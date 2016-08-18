<?php
/**
 * TaskContent::getTaskDateColor()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('WorkflowGetTest', 'Workflow.TestSuite');

/**
 * TaskContent::getTaskDateColor()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TaskContent
 */
class TaskContentGetTaskDateColorTest extends WorkflowGetTest {

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
 * Model name
 *
 * @var string
 */
	protected $_modelName = 'TaskContent';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'getTaskDateColor';

/**
 * getTaskDateColor() 現在実施中の場合のテスト1
 *
 * @return void
 */
	public function testGetTaskDateColor() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$taskContent = array(
			'is_completion' => true,
			'is_date_set' => true,
			'task_start_date' => '2016-03-17 07:10:12',
			'task_end_date' => '2016-03-17 07:10:12',
		);

		//テスト実施
		$result = $this->$model->$methodName($taskContent);

		//チェック
		$this->assertNotEmpty($result);
		$this->assertEquals(TaskContent::TASK_BEING_PERFORMED, $result);
	}

/**
 * getTaskDateColor() 現在実施中の場合のテスト2
 *
 * @return void
 */
	public function testGetTaskDateColor1() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$taskContent = array(
			'is_completion' => false,
		);

		//テスト実施
		$result = $this->$model->$methodName($taskContent);

		//チェック
		$this->assertNotEmpty($result);
		$this->assertEquals(TaskContent::TASK_BEING_PERFORMED, $result);
	}

/**
 * getTaskDateColor() 日付が開始日より後・終了期限間近の場合のテスト
 *
 * @return void
 */
	public function testGetTaskDateColor2() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$taskContent = array(
			'is_completion' => false,
			'is_date_set' => true,
			'task_start_date' => '2016-08-19 07:10:12',
			'task_end_date' => '2016-08-19 07:10:12',
		);

		//テスト実施
		$result = $this->$model->$methodName($taskContent);

		//チェック
		$this->assertNotEmpty($result);
		$this->assertEquals(TaskContent::TASK_DEADLINE_CLOSE, $result);
	}

/**
 * getTaskDateColor() 日付が開始日より前・終了期限切れの場合のテスト
 *
 * @return void
 */
	public function testGetTaskDateColor3() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$taskContent = array(
			'is_completion' => false,
			'is_date_set' => true,
			'task_start_date' => '2016-08-17 07:10:12',
			'task_end_date' => '2016-08-17 07:10:12',
		);

		//テスト実施
		$result = $this->$model->$methodName($taskContent);

		//チェック
		$this->assertNotEmpty($result);
		$this->assertEquals(TaskContent::TASK_BEYOND_THE_END_DATE, $result);
	}

/**
 * getTaskDateColor() 日付が開始日より前・終了期限に余裕がある場合のテスト
 *
 * @return void
 */
	public function testGetTaskDateColor4() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$taskContent = array(
			'is_completion' => false,
			'is_date_set' => true,
			'task_start_date' => '2017-08-17 07:10:12',
			'task_end_date' => '2017-08-17 07:10:12',
		);

		//テスト実施
		$result = $this->$model->$methodName($taskContent);

		//チェック
		$this->assertNotEmpty($result);
		$this->assertEquals(TaskContent::TASK_START_DATE_BEFORE, $result);
	}

/**
 * getTaskDateColor() Nullのテスト
 *
 * @return void
 */
	public function testGetTaskDateColorNull() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$taskContent = array(
			'is_completion' => false,
			'is_date_set' => true,
		);

		//テスト実施
		$result = $this->$model->$methodName($taskContent);

		//チェック
		$this->assertNotEmpty($result);
		$this->assertEquals(TaskContent::TASK_BEING_PERFORMED, $result);
	}

}
