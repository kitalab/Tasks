<?php
/**
 * TaskContent view template
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
<div class="taskContents form" xmlns="http://www.w3.org/1999/html">
	<div class="ng-scope">

		<header class="clearfix">
			<div class="pull-left">
				<?php echo $this->Workflow->label($taskContent['TaskContent']['status']); ?>
			</div>
			<div class="pull-right">
				<?php if ($this->Workflow->canEdit('Tasks.TaskContent', $taskContent)) : ?>
					<div class="text-right">
						<?php echo $this->Button->editLink('',
							array(
								'controller' => 'task_contents',
								'key' => $taskContent['TaskContent']['key']
							),
							array(
								'tooltip' => true,
							)
						); ?>
					</div>
				<?php endif; ?>
			</div>
		</header>

		<article>
			<div class="clearfix">
				<?php echo $this->NetCommonsHtml->blockTitle($taskContent['TaskContent']['title']); ?>
			</div>

			<div class="clearfix task-content-margin-2">
				<div class="pull-left">
					<?php echo h(__d('tasks', 'Implementation period') . __d('tasks', 'Colon')); ?>
					<?php if (empty($taskContent['TaskContent']['is_date_set'])): ?>
						<?php echo __d('tasks', 'Not Date Set'); ?>
					<?php else: ?>
						<?php echo $this->Date->dateFormat($taskContent['TaskContent']['task_start_date']); ?>
					<?php endif; ?>

					<?php echo h(__d('tasks', 'Till')); ?>

					<?php if (empty($taskContent['TaskContent']['is_date_set'])): ?>
						<?php echo __d('tasks', 'Not Date Set'); ?>
					<?php else: ?>
						<?php echo $this->Date->dateFormat($taskContent['TaskContent']['task_end_date']); ?>
					<?php endif; ?>
				</div>
				<div class="pull-left task-content-margin-3">
					<?php echo h(__d('tasks', 'Priority') . __d('tasks', 'Colon')); ?>
					<?php if ($taskContent['TaskContent']['priority']) : ?>
						<?php echo $this->element('TaskContents/priority_icon', array(
							'priority' => $taskContent['TaskContent']['priority'],
							'class' => false,
						)); ?>
					<?php else : ?>
						<?php echo h(__d('tasks', 'Undefined')); ?>
					<?php endif; ?>
				</div>
				<div class="pull-left task-content-margin-3">
					<?php echo h(__d('tasks', 'Category') . __d('tasks', 'Colon')); ?>
					<?php if ($taskContent['Category']['name']): ?>
						<?php
						$url = array(
							'controller' => 'task_contents',
							'action' => 'index');
						?>
						<?php echo $this->NetCommonsHtml->link($taskContent['Category']['name'],
							Hash::merge($url, array('category_id' => $taskContent['Category']['id'])));
						?>
					<?php else : ?>
						<?php echo h(__d('tasks', 'Not selected')); ?>
					<?php endif; ?>
				</div>
				<div class="pull-right">
					<div class="task-view-table">
						<?php echo h(__d('tasks', 'Created_user')); ?>
						<div class="task-view-table-cell-1">
							<?php echo $this->DisplayUser->handlelink(
								$taskContent, array('avatar' => true)
							); ?>
						</div>
						<?php echo $this->Date->dateFormat($taskContent['TaskContent']['created']); ?>
					</div>
				</div>
			</div>
			<div class="clearfix">
				<div class="pull-left">
					<div class="pull-left">
						<div class="task-view-table">
							<div class="task-view-table-cell">
								<?php echo h(__d('tasks', 'Progress rate')); ?>
							</div>
							<div class="task-view-table-cell">
								<?php echo $this->element(
									'TaskContents/select_progress', array(
									'progressRate' => $taskContent['TaskContent']['progress_rate']
								)); ?>
							</div>
						</div>
					</div>
					<div class="pull-left">
						<div class="progress-min-scale-xs" class="task-view-table-cell">
							<div class="progress progress-min-width-xs task-view-progress"
								 style="width: 300px;">
								<div class="progress-bar progress-bar-success"
									 style="width: <?php echo $taskContent['TaskContent']['progress_rate']; ?>%;">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="pull-right ">
					<div class="task-view-table">
						<?php echo h(__d('tasks', 'Modified user')); ?>
						<div class="task-view-table-cell-1">
							<?php echo $this->DisplayUser->handlelink(
								$taskContent, array('avatar' => true), array(), 'TrackableUpdater'
							); ?>
						</div>
						<?php echo $this->Date->dateFormat($taskContent['TaskContent']['modified']); ?>
					</div>
				</div>
			</div>

			<div class="clearfix">
				<div class="pull-left">
					<div class="task-view-table">
						<div class="task-view-table-cell-2 task-view-user-top">
							<?php echo h(__d('tasks', 'Person in charge')); ?>
						</div>
						<div class="">
					<span class="nc-groups-avatar-list text-left">
						<?php if (! $this->request->data['selectUsers']) : ?>
							<?php echo h(__d('tasks', 'Not selected')); ?>
						<?php else : ?>
							<?php foreach ($this->request->data['selectUsers'] as $selectUsers): ?>
								<?php
								echo $this->DisplayUser->handlelink(
									$selectUsers, array('avatar' => true), array(), 'User'
								);
								?>
							<?php endforeach; ?>
						<?php endif; ?>
					</span>
						</div>
					</div>
				</div>
			</div>

			<hr style="border: 0 none transparent;">

			<div>
				<?php echo $taskContent['TaskContent']['content']; ?>
			</div>

			<hr style="border: 0 none transparent;">

			<?php echo $this->ContentComment->index($taskContent); ?>
		</article>
	</div>
</div>
