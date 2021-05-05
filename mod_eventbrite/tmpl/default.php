<?php
defined('_JEXEC') or die;
define('MOD_EVENTBRITE', '/modules/mod_eventbrite');
$mod = new modEventbriteHelper;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

$doc = Factory::getDocument();
$doc->addStyleSheet(MOD_EVENTBRITE.'/assets/css/mod_eventbrite.css');

?>

<div class="uk-card uk-card-default uk-card-body uk-padding-small uk-margin-top">
    <h3 class="uk-card-title uk-margin-top uk-margin-remove-bottom">Our next event</h3>
    <div class="uk-panel">
        <?php for($x = 0; $x < $numberOfEvents; $x++){
            $event = $events[$x];
            $mod->generateStyles($event);
            ?>
                <a href="<?= $event['url']; ?>" title="<?= $event['name']['text']; ?>" target="_blank">
                    <div class="event--item event-<?= $event['id']; ?> uk-background-cover uk-background-norepeat uk-position-relative">
                        <div class="uk-grid uk-margin-remove-left" uk-grid>
                            <div class="uk-padding-remove">
                                <span class="uk-position-top-left event--item__tag"><?= $mod->mapTag($event['format']['short_name']); ?></span>
                            </div>
                            <div>
                                <span class="uk-position-top-right event--item__date"><?= date('d/m/y H:i', strtotime($event['start']['local'])); ?></span>
                            </div>
                        </div>
                        <div class="uk-position-bottom-center uk-text-center event--item__title"><?= $event['name']['text']; ?></div>
                    </div>
                </a>
        <?php } ?>
    </div>
</div>
