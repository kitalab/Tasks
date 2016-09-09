<?php
/**
 * View/Elements/TaskContents/select_sortのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * View/Elements/TaskContents/select_sortのテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\View\Elements\TaskContents\SelectSort
 */
class TasksViewElementsTaskContentsSelectSortTest extends NetCommonsControllerTestCase {

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
		$this->generateNc('TestTasks.TestViewElementsTaskContentsSelectSort');
	}

/**
 * View/Elements/TaskContents/select_sortのテスト
 *
 * @return void
 */
	public function testSelectSort() {
		$this->controller->set('currentSort', '');
		$this->controller->set('options', array(
			'TaskContent.task_end_date.asc' => array(
				'label' => 'aaa',
				'sort' => 'task_end_date',
				'direction' => 'asc',
			)
		));
		//テスト実行
		$this->_testGetAction('/test_tasks/test_view_elements_task_contents_select_sort/select_sort',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/TaskContents/select_sort', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		debug($this->view);
	}

}
