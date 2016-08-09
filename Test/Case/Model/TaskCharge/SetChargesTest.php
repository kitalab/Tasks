<?php
/**
 * TaskCharge::setCharges()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * TaskCharge::setCharges()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TaskCharge
 */
class TaskChargeSetChargesTest extends NetCommonsModelTestCase {

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
	protected $_modelName = 'TaskCharge';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'setCharges';

/**
 * テストデータ
 *
 * @return array
 */
	private function __data() {
		//データ生成
		return array(
			0 => array('TaskCharge' => array(
				'user_id' => '1',
				'task_content_id' => '1',
			)),
			1 => array('TaskCharge' => array(
				'user_id' => '1',
				'task_content_id' => '2',
			)),
			2 => array('TaskCharge' => array(
				'user_id' => '1',
				'task_content_id' => '3',
			)),
			3 => array('TaskCharge' => array(
				'user_id' => '1',
				'task_content_id' => '4',
			)),
		);
	}

/**
 * setCharges()のテスト
 *
 * @return void
 */
	public function testSetCharges() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$data['TaskCharges'] = $this->__data();
		// $contentIdの値設定
		$data['TaskContent']['id'] = 1;

		//テスト実施
		$result = $this->$model->$methodName($data);

		//チェック
		$this->assertTrue($result);
	}

/**
 * データ一括削除 例外テスト
 *
 * @return void
 */
	public function testDeleteAllException() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$this->setExpectedException('InternalErrorException');

		//データ生成
		$data['TaskCharges'] = $this->__data();
		// $contentIdの値設定
		$data['TaskContent']['id'] = 4;

		// 例外を発生させるためのモック
		$choicesMock = $this->getMockForModel('Tasks.' . $model, ['deleteAll']);
		$choicesMock->expects($this->any())
			->method('deleteAll')
			->will($this->returnValue(false));

		$result = $choicesMock->$methodName($data);

		//チェック
		$this->assertInstanceOf('InternalErrorException', $result);
	}

/**
 * validateTaskCharge() falseのテスト
 *
 * @return void
 */
	public function testValidateTaskChargeFalse() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$data['TaskCharges'] = $this->__data();
		// $contentIdの値設定
		$data['TaskContent']['id'] = 4;

		// falseを発生させるためのモック
		$choicesMock = $this->getMockForModel('Tasks.' . $model, ['validateTaskCharge']);
		$choicesMock->expects($this->any())
			->method('validateTaskCharge')
			->will($this->returnValue(false));
		$result = $choicesMock->$methodName($data);

		//チェック
		$this->assertFalse($result);
	}

/**
 * データ保存 例外テスト
 *
 * @return void
 */
	public function testSaveException() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$this->setExpectedException('InternalErrorException');

		//データ生成
		$data['TaskCharges'] = $this->__data();
		// $contentIdの値設定
		$data['TaskContent']['id'] = 4;

		// 例外を発生させるためのモック
		$choicesMock = $this->getMockForModel('Tasks.' . $model, ['save']);
		$choicesMock->expects($this->any())
			->method('save')
			->will($this->returnValue(false));

		$result = $choicesMock->$methodName($data);

		//チェック
		$this->assertInstanceOf('InternalErrorException', $result);
	}

}
