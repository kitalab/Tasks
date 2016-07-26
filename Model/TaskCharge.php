<?php
/**
 * TaskCharge Model
 *
 * @author   Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link     http://www.netcommons.org NetCommons Project
 * @license  http://www.netcommons.org/license.txt NetCommons License
 */

App::uses('TasksAppModel', 'Tasks.Model');

/**
 * TaskCharge Model
 *
 * @author   Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @package NetCommons\Tasks\Model
 */
class TaskCharge extends TasksAppModel {

/**
 * @var int recursiveはデフォルトアソシエーションなしに
 */
	public $recursive = -1;

/**
 * Validate this model
 *
 * @param array $data input data
 * @return bool
 */
	public function validateTaskCharge($data) {
		$this->set($data);
		$this->validates();
		return $this->validationErrors ? false : true;
	}

/**
 * ToDoの担当者を登録
 *
 * @param array $data 登録データ
 * @return bool
 * @throws InternalErrorException
 */
	public function setCharges($data) {
		$taskId = $data['TaskContent']['id'];

		// すべてDelete
		if (! $this->deleteAll(array(
			'TaskCharge.task_id' => $taskId), false)
		) {
			throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
		}

		// 1件ずつ保存
		if (isset($data['TaskCharges']) && count($data['TaskCharges']) > 0) {
			foreach ($data['TaskCharges'] as $charge) {
				$charge['TaskCharge']['task_id'] = $taskId;
				if (!$this->validateTaskCharge($charge)) {
					return false;
				}
				$this->create($charge);
				if (!$this->save(null, false)) {
					throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
				}
			}
		}

		return true;
	}

/**
 * 選択済みユーザを設定
 *
 * @param array $taskContent ToDoデータ
 * @return {void}
 */
	public function setSelectUsers($taskContent) {
		$this->loadModels([
			'User' => 'Users.User',
		]);

		$selectUsers['selectUsers'] = array();
		if (isset($taskContent['TaskCharge'])) {
			$selectUsers =
				Hash::extract($taskContent['TaskCharge'], '{n}.user_id');
			foreach ($selectUsers as $userId) {
				$user = $this->User->getUser($userId);
				$taskContent['selectUsers'][] = $user;
			}
		}
		return $taskContent;
	}
}
