<?php
// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Factory;

require_once(dirname(__FILE__).'/helper.php');

$helper = new modEventbriteHelper();
$key = $helper->getParams($params, 'apikey');
$org = $helper->getParams($params, 'organisation');
$events = $helper->getEvents($org, $helper->getParams($params, 'apikey'));
$numberOfEvents = $helper->getParams($params, 'numberOfEvents');
require ModuleHelper::getLayoutPath('mod_eventbrite');
