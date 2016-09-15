<?php
/**
 * TaskChargeBehavior::validates()テスト用Fixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * TaskChargeBehavior::validates()テスト用Fixture
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\Fixture
 */
class TestTaskChargeBehaviorValidatesModelFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => ''),
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'user_id' => '1',
		),
		array(
			'user_id' => '2',
		),
		array(
			'user_id' => 'moji',
		),
	);

}
