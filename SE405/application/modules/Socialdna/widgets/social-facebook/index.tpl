<?php
  $this->headScript()
    ->appendFile($this->baseUrl() . '/application/modules/Semods/externals/scripts/semods.js')
    ->appendFile($this->baseUrl() . '/application/modules/Socialdna/externals/scripts/socialdna.js')
?>


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
<?php if($this->facebook_enabled): ?>
<div style='color:#777777;font-size:18px;margin-left:15px;'>
Login using Facebook:
<a href="javascript:void(0)" class="openidconnect_facebook_login_button" >
  <img id="fb_login_image" src="http://static.ak.fbcdn.net/images/fbconnect/login-buttons/connect_light_medium_long.gif" alt="Facebook Connect" border="0" />
  </a>
</div>
<script type="text/javascript">
openidconnect_register_facebook_login_button('<?php echo $openid_facebook_landingpage ?>');
</script>
<?php endif; ?>
</div>