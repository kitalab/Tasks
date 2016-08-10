<?php
/**
 * TasksAppModel::validateDatetimeFromTo()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * TasksAppModel::validateDatetimeFromTo()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TasksAppModel
 */
class TasksAppModelValidateDatetimeFromToTest extends NetCommonsModelTestCase {

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
	protected $_methodName = 'validateDatetimeFromTo';

/**
 * validateDatetimeFromTo()のテスト1
 *
 * @return void
 */
	public function testValidateDatetimeFromTo1() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$check = array(
			'reply_deadline' => '2016-03-24 00:01'
		);
		$params = array(
			'from' => '2016-03-23 00:00',
			'to' => '2016-03-24 00:00'
		);

		//テスト実施
		$result = $this->$model->$methodName($check, $params);

		//チェック
		$this->assertTrue($result);
	}

/**
 * validateDatetimeFromTo()のテスト2
 *
 * @return void
 */
	public function testValidateDatetimeFromTo2() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$check = array(
			'reply_deadline' => '2016-03-24 00:00'
		);
		$params = array(
			//'from' => '2016-03-23 00:00',
			'to' => '2016-03-24 00:00'
		);

		//テスト実施
		$result = $this->$model->$methodName($check, $params);

		//チェック
		$this->assertTrue($result);
	}

/**
 * validateDatetimeFromTo()のfalseテスト1
 *
 * @return void
 */
	public function testValidateDatetimeFromToFalse1() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$check = array(
			'reply_deadline' => '2016-03-22 23:59'
		);
		$params = array(
			'from' => '2016-03-23 00:00',
			'to' => '2016-03-24 00:00'
		);

		//テスト実施
		$result = $this->$model->$methodName($check, $params);

		//チェック
		$this->assertFalse($result);
	}

/**
 * validateDatetimeFromTo()のfalseテスト2
 *
 * @return void
 */
	public function testValidateDatetimeFromToFalse2() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$check = array(
			'reply_deadline' => '2016-03-24 00:01'
		);
		$params = array(
			//'from' => '2016-03-23 00:00',
			'to' => '2016-03-24 00:00'
		);

		//テスト実施
		$result = $this->$model->$methodName($check, $params);

		//チェック
		$this->assertFalse($result);
	}
}
