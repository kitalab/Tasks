<?php
/**
 * View/Elements/TaskContents/priority_iconのテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');
App::uses('TitleIconHelper', 'NetCommons.View/Helper');

/**
 * View/Elements/TaskContents/priority_iconのテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\View\Elements\TaskContents\PriorityIcon
 */
class TasksViewElementsTaskContentsPriorityIconTest extends NetCommonsControllerTestCase {

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

		$view = new View();
		new TitleIconHelper($view);

		//テストプラグインのロード
		NetCommonsCakeTestCase::loadTestPlugin($this, 'Tasks', 'TestTasks');
		//テストコントローラ生成
		$this->generateNc('TestTasks.TestViewElementsTaskContentsPriorityIcon');
	}

/**
 * View/Elements/TaskContents/priority_iconのテスト用DataProvider
 *
 * @return array
 */
	public function dataProviderPriorityIcon() {
		$results = array();

		$results[0] = array(
			'priority' => 1
		);
		$results[1] = array(
			'priority' => 2
		);
		$results[2] = array(
			'priority' => 3
		);

		return $results;
	}

/**
 * View/Elements/TaskContents/priority_iconのテスト
 *
 * @param $data
 * @return void
 * @dataProvider dataProviderPriorityIcon
 */
	public function testPriorityIcon($data) {
		$this->controller->set('class', false);
		$this->controller->set('priority', $data);
		//テスト実行
		$this->_testGetAction('/test_tasks/test_view_elements_task_contents_priority_icon/priority_icon',
				array('method' => 'assertNotEmpty'), null, 'view');

		//チェック
		$pattern = '/' . preg_quote('View/Elements/TaskContents/priority_icon', '/') . '/';
		$this->assertRegExp($pattern, $this->view);

		debug($this->view);
	}

}
