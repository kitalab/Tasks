<?php
/**
 * TasksApp Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@wihtone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppController', 'Controller');

/**
 * TasksApp Controller
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@wihtone.co.jp>
 * @package NetCommons\Tasks\Controller
 * @property TaskSetting $TaskSetting
 */
class TasksAppController extends AppController {

/**
 * @var array ToDo名
 */
	protected $_taskTitle;

/**
 * @var array ToDo設定
 */
	protected $_taskSetting;

/**
 * use component
 *
 * @var array
 */
	public $components = array (
		'Pages.PageLayout',
		'Security',
		'Tasks.Tasks',
	);

/**
 * @var array use model
 */
	public $uses = array(
		'Tasks.Task',
		'Tasks.TaskSetting',
	);

/**
 * ブロック名をToDoタイトルとしてセットする
 *
 * @return void
 */
	protected function _setupTaskTitle() {
		$this->loadModel('Blocks.Block');
		$block = $this->Block->find('first', array(
			'recursive' => 0,
			'condtions' => array(
				'Block.id' => Current::read('Block.id')
			)
		));
		var_dump($block);
		$this->_taskTitle = $block['BlocksLanguage']['name'];
	}

/**
 * 設定等の呼び出し
 *
 * @return void
 */
	protected function _prepare() {
		$this->_setupTaskTitle();
		$this->_initTask(['taskSetting']);
	}

/**
 * initTask
 *
 * @param array $contains Optional result sets
 * @return bool True on success, False on failure
 */
	protected function _initTask($contains = []) {
		$task = $this->Task->getTask();
		if (! $task) {
			return $this->throwBadRequest();
		}
		$this->_TaskTitle = $task['Task']['name'];
		$this->set('task', $task);

		if (! $taskSetting = $this->TaskSetting->getTaskSetting()) {
			$taskSetting = $this->TaskSetting->createBlockSetting();
			$taskSetting['TaskSetting']['task_key'] = null;
		} else {
			$taskSetting['TaskSetting']['task_key'] = $task['Task']['key'];
		}

		$this->_taskSetting = $taskSetting;
		$this->set('taskSetting', $taskSetting['TaskSetting']);

		$this->set('userId', (int)$this->Auth->user('id'));

		return true;
	}

}
