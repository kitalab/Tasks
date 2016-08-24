<?php
/**
 * TaskContents select progress for view element
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php

$url = array(
		'controller' => 'task_progress_rate',
		'action' => 'edit',
		'content_key' => $taskContent['TaskContent']['key'],
		'stru' => $taskContent['TaskContent']['key'],
);
echo $this->NetCommonsForm->create(
	'TaskProgressRate', array('type' => 'post', 'url' => $url)
);

for ($i = 0; $i <= TaskContent::TASK_COMPLETION_PROGRESS_RATE;) {
	$options[$i] = $i . '%';
	$i += TaskContent::TASK_PROGRESS_RATE_INCREMENTS;
}

echo $this->NetCommonsForm->input('TaskContent.progress_rate', array(
		'type' => 'select',
		'options' => $options,
		'value' => $progressRate,
		'onChange' => 'submit();',
		$disabled
	)
);

echo $this->NetCommonsForm->end();