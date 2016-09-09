<?php
/**
 * TaskContent::getCategoryContentList()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('WorkflowGetTest', 'Workflow.TestSuite');

/**
 * TaskContent::getCategoryContentList()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\Model\TaskContent
 */
class TaskContentGetCategoryContentListTest extends WorkflowGetTest {

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
	protected $_methodName = 'getCategoryContentList';

/**
 * getCategoryContentList()のテスト
 *
 * @return void
 */
	public function testGetCategoryContentList() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$categoryArr = array(
			0 => array(
				'id' => 2
			)
		);
		$contentLists = array(
			0 => array(
				'TaskContent' => array(
					'category_id' => 2,
					'id' => 2,
					'is_completion' => 1,
				)
			)
		);
		$categoryData = array(
			2 => array(
				'category_id' => 1,
				'progress_rate' => 0,
				'id' => 1,
				'cnt' => 1,
				'sum' => 0,
			)
		);

		//テスト実施
		$result = $this->$model->$methodName($categoryArr, $contentLists, $categoryData);

		//チェック
		$this->assertNotEmpty($result);
		$this->assertArrayNotHasKey('name', $result[0]['Category']);
	}

/**
 * getCategoryContentList() 指定のカテゴリIDが0の場合のテスト
 *
 * @return void
 */
	public function testGetCategoryContentListCategoryEmpty() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$categoryArr = array(
			0 => array(
				'id' => 0
			)
		);
		$contentLists = array();
		$categoryData = array();

		//テスト実施
		$result = $this->$model->$methodName($categoryArr, $contentLists, $categoryData);

		//チェック
		$this->assertNotEmpty($result);
		$this->assertEquals(__d('tasks', 'No category'), $result[0]['Category']['name']);
	}

/**
 * getCategoryContentList() Nullのテスト
 *
 * @return void
 */
	public function testGetCategoryContentListNull() {
		$model = $this->_modelName;
		$methodName = $this->_methodName;

		//データ生成
		$categoryArr = array();
		$contentLists = null;
		$categoryData = array();

		//テスト実施
		$result = $this->$model->$methodName($categoryArr, $contentLists, $categoryData);

		//チェック
		$this->assertEmpty($result);
	}

}
