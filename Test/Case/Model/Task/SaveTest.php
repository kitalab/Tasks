<?php
/**
 * Task::beforeSave()とafterSave()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');
App::uses('NetCommonsSaveTest', 'NetCommons.TestSuite');
App::uses('TaskFixture', 'Tasks.Test/Fixture');

/**
 * Task::beforeSave()とafterSave()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\Task
 */
class TaskSaveTest extends NetCommonsSaveTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.categories.category',
		'plugin.categories.category_order',
		'plugin.categories.categories_language',
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
 * Model name
 *
 * @var string
 */
	protected $_modelName = 'Task';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'saveTask';

/**
 * Method name
 *
 * @var string
 */
	public $blockKey = 'block_1';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		Current::write('Plugin.key', $this->plugin);
		Current::write('Block.key', $this->blockKey);
	}

/**
 * テストDataの取得
 *
 * @param string $taskKey
 * @return array
 */
	private function __getData($taskKey = 'task_1') {
		$frameId = '6';
		$frameKey = 'frame_3';
		$blockId = '2';
		$blockKey = $this->blockKey;
		if ($taskKey === 'task_1') {
			$taskId = '2';
		} else {
			$taskId = null;
		}

		$data = array(
			'Frame' => array(
				'id' => $frameId
			),
			'Block' => array(
				'id' => $blockId,
				'key' => $blockKey,
				'language_id' => '2',
				'room_id' => '2',
				'plugin_key' => $this->plugin,
				'public_type' => '1',
			),
			'Task' => array(
				'id' => $taskId,
				'key' => $taskKey,
				'name' => 'taskName',
				'block_id' => $blockId,
				'public_type' => '1',
			),
			'TaskSetting' => array(
				'use_comment' => '1',
			),
			'TaskFrameSetting' => array(
				'id' => $taskId,
				'frame_key' => $frameKey,
				'articles_per_page' => 10,
			),
		);

		return $data;
	}

/**
 * SaveのDataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *
 * @return array
 */
	public function dataProviderSave() {
		return array(
			array($this->__getData()), //修正
			array($this->__getData(null)), //新規
		);
	}

/**
 * SaveのExceptionErrorのDataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *  - mockModel Mockのモデル
 *  - mockMethod Mockのメソッド
 *
 * @return array
 */
	public function dataProviderSaveOnExceptionError() {
		return array(
			array($this->__getData(), 'Tasks.Task', 'save'),
			array($this->__getData(null), 'Blocks.BlockSetting', 'saveMany'),
		);
	}

/**
 * SaveのValidationErrorのDataProvider
 *
 * ### 戻り値
 *  - data 登録データ
 *  - mockModel Mockのモデル
 *
 * @return array
 */
	public function dataProviderSaveOnValidationError() {
		return array(
			array($this->__getData(), 'Tasks.Task'),
			array($this->__getData(), 'Tasks.TaskSetting'),
		);
	}

}
