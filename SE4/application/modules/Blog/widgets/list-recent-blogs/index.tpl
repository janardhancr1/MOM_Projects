<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6508 2010-06-22 23:41:11Z shaun $
 * @author     John
 */
?>

<ul>
  <?php foreach( $this->paginator as $item ): ?>
    <li>
      <?php echo $this->htmlLink($item->getHref(), $this->itemPhoto($item, 'thumb.icon'), array('class' => 'recentblogs_thumb')) ?>
      <div class='recentblogs_info'>
        <div class='recentblogs_title'>
          <?php echo $this->htmlLink($item->getHref(), $item->getTitle()) ?>
        </div>
        <div class='recentblogs_date'>
          <?php echo $this->timestamp($item->creation_date) ?>
        </div>
        <div class='recentblogs_owner'>
          <?php
            $owner = $item->getOwner();
            echo $this->translate('Posted by %1$s', $this->htmlLink($owner->getHref(), $owner->getTitle()));
          ?>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>