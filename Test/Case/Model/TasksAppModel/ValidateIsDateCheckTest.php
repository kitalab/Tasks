<?php
/**
 * TasksAppModel::validateIsDateCheck()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * TasksAppModel::validateIsDateCheck()のテスト
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TasksAppModel
 */
class TasksAppModelValidateIsDateCheckTest extends NetCommonsModelTestCase {

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
	protected $_methodName = 'validateIsDateCheck';

/**
 * validateIsDateCheck()のテスト
 *
 * @return void
 */
	public function testValidateIsDateCheck() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$check = array(array());
		$params = array();

		//テスト実施
		$result = $this->$model->$methodName($check, $params);

		//チェック
		$this->assertTrue($result);

		//データ生成
		$check = array(array(true));
		$params = array('from' => '2016/01/01');

		//テスト実施
		$result = $this->$model->$methodName($check, $params);

		//チェック
		$this->assertTrue($result);

		//データ生成
		$check = array(array(true));
		$params = array('to' => '2016/01/02');

		//テスト実施
		$result = $this->$model->$methodName($check, $params);

		//チェック
		$this->assertTrue($result);
	}

/**
 * validateIsDateCheck()のテスト
 *
 * @return void
 */
	public function testValidateIsDateCheckFalse() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$check = array(array(true));
		$params = array();

		//テスト実施
		$result = $this->$model->$methodName($check, $params);

		//チェック
		$this->assertFalse($result);
	}

}
