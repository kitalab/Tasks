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
 * @var int recursiveはデフォルトアソシエーションなしに
 */
	public $recursive = -1;

/**
 * @var array 進捗率のバリデーションルールinList用配列
 */
	protected $_progressRates = array();

/**
 * @var array カテゴリIDのバリデーションルールinList用配列
 */
	protected $_categoryIds = array();

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
				'X-URL' => array('controller' => 'task_contents'),
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
		'CategoryOrder' => array(
			'className' => 'Categories.CategoryOrder',
			'foreignKey' => false,
			'conditions' => 'CategoryOrder.category_key=Category.key',
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
		if ($options['only_progress']) {
			$getValidate = $this->_getValidateOnlyProgress();
		} else {
			$getValidate = $this->_getValidateSpecification();
		}

		$this->validate = Hash::merge(
			$this->validate, $getValidate
		);
		return parent::beforeValidate($options);
	}

/**
 * コンストラクタ
 * 
 * @param bool|int|string|array $id Set this ID for this model on startup,
 * can also be an array of options, see above.
 * @param string $table Name of database table to use.
 * @param string $ds DataSource connection name.
 * @see Model::__construct()
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		for ($i = 0; $i <= TasksComponent::TASK_COMPLETION_PROGRESS_RATE;) {
			$this->_progressRates[$i] = $i;
			$i += TasksComponent::TASK_PROGRESS_RATE_INCREMENTS;
		}

		// 必要なモデル読み込み
		$this->loadModels([
				'Category' => 'Categories.Category',
		]);
		$conditions = array(
			'Category.block_id' => Current::read('Block.id')
		);
		$categories = $this->Category->find('all', array('recursive' => -1, 'conditions' => $conditions));
		$this->_categoryIds = Hash::combine($categories, '{n}.Category.id', '{n}.Category.id');
		// カテゴリ未設定時の時にエラーとなるので0をinList条件に加える
		$this->_categoryIds[0] = 0;
	}

/**
 * バリデーションルールを返す
 *
 * @return array
 */
	protected function _getValidateSpecification() {
		$validate = array(
			'title' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => sprintf(__d('net_commons', 'Please input %s.'), __d('tasks', 'Title')),
					'required' => true,
				),
			),
			'category_id' => array(
				'numeric' => array(
					'rule' => array('inList', $this->_categoryIds),
					'allowEmpty' => true,
				'message' => __d('net_commons', 'Invalid request.')
				),
			),
			'priority' => array(
				'numeric' => array(
					'rule' => array('inList', array(
						TasksComponent::TASK_PRIORITY_UNDEFINED, TasksComponent::TASK_PRIORITY_LOW,
						TasksComponent::TASK_PRIORITY_MEDIUM, TasksComponent::TASK_PRIORITY_HIGH
					)),
					'allowEmpty' => true,
				'message' => __d('net_commons', 'Invalid request.')
				),
			),
			'status' => array(
					'numeric' => array(
							'rule' => array('numeric'),
					'message' => __d('net_commons', 'Invalid request.')
					),
			),
			'is_enable_mail' => array(
					'boolean' => array(
							'rule' => array('boolean'),
					'message' => __d('net_commons', 'Invalid request.')
					),
			),
			'is_date_set' => array(
					'boolean' => array(
							'rule' => array('boolean'),
					'message' => __d('net_commons', 'Invalid request.')
					),
					'isDateCheck' => array(
						'rule' => array('validateIsDateCheck',
							array('from' => $this->data['TaskContent']['task_start_date'],
								'to' => $this->data['TaskContent']['task_end_date'])
						),
						'message' => __d('tasks', 'Please set the start date or end date.')
					),
			),
			'use_calendar' => array(
					'boolean' => array(
							'rule' => array('boolean'),
					'message' => __d('net_commons', 'Invalid request.')
					),
			),
			'email_send_timing' => array(
				'numeric' => array(
					'rule' => array('numeric'),
					'allowEmpty' => true,
				'message' => __d('net_commons', 'Invalid request.')
				),
			),
			'progress_rate' => array(
				'numeric' => array(
					'rule' => array('inList', $this->_progressRates),
					'allowEmpty' => true,
				'message' => __d('net_commons', 'Invalid request.')
				),
			),
		);
		$validate = $this->_getValidateTaskDate($validate);

		return $validate;
	}

/**
 * 進捗率のみ更新時のバリデーションルールを返す
 *
 * @return array
 */
	protected function _getValidateOnlyProgress() {
		$validate = array(
			'progress_rate' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => __d('net_commons', 'Invalid request.'),
				),
				'numeric' => array(
					'rule' => array('inList', $this->_progressRates),
					'allowEmpty' => true,
					'message' => __d('net_commons', 'Invalid request.')
				),
			),
		);
		return $validate;
	}

/**
 * 実施日に関するバリデーションルールを返す
 *
 * @param array $validate validate
 * @return array
 */
	protected function _getValidateTaskDate($validate = array()) {
		if ($this->data['TaskContent']['task_start_date']) {
			$validate = Hash::merge($validate, array(
				'task_start_date' => array(
					'datetime' => array(
						'rule' => array('datetime'),
						'message' => __d('net_commons', 'Invalid request.'),
					),
				),
			));
		}

		if ($this->data['TaskContent']['task_end_date']) {
			$validate = Hash::merge($validate, array(
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
			));
		}

		return $validate;
	}

/**
 * ToDoの一覧データを全て返す
 *
 * @param array $params 絞り込み条件
 * @param array $order 並べ替え条件
 * @return array
 */
	public function getAllList($params = array(), $order = array()) {
		$conditions = $this->getConditions(Current::read('Block.id'), $params);

		$lists = $this->find('all',
			array('recursive' => 1, 'conditions' => $conditions, 'order' => $order));

		if (! $lists) {
			return array();
		}

		$results = array();
		// isDeadLine及びdate_colorを取得
		foreach ($lists as $list) {
			// 現在実施中
			$list['TaskContent']['date_color'] = TasksComponent::TASK_BEING_PERFORMED;
			// ここでdate_colorをセット＆Controllerで期限間近判定用のフラグをセット
			if (empty($list['TaskContent']['is_completion'])
					&& ! empty($list['TaskContent']['is_date_set'])
			) {
				$list['TaskContent']['date_color'] = $this->getTaskDateColor(
						$list['TaskContent']['task_start_date'],
						$list['TaskContent']['task_end_date']
				);
			}

			$isDeadLine = $this->isDeadLine($list['TaskContent']['date_color']);
			$results[] = array_merge($list, array('isDeadLine' => $isDeadLine));
		}

		// $listsにdate_colorを取得した$resultsを代入する
		$listArray = array(
			'results' => $results,
			'conditions' => $conditions
		);

		return $listArray;
	}

/**
 * ToDoの一覧データを必要なデータのみに整理して返す
 *
 * @param array $lists ToDoの取得データ
 * @param array $listConditions ToDo全体データ取得時に使用したconditions
 * @return array
 */
	public function getList($lists = array(), $listConditions = array()) {
		// カテゴリなしは進捗率を表示しないので条件から省く
		$categoryRateParam = array('Not' => array('TaskContent.category_id' => 0));
		$listConditions = array_merge($listConditions, $categoryRateParam);
		// バーチャルフィールドを追加
		$this->virtualFields['cnt'] = 0;
		$this->virtualFields['sum'] = 0;
		// カテゴリ毎の全体のToDo数と進捗率を取得
		$categoryData = $this->find('all', array(
				'fields' => array(
						'TaskContent.category_id', 'count(TaskContent.category_id) as TaskContent__cnt',
						'TaskContent.progress_rate', 'sum(TaskContent.progress_rate) as TaskContent__sum'
				),
				'conditions' => $listConditions,
				'group' => array('TaskContent.category_id'),
		));
		$categoryData = Hash::combine($categoryData, '{n}.TaskContent.category_id', '{n}.TaskContent');

		$taskContentList = $this->getTaskContentList($lists, $categoryData);

		return $taskContentList;
	}

/**
 * カテゴリデータとToDoデータを整理したLISTを返す
 *
 * @param array $lists 担当者絞り込み条件で取得したデータ
 * @param array $categoryData カテゴリ毎の全体のToDo数と進捗率
 *
 * @return array
 */
	public function getTaskContentList($lists, $categoryData = array()) {
		// カテゴリ情報を取得
		$categoryArr = $this->getCategory($lists);

		// ToDo一覧情報を取得
		$taskContentList = $this->getCategoryContentList($categoryArr, $lists, $categoryData);

		return $taskContentList;
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
		$categoryOderArr = Hash::combine(
			$contentLists,
			'{n}.CategoryOrder.id',
			'{n}.CategoryOrder.weight'
		);

		$categoryWeightArr = array();
		foreach ($categoryArr as $category) {
			$id = $category['id'];
			if (isset($categoryOderArr[$id])) {
				$category['weight'] = $categoryOderArr[$id];
			}
			$categoryWeightArr[$id] = $category;
		}
		$categoryArr = $categoryWeightArr;

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
		$categoryArr = Set::sort($categoryArr, '{n}.weight', 'ASC');

		// カテゴリなしを配列の先頭へ配置するためのマージ
		$categoryArr = array_merge($notCategory, $categoryArr);

		return $categoryArr;
	}

/**
 * ToDoと担当者データを紐づけたデータを返す
 *
 * @param array $categoryArr カテゴリデータ
 * @param array $contentLists ToDoリスト
 * @param array $categoryData カテゴリ毎の全体のToDo数と進捗率
 *
 * @return array
 */
	public function getCategoryContentList($categoryArr, $contentLists, $categoryData = array()) {
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

				$results['TaskContents'][] = array(
					'TaskContent' => $content,
					'TaskCharge' => $taskCharge,
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
				)
			);
		});

		$this->begin();
		try {
			$this->create(); // 常に新規登録
			// 先にvalidate 失敗したらfalse返す
			$this->set($data);

			if (! $this->validates(array('only_progress' => false))) {
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

			//$sendTimes = array(NetCommonsTime::getNowDatetime());
			//リマインダーメール設定
			//if ($data['TaskContent']['is_enable_mail']) {
			//実施終了日の日時を0持00分に変更する
			//$taskEndDate = date('Y-m-d H:i:s',
			//strtotime($data['TaskContent']['task_end_date'] . ' -1day +1 second'));
			//$sendTimes = array(
			//date('Y-m-d H:i:s', strtotime(
			//	$taskEndDate . ' -' . $data['TaskContent']['email_send_timing'] . 'day'
			//))
			//);
			//}
			//$this->setSendTimeReminder($sendTimes);
			// メール処理
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
	public function updateProgressRate($key, $progressRate) {
		$this->begin();
		try {
			$isCompletion = false;
			if ((int)$progressRate === TasksComponent::TASK_COMPLETION_PROGRESS_RATE) {
				$isCompletion = true;
			}

			$conditions = array(
				'TaskContent.key' => $key,
				'TaskContent.status' => TasksComponent::TASK_CONTENT_STATUS_PUBLISHED,
			);

			if (! Current::permission('content_publishable')) {
				$taskContents = $this->find('first',
					array('recursive' => 1, 'conditions' => $conditions));
				$chargeUser = Hash::extract(
					$taskContents, 'TaskCharge.{n}[user_id=' . Current::read('User.id') . ']'
				);

				$taskContent = Hash::extract($taskContents, 'TaskContent');

				// 担当者でなくTODO作成者でもないのであればfalseを返す
				if (! $taskContent
						|| ! $chargeUser
						&& $taskContent['created_user'] !== Current::read('User.id')
				) {
					return false;
				}
			}

			$data = array(
				'progress_rate' => $progressRate,
				'is_completion' => $isCompletion,
				'modified_user' => Current::read('User.id'),
			);

			// statusを一時保存の状態として設定しバリデーション処理を行う
			$data['status'] = TasksComponent::TASK_CONTENT_STATUS_IN_DRAFT;

			$this->set($data);
			if (! $this->validates( array('only_progress' => true))) {
				return false;
			}

			// statusは更新しないのでunsetする
			unset($data['status']);
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
 * @param void $key オリジンKey
 * @throws InternalErrorException
 * @return bool
 */
	public function deleteContentByKey($key) {
		$this->begin();
		try {

			// 削除対象となるIDを取得
			$targetIds = $this->find('list', array(
				'fields' => array('TaskContent.id', 'TaskContent.id'),
				'recursive' => -1,
				'conditions' => array(
					'TaskContent.key' => $key,
				)
			));

			// 関連するデータを一式削除
			if (count($targetIds) > 0) {
				$this->contentKey = $key;
				if (! $this->TaskCharge->deleteAll(
					array('TaskCharge.task_content_id' => $targetIds), false)
				) {
					throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
				}
				if (! $this->deleteAll(array($this->alias . '.key' => $key), false, true)) {
					throw new InternalErrorException(__d('net_commons', 'Internal Server Error'));
				}
			}

			$this->commit();

		} catch (Exception $ex) {
			$this->rollback();
			CakeLog::error($ex);
			throw $ex;
		}
		return true;
	}
}
