<?php
/**
 * TaskFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * TaskFixture
 */
class TaskFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID | | | '),
		'block_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'TASK name | TASK名称 | | ', 'charset' => 'utf8'),
		'key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'task key | ToDoキー | Hash値 | ', 'charset' => 'utf8'),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false, 'comment' => 'public status, 1: public, 2: public pending, 3: draft during 4: remand | 公開状況  1:公開中、2:公開申請中、3:下書き中、4:差し戻し |  | '),
		'public_type' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 4, 'unsigned' => false, 'comment' => '一般以下のパートが閲覧可能かどうか。（0:非公開, 1:公開, 2:期間限定公開'),
		'created_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false, 'comment' => 'created user | 作成者 | users.id | '),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'created datetime | 作成日時 | | '),
		'modified_user' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false, 'comment' => 'modified user | 更新者 | users.id | '),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'modified datetime | 更新日時 | | '),
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
		// * ルーム管理者が書いたコンテンツ＆一度公開して、下書き中
		//   (id=1とid=2で区別できるものをセットする)
		array(
			'id' => '1',
			'block_id' => '2',
			'key' => 'content_block_1',
			'status' => '1',
			'name' => 'Lorem ipsum dolor sit amet',
			'public_type' => '1',
			'created_user' => '1',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '1',
			'modified' => '2016-03-17 07:10:12',
		),
		array(
			'id' => '2',
			'block_id' => '4',
			'key' => 'content_block_1',
			'status' => '1',
			'name' => 'Lorem ipsum dolor sit amet',
			'public_type' => '1',
			'created_user' => '1',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '1',
			'modified' => '2016-03-17 07:10:12',
		),
	);

}
