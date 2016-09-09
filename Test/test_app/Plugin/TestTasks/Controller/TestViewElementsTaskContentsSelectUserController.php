<?php
/**
 * View/Elements/TaskContents/select_userテスト用Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppController', 'Controller');

/**
 * View/Elements/TaskContents/select_userテスト用Controller
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\test_app\Plugin\TestTasks\Controller
 */
class TestViewElementsTaskContentsSelectUserController extends AppController {

/**
 * select_user
 *
 * @return void
 */
	public function select_user() {
		$this->autoRender = true;
	}

}
