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

$url = $this->NetCommonsHtml->url(array(
		'controller' => 'task_progress_rate',
		'action' => 'edit',
		'key' => $taskContent['TaskContent']['key']
	)
);
echo $this->NetCommonsForm->create(
	'TaskProgressRate', array('type' => 'post', 'url' => $url)
);

$options[0] = '0%';
$options[10] = '10%';
$options[20] = '20%';
$options[30] = '30%';
$options[40] = '40%';
$options[50] = '50%';
$options[60] = '60%';
$options[70] = '70%';
$options[80] = '80%';
$options[90] = '90%';
$options[100] = '100%';

echo $this->NetCommonsForm->input('TaskContent.progress_rate', array(
		'type' => 'select',
		'options' => $options,
		'value' => $progressRate,
		'onChange' => 'submit();',
	)
);

echo $this->NetCommonsForm->end();