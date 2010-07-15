<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: browse.tpl 6516 2010-06-23 01:15:53Z shaun $
 * @author	   John
 */
?>
<!--
<div class="headline">
  <h2>
    <?php echo $this->translate('Groups');?>
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
  <!--
  <?php if( $this->viewer()->getIdentity() ): ?>
  <br />
    <div class="quicklinks">
      <ul>
        <li>
          <?php echo $this->htmlLink(array('route' => 'group_general', 'action' => 'create'), $this->translate('Create New Group'), array(
            'class' => 'buttonlink icon_group_new'
          )) ?>
        </li>
      </ul>
    </div>
  <?php endif; ?>-->
</div>

  <div class='layout_middle'>
  <div class="headline_header">
	<img src='./application/modules/Group/externals/images/group_group48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Groups');?></div>
    <div class="smallheadline"><?php echo $this->translate('Find a group to join or create a new one and invite your friends.');?></div>
</div>
<div>
  <?php echo $this->formFilter->setAttrib('class', 'global_search_box')->render($this) ?>
 </div>
 <div style='padding-top:20px;padding-right:10px;width:680px'>
    <?php if( count($this->paginator) > 0 ): ?>

    <ul class='groups_browse'>
      <?php foreach( $this->paginator as $group ): ?>
        <li>
          <div class="groups_photo">
            <?php echo $this->htmlLink($group->getHref(), $this->itemPhoto($group, 'thumb.normal')) ?>
          </div>
          <div class="groups_info">
            <div class="groups_title">
              <h3><?php echo $this->htmlLink($group->getHref(), $group->getTitle()) ?></h3>
            </div>
            <div class="groups_members">
              <?php echo $this->translate(array('%s member', '%s members', $group->membership()->getMemberCount()),$this->locale()->toNumber($group->membership()->getMemberCount())) ?>
              <?php echo $this->translate('led by');?> <?php echo $this->htmlLink($group->getOwner()->getHref(), $group->getOwner()->getTitle()) ?>
            </div>
            <div class="groups_desc">
              <?php echo $this->viewMore($group->getDescription()) ?>
            </div>
          </div>
          <div class="groups_options">
            <?php if( $this->viewer()->getIdentity() ): ?>
              <?php if( $group->isOwner($this->viewer()) ): ?>
                <?php echo $this->htmlLink(array('route' => 'group_specific', 'action' => 'edit', 'group_id' => $group->getIdentity()), $this->translate('Edit Group'), array(
                  'class' => 'buttonlink icon_group_edit'
                )) ?>
                <?php echo $this->htmlLink(array('route' => 'group_specific', 'action' => 'delete', 'group_id' => $group->getIdentity()), $this->translate('Delete Group'), array(
                  'class' => 'buttonlink REMsmoothbox icon_group_delete'
                )) ?>
              <?php elseif( !$group->membership()->isMember($this->viewer(), null) ): ?>
                <?php echo $this->htmlLink(array('route' => 'group_extended', 'controller' => 'member', 'action' => 'join', 'group_id' => $group->getIdentity()), $this->translate('Join Group'), array(
                  'class' => 'buttonlink smoothbox icon_group_join'
                )) ?>
              <?php elseif( $group->membership()->isMember($this->viewer(), true) ): ?>
                <?php echo $this->htmlLink(array('route' => 'group_extended', 'controller' => 'member', 'action' => 'leave', 'group_id' => $group->getIdentity()), $this->translate('Leave Group'), array(
                  'class' => 'buttonlink smoothbox icon_group_leave'
                )) ?>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
    
    <?php else: ?>
      <div class="tip">
        <span>
          <?php echo $this->translate('Tip: %1$sClick here%2$s to create the first group!', "<a href='".$this->url(array('action' => 'create'), 'group_general', true)."'>", '</a>'); ?>
        </span>
      </div>
    <?php endif; ?>

    <?php echo $this->paginationControl($this->paginator, null, null, array(
      'query' => $this->formValues
    )); ?>
  </div>


