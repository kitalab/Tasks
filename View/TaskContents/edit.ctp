<?php
/**
 * TaskContent edit template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php
echo $this->Html->script(
	array(
		'/tasks/js/tasks.js',
	),
	array(
		'plugin' => false,
		'once' => true,
		'inline' => false
	)
);
?>

<div class="taskContents form"
	 ng-controller="TaskContent"
	 ng-init="initialize(<?php echo h(json_encode($this->viewVars['taskContent'])); ?>)">
	<article>

		<h1><?php echo h(__d('tasks', 'Task')); ?></h1>

		<div class="panel panel-default">

			<?php echo $this->NetCommonsForm->create(
				'TaskContent',
				array(
					'inputDefaults' => array(
						'div' => 'form-group',
						'class' => 'form-control',
						'error' => false,
					),
					'div' => 'form-control',
					'novalidate' => true
				)
			);
			?>
			<?php echo $this->NetCommonsForm->input('key', array('type' => 'hidden')); ?>
			<?php echo $this->NetCommonsForm->hidden('Frame.id', array(
				'value' => Current::read('Frame.id'),
			)); ?>
			<?php echo $this->NetCommonsForm->hidden('Block.id', array(
				'value' => Current::read('Block.id'),
			)); ?>

			<div class="panel-body">

				<fieldset>

					<?php echo $this->NetCommonsForm->input(
						'TaskContent.title', array(
						'type' => 'text',
						'required' => 'required',
						'label' => __d('tasks', 'Title')
					)); ?>

					<?php echo $this->Category->select('TaskContent.category_id', array('empty' => true)); ?>

					<?php echo $this->element('TaskContents/select_priority'); ?>
					
					<?php echo $this->element('TaskContents/task_period_edit_form'); ?>

					<?php echo $this->element('TaskContents/charge_edit_form'); ?>

					<?php echo $this->element('TaskContents/content_edit_form'); ?>

					<?php
					echo $this->NetCommonsForm->input('TaskContent.is_enable_mail', array(
						'type' => 'checkbox',
						'checked' => false,
						'label' => false,
						'div' => false,
						'class' => 'text-left',
						'style' => 'float: left',
					));
					?>
					<label style='float: left; font-weight: 400; font-size: 14px'>
						<?php echo __d('tasks', 'Inform in advance by mail'); ?>
					</label>

					<?php
					$options = array(
						'0' => __d('tasks', 'Two days previously'),
					);
					?>

					<?php
					echo $this->NetCommonsForm->select('TaskContent.email_send_timing', $options, array(
						'value' => __d('tasks', 'Two days previously'),
						'class' => 'form-control',
						'empty' => false,
						'required' => true,
						'div' => false,
						'style' => 'float: left',
					));
					?>

					<?php
					echo $this->NetCommonsForm->input('TaskContent.use_calendar', array(
						'type' => 'checkbox',
						'checked' => false,
						'label' => false,
						'div' => false,
						'class' => 'text-left',
						'style' => 'float: left; margin-top: 13px',
					));
					?>
					<label style='margin-top: 10px; float: left; font-weight: 400; font-size: 14px'>
						<?php echo __d('tasks', 'Use calendar'); ?>
					</label>
				</fieldset>

				<hr/>

				<div class="form-group" name="inputCommentArea">
					<div class="col-xs-12 col-sm-10 col-sm-offset-1">
						<?php echo $this->Workflow->inputComment('TaskContent.status'); ?>
					</div>
				</div>

			</div>

			<div class="panel-footer text-center">
				<?php echo $this->Button->cancelAndSaveAndSaveTemp(); ?>
			</div>

			<?php echo $this->NetCommonsForm->end(); ?>

			<?php if ($this->request->params['action'] === 'edit') : ?>
				<div class="panel-footer text-right">
					<?php echo $this->element('TaskContents/delete_form'); ?>
				</div>
			<?php endif; ?>

		</div>

	</article>
</div>
