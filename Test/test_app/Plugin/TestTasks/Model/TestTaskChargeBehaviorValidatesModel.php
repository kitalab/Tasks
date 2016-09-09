<?php
/**
 * TaskChargeBehavior::validates()テスト用Model
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppModel', 'Model');

/**
 * TaskChargeBehavior::validates()テスト用Model
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\test_app\Plugin\TestTasks\Model
 */
class TestTaskChargeBehaviorValidatesModel extends AppModel {

/**
 * 使用ビヘイビア
 *
 * @var array
 */
	public $actsAs = array(
		'Tasks.TaskCharge'
	);

}
