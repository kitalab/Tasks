<?php
/**
 * CalendarFixture
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author AllCreator <info@allcreator.net>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('CalendarFixture', 'Calendars.Test/Fixture');

/**
 * Summary for CalendarFixture
 */
class CalendarForTaskFixture extends CalendarFixture {
	/**
	 * Plugin key
	 *
	 * @var string
	 */
	public $pluginKey = 'calendars';

	/**
	 * Model name
	 *
	 * @var string
	 */
	public $name = 'Calendars';

	/**
	 * Full Table Name
	 *
	 * @var string
	 */
	public $table = 'calendars';
	
/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'block_key' => 'block_1',
			//'use_workflow' => 1,
			'created_user' => 1,
			'created' => '2016-03-24 07:10:30',
			'modified_user' => 1,
			'modified' => '2016-03-24 07:10:30'
		),
		array(
			'id' => 2,
			'block_key' => 'block_1',
			//'use_workflow' => 1,
			'created_user' => 1,
			'created' => '2016-03-24 07:10:30',
			'modified_user' => 1,
			'modified' => '2016-03-24 07:10:30'
		),
	);
}
