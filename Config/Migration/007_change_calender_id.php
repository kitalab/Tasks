<?php
/**
 * task_contentsのcalendar_idをcalendar_keyを変更するMigration
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kitatsuji.Yuto <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * task_contentsのcalendar_idをcalendar_keyを変更するMigration
 *
 * @package NetCommons\Tasks\Config\Migration
 */
class ChangeCalenderId extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'change_calendar_id';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'drop_field' => array(
				'task_contents' => array(
					'calendar_id'
				)
			),
			'create_field' => array(
				'task_contents' => array(
					'calendar_key' => array(
						'type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Calender key | CONTENTキー | Hash値 | ', 'charset' => 'utf8'
					)
				)
			)
		),
		'down' => array(
			'drop_field' => array(
				'task_contents' => array('calendar_key'),
			),
			'create_field' => array(
				'task_contents' => array(
					'calendar_id' => array(
						'type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => 'calendar id | カレンダーID | calendar.id | '
					)
				)
			)
		)
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
