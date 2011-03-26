<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 7319 2010-09-08 21:08:45Z jung $
 * @author     John
 */
?>

<ul class="groups_browse">
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
         
        </li>
      <?php endforeach; ?>
</ul>