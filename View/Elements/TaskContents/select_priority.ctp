<?php
/**
 * TaskContents select priority element
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php
$priorityOptions[] = __d('tasks', 'Undefined');
$priorityOptions[] = __d('tasks', 'Low');
$priorityOptions[] = __d('tasks', 'Medium');
$priorityOptions[] = __d('tasks', 'High');
?>

<?php echo $this->NetCommonsForm->input('TaskContent.priority',
	array(
		'label' => __d('tasks', 'Priority'),
		'type' => 'select',
		'options' => $priorityOptions,
		'style' => 'width: auto',
	));
