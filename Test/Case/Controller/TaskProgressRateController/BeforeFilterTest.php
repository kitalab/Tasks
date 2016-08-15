<?php
/**
 * TaskProgressRateController::beforeFilter()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsControllerTestCase', 'NetCommons.TestSuite');

/**
 * TaskProgressRateController::beforeFilter()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Controller\TaskProgressRateController
 */
class TaskProgressRateControllerBeforeFilterTest extends NetCommonsControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.categories.category',
		'plugin.categories.category_order',
		'plugin.tasks.task',
		'plugin.tasks.task_charge',
		'plugin.tasks.task_content',
		'plugin.tasks.block_setting_for_task',
		'plugin.workflow.workflow_comment',
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'tasks';

/**
 * Controller name
 *
 * @var string
 */
	protected $_controller = 'task_progress_rate';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//ログイン
		TestAuthGeneral::login($this);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		//ログアウト
		TestAuthGeneral::logout($this);

		parent::tearDown();
	}

/**
 * index()アクションのGetリクエストテスト
 *
 * @return void
 */
	public function testBeforeFilterGet() {
		//テストデータ
		$blockId = '2';
		$data = array(
			'TaskContent' => array(
				'progress_rate' => '10',
			),
		);

		//アクション実行
		$url = NetCommonsUrl::actionUrl(array(
			'plugin' => $this->plugin,
			'controller' => $this->_controller,
			'action' => 'edit',
			'block_id' => $blockId
		));
		$params = array(
			'data' => $data,
		);
		$result = $this->testAction($url, $params);

		//チェック
		$this->assertNull($result);
	}

}
