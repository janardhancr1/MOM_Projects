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

<h3><?php echo $this->translate('Mutual Friends');?></h3>

<ul>
  <?php foreach( $this->paginator as $user ): ?>
    <li><?php echo $this->htmlLink($user->getHref(), $this->itemPhoto($user, 'thumb.icon', $user->getTitle()), array('title'=>$user->getTitle())) ?></li>
  <?php endforeach; ?>
</ul>
