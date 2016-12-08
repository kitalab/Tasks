<?php
/**
 * Task::getTask()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsGetTest', 'NetCommons.TestSuite');

/**
 * Task::getTask()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\Task
 */
class TaskGetTaskTest extends NetCommonsGetTest {

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
	protected $_methodName = 'getTask';

/**
 * getのDataProvider
 *
 * #### 戻り値
 *  - array 取得するキー情報
 *  - array 期待値 （取得したキー情報）
 *
 * @return array
 */
	public function dataProviderGet() {
		$existData = array('Block.id' => '2', 'Room.id' => '2'); // データあり
		$notExistData = array('Block.id' => '0', 'Room.id' => '0'); // データなし

		return array(
			array($existData, array('id' => '2', 'key' => 'content_block_1')), // 存在する
			array($notExistData, array('id' => '0')), // 存在しない
		);
	}

/**
 * getTask()のテスト
 *
 * @param array $exist 取得するキー情報
 * @param array $expected 期待値（取得したキー情報）
 * @dataProvider dataProviderGet
 * @return void
 */
	public function testGetTask($exist, $expected) {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$testCurrentData = Hash::expand($exist);
		Current::$current = Hash::merge(Current::$current, $testCurrentData);

		//テスト実施
		$result = $this->$model->$methodName();

		//チェック
		if ($result == null) {
			$this->assertEquals($expected['id'], '0');
		} else {
			foreach ($expected as $key => $val) {
				$this->assertEquals($result[$model][$key], $val);
			}
		}
	}

}
