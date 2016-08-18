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

}
