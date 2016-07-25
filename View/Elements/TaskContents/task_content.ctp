<?php
/**
 * TaskContentstask content select status for view element
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
		<tr >
			<td class="btn-group col-xs-1 col-ms-1 col-md-1 col-lg-1" style="vertical-align: middle;">
				<div data-toggle="buttons" >
					<label class="btn btn-default form-group" ng-controller="SampleCtrl" ng-click="methodA('<?php echo $content['TaskContent']['id'] ?>')">
						<input type="checkbox" autocomplete="off" checked="" ng-model="taskContents.isCompletion">
								<span class="glyphicon glyphicon-ok" style="color: #BBBBBB">
								</span>
					</label>
				</div>
			</td>

			<td class="col-xs-1 col-ms-1 col-md-1 col-lg-1" style="vertical-align: middle;">
				<?php if (empty($content['TaskContent']['priority'])): ?>
					<div>
						<?php echo $this->Date->dateFormat($content['TaskContent']['task_end_date']) ?>
					</div>
				<?php else: ?>
					<div style="position: absolute">
						<?php echo $this->Date->dateFormat($content['TaskContent']['task_end_date']); ?>
					</div>
					<?php echo $this->element('TaskContents/priority_icon', array(
						'priority' => $content['TaskContent']['priority'],
						'style' => "position: relative; bottom: 12px;"
					)); ?>
				<?php endif; ?>
			</td>

			<td class="col-xs-5 col-ms-5 col-md-6 col-lg-6" style="vertical-align: middle;">
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
						if ($count >= 5):
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
