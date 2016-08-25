<?php
/**
 * Task::updateCategoryId()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsModelTestCase', 'NetCommons.TestSuite');

/**
 * Task::updateCategoryId()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\Task
 */
class TaskUpdateCategoryIdTest extends NetCommonsModelTestCase {

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
	protected $_modelName = 'Task';

/**
 * Method name
 *
 * @var string
 */
	protected $_methodName = 'updateCategoryId';

/**
 * updateCategoryId()のテスト
 *
 * @return void
 */
	public function testUpdateCategoryId() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$categoryId = null;

		//テスト実施
		$result = $this->$model->$methodName($categoryId);

		//チェック
		$this->assertTrue($result);
	}

/**
 * updateCategoryId()のテスト
 *
 * @return void
 */
	public function testUpdateCategoryIdFalse() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$categoryId = null;

		//テスト実施
		$this->_mockForReturnFalse($model, 'TaskContent', 'updateAll');
		$this->setExpectedException('InternalErrorException');

		//テスト実施
		$this->$model->$methodName($categoryId);
	}

}
