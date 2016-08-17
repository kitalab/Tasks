<?php
/**
 * TaskContent::getTask()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('WorkflowGetTest', 'Workflow.TestSuite');

/**
 * TaskContent::getTask()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TaskContent
 */
class TaskContentGetTaskTest extends WorkflowGetTest {

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
	protected $_methodName = 'getTask';

/**
 * getTask()のテスト
 *
 * @return void
 */
	public function testGetTask() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$key = (new TaskContentFixture())->records[0];

		//テスト実施
		$result = $this->$model->$methodName($key);

		//チェック
		$this->assertNotEmpty($result);
	}

/**
 * getTask() Nullのテスト
 *
 * @return void
 */
	public function testGetTaskNull() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$key = null;

		//テスト実施
		$result = $this->$model->$methodName($key);

		//チェック
		$this->assertEmpty($result);
	}

}
