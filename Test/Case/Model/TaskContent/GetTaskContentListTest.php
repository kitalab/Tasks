<?php
/**
 * TaskContent::getTaskContentList()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('WorkflowGetTest', 'Workflow.TestSuite');

/**
 * TaskContent::getTaskContentList()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TaskContent
 */
class TaskContentGetTaskContentListTest extends WorkflowGetTest {

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
	protected $_methodName = 'getTaskContentList';

/**
 * getTaskContentList()のテスト
 *
 * @return void
 */
	public function testGetTaskContentList() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$params = array();
		$order = array();

		//テスト実施
		$result = $this->$model->$methodName($params, $order);

		//チェック
		$this->assertNotNull($result);

		//データ生成
		$params = array('TaskContent.title' => 'test');
		$order = array();

		//テスト実施
		$result = $this->$model->$methodName($params, $order);

		//チェック
		$this->assertEmpty($result);
	}
}
