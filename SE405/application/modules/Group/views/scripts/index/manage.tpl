<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manage.tpl 7244 2010-09-01 01:49:53Z john $
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
<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?> 
<!--
<div class='layout_right'>
  <?php echo $this->formFilter->setAttrib('class', 'filters')->render($this) ?>
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
  <?php endif; ?>
</div>
-->
  <div class='layout_middle'>
  <div class="headline_header">
	<img src='./application/modules/Group/externals/images/group_group48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <a href='/index.php/groups/manage'><?php echo $this->translate('My Groups');?></a>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/groups'>Back to Groups</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Create a new group, invite moms, view all of your groups and join in on the conversation.');?></div>
</div>
<div>
    <ul>
      <li>
        <?php echo $this->htmlLink(array('route' => 'group_general', 'action' => 'create'), $this->translate('Create New Group'), array(
            'class' => 'buttonlink icon_group_new'
          )) ?>
      </li>
    </ul>
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
              <?php if( $group->isOwner($this->viewer()) ): ?>
                <?php echo $this->htmlLink(array('route' => 'group_specific', 'action' => 'edit', 'group_id' => $group->getIdentity()), $this->translate('Edit Group'), array(
                  'class' => 'buttonlink icon_group_edit'
                )) ?>
                <?php echo $this->htmlLink(array('route' => 'group_specific', 'action' => 'delete', 'group_id' => $group->getIdentity()), $this->translate('Delete Group'), array(
                  'class' => 'buttonlink icon_group_delete'
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
            </div>
            
          </li>
        <?php endforeach; ?>
      </ul>
      <?php if( count($this->paginator) > 1 ): ?>
        <div>
          <?php echo $this->paginationControl($this->paginator); ?>
        </div>
      <?php endif; ?>

    <?php else: ?>
      <div class="tip">
        <span>
          <?php echo $this->translate('Tip: %1$sClick here%2$s to create a group or %3$sbrowse%2$s for groups to join!', "<a href='".$this->url(array('action' => 'create'), 'group_general', true)."'>", '</a>', "<a href='".$this->url(array('action' => 'browse'), 'group_general', true)."'>"); ?>
        </span>
      </div>
    <?php endif; ?>

  </div>
  </div>



