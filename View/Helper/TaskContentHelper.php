<?php
/**
 * Task Content Helper
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
App::uses('AppHelper', 'View/Helper');

/**
 * Task Content Helper
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @package NetCommons\Tasks\View\Helper
 */
class TaskContentHelper extends AppHelper {

/**
 * Other helpers used by FormHelper
 *
 * @var array
 */
	public $helpers = array(
		'NetCommons.Date',
		'NetCommons.NetCommonsTime',
	);

/**
 * 表示するTODO実施期間作成
 *
 * @param string $date 実施期間
 * @param string $isDateSet 実施期間使用フラグ
 * @return string HTML
 */
	public function displayDate($date, $isDateSet = false) {
		if ($isDateSet) {
			$format = '';
			$now = $this->NetCommonsTime->getNowDatetime();
			$nowUserDatetime = $this->NetCommonsTime->toUserDatetime($now);
			$dateYear = date('Y', strtotime($date));
			$nowYear = date('Y', strtotime($nowUserDatetime));
			if ($dateYear === $nowYear) {
				$format = 'm/d';
			}

			$displayDate = $this->Date->dateFormat($date, $format);
		} else {
			$displayDate = __d('tasks', 'Not Date Set');
		}

		return $displayDate;
	}
}
