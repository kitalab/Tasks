<?php
/**
 * TaskContent Model
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('TasksAppModel', 'Tasks.Model');

/**
 * Summary for TaskContent Model
 *
 * @property TaskCharge $TaskCharge
 */
class TaskContent extends TasksAppModel {

/**
 * 完了したToDo
 *
 * @var const
 */
	const TASK_CONTENT_INCOMPLETE_TASK = 0;

/**
 * 完了したToDo
 *
 * @var const
 */
	const TASK_CONTENT_IS_COMPLETION = 1;

/**
 * 実施開始日前のToDo
 *
 * @var const
 */
	const TASK_START_DATE_BEFORE = 1;

/**
 * 実施終了日間近のToDo
 *
 * @var const
 */
	const TASK_DEADLINE_CLOSE = 2;

/**
 * 実施終了日を過ぎたToDo
 *
 * @var const
 */
	const TASK_BEYOND_THE_END_DATE = 3;

/**
 * 実施中のToDo
 *
 * @var const
 */
	const TASK_BEING_PERFORMED = 4;

/**
 * 一覧画面でのユーザーアイコン表示上限
 *
 * @var const
 */
	const LIST_DISPLAY_NUM = 5;

/**
 * ToDoの進捗率の刻み数
 *
 * @var const
 */
	const TASK_PROGRESS_RATE_INCREMENTS = 10;

/**
 * ToDo完了時の進捗率
 *
 * @var const
 */
	const TASK_COMPLETION_PROGRESS_RATE = 100;

/**
 * @var int recursiveはデフォルトアソシエーションなしに
 */
	public $recursive = -1;

/**
 * use behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'NetCommons.Trackable',
		'NetCommons.OriginalKey',
		'Workflow.Workflow',
		'Workflow.WorkflowComment',
		'ContentComments.ContentComment',
		'Topics.Topics' => array(
			'fields' => array(
				'title' => 'title',
				'summary' => 'content',
				'path' => '/:plugin_key/task_contents/view/:block_id/:content_key',
			),
		),
		'Mails.MailQueue' => array(
			'embedTags' => array(
				'X-SUBJECT' => 'TaskContent.title',
				'X-BODY' => 'TaskContent.content',
			),
		),
		'Tasks.TaskCharge',
		'Wysiwyg.Wysiwyg' => array(
			'fields' => array('content'),
		),
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Categories.Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Block' => array(
			'className' => 'Blocks.Block',
			'foreignKey' => 'block_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => array(
				'content_count' => array('TaskContent.is_latest' => 1),
			),
		),
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TaskCharge' => array(
			'className' => 'Tasks.TaskCharge',
			'foreignKey' => 'task_content_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);

/**
 * バリデートメッセージ多言語化対応のためのラップ
 *
 * @param array $options options
 * @return bool
 */
	public function beforeValidate($options = array()) {
		$this->validate = Hash::merge(
			$this->validate,
			$this->_getValidateSpecification()
		);
		return parent::beforeValidate($options);
	}

/**
 * バリデーションルールを返す
 *
 * @return array
 */
	protected function _getValidateSpecification() {
		$validate = array(
			'title' => array(
				'notBlank' => [
					'rule' => array('notBlank'),
					'message' => sprintf(__d('net_commons', 'Please input %s.'), __d('tasks', 'Title')),
					'required' => true,
				],
			),
			'content' => array(
				'notBlank' => [
					'rule' => array('notBlank'),
					'message' => sprintf(__d('net_commons', 'Please input %s.'), __d('tasks', 'Content')),
					'required' => true,
				],
			),
			'task_start_date' => array(
					'datetime' => array(
							'rule' => array('datetime'),
							'message' => __d('net_commons', 'Invalid request.'),
					),
			),
			'task_end_date' => array(
					'datetime' => array(
							'rule' => array('datetime'),
							'message' => __d('net_commons', 'Invalid request.'),
					),
					'fromTo' => array(
							'rule' => array('validateDatetimeFromTo',
									array('from' => $this->data['TaskContent']['task_start_date'])),
							'message' => __d('net_commons', 'Invalid request.'),
					)
			),
		);
		return $validate;
	}

/**
 * ToDoの一覧データを返す
 *
 * @param array $params 絞り込み条件
 * @param array $order 並べ替え条件
 * @param array $userParam 担当者絞り込み条件
 * @return array
 */
	public function getList($params = array(), $order = array(), $userParam = array()) {
		if ($userParam) {
			$params = $this->getUserCondition($params, $userParam);
		}

		$conditions = $this->getConditions(Current::read('Block.id'), $params);

		$lists = $this->find('threaded',
			array('recursive' => 1, 'conditions' => $conditions, 'order' => $order));

		if (! $lists) {
			return array();
		}

		$taskContentList = $this->getTaskContentList($lists);

		return $taskContentList;
	}

/**
 * カテゴリデータとToDoデータを整理したLISTを返す
 *
 * @param array $lists 担当者絞り込み条件で取得したデータ
 *
 * @return array
 */
	public function getTaskContentList($lists) {
		// カテゴリ情報を取得
		$categoryArr = $this->getCategory($lists);

		// ToDo一覧情報を取得
		$taskContentList = $this->getCategoryContentList($categoryArr, $lists);

		return $taskContentList;
	}

/**
 * 担当者絞り込みを含めた条件を返す
 *
 * @param array $params 担当者絞り込み条件
 * @param array $userParam 絞り込み条件
 *
 * @return array
 */
	public function getUserCondition($params, $userParam) {
		// 絞り込み条件に指定した担当者データを全て取得
		$taskChargeContents = $this->TaskCharge->find('threaded',
			array('recursive' => 1, 'conditions' => $userParam));
		// 担当者として設定されているToDoのcontent_idのみ取得
		$taskContentIds = Hash::extract($taskChargeContents, '{n}.TaskCharge.task_content_id');

		// 絞り込み条件に加える
		$params[] = array('TaskContent.id' => $taskContentIds);

		return $params;
	}

/**
 * カテゴリデータを返す
 *
 * @param array $contentLists ToDoリスト
 *
 * @return array
 */
	public function getCategory($contentLists) {
		// 取得したデータに存在するカテゴリ配列を取得
		$categoryArr = Hash::combine($contentLists, '{n}.Category.id', '{n}.Category');

		// カテゴリが未指定のときのカテゴリ情報を作成
		$notCategory = array();
		if (isset($categoryArr[''])) {
			$notCategory[] = array(
				'id' => 0,
				'name' => __d('tasks', 'No category')
			);
			unset($categoryArr['']);
		}
		// カテゴリをidの降順で表示
		$categoryArr = Set::sort($categoryArr, '{n}.id', 'DESC');

		// カテゴリなしを配列の先頭へ配置するためのマージ
		$categoryArr = array_merge($notCategory, $categoryArr);

		return $categoryArr;
	}

/**
 * ToDoと担当者データを紐づけたデータを返す
 *
 * @param array $categoryArr カテゴリデータ
 * @param array $contentLists ToDoリスト
 *
 * @return array
 */
	public function getCategoryContentList($categoryArr, $contentLists) {
		// カテゴリなしは進捗率を表示しないので条件から省く
		$categoryRateParam = array('Not' => array('TaskContent.category_id' => 0));
		$categoryCondition = $this->getConditions(Current::read('Block.id'), $categoryRateParam);
		// バーチャルフィールドを追加
		$this->virtualFields['cnt'] = 0;
		$this->virtualFields['sum'] = 0;
		// カテゴリ毎の全体のToDo数と進捗率を取得
		$categoryData = $this->find('all', array(
			'fields' => array(
				'TaskContent.category_id', 'count(TaskContent.category_id) as TaskContent__cnt',
				'TaskContent.progress_rate', 'sum(TaskContent.progress_rate) as TaskContent__sum'
			),
			'conditions' => $categoryCondition,
			'group' => array('TaskContent.category_id'),
		));
		$categoryData = Hash::combine($categoryData, '{n}.TaskContent.category_id', '{n}.TaskContent');

		$taskContentList = array();

		foreach ($categoryArr as $category) {
			$results = array();
			$categoryPriority = 0;
			if (empty($category['id'])) {
				$category['id'] = 0;
				$category['name'] = __d('tasks', 'No category');
			}

			$contents = Hash::extract(
				$contentLists, '{n}.TaskContent[category_id=' . $category['id'] . ']', '{n}'
			);

			// ToDoとToDo担当者を一つの配列にまとめる
			foreach ($contents as $content) {
				$taskCharge = Hash::extract(
					$contentLists, '{n}.TaskCharge.{n}[task_content_id=' . $content['id'] . ']'
				);
				// ここでdate_colorをセット＆Controllerで期限間近判定用のフラグをセット
				$content['date_color'] = $this->getTaskDateColor($content);
				$isDeadLine = $this->isDeadLine($content['date_color']);
				$results['TaskContents'][] = array(
					'TaskContent' => $content,
					'TaskCharge' => $taskCharge,
					'isDeadLine' => $isDeadLine,
				);
			}

			// ToDoListカテゴリがある場合進捗率の平均値を取得する
			if (isset($categoryData[$category['id']])) {
				$categoryPriority = $this->getCategoryPriority($categoryData[$category['id']]);
			}

			$results['Category'] = $category;
			$results['Category']['category_priority'] = $categoryPriority;
			$taskContentList[] = $results;
		}
		return $taskContentList;
	}

/**
 * 登録されている実施日によりdate_colorを取得
 *
 * @param array $taskContent ToDoデータ
 *
 * @return array
 */
	public function getTaskDateColor($taskContent) {
		$now = date('Ymd', strtotime(date('Y/m/d H:i:s')));
		$deadLine = date('Ymd', strtotime('+2 day'));

		// 現在実施中
		$dateColor = TaskContent::TASK_BEING_PERFORMED;
		if ($taskContent['is_completion'] === true || empty($taskContent['is_date_set'])) {
			return $dateColor;
		}
		// 現在の日付が開始日より前
		if (! empty($taskContent['task_start_date'])
			&& intval(date('Ymd', strtotime($taskContent['task_start_date']))) > $now
		) {
			$dateColor = TaskContent::TASK_START_DATE_BEFORE;
		}
		if (! empty($taskContent['task_end_date'])) {
			// 終了期限間近
			if (intval($taskContent['task_end_date']) >= intval($now)
				&& intval(date('Ymd', strtotime($taskContent['task_end_date']))) <= intval($deadLine)
			) {
				$dateColor = TaskContent::TASK_DEADLINE_CLOSE;
				// 終了期限切れ
			} elseif (intval(date('Ymd', strtotime($taskContent['task_end_date']))) < intval($now)
			) {
				$dateColor = TaskContent::TASK_BEYOND_THE_END_DATE;
			}
		}

		return $dateColor;
	}

/**
 * date_colorにより期限間近か否か判定
 *
 * @param array $dateColor ToDoの実施期間判定色
 *
 * @return array
 */
	public function isDeadLine($dateColor) {
		if ($dateColor == TaskContent::TASK_DEADLINE_CLOSE
				|| $dateColor == TaskContent::TASK_BEYOND_THE_END_DATE) {
			return true;
		}
		return false;
	}

/**
 * ToDoのデータを一件返す
 *
 * @param void $key key
 *
 * @return array
 */
	public function getTask($key) {
		$conditions = $this->getConditions(
			Current::read('Block.id')
		);

		$conditions = array_merge($conditions, array('TaskContent.key' => $key));

		$lists = $this->find('first', array(
			'recursive' => 1,
			'conditions' => $conditions
		));

		if (! $lists) {
			return array();
		}

		return $lists;
	}

/**
 * blockIdから参照可能なToDoを取得するCondition配列を返す
 *
 * @param int $blockId blockId
 * @param array $conditions ソート絞り込み条件
 * @return array condition
 */
	public function getConditions($blockId, $conditions = array()) {
		// デフォルト絞り込み条件にソート絞り込み条件をマージする
		$conditions = array_merge($conditions, array('TaskContent.block_id' => $blockId));

		$conditions = $this->getWorkflowConditions($conditions);

		return $conditions;
	}

/**
 * カテゴリごとのToDoの進捗率の平均値を取得
 *
 * @param array $categoryData カテゴリデータ
 * @return int
 */
	public function getCategoryPriority($categoryData) {
		// ToDoの進捗率の合計を求める
		$total = $categoryData['sum'];
		$count = $categoryData['cnt'];

		// 実際の値より大きくならないよう小数点以下切り捨て
		$categoryPriority = floor($total / $count);

		return $categoryPriority;
	}

/**
 * ToDoの保存。
 *
 * @param array $data 登録データ
 * @return bool
 * @throws InternalErrorException
 */
	public function saveContent($data) {
		// 必要なモデル読み込み
		$this->loadModels([
			'TaskCharge' => 'Tasks.TaskCharge',
		]);
		$data['TaskCharges'] = Hash::map($data, 'TaskCharge.{n}.user_id', function ($value) {
			return array(
				'TaskCharge' => array(
					'id' => null,
					'user_id' => $value,
				));
		});

		$this->begin();
		try {
			$this->create(); // 常に新規登録
			// 先にvalidate 失敗したらfalse返す
			$this->set($data);
			if (! $this->validates($data)) {
				$this->rollback();
				return false;
			}

			if (($savedData = $this->save($data, false)) === false) {
				//このsaveで失敗するならvalidate以外なので例外なげる
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
			$data['TaskContent'] = $savedData['TaskContent'];
			// 担当者を登録
			if (! $this->TaskCharge->setCharges($data)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
			// メール処理
			$sendTimes = array($data['TaskContent']['modified']);
			$this->setSendTimeReminder($sendTimes);
			$mailSendUserIdArr =
				Hash::extract($data, 'TaskCharges.{n}.TaskCharge.user_id');
			$this->setSetting(MailQueueBehavior::MAIL_QUEUE_SETTING_USER_IDS, $mailSendUserIdArr);

			$this->commit();

		} catch (Exception $e) {
			$this->rollback($e);
		}
		return $savedData;
	}

/**
 * 進捗率を更新
 *
 * @param array $key ToDoキー
 * @param array $progressRate ToDo進捗率
 * @return bool
 * @throws InternalErrorException
 */
	public function saveProgressRate($key, $progressRate) {
		$this->begin();
		try {
			$isCompletion = false;
			if ((int)$progressRate === TaskContent::TASK_COMPLETION_PROGRESS_RATE) {
				$isCompletion = true;
			}

			$data = array(
				'TaskContent.progress_rate' => $progressRate,
				'is_completion' => $isCompletion,
			);
			$conditions = array(
				'TaskContent.key' => $key,
			);
			if (! $this->updateAll($data, $conditions)) {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}

			$this->commit();

		} catch (Exception $e) {
			$this->rollback($e);
		}

		return true;
	}

/**
 * TODO削除
 *
 * @param int $key オリジンID
 * @throws InternalErrorException
 * @return bool
 */
	public function deleteContentByKey($key) {
		$this->begin();
		try {
			// 記事削除
			$this->contentKey = $key;
			$conditions = array('TaskContent.key' => $key);
			if ($result = $this->deleteAll($conditions, true, true)) {
				$this->commit();
			} else {
				throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
			}
			
			$this->log($result);
		} catch (Exception $e) {
			$this->rollback($e);
			//エラー出力
		}
		return $result;
	}
}
