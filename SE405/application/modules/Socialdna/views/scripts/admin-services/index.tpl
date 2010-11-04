
<h2><?php echo $this->translate("Social DNA Plugin") ?></h2>

<?php if( count($this->navigation) ): ?>
  <div class='tabs'>
    <?php
      // Render the menu
      //->setUlClass()
      echo $this->navigation()->menu()->setContainer($this->navigation)->render();
      
    ?>
  </div>
<?php endif; ?>


<script>
function toggle_service(el) {
  while (el.tagName && el.tagName != "TD") {
      el = el.parentNode
  }
  var inputs = el.getElementsByTagName('input');
  inputs[0].value = inputs[0].value == 0 ? 1 : 0;
}
function openidconnect_iconstyle_onchange() {
  var v = document.getElementById('setting_openidconnect_iconstyle').value;

  SEMods.B.hide('openidconnect_iconstyle_10');
  SEMods.B.hide('openidconnect_iconstyle_11');
  SEMods.B.hide('openidconnect_iconstyle_12');
  SEMods.B.hide('openidconnect_iconstyle_13');
  SEMods.B.hide('openidconnect_iconstyle_14');
  SEMods.B.hide('openidconnect_iconstyle_15');

  SEMods.B.show('openidconnect_iconstyle_' + v);

}
</script>


<div class='clear'>
  <div class='settings'>

      <div class="global_form" id="admin_settings_form">

<form action='<?php echo $this->url(array('module'  => 'socialdna', 'controller' => 'services'), 'admin_default') ?>' method='POST'>
<div>
<div>
  
  <h3><?php echo $this->translate('Social DNA Service Settings') ?></h3>
  <p class="form-description"> <?php echo $this->translate('Setup Social Services') ?> </p>

  <?php if ($this->success == 1): ?>
  <ul class="form-notices"><li><?php echo $this->translate("Changes Successfully Saved"); ?></li></ul>
  <?php endif; ?>







  <table cellpadding='0' cellspacing='0' class='admin_table' style="width:600px;" Xwidth='100%'>
  <thead>
  <tr>
  <th class='header'>Service Name</th>
  <th class='header'>Enabled?</th>
  <th class='header'>Show in Publisher?</th>
  <th class='header'>Show on signup/login page?</th>
  <th class='header'>Display Order</th>
  </tr>
  </thead>

  <tbody>
  <?php foreach($this->openid_services as $openid_service) : ?>
  <tr>
  <td class='form1' style="text-align: left"> <img style="float:left; padding-right: 5px" border='0' src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_mini'] ?>"> &nbsp;<?php echo $openid_service['openidservice_displayname'] ?> <?php if($openid_service['openidservice_branding']): ?>(<a href="<?php echo $this->url(array('module'  => 'socialdna', 'controller' => 'services', 'action' => 'edit', 'service_id' => $openid_service['openidservice_id'] ), 'admin_default') ?>"><?php echo $this->translate('edit') ?></a>)<?php endif; ?> </td>
  <td style='text-align: center'>
    <input name="openid_services[e][<?php echo $openid_service['openidservice_id'] ?> ]" type="hidden" value="<?php if($openid_service['openidservice_enabled']): ?>1<?php else : ?>0<?php endif; ?>">
    <input type="checkbox" <?php if($openid_service['openidservice_enabled']): ?>CHECKED="checked"<?php endif; ?> onclick="toggle_service(this)">
  </td>
  <td style='text-align: center'>
    <?php if($openid_service['openidservice_can_status'] OR $openid_service['openidservice_can_newsfeed']): ?>
    <input name="openid_services[p][<?php echo $openid_service['openidservice_id']?>]" type="hidden" value="<?php if($openid_service['openidservice_publisher']):?>1<?php else : ?>0<?php endif; ?>">
    <input type="checkbox" <?php if($openid_service['openidservice_publisher']): ?>CHECKED="checked"<?php endif; ?> onclick="toggle_service(this)">
    <?php else : ?>
    &nbsp;
    <?php endif; ?>
  </td>
  <td style='text-align: center'>
    <input name="openid_services[s][<?php echo $openid_service['openidservice_id']?>]" type="hidden" value="<?php if($openid_service['openidservice_signup']): ?>1<?php else : ?>0<?php endif; ?>">
    <input type="checkbox" <?php if($openid_service['openidservice_signup']): ?>CHECKED="checked"<?php endif; ?> onclick="toggle_service(this)">
  </td>
  <td style='text-align: center'>
    <input style='width:15px' name="openid_services[o][<?php echo $openid_service['openidservice_id']?>]" type="text" value="<?php echo $openid_service['openidservice_showorder'] ?>">
  </td>
  </tr>
  <?php endforeach; ?>
  </tbody>
  </table>
  

  </table>
  
  
  <div style="background-color:#E9F4FA; height: 1px; margin-left: -20px; margin-right: -20px; margin-top: 50px; margin-bottom: 40px">&nbsp;</div>




  <h3><?php echo $this->translate('Social status update') ?></h3>
  <p class="form-description"> When user updates his status on this website, it will be automatically updated across all user's connected networks. The user can select on his settings page whether he will be prompted before updating the status on all the networks or the update will be automatic. Please select what will be the <strong>default</strong> option for new users. </p>


<div class="form_elements">

<div class="form-wrapper">
  <div class="form-label">
    <label class="optional"><?php echo $this->translate('Social status update') ?></label>
  </div>
  <div class="form-element">

  <ul class="form-options-wrapper">
  <li><input type='radio' name='setting_openidconnect_autostatus' id='setting_openidconnect_autostatus_0' value='0'<?php if($this->setting_openidconnect_autostatus == 0): ?> checked='checked'<?php endif; ?>><label for="setting_openidconnect_autostatus_0">Users will be prompted to have the status updated across all connected networks</label></li>
  <li><input type='radio' name='setting_openidconnect_autostatus' id='setting_openidconnect_autostatus_1' value='1'<?php if($this->setting_openidconnect_autostatus == 1): ?> checked='checked'<?php endif; ?>><label for="setting_openidconnect_autostatus_1">The status will be updated automatically</label></li>
  </ul>

  </div>
</div>




  <div style="background-color:#E9F4FA; height: 1px; margin-left: -20px; margin-right: -20px; margin-top: 50px; margin-bottom: 40px">&nbsp;</div>




  <h3><?php echo $this->translate("Home Login or Signup Widget Styling"); ?></h3>
  <p class="form-description"> <?php echo $this->translate('Change style of the widget') ?> </p>






<div class="form-wrapper">
  <div class="form-label">
    <label class="optional" for="invite_api_key"><?php echo $this->translate("Style"); ?></label>
  </div>
  <div class="form-element">

    <table cellspacing=0 cellpadding=0 style="background-color:#F6F6F6;border:1px solid #DDDDDD;padding:10px;width:auto;">
      <tr>
        <td style="border: 0px; vertical-align: top; text-align: center">

        <select name="setting_openidconnect_iconstyle" id="setting_openidconnect_iconstyle" onchange="openidconnect_iconstyle_onchange()">
          <option value="10" <?php if($this->setting_openidconnect_iconstyle == 10):?>selected="selected"<?php endif; ?>>Big Square Icons (scrolled)</option>
          <option value="11" <?php if($this->setting_openidconnect_iconstyle == 11):?>selected="selected"<?php endif; ?>>Small Icons (scrolled)</option>
          <option value="12" <?php if($this->setting_openidconnect_iconstyle == 12):?>selected="selected"<?php endif; ?>>Small Icons with big Facebook button (scrolled)</option>
          <option value="13" <?php if($this->setting_openidconnect_iconstyle == 13):?>selected="selected"<?php endif; ?>>All Big square icons</option>
          <option value="14" <?php if($this->setting_openidconnect_iconstyle == 14):?>selected="selected"<?php endif; ?>>All Big square icons 2</option>
          <option value="15" <?php if($this->setting_openidconnect_iconstyle == 15):?>selected="selected"<?php endif; ?>>All small icons</option>
        </select>

        <br><br>
          <?php echo $this->translate("Preview"); ?> <br>
          <div style="width: 170px; margin: 0px auto; padding-top: 5px">
          <img id="openidconnect_iconstyle_10" src="application/modules/Socialdna/externals/images/10.png" <?php if($this->setting_openidconnect_iconstyle != 10) : ?>style='display:none'<?php endif; ?>>
          <img id="openidconnect_iconstyle_11" src="application/modules/Socialdna/externals/images/11.png" <?php if($this->setting_openidconnect_iconstyle != 11) : ?>style='display:none'<?php endif; ?>>
          <img id="openidconnect_iconstyle_12" src="application/modules/Socialdna/externals/images/12.png" <?php if($this->setting_openidconnect_iconstyle != 12) : ?>style='display:none'<?php endif; ?>>
          <img id="openidconnect_iconstyle_13" src="application/modules/Socialdna/externals/images/13.png" <?php if($this->setting_openidconnect_iconstyle != 13) : ?>style='display:none'<?php endif; ?>>
          <img id="openidconnect_iconstyle_14" src="application/modules/Socialdna/externals/images/14.png" <?php if($this->setting_openidconnect_iconstyle != 14) : ?>style='display:none'<?php endif; ?>>
          <img id="openidconnect_iconstyle_15" src="application/modules/Socialdna/externals/images/15.png" <?php if($this->setting_openidconnect_iconstyle != 15) : ?>style='display:none'<?php endif; ?>>
          </div>
        </td>
        </tr>
    </table>
    
  </div>
</div>



<br>
<br>


<div class="form-wrapper">
  <div class="form-label">&nbsp;</div>
  <div class="form-element">
  <button type="submit" id="submit" name="submit"><?php echo $this->translate("Save Changes") ?></button>
  </div>
</div>

<input type='hidden' name='task' value='dosave'>

</div>
</div>








</form>

      </div>

  </div>
</div>
