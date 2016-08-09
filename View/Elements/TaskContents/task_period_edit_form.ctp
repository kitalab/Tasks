<?php
/**
 * TaskContents task period edit form element
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>
<div class="form-group" ng-controller="TaskIsDate"
	 ng-init="initialize(<?php echo $taskContent['TaskContent']['date_set_flag']; ?>)">
	<div>
		<?php echo $this->NetCommonsForm->label(
			'TaskContent.date_set_flag',
			__d('tasks', 'Implementation period')
		); ?>
	</div>

	<?php
	$options = array(
		'0' => __d('Tasks', 'No Date'),
		'1' => __d('Tasks', 'Set Date'),
	);
	echo $this->NetCommonsForm->radio(
		'TaskContent.date_set_flag', $options, array(
			'value' => $taskContent['TaskContent']['date_set_flag'],
			'ng-click' => 'switchDeadline($event)',
			'outer' => false,
		)
	);
	?>

	<div ng-show="deadline==1" style="margin-bottom: 10px;">
		<?php
		$pickerOpt = str_replace('"', "'", json_encode(array(
					'format' => 'YYYY-MM-DD',
				)
			)
		);

		$initStartDate = sprintf(
			"%s = '%s'; ", 'TaskContent.task_start_date',
			substr($taskContent['TaskContent']['task_start_date'], 0, 10)
		);
		$initEndDate = sprintf(
			"%s = '%s'; ", 'TaskContent.task_end_date',
			substr($taskContent['TaskContent']['task_end_date'], 0, 10)
		);
		?>
		<div class="form-inline">
			<div class="input-group" style="margin-bottom: 10px">
				<?php echo $this->NetCommonsForm->input('TaskContent.task_start_date', array(
						'type' => 'datetime',
						'datetimepicker-options' => $pickerOpt,
						'ng-model' => 'TaskContent.task_start_date',
						'data-toggle' => 'dropdown',
						'label' => false,
						'error' => false,
						'div' => false,
						'class' => 'form-control',
						'placeholder' => 'yyyy-mm-dd',
						'convert_timezone' => false,
						'ng-init' => $initStartDate
					)
				); ?>
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-minus"></span>
				</span>
				<?php echo $this->NetCommonsForm->input('TaskContent.task_end_date', array(
						'type' => 'datetime',
						'datetimepicker-options' => $pickerOpt,
						'ng-model' => 'TaskContent.task_end_date',
						'data-toggle' => 'dropdown',
						'label' => false,
						'error' => false,
						'div' => false,
						'class' => 'form-control',
						'placeholder' => 'yyyy-mm-dd',
						'ng-init' => $initEndDate
					)
				); ?>
			</div>
			<?php echo $this->NetCommonsForm->error('TaskContent.task_start_date'); ?>
			<?php echo $this->NetCommonsForm->error('TaskContent.task_end_date'); ?>
		</div>
	</div>
</div>
