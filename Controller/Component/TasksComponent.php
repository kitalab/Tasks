<?php
/**
 * Tasks Component
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@wihtone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('Component', 'Controller');

/**
 * TasksComponent
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@wihtone.co.jp>
 * @package NetCommons\Tasks\Controller
 */
class TasksComponent extends Component {

/**
 * 公開中のTODO
 *
 * @var string
 */
	const TASK_CONTENT_STATUS_PUBLISHED = WorkflowComponent::STATUS_PUBLISHED;

/**
 * 一時保存中のTODO
 *
 * @var string
 */
	const TASK_CONTENT_STATUS_IN_DRAFT = WorkflowComponent::STATUS_IN_DRAFT;

/**
 * メールを送信しない
 *
 * @var const
 */
	const TASK_CONTENT_NOT_IS_MAIL_SEND = 0;

/**
 * 未完了のToDo
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
 * 重要度未設定
 *
 * @var const
 */
	const TASK_PRIORITY_UNDEFINED = 0;

/**
 * 重要度低
 *
 * @var const
 */
	const TASK_PRIORITY_LOW = 1;

/**
 * 重要度中
 *
 * @var const
 */
	const TASK_PRIORITY_MEDIUM = 2;

/**
 * 重要度高
 *
 * @var const
 */
	const TASK_PRIORITY_HIGH = 3;
}
