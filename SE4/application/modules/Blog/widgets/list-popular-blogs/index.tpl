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
      <?php echo $this->htmlLink($item->getHref(), $this->itemPhoto($item, 'thumb.icon'), array('class' => 'popularblogs_thumb')) ?>
      <div class='popularblogs_info'>
        <div class='popularblogs_title'>
          <?php echo $this->htmlLink($item->getHref(), $item->getTitle()) ?>
        </div>
        <div class='popularblogs_views'>
          <?php echo $this->translate(array('%s view', '%s views', $item->view_count), $this->locale()->toNumber($item->view_count)) ?>
        </div>
        <div class='popularblogs_owner'>
          <?php
            $owner = $item->getOwner();
            echo $this->translate('Posted by %1$s', $this->htmlLink($owner->getHref(), $owner->getTitle()));
          ?>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>