<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Exception\ExceptionHandler;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Pagination\Pagination;
use Joomla\CMS\Document\Document;
use Joomla\CMS\Date\Date;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\User\User;
use Joomla\CMS\User\UserHelper;
use Joomla\CMS\Mail\Mail;
use Joomla\CMS\Input\Input;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Registry\Registry;
use Joomla\CMS\Response\JsonResponse;

class modEventbriteHelper{

	private $base_url = 'https://www.eventbriteapi.com/v3/';

	public function getParams($params, $type)
	{
		return $params->get($type);
	}

	private function restCall($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);
		$err = curl_error($ch);
		curl_close($ch);
		if($err){
			Log::add($err, Log::DEBUG, 'mod-eventbrite');
			return false;
		} else {
			if($response){
				return json_decode($response);
			} else {
				Log::add('No valid response given', Log::DEBUG, 'mod-eventbrite');
				return false;
			}
		}
	}

	public function getEvents(string $org_id = '', string $apikey = '')
	{
		$url = $this->base_url.'organizations/'.$org_id.'/events/?expand=venue,organizer&status=live&token='.$apikey;
		return $this->restCall($url);
	}

}
