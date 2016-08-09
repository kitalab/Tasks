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

<table class="table table-hover">
	<tbody>
	<?php foreach ($taskContents as $content): ?>
		<tr>
			<?php if ($content['TaskContent']['is_completion'] === true): ?>
				<td class="col-xs-1 col-ms-1 col-md-1 col-lg-1" style="vertical-align: middle;">
					<div data-toggle="buttons">
						<?php echo $this->NetCommonsForm->input(
							'<span class="glyphicon glyphicon-ok" style="color: #00AA00"></span>', array(
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
				); ?>
				<td class="col-xs-1 col-ms-1 col-md-1 col-lg-1" style="vertical-align: middle;">
					<div data-toggle="buttons">
						<?php echo $this->NetCommonsForm->input(
							'<span class="glyphicon glyphicon-ok" style="color: #BBBBBB"></span>', array(
								'type' => 'button',
								'onClick' => "submit();",
								'checked' => true,
								'class' => 'btn btn-default',
								'div' => false,
								'value' => TaskContent::TASK_COMPLETION_PROGRESS_RATE
							)
						); ?>
					</div>
				</td>
				<?php echo $this->NetCommonsForm->end(); ?>
			<?php endif; ?>

			<?php
			$color = array(
				1 => 'color: #BBBBBB',
				2 => 'color: #f0ad4e',
				3 => 'color: #FF0000',
				4 => '',
			);
			?>

			<td class="col-xs-2 col-ms-2 col-md-2 col-lg-2"
				style="vertical-align: middle; <?php echo $color[$content['TaskContent']['date_color']]; ?>">
				<?php if (empty($content['TaskContent']['priority'])): ?>
					<?php if (empty($content['TaskContent']['task_end_date'])): ?>
						<?php echo h('--:--'); ?>
					<?php else: ?>
						<?php echo $this->Date->dateFormat($content['TaskContent']['task_end_date']); ?>
					<?php endif; ?>
				<?php else: ?>
					<div style="position: absolute">
						<?php if (empty($content['TaskContent']['task_end_date'])): ?>
							<?php echo h('--:--'); ?>
						<?php else: ?>
							<?php echo $this->Date->dateFormat($content['TaskContent']['task_end_date']); ?>
						<?php endif; ?>
					</div>
					<?php echo $this->element('TaskContents/priority_icon', array(
							'priority' => $content['TaskContent']['priority'],
							'style' => "position: relative; bottom: 12px;"
						)
					); ?>
				<?php endif; ?>
			</td>

			<td class="col-xs-4 col-ms-4 col-md-5 col-lg-5" style="vertical-align: middle;">
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

			<td class="col-xs-1 col-ms-1 col-md-1 col-lg-1" style="vertical-align: middle; text-align: right">
				<?php echo $content['TaskContent']['progress_rate']; ?>%
			</td>

			<td class="" align="col-xs-4 col-ms-3 col-md-3 col-lg-3" style="vertical-align: middle;">
				<span class="nc-groups-avatar-list">
					<?php $count = 0; ?>
					<?php foreach ($content['TaskCharge'] as $userInCharge): ?>
						<?php
						$count++;
						echo $this->DisplayUser->avatar($userInCharge, [], 'user_id');
						if ($count > 5):
							echo "...";
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
