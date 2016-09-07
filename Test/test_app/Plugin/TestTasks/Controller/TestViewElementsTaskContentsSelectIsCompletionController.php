<?php
/**
 * View/Elements/TaskContents/select_is_completionテスト用Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppController', 'Controller');

/**
 * View/Elements/TaskContents/select_is_completionテスト用Controller
 *
 * @author Tomoyoshi Nakata <nakata.tomoyoshi@withone.co.jp>
 * @package NetCommons\Tasks\Test\test_app\Plugin\TestTasks\Controller
 */
class TestViewElementsTaskContentsSelectIsCompletionController extends AppController {

/**
 * select_is_completion
 *
 * @return void
 */
	public function select_is_completion() {
		$this->autoRender = true;
	}

}
