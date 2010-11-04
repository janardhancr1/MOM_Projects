<?php
  $this->headScript()
    ->appendFile($this->baseUrl() . '/application/modules/Semods/externals/scripts/semods.js')
    ->appendFile($this->baseUrl() . '/application/modules/Socialdna/externals/scripts/socialdna.js')
?>
<?php

  $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
  if( null !== $viewRenderer && $viewRenderer->view instanceof Zend_View_Interface ) {
    $myview = $viewRenderer->view;
  }
  
?>


<div id="socialdna_form">

  <?php if( count($this->navigation) ): ?>
  <div class="headline">
    <h2>
      <?php echo $this->translate('Social DNA');?>
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
  <?php endif; ?>

  <?php if ($this->result != ""): ?>
  <div id="statusmessage" style='margin-left:340px;'>
    <ul class="form-notices"><li><?php echo $this->translate($this->result) ?></li></ul>
  </div>
  <?php endif; ?>

  <?php if ($this->error_message != ""): ?>
  <div id="errormessage" style='margin-left:340px;'>
    <ul class="form-errors"><li><?php echo $this->translate($this->error_message) ?></li></ul>
  </div>
  <?php endif; ?>








<h3><?php echo $this->translate('socialdna_social_connected_networks') ?></h3>
<div class="extra_info" style="padding-top: 5px">
  <?php echo $this->translate('socialdna_social_connected_networks_help') ?>
</div>
<br />
<div >
  
  <table cellpadding=0 cellspacing=0 class="socialdna_services_table">

      <?php foreach($this->openid_services as $openid_service): ?>
      <?php if ($openid_service['openidservice_can_status'] OR $openid_service['openidservice_can_newsfeed'] OR $openid_service['openidservice_can_friends'] OR $openid_service['openidservice_can_message'] OR $openid_service['openidservice_can_stream']): ?>
      <tr>
      <td>

          <img style="float:left; padding-right: 5px; width: 32px" src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_square']?>" title="<?php echo $openid_service['openidservice_displayname']; ?>">

          <div style="padding-left: 40px; padding-top: 5px; color: #777">
            <span class="socialdna_service_name"><?php echo $openid_service['openidservice_displayname']; ?></span>
          </div>

      </td>
      <td style='min-width: 200px'>
          
          <div style="Xpadding-left: 40px; Xpadding-top: 5px; color: #777; padding-right: 10px">
            <!--<span class="socialdna_service_name"><?php echo $openid_service['openidservice_displayname']; ?></span>-->
            <?php if (array_key_exists($openid_service['openidservice_name'],$this->openidconnect_user_services)): ?>

            <?php if($this->openidconnect_user_services[$openid_service['openidservice_name']]['openid_user_photo'] != '') : ?>
            <img style="width: 32px; float: left; padding-right: 5px" src="<?php echo $this->openidconnect_user_services[$openid_service['openidservice_name']]['openid_user_photo'] ?>">
            <?php endif; ?>
            
            <p style="padding-left: 37px"><?php echo $this->translate('socialdna_social_connected_networks_connected') ?><?php if ($this->openidconnect_user_services[$openid_service['openidservice_name']]['openid_user_displayname'] != ''): ?> <?php echo $this->translate('socialdna_social_connected_networks_as') ?> <strong><?php echo $this->openidconnect_user_services[$openid_service['openidservice_name']]['openid_user_displayname']; ?></strong><?php endif; ?>. </p><p style="padding-left: 37px">(<a href="<?php echo $this->url(array(), 'socialdna') . '?task=disconnect&openidservice=' . $openid_service['openidservice_name']; ?>"><?php echo $this->translate('socialdna_social_connected_networks_disconnect') ?></a>)</p>
            
            <?php else: ?>
            
            <div style="padding-top: 5px">
            <a href="javascript:void(0)" onclick="openidconnect_connect_service('<?php echo $openid_service['openidservice_name']; ?>',openidconnect_onNotifyConnectedSocial)"><?php echo $this->translate('socialdna_social_connected_networks_connect') ?></a>
            </div>
            
            <?php endif; ?>
            
          </div>

      </td>

      <!--
      <td>
        <ul style="color: #777; padding-left: 20px">
          <?php if($openid_service['openidservice_can_status']) : ?>
          <li style="padding-bottom: 3px"><img style="float: left; padding-right: 2px" src="application/modules/Socialdna/externals/images/icons/1.png"> <?php echo $this->translate('Update your status') ?> </li>
          <?php endif; ?>
          <?php if($openid_service['openidservice_can_stream']) : ?>
          <li style="padding-bottom: 3px"><img style="float: left; padding-right: 2px" src="application/modules/Socialdna/externals/images/icons/1.png"> <?php echo $this->translate("See your friends' activities") ?> </li>
          <?php endif; ?>
          <?php if($openid_service['openidservice_can_friends']) : ?>
          <li style="padding-bottom: 3px"><img style="float: left; padding-right: 2px" src="application/modules/Socialdna/externals/images/icons/1.png"> <?php echo $this->translate("See your friends") ?> </li>
          <?php endif; ?>
          <?php if($openid_service['openidservice_can_message']) : ?>
          <li style="padding-bottom: 3px"><img style="float: left; padding-right: 2px" src="application/modules/Socialdna/externals/images/icons/1.png"> <?php echo $this->translate("Message your friends") ?> </li>
          <?php endif; ?>
          <?php if($openid_service['openidservice_can_newsfeed']) : ?>
          <li style="padding-bottom: 3px"><img style="float: left; padding-right: 2px" src="application/modules/Socialdna/externals/images/icons/1.png"> <?php echo $this->translate("Publish your updates") ?> </li>
          <?php endif; ?>
        </ul>
      </td>
      -->
      
      </tr>

        <?php endif; ?>
      <?php endforeach; ?>
      
    </table>
    
</div>


<br><br><br><br>


<h3><?php echo $this->translate('socialdna_social_connected_networks_quicklogin') ?></h3>
<div class="extra_info" style="padding-top: 5px">
  <?php echo $this->translate('socialdna_social_connected_networks_quicklogin_help') ?>
</div>
<br />
<div>
  
  <table cellpadding=0 cellspacing=0 class="socialdna_services_table">

      <?php foreach($this->openid_services as $openid_service): ?>
      <?php //if ((!$openid_service['openidservice_can_status'] AND !$openid_service['openidservice_can_newsfeed'] AND !$openid_service['openidservice_can_friends'] AND !$openid_service['openidservice_can_message'] AND !$openid_service['openidservice_can_stream']) && array_key_exists($openid_service['openidservice_name'],$this->openidconnect_user_services)): ?>
      <?php if ((!$openid_service['openidservice_can_status'] AND !$openid_service['openidservice_can_newsfeed'] AND !$openid_service['openidservice_can_friends'] AND !$openid_service['openidservice_can_message'] AND !$openid_service['openidservice_can_stream'])): ?>
      <tr>
      <td>

        <img style="float:left; padding-right: 5px; width: 32px" src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_square'] ?>" title="<?php echo $openid_service['openidservice_displayname'] ?>">

        <div style="padding-left: 40px; padding-top: 5px; color: #777">
          <span class="socialdna_service_name"><?php echo $openid_service['openidservice_displayname']; ?></span>
        </div>
        
      </td>
      
      <td style='min-width: 200px'>

          <div style="Xpadding-left: 40px; Xpadding-top: 5px; color: #777; padding-right: 10px">
            <?php if (array_key_exists($openid_service['openidservice_name'],$this->openidconnect_user_services)): ?>

            <?php if($this->openidconnect_user_services[$openid_service['openidservice_name']]['openid_user_photo'] != '') : ?>
            <img style="width: 32px; float: left; padding-right: 5px" src="<?php echo $this->openidconnect_user_services[$openid_service['openidservice_name']]['openid_user_photo'] ?>">
            <?php endif; ?>

            <p style="padding-left: 37px"><?php echo $this->translate('socialdna_social_connected_networks_connected') ?><?php if ($this->openidconnect_user_services[$openid_service['openidservice_name']]['openid_user_displayname'] != ''): ?> <?php echo $this->translate('socialdna_social_connected_networks_as') ?> <strong><?php echo $this->openidconnect_user_services[$openid_service['openidservice_name']]['openid_user_displayname']; ?></strong><?php endif; ?>. </p><p style="padding-left: 37px">(<a href="<?php echo $this->url(array(), 'socialdna') . '?task=disconnect&openidservice=' . $openid_service['openidservice_name']; ?>"><?php echo $this->translate('socialdna_social_connected_networks_disconnect') ?></a>)</p>

            <?php else: ?>

            <div style="padding-top: 5px">
            <a href="javascript:void(0)" onclick="openidconnect_connect_service('<?php echo $openid_service['openidservice_name']; ?>',openidconnect_onNotifyConnectedSocial)"><?php echo $this->translate('socialdna_social_connected_networks_connect') ?></a>
            </div>
            
            
            <?php endif; ?>
          </div>
          
      
        </td>
        </tr>
        <?php endif; ?>
      <?php endforeach; ?>
      
    </table>
    
</div>


<div class="table_clear" style="margin-top:20px;">
</div>			












</div>

