<?php
/**
 * TaskMailSettings Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Yuto Kitatsuji <kitatsuji.yuto@wihtone.co.jp>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('MailSettingsController', 'Mails.Controller');

/**
 * TaskMailSettings Controller
 *
 * @author Yuto Kitatsuji <kitatsuji.yuto@wihtone.co.jp>
 * @package NetCommons\Tasks\Controller
 */
class TaskMailSettingsController extends MailSettingsController {

/**
 * use helpers
 *
 * @var array
 */
	public $helpers = array(
		'Blocks.BlockRolePermissionForm',
		'Blocks.BlockTabs' => array(
			'mainTabs' => array(
				'block_index',
			),
			'blockTabs' => array('block_settings', 'mail_settings', 'role_permissions'),
		),
		'Mails.MailForm',
	);

/**
 * beforeFilter
 *
 * @return void
 * @throws NotFoundException
 * @see NetCommonsAppController::beforeFilter()
 */
	public function beforeFilter() {
		parent::beforeFilter();

		// メール設定 多段の場合にセット
		$this->MailSettings->permission =
				array('mail_content_receivable', 'mail_answer_receivable');
		$this->MailSettings->typeKeys =
				array(MailSettingFixedPhrase::DEFAULT_TYPE, 'reminder');

		$this->backUrl = NetCommonsUrl::backToPageUrl(true);
	}
}