<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: user-search.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     Sami
 */
?>
<?php if (count($this->paginator) > 1):?>
<?php echo $this->translate("Your search returned too many results; only displaying the first 20.") ?>
<?php endif;?>
<?php foreach ($this->paginator as $user):?>
<?php if (!$this->forum->isModerator($user)):?>
  <li>
    <a href='javascript:addModerator(<?php echo $user->getIdentity();?>);'><?php echo $user->getTitle();?></a>
  </li>
<?php endif;?>
<?php endforeach;?>