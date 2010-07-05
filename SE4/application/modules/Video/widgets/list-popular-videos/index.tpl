<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6531 2010-06-23 22:02:51Z shaun $
 * @author     John
 */
?>

<ul>
  <?php foreach( $this->paginator as $item ): ?>
    <li>
      <?php echo $this->htmlLink($item->getHref(), $this->itemPhoto($item, 'thumb.icon'), array('class' => 'popularvideos_thumb')) ?>
      <div class='popularvideos_info'>
        <div class='popularvideos_title'>
          <?php echo $this->htmlLink($item->getHref(), $item->getTitle()) ?>
        </div>
        <div class='popularvideos_views'>
          <?php echo $this->translate(array('%s view', '%s views', $item->view_count), $this->locale()->toNumber($item->view_count)) ?>
        </div>
        <div class='popularvideos_owner'>
          <?php
            $owner = $item->getOwner();
            echo $this->translate('Posted by %1$s', $this->htmlLink($owner->getHref(), $owner->getTitle()));
          ?>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>