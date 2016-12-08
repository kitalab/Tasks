<?php
/**
 * TasksAppModel::setSendMail()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * TasksAppModel::setSendMail()のテスト
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto>
 * @package NetCommons\Tasks\Test\Case\Model\TasksAppModel
 */
class TasksAppModelIsReminderTest extends NetCommonsModelTestCase {

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
		'plugin.categories.category',
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
	protected $_methodName = 'isReminder';

/**
 * isReminder()のテスト
 *
 * @return void
 */
	public function testIsReminder() {
		$methodName = $this->_methodName;

		$model = $this->_modelName;
		//データ生成
		$reminder1 = false;
		$makeReminder1 = false;

		//テスト実施
		$result1 = $this->$model->$methodName($reminder1, $makeReminder1);

		//チェック
		$this->assertFalse($result1);

		//データ生成
		$reminder2 = false;
		$makeReminder2 = true;

		//テスト実施
		$result2 = $this->$model->$methodName($reminder2, $makeReminder2);

		//チェック
		$this->assertFalse($result2);

		//データ生成
		$reminder3 = true;
		$makeReminder3 = true;

		//テスト実施
		$result3 = $this->$model->$methodName($reminder3, $makeReminder3);

		//チェック
		$this->assertFalse($result3);

		//データ生成
		$reminder4 = true;
		$makeReminder4 = false;

		//テスト実施
		$result4 = $this->$model->$methodName($reminder4, $makeReminder4);

		//チェック
		$this->assertTrue($result4);
	}

}
