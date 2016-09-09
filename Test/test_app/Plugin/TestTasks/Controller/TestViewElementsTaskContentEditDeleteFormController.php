<?php
/**
 * View/Elements/TaskContentEdit/delete_formテスト用Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppController', 'Controller');

/**
 * View/Elements/TaskContentEdit/delete_formテスト用Controller
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\test_app\Plugin\TestTasks\Controller
 */
class TestViewElementsTaskContentEditDeleteFormController extends AppController {

/**
 * delete_form
 *
 * @return void
 */
	public function delete_form() {
		$this->autoRender = true;
	}

}
