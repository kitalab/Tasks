<?php
/**
 * TasksAppModel::validateIsSetReminderCheck()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * TasksAppModel::validateIsSetReminderCheck()のテスト
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TasksAppModel
 */
class TasksAppModelValidateIsSetReminderCheckTest extends NetCommonsModelTestCase {

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
		'plugin.mails.mail_setting_fixed_phrase',
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
	protected $_methodName = 'validateIsSetReminderCheck';

/**
 * testValidateIsSetReminderCheckのDataProvider
 *
 * ### 戻り値
 *  - check リマインダーメール作成フラグ
 *  - params Postされたパラメーター
 *
 * @return array
 */
	public function dataProviderValidateIsSetReminderCheck() {
		return array(
			array(
				'check' => array(0 => 1),
				'params' => array(
					'to' => null,
					'is_enable_mail' => 0
				)
			),
			array(
				'check' => array(0 => 2),
				'params' => array(
					'to' => date('Y/m/d H:i:s', strtotime('+10 day')),
					'is_enable_mail' => 1,
				)
			),
			array(
				'check' => array(0 => 7),
				'params' => array(
					'to' => date('Y/m/d H:i:s', strtotime('+14 day')),
					'is_enable_mail' => 1,
				)
			),
		);
	}

/**
 * ValidateIsSetReminderCheck()のTrueテスト
 * @param $check
 * @param $params
 * @dataProvider dataProviderValidateIsSetReminderCheck
 * @return void
 */
	public function testValidateIsSetReminderCheck($check, $params) {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//テスト実施
		$result = $this->$model->$methodName($check, $params);

		//チェック
		$this->assertTrue($result);
	}

/**
 * testValidateIsSetReminderCheckFalseのDataProvider
 *
 * ### 戻り値
 *  - check リマインダーメール作成フラグ
 *  - params Postされたパラメーター
 *
 * @return array
 */
	public function dataProviderValidateIsSetReminderCheckFalse() {
		return array(
			array(
				'check' => array(0 => 1),
				'params' => array(
					'to' => null,
					'is_enable_mail' => 1
				)
			),
			array(
				'check' => array(0 => 2),
				'params' => array(
					'to' => date('Y/m/d H:i:s', strtotime('+1 day')),
					'is_enable_mail' => 1,
				)
			),
			array(
				'check' => array(0 => 7),
				'params' => array(
					'to' => date('Y/m/d H:i:s', strtotime('+7 day')),
					'is_enable_mail' => 1,
				)
			),
			array(
				'check' => array(0 => 1),
				'params' => array(
					'to' => date('Y/m/d H:i:s', strtotime('-2 day')),
					'is_enable_mail' => 1,
				)
			),
		);
	}

/**
 * ValidateIsSetReminderCheck()のFalseテスト
 * @param $check
 * @param $params
 * @dataProvider dataProviderValidateIsSetReminderCheckFalse
 * @return void
 */
	public function testValidateIsSetReminderCheckFalse($check, $params) {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//テスト実施
		$result = $this->$model->$methodName($check, $params);

		//チェック
		$this->assertFalse($result);
	}
}
