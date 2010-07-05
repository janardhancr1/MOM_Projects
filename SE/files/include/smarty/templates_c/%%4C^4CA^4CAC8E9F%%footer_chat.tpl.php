<?php /* Smarty version 2.6.14, created on 2010-05-26 07:16:05
         compiled from footer_chat.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'footer_chat.tpl', 21, false),)), $this);
?><?php
SELanguage::_preload_multi(3500013,3500014,3510001,3510002,3510015,3510016,3510017,3510018,3510019,3510020,3510021,3510022,3510023,3510024,3510025,3510026,3510027,3510028,3510029,3510030,3510031,3510032,3510033,3510034,3510035,3510036,3510037,3510038,3510041,3510039,3510040);
SELanguage::load();
?>

<?php if (! $this->_tpl_vars['global_smoothbox'] && $this->_tpl_vars['user']->user_exists && $this->_tpl_vars['user']->level_info['level_im_allow']): ?>
  
  <?php 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(3500013,3500014,3510001,3510002,3510015,3510016,3510017,3510018,3510019,3510020,3510021,3510022,3510023,3510024,3510025,3510026,3510027,3510028,3510029,3510030,3510031,3510032,3510033,3510034,3510035,3510036,3510037,3510038));
$javascript_lang_import_first = TRUE;
if( is_array($javascript_lang_import_list) && !empty($javascript_lang_import_list) )
{
  echo "\n<script type='text/javascript'>\n<!--\n";
  echo "SocialEngine.Language.Import({\n";
  foreach( $javascript_lang_import_list as $javascript_import_id )
  {
    if( !$javascript_lang_import_first ) echo ",\n";
    echo "  ".$javascript_import_id." : '".addslashes(SE_Language::_get($javascript_import_id))."'";
    $javascript_lang_import_first = FALSE;
  }
  echo "\n});\n//-->\n</script>\n";
}
 ?>
  
    <?php if (empty ( $this->_tpl_vars['server_time'] )): 
 $this->assign('server_time',time()); 
 endif; ?>
  
  <?php echo '
  <script type="text/javascript">
    
    var SEIM, SEIM_GUI;
    var SEIM_Config = {
      chatEnabled: use_seIM,
      IMEnabled: use_seChat,
      
      imagePath: \'./images\',
      timeDelta: '; 
 echo $this->_tpl_vars['server_time']; 
 echo ' - Math.round((new Date()).getTime() / 1000),
      updateDelay: '; 
 echo ((is_array($_tmp=@$this->_tpl_vars['setting']['setting_chat_update'])) ? $this->_run_mod_handler('default', true, $_tmp, 2000) : smarty_modifier_default($_tmp, 2000)); 
 echo '
    }
    
    window.addEvent(\'load\', function()
    {
      SEIM = new InstantMessengerCore(SEIM_Config);
      SEIM.RegisterModule(\'gui\', (new InstantMessengerGUI));
      SEIM.RegisterModule(\'conversations\', (new InstantMessengerConversations));
      SEIM.Boot();
    });
    
  </script>
  '; ?>

  
  
    <iframe src="about:blank" id="seIMAudioFrame" style="visibility: hidden;" frameborder='0' height="1" width="1"></iframe>
  
  
    <div style="display:none;" id="seIM_tray_template">
    <table class="seIM_tray_wrapper" cellpadding="0" cellspacing="0"><tr><td class="seIM_tray_wrapperCell">
      <table class="seIMHide seIM_tray" cellpadding="0" cellspacing="0">
        <tbody>
          <tr class="seIM_trayRow">
            <td class="seIM_traySpacer" style="width:99%;">&nbsp;</td>
          </tr>
        </tbody>
      </table>
    </td></tr></table>
  </div>
  
  
    <div style="display:none;" id="seIM_conversation_trayItem_template">
    <table><tr><tbody>
      <td class="seIM_trayItem seIM_conversation_trayItem" nowrap="nowrap" style="width:140px;" onmouseover="if( !$(this).hasClass('seIM_trayItem_isHover') ) $(this).addClass('seIM_trayItem_isHover');" onmouseout="if( $(this).hasClass('seIM_trayItem_isHover') ) $(this).removeClass('seIM_trayItem_isHover');">
        <a class="seIM_trayItem_menuActivator" href="javascript:void(0);" nowrap="nowrap" style="width: 140px;" onClick='this.blur()'>
          <span class="seIM_trayItem_icon"></span>
          <span class="seIM_trayItem_title"><?php echo SELanguage::_get(3510002); ?></span>
          <span class="seIM_trayItem_userStatus"></span>
        </a>
      </td>
    </tbody></tr></table>
  </div>
  
  
    <div style="display:none;" id="seIM_conversation_trayMenu_template">
    <table class="seIMHide seIM_trayMenu seIM_conversation_trayMenu" style='border-bottom: 0px;' cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <td class="seIM_trayMenu_header">
            <table cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td class="seIM_trayMenu_title">
                    <img src='./images/icons/chat_conversation16.gif' border='0' style='vertical-align: middle; margin-right: 2px; width: 16px;'>
                    <span class="seIM_trayMenu_userName"><?php echo SELanguage::_get(3510002); ?></span>
                                      </td>
                  <td class="seIM_trayMenu_buttons">
                    <a class="seIM_trayItem_menuDeactivator" href="javascript:void(0);" onClick='this.blur()'><img src="./images/icons/chat_im_minimize.gif" width='10' height='10' onMouseOver="this.src='./images/icons/chat_im_minimize1.gif'" onMouseOut="this.src='./images/icons/chat_im_minimize.gif'"/></a>
                    <a class="seIM_trayItem_menuDestroyer" href="javascript:void(0);" onClick='this.blur()'><img src="./images/icons/chat_im_close.gif" width='10' height='10'  onMouseOver="this.src='./images/icons/chat_im_close1.gif'" onMouseOut="this.src='./images/icons/chat_im_close.gif'"/></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <tr>
          <td class="seIM_trayMenu_body">
            <div class="seIM_trayMenu_bodyListWrapper seIM_conversation_trayMenu_bodyListWrapper">
              <div class="seIM_conversation_trayMenu_bodyListWrapper2">
                <ul class="seIM_trayMenu_bodyList">
                  <li class="seIMNullMessage"><?php echo SELanguage::_get(3510019); ?></li>
                </ul>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td class="seIM_trayMenu_input">
            <input type="text" class="seIM_conversation_trayMenu_textInput" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  
  
    <div style="display:none;" id="seIM_conversation_trayMenu_message_template">
    <ul>
      <li class="seIM_conversation_trayMenu_message">
        <span class="seIM_conversation_trayMenu_messageTimestamp"></span>
        <span class="seIM_conversation_trayMenu_messageUserName"></span>
        <span class="seIM_conversation_trayMenu_messageContent"></span>
      </li>
    </ul>
  </div>
  
  
    <div style="display:none;" id="seIM_friends_trayItem_template">
    <table><tbody><tr>
      <td class="seIM_trayItem seIM_friends_trayItem" nowrap="nowrap" onmouseover="if( !$(this).hasClass('seIM_trayItem_isHover') ) $(this).addClass('seIM_trayItem_isHover');" onmouseout="if( $(this).hasClass('seIM_trayItem_isHover') ) $(this).removeClass('seIM_trayItem_isHover');">
        <a class="seIM_trayItem_menuActivator" href="javascript:void(0);" onClick='this.blur()'>
          <img src="./images/icons/chat_im_friendsMenu16.png" style="width: 16px; height: 16px; margin-right: 2px;" />
          <?php echo SELanguage::_get(3510041); ?> (<span class="seIM_friends_trayItem_userCount">0</span>)
        </a>
      </td>
    </tr></tbody></table>
  </div>
  
  
    <div style="display:none;" id="seIM_friends_trayMenu_template">
    <table class="seIMHide seIM_trayMenu seIM_friends_trayMenu" cellpadding="0" cellspacing="0">
      <tbody>
        <tr style="padding: 0px;">
          <td class="seIM_trayMenu_header">
            <table cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td class="seIM_trayMenu_title"><div class='seIM_friends_title'><?php echo SELanguage::_get(3510024); ?></div></td>
                  <td class="seIM_trayMenu_buttons">
                    <a href="javascript:void(0);" class="seIM_trayItem_menuDeactivator"><img src="./images/icons/chat_im_minimize.gif"  onMouseOver="this.src='./images/icons/chat_im_minimize1.gif'" onMouseOut="this.src='./images/icons/chat_im_minimize.gif'"/></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <div class="seIM_trayMenu_bodyListWrapper seIM_friends_trayMenu_bodyListWrapper">
              <ul class="seIM_trayMenu_bodyList">
                <li class="seIMNullMessage"><?php echo SELanguage::_get(3510025); ?></li>
              </ul>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  
  
    <div style="display:none;" id="seIM_friends_trayMenu_bodyListItem_template">
    <ul>
      <li class="seIM_trayMenu_bodyListItem seIM_friends_trayMenu_bodyListItem">
        <table class="seIM_trayMenu_bodyList_activator seIMTips1" cellpadding="0" cellspacing="0" onmouseover="if( !$(this).hasClass('seIM_friends_trayMenu_bodyList_activatorHover') ) $(this).addClass('seIM_friends_trayMenu_bodyList_activatorHover');" onmouseout="if( $(this).hasClass('seIM_friends_trayMenu_bodyList_activatorHover') ) $(this).removeClass('seIM_friends_trayMenu_bodyList_activatorHover');">
          <tr>
            <td rowspan="2" class="seIM_friends_trayMenu_friendIcon" width="25"></td>
            <td class="seIM_friends_trayMenu_friendName"></td>
            <td class="seIM_friends_trayMenu_friendStatus">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" class="seIM_friends_trayMenu_friendMessage" nowrap="nowrap"></td>
          </tr>
        </table>
      </li>
    </ul>
  </div>
  
  
    <div style="display:none;" id="seIM_options_trayItem_template">
    <table><tbody><tr>
      <td class="seIM_trayItem seIM_options_trayItem" width="25" nowrap="nowrap" onmouseover="if( !$(this).hasClass('seIM_trayItem_isHover') ) $(this).addClass('seIM_trayItem_isHover');" onmouseout="if( $(this).hasClass('seIM_trayItem_isHover') ) $(this).removeClass('seIM_trayItem_isHover');">
        <a class="seIM_trayItem_menuActivator" href="javascript:void(0);" onClick='this.blur()'>
          <img class="seIM_trayItem_icon" src="./images/status_im/options_offline16.gif"  style="width: 16px; height: 16px;" />
        </a>
      </td>
    </tr></tbody></table>
  </div>
  
  
    <div style="display:none;" id="seIM_options_trayMenu_template">
    <table class="seIMHide seIM_trayMenu seIM_options_trayMenu" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <td class="seIM_trayMenu_header">
            <table cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td class="seIM_trayMenu_title"><div class='seIM_options_title'><?php echo SELanguage::_get(3510026); ?></div></td>
                  <td class="seIM_trayMenu_buttons">
                    <a href="javascript:void(0);" class="seIM_trayItem_menuDeactivator"><img src="./images/icons/chat_im_minimize.gif"  onMouseOver="this.src='./images/icons/chat_im_minimize1.gif'" onMouseOut="this.src='./images/icons/chat_im_minimize.gif'"/></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <div class="seIM_trayMenu_bodyListWrapper seIM_options_trayMenu_bodyListWrapper">
              <ul class="seIM_trayMenu_bodyList">
                <li>
                  <div style='margin-bottom: 5px;'>
                    <div><?php echo SELanguage::_get(3510039); ?></div>
                    <select class="seIM_options_trayMenu_statusSelect" onchange="this.blur();">
                      <option value="1" class="seIM_options_trayMenu_status_1"><?php echo SELanguage::_get(3510028); ?></option>
                      <option value="0" class="seIM_options_trayMenu_status_0"><?php echo SELanguage::_get(3510027); ?></option>
                      <option value="2" class="seIM_options_trayMenu_status_2"><?php echo SELanguage::_get(3510029); ?></option>
                                          </select>
                  </div>
                </li>
                <li>
                                    <table cellpadding='0' cellspacing='0'><tr><td><input type="checkbox" class="seIM_options_trayMenu_audioButton" /></td><td>&nbsp;<?php echo SELanguage::_get(3510040); ?></td></tr></table>
                  
                                    <table cellpadding='0' cellspacing='0' style="display: none;"><tr><td><img class="seIM_options_trayMenu_timestampButton" src="./images/icons/chat_clock2.gif" style="width: 16px;" /></td><td>&nbsp;&nbsp;</td></tr></table>
                </li>
              </ul>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
<?php endif; ?>