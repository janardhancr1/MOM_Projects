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

<!--
<h3><?php echo $this->count ?> Members Online</h3>
-->

<div>
  <?php foreach( $this->users as $user ): ?>
    <div class='whosonline_thumb'>
      <?php echo $this->htmlLink($user->getHref(), $this->itemPhoto($user, 'thumb.icon', $user->getTitle()), array('title'=>$user->getTitle())) ?>
    </div>
  <?php endforeach; ?>
</div>
