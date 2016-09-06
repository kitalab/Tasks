<?php
/**
 * View/Elements/TaskContents/select_userのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * View/Elements/TaskContents/select_userのテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\View\Elements\TaskContents\SelectUser
 */
class TasksViewElementsTaskContentsSelectUserTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array();

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
		$this->generateNc('TestTasks.TestViewElementsTaskContentsSelectUser');
	}

/**
 * View/Elements/TaskContents/select_userのテスト
 *
 * @return void
 */
	public function testSelectUser() {
		$this->controller->set('currentUserId', '');
		$this->controller->set('options', array(
			'TaskContents.charge_user_id_' => array(
				'label' => 'aaa',
				'user_id' => '',
			)
		));
		//テスト実行
		$this->_testGetAction('/test_tasks/test_view_elements_task_contents_select_user/select_user',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/TaskContents/select_user', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		debug($this->view);
	}

}
