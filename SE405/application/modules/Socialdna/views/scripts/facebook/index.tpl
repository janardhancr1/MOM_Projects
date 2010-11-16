<?php
  $this->headScript()
    ->appendFile($this->baseUrl() . '/application/modules/Semods/externals/scripts/semods.js')
    ->appendFile($this->baseUrl() . '/application/modules/Socialdna/externals/scripts/socialdna.js')
?>

<div class='layout_middle'>
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


<?php if (!$this->service_connected): ?>

  <br><br>
  
  <table cellspacing=0 cellpadding=0 align='center' style="margin: 0px auto">
  <tr>
    <td>
    <?php echo $this->translate('socialdna_facebook_not_connected') ?>
    <br><br><br>
    </td>
    </tr>
    <tr>
    <td align="center" style="text-align: center">
    <?php echo $this->partial('_facebookButton.tpl') ?>
    </td>
  </tr>
  </table>

  <br><br>




<?php else: ?>


  <div id="openidconnect_facebook_require_login_loading" style="display:block">

    <br>
    <br>
    <table cellpadding='0' cellspacing='0' align='center' style="margin: 0px auto">
    <tr><td class='result'>
      <img src='application/modules/Socialdna/externals/images/icons/ajaxprogress1.gif' border='0' style='float: left; padding-right: 5px'><?php echo $this->translate('socialdna_facebook_loading') ?>
    </td></tr>
    </table>

  </div>


  <div id="openidconnect_facebook_notloggedin" style="display:none">

    <br>
    <br>
    <table cellpadding='0' cellspacing='0' align='center' style="margin: 0px auto">
    <tr><td>

      <?php echo $this->translate('socialdna_facebook_login_for_friends') ?> <br><br>
  
      <div style="padding-bottom: 10px; padding-left: 20px">
      <?php echo $this->partial('_facebookButton.tpl') ?>
      </div>

    </td></tr>
    </table>

    <br>
    <br>

  </div>


  <div id="openidconnect_facebook_loggedin" style="display:none">
      
      <div style='padding: 20px; margin-top: 20px;'>
        
        <div style="font-size: 14px; border-bottom: 1px solid #EEE; padding-bottom: 2px; margin-bottom: 7px;">
          <div style="float: left; font-size: 14px">

          <?php echo $this->translate(array('You have %s Facebook friend that is already here', 'You have %s Facebook friends that are already here', $this->linked_friends_stats['connected_friends']),$this->locale()->toNumber($this->linked_friends_stats['connected_friends'])) ?>
          
          </div>
          <div style="float: right; font-size: 14px"><a href="<?php echo $this->url(array(), 'socialdna_facebookfriends'); ?>"><?php echo $this->translate('socialdna_facebook_friends_seeall') ?></a></div>
          <div style="clear:both"></div>
        </div>
  
        <div style="padding: 5px">
        <?php if (count($this->linked_friends) > 0): ?>
          <?php foreach($this->linked_friends as $linked_friend): ?>
          <div style="width: 50px; float: left; padding-right: 5px; padding-bottom: 5px">
            <a href="<?php echo $this->user($linked_friend['user_id'])->getHref() ?>">
              <img border='0' width=50 height=50 src="<?php echo $linked_friend['user_openid_thumb'] ?>" alt="<?php echo $this->user($linked_friend['user_id'])->getTitle() ?>">
            </a>
          </div>
          <?php endforeach; ?>
        <div style="clear:both"></div>
        <?php else: ?>
          <?php echo $this->translate('socialdna_facebook_friends_nofriends') ?> <a href="<?php echo $this->url(array(), 'socialdna_facebookinvite'); ?>"> <?php echo $this->translate('socialdna_facebook_friends_invite') ?> </a>
        <?php endif; ?>
        </div>
        
      </div>
        
      <div style='padding: 20px; margin-top: 40px; margin-bottom: 40px;'>
  
        <div style="font-size: 14px; border-bottom: 1px solid #EEE; padding-bottom: 2px; margin-bottom: 7px;">
          <div style="float: left; font-size: 14px"><?php echo $this->translate('socialdna_facebook_friends_nothere') ?></div>
          <?php if ($this->linked_friends_stats['unconnected_friends'] != 0): ?>
          <div style="float: right; font-size: 14px"><a href="<?php echo $this->url(array(), 'socialdna_facebookinvite'); ?>"><?php echo $this->translate('socialdna_facebook_friends_invitefriends') ?></a></div>
          <?php endif; ?>
          <div style="clear:both"></div>
        </div>
  
        <div style="padding: 5px">
        <?php if (count($this->unlinked_friends) > 0): ?>
          <?php foreach($this->unlinked_friends as $unlinked_friend): ?>
          <div style="width: 50px; float: left; padding-right: 2px; padding-bottom: 2px">
            <a href="<?php echo $this->url(array(), 'socialdna_facebookinvite'); ?>">
              <img border='0' width=50 height=50 src="<?php echo $unlinked_friend['pic_square'] ?>" alt="<?php echo $unlinked_friend['name'] ?>" title="<?php echo $unlinked_friend['name'] ?>">
            </a>
          </div>
          <?php endforeach; ?>
        <div style="clear:both"></div>
        <?php else: ?>
          <?php echo $this->translate('socialdna_facebook_friends_allhere') ?>
        <?php endif; ?>
        </div>
        
      </div>
        
  </div>

  <script type="text/javascript">
  openidconnect_facebook_require_login();
  </script>

  <br><br>

  <!--  
  <div style="color: #999">
    <a style="color: #999" href="javascript:void(0)" onclick="openidconnect_facebook_disconnect('<?php echo $this->url(array('task' => 'disconnect', 'next' => 'user_logout'), 'socialdna_facebook'); ?>')"><?php echo $this->translate('socialdna_facebook_disconnect') ?></a>
  </div>
  -->


<?php endif; ?>
</div>