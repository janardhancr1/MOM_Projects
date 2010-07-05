<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: forgot.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>
<?php if( empty($this->sent) ): ?>

  <?php echo $this->form->render($this) ?>

<?php else: ?>

  <div class="tip">
    <span>
      <?php echo $this->translate("USER_VIEWS_SCRIPTS_AUTH_FORGOT_DESCRIPTION") ?>
    </span>
  </div>

<?php endif; ?>
