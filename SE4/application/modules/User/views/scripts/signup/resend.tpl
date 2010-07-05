<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: resend.tpl 6641 2010-06-30 01:22:51Z john $
 * @author		 Alex
 */
?>

<h2>
  <?php echo $this->translate("Verification Email") ?>
</h2>

<p>
  <?php 
    echo $this->translate("A verification message has been sent resent to your email address with instructions for activating your account. Once you have activated your account, you will be able to sign in.");
  ?>
</p>

<br />

<h3>
  <a href="#"><?php echo $this->translate("OK, thanks!") ?></a>
</h3>