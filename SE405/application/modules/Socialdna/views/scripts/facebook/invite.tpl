
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


  <div id="openidconnect_facebook_connect" style="display:none">

    <br>
    <br>
    <table cellpadding='0' cellspacing='0' align='center' style="margin: 0px auto">
    <tr><td>

      <?php echo $this->translate('socialdna_facebook_invite_login') ?> <br><br>
  
      <div style="padding-bottom: 10px; padding-left: 20px">
      
      <?php echo $this->partial('_facebookButton.tpl', array('openid_facebook_landingpage'  => $this->openid_facebook_landingpage) ) ?>
      
      </div>

    </td></tr>
    </table>

    <br>
    <br>

  </div>

  <div id="openidconnect_facebook_invite_dialog" style="display:block">

      <div style='padding-left: 11px; text-align: center; width: 740px'>

      <span><?php echo $this->translate('socialdna_facebook_invite_tophelp') ?> <a href="<?php echo $this->url(array(),'invite'); ?>"><?php echo $this->translate('socialdna_facebook_invite_tophelp_link') ?></a></span>
      
      </div>
    
    <?php echo $this->partial('_facebookInvite.tpl',
                              array( 'openid_invite_facebook_content' => $this->openid_invite_facebook_content,
                                     'openid_invite_facebook_action'  => $this->openid_invite_facebook_action,
                                     'openid_invite_facebook_type'    => $this->openid_invite_facebook_type,
                                     'openid_invite_facebook_max'     => $this->openid_invite_facebook_max,
                                     'openid_invite_facebook_actiontext'  => $this->openid_invite_facebook_actiontext
                                    )
                             );
    ?>

  </div>

  <script type="text/javascript">
  openidconnect_register_invite_form();
  </script>
