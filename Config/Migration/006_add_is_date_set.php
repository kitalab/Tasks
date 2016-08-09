<?php
/**
 * 実施期間を設定するか決定する制御フラグ
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 */

/**
 * tasksにis_date_setを足すMigration
 * 
 * @package NetCommons\Tasks\Config\Migration
 */
class AddIsDateSet extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_is_date_set';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'task_contents' => array(
					'is_date_set' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'task_contents' => array('is_date_set'),
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
