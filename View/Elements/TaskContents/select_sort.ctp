<?php
/**
 * TaskContents select value for view element
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

$currentSort = isset($this->Paginator->params['named']['sort']) ? $this->Paginator->params['named']['sort'] : '';

if (empty($currentSort)) :
	$currentSort = 1;
endif;

$options = array();

$options = array(
	'TaskContents.sort_' . 1 => array(
		'label' => __d('tasks', '期限の近い順'),
		'sort' => 1,
	),
	'TaskContents.sort_' . 2 => array(
		'label' => __d('tasks', '重要度の高い順'),
		'sort' => 2,
	),
	'TaskContents.sort_' . 3 => array(
		'label' => __d('tasks', '進捗率の高い順'),
		'sort' => 3,
	),
	'TaskContents.sort_' . 4 => array(
		'label' => __d('tasks', '進捗率の低い順'),
		'sort' => 4,
	),
);
?>

<span class="btn-group">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
			style="width: auto">
		<?php echo h($options['TaskContents.sort_' . $currentSort]['label']); ?>
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu">
		<?php foreach ($options as $key => $sort) : ?>
			<li>
				<?php echo $this->NetCommonsHtml->link($sort['label'],
					Hash::merge($url, array('sort' => $sort['sort']))
				); ?>
			</li>
		<?php endforeach; ?>
	</ul>
</span>
