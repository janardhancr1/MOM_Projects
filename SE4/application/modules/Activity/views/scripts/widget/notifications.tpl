<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: notifications.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>
<?php foreach( $this->notifications as $notification ): ?>
  <li<?php if( !$notification->read ): ?> class="notifications_unread"<?php endif; ?> value="<?php echo $notification->getIdentity();?>">
    <span class="notification_item_general notification_type_<?php echo $notification->type ?>">
      <?php echo $notification->__toString() ?>
    </span>
  </li>
<?php endforeach; ?>