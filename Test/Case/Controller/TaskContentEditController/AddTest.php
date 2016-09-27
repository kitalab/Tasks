<?php
/**
 * TaskContentEditController::add()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('WorkflowControllerAddTest', 'Workflow.TestSuite');

/**
 * TaskContentEditController::add()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Controller\TaskContentsController
 */
class TaskContentEditControllerAddTest extends WorkflowControllerAddTest {

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
	protected $_controller = 'task_content_edit';

/**
 * テストDataの取得
 *
 * @return array
 */
	private function __data() {
		$frameId = '6';
		$blockId = '2';
		$blockKey = 'block_1';

		$data = array(
			'save_' . WorkflowComponent::STATUS_IN_DRAFT => null,
			'Frame' => array(
				'id' => $frameId,
			),
			'Block' => array(
				'id' => $blockId,
				'key' => $blockKey,
				'language_id' => '2',
				'room_id' => '1',
				'plugin_key' => $this->plugin,
			),
			'TaskContent' => array(
				'id' => null,
				'key' => null,
				'language_id' => '2',
				'status' => null,
				'title' => 'Title 1',
				'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
				'priority' => 1,
				'is_date_set' => true,
				'is_enable_mail' => false,
				'email_send_timing' => '2',
				'task_start_date' => '2016-03-10 07:10:12',
				'task_end_date' => '2016-03-17 07:10:12',
			),
			'TaskCharge' => array(
				0 => array(
					'user_id' => 2
				),
			),
			'WorkflowComment' => array(
				'comment' => 'WorkflowComment save test',
			),
		);

		return $data;
	}

/**
 * addアクションのGETテスト(ログインなし)用DataProvider
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - assert: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderAddGet() {
		$data = $this->__data();

		//テストデータ
		$results = array();
		// * ログインなし
		$results[0] = array(
			'urlOptions' => array(
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id']
			),
			'assert' => null, 'exception' => 'ForbiddenException',
		);

		return $results;
	}

/**
 * addアクションのGETテスト(作成権限あり)用DataProvider
 *
 * ### 戻り値
 *  - urlOptions: URLオプション
 *  - assert: テストの期待値
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderAddGetByCreatable() {
		$data = $this->__data();

		//テストデータ
		$results = array();
		$results[0] = array(
			'urlOptions' => array(
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id'],
			),
			'assert' => array('method' => 'assertNotEmpty'),
		);

		// * フレームID指定なしテスト
		array_push($results, Hash::merge($results[0], array(
			'urlOptions' => array('frame_id' => null, 'block_id' => $data['Block']['id']),
			'assert' => array('method' => 'assertNotEmpty'),
		)));

		return $results;
	}

/**
 * addアクションのPOSTテスト用DataProvider
 *
 * ### 戻り値
 *  - data: 登録データ
 *  - role: ロール
 *  - urlOptions: URLオプション
 *  - exception: Exception
 *  - return: testActionの実行後の結果
 *
 * @return array
 */
	public function dataProviderAddPost() {
		$data = $this->__data();

		//テストデータ
		$results = array();
		// * ログインなし
		$results[0] = array(
			'data' => $data, 'role' => null,
			'urlOptions' => array(
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id']
			),
			'exception' => 'ForbiddenException'
		);
		// * 作成権限あり
		$results[1] = array(
			'data' => $data, 'role' => Role::ROOM_ROLE_KEY_GENERAL_USER,
			'urlOptions' => array(
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id']
			),
		);
		// * フレームID指定なしテスト
		$results[2] = array(
			'data' => $data, 'role' => Role::ROOM_ROLE_KEY_ROOM_ADMINISTRATOR,
			'urlOptions' => array(
				'frame_id' => null,
				'block_id' => $data['Block']['id']),
		);
		// * is_date_setがfalseの場合のテスト
		$results[3] = array(
			'data' => $data, 'role' => Role::ROOM_ROLE_KEY_ROOM_ADMINISTRATOR,
			'urlOptions' => array(
				'frame_id' => null,
				'block_id' => $data['Block']['id']),
		);

		return $results;
	}

/**
 * addアクションのValidationErrorテスト用DataProvider
 *
 * ### 戻り値
 *  - data: 登録データ
 *  - urlOptions: URLオプション
 *  - validationError: バリデーションエラー
 *
 * @return array
 */
	public function dataProviderAddValidationError() {
		$data = $this->__data();
		$result = array(
			'data' => $data,
			'urlOptions' => array(
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id']
			),
			'validationError' => array(),
		);

		//テストデータ
		$results = array();
		array_push($results, Hash::merge($result, array(
			'validationError' => array(
				'field' => 'TaskContent.title',
				'value' => '',
				'message' => sprintf(__d('net_commons', 'Please input %s.'), __d('tasks', 'Title')),
			)
		)));
		array_push($results, Hash::merge($result, array(
			'validationError' => array(
				'field' => 'TaskContent.category_id',
				'value' => 'text',
				'message' => sprintf(__d('net_commons', 'Invalid request.')),
			)
		)));
		array_push($results, Hash::merge($result, array(
			'validationError' => array(
				'field' => 'TaskContent.priority',
				'value' => 100,
				'message' => sprintf(__d('net_commons', 'Invalid request.')),
			)
		)));
		array_push($results, Hash::merge($result, array(
			'validationError' => array(
				'field' => 'TaskContent.priority',
				'value' => 'text',
				'message' => sprintf(__d('net_commons', 'Invalid request.')),
			)
		)));
		array_push($results, Hash::merge($result, array(
			'validationError' => array(
				'field' => 'TaskContent.is_date_set',
				'value' => 100,
				'message' => sprintf(__d('net_commons', 'Invalid request.')),
			)
		)));
		array_push($results, Hash::merge($result, array(
			'validationError' => array(
				'field' => 'TaskContent.is_date_set',
				'value' => 'text',
				'message' => sprintf(__d('net_commons', 'Invalid request.')),
			)
		)));
		array_push($results, Hash::merge($result, array(
			'validationError' => array(
				'field' => 'TaskContent.is_date_set',
				'value' => '',
				'message' => sprintf(__d('net_commons', 'Invalid request.')),
			)
		)));
		array_push($results, Hash::merge($result, array(
			'validationError' => array(
				'field' => 'TaskContent.task_start_date',
				'value' => '2112-09-03 07:10:12',
				'message' => sprintf(__d('net_commons', 'Invalid request.')),
			)
		)));
		array_push($results, Hash::merge($result, array(
			'validationError' => array(
				'field' => 'TaskCharge.0.user_id',
				'value' => 200,
				'message' => sprintf(__d('net_commons', 'Failed on validation errors. Please check the input data.')),
			)
		)));

		// リマインダーメールを作成するとき
		$data2 = $this->__data();
		$data2['TaskContent']['is_enable_mail'] = true;
		$result2 = array(
			'data' => $data2,
			'urlOptions' => array(
					'frame_id' => $data2['Frame']['id'],
					'block_id' => $data2['Block']['id']
			),
			'validationError' => array(),
		);
		array_push($results, Hash::merge($result2, array(
			'validationError' => array(
				'field' => 'TaskContent.task_end_date',
				'value' => '',
				'message' => sprintf(__d('tasks', 'Please set the end date.')),
			)
		)));

		return $results;
	}

/**
 * Viewのアサーション
 *
 * @param array $data テストデータ
 * @return void
 */
	private function __assertAddGet($data) {
		$this->assertInput(
			'input', 'data[Frame][id]', $data['Frame']['id'], $this->view
		);
		$this->assertInput(
			'input', 'data[Block][id]', $data['Block']['id'], $this->view
		);
	}

/**
 * view(ctp)ファイルのテスト(公開権限なし)
 *
 * @return void
 */
	public function testViewFileByCreatable() {
		TestAuthGeneral::login($this, Role::ROOM_ROLE_KEY_GENERAL_USER);

		//テスト実行
		$data = $this->__data();
		$this->_testGetAction(
			array(
				'action' => 'add',
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id'],
			),
			array('method' => 'assertNotEmpty')
		);

		//チェック
		$this->__assertAddGet($data);
		$this->assertInput('button', 'save_' . WorkflowComponent::STATUS_IN_DRAFT, null, $this->view);
		$this->assertInput('button', 'save_' . WorkflowComponent::STATUS_APPROVED, null, $this->view);

		TestAuthGeneral::logout($this);
	}

/**
 * view(ctp)ファイルのテスト(公開権限あり)
 *
 * @return void
 */
	public function testViewFileByPublishable() {
		//ログイン
		TestAuthGeneral::login($this);

		//テスト実行
		$data = $this->__data();
		$this->_testGetAction(
			array(
				'action' => 'add',
				'frame_id' => $data['Frame']['id'],
				'block_id' => $data['Block']['id'],
			),
			array('method' => 'assertNotEmpty')
		);

		//チェック
		$this->__assertAddGet($data);
		$this->assertInput('button', 'save_' . WorkflowComponent::STATUS_IN_DRAFT, null, $this->view);
		$this->assertInput('button', 'save_' . WorkflowComponent::STATUS_PUBLISHED, null, $this->view);

		//ログアウト
		TestAuthGeneral::logout($this);
	}

/**
 * edit()アクションのPOSTリクエストテスト
 *
 * @return void
 */
	public function testEditPost() {
		//ログイン
		TestAuthGeneral::login($this);
		//テストデータ
		$data = $this->__data();
		$data['TaskContent']['is_date_set'] = false;
		$data['TaskContent']['is_enable_mail'] = false;

		//アクション実行
		$url = NetCommonsUrl::actionUrl(array(
			'plugin' => $this->plugin,
			'controller' => $this->_controller,
			'action' => 'add',
			'content_key' => 'task_content_key',
			'frame_id' => $data['Frame']['id'],
			'block_id' => $data['Block']['id'],
		));
		$params = array(
			'data' => $data,
		);
		$this->testAction($url, $params);

		//チェック
		$header = $this->controller->response->header();
		$asserts = array(
			array('method' => 'assertNotEmpty', 'value' => $header['Location'])
		);
		$this->asserts($asserts, $this->contents);

		//ログアウト
		TestAuthGeneral::logout($this);
	}

}
