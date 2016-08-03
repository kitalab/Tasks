<?php
/**
 * TaskSettingFixture
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
class TaskSettingFixture extends BlockSettingFixture {

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
	);

}
