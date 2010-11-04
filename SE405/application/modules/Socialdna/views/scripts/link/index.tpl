<?php
  $this->headScript()
    ->appendFile($this->baseUrl() . '/application/modules/Semods/externals/scripts/semods.js')
    ->appendFile($this->baseUrl() . '/application/modules/Socialdna/externals/scripts/socialdna.js')
?>

  <br><br>

  <table cellpadding='0' cellspacing='0' style='margin: 0px auto'>
  <tr>
  <td style="vertical-align:top; padding-right: 10px; width: 50px; text-align: right">
    <?php if($this->openid_user_thumb != '') : ?>
    <img border='0' src="<?php echo $this->openid_user_thumb ?>" style="max-width: 50px; Xmargin-bottom: -19px">
    <?php endif; ?>
    <img border='0' src="application/modules/Socialdna/externals/images/brands/<?php echo $this->openid_service_info['openidservice_logo_mini'] ?>" alt="<?php echo $this->openid_service_info['openidservice_displayname'] ?>">
  </td>
  <td style="vertical-align:top">
    <div>
      <?php echo $this->translate("socialdna_openid_link_loggedinas") ?> <strong><?php echo $this->user_full_name ?></strong> <br><br>
      
      <?php echo sprintf($this->translate("socialdna_openid_link_question"), $this->openid_service_info['openidservice_displayname']) ?> 
    </div>
     <br><br><br>
  </td>
  </tr>
  <tr>
  <td colspan=2 align='center'>

    <?php if(!$this->already_linked) : ?>

    <form method="post" action="<?php echo $this->url(array(), 'socialdna_link') ?>">
    <input type="hidden" name="openidsession" id="openidsession" value="<?php echo $this->openid_session ?>" />
    <input type="hidden" name="openidservice" id="openidservice" value="<?php echo $this->openid_service ?>" />
    <input type="hidden" name="task" value="confirmlink" />
    <input type='hidden' name='next' value='<?php echo $this->next ?>'>
  
    <button type='submit' class='button'><?php echo $this->translate('socialdna_openid_link_confirm') ?></button> <?php echo $this->translate('or') ?> <a href="<?php echo $this->url(array('action'  => 'home'), 'user_general') ?>"><?php echo $this->translate('socialdna_openid_link_cancel') ?></a>
  
    </form>

    <?php else : ?>
    
    <div class='error'>
      <?php echo sprintf($this->translate("socialdna_connect_this_account_linked_another"), $this->openid_service_info['openidservice_displayname']) ?> 
    </div>
    
    <?php endif; ?>

  </td>
  </tr>
  </table>

  <br><br>
