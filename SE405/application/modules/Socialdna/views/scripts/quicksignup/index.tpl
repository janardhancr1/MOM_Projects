<div class='layout_middle'>
<h2><?php echo $this->title ?></h2>
<script type="text/javascript">
  function skipForm()
  {
    document.getElementById("skip").value = "skipForm";
    $('SignupForm').submit();
  }
  function finishForm()
  {
    document.getElementById("nextStep").value = "finish";
  }

  function socialdna_login(method) {
    if(method == 'signup') {
      SEMods.B.show('openid_signup');
      SEMods.B.hide('openid_signup_login');

      SEMods.B.show('openid_signup_login_hint');
      SEMods.B.hide('openid_signup_hint');

    } else {
      SEMods.B.hide('openid_signup');
      SEMods.B.show('openid_signup_login');

      SEMods.B.hide('openid_signup_login_hint');
      SEMods.B.show('openid_signup_hint');
    }
  }
</script>

<?php //if($this->script[0] == 'signup/form/account.tpl'): ?>
<?php if($this->script[0] == 'quicksignup/form/account.tpl'): ?>

<table cellpadding=0 cellpadding=0 Xwidth="100%">
<tr>
<td style="width: 550px">

<div id="openid_signup" <?php if($this->task == 'signuplogin'): ?>style='display:none'<?php endif; ?>>
  
<?php endif; ?>

<?php echo $this->partial($this->script[0], $this->script[1], array(
  'form' => $this->form
)) ?>

<?php //if($this->script[0] == 'signup/form/account.tpl'): ?>
<?php if($this->script[0] == 'quicksignup/form/account.tpl'): ?>

</div>

<div id="openid_signup_login" <?php if($this->task != 'signuplogin'): ?>style='display:none'<?php endif; ?>>


<form method="post" action="" class="global_form" enctype="application/x-www-form-urlencoded" id="user_form_login" style="padding: 0px">
  <input type="hidden" name="task" value="signuplogin" />
  <div style="width: 100%">
    <div>
      <h3><?php echo $this->translate('Member Sign In') ?></h3>
      <p class="form-description"><?php echo $this->translate('If you already have an account, please enter your details below.') ?></p>
      
      <?php if($this->error_message) :?>
      <ul class="form-errors"><li><ul class="errors"><li><?php echo $this->error_message ?></li></ul></li></ul>      
      <?php endif; ?>
      
      <div class="form-elements">
        <div class="form-wrapper" id="email-wrapper">
          <div class="form-label" id="email-label">
            <label class="required" for="email"><?php echo $this->translate('Email Address') ?></label>
          </div>
          <div class="form-element" id="email-element">
            <input type="text" tabindex="1" value="" id="email" name="email">
          </div>
        </div>
        <div class="form-wrapper" id="password-wrapper">
          <div class="form-label" id="password-label">
            <label class="required" for="password"><?php echo $this->translate('Password') ?></label>
          </div>
          <div class="form-element" id="password-element">
            <input type="password" tabindex="2" value="" id="password" name="password">
          </div>
        </div>
        <div id="buttons-wrapper" class="form-wrapper">
          <div class="form-wrapper" id="submit-wrapper">
            <div class="form-label" id="submit-label">&nbsp;</div>
            <div class="form-element" id="submit-element">
              <button tabindex="5" type="submit" id="submit" name="submit"><?php echo $this->translate('Sign In') ?></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
  
</div>


</td>
<td style='vertical-align:top'>

  <div style='margin-left: 30px; margin-bottom: 20px; Xmargin-bottom: 30px; margin-top: 10px'>
  
    <table cellpadding='0' cellspacing='0'>
    <tr>
    <td style="vertical-align:top; padding-right: 10px; width: 50px; text-align: right">
      <?php if ($this->openid_user_thumb != '') : ?>
      <img border='0' src="<?php echo $this->openid_user_thumb ?>" style="max-width: 50px; Xmargin-bottom: -19px">
      <?php endif; ?>
      <img border='0' src="application/modules/Socialdna/externals/images/brands/<?php echo $this->openid_service_info['openidservice_logo_mini'] ?>">
    </td>
    <td style="vertical-align:top">
      <div style='font-size: 20px; text-align: left'>
      <?php echo $this->translate('socialdna_openid_signup_hello') ?> <?php echo $this->openid_user_fullname ?>!
      </div>
      <div style='padding-top: 5px'>
        <?php echo $this->translate('socialdna_openid_signup_welcome_message') ?>
      </div>
    </td>
    </tr>
    </table>


    <div style='margin-bottom: 10px; margin-top: 10px;<?php if($this->task != 'signuplogin'): ?>display:none<?php endif; ?>' id="openid_signup_hint">
      <?php echo $this->translate('socialdna_openid_signup_newuser') ?> <a href="javascript:void(0)" onclick="socialdna_login('signup')"> <?php echo $this->translate('socialdna_openid_signup_newuser_signup') ?> </a>
    </div>
    
    <div style='margin-bottom: 10px; margin-top: 10px;<?php if($this->task == 'signuplogin'): ?>display:none<?php endif; ?>' id="openid_signup_login_hint">
      <?php echo $this->translate('socialdna_openid_signup_already_have_account') ?> <a href="javascript:void(0)" onclick="socialdna_login('login')"> <?php echo $this->translate('socialdna_openid_signup_connect_account') ?> <?php echo $this->openid_service_info['openidservice_displayname'] ?></a>
    </div>
    
  
  </div>

  
</td>
</tr>
</table>
<?php endif; ?>
</div>

