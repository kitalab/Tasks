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

/**
 * Initialize the fixture.
 *
 * @return void
 */
	public function init() {
		require_once App::pluginPath('Tasks') . 'Config' . DS . 'Schema' . DS . 'schema.php';
		$this->fields = (new TasksSchema())->tables[Inflector::tableize($this->name)];
		parent::init();
	}

}
