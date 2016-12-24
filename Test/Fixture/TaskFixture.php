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
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '2',
			'block_id' => '2',
			'key' => 'content_block_1',
			'name' => 'Lorem ipsum dolor sit amet',
			'public_type' => '1',
			'created_user' => '1',
			'created' => '2016-03-17 07:10:12',
			'modified_user' => '1',
			'modified' => '2016-03-17 07:10:12',
		),
		array(
			'id' => '4',
			'block_id' => '4',
			'key' => 'content_block_2',
			'name' => 'Lorem ipsum dolor sit amet',
			'public_type' => '1',
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
