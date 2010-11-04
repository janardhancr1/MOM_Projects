<?php
  $this->headScript()
    ->appendFile($this->baseUrl() . '/application/modules/Semods/externals/scripts/semods.js')
    ->appendFile($this->baseUrl() . '/application/modules/Socialdna/externals/scripts/socialdna.js')
?>


<?php /* <user.widgets.login-or-signup> */ ?>

<h3>
  <?php echo $this->translate('Sign In or %1$sJoin%2$s', '<a href="'.$this->url(array(), "user_signup").'">', '</a>'); ?>
</h3>

<?php // unroll form // echo $this->form->setAttrib('class', 'global_form_box')->render($this) ?>

<form method="post" action="<?php echo $this->url(array(),'user_login') ?>" class="global_form_box" enctype="application/x-www-form-urlencoded" id="user_form_login" name="user_form_login">
  <div>
    <div>
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
          
        <?php if($this->form->getElement('captcha')) : ?>
        <?php echo $this->form->getElement('captcha')->render($this) ?>
        <?php endif; ?>

        <div id="buttons-wrapper" class="form-wrapper">
          <fieldset id="fieldset-buttons">
            <div class="form-wrapper" id="submit-wrapper">
              <div class="form-label" id="submit-label">
                &nbsp;
              </div>

              <div class="form-element" id="submit-element">
                <button tabindex="5" type="submit" id="submit" name="submit"><?php echo $this->translate('Sign In') ?></button>
              </div>
            </div>

            <div class="form-wrapper" id="remember-wrapper">
              <div id="remember-label" class="form-label">
                &nbsp;
              </div>

              <div class="form-element" id="remember-element">
                <input type="hidden" value="0" name="remember"><input type="checkbox" tabindex="4" value="1" id="remember" name="remember"> <label class="optional" for="remember"><?php echo $this->translate('Remember Me') ?></label>
              </div>
            </div>
          </fieldset>
        </div><input type="hidden" id="return_url" value="" name="return_url">
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</form>-->
<?php /* </user.widgets.login-or-signup> */ ?>




<script>

var openidconnect_scroll_icons_timer = null;
var openidconnect_scroll = false;
var openidconnect_scroll_timer_period = 25;
var openidconnect_scroll_delta = 8;

function openidconnect_scroll_icons(direction) {

  openidconnect_scroll = true;

  if(direction == 'left') {

    if(parseInt(SEMods.B.ge("openidconnect_connect_icons").style.left) >= 0) {
      openidconnect_scroll = false;
    } else {
      SEMods.B.ge("openidconnect_connect_icons").style.left = parseInt(SEMods.B.ge("openidconnect_connect_icons").style.left) + openidconnect_scroll_delta + 'px';
    }
    
  } else {
    
    if((SEMods.B.ge("openidconnect_connect_icons").offsetWidth) - Math.abs(parseInt(SEMods.B.ge("openidconnect_connect_icons").style.left)) <= SEMods.B.ge("openidconnect_connect_icons_wrapper").offsetWidth) {
      openidconnect_scroll = false;
    } else {
      SEMods.B.ge("openidconnect_connect_icons").style.left = parseInt(SEMods.B.ge("openidconnect_connect_icons").style.left) - openidconnect_scroll_delta + 'px';
    }
    
  }

  if(openidconnect_scroll) {
    openidconnect_scroll_icons_timer = setTimeout(function() { openidconnect_scroll_icons(direction); }, openidconnect_scroll_timer_period);
  }

}

function openidconnect_scroll_icons_stop() {
  clearTimeout(openidconnect_scroll_icons_timer);
  openidconnect_scroll_icons_timer = null;
  openidconnect_scroll = false;
}

</script>

<div>

  <?php if ($this->openid_layout == 10): // big square icons ?>

    <div class='openidconnect_social_login_wrapper'>

    <table cellspacing="0" cellpadding="0" style="" class="openid_login_block_home">
    <tr>
      <td style="font-weight: bold; padding-top: 10px; padding-bottom: 10px; text-align: center; color: #777"> <?php echo $this->translate('Or Sign In Using') ?> </td>
    </tr>
    <tr>
      <td nowrap="nowrap">

        <table cellspacing="0" cellpadding="0">
          <tr>
            <td style="width: 5px;">
              <div class="openidconnect_icons_scroller" style='padding-left: 0px; padding-right: 0px' onmouseover="openidconnect_scroll_icons('left')" onmouseout="openidconnect_scroll_icons_stop()">
              &laquo;
              </div>
            </td>
            <td style="padding-left: 3px; padding-right: 6px">
          
              <div  id="openidconnect_connect_icons_wrapper" style="width: 147px; height: 70px; overflow: hidden; position: relative">
                
                <div id="openidconnect_connect_icons" style="width: <?php echo $this->services_per_row * 40 ?>px; position: absolute; top: 0px; left: 0px;">
      
                  <?php $_service_counter = 0; ?>
                  <?php if($this->facebook_enabled): ?>
                  <div style='float: left'>
                  <div style="padding-bottom: 5px; padding-left: 5px;">
                    <?php echo $this->partial('_facebookButton.tpl', 'socialdna', array('openid_facebook_button_style' => 2)) ?>
                  </div>
                  <?php $_service_counter++; ?>
                  <?php endif; ?>
                  
                  <?php foreach($this->openid_services as $openid_service): ?>
                  <?php if(($_service_counter % 2) == 0) : ?>
                  <div style='float: left'>
                  <?php endif; ?>
                  <div style="padding-bottom: 5px; padding-left: 5px; Xfloat: left">
                    <a href="http://<?php echo $this->openid_relay_url ?>/login/<?php echo $openid_service['openidservice_name'] ?>" title="<?php echo $openid_service['openidservice_displayname'] ?>"><img border='0' width=32 height=32 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_square'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></a>
                  </div>
                  <?php if(($_service_counter++ % 2) != 0) : ?>
                  <div style="clear: both"></div>
                  </div>
                  <?php endif; ?>
                  <?php endforeach; ?>

                  <?php if(($_service_counter % 2) != 0) : ?>
                  <div style="clear: both"></div>
                  </div>
                  <?php endif; ?>

                  <div style="clear: both"></div>
      
                </div>
                  
              </div>
                          
          </td>
          <td style="width: 5px;">
            <div class="openidconnect_icons_scroller" style='padding-left: 0px; padding-right: 0px' onmouseover="openidconnect_scroll_icons('right')"  onmouseout="openidconnect_scroll_icons_stop()">&raquo;</div>
          </td>
          </tr>
        </table>
                        
      </td>
    </tr>
    </table>

  </div>
  
  <?php elseif ($this->openid_layout == 11): // small icons ?>

    <div class='openidconnect_social_login_wrapper'>

    <table cellspacing="0" cellpadding="0" style="" class="openid_login_block_home">
    <tr>
      <td style="font-weight: bold; padding-top: 10px; padding-bottom: 10px; text-align: center; color: #777"> <?php echo $this->translate('Or Sign In Using') ?> </td>
    </tr>
    <tr>
      <td nowrap="nowrap">

        <table cellspacing="0" cellpadding="0">
          <tr>
            <td style="width: 5px;">
              <div class="openidconnect_icons_scroller" style='padding: 15px 0px' onmouseover="openidconnect_scroll_icons('left')" onmouseout="openidconnect_scroll_icons_stop()">&laquo;</div>
            </td>
            <td style="padding-left: 3px; padding-right: 6px">
          
              <div id="openidconnect_connect_icons_wrapper" style="width: 147px; height: 45px; overflow: hidden; position: relative">
                
                <div id="openidconnect_connect_icons" style="width: <?php echo $this->services_per_row * 23 ?>px; position: absolute; top: 0px; left: 0px;">
      
                  <?php $_service_counter = 0; ?>
                  <?php if($this->facebook_enabled): ?>
                  <div style='float: left'>
                  <div style="padding-bottom: 5px; padding-left: 5px;">
                    <?php echo $this->partial('_facebookButton.tpl', 'socialdna', array('openid_facebook_button_style' => 3)) ?>
                  </div>
                  <?php $_service_counter++; ?>
                  <?php endif; ?>

                  <?php foreach($this->openid_services as $openid_service): ?>
                  <?php if(($_service_counter % 2) == 0) : ?>
                  <div style='float: left'>
                  <?php endif; ?>
                  <div style="padding-bottom: 5px; padding-left: 5px; Xfloat: left">
                    <a href="http://<?php echo $this->openid_relay_url ?>/login/<?php echo $openid_service['openidservice_name'] ?>" title="<?php echo $openid_service['openidservice_displayname'] ?>"><img border='0' width=16 height=16 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_mini'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></a>
                  </div>
                  <?php if(($_service_counter++ % 2) != 0) : ?>
                  <div style="clear: both"></div>
                  </div>
                  <?php endif; ?>
                  <?php endforeach; ?>

                  <?php if(($_service_counter % 2) != 0) : ?>
                  <div style="clear: both"></div>
                  </div>
                  <?php endif; ?>

                  <div style="clear: both"></div>
      
                </div>
                  
              </div>
                          
          </td>
          <td style="width: 5px;">
            <div class="openidconnect_icons_scroller" style='padding: 15px 0px' onmouseover="openidconnect_scroll_icons('right')"  onmouseout="openidconnect_scroll_icons_stop()">&raquo;</div>
          </td>
          </tr>
        </table>
                        
      </td>
    </tr>
    </table>
    
    </div>

  <?php elseif ($this->openid_layout == 12): // small icons, big facebook button ?>

    <div class='openidconnect_social_login_wrapper'>

    <table cellspacing="0" cellpadding="0" style="" class="openid_login_block_home">
    <tr>
      <td style="font-weight: bold; padding-top: 10px; padding-bottom: 10px; text-align: center; color: #777"> <?php echo $this->translate('Or Sign In Using') ?> </td>
    </tr>
    <tr>
      <td nowrap="nowrap">

        <?php if($this->facebook_enabled): ?>
        <div style="padding-bottom: 5px; padding-left: 5px;">
          <?php echo $this->partial('_facebookButton.tpl', 'socialdna', array('openid_facebook_button_style' => 0)) ?>
        </div>
        <?php endif; ?>
      
        <table cellspacing="0" cellpadding="0">
          <tr>
            <td style="width: 5px;">
              <div class="openidconnect_icons_scroller" style='padding: 15px 0px' onmouseover="openidconnect_scroll_icons('left')" onmouseout="openidconnect_scroll_icons_stop()">&laquo;</div>
            </td>
            <td style="padding-left: 3px; padding-right: 6px">

              <div id="openidconnect_connect_icons_wrapper" style="width: 147px; height: 45px; overflow: hidden; position: relative">
                
                <div id="openidconnect_connect_icons" style="width: <?php echo $this->services_per_row * 23 ?>px; position: absolute; top: 0px; left: 0px;">
      
                  <?php foreach($this->openid_services as $key => $openid_service): ?>
                  <?php if(($key % 2) == 0) : ?>
                  <div style='float: left'>
                  <?php endif; ?>
                  <div style="padding-bottom: 5px; padding-left: 5px; Xfloat: left">
                    <a href="http://<?php echo $this->openid_relay_url ?>/login/<?php echo $openid_service['openidservice_name'] ?>" title="<?php echo $openid_service['openidservice_displayname'] ?>"><img border='0' width=16 height=16 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_mini'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></a>
                  </div>
                  <?php if(($key % 2) != 0) : ?>
                  <div style="clear: both"></div>
                  </div>
                  <?php endif; ?>
                  <?php endforeach; ?>

                  <?php if(((count($this->openid_services)) % 2) != 0) : ?>
                  <div style="clear: both"></div>
                  </div>
                  <?php endif; ?>

                  <div style="clear: both"></div>
      
                </div>
                  
              </div>
                          
          </td>
          <td style="width: 5px;">
            <div class="openidconnect_icons_scroller" style='padding: 15px 0px' onmouseover="openidconnect_scroll_icons('right')"  onmouseout="openidconnect_scroll_icons_stop()">&raquo;</div>
          </td>
          </tr>
        </table>
                        
      </td>
    </tr>
    </table>

    </div>

  <?php elseif ($this->openid_layout == 13): // ALL square icons, white background ?>

    <div class='openidconnect_social_login_wrapper'>

    <table cellpadding='0' cellspacing='0' class='openid_login_block_home' style="<?php echo $this->openid_icons_block_style ?>">
    <tr>
      <td style="font-weight: bold; padding-top: 10px; padding-bottom: 10px; text-align: center; color: #777">
        <?php echo $this->translate('Sign In With'); ?>
      </td>
    </tr>
    <tr>
      <td nowrap="nowrap">
        <div style="padding-left: -5px">
          
          <div style="width: 155px; padding-left: 10px">
          <?php if($this->facebook_enabled): ?>
          <div style="padding-bottom: 5px; padding-left: 5px; float: left">
            <?php echo $this->partial('_facebookButton.tpl', 'socialdna', array('openid_facebook_button_style' => 2)) ?>
          </div>
          <?php endif; ?>
          <?php foreach($this->openid_services as $openid_service): ?>
          <div style="padding-bottom: 5px; padding-left: 5px; float: left">
            <a href="http://<?php echo $this->openid_relay_url ?>/login/<?php echo $openid_service['openidservice_name'] ?>" title="<?php echo $openid_service['openidservice_displayname'] ?>"><img border='0' width=32 height=32 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_square'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></a>
          </div>
          <?php endforeach; ?>
          <div style="clear: both"></div>
          <?php if (count($this->openid_services_more) > 0): ?>
            <div id="openid_services_more_hint" style="text-align: right" onclick="$(this).hide();$('#openid_services_more_<?php echo $this->openid_login_block_instance ?>').show();return false;"><a href=""><?php echo $this->translate('more') ?></a></div>
            <div id="openid_services_more_<?php echo $this->openid_login_block_instance ?>" style="display:none">
            <?php foreach($this->openid_services_more as $openid_service): ?>
            <div style="padding-bottom: 5px; padding-left: 5px; float: left">
              <a href="http://<?php echo $this->openid_relay_url ?>/login/<?php echo $openid_service['openidservice_name'] ?>" title="<?php echo $openid_service['openidservice_displayname'] ?>"><img border='0' width=32 height=32 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_square'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></a>
            </div>
            <?php endforeach; ?>
            </div>
          <?php endif; ?>
          </div>
          
        </div>
      </td>
    </tr>
    </table>
    
    </div>  
    
  <?php elseif ($this->openid_layout == 14): // ALL square icons, empty background ?>

    <div style="margin-left:-11px;margin-right:-7px;margin-top:5px;">

    <table cellpadding='0' cellspacing='0' class='openid_login_block_home' style="<?php echo $this->openid_icons_block_style ?>">
    <tr>
      <td style="font-weight: bold; padding-top: 10px; padding-bottom: 10px; text-align: center;">
        <?php echo $this->translate('Sign In With'); ?>
      </td>
    </tr>
    <tr>
      <td nowrap="nowrap">
        <div style="padding-left: -5px">
          
          <div style="width: 194px;">
          <?php if($this->facebook_enabled): ?>
          <div style="padding-bottom: 5px; padding-left: 5px; float: left">
            <?php echo $this->partial('_facebookButton.tpl', 'socialdna', array('openid_facebook_button_style' => 2)) ?>
          </div>
          <?php endif; ?>
          <?php foreach($this->openid_services as $openid_service): ?>
          <div style="padding-bottom: 5px; padding-left: 5px; float: left">
            <a href="http://<?php echo $this->openid_relay_url ?>/login/<?php echo $openid_service['openidservice_name'] ?>" title="<?php echo $openid_service['openidservice_displayname'] ?>"><img border='0' width=32 height=32 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_square'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></a>
          </div>
          <?php endforeach; ?>
          <div style="clear: both"></div>
          <?php if (count($this->openid_services_more) > 0): ?>
            <div id="openid_services_more_hint" style="text-align: right" onclick="$(this).hide();$('#openid_services_more_<?php echo $this->openid_login_block_instance ?>').show();return false;"><a href=""><?php echo $this->translate('more') ?></a></div>
            <div id="openid_services_more_<?php echo $this->openid_login_block_instance ?>" style="display:none">
            <?php foreach($this->openid_services_more as $openid_service): ?>
            <div style="padding-bottom: 5px; padding-left: 5px; float: left">
              <a href="http://<?php echo $this->openid_relay_url ?>/login/<?php echo $openid_service['openidservice_name'] ?>" title="<?php echo $openid_service['openidservice_displayname'] ?>"><img border='0' width=32 height=32 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_square'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></a>
            </div>
            <?php endforeach; ?>
            </div>
          <?php endif; ?>
          </div>
          
        </div>
      </td>
    </tr>
    </table>
    
    </div>
    
  <?php else: // ALL small icons ?>

    <div class='openidconnect_social_login_wrapper'>
  
    <table cellpadding='0' cellspacing='0' class='openid_login_block'>
    <tr>
      <td style="font-weight: bold; padding-bottom: 10px; padding-top: 10px; text-align: center; color: #777">
        <?php echo $this->translate('Or Sign In Using') ?>
      </td>
    </tr>
    <tr>
      <td nowrap="nowrap">
        <div style="padding-left: -5px; width: 170px">
          
          <div style="padding-bottom: 5px; padding-left: 5px; float: left;">
          <?php echo $this->partial('_facebookButton.tpl','socialdna') ?>            
          </div>
  
          <?php foreach($this->openid_services as $openid_service): ?>
          <div style="padding-bottom: 5px; padding-left: 5px; float: left">
            <a href="http://<?php echo $this->openid_relay_url ?>/login/<?php echo $openid_service['openidservice_name'] ?>" title="<?php echo $openid_service['openidservice_displayname'] ?>"><img border='0' width=16 height=16 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_mini'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></a>
          </div>
          <?php endforeach; ?>
          
        </div>
      </td>
    </tr>
    </table>

    </div>
    
  <?php endif; ?>
</div>




      </div>
    </div>
  </div>
</form>
