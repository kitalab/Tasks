<?php
/**
 * TaskBlocksController::add(),edit(),delete()
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Nakata Tomoyoshi <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('BlocksControllerEditTest', 'Blocks.TestSuite');

/**
 * TaskBlocksController::add(),edit(),delete()
 *
 * @author Nakata Tomoyoshi <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Controller\TaskBlocksController
 */
class TaskBlocksControllerEditTest extends BlocksControllerEditTest {

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
	protected $_controller = 'task_blocks';

/**
 * Edit controller name
 *
 * @var string
 */
	protected $_editController = 'task_blocks';

/**
 * テストDataの取得
 *
 * @param bool $isEdit 編集かどうか
 * @return array
 */
	private function __data($isEdit) {
		$frameId = '6';
		//$frameKey = 'frame_3';
		if ($isEdit) {
			$blockId = '4';
			$blockKey = 'block_2';
			$taskId = '3';
			$taskKey = 'task_key_2';
		} else {
			$blockId = null;
			$blockKey = null;
			$taskId = null;
			$taskKey = null;
		}

		$data = array(
			'Frame' => array(
				'id' => $frameId
			),
			'Block' => array(
				'id' => $blockId,
				'key' => $blockKey,
				'language_id' => '2',
				'room_id' => '1',
				'plugin_key' => $this->plugin,
				'public_type' => '2',
				'publish_start' => '2015-01-28 04:56:56',
				'publish_end' => '2015-01-31 04:56:56',
			),
			'Task' => array(
				'id' => $taskId,
				'key' => $taskKey,
				'block_id' => $blockId,
				'name' => 'Task name',
			),
			'TaskSetting' => array(
				'id' => $taskId,
				'use_workflow' => 1,
				'use_comment_approval' => 1,
				'use_comment' => 1,
			),
			'old' => Array(
				'Categories' =>
					'[{
						"Category":{
							"id":"1",
							"block_id":"2",
							"key":"category_1",
							"language_id":"2",
							"name":"Category 1",
							"created_user":"1",
							"created":"2015-01-28 04:56:56",
							"modified_user":"1",
							"modified":"2015-01-28 04:56:56"
						},"CategoryOrder":{
							"id":"1",
							"category_key":"category_1",
							"block_key":"block_1",
							"weight":"1",
							"created_user":"1",
							"created":"2015-01-28 04:57:05",
							"modified_user":"1",
							"modified":"2015-01-28 04:57:05"
						}
					}]'
			),
		);

		return $data;
	}

/**
 * add()アクションDataProvider
 *
 * ### 戻り値
 *  - method: リクエストメソッド（get or post or put）
 *  - data: 登録データ
 *  - validationError: バリデーションエラー
 *
 * @return array
 */
	public function dataProviderAdd() {
		$data = $this->__data(false);

		//テストデータ
		$results = array();
		$results[0] = array('method' => 'get');
		$results[1] = array('method' => 'put');
		$results[2] = array('method' => 'post', 'data' => $data, 'validationError' => false);
		$results[3] = array('method' => 'post', 'data' => $data,
			'validationError' => array(
				'field' => 'Task.name',
				'value' => '',
				'message' => sprintf(__d('net_commons', 'Please input %s.'), __d('tasks', 'Task name')),
			)
		);
		$results[4] = array('method' => 'post', 'data' => $data,
			'validationError' => array(
				'field' => 'Block.public_type',
				'value' => '100',
				'message' => __d('net_commons', 'Failed on validation errors. Please check the input data.'),
			)
		);
		$results[5] = array('method' => 'post', 'data' => $data,
			'validationError' => array(
				'field' => 'Block.publish_start',
				'value' => '2112-09-03 10:00:00',
				'message' => 'value="2112-09-03 10:00:00"',
			)
		);
		$results[6] = array('method' => 'post', 'data' => $data,
			'validationError' => array(
				'field' => 'TaskSetting.use_comment',
				'value' => '',
				'message' => __d('net_commons', 'Failed on validation errors. Please check the input data.'),
			)
		);

		return $results;
	}

/**
 * edit()アクションDataProvider
 *
 * ### 戻り値
 *  - method: リクエストメソッド（get or post or put）
 *  - data: 登録データ
 *  - validationError: バリデーションエラー
 *
 * @return array
 */
	public function dataProviderEdit() {
		$data = $this->__data(true);

		//テストデータ
		$results = array();
		$results[0] = array('method' => 'get');
		$results[1] = array('method' => 'post');
		$results[2] = array('method' => 'put', 'data' => $data, 'validationError' => false);
		$results[3] = array('method' => 'put', 'data' => $data,
			'validationError' => array(
				'field' => 'Task.name',
				'value' => '',
				'message' => sprintf(__d('net_commons', 'Please input %s.'), __d('tasks', 'Task name')),
			)
		);
		$results[4] = array('method' => 'put', 'data' => $data,
			'validationError' => array(
				'field' => 'Block.public_type',
				'value' => '100',
				'message' => __d('net_commons', 'Failed on validation errors. Please check the input data.'),
			)
		);
		$results[5] = array('method' => 'put', 'data' => $data,
			'validationError' => array(
				'field' => 'Block.publish_start',
				'value' => '2112-09-03 10:00:00',
				'message' => 'value="2112-09-03 10:00:00"',
			)
		);
		$results[6] = array('method' => 'put', 'data' => $data,
			'validationError' => array(
				'field' => 'TaskSetting.use_comment',
				'value' => '',
				'message' => __d('net_commons', 'Failed on validation errors. Please check the input data.'),
			)
		);

		$data['old'] = array();
		$results[7] = array('method' => 'put', 'data' => $data, 'validationError' => false);

		return $results;
	}

/**
 * delete()アクションDataProvider
 *
 * ### 戻り値
 *  - data 削除データ
 *
 * @return array
 */
	public function dataProviderDelete() {
		$data = array(
			'Block' => array(
				'id' => '4',
				'key' => 'block_2',
			),

			'Task' => array(
				'key' => 'task_key_2',
			),
		);

		//テストデータ
		$results = array();
		$results[0] = array('data' => $data);

		return $results;
	}

/**
 * TaskNotFoundでBadRequest
 *
 * @return void
 */
	public function testEditTaskNotFound() {
		//ログイン
		TestAuthGeneral::login($this);

		$this->_mockForReturnFalse('Tasks.Task', 'getTask', 1);

		//テスト実行
		$result = $this->_testGetAction(array('action' => 'edit', 'block_id' => '2', 'frame_id' => '6'),
			false, 'BadRequestException', 'view');
		$this->assertFalse($result);

		//ログアウト
		TestAuthGeneral::logout($this);
	}

}
