<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: password.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     Steve
 */
?>
<div class='layout_middle'>
<div class="headline">
  <h2>
    <?php echo $this->translate('My Settings');?>
  </h2>
  <div class="tabs">
    <?php
      // Render the menu
      echo $this->navigation()
        ->menu()
        ->setContainer($this->navigation)
        ->render();
    ?>
  </div>
</div>
<div style='float:left'>
<?php echo $this->form->render($this) ?>
</div>
<div style='-moz-border-radius:8px 8px 8px 8px;
background-color:#FFFFFF;
border:1px solid #EAEAEA;
padding:12px; float:right; width:400px;margin-right:50px'>
Hi Mom!  When you joined Momburbia.com, you may have used your Facebook account to register or you may have simply created a new Momburbia account.  In either case, you would have received an email with your email address and randomized password.  If you wish to change that password, you can do that here. 
If you did register using Facebook, the password given to you is a backup, just in case there is an issue with logging in using Facebook.
<br/>
<br/>
Hope this helps! 
<br/>
<br/>
Momburbia Team
</div>