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
	public function validateDatetimeFromTo($check, $params) {
		$checkValue = array_values($check)[0];
		$isCompareFrom = isset($params['from']);
		$compareValue = $isCompareFrom ? $params['from'] : $params['to'];

		if (($isCompareFrom && $checkValue >= $compareValue) ||
			(! $isCompareFrom && $checkValue <= $compareValue)
		) {
			return true;
		}
		return false;
	}

/**
 * Validate datetime from to.
 *
 * @param array $check check fields.
 * @param array $params parameters.
 * @return bool
 */
	public function validateValueCheck($check, $params) {
		$checkValue = array_values($check)[0];
		for ($i = 0; $i <= TaskContent::TASK_COMPLETION_PROGRESS_RATE;) {
			$options[$i] = $i . '%';
			$i += TaskContent::TASK_PROGRESS_RATE_INCREMENTS;
		}

		if (isset($options[$checkValue])) {
			return true;
		}
		return false;
	}
}
