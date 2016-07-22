<?php
/**
 * TaskContents achievement rate progress bar for view element
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<div class="pull-right">
	<div class="clearfix">
		<div class="pull-left progress-min-scale-xs">
			<div class="progress progress-min-width-xs"
				 style="width: <?php echo $progressWidth; ?>px; margin-bottom: 5px; height: 20px;">
				<div class="progress-bar progress-bar-info" style="width: <?php echo $achievedValue; ?>%;">
					<?php echo $achievedValue; ?>%
				</div>
			</div>
		</div>
	</div>
</div>
