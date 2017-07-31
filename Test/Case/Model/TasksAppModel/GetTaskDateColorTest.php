<?php
/**
 * TasksAppModel::getTaskDateColor()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsGetTest', 'NetCommons.TestSuite');

/**
 * TasksAppModel::getTaskDateColor()のテスト
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TasksAppModel
 */
class TasksAppModelGetTaskDateColorTest extends NetCommonsGetTest {

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
	protected $_modelName = 'TasksAppModel';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'getTaskDateColor';

/**
 * testGetTaskDateColorBeingのDataProvider
 *
 * ### 戻り値
 *  - taskStartDate 実施期間開始日
 *  - taskEndDate 実施期間終了日
 *
 * @return array
 */
	public function dataProviderGetTaskDateColorBeing() {
		return array(
			array(
				'taskStartDate' => null,
				'taskEndDate' => null,
			),
			array(
				'taskStartDate' => date('Ymd', strtotime(date('Y/m/d H:i:s'))),
				'taskEndDate' => null,
			),
			array(
				'taskStartDate' => date('Ymd', strtotime('-1 day')),
				'taskEndDate' => date('Ymd', strtotime('+3 day')),
			),
			array(
				'taskStartDate' => null,
				'taskEndDate' => date('Ymd', strtotime('+9 day')),
			),
		);
	}

/**
 * GetTaskDateColorBeing()のテスト
 * @param $taskStartDate
 * @param $taskEndDate
 * @dataProvider dataProviderGetTaskDateColorBeing
 * @return void
 */
	public function testGetTaskDateColorBeing($taskStartDate, $taskEndDate) {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//テスト実施
		$result = $this->$model->$methodName($taskStartDate, $taskEndDate);

		//チェック
		$this->assertEquals(TasksComponent::TASK_BEING_PERFORMED, $result);
	}

/**
 * testGetTaskDateColorStartDateBeforeのDataProvider
 *
 * ### 戻り値
 *  - taskStartDate 実施期間開始日
 *  - taskEndDate 実施期間終了日
 *
 * @return array
 */
	public function dataProviderGetTaskDateColorStartDateBefore() {
		return array(
			array(
				'taskStartDate' => date('Ymd', strtotime('+1 day')),
				'taskEndDate' => null,
			),
			array(
				'taskStartDate' => date('Ymd', strtotime('+1 day')),
				'taskEndDate' => date('Ymd', strtotime('+3 day')),
			),
			array(
				'taskStartDate' => date('Ymd', strtotime('+2 day')),
				'taskEndDate' => date('Ymd', strtotime('+7 day')),
			),
			array(
				'taskStartDate' => date('Ymd', strtotime('+3 day')),
				'taskEndDate' => date('Ymd', strtotime('+3 day')),
			),
		);
	}

/**
 * GetTaskDateColorStartDateBefore()のテスト
 * @param $taskStartDate
 * @param $taskEndDate
 * @dataProvider dataProviderGetTaskDateColorStartDateBefore
 * @return void
 */
	public function testGetTaskDateColorStartDateBefore($taskStartDate, $taskEndDate) {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//テスト実施
		$result = $this->$model->$methodName($taskStartDate, $taskEndDate);

		//チェック
		$this->assertEquals(TasksComponent::TASK_START_DATE_BEFORE, $result);
	}

/**
 * testGetTaskDateColorDeadlineのDataProvider
 *
 * ### 戻り値
 *  - taskStartDate 実施期間開始日
 *  - taskEndDate 実施期間終了日
 *
 * @return array
 */
	public function dataProviderGetTaskDateColorDeadline() {
		return array(
			array(
				'taskStartDate' => date('Ymd', strtotime(date('Y/m/d H:i:s'))),
				'taskEndDate' => date('Ymd', strtotime(date('Y/m/d H:i:s'))),
			),
			array(
				'taskStartDate' => null,
				'taskEndDate' => date('Ymd', strtotime('+1 day')),
			),
			array(
				'taskStartDate' => date('Ymd', strtotime('-8 day')),
				'taskEndDate' => date('Ymd', strtotime('+2 day')),
			),
			array(
				'taskStartDate' => date('Ymd', strtotime(date('Y/m/d H:i:s'))),
				'taskEndDate' => date('Ymd', strtotime('+2 day')),
			),
		);
	}

/**
 * GetTaskDateColorDeadline()のテスト
 * @param $taskStartDate
 * @param $taskEndDate
 * @dataProvider dataProviderGetTaskDateColorDeadline
 * @return void
 */
	public function testGetTaskDateColorDeadline($taskStartDate, $taskEndDate) {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//テスト実施
		$result = $this->$model->$methodName($taskStartDate, $taskEndDate);

		//チェック
		$this->assertEquals(TasksComponent::TASK_DEADLINE_CLOSE, $result);
	}

/**
 * testGetTaskDateColorBeyondTheEndDateのDataProvider
 *
 * ### 戻り値
 *  - taskStartDate 実施期間開始日
 *  - taskEndDate 実施期間終了日
 *
 * @return array
 */
	public function dataProviderGetTaskDateColorBeyondTheEndDate() {
		return array(
			array(
				'taskStartDate' => null,
				'taskEndDate' => date('Ymd', strtotime('-1 day')),
			),
			array(
				'taskStartDate' => date('Ymd', strtotime('-1 day')),
				'taskEndDate' => date('Ymd', strtotime('-1 day')),
			),
			array(
				'taskStartDate' => date('Ymd', strtotime('-2 day')),
				'taskEndDate' => date('Ymd', strtotime('-1 day')),
			),
			array(
				'taskStartDate' => date('Ymd', strtotime('-8 day')),
				'taskEndDate' => date('Ymd', strtotime('-5 day')),
			),
		);
	}

/**
 * GetTaskDateColorBeyondTheEndDate()のテスト
 * @param $taskStartDate
 * @param $taskEndDate
 * @dataProvider dataProviderGetTaskDateColorBeyondTheEndDate
 * @return void
 */
	public function testGetTaskDateColorBeyondTheEndDate($taskStartDate, $taskEndDate) {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//テスト実施
		$result = $this->$model->$methodName($taskStartDate, $taskEndDate);

		//チェック
		$this->assertEquals(TasksComponent::TASK_BEYOND_THE_END_DATE, $result);
	}
}
