<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6512 2010-06-23 00:27:01Z shaun $
 * @access	   John
 */
?>

<h3><?php echo $this->translate('Upcoming Events');?></h3>
<ul id="events-upcoming">
  <?php foreach( $this->paginator as $event ): ?>
    <li>
      <?php echo $event->__toString() ?>
      <div class="events-upcoming-date">
        <?php //echo strtotime($event->starttime) - time() ?>
        <?php echo $this->timestamp(strtotime($event->starttime), array('class'=>'eventtime')) ?>
      </div>
    </li>
  <?php endforeach; ?>
</ul>