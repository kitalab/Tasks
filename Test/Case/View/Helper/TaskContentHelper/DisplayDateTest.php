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
		$results = array(
			array(
				'date' => date('Y/m/d H:m:s')
			),
			array(
				'date' => date('Y/m/d H:m:s', strtotime('+1 day'))
			),
			array(
				'date' => date('Y/m/d H:m:s', strtotime('-1 day'))
			),
			array(
				'date' => date('Y/m/d H:m:s', strtotime('+1 week'))
			),
			array(
				'date' => date('Y/m/d H:m:s', strtotime('-1 week'))
			),
			array(
				'date' => date('Y/m/d H:m:s', strtotime('+1 month'))
			),
			array(
				'date' => date('Y/m/d H:m:s', strtotime('-1 month'))
			),
			array(
				'date' => date('Y/m/d H:m:s', strtotime('+1 year'))
			),
			array(
				'date' => date('Y/m/d H:m:s', strtotime('-1 year'))
			)
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
		$dateYear = date('Y', strtotime($date));
		$nowYear = date('Y');

		//テスト実施
		$result = $this->TaskContent->displayDate($date, $isDateSet, $isView);

		if ($dateYear === $nowYear) {
			$this->assertEquals(date('m/d', strtotime($date)), $result);
		} else {
			$this->assertEquals(date('Y/m/d', strtotime($date)), $result);
		}
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
		$this->assertEquals(__d('tasks', 'Not Date Set'), $result);
	}

}
