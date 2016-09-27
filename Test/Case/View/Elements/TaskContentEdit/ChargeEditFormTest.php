<?php
/**
 * View/Elements/TaskContentEdit/charge_edit_formのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');
App::uses('GroupUserListHelper', 'Groups.View/Helper');

/**
 * View/Elements/TaskContentEdit/charge_edit_formのテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\View\Elements\TaskContentEdit\ChargeEditForm
 */
class TasksViewElementsTaskContentEditChargeEditFormTest extends NetCommonsControllerTestCase {

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

		$View = new View();
		new GroupUserListHelper($View);

		//テストプラグインのロード
		NetCommonsCakeTestCase::loadTestPlugin($this, 'Tasks', 'TestTasks');
		//テストコントローラ生成
		$this->generateNc('TestTasks.TestViewElementsTaskContentEditChargeEditForm');
	}

/**
 * View/Elements/TaskContentEdit/charge_edit_formのテスト
 *
 * @return void
 */
	public function testChargeEditForm() {
		//テスト実行
		$this->_testGetAction('/test_tasks/test_view_elements_task_content_edit_charge_edit_form/charge_edit_form',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/TaskContentEdit/charge_edit_form', '/') . '/';
		$this->assertRegExp($pattern, $this->view);
	}
}
