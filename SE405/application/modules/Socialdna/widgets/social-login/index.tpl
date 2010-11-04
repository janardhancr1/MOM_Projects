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

  <?php if ($this->openid_layout == 0): ?>
  
    <table cellpadding='0' cellspacing='0' class='openid_login_block' style="<?php echo $this->openid_icons_block_style ?>">
    <tr>
      <td style="font-weight: bold; padding-top: 10px; padding-bottom: 10px; text-align: center;">
        <?php echo $this->translate('Sign In With'); ?>
      </td>
    </tr>
    <tr>
      <td nowrap="nowrap">
        <div style="padding-left: -5px">
          
          <div style="padding-bottom: 10px; text-align: center">
          <?php echo $this->partial('_facebookButton.tpl') ?>
          </div>
          
          <!--<div style="width: 260px">-->
          <div style="width: <?php echo $this->openid_icons_block_width ?>px">
          <?php foreach($this->openid_services as $openid_service) : ?>
          <div style="padding-bottom: 5px; padding-left: 5px; float: left">
            <a href="http://<?php echo $this->openid_relay_url ?>/login/<?php echo $openid_service['openidservice_name'] ?>" title="<?php echo $openid_service['openidservice_displayname'] ?>"><img border='0' width=16 height=16 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_mini'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></a>
          </div>
          <?php endforeach; ?>
          <div style="clear: both"></div>
          <?php if (count($this->openid_services_more) > 0): ?>
            <div id="openid_services_more_hint" style="text-align: right" onclick="$(this).hide();$('#openid_services_more_<?php echo $this->openid_login_block_instance ?>').show();return false;"><a href=""><?php echo $this->translate('more') ?></a></div>
            <div id="openid_services_more_<?php echo $this->openid_login_block_instance ?>" style="display:none">
            <?php foreach($this->openid_services_more as $openid_service): ?>
            <div style="padding-bottom: 5px; padding-left: 5px; float: left">
              <a href="http://<?php echo $this->openid_relay_url ?>/login/<?php echo $openid_service['openidservice_name'] ?>" title="<?php echo $openid_service['openidservice_displayname'] ?>"><img border='0' width=16 height=16 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_mini'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></a>
            </div>
            <?php endforeach; ?>
            </div>
          <?php endif; ?>
          </div>
          
        </div>
      </td>
    </tr>
    </table>
  
  <?php elseif ($this->openid_layout == 2): ?>
  
    <table cellpadding='0' cellspacing='0' class='openid_login_block' style="<?php echo $this->openid_icons_block_style ?>">
    <tr>
      <td style="font-weight: bold; padding-top: 10px; padding-bottom: 10px; text-align: center;">
        <?php echo $this->translate('Sign In With'); ?>
      </td>
    </tr>
    <tr>
      <td nowrap="nowrap">
        <div style="padding-left: -5px">
          
          <!--<div style="width: 260px">-->
          <div style="width: <?php echo $this->openid_icons_block_width ?>px">
          <?php if($this->facebook_enabled): ?>
          <div style="padding-bottom: 5px; padding-left: 5px; float: left">
            <?php echo $this->partial('_facebookButton.tpl', array('openid_facebook_button_style' => 2)) ?>
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
  
  <?php elseif ($this->openid_layout == 3): ?>
  
    <table cellpadding='0' cellspacing='0' class='openid_login_block' style="<?php echo $this->openid_icons_block_style ?>">
    <tr>
      <td style="font-weight: bold; padding-top: 10px; padding-bottom: 10px; text-align: center;">
        <?php echo $this->translate('Sign In With') ?>
      </td>
    </tr>
    <tr>
      <td nowrap="nowrap">
        <div style="padding-left: -5px">
          
          <div style="width: <?php echo $this->openid_icons_block_width ?>px">
          <div style="padding-bottom: 5px; padding-left: 5px; float: left">
            <?php echo $this->partial('_facebookButton.tpl', array('openid_facebook_button_style' => 3)) ?>
          </div>
          <?php foreach($this->openid_services as $openid_service): ?>
          <div style="padding-bottom: 5px; padding-left: 5px; float: left">
            <a href="http://<?php echo $this->openid_relay_url ?>/login/<?php echo $openid_service['openidservice_name'] ?>" title="<?php echo $openid_service['openidservice_displayname'] ?>"><img border='0' width=16 height=16 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_mini'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></a>
          </div>
          <?php endforeach; ?>
          <div style="clear: both"></div>
          <?php if (count($this->openid_services_more) > 0): ?>
            <div id="openid_services_more_hint" style="text-align: right" onclick="$(this).hide();$('#openid_services_more_<?php echo $this->openid_login_block_instance ?>').show();return false;"><a href=""><?php echo $this->translate('more') ?></a></div>
            <div id="openid_services_more_<?php echo $this->openid_login_block_instance ?>" style="display:none">
            <?php foreach($this->openid_services_more as $openid_service): ?>
            <div style="padding-bottom: 5px; padding-left: 5px; float: left">
              <a href="http://<?php echo $this->openid_relay_url ?>/login/<?php echo $openid_service['openidservice_name'] ?>" title="<?php echo $openid_service['openidservice_displayname'] ?>"><img border='0' width=16 height=16 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_mini'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></a>
            </div>
            <?php endforeach; ?>
            </div>
          <?php endif; ?>
          </div>
          
        </div>
      </td>
    </tr>
    </table>

  
  <?php elseif ($this->openid_layout == 777): // design ?>

  <table cellspacing="0" cellpadding="0" style="" class="openid_login_block">
    <tbody><tr>
      <td style="font-weight: bold; padding-top: 10px; padding-bottom: 10px; text-align: center;"> <?php echo $this->translate($this->title_text) ?> </td>
    </tr>
    <tr>
      <td nowrap="nowrap">

      <table cellspacing="0" cellpadding="0">
        <tr>
          <td style="width: 5px;">
            <div class="openidconnect_icons_scroller" onclick="openidconnect_scroll_icons('left')" onmouseover="openidconnect_scroll_icons('left')" onmouseout="openidconnect_scroll_icons_stop()">
            &laquo;
            </div>
          </td>
          <td style="padding-left: 3px; padding-right: 6px">
        
        <div  id="openidconnect_connect_icons_wrapper" style="width: 260px; height: 70px; overflow: hidden; position: relative">

          
          <div id="openidconnect_connect_icons" style="Xheight: 70px; Xoverflow: hidden; width: <?php echo $this->services_per_row * 40 ?>px; position: absolute; top: 0px; left: 0px;">
              
              <?php $_service_counter = 0; ?>
              <?php if($this->facebook_enabled): ?>
              <div style='float: left'>
              <div style="padding-bottom: 5px; padding-left: 5px; Xfloat: left">
                <?php echo $this->partial('_facebookButton.tpl', array('openid_facebook_button_style' => 2)) ?>
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
                        
          
        </div>
                        
        </td>
        <td style="Xwidth: 5px;">
          <div class="openidconnect_icons_scroller"  onclick="openidconnect_scroll_icons('right')" onmouseover="openidconnect_scroll_icons('right')"  onmouseout="openidconnect_scroll_icons_stop()">
          &raquo;
          </div>
        </td>
        </tr>
      </table>
                        
                        
      </td>
    </tr>
    </tbody></table>

  <?php else: ?>
  
    <table cellpadding='0' cellspacing='0' class='openid_login_block'>
    <tr>
      <td style="font-weight: bold; Xpadding-top: 10px; padding-bottom: 10px; text-align: center;">
        <?php echo $this->translate('Sign In With') ?>
      </td>
      <td nowrap="nowrap">
        <div style="padding-left: -5px">
          
          <div style="padding-bottom: 5px; padding-left: 5px; float: left;">
          <?php echo $this->partial('_facebookButton.tpl') ?>            
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
    
  <?php endif; ?>
</div>
