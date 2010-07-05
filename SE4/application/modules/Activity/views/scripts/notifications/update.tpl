<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: update.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     Jung
 */
?>
<div id='new_notification'>
  <span>
    <?php echo $this->htmlLink(array('route' => 'default', 'module' => 'activity', 'controller' => 'notifications'),
                               $this->translate(array('%s update', '%s updates', $this->notificationCount), $this->locale()->toNumber($this->notificationCount)),
                               array('id' => 'core_menu_mini_menu_updates_count')) ?>
  </span>
  <span id="core_menu_mini_menu_updates_close">
    <a href="javascript:void(0);" onclick="en4.activity.hideNotifications();">x</a>
  </span>
</div>