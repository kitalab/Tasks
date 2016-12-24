<?php
/**
 * 多言語化対応
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsMigration', 'NetCommons.Config/Migration');

/**
 * 多言語化対応
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Tasks\Config\Migration
 */
class AddFieldsForM17n extends NetCommonsMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_fields_for_m17n';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'task_contents' => array(
					'is_origin' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => 'オリジナルかどうか', 'after' => 'language_id'),
					'is_translation' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '翻訳したかどうか', 'after' => 'is_origin'),
				),
				'tasks' => array(
					'language_id' => array('type' => 'integer', 'null' => false, 'default' => '2', 'length' => 6, 'unsigned' => false, 'after' => 'block_id'),
					'is_origin' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'comment' => 'オリジナルかどうか', 'after' => 'language_id'),
					'is_translation' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '翻訳したかどうか', 'after' => 'is_origin'),
				),
			),
			'alter_field' => array(
				'task_contents' => array(
					'email_send_timing' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
					'progress_rate' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'task_contents' => array('is_origin', 'is_translation'),
				'tasks' => array('language_id', 'is_origin'),
			),
			'alter_field' => array(
				'task_contents' => array(
					'email_send_timing' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 11, 'unsigned' => false),
					'progress_rate' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 11, 'unsigned' => false),
				),
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
