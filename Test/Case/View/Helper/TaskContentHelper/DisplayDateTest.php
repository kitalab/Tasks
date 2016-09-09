<?php
/**
 * TaskContentHelper::displayDate()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsHelperTestCase', 'NetCommons.TestSuite');

/**
 * TaskContentHelper::displayDate()のテスト
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Case\View\Helper\TaskContentHelper
 */
class TaskContentHelperDisplayDateTest extends NetCommonsHelperTestCase {

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
		$this->loadHelper('Tasks.TaskContent', $viewVars, $requestData, $params);
	}

/**
 * View/Helper/TaskContentHelper/displayDateのテスト用DataProvider
 *
 * @return array
 */
	public function dataProviderDisplayDate() {
		$results = array();
		$results[0] = array(
			'date' => '2016-10-10 10:10:10'
		);
		$results[1] = array(
			'date' => '2017-10-10 10:10:10'
		);

		return $results;
	}

/**
 * displayDate()のテスト
 *
 * @param $data
 * @return void
 * @dataProvider dataProviderDisplayDate
 */
	public function testDisplayDate($data) {
		//データ生成
		$date = $data;
		$isDateSet = true;
		$isView = true;

		//テスト実施
		$result = $this->TaskContent->displayDate($date, $isDateSet, $isView);

		//チェック
		debug($result);
	}

/**
 * displayDate() Nullのテスト
 *
 * @return void
 */
	public function testDisplayDateNull() {
		//データ生成
		$date = null;
		$isDateSet = null;
		$isView = null;

		//テスト実施
		$result = $this->TaskContent->displayDate($date, $isDateSet, $isView);

		//チェック
		debug($result);
	}

}
