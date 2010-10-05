<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6438 2010-06-17 23:39:55Z jung $
 * @author     Steve
 */
?>
<div style='padding: 0px 3px'>
<ul class="polls_browse">
  <?php foreach ($this->paginator as $group): ?>
    <li>
       <div class='polls_browse_info'>
        <div class="groups_photo">
            <?php echo $this->htmlLink($group->getHref(), $this->itemPhoto($group, 'thumb.normal')) ?>
          </div>
        <div class="polls_browse_info">
            <div class="groups_title">
              <?php echo $this->htmlLink($group->getHref(), $group->getTitle()) ?>
            </div>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
</div>