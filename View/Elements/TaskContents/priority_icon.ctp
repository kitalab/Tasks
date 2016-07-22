<?php
/**
 * TaskContents priority icon select status for view element
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@withone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php
$iconPath = '';

if ($style === false) {
	$style = '';
}
switch ($priority) {
	case 1;
		$iconPath = '/net_commons/img/title_icon/10_060_one_star.svg';
		break;
	case 2;
		$iconPath = '/net_commons/img/title_icon/10_061_two_stars.svg';
		break;
	case 3;
		$iconPath = '/net_commons/img/title_icon/10_062_three_stars.svg';
		break;
}
?>

<img src="<?php echo $iconPath; ?>"
	 ng-src="<?php echo $iconPath; ?>"
	 class="nc-title-icon"
	 style="<?php echo $style ?>">