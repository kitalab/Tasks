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
	 ng-init="initialize(<?php echo $this->request->data['TaskContent']['is_date_set']; ?>)">
	<div>
		<?php echo $this->NetCommonsForm->label(
			'TaskContent.is_date_set',
			__d('tasks', 'Implementation period')
		); ?>
	</div>

	<?php
	$options = array(
		'0' => __d('Tasks', 'No Date'),
		'1' => __d('Tasks', 'Set Date'),
	);
	echo $this->NetCommonsForm->radio(
		'TaskContent.is_date_set', $options, array(
			'value' => $this->request->data['TaskContent']['is_date_set'],
			'ng-click' => 'switchIsDate($event)',
			'outer' => false,
		)
	);
	?>

	<div ng-show="flag==1" class="task-content-margin-2">
		<?php
		$pickerOpt = str_replace('"', "'", json_encode(array(
					'format' => 'YYYY-MM-DD',
				)
			)
		);

		$initStartDate = sprintf(
			'%s = \'%s\'; ', 'TaskContent.task_start_date',
			substr($this->request->data['TaskContent']['task_start_date'], 0, 10)
		);
		$initEndDate = sprintf(
			'%s = \'%s\'; ', 'TaskContent.task_end_date',
			substr($this->request->data['TaskContent']['task_end_date'], 0, 10)
		);
		?>
		<div class="form-inline">
			<div class="input-group task-content-margin-2">
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
