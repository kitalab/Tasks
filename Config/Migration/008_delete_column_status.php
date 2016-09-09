<?php
/**
 * DeleteColumnStatus
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * DeleteColumnStatus
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @package NetCommons\Tasks\Config\Migration
 */
class DeleteColumnStatus extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'delete_column_status';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'drop_field' => array(
				'tasks' => array('status'),
			)
		),
		'down' => array(
			'create_field' => array(
				'tasks' => array(
					'status' => array(
						'type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false, 'comment' => 'public status, 1: public, 2: public pending, 3: draft during 4: remand | 公開状況  1:公開中、2:公開申請中、3:下書き中、4:差し戻し |  | '
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
