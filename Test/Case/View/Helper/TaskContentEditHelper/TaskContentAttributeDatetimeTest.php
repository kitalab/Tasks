<?php
/**
 * TaskContentEditHelper::taskContentAttributeDatetime()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsHelperTestCase', 'NetCommons.TestSuite');

/**
 * TaskContentEditHelper::taskContentAttributeDatetime()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\View\Helper\TaskContentEditHelper
 */
class TaskContentEditHelperTaskContentAttributeDatetimeTest extends NetCommonsHelperTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array();

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

		//テストデータ生成
		$viewVars = array();
		$requestData = array();
		$params = array();

		//Helperロード
		$this->loadHelper('Tasks.TaskContentEdit', $viewVars, $requestData, $params);
	}

/**
 * taskContentAttributeDatetime()のテスト
 *
 * @return void
 */
	public function testTaskContentAttributeDatetime() {
		//データ生成
		$fieldName = 'task_start_date';
		$options = array(
			'label' => null,
			'start' => '',
			'end' => 'TaskContent.task_end_date',
			'div' => null,
			'error' => null,
			'ng-model' => 'TaskContent.task_start_date',
			'ng-init' => "TaskContent.task_start_date = '';",
		);

		//テスト実施
		$result = $this->TaskContentEdit->taskContentAttributeDatetime($fieldName, $options);

		//チェック
		debug($result);
	}

/**
 * taskContentAttributeDatetime() Nullのテスト
 *
 * @return void
 */
	public function testTaskContentAttributeDatetimeNull() {
		//データ生成
		$fieldName = null;
		$options = null;

		//テスト実施
		$result = $this->TaskContentEdit->taskContentAttributeDatetime($fieldName, $options);

		//チェック
		debug($result);
	}

}
