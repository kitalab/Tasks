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
 * 担当者に設定したユーザーの存在確認
 *
 * @param int $userId ユーザーID
 * @return bool
 * @throws InternalErrorException
 */
	public function searchChargeUser($userId) {
		// 必要なモデル読み込み
		$this->loadModels([
			'User' => 'Users.User',
		]);
		if (! $this->User->findById($userId)) {
			return false;
		}
		return true;
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
		if (! $this->deleteAll(array('TaskCharge.task_content_id' => $taskId), false)) {
			throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
		}

		// 1件ずつ保存
		if (isset($data['TaskCharges']) && count($data['TaskCharges']) > 0) {
			foreach ($data['TaskCharges'] as $charge) {
				$charge['TaskCharge']['task_content_id'] = $taskId;
				if (! $this->validateTaskCharge($charge)) {
					return false;
				}
				$this->create($charge);
				if (! $this->save(null, false)) {
					throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
				}
			}
		}

		return true;
	}

/**
 * 担当者ユーザを設定
 *
 * @param array $taskContent ToDoデータ
 * @param bool $isMyUser 作成者ユーザー取得フラグ
 * @return array
 */
	public function getSelectUsers($taskContent, $isMyUser) {
		$this->loadModels(['User' => 'Users.User']);

		if ($isMyUser) {
			$taskContent['TaskCharge'][] = array('user_id' => Current::read('User.id'));
		}
		$this->log($taskContent);
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

/**
 * 担当者ユーザのハンドル名を絞り込み選択肢として取得
 *
 * @param array $taskContents ToDoListデータ
 * @return array
 */
	public function getSelectChargeUsers($taskContents) {
		$this->loadModels(['User' => 'Users.User']);

		$selectChargeUsers = array();

		// 一覧に表示可能なToDoで担当者として設定されているユーザidを取得(idをkeyに設定し重複を省く)
		$chargeUsers = Hash::combine(
			$taskContents,
			'{n}.TaskContents.{n}.TaskCharge.{n}.user_id',
			'{n}.TaskContents.{n}.TaskCharge.{n}.user_id'
		);

		if ($chargeUsers) {
			foreach ($chargeUsers as $userId) {
				$user = $this->User->getUser($userId);
				if (isset($user['User'])) {
					$selectChargeUsers['TaskContents.charge_user_id_' . $user['User']['id']] = array(
						'label' => $user['User']['handlename'],
						'user_id' => $user['User']['id']
					);
				}
			}
		}

		return $selectChargeUsers;
	}
}
