

<!-- boot facebook -->

<script type="text/javascript">
  var openidconnect_primary_network = 'facebook';

  var openidconnect_facebook_api_key = "<?php echo $this->openidconnect_facebook_api_key ?>";
  var openidconnect_facebook_user_id = "<?php echo $this->openidconnect_facebook_user_id ?>";
  
  var openidconnect_autologin_url = "<?php echo $this->openidconnect_autologin_url ?>";
  var openidconnect_logout_url = "<?php echo $this->openidconnect_logout_url ?>";
  var openidconnect_relay_url = "<?php echo $this->openidconnect_relay_url ?>";
  var openidconnect_fbe = "<?php echo $this->openidconnect_fbe ?>";
</script>

<script type="text/javascript">
var fbHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://static.ak.");
document.write(unescape("%3Cscript src='" + fbHost + "connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/<?php echo $this->facebook_locale ?>' type='text/javascript'%3E%3C/script%3E"));
</script>


<?php if ($this->openidconnect_request_connect): ?>
<div id="openidconnect_connect_prompt" style="display:none">

    <div id='form_div' class="form_div">
  
      <div style="border-bottom: 1px solid #DDD; margin-bottom: 10px; padding-bottom: 5px;">
        <img style="float:left; padding-right: 5px; width: 16px" src="application/modules/Socialdna/externals/images/brands/logo_facebook_mini.gif"> &nbsp; <span style="font-size: 14px"><?php echo $this->translate('socialdna_facebook_publish_stories') ?></span>
      </div>
      
      <br/>
      
        <?php echo $this->translate('socialdna_facebook_not_logged_in') ?>

      <br/>
      <br/>
        
        <table cellpadding='0' cellspacing='0' style="margin: 0px auto">
        <tr>
        <td><input type='submit' style="width: 150px" class='button openidconnect_connect_prompt_confirmed' onclick="openidconnect_facebook_request_connect_confirmed()" value="<?php echo $this->translate('socialdna_facebook_connect_button') ?>">&nbsp;&nbsp;</td>
        <td style="padding-left: 10px"> <?php echo $this->translate('socialdna_openid_or') ?> <a href="javascript:void(0)" class='openidconnect_connect_prompt_cancel' onclick="openidconnect_facebook_request_connect_cancel()"><?php echo $this->translate('socialdna_facebook_cancel_button') ?></a>&nbsp;&nbsp;</td>
        </tr>
        </table>

      <br/>

    </div>
  
</div>
<?php endif; ?>






<?php if (!Semods_Utils::isUser()): ?>
<div id="openidconnect_autologin_prompt" style="display:none; padding: 10px">

  <div id='form_div' class="form_div">

    <div style="border-bottom: 1px solid #DDD; margin-bottom: 10px; padding-bottom: 5px; color: #555">
      <img style="float:left; padding-right: 5px; width: 16px" src="application/modules/Socialdna/externals/images/brands/logo_facebook_mini.gif"> &nbsp; <span style="font-size: 14px"><?php echo $this->translate('socialdna_facebook_login_via_facebook_title') ?></span>
    </div>
    
    <br/>


    <div style="position: relative; text-align: center;">
    
      <div style="margin: 0px auto;width: 500px; color: #555">
        <?php echo $this->translate('socialdna_facebook_login_via_facebook_message') ?>
      </div>

    </div>

    <br/>
    <br/>
      
      <table cellpadding='0' cellspacing='0' style="margin: 0px auto">
      <tr>
      <td><button type='submit' style="width: 150px" class='button openidconnect_autologin_prompt_confirmed' onclick="openidconnect_autologin_confirmed()"><?php echo $this->translate('socialdna_facebook_login_via_facebook_login') ?></button>&nbsp;&nbsp;</td>
      <td style="padding-left: 10px; color: #555"> <?php echo $this->translate('socialdna_openid_or') ?> <a class="openidconnect_autologin_prompt_cancel"  href="javascript:void(0)" onclick="openidconnect_autologin_cancel()"><?php echo $this->translate('socialdna_facebook_login_via_facebook_cancel') ?></a>&nbsp;&nbsp;</td>
      </tr>
      <tr>
      <td style="padding-top: 5px">

        <input class="openidconnect_autologin_remember" type='checkbox' style="vertical-align:middle">&nbsp;&nbsp;<label for='openidconnect_autologin_remember' style="vertical-align:middle; float: left; color: #555"><?php echo $this->translate('socialdna_facebook_login_via_facebook_remember') ?></label>

      </td>
      <td> &nbsp; </td>
      </tr>
      </table>

    <br/>

  </div>
  
</div>
<?php endif; ?>







<?php if ($this->openidconnect_feed_story_publish): ?>

  <div id="openidconnect_publish_feed_story_prompt" style="display:none; padding-bottom: 10px;">
  
      <div id='form_div' class="form_div">
    
        <div style="border-bottom: 1px solid #DDD; margin-bottom: 10px; Xmargin-left:-10px; margin-bottom: 10px; Xmargin-right: -10px; padding: 10px 10px 10px 10px;">
          <span style="font-size: 14px; color: #555"><?php echo $this->translate('socialdna_publisher_wouldyou') ?></span>
        </div>
        
        <br/>
        
        <div style='margin: 0px auto; width: 550px'>

        <div style="position: relative; text-align: center; padding-left: 60px">

          <a href="javascript:void(0)" onclick="return false;" style="position: absolute; left: 0px">
            <?php echo $this->user_avatar ?>
          </a>

          <div style="font-size: 13px; font-weight: bold; margin-bottom: 10px; text-align: left; color: #888;">
            <?php if ($this->openidconnect_feed_story['user_prompt'] != ''): ?>
            <?php echo $this->openidconnect_feed_story['user_prompt'] ?>
            <?php else: ?>
            <?php echo $this->translate('socialdna_publisher_whatsonyourmind') ?>
            <?php endif; ?>
          </div>

          <div style='margin-bottom: 10px; Xmargin: 0px auto 10px auto; Xwidth: 500px; text-align: left'>
            <textarea style='width: 480px; height: 48px; overflow: hidden; background-color: #FFF; border-color:#999999 #CCCCCC #CCCCCC #999999; border-width:1px;color:#555555;font-size:10pt;padding:2px;' Xrows='1' name='openidconnect_user_message' class='openidconnect_user_message'><?php echo $this->openidconnect_feed_story['user_message'] ?></textarea>
          </div>
            
          <?php if (($this->openidconnect_feed_story['feed_params']['story_preview_image'] != '') OR ($this->openidconnect_feed_story['feed_params']['attachment']['name'] != '') OR ($this->openidconnect_feed_story['feed_params']['attachment']['description'] != '')): ?>
          <div style="padding-left: 10px; border-left: 2px solid #DDD; Xborder: 1px solid #EEE; Xbackground-color: #F6F6F6; background-color: #FFF; Xpadding: 20px; margin: 0px auto; margin-bottom: 10px; width: 500px; text-align: left">
            
            <table cellspacing=0 cellpadding=0>
            <tr>
              <?php if ($this->openidconnect_feed_story['feed_params']['story_preview_image'] != ''): ?>
              <td valign="top" style='padding-right: 5px; padding-top: 3px'>
                <img width="50" src="<?php echo $this->openidconnect_feed_story['feed_params']['story_preview_image'] ?>">
              </td>
              <?php endif; ?>
              <td valign="top">
              <?php if ($this->openidconnect_feed_story['feed_params']['attachment']): ?>
                <div style="font-weight: bold; margin-bottom: 5px; padding-top: 3px;">
                  <?php if (isset($this->openidconnect_feed_story['feed_params']['attachment']['href']) AND $this->openidconnect_feed_story['feed_params']['attachment']['href'] != ''): ?>
                  <a target=_blank href="<?php echo $this->openidconnect_feed_story['feed_params']['attachment']['href'] ?>"><?php echo $this->openidconnect_feed_story['feed_params']['attachment']['name'] ?></a>
                  <?php else: ?>
                  <?php echo $this->openidconnect_feed_story['feed_params']['attachment']['name'] ?>
                  <?php endif; ?>
                </div>
                <div style='color: #555; font-size: 10pt; text-align: left'>

                  <?php echo $this->viewMore($this->openidconnect_feed_story['feed_params']['attachment']['description']) ?>
                  
                  <?php
                  //echo $this->openidconnect_feed_story['feed_params']['attachment']['description'] shorten to 200, then split 60
                  ?>
                  
                </div>
                <?php endif; ?>
              </td>
            </tr>
            </table>
            
          </div>
          <?php endif; ?>
  
        </div>

        </div>

          <div style="font-weight: bold; font-size: 13px; color: #888; Xwidth: 500px; margin-left: 86px; Xmargin: 0px auto; margin-top:30px; margin-bottom: 10px">
            <?php echo $this->translate('socialdna_publisher_publishto') ?>:
          </div>
        
        <table cellpadding=0 cellspacing=0 style='margin: 0px auto; Xmargin-top:30px; Xwidth: 500px'>
        <tr>
          <td>
            
          <div>
          <?php if (in_array('facebook',$this->openidconnect_publisher_services)): ?>
          <div style="float: left; height: 38px" onmouseover="SEMods.B.show( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_user_facebook') )" onmouseout="SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_user_facebook') )">
            <div>
            <input class="openidconnect_publish_feed_story_service openidconnect_publish_feed_story_service_facebook openidconnect_checkbox" type='checkbox' style="float: left; vertical-align:middle" value="facebook" <?php if (array_key_exists('facebook',$this->openidconnect_user_services)): ?>checked="checked"<?php else: ?>onclick="openidconnect_connect_service('facebook')"<?php endif; ?>> <img style="float:left; padding-right: 5px; Xwidth: 16px" src="application/modules/Socialdna/externals/images/brands/facebook32.png"> &nbsp;
            <div style="clear:both"></div>
            </div>
            <div style="display: none;" id="openidconnect_publish_feed_story_service_facebook_user" class="openidconnect_publish_feed_story_service_user openidconnect_publish_feed_story_service_user_facebook">
            <?php if (array_key_exists('facebook',$this->openidconnect_user_services) AND $this->openidconnect_user_services['facebook']['openid_user_displayname'] != ''): ?>
            <?php echo $this->translate('socialdna_publisher_connectedas') ?> <span><?php echo $this->openidconnect_user_services['facebook']['openid_user_displayname'] ?></span>
            <?php else: ?>
            <?php echo $this->translate('socialdna_publisher_connect') ?>
            <?php endif; ?>
            </div>
          </div>
          <?php endif; ?>
          <?php if (in_array('twitter',$this->openidconnect_publisher_services)): ?>
          <div style="float: left; height: 38px" onmouseover="SEMods.B.show( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_user_twitter') )" onmouseout="SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_user_twitter') )">
            <div>
            <input class="openidconnect_publish_feed_story_service openidconnect_publish_feed_story_service_twitter openidconnect_checkbox" type='checkbox' style="float: left; vertical-align:middle" value="twitter" <?php if (array_key_exists('twitter',$this->openidconnect_user_services)): ?>checked="checked"<?php else: ?>onclick="openidconnect_connect_service('twitter')"<?php endif; ?>> <img style="float:left; padding-right: 5px; Xwidth: 16px" src="application/modules/Socialdna/externals/images/brands/twitter32.png"> &nbsp;
            <div style="clear:both"></div>
            </div>
            <div style="display: none" id="openidconnect_publish_feed_story_service_twitter_user" class="openidconnect_publish_feed_story_service_user openidconnect_publish_feed_story_service_user_twitter">
            <?php if (array_key_exists('twitter',$this->openidconnect_user_services) AND $this->openidconnect_user_services['twitter']['openid_user_displayname'] != ''): ?>
            <?php echo $this->translate('socialdna_publisher_connectedas') ?> <span><?php echo $this->openidconnect_user_services['twitter']['openid_user_displayname'] ?></span>
            <?php else: ?>
            <?php echo $this->translate('socialdna_publisher_connect') ?>
            <?php endif; ?>
            </div>
          </div>
          <?php endif; ?>
          <?php if (in_array('myspace',$this->openidconnect_publisher_services)): ?>
          <div style="float: left; height: 38px" onmouseover="SEMods.B.show( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_user_myspace') )" onmouseout="SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_user_myspace') )">
            <div>
            <input class="openidconnect_publish_feed_story_service openidconnect_publish_feed_story_service_myspace openidconnect_checkbox" type='checkbox' style="float: left; vertical-align:middle" value="myspace" <?php if (array_key_exists('myspace',$this->openidconnect_user_services)): ?>checked="checked"<?php else: ?>onclick="openidconnect_connect_service('myspace')"<?php endif; ?>> <img style="float:left; padding-right: 5px; Xwidth: 16px" src="application/modules/Socialdna/externals/images/brands/myspace32.png"> &nbsp;
            <div style="clear:both"></div>
            </div>
            <div style="display: none" id="openidconnect_publish_feed_story_service_myspace_user" class="openidconnect_publish_feed_story_service_user openidconnect_publish_feed_story_service_user_myspace">
            <?php if (array_key_exists('myspace',$this->openidconnect_user_services) AND $this->openidconnect_user_services['myspace']['openid_user_displayname'] != ''): ?>
            <?php echo $this->translate('socialdna_publisher_connectedas') ?> <span><?php echo $this->openidconnect_user_services['myspace']['openid_user_displayname'] ?></span>
            <?php else: ?>
            <?php echo $this->translate('socialdna_publisher_connect') ?>
            <?php endif; ?>
            </div>
          </div>
          <?php endif; ?>
          <?php if (in_array('yahoo',$this->openidconnect_publisher_services)): ?>
          <div style="float: left; height: 38px" onmouseover="SEMods.B.show( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_user_yahoo') )" onmouseout="SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_user_yahoo') )">
            <div>
            <input class="openidconnect_publish_feed_story_service openidconnect_publish_feed_story_service_yahoo openidconnect_checkbox" type='checkbox' style="float: left; vertical-align:middle" value="yahoo" <?php if (array_key_exists('yahoo',$this->openidconnect_user_services)): ?>checked="checked"<?php else: ?>onclick="openidconnect_connect_service('yahoo')"<?php endif; ?>> <img style="float:left; padding-right: 5px; Xwidth: 16px" src="application/modules/Socialdna/externals/images/brands/yahoo32.png"> &nbsp;
            <div style="clear:both"></div>
            </div>
            <div style="display: none" id="openidconnect_publish_feed_story_service_yahoo_user" class="openidconnect_publish_feed_story_service_user openidconnect_publish_feed_story_service_user_yahoo">
            <?php if (array_key_exists('yahoo',$this->openidconnect_user_services) AND $this->openidconnect_user_services['yahoo']['openid_user_displayname'] != ''): ?>
            <?php echo $this->translate('socialdna_publisher_connectedas') ?> <span><?php echo $this->openidconnect_user_services['yahoo']['openid_user_displayname'] ?></span>
            <?php else: ?>
            <?php echo $this->translate('socialdna_publisher_connect') ?>
            <?php endif; ?>
            </div>
          </div>
          <?php endif; ?>
          <?php if (in_array('linkedin',$this->openidconnect_publisher_services)): ?>
          <div style="float: left; height: 38px" onmouseover="SEMods.B.show( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_user_linkedin') )" onmouseout="SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_user_linkedin') )">
            <div>
            <input class="openidconnect_publish_feed_story_service openidconnect_publish_feed_story_service_linkedin openidconnect_checkbox" type='checkbox' style="float: left; vertical-align:middle" value="linkedin" <?php if (array_key_exists('linkedin',$this->openidconnect_user_services)): ?>checked="checked"<?php else: ?>onclick="openidconnect_connect_service('linkedin')"<?php endif; ?>> <img style="float:left; padding-right: 5px; Xwidth: 16px" src="application/modules/Socialdna/externals/images/brands/linkedin32.png"> &nbsp;
            <div style="clear:both"></div>
            </div>
            <div style="display: none" id="openidconnect_publish_feed_story_service_linkedin_user" class="openidconnect_publish_feed_story_service_user openidconnect_publish_feed_story_service_user_linkedin">
            <?php if (array_key_exists('linkedin',$this->openidconnect_user_services) AND $this->openidconnect_user_services['linkedin']['openid_user_displayname'] != ''): ?>
            <?php echo $this->translate('socialdna_publisher_connectedas') ?> <span><?php echo $this->openidconnect_user_services['linkedin']['openid_user_displayname'] ?></span>
            <?php else: ?>
            <?php echo $this->translate('socialdna_publisher_connect') ?>
            <?php endif; ?>
            </div>
          </div>
          <?php endif; ?>
          <?php if (in_array('friendster',$this->openidconnect_publisher_services)): ?>
          <div style="float: left; height: 38px" onmouseover="SEMods.B.show( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_user_friendster') )" onmouseout="SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_user_friendster') )">
            <div>
            <input class="openidconnect_publish_feed_story_service openidconnect_publish_feed_story_service_friendster openidconnect_checkbox" type='checkbox' style="float: left; vertical-align:middle" value="friendster" <?php if (array_key_exists('friendster',$this->openidconnect_user_services)): ?>checked="checked"<?php else: ?>onclick="openidconnect_connect_service('friendster')"<?php endif; ?>> <img style="float:left; padding-right: 5px; Xwidth: 16px" src="application/modules/Socialdna/externals/images/brands/friendster32.png"> &nbsp;
            <div style="clear:both"></div>
            </div>
            <div style="display: none" id="openidconnect_publish_feed_story_service_friendster_user" class="openidconnect_publish_feed_story_service_user openidconnect_publish_feed_story_service_user_friendster">
            <?php if (array_key_exists('friendster',$this->openidconnect_user_services) AND $this->openidconnect_user_services['friendster']['openid_user_displayname'] != ''): ?>
            <?php echo $this->translate('socialdna_publisher_connectedas') ?> <span><?php echo $this->openidconnect_user_services['friendster']['openid_user_displayname'] ?></span>
            <?php else: ?>
            <?php echo $this->translate('socialdna_publisher_connect') ?>
            <?php endif; ?>
            </div>
          </div>
          <?php endif; ?>
          <?php if (in_array('orkut',$this->openidconnect_publisher_services)): ?>
          <div style="float: left; height: 38px" onmouseover="SEMods.B.show( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_user_orkut') )" onmouseout="SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_user_orkut') )">
            <div>
            <input class="openidconnect_publish_feed_story_service openidconnect_publish_feed_story_service_orkut openidconnect_checkbox" type='checkbox' style="float: left; vertical-align:middle" value="orkut" <?php if (array_key_exists('orkut',$this->openidconnect_user_services)): ?>checked="checked"<?php else: ?>onclick="openidconnect_connect_service('orkut')"<?php endif; ?>> <img style="float:left; padding-right: 5px; Xwidth: 16px" src="application/modules/Socialdna/externals/images/brands/orkut32.png"> &nbsp;
            <div style="clear:both"></div>
            </div>
            <div style="display: none" id="openidconnect_publish_feed_story_service_orkut_user" class="openidconnect_publish_feed_story_service_user openidconnect_publish_feed_story_service_user_orkut">
            <?php if (array_key_exists('orkut',$this->openidconnect_user_services) AND $this->openidconnect_user_services['orkut']['openid_user_displayname'] != ''): ?>
            <?php echo $this->translate('socialdna_publisher_connectedas') ?> <span><?php echo $this->openidconnect_user_services['orkut']['openid_user_displayname'] ?></span>
            <?php else: ?>
            <?php echo $this->translate('socialdna_publisher_connect') ?>
            <?php endif; ?>
            </div>
          </div>
          <?php endif; ?>
          <div style="clear: both"></div>
          </div>
          
          <div style="clear: both"></div>
          </td>
        </tr>
        </table>
  
        
        <div style="background-color: #F2F2F2; border-top: 1px solid #DDD; border-bottom: #DDD; padding-bottom: 10px; padding-top: 20px; padding-left: 20px; padding-right: 10px; margin-top: 10px; Xmargin-left: -10px; margin-bottom: -10px; Xmargin-right: -10px; text-align: center; width: 590px">

          <div id="openidconnect_publish_feed_story_action" class="openidconnect_publish_feed_story_action">

            <table cellpadding='0' cellspacing='0' style="margin: 0px auto">
  
            <tr>
            <td style="text-align: left; Xpadding-bottom: 15px">
              <div style='height: 65px; width: 160px; overflow: hidden' <?php if (!$this->openidconnect_feed_story['publish_prompt']): ?>onmouseover="SEMods.B.show( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_auto_wrapper') )" onmouseout="SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_auto_wrapper') )"<?php endif; ?>>
                <button type='submit' style="width: 150px; font-size: 20px" class='button openidconnect_publish_feed_story_prompt_confirmed' onclick="openidconnect_publish_feed_story_prompt_confirmed(); this.disabled = true;"><?php echo $this->translate('socialdna_facebook_publish_story_publish') ?></button>&nbsp;&nbsp;
                <div id="openidconnect_publish_feed_story_auto_wrapper" class="openidconnect_publish_feed_story_auto_wrapper" style="display:none; padding-top: 2px">
                  <input id="openidconnect_publish_feed_story_auto" class="openidconnect_publish_feed_story_auto openidconnect_checkbox" type='checkbox' style="vertical-align:middle">&nbsp;&nbsp;<label for='openidconnect_publish_feed_story_auto' style="vertical-align:middle; float: left"><?php echo $this->translate('socialdna_publisher_autopublish') ?></label>
                </div>
              </div>
            </td>
            <?php if ($this->openidconnect_feed_story['publish_prompt']): ?>
            <td valign="top" style="padding-left: 10px; padding-top: 5px; width: 220px; text-align: center">
              <button type='submit' style="font-size: 10px; padding: 5px" class='button openidconnect_shadowbutton openidconnect_publish_feed_story_prompt_wait' onclick="openidconnect_publish_feed_story_prompt_wait()"><?php echo $this->translate('socialdna_facebook_publish_story_notyet') ?></button>
            </td>
            <?php endif; ?>
            <td valign="top" style="padding-left: 10px; padding-top: 5px; width: 150px; text-align: left">
              <div style='height: 45px; width: 150px' onmouseover="SEMods.B.show( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_neveragain_wrapper') )" onmouseout="SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_neveragain_wrapper') )">
                <button type='submit' style="font-size: 10px; padding: 5px" class='button openidconnect_shadowbutton openidconnect_publish_feed_story_prompt_cancel' onclick="openidconnect_publish_feed_story_prompt_cancel('<?php echo $this->openidconnect_feed_story['story_type'] ?>')"><?php echo $this->translate('socialdna_facebook_publish_story_cancel') ?></button>
                <br>
                <div id="openidconnect_publish_feed_story_neveragain_wrapper" class="openidconnect_publish_feed_story_neveragain_wrapper" style="display:none">
                  <input id="openidconnect_publish_feed_story_neveragain" class="openidconnect_publish_feed_story_neveragain openidconnect_checkbox" type='checkbox' style="vertical-align:middle">&nbsp;&nbsp;<label for='openidconnect_publish_feed_story_neveragain' style="vertical-align:middle; float: left"><?php echo $this->translate('socialdna_facebook_publish_story_neverask') ?></label>
                </div>
              </div>
            </td>
            </tr>
    
            </table>
            
            <input id="openidconnect_publish_feed_story_update_session" class="openidconnect_publish_feed_story_update_session" type='hidden' value=0>
              
          </div>

          <div id="openidconnect_publish_feed_story_progress" class="openidconnect_publish_feed_story_progress" style="display:none; margin-bottom: 45px">

            <table cellpadding='0' cellspacing='0' align='center' style="margin: 0px auto">
            <tr><td class='result'>
              <img src='application/modules/Socialdna/externals/images/icons/publishing.gif' border='0' style='float: left; padding-right: 5px'><?php echo $this->translate('socialdna_publisher_publishing') ?>
            </td></tr>
            </table>
            
          </div>
          
        </div>
  
      </div>
      
      <div id="openidconnect_publish_feed_story_success" class="openidconnect_publish_feed_story_success" style="display:none; padding: 20px; text-align: center; margin: 50px; font-size: 22px; width: 450px;">
        
        <?php echo $this->translate('socialdna_publisher_published') ?>
                
      </div>
    
      <div id="openidconnect_publish_feed_story_fail" class="openidconnect_publish_feed_story_fail" style="display:none; padding: 20px; text-align: center; margin: 50px">
        
        <?php echo $this->translate('socialdna_publisher_error') ?>
                
      </div>
    
  </div>


  <script type="text/javascript">
  
      var openidconnect_facebook_feed_story_template_bundle_id = '<?php echo $this->openidconnect_feed_story['template_bundle_id'] ?>';
      var openidconnect_facebook_feed_story_data = eval(<?php echo $this->openidconnect_feed_story['data'] ?>);
      var openidconnect_facebook_feed_story_params = '<?php echo $this->openidconnect_feed_story['story_params'] ?>';
      var openidconnect_facebook_feed_story_type = '<?php echo $this->openidconnect_feed_story['story_type'] ?>';
    
      openidconnect_publish_feed_story_prompt();
  
  </script>

<?php endif; ?>



<script type="text/javascript">
  SEMods.B.register_onload( function() { openidconnect_facebook_onload( { 'user_exists' : '<?php if (Semods_Utils::isUser()): ?>1<?php else: ?>0<?php endif; ?>', 'hook_logout' : '<?php echo $this->openidconnect_hook_logout ?>', 'autologin' : '<?php echo $this->openidconnect_autologin ?>', 'request_connect' : '<?php echo $this->openidconnect_request_connect ?>' } ); } );
  //en4.core.runonce.add( function() { openidconnect_facebook_onload( { 'user_exists' : '<?php if (Semods_Utils::isUser()): ?>1<?php else: ?>0<?php endif; ?>', 'hook_logout' : '<?php echo $this->openidconnect_hook_logout ?>', 'autologin' : '<?php echo $this->openidconnect_autologin ?>', 'request_connect' : '<?php echo $this->openidconnect_request_connect ?>' } ); } );
</script>
