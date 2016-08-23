<?php
/**
 * TaskCharge::searchChargeUser()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * TaskCharge::searchChargeUser()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TaskCharge
 */
class TaskChargeSearchChargeUserTest extends NetCommonsModelTestCase {

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
		'plugin.user_roles.user_role_setting',
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
	protected $_modelName = 'TaskCharge';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'searchChargeUser';

/**
 * searchChargeUser()のテスト
 *
 * @return void
 */
	public function testSearchChargeUser() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$userId = 1;

		//テスト実施
		$result = $this->$model->$methodName($userId);

		//チェック
		$this->assertTrue($result);
	}
	
/**
 * searchChargeUser() Nullのテスト
 *
 * @return void
 */
	public function testSearchChargeUserNull() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$userId = null;

		//テスト実施
		$result = $this->$model->$methodName($userId);

		//チェック
		$this->assertFalse($result);
	}

}
