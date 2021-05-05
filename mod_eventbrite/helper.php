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

require_once('libraries/php/eventbrite-sdk-php/HttpClient.php');

class modEventbriteHelper{

	private $client;

	private $main_org_id = '258029550293';

	public function getParams($params, $type)
	{
		return $params->get($type);
	}

	public function generateToken(string $apikey)
	{
		$this->client = new HttpClient($apikey);
		return $this->client;
	}

	public function getEvents(string $org_id, string $key)
	{
		$this->client = $this->generateToken($key);
		$getEventsList = $this->client->get(
			sprintf('/organizations/%s/events/', $this->main_org_id), 
			array('venue', 'organizer', 'format'), 
			array('status' => 'live')
		);
		foreach($getEventsList['events'] as $k => $v){
			if($v['organizer']['id'] != $org_id){
				unset($getEventsList['events'][$k]);
			}
		}
		if(empty($getEventsList['events'])){
			return false;
		} else {
			return array_values($getEventsList['events']);
		}
	}

	public function mapTag($tag)
	{
		switch($tag){
			case 'Seminar':
				return 'Webinar';
				break;
			default:
				return $tag;
				break;
		}
	}

	public function generateStyles($event)
	{
		?>
		<style>
			.event-<?= $event['id']; ?> {
				background-image: url('<?= $event['logo']['url']; ?>');
			}
		</style>
		<?php
	}

}
