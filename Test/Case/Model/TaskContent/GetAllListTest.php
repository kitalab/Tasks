<?php
/**
 * TaskContent::getAllList()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('WorkflowGetTest', 'Workflow.TestSuite');

/**
 * TaskContent::getAllList()のテスト
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TaskContent
 */
class TaskContentGetAllListTest extends WorkflowGetTest {

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
	protected $_methodName = 'getAllList';

/**
 * getAllList()のテスト
 *
 * @return void
 */
	public function testGetAllList() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$params = array();
		$order = array();

		//テスト実施
		$result = $this->$model->$methodName($params, $order);

		//チェック
		$this->assertNotEmpty($result);
	}

/**
 * getAllList()のテスト
 *
 * @return void
 */
	public function testGetAllListEmpty() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$params = array('TaskContent.id' => 0);
		$order = array();

		//テスト実施
		$result = $this->$model->$methodName($params, $order);

		//チェック
		$this->assertEmpty($result);
	}

}
