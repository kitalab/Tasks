<?php
/**
 * TaskContent::getList()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('WorkflowGetTest', 'Workflow.TestSuite');

/**
 * TaskContent::getList()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TaskContent
 */
class TaskContentGetListTest extends WorkflowGetTest {

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
	protected $_methodName = 'getList';

/**
 * getList()のテスト
 *
 * @return void
 */
	public function testGetList() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$lists = array();
		$conditions = array();

		//テスト実施
		$result = $this->$model->$methodName($lists, $conditions);

		//チェック
		$this->assertEmpty($result);
	}

/**
 * getList()のテスト
 *
 * @return void
 */
	public function testGetListNull() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$lists = array(
			0 => array(
				'TaskContent.is_completion' => 0,
			),
		);
		$conditions = array(
			'TaskContent.progress_rate' => 'asc',
			'TaskContent.task_end_date' => 'asc',
			'TaskContent.priority' => 'desc',
			'TaskContent.modified' => 'desc',
		);

		//テスト実施
		$result = $this->$model->$methodName($lists, $conditions);

		//チェック
		$this->assertEmpty($result);
	}

}
