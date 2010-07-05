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
      <?php echo $this->htmlLink($item->getHref(), $this->itemPhoto($item, 'thumb.icon'), array('class' => 'recentvideos_thumb')) ?>
      <div class='recentvideos_info'>
        <div class='recentvideos_title'>
          <?php echo $this->htmlLink($item->getHref(), $item->getTitle()) ?>
        </div>
        <div class='recentvideos_date'>
          <?php echo $this->timestamp($item->creation_date) ?>
        </div>
        <div class='recentvideos_owner'>
          <?php
            $owner = $item->getOwner();
            echo $this->translate('Posted by %1$s', $this->htmlLink($owner->getHref(), $owner->getTitle()));
          ?>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>