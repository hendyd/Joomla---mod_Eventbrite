<?php
// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Factory;

require_once(JPATH_SITE.'/components/com_jsn/helpers/helper.php');
require_once(dirname(__FILE__).'/helper.php');

$helper = new modStaffSpotlightHelper;
$existing_user = Factory::getUser();
if($existing_user->guest):
	$guest = true;
else:
	$guest = false;
endif;
$template = $helper->getParams($params, 'template');
$showName = $helper->getParams($params, 'displayName');
$showEmail = $helper->getParams($params, 'displayEmail');
$showPhoto = $helper->getParams($params, 'displayPhoto');
$showContent = $helper->getParams($params, 'displayContent');
$showRegions = $helper->getParams($params, 'displayRegions');
$showForm = $helper->getParams($params, 'displayForm');
$showPosition = $helper->getParams($params, 'displayPosition');
if($showPhoto):
	$photoType = $helper->getParams($params, 'displayPhotoType');
	$photoPosition = $helper->getParams($params, 'displayPhotoPosition');
	if($photoPosition == 'right' || $photoPosition == 'left'):
		$photoSize = $helper->getParams($params, 'displayPhotoSize');
		$photoHeight = $helper->getParams($params, 'displayPhotoHeight');
	endif;
endif;

if($template == 'dynamic'):
	if(!$existing_user->guest):
		if(!@include_once JPATH_BASE.'/includes/SugarCode.php'):
			echo 'not included';
		else:
			$getContact = $helper->getCRMData($base_url, $oauth2_token_response, 'Contacts', '', array('email1' => $existing_user->email, 'platform_c' => 'sbhnw'));
			$getAccount = $helper->getCRMData($base_url, $oauth2_token_response, 'Accounts', $getContact->records[0]->account_id);
			$region_user = $helper->getRegionRep($getAccount->account_region_c);
			if(!empty($region_user)):
				$user = JsnHelper::getUser($region_user);
			endif;
		endif;
	endif;
else:
	$user = JsnHelper::getUser($helper->getParams($params, 'user'));
endif;

switch($showContent){
	case 'blurb':
		$user_content = '<p>'.$user->blurb.'</p>';
		break;
	case 'quote':
		$user_content = '<p>'.$user->quote.'</p>';
		break;
}

$isAdmin = $helper->isAdmin($existing_user);

require ModuleHelper::getLayoutPath('mod_staffspotlight', $template);
