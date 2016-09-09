<?php
/**
 * TaskChargeBehavior::validates()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');
App::uses('TestTaskChargeBehaviorValidatesModelFixture', 'Tasks.Test/Fixture');

/**
 * TaskChargeBehavior::validates()のテスト
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\Behavior\TaskChargeBehavior
 */
class TaskChargeBehaviorValidatesTest extends NetCommonsModelTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.tasks.test_task_charge_behavior_validates_model',
	);

/**
 * Plugin name
 *
 * @var string
 */
	public $plugin = 'tasks';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//テストプラグインのロード
		NetCommonsCakeTestCase::loadTestPlugin($this, 'Tasks', 'TestTasks');
		$this->TestModel = ClassRegistry::init('TestTasks.TestTaskChargeBehaviorValidatesModel');
	}

/**
 * validates()のテスト
 *
 * @return void
 */
	public function testValidates() {
		//テストデータ
		$data = array(
			'TestTaskChargeBehaviorValidatesModel' => (new TestTaskChargeBehaviorValidatesModelFixture())->records[0],
		);

		//テスト実施
		$this->TestModel->set($data);
		$result = $this->TestModel->validates();

		//チェック
		$this->assertTrue($result);
	}

}
