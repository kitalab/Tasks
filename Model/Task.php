<?php
/**
 * TaskContent Model
 *
 * @property User $User
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('TasksAppModel', 'Tasks.Model');
App::uses('MailQueueBehavior', 'Mails.Model/Behavior');
App::uses('WorkflowComponent', 'Workflow.Controller/Component');

/**
 * Task Model
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @package NetCommons\Tasks\Model
 */
class Task extends TasksAppModel {

/**
 * use tables
 *
 * @var string
 */
	public $useTable = 'tasks';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

/**
 * use behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'Blocks.Block' => array(
			'name' => 'Task.name',
			'loadModels' => array(
				'BlockSetting' => 'Blocks.BlockSetting',
				'Category' => 'Categories.Category',
				'CategoryOrder' => 'Categories.CategoryOrder',
				'WorkflowComment' => 'Workflow.WorkflowComment',
			)
		),
		'Categories.Category',
		'NetCommons.OriginalKey',
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Block' => array(
			'className' => 'Blocks.Block',
			'foreignKey' => 'block_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * Called during validation operations, before validation. Please note that custom
 * validation rules can be defined in $validate.
 *
 * @param array $options Options passed from Model::save().
 * @return bool True if validate operation should continue, false to abort
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforevalidate
 * @see Model::save()
 */
	public function beforeValidate($options = array()) {
		$this->validate = Hash::merge($this->validate, array(
			'key' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => __d('net_commons', 'Invalid request.'),
					'allowEmpty' => false,
					'required' => true,
					'on' => 'update'
				),
			),

			'name' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => sprintf(__d('net_commons', 'Please input %s.'), __d('tasks', 'Task name')),
					'required' => true
				),
			),
		));

		if (isset($this->data['TaskSetting'])) {
			$this->TaskSetting->set($this->data['TaskSetting']);
			if (! $this->TaskSetting->validates()) {
				$this->validationErrors = Hash::merge($this->validationErrors,
					$this->TaskSetting->validationErrors);
				return false;
			}
		}

		return parent::beforeValidate($options);
	}

/**
 * Called after each successful save operation.
 *
 * @param bool $created True if this save created a new record
 * @param array $options Options passed from Model::save().
 * @return void
 * @throws InternalErrorException
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#aftersave
 * @see Model::save()
 */
	public function afterSave($created, $options = array()) {
		//TaskSetting登録
		if (isset($this->TaskSetting->data['TaskSetting'])) {
			$this->TaskSetting->set($this->TaskSetting->data['TaskSetting']);
			$this->TaskSetting->save(null, false);
		}

		parent::afterSave($created, $options);
	}

/**
 * Create task data
 *
 * @return array
 */
	public function createTask() {
		$this->loadModels(['TaskSetting' => 'Tasks.TaskSetting']);

		$task = $this->createAll(array(
				'Task' => array(
					'name' => __d('tasks', 'New task list', date('YmdHis'))
				),
				'Block' => array(
					'room_id' => Current::read('Room.id'),
					'language_id' => Current::read('Language.id'),
				),
			)
		);

		$task = Hash::merge($task, $this->TaskSetting->createBlockSetting());

		return $task;
	}

/**
 * Get task data
 *
 * @return array
 */
	public function getTask() {
		$this->loadModels(['TaskSetting' => 'Tasks.TaskSetting']);

		$task = $this->find('all', array(
				'recursive' => -1,
				'fields' => array(
					$this->alias . '.*',
					$this->Block->alias . '.*',
				),
				'joins' => array(
					array(
						'table' => $this->Block->table,
						'alias' => $this->Block->alias,
						'type' => 'INNER',
						'conditions' => array(
							$this->alias . '.block_id' . ' = ' . $this->Block->alias . ' .id',
						),
					),
				),
				'conditions' => $this->getBlockConditionById(),
			)
		);
		if (! $task) {
			return $task;
		}
		return Hash::merge($task[0], $this->TaskSetting->getTaskSetting());
	}

/**
 * Save tasks
 *
 * @param array $data received post data
 * @return bool True on success, false on validation errors
 * @throws InternalErrorException
 */
	public function saveTask($data) {
		$this->loadModels(['Task' => 'Tasks.Task', 'TaskSetting' => 'Tasks.TaskSetting']);

		//トランザクションBegin
		$this->begin();

		//バリデーション
		$this->set($data);
		if (! $this->validates()) {
			return false;
		}

		try {
			//登録処理
			if (! $this->save(null, false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
			//トランザクションCommit
			$this->commit();

		} catch (Exception $ex) {
			//トランザクションRollback
			$this->rollback($ex);
		}

		return true;
	}

/**
 * Delete tasks
 *
 * @param array $data received post data
 * @return mixed On success Model::$data if its not empty or true, false on failure
 * @throws InternalErrorException
 */
	public function deleteTask($data) {
		$this->loadModels([
			'Task' => 'Tasks.Task',
			'TaskSetting' => 'Tasks.TaskSetting',
			'TaskContent' => 'Tasks.TaskContent',
		]);

		//トランザクションBegin
		$this->begin();

		try {
			$conditions = array($this->alias . '.key' => $data['Task']['key']);
			if (! $this->deleteAll($conditions, false, false)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			$this->TaskContent->blockKey = $data['Block']['key'];
			$ContentConditions = array(
				$this->TaskContent->alias . '.key' => $data['Task']['key']
			);
			if (! $this->TaskContent->deleteAll($ContentConditions, false, true)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			//Blockデータ削除
			$this->deleteBlock($data['Block']['key']);

			//トランザクションCommit
			$this->commit();

		} catch (Exception $ex) {
			//トランザクションRollback
			$this->rollback($ex);
		}

		return true;
	}

}
