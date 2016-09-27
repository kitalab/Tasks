<?php
/**
 * View/Elements/TaskBlocks/delete_formのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * View/Elements/TaskBlocks/delete_formのテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\View\Elements\TaskBlocks\DeleteForm
 */
class TasksViewElementsTaskBlocksDeleteFormTest extends NetCommonsControllerTestCase {

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
		$this->generateNc('TestTasks.TestViewElementsTaskBlocksDeleteForm');
	}

/**
 * View/Elements/TaskBlocks/delete_formのテスト
 *
 * @return void
 */
	public function testDeleteForm() {
		//テスト実行
		$this->_testGetAction('/test_tasks/test_view_elements_task_blocks_delete_form/delete_form',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/TaskBlocks/delete_form', '/') . '/';
		$this->assertRegExp($pattern, $this->view);
	}
}
