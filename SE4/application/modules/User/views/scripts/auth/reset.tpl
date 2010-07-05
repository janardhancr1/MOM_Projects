<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: reset.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>
<?php if( empty($this->reset) ): ?>

  <?php echo $this->form->render($this) ?>

<?php else: ?>

  <div class="tip">
    <span>
      <?php echo $this->translate("Your password has been reset. Click %s to sign-in.", $this->htmlLink(array('route' => 'user_login'), 'here')) ?>
    </span>
  </div>

<?php endif; ?>
