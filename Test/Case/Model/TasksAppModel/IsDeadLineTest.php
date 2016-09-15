<?php
/**
 * TasksAppModel::isDeadLine()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * TasksAppModel::isDeadLine()のテスト
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TasksAppModel
 */
class TasksAppModelIsDeadLineTest extends NetCommonsModelTestCase {

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
	protected $_modelName = 'TasksAppModel';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'isDeadLine';

/**
 * isDeadLine()のテスト
 *
 * @return void
 */
	public function testIsDeadLine() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$dateColor = TasksComponent::TASK_DEADLINE_CLOSE;

		//テスト実施
		$result = $this->$model->$methodName($dateColor);

		//チェック
		$this->assertTrue($result);

		//データ生成
		$dateColor = TasksComponent::TASK_BEYOND_THE_END_DATE;

		//テスト実施
		$result = $this->$model->$methodName($dateColor);

		//チェック
		$this->assertTrue($result);
	}

/**
 * IsDeadLineFalse()のテスト
 *
 * @return void
 */
	public function testIsDeadLineFalse() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$dateColor = TasksComponent::TASK_BEING_PERFORMED;

		//テスト実施
		$result = $this->$model->$methodName($dateColor);

		//チェック
		$this->assertFalse($result);

		//データ生成
		$dateColor = TasksComponent::TASK_START_DATE_BEFORE;

		//テスト実施
		$result = $this->$model->$methodName($dateColor);

		//チェック
		$this->assertFalse($result);
	}

}
