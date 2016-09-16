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
 * getTaskDateColor() 終了期限間近の場合のテスト
 *
 * @return void
 */
	public function testGetTaskDateColor2() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		//データ生成
		$taskContent = array(
			'task_start_date' => '2016-08-19 07:10:12',
			'task_end_date' => date('Ymd', strtotime('+2 day')),
		);

		//テスト実施
		$result = $this->$model->$methodName($taskContent['task_start_date'], $taskContent['task_end_date']);

		//チェック
		$this->assertNotEmpty($result);
		$this->assertEquals(TasksComponent::TASK_DEADLINE_CLOSE, $result);
	}

/**
 * getTaskDateColor() 終了期限切れの場合のテスト
 *
 * @return void
 */
	public function testGetTaskDateColor3() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$taskContent = array(
			'task_start_date' => '2016-08-15 07:10:12',
			'task_end_date' => '2016-08-17 07:10:12',
		);

		//テスト実施
		$result = $this->$model->$methodName($taskContent['task_start_date'], $taskContent['task_end_date']);

		//チェック
		$this->assertNotEmpty($result);
		$this->assertEquals(TasksComponent::TASK_BEYOND_THE_END_DATE, $result);
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
			'task_start_date' => date('Ymd', strtotime('+1 day')),
			'task_end_date' => date('Ymd', strtotime('+1 month')),
		);

		//テスト実施
		$result = $this->$model->$methodName($taskContent['task_start_date'], $taskContent['task_end_date']);

		//チェック
		$this->assertNotEmpty($result);
		$this->assertEquals(TasksComponent::TASK_START_DATE_BEFORE, $result);
	}

}
