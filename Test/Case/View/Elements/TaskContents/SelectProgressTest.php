<?php
/**
 * View/Elements/TaskContents/select_progressのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');
App::uses('TaskContent', 'Tasks.Model');

/**
 * View/Elements/TaskContents/select_progressのテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\View\Elements\TaskContents\SelectProgress
 */
class TasksViewElementsTaskContentsSelectProgressTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.tasks.task_content',
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'tasks';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//テストプラグインのロード
		NetCommonsCakeTestCase::loadTestPlugin($this, 'Tasks', 'TestTasks');
		//テストコントローラ生成
		$this->generateNc('TestTasks.TestViewElementsTaskContentsSelectProgress');
	}

/**
 * View/Elements/TaskContents/select_progressのテスト
 *
 * @return void
 */
	public function testSelectProgress() {
		$this->controller->set('taskContent', array(
			'TaskContent' => array(
				'key' => 1,
			)
		));
		$this->controller->set('progressRate', 20);
		$this->controller->set('disabled', false);
		//テスト実行
		$this->_testGetAction('/test_tasks/test_view_elements_task_contents_select_progress/select_progress',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/TaskContents/select_progress', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		debug($this->view);
	}

}
