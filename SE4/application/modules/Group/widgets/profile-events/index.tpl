<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6516 2010-06-23 01:15:53Z shaun $
 * @author		 Sami
 */
?>

<div class="group_album_options">
  <?php if( $this->paginator->getTotalItemCount() > 0 ): ?>
    <?php echo $this->htmlLink(array(
        'route' => 'event_general',
      ), $this->translate('View All Events'), array(
        'class' => 'buttonlink icon_group_photo_view'
    )) ?>
  <?php endif; ?>

  <?php if( $this->canAdd ): ?>
    <?php echo $this->htmlLink(array(
        'route' => 'event_general',
        'controller' => 'event',
        'action' => 'create',
        'parent_type'=> 'group',
        'subject_id' => $this->subject()->getIdentity(),
      ), $this->translate('Add Events'), array(
        'class' => 'buttonlink icon_group_photo_new'
    )) ?>
  <?php endif; ?>
</div>

<br />

<?php if( $this->paginator->getTotalItemCount() > 0 ): ?>

  <ul class='group_thumbs'>
    <?php foreach( $this->paginator as $event ): ?>
      <li class="group_album_thumb_notext">
        <div class='group_album_thumb_wrapper'>
          <?php echo $this->htmlLink($event->getHref(), $this->itemPhoto($event, 'thumb.normal')) ?>
        </div>
        <p>
          <?php if( '' != $event->getTitle() ): ?>
            <?php echo $this->htmlLink($event->getHref(), $this->string()->chunk($event->getTitle(), 10)) ?>
          <?php endif; ?>
          <span>
            <?php echo $this->translate('By');?> <?php echo $this->htmlLink($event->getOwner()->getHref(), $event->getOwner()->getTitle()) ?>
          </span>
          <span>
            <?php echo $this->timestamp($event->creation_date) ?>
          </span>
        </p>
      </li>
    <?php endforeach;?>
  </ul>

<?php else: ?>
  <div class="tip">
    <span>
      <?php echo $this->translate('No events have been added to this group yet.');?>
    </span>
  </div>

<?php endif; ?>
