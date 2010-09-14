<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     Sami
 */
?>

<h3>
  <?php echo $this->translate('Event Details') ?>
</h3>
<div id='event_stats'>
  <ul>
    <?php if (!empty($this->subject()->description)):?>
    <li>
      <?php echo nl2br($this->subject()->description);?>
    </li>
    <?php endif ?>
    <li class="event_date">
      <?php if ($this->subject()->starttime == $this->subject()->endtime): ?>
        <div class="label"><?php echo $this->translate('Date')?></div> <div class="event_stats_content"><?php echo strftime("%b %d, %Y",strtotime($this->subject()->starttime))?></div>
        <div class="label"><?php echo $this->translate('Time')?></div> <div class="event_stats_content"><?php echo strftime("%l:%M %p",strtotime($this->subject()->starttime))?></div>
      <?php else: ?>  
        <div class="event_stats_content">
          <?php echo str_replace('at', '@', $this->dateTime($this->subject()->starttime));?> -
          <br /><?php echo str_replace('at', '@', $this->dateTime($this->subject()->endtime));?>
        </div>
      <?php endif ?>
    </li>
    
    <?php if (!empty($this->subject()->location)):?>
    <li>
      <div class="label"><?php echo $this->translate('Where')?></div>
      <div class="event_stats_content"><?php echo $this->subject()->location; ?> <?php echo $this->htmlLink('http://maps.google.com/?q='.urlencode($this->subject()->location), $this->translate('Map'), array('target' => 'blank')) ?></div>
    </li>
    <?php endif;?>
    
    <?php if (!empty($this->subject()->host)):?>
    <?php if ($this->subject()->host != $this->subject()->getParent()->getTitle()):?>
    <li>
      <div class="label"><?php echo $this->translate('Host');?></div>
      <div class="event_stats_content"><?php echo $this->subject()->host; ?></div>
    </li>
   <?php endif;?>
    <li>
      <div class="label"><?php echo $this->translate('Led by');?></div>
      <div class="event_stats_content"><?php echo $this->subject()->getParent()->__toString(); ?></div>
    </li>
    <?php endif;?>
  
    <li class="event_stats_info">
      <div class="label"><?php echo $this->translate('RSVPs');?></div>
      <div class="event_stats_content">
        <ul>
          <li>
            <?php echo $this->locale()->toNumber($this->subject()->getAttendingCount()) ?>
            <span><?php echo $this->translate('attending');?></span>
          </li>
          <li>
            <?php echo $this->locale()->toNumber($this->subject()->getMaybeCount()) ?>
            <span><?php echo $this->translate('maybe attending');?></span>
          </li>
          <li>
            <?php echo $this->locale()->toNumber($this->subject()->getNotAttendingCount()) ?>
            <span><?php echo $this->translate('not attending');?></span>
          </li>
        </ul>
      </div>
    </li>
  </ul>
</div>