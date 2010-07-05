<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: account.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>

<h1>
  <?php echo $this->translate('Step 4: Create Admin Account') ?>
</h1>

<p>
  <?php echo $this->translate('Now that you\'ve setup SocialEngine, let\'s get started by naming your community and creating an administrator account. Please provide your email address and choose a password. You will use this information to sign in to your control panel and manage your social network.') ?>
</p>

<br />

<?php if( !empty($this->form) ): ?>
  <?php echo $this->form->render($this) ?>
<?php endif; ?>