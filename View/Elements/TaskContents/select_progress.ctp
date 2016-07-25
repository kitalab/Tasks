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
$options[] = '0%';
$options[] = '10%';
$options[] = '20%';
$options[] = '30%';
$options[] = '40%';
$options[] = '50%';
$options[] = '60%';
$options[] = '70%';
$options[] = '80%';
$options[] = '90%';
$options[] = '100%';

echo $this->NetCommonsForm->input('TaskContent.progress', array(
	'type' => 'select',
	'options' => $options,
));
