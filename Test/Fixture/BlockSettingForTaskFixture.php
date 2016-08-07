<?php
/**
 * BlockSettingForTaskFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('BlockSettingFixture', 'Blocks.Test/Fixture');

/**
 * TaskFixture
 */
class BlockSettingForTaskFixture extends BlockSettingFixture {

/**
 * Plugin key
 *
 * @var string
 */
	public $pluginKey = 'tasks';

/**
 * Model name
 *
 * @var string
 */
	public $name = 'BlockSetting';

/**
 * Full Table Name
 *
 * @var string
 */
	public $table = 'block_settings';

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'plugin_key' => 'tasks',
			'room_id' => null,
			'block_key' => null,
			'field_name' => BlockSettingBehavior::FIELD_USE_COMMENT,
			'value' => '1',
			'type' => BlockSettingBehavior::TYPE_BOOLEAN,
		),
		// use_workflow, use_comment_approvalの初期値は、rooms.need_approvalによって値決まる。
		// BlockSettingでデフォルト値（room_id=null, block_key=nullの値）設定しても無視される。
		array(
			'plugin_key' => 'tasks',
			'room_id' => null,
			'block_key' => null,
			'field_name' => BlockSettingBehavior::FIELD_USE_WORKFLOW,
			'value' => '0',
			'type' => BlockSettingBehavior::TYPE_NUMERIC,
		),
		array(
			'plugin_key' => 'tasks',
			'room_id' => null,
			'block_key' => null,
			'field_name' => BlockSettingBehavior::FIELD_USE_COMMENT_APPROVAL,
			'value' => '0',
			'type' => BlockSettingBehavior::TYPE_NUMERIC,
		),
		// ブロック設定後 - room_idあり、block_keyあり
		array(
			'plugin_key' => 'tasks',
			'room_id' => 1,
			'block_key' => 'block_1',
			'field_name' => BlockSettingBehavior::FIELD_USE_COMMENT,
			'value' => '1',
			'type' => BlockSettingBehavior::TYPE_BOOLEAN,
		),
		array(
			'plugin_key' => 'tasks',
			'room_id' => 1,
			'block_key' => 'block_1',
			'field_name' => BlockSettingBehavior::FIELD_USE_WORKFLOW,
			'value' => '0',
			'type' => BlockSettingBehavior::TYPE_NUMERIC,
		),
		array(
			'plugin_key' => 'tasks',
			'room_id' => 1,
			'block_key' => 'block_1',
			'field_name' => BlockSettingBehavior::FIELD_USE_COMMENT_APPROVAL,
			'value' => '1',
			'type' => BlockSettingBehavior::TYPE_NUMERIC,
		),
		// イレギュラーデータ - room_idあり、block_keyあり、USE_WORKFLOW, USE_COMMENT_APPROVALのデータなし
		array(
			'plugin_key' => 'tasks',
			'room_id' => 2,
			'block_key' => 'block_2',
			'field_name' => BlockSettingBehavior::FIELD_USE_COMMENT,
			'value' => '1',
			'type' => BlockSettingBehavior::TYPE_BOOLEAN,
		),
	);

}
