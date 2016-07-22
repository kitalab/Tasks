<?php
/**
 * TaskContent Model
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('TasksAppModel', 'Tasks.Model');

/**
 * Summary for TaskContent Model
 */
class TaskContent extends TasksAppModel {

/**
 * @var int recursiveはデフォルトアソシエーションなしに
 */
	public $recursive = -1;

/**
 * use behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'NetCommons.Trackable',
		'NetCommons.OriginalKey',
		'Workflow.Workflow',
		'Workflow.WorkflowComment',
		'ContentComments.ContentComment',
		'Topics.Topics' => array(
			'fields' => array(
				'title' => 'title',
				'summary' => 'content',
				'path' => '/:plugin_key/task_contents/view/:block_id/:content_key',
			),
		),
		'Mails.MailQueue' => array(
			'embedTags' => array(
				'X-SUBJECT' => 'TaskContent.title',
				'X-BODY' => 'TaskContent.content',
			),
		),
		'Tasks.TaskCharge',
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Categories.Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TaskCharge' => array(
			'className' => 'Tasks.TaskCharge',
			'foreignKey' => 'task_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);

/**
 * バリデートメッセージ多言語化対応のためのラップ
 *
 * @param array $options options
 * @return bool
 */
	public function beforeValidate($options = array()) {
		$this->validate = Hash::merge(
			$this->validate,
			$this->_getValidateSpecification()
		);
		return parent::beforeValidate($options);
	}

/**
 * バリデーションルールを返す
 *
 * @return array
 */
	protected function _getValidateSpecification() {
		$validate = array(
			'title' => array(
				'notBlank' => [
					'rule' => array('notBlank'),
					'message' => sprintf(__d('net_commons', 'Please input %s.'), __d('tasks', 'Title')),
					'required' => true,
				],
			),
			'content' => array(
				'notBlank' => [
					'rule' => array('notBlank'),
					'message' => sprintf(__d('net_commons', 'Please input %s.'), __d('tasks', 'Content')),
					'required' => true,
				],
			),
		);
		return $validate;
	}

/**
 * ToDoの一覧データを返す
 *
 * @param array $conditions ソート絞り込み条件
 * @return array
 */
	public function getList($conditions = array()) {
		$conditions = $this->getConditions(
			Current::read('Block.id'),
			$conditions
		);

		$lists = $this->find('all', array(
			'recursive' => 1,
			'conditions' => $conditions
		));

		if (!$lists) {
			return array();
		}

		// 取得したデータに存在するカテゴリ配列を取得
		$categoryArr = Hash::combine($lists, '{n}.Category.id', '{n}.Category');

		$taskContentList = array();
		foreach ($categoryArr as $category) {
			$results = array();
			// カテゴリが未指定のときのカテゴリ情報を作成
			if (empty($category['id'])) {
				$category['id'] = 0;
				$category['name'] = __d('tasks', 'No category');
			}

			$contents = Hash::extract(
				$lists, '{n}.TaskContent[category_id=' . $category['id'] . ']', '{n}'
			);

			// ToDoとToDo担当者を一つの配列にまとめる
			foreach ($contents as $content) {
				$taskCharge = Hash::extract(
					$lists, '{n}.TaskCharge.{n}[task_id=' . $content['id'] . ']'
				);
				$results['TaskContents'][] = array('TaskContent' => $content, 'TaskCharge' => $taskCharge);
			}

			$categoryPriority = $this->getCategoryPriority($contents);

			$results['Category'] = $category;
			$results['Category']['category_priority'] = $categoryPriority;
			$taskContentList[] = $results;
		}

		return $taskContentList;
	}

/**
 * UserIdから参照可能なToDoを取得するCondition配列を返す
 *
 * @param int $blockId ブロックId
 * @param array $conditions ソート絞り込み条件
 * @return array condition
 */
	public function getConditions($blockId, $conditions = array()) {
		// デフォルト絞り込み条件にソート絞り込み条件をマージする
		$conditions = array_merge($conditions, array('TaskContent.block_id' => $blockId));

		$conditions = $this->getWorkflowConditions($conditions);

		return $conditions;
	}

/**
 * カテゴリごとのToDoの進捗率の平均値を取得
 *
 * @param array $contents ToDoデータ
 * @return int
 */
	public function getCategoryPriority($contents) {
		$taskPriority = array();
		foreach ($contents as $content) {
			$taskPriority[] = $content['progress_rate'];
		}

		// ToDoの進捗率の合計を求める
		$total = array_sum($taskPriority);

		// 実際の値より大きくならないよう小数点以下切り捨て
		$categoryPriority = floor($total / count($taskPriority));

		return $categoryPriority;
	}
}