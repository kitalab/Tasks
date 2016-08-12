<?php
/**
 * TaskContentstask task content for view element
 *
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

<table class="table table-hover">
	<tbody>
	<?php foreach ($taskContents as $content): ?>
		<tr>
			<?php if ($content['TaskContent']['is_completion'] === true): ?>
				<td class="col-xs-1 col-ms-1 col-md-1 col-lg-1 task-index-content-text-middle">
					<div data-toggle="buttons">
						<?php echo $this->NetCommonsForm->input(
							'<span class="glyphicon glyphicon-ok task-index-button-completion-color"></span>', array(
								'type' => 'button',
								'checked' => true,
								'disabled' => 'disabled',
								'class' => 'btn btn-default active',
								'div' => false,
							)
						); ?>
					</div>
				</td>
			<?php else: ?>
				<?php
				$url = $this->NetCommonsHtml->url(array(
						'controller' => 'task_progress_rate',
						'action' => 'edit',
						'key' => $content['TaskContent']['key'],
						'TaskContent' => array('progress_rate' => TaskContent::TASK_COMPLETION_PROGRESS_RATE),
					)
				);
				echo $this->NetCommonsForm->create(
					'TaskProgressRate', array('type' => 'post', 'url' => $url)
				);
				$disabled = 'disabled';
				if (Hash::extract($content, 'TaskCharge.{n}[user_id=' . Current::read('User.id') . ']')
						|| $this->Workflow->canEdit('Tasks.TaskContent', $content)
				):
					$disabled = '';
				endif;
				?>
				<td class="col-xs-1 col-ms-1 col-md-1 col-lg-1 task-index-content-text-middle">
					<div data-toggle="buttons">
						<?php echo $this->NetCommonsForm->input(
							'<span class="glyphicon glyphicon-ok text-muted color-un-active"></span>', array(
								'type' => 'button',
								'onClick' => 'submit();',
								'checked' => true,
								'class' => 'btn btn-default',
								'div' => false,
								$disabled
							)
						); ?>
					</div>
				</td>
				<?php echo $this->NetCommonsForm->end(); ?>
			<?php endif; ?>

			<?php
			$color = array(
				TaskContent::TASK_START_DATE_BEFORE => 'task-color-un-active',
				TaskContent::TASK_DEADLINE_CLOSE => 'task-color-deadline',
				TaskContent::TASK_BEYOND_THE_END_DATE => 'task-color-danger',
				TaskContent::TASK_BEING_PERFORMED => ''
			);
			?>
			<td class="col-xs-2 col-ms-2 col-md-2 col-lg-2 task-index-content-text-middle 
				<?php echo $color[$content['TaskContent']['date_color']]; ?>">
				<?php if (empty($content['TaskContent']['priority'])): ?>
					<?php if (empty($content['TaskContent']['is_date_set'])): ?>
						<?php echo __d('tasks', 'Not Date Set'); ?>
					<?php else: ?>
						<?php echo $this->Date->dateFormat($content['TaskContent']['task_end_date']); ?>
					<?php endif; ?>
				<?php else: ?>
					<div class="task-index-priority-1">
						<?php if (empty($content['TaskContent']['is_date_set'])): ?>
							<?php echo __d('tasks', 'Not Date Set'); ?>
						<?php else: ?>
							<?php echo $this->Date->dateFormat($content['TaskContent']['task_end_date']); ?>
						<?php endif; ?>
					</div>
					<?php echo $this->element('TaskContents/priority_icon', array(
							'priority' => $content['TaskContent']['priority'],
							'class' => 'task-index-priority-2'
						)
					); ?>
				<?php endif; ?>
			</td>

			<td class="col-xs-4 col-ms-4 col-md-5 col-lg-5 task-index-content-text-middle">
				<?php echo $this->Workflow->label($content['TaskContent']['status']); ?>
				<?php echo $this->Html->link(
					$content['TaskContent']['title'],
					$this->NetCommonsHtml->url(
						array(
							'controller' => 'task_contents',
							'action' => 'view',
							'key' => $content['TaskContent']['key']
						)
					)
				); ?>
			</td>

			<td class="col-xs-1 col-ms-1 col-md-1 col-lg-1 task-index-content-text-middle">
				<?php echo $content['TaskContent']['progress_rate']; ?>%
			</td>

			<td class="col-xs-4 col-ms-3 col-md-3 col-lg-3 task-index-content-text-middle">
				<span class="nc-groups-avatar-list">
					<?php $count = 0; ?>
					<?php foreach ($content['TaskCharge'] as $userInCharge): ?>
						<?php
						$count++;
						echo $this->DisplayUser->avatar($userInCharge, [], 'user_id');
						if ($count > TaskContent::LIST_DISPLAY_NUM):
							echo '...';
							break;
						endif;
						?>
					<?php endforeach; ?>
				</span>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
