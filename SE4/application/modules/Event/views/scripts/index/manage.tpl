<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manage.tpl 6159 2010-06-05 02:12:43Z alex $
 * @author     Sami
 */
?>
<!--
<div class="headline">
  <h2>
    <?php echo $this->translate('Events');?>
  </h2>
  <div class="tabs">
    <?php
      // Render the menu
      echo $this->navigation()
        ->menu()
        ->setContainer($this->navigation)
        ->render();
    ?>
  </div>
</div>
-->
<div class='layout_right'>
  <div class="generic_layout_container layout_core_ad_campaign">
<script type="text/javascript">

 function processClick(adcampaign_id, ad_id) {
    (new Request.JSON({
      'format': 'json',
      'url' : '/utility/advertisement',
      'data' : {
        'format' : 'json',
        'adcampaign_id' : adcampaign_id,
        'ad_id' : ad_id
      },
      'onRequest' : function(){
      },
      'onSuccess' : function(responseJSON, responseText)
      {
      }
    })).send();

  }
</script>
<div style="float:right;color:#B2BCC0;font-family:Georgia;font-size:10px;">Advertisement&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="clear:both;"></div>
<div style="vertical-align: middle;" onclick="javascript:processClick(2, 2)">
  <a href='' target='_blank'><img src='/public/user/1000000/1000/1/3.gif'/></a></div></div>

<div class="generic_layout_container layout_core_ad_campaign">
<script type="text/javascript">

 function processClick(adcampaign_id, ad_id) {
    (new Request.JSON({
      'format': 'json',
      'url' : '/utility/advertisement',
      'data' : {
        'format' : 'json',
        'adcampaign_id' : adcampaign_id,
        'ad_id' : ad_id
      },
      'onRequest' : function(){
      },
      'onSuccess' : function(responseJSON, responseText)
      {
      }
    })).send();

  }

</script>
<div style="float:right;color:#B2BCC0;font-family:Georgia;font-size:10px;">Advertisement&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="clear:both;"></div>
<div style="vertical-align: middle;" onclick="javascript:processClick(3, 3)">
  <a href='' target='_blank' style='border-bottom: 1px solid #DDDDDD'><img src='/public/user/1000000/1000/1/5.gif'/></a></div></div>
</div>
<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Event/externals/images/event_event48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('My Events');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/events'>Back to Events</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Below are all of the events that you\'ve created or been invited to.');?></div>
</div>
<div>
    <ul>
      <li>
        <?php echo $this->htmlLink(array('route' => 'event_general', 'action' => 'create'), $this->translate('Create New Event'), array(
          'class' => 'buttonlink icon_photos_new'
        )) ?>
      </li>
    </ul>
  </div>
<div style='padding-top:20px;padding-right:10px;width:690px'>
<?php if( count($this->paginator) > 0 ): ?>

    <ul class='events_browse'>
      <?php foreach( $this->paginator as $event ): ?>
        <li>
          <div class="events_photo">
            <?php echo $this->htmlLink($event->getHref(), $this->itemPhoto($event, 'thumb.normal')) ?>
          </div>
          <div class="events_info">
            <div class="events_title">
              <h3><?php echo $this->htmlLink($event->getHref(), $event->getTitle()) ?></h3>
            </div>
	    <div class="events_members">
	      <?php echo $this->dateTime($event->starttime);?>
	    </div>
            <div class="events_members">
              <?php echo $this->translate(array('%s member', '%s members', $event->membership()->getMemberCount()),$this->locale()->toNumber($event->membership()->getMemberCount())) ?>
              <?php echo $this->translate('led by');?> <?php echo $this->htmlLink($event->getOwner()->getHref(), $event->getOwner()->getTitle()) ?>
            </div>
            <div class="events_desc">
              <?php echo $event->getDescription() ?>
            </div>
          </div>
          <div class="events_options">
            <?php if( $this->viewer() && $event->isOwner($this->viewer()) ): ?>
              <?php echo $this->htmlLink(array('route' => 'event_specific', 'action' => 'edit', 'controller'=>'event', 'event_id' => $event->getIdentity()), $this->translate('Edit Event'), array(
                'class' => 'buttonlink icon_event_edit'
              )) ?>
            <?php endif; ?>
            <?php if( $this->viewer() && !$event->membership()->isMember($this->viewer(), null) ): ?>
              <?php echo $this->htmlLink(array('route' => 'event_extended', 'controller'=>'member', 'action' => 'join', 'event_id' => $event->getIdentity()), $this->translate('Join Event'), array(
                'class' => 'buttonlink smoothbox icon_event_join'
              )) ?>
              <?php elseif( $this->viewer() && $event->isOwner($this->viewer()) ): ?>
                <?php echo $this->htmlLink(array('route' => 'event_specific', 'action' => 'delete', 'event_id' => $event->getIdentity()), $this->translate('Delete Event'), array(
                  'class' => 'buttonlink REMsmoothbox icon_event_delete'
                )) ?>
            <?php elseif( $this->viewer() && $event->membership()->isMember($this->viewer()) ): ?>
              <?php echo $this->htmlLink(array('route' => 'event_extended', 'controller'=>'member', 'action' => 'leave', 'event_id' => $event->getIdentity()), $this->translate('Leave Event'), array(
                'class' => 'buttonlink smoothbox icon_event_leave'
              )) ?>
            <?php endif; ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>

    <?php if( $this->paginator->count() > 1 ): ?>
      <?php echo $this->paginationControl($this->paginator, null, null, array(
        'query' => array('view'=>$this->view, 'text'=>$this->text)
      )); ?>
    <?php endif; ?>
    
<?php else: ?>
  <div class="tip">
    <span>
       <?php echo $this->translate('Tip: %1$sClick here%2$s to create a event or %3$sbrowse%2$s for events to join!', "<a href='".$this->url(array('action' => 'create'), 'event_general', true)."'>", '</a>', "<a href='".$this->url(array(), 'event_upcoming', true)."'>"); ?>
    </span>
  </div>
<?php endif; ?>
</div>

