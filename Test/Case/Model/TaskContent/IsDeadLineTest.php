<?php
/**
 * TaskContent::isDeadLine()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * TaskContent::isDeadLine()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TaskContent
 */
class TaskContentIsDeadLineTest extends NetCommonsModelTestCase {

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
	protected $_methodName = 'isDeadLine';

/**
 * isDeadLine() 終了期限間近の場合のテスト
 *
 * @return void
 */
	public function testIsDeadLineClose() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$dateColor = TasksComponent::TASK_DEADLINE_CLOSE;

		//テスト実施
		$result = $this->$model->$methodName($dateColor);

		//チェック
		$this->assertTrue($result);
	}

/**
 * isDeadLine() 終了期限切れの場合のテスト
 *
 * @return void
 */
	public function testIsDeadLineEnd() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$dateColor = TasksComponent::TASK_BEYOND_THE_END_DATE;

		//テスト実施
		$result = $this->$model->$methodName($dateColor);

		//チェック
		$this->assertTrue($result);
	}

/**
 * isDeadLine() 現在実施中の場合のテスト
 *
 * @return void
 */
	public function testIsDeadLinePerformed() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$dateColor = TasksComponent::TASK_BEING_PERFORMED;

		//テスト実施
		$result = $this->$model->$methodName($dateColor);

		//チェック
		$this->assertFalse($result);
	}

/**
 * isDeadLine() 現在の日付が開始日より前の場合のテスト
 *
 * @return void
 */
	public function testIsDeadLineBefore() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$dateColor = TasksComponent::TASK_START_DATE_BEFORE;

		//テスト実施
		$result = $this->$model->$methodName($dateColor);

		//チェック
		$this->assertFalse($result);
	}

/**
 * isDeadLine() Nullのテスト
 *
 * @return void
 */
	public function testIsDeadLineNull() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$dateColor = null;

		//テスト実施
		$result = $this->$model->$methodName($dateColor);

		//チェック
		$this->assertFalse($result);
	}

}
