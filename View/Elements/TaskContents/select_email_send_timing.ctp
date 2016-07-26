<?php
/**
 * TaskContents select email send timing element
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php
$options = array(
	'0' => __d('tasks', 'One day before the task period'),
	'1' => __d('tasks', 'Two days before the task period'),
	'2' => __d('tasks', 'One week before the task period'),
);

echo $this->NetCommonsForm->select('TaskContent.email_send_timing', $options, array(
	'class' => 'form-control',
	'empty' => false,
	'style' => 'float: left',
));
