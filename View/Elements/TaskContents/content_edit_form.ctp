<?php
/**
 * TaskContents charge edit content element
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<div class="form-group">
	<?php echo $this->NetCommonsForm->wysiwyg('TaskContent.content', array(
		'label' => __d('tasks', 'Content'),
		'required' => true,
	)); ?>
</div>
