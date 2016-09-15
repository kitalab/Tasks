<?php
/**
 * Task Content Edit Helper
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
App::uses('AppHelper', 'View/Helper');

/**
 * Task Content edit Helper
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @package NetCommons\Tasks\View\Helper
 */
class TaskContentEditHelper extends AppHelper {

/**
 * Other helpers used by FormHelper
 *
 * @var array
 */
	public $helpers = array(
		'NetCommons.NetCommonsForm',
		'NetCommons.NetCommonsHtml',
		'Form'
	);

/**
 * TODO期間設定作成
 *
 * @param string $fieldName フィールド名
 * @param array $options オプション
 * @return string HTML
 */
	public function taskContentAttributeDatetime($fieldName, $options) {
		$ngModel = 'TaskContent.' . Inflector::variable($fieldName);

		$pickerOpt = str_replace('"', "'", json_encode(array(
					'format' => 'YYYY-MM-DD',
				)
			)
		);

		$defaultOptions = array(
			'type' => 'datetime',
			'id' => $fieldName,
			'ng-model' => $ngModel,
			'datetimepicker-options' => $pickerOpt,
			'data-toggle' => 'dropdown',
			'class' => 'form-control',
			'placeholder' => 'yyyy-mm-dd',
		);
		$options = Hash::merge($defaultOptions, $options);
		if (isset($options['start']) && isset($options['end'])) {
			$start = $options['start'];
			$end = $options['end'];
			$options = Hash::merge($options, array(
				'ng-focus' => 'setStartToDate($event, \'' . $start . '\', \'' . $end . '\')',
			));
		}

		$ret = '';
		$ret .= $this->NetCommonsForm->input($fieldName, $options);
		return $ret;
	}
}
