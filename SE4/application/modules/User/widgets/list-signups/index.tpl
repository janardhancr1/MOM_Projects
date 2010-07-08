<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>

<table>
<tr>
  <?php foreach( $this->users as $user ): ?>
   <td width="33%">
      <div class='newestmembers_info'>
        <div class='newestmembers_name'>
          <?php echo $this->htmlLink($user->getHref(), $user->getTitle()) ?>
        </div>
        <div class='newestmembers_date'>
          <?php echo $this->htmlLink($user->getHref(), $this->itemPhoto($user, 'thumb.icon'), array('class' => 'newestmembers_thumb')) ?>
        </div>
      </div>
    </td>
  <?php endforeach; ?>
</tr>
 </table>