<?php
/**
 * TaskContentFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * TaskContentFixture
 */
class TaskContentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary', 'comment' => 'ID |  |  | '),
		'task_key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'block_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => 'category id | カテゴリーID | Task_categories.id | '),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false, 'comment' => 'public status, 1: public, 2: public pending, 3: draft during 4: remand | 公開状況  1:公開中、2:公開申請中、3:下書き中、4:差し戻し |  | '),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'is_latest' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'language_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'title | タイトル |  | ', 'charset' => 'utf8'),
		'content' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'content | 内容', 'charset' => 'utf8'),
		'priority' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4, 'unsigned' => false, 'comment' => 'priority | 重要度 0:未設定、1:低、2:中、3:高'),
		'task_start_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'task_end_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'is_date_set' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'is_enable_mail' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'email_send_timing' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 11, 'unsigned' => false),
		'use_calendar' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'calendar_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'comment' => 'calendar id | カレンダーID | calendar.id | '),
		'is_completion' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'progress_rate' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 11, 'unsigned' => false),
		'key' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'key | content key | Hash値 | ', 'charset' => 'utf8'),
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
			'key' => 'content_key_1',
			'language_id' => '2',
			'status' => '1',
			'is_active' => true, // @see TaskContentYetPublishTest
			'is_latest' => false,

			'task_key' => 'Lorem ipsum dolor sit amet',
			'category_id' => '',
			'title' => 'Title 1',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'priority' => '1',
			'task_start_date' => '2016-03-17 07:10:12',
			'task_end_date' => '2016-03-17 07:10:12',
			'is_date_set' => true,
			'is_enable_mail' => true,
			'email_send_timing' => '12345678901',
			'use_calendar' => true,
			'calendar_id' => '1',
			'is_completion' => false,
			'progress_rate' => '50',
			'created_user' => '1',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '1',
			'modified' => '2016-03-17 07:10:12',
		),
		array(
			'id' => '2',
			'block_id' => '2',
			'key' => 'content_key_1',
			'language_id' => '2',
			'status' => '3',
			'is_active' => false,
			'is_latest' => true,

			'task_key' => 'Lorem ipsum dolor sit amet',
			'category_id' => '2',
			'title' => 'Title 2',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'priority' => '1',
			'task_start_date' => '2016-03-17 07:10:12',
			'task_end_date' => '2016-03-17 07:10:12',
			'is_date_set' => true,
			'is_enable_mail' => true,
			'email_send_timing' => '12345678901',
			'use_calendar' => true,
			'calendar_id' => '1',
			'is_completion' => true,
			'progress_rate' => '100',
			'created_user' => '1',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '2',
			'modified' => '2016-03-17 07:10:12',
		),
		// * 一般が書いたコンテンツ＆一度も公開していない（承認待ち）
		array(
			'id' => '3',
			'block_id' => '2',
			'key' => 'content_key_2',
			'language_id' => '2',
			'status' => '2',
			'is_active' => false,
			'is_latest' => true,

			'task_key' => 'Lorem ipsum dolor sit amet',
			'category_id' => '3',
			'title' => 'Title 3',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'priority' => '1111',
			'task_start_date' => '2016-03-17 07:10:12',
			'task_end_date' => '2016-03-17 07:10:12',
			'is_date_set' => true,
			'is_enable_mail' => true,
			'email_send_timing' => '12345678901',
			'use_calendar' => true,
			'calendar_id' => '1',
			'is_completion' => true,
			'progress_rate' => '100',
			'created_user' => '4',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '3',
			'modified' => '2016-03-17 07:10:12',
		),
		// * 一般が書いたコンテンツ＆公開して、一時保存
		//   (id=4とid=5で区別できるものをセットする)
		array(
			'id' => '4',
			'block_id' => '2',
			'key' => 'content_key_3',
			'language_id' => '2',
			'status' => '1',
			'is_active' => true, // @see TaskContentYetPublishTest
			'is_latest' => false,

			'task_key' => 'Lorem ipsum dolor sit amet',
			'category_id' => '4',
			'title' => 'Title 4',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'priority' => '2',
			'task_start_date' => '2016-03-17 07:10:12',
			'task_end_date' => '2016-03-17 07:10:12',
			'is_date_set' => true,
			'is_enable_mail' => true,
			'email_send_timing' => '12345678901',
			'use_calendar' => true,
			'calendar_id' => '1',
			'is_completion' => true,
			'progress_rate' => '100',
			'created_user' => '4',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '4',
			'modified' => '2016-03-17 07:10:12',
		),
		array(
			'id' => '5',
			'block_id' => '2',
			'key' => 'content_key_3',
			'language_id' => '2',
			'status' => '3',
			'is_active' => false,
			'is_latest' => true,

			'task_key' => 'Lorem ipsum dolor sit amet',
			'category_id' => '5',
			'title' => 'Title 5',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'priority' => '2',
			'task_start_date' => '2016-03-17 07:10:12',
			'task_end_date' => '2016-03-17 07:10:12',
			'is_date_set' => true,
			'is_enable_mail' => true,
			'email_send_timing' => '12345678901',
			'use_calendar' => true,
			'calendar_id' => '1',
			'is_completion' => true,
			'progress_rate' => '100',
			'created_user' => '4',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '5',
			'modified' => '2016-03-17 07:10:12',
		),
		// * 編集者が書いたコンテンツ＆一度公開して、差し戻し
		//   (id=6とid=7で区別できるものをセットする)
		array(
			'id' => '6',
			'block_id' => '2',
			'key' => 'content_key_4',
			'language_id' => '2',
			'status' => '1',
			'is_active' => true,
			'is_latest' => false,

			'task_key' => 'Lorem ipsum dolor sit amet',
			'category_id' => '1',
			'title' => 'Title 6',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'priority' => '3',
			'task_start_date' => '2016-03-17 07:10:12',
			'task_end_date' => '2016-03-17 07:10:12',
			'is_date_set' => true,
			'is_enable_mail' => true,
			'email_send_timing' => '12345678901',
			'use_calendar' => true,
			'calendar_id' => '1',
			'is_completion' => true,
			'progress_rate' => '100',
			'created_user' => '3',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '6',
			'modified' => '2016-03-17 07:10:12',
		),
		array(
			'id' => '7',
			'block_id' => '2',
			'key' => 'content_key_4',
			'language_id' => '2',
			'status' => '4',
			'is_active' => false,
			'is_latest' => true,

			'task_key' => 'Lorem ipsum dolor sit amet',
			'category_id' => '7',
			'title' => 'Title 7',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'priority' => '3',
			'task_start_date' => '2016-03-17 07:10:12',
			'task_end_date' => '2016-03-17 07:10:12',
			'is_date_set' => true,
			'is_enable_mail' => true,
			'email_send_timing' => '12345678901',
			'use_calendar' => true,
			'calendar_id' => '1',
			'is_completion' => true,
			'progress_rate' => '100',
			'created_user' => '3',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '7',
			'modified' => '2016-03-17 07:10:12',
		),
		array(
			'id' => '8',
			'block_id' => '2',
			'key' => 'content_key_5',
			'language_id' => '2',
			'status' => '3',
			'is_active' => false,
			'is_latest' => true,

			'task_key' => 'Lorem ipsum dolor sit amet',
			'category_id' => '8',
			'title' => 'Title 8',
			'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'priority' => '1111',
			'task_start_date' => '2016-03-17 07:10:12',
			'task_end_date' => '2016-03-17 07:10:12',
			'is_date_set' => true,
			'is_enable_mail' => true,
			'email_send_timing' => '12345678901',
			'use_calendar' => true,
			'calendar_id' => '1',
			'is_completion' => true,
			'progress_rate' => '100',
			'created_user' => '2',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '8',
			'modified' => '2016-03-17 07:10:12',
		),
	);

}
