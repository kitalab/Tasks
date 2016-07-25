<?php
/**
 * TaskContents select status for view element
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

$params = $this->params['named'];
$params['page'] = 1;
$url = Hash::merge(array(
	'controller' => 'task_contents',
	'action' => 'index'),
	$params);

$currentStatus = isset($this->Paginator->params['named']['status']) ? $this->Paginator->params['named']['status'] : '';

if (empty($currentStatus)) :
	$currentStatus = 1;
endif;

$options = array();

$options = array(
	'TaskContents.status_' . 1 => array(
		'label' => __d('tasks', 'Incomplete task'),
		'status' => 1,
	),
	'TaskContents.status_' . 2 => array(
		'label' => __d('tasks', 'Completed task'),
		'status' => 2,
	),
	'TaskContents.status_' . 3 => array(
		'label' => __d('tasks', 'All task'),
		'status' => 3,
	),
);
?>

<span class="btn-group">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
			style="width: 125px">
		<?php echo h($options['TaskContents.status_' . $currentStatus]['label']); ?>
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu">
		<?php foreach ($options as $key => $status) : ?>
			<li>
				<?php echo $this->NetCommonsHtml->link($status['label'],
					Hash::merge($url, array('status' => $status['status']))
				); ?>
			</li>
		<?php endforeach; ?>
	</ul>
</span>
