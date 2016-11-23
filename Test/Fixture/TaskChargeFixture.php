<?php
/**
 * TaskChargeFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * TaskChargeFixture
 */
class TaskChargeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID'),
		'task_content_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => 'タスクID'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => '作成者'),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false, 'comment' => '作成者'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '作成日時'),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false, 'comment' => '更新者'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => '更新日時'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'task_content_id' => '1',
			'user_id' => '1',
			'created_user' => '1',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '1',
			'modified' => '2016-03-17 07:10:12',
		),
		array(
			'id' => '2',
			'task_content_id' => '2',
			'user_id' => '2',
			'created_user' => '2',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '2',
			'modified' => '2016-03-17 07:10:12',
		),
		array(
			'id' => '3',
			'task_content_id' => '1',
			'user_id' => '2',
			'created_user' => '1',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '1',
			'modified' => '2016-03-17 07:10:12',
		),
		array(
			'id' => '4',
			'task_content_id' => '1',
			'user_id' => '3',
			'created_user' => '1',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '1',
			'modified' => '2016-03-17 07:10:12',
		),
		array(
			'id' => '5',
			'task_content_id' => '1',
			'user_id' => '4',
			'created_user' => '1',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '1',
			'modified' => '2016-03-17 07:10:12',
		),
		array(
			'id' => '6',
			'task_content_id' => '1',
			'user_id' => '5',
			'created_user' => '1',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '1',
			'modified' => '2016-03-17 07:10:12',
		),
		array(
			'id' => '7',
			'task_content_id' => '1',
			'user_id' => '6',
			'created_user' => '1',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '1',
			'modified' => '2016-03-17 07:10:12',
		),
		array(
			'id' => '8',
			'task_content_id' => '9',
			'user_id' => '7',
			'created_user' => '1',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '1',
			'modified' => '2016-03-17 07:10:12',
		),
	);

}
