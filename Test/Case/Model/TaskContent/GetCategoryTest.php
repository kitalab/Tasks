<?php
/**
 * TaskContent::getCategory()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('WorkflowGetTest', 'Workflow.TestSuite');

/**
 * TaskContent::getCategory()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TaskContent
 */
class TaskContentGetCategoryTest extends WorkflowGetTest {

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
	protected $_methodName = 'getCategory';

/**
 * getCategory()のテスト
 *
 * @return void
 */
	public function testGetCategory() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$contentLists = array(
			0 => array(
				'Category' => Array(
					'id' => 2,
				),
				'CategoryOrder' => array(
					'id' => 2,
					'weight' => 2,
				),
			)
		);

		//テスト実施
		$result = $this->$model->$methodName($contentLists);

		//チェック
		$this->assertArrayNotHasKey('name', $result);
	}

/**
 * getCategory() CategoryOrderがNullの場合のテスト
 *
 * @return void
 */
	public function testGetCategoryOrderNull() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$contentLists = array(
			0 => array(
				'Category' => Array(
					'id' => 2,
				),
			)
		);

		//テスト実施
		$result = $this->$model->$methodName($contentLists);

		//チェック
		$this->assertArrayNotHasKey('name', $result);
	}

/**
 * getCategory() IDがNullの場合のテスト
 *
 * @return void
 */
	public function testGetCategoryIdNull() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$contentLists = array(
			0 => array(
				'Category' => Array(
					'id' => null,
				)
			)
		);

		//テスト実施
		$result = $this->$model->$methodName($contentLists);

		//チェック
		$this->assertArrayHasKey('name', $result[0]);
		$this->assertContains(__d('tasks', 'No category'), $result[0]['name']);
	}

}
