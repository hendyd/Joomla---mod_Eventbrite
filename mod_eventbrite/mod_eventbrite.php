<?php
// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Factory;

require_once(dirname(__FILE__).'/helper.php');

$helper = new modStaffSpotlightHelper;
//$template = $helper->getParams($params, 'template');
$apikey = $helper->getParams($params, 'apikey');
$organisation = $helper->getParams($params, 'organisation');
$events = $helper->getEvents($organisation, $apikey);

//require ModuleHelper::getLayoutPath('mod_eventbrite', $template);
require ModuleHelper::getLayoutPath('mod_eventbrite');
