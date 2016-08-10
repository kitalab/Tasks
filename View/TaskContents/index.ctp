<?php
/**
 * TaskContent index template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>
<?php
echo $this->Html->css(
	array(
		'/tasks/css/tasks.css'
	),
	array(
		'plugin' => false,
		'once' => true,
		'inline' => false
	)
);
?>
<article class="tasks index " ng-controller="Tasks.Contents" ng-init="init(<?php echo Current::read('Frame.id') ?>)">
	<h1 class="tasks_taskTitle"><?php echo $listTitle ?></h1>

	<?php if (Current::permission('content_creatable')) : ?>

		<div class="pull-right">
			<?php
			$addUrl = $this->NetCommonsHtml->url(array(
				'controller' => 'task_contents',
				'action' => 'add',
			));
			echo $this->Button->addLink('',
				$addUrl,
				array('tooltip' => __d('tasks', 'ToDo Add'))
			);
			?>
		</div>
	<?php endif ?>

	<div class="clearfix task-content-margin-1">
		<div class="pull-left">
			<?php echo $this->element('TaskContents/select_is_completion'); ?>
			<?php echo $this->Category->dropDownToggle(array(
					'empty' => h(__d('tasks', 'No category assignment')),
					'displayMenu' => true,
					'url' => NetCommonsUrl::actionUrlAsArray(Hash::merge(array(
						'plugin' => 'tasks',
						'controller' => 'task_contents',
						'action' => 'index',
						'block_id' => Current::read('Block.id'),
						'frame_id' => Current::read('Frame.id')
					), $this->params['named']))
				)
			); ?>
			<?php echo $this->element('TaskContents/select_user', array('options' => $userOptions)); ?>
			<?php echo $this->element('TaskContents/select_sort'); ?>
		</div>
	</div>
	<?php if (empty(count($taskContents))): ?>
		<div>
			<?php echo h(__d('tasks', 'Not task')); ?>
		</div>
	<?php else: ?>

		<?php $isNotShow = false; ?>
		<?php if (isset($params['user_id']) && $params['user_id'] !== Current::read('User.id')): ?>
			<?php $isNotShow = true; ?>
		<?php endif; ?>
		<?php $params = $this->params['named']; ?>

		<?php if ($deadLineTasks && empty($params['category_id']) && $isNotShow === false): ?>
			<div class="clearfix">
				<div class="pull-left">
					<?php echo __d('tasks', 'Deadline close Expiration'); ?>
				</div>
			</div>

			<?php echo $this->element('TaskContents/task_content', array(
					'taskContents' => $deadLineTasks,
				)
			); ?>
		<?php endif; ?>

		<?php foreach ($taskContents as $taskContent): ?>

			<div class="clearfix">
				<div class="pull-left task-category-name-margin">
					<?php echo $taskContent['Category']['name']; ?>
				</div>

				<?php if ($taskContent['Category']['name'] !== __d('tasks', 'No category')): ?>
					<div class="pull-right">
						<div class="clearfix">
							<div class="pull-left progress-min-scale-xs">
								<div class="progress progress-min-width-xs task-index-progress"
									 style="width: 250px;">
									<div class="progress-bar progress-bar-info"
										 style="width: <?php echo $taskContent['Category']['category_priority']; ?>%;">
										<?php echo $taskContent['Category']['category_priority']; ?>%
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>

			</div>

			<?php echo $this->element('TaskContents/task_content', array(
				'taskContents' => $taskContent['TaskContents'],
			)); ?>

		<?php endforeach; ?>

	<?php endif; ?>
</article>