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
<?php echo $this->partial('_facebookButton.tpl') ?>
<?php endif; ?>
</div>