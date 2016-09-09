<?php
/**
 * TaskAppModel
 */
App::uses('AppModel', 'Model');

/**
 * Class TasksAppModel
 */
class TasksAppModel extends AppModel {

/**
 * Validate datetime from to.
 *
 * @param array $check check fields.
 * @param array $params parameters.
 * @return bool
 */
	public function validateIsDateCheck($check, $params) {
		$valid = false;
		$checkValue = array_values($check)[0];
		if (! $checkValue) {
			$valid = true;
		}
		if (isset($params['from']) && $params['from']) {
			$valid = true;
		}
		if (isset($params['to']) && $params['to']) {
			$valid = true;
		}

		return $valid;
	}

/**
 * Validate datetime from to.
 *
 * @param array $check check fields.
 * @param array $params parameters.
 * @return bool
 */
	public function validateDatetimeFromTo($check, $params) {
		$checkValue = array_values($check)[0];
		$isCompareFrom = isset($params['from']);
		if (! $isCompareFrom) {
			return true;
		}
		$compareValue = $isCompareFrom ? $params['from'] : $params['to'];

		if (($isCompareFrom && $checkValue >= $compareValue)
				|| (! $isCompareFrom && $checkValue <= $compareValue)) {
			return true;
		}
		return false;
	}

/**
 * 登録されている実施日によりdate_colorを取得
 *
 * @param array $taskStartDate 実施開始日
 * @param array $taskEndDate 実施終了日
 *
 * @return int
 */
	public function getTaskDateColor($taskStartDate, $taskEndDate) {
		$now = date('Ymd', strtotime(date('Y/m/d H:i:s')));
		$deadLine = date('Ymd', strtotime('+2 day'));

		$dateColor = TaskContent::TASK_BEING_PERFORMED;
		// 現在の日付が開始日より前
		if (! empty($taskStartDate)
				&& intval(date('Ymd', strtotime($taskStartDate))) > $now
		) {
			$dateColor = TaskContent::TASK_START_DATE_BEFORE;
		}
		if (! empty($taskEndDate)) {
			// 終了期限間近
			if (intval(date('Ymd', strtotime($taskEndDate))) >= intval($now)
					&& intval(date('Ymd', strtotime($taskEndDate))) <= intval($deadLine)
			) {
				$dateColor = TaskContent::TASK_DEADLINE_CLOSE;
				// 終了期限切れ
			} elseif (intval(date('Ymd', strtotime($taskEndDate))) < intval($now)
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
			|| $dateColor == TaskContent::TASK_BEYOND_THE_END_DATE
		) {
			return true;
		}
		return false;
	}

}
