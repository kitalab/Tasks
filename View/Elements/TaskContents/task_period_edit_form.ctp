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

<div class="form-group" style="margin-bottom: 10px;">
	<div>
		<?php echo $this->NetCommonsForm->label(
			'Task.period',
			__d('tasks', 'Implementation period')
		); ?>
	</div>
	<?php
	$pickerOpt = str_replace('"', "'", json_encode(array(
		'format' => 'YYYY-MM-DD',
	)));
	?>

	<div>
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
					'ng-init' => sprintf(
						"%s = '%s'; ", 'TaskContent.task_start_date',
						substr($taskContent['TaskContent']['task_start_date'], 0, 10)
					),
				)); ?>
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
					'ng-init' => sprintf(
						"%s = '%s'; ", 'TaskContent.task_end_date',
						substr($taskContent['TaskContent']['task_end_date'], 0, 10)
					),
				)); ?>
			</div>
			<?php echo $this->NetCommonsForm->error('TaskContent.task_start_date'); ?>
			<?php echo $this->NetCommonsForm->error('TaskContent.task_end_date'); ?>
		</div>
	</div>
</div>
