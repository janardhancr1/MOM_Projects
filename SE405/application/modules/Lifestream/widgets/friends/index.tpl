<?php
  $this->headScript()
    ->appendFile($this->baseUrl() . 'application/modules/Semods/externals/scripts/semods.js')
    ->appendFile($this->baseUrl() . 'application/modules/Socialdna/externals/scripts/socialdna.js')
    ->appendFile($this->baseUrl() . 'application/modules/Lifestream/externals/scripts/lifestream.js')
?>

<div>
  
<?php if ($this->service_connected): ?>
  
<div class="socialfriends_servicelogos" id="socialfriends_servicelogos">
  <div class="socialfriends_servicelogo" style='padding-left: 0px;'></div>
  <?php foreach($this->openid_services as $openid_service): ?>
  <div class="socialfriends_servicelogo"><img border='0' width=16 height=16 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_mini'] ?>" alt="<?php echo $openid_service['openidservice_displayname']; ?>"></div>
  <?php endforeach; ?>
  <div class="socialfriends_servicelogo" style="float: right"><a href="<?php echo $this->url(array(),'socialdna') ?>"><span style="color: #888">+</span></a></div>
  <div style="clear: both"></div>    
</div>

<a id="openidconnect_send_message_hint" href="javascript:void(0)" onclick="openidconnect_facebookwall_slidedown('openidconnect_send_message');SEMods.B.hide('openidconnect_send_message_hint'); this.blur();"><?php echo $this->translate('socialdna_socialfriends_send_message') ?></a>
<div style="margin-bottom: 5px; display: none" id="openidconnect_send_message">
  <table cellspacing=0 cellpadding=0>
    <tr>
      <td style="vertical-align: top; padding-top: 5px; padding-bottom: 5px; padding-right: 5px;"> <?php echo $this->translate('socialdna_socialfriends_to') ?>: </td>
      <td style="vertical-align: top; padding-top: 5px; padding-bottom: 5px;">
        <?php echo $this->translate('socialdna_socialfriends_select') ?>
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top; padding-top: 5px; padding-right: 5px;"> <?php echo $this->translate('socialdna_socialfriends_subject') ?>: </td>
      <td style="vertical-align: top; padding-bottom: 5px;"> <input type=text id="openidconnect_msg_subject"> </td>
    </tr>
    <tr>
      <td style="vertical-align: top; padding-top: 5px; padding-right: 5px;"> <?php echo $this->translate('socialdna_socialfriends_message') ?>: </td>
      <td style="vertical-align: top; padding-bottom: 5px;">
        <textarea class=textarea id="openidconnect_msg_body"></textarea>
        <div style='color: #808080'><?php echo $this->translate('lifestream_facebook_message_note') ?></div>
      </td>
    </tr>
    <tr>
      <td> &nbsp; </td>
      <td>
        <div id="openidconnect_msg_actions">
          <button onclick="OpenidConnect.Friends.send_message()"><?php echo $this->translate('socialdna_socialfriends_message_send') ?></button>
          <button onclick="OpenidConnect.Friends.send_message_cancel()"><?php echo $this->translate('socialdna_socialfriends_message_cancel') ?></button>
        </div>
        <div id="openidconnect_msg_progress" style='display:none'>
          <table cellpadding='0' cellspacing='0' align='center'>
          <tr><td style="padding: 5px">
            <img src='application/modules/Socialdna/externals/images/icons/ajaxprogress1.gif' border='0' style='float: left; padding-right: 5px'><?php echo $this->translate('socialdna_socialfriends_sending') ?>
          </td></tr>
          </table>
        </div>
        <div id="openidconnect_msg_sent" style='display:none; color: green; border: 1px solid green; font-weight: bold; padding: 5px'>
          <table cellpadding='0' cellspacing='0' align='center'>
          <tr><td>
            <?php echo $this->translate('socialdna_socialfriends_sent') ?>
          </td></tr>
          </table>
        </div>
      </td>
    </tr>
    </table>  
</div>


  <div id="openidconnect_friends_loading" style="display:block">
    <br>
    <table cellpadding='0' cellspacing='0' style='margin: 0px auto'>
    <tr><td>
      <img src='application/modules/Socialdna/externals/images/icons/ajaxprogress1.gif' border='0' style='float: left; padding-right: 5px'><?php echo $this->translate('socialdna_facebook_loading') ?>
    </td></tr>
    </table>
    <br>
  </div>

  <div id="openidconnect_friends_control" style='display:none' class="openidconnect_friends_gridview">

    <div>
      <table cellspacing=0 cellpadding=0>
        <tr>
          <td>
            <select id="openidconnect_friends_service" disabled=1 onchange="OpenidConnect.Friends.service_onChange()">
              <option value="0"><?php echo $this->translate('socialdna_socialfriends_networks_all') ?></option>
              <option value="1">Facebook</option>
              <option value="2">MySpace</option>
              <option value="4">Yahoo</option>
              <option value="12">LinkedIn</option>
              <option value="10">Twitter</option>
            </select>
          </td>
          <td style='padding-left: 5px'>
            <input type="text" class="text" id="openidconnect_friends_suggest" onkeyup="OpenidConnect.Friends.typeahead()">
          </td>
        </tr>
      </table>
    </div>

    <div style="padding-top: 5px; padding-bottom: 5px; margin-left: 2px; Xmargin-right: 25px">
      <div style="float: left">
        <a href="javascript:void(0)" onclick="OpenidConnect.Friends.set_display('grid'); this.blur();"><img style='padding-right: 5px' border="0" width=16 height=16 src="application/modules/Socialdna/externals/images/icons/grid16.png"></a><a href="javascript:void(0); this.blur();" onclick="OpenidConnect.Friends.set_display('list')"><img border="0" width=16 height=16 src="application/modules/Socialdna/externals/images/icons/list16.png"></a>
      </div>
      <div style="float: left; margin-left: 15px">
        <a href="javascript:void(0)" id="openidconnect_friends_selector_all" class="openidconnect_friends_selector_selected" onclick="OpenidConnect.Friends.show_all(); this.blur();"><?php echo $this->translate('socialdna_socialfriends_friends_all') ?> <!--(<span id="openidconnect_friends_selector_all_count"></span>)--></a> &nbsp;
        <a href="javascript:void(0)" id="openidconnect_friends_selector_selected" onclick="OpenidConnect.Friends.show_selected(); this.blur();"><?php echo $this->translate('socialdna_socialfriends_friends_selected') ?> (<span id="openidconnect_friends_selector_selected_count">0</span>)</a>
      </div>
      <div id="openidconnect_friends_pager" style="float: left; margin-left: 10px;">
        <a href="javascript:void(0)" id="openidconnect_friends_pager_left" class="openidconnect_friends_pager" onclick="OpenidConnect.Friends.page_left(); this.blur();"> &lt; </a> &nbsp;
        <span id="openidconnect_friends_pager_from"></span>&nbsp;-&nbsp;<span id="openidconnect_friends_pager_to"></span>&nbsp;<?php echo $this->translate('socialdna_socialfriends_friends_of') ?>&nbsp;<span id="openidconnect_friends_pager_total"></span>
        <a href="javascript:void(0)" id="openidconnect_friends_pager_right" class="openidconnect_friends_pager" onclick="OpenidConnect.Friends.page_right(); this.blur();"> &gt; </a>
      </div>
      <!--<div style="float: right">-->
      <!--  <a href="javascript:void(0)" onclick="OpenidConnect.Friends.set_display('grid')"><img style='padding-right: 5px' border="0" width=16 height=16 src="application/modules/Socialdna/externals/images/icons/grid16.png"></a><a href="javascript:void(0)" onclick="OpenidConnect.Friends.set_display('list')"><img border="0" width=16 height=16 src="application/modules/Socialdna/externals/images/icons/list16.png"></a>-->
      <!--</div>-->
      <div style="clear:both"></div>
    </div>

    <!--<div id="openidconnect_friends" class="openidconnect_friends_gridview">-->
    <div id="openidconnect_friends">
  
      <div style="clear:both"></div>
    </div>

    <div id="openidconnect_friends_checked" style="display: none">
  
      <div style="clear:both"></div>
    </div>

  </div>

  <div style="display:none">
  
    <div id="openidconnect_friendrow" class="openidconnect_friendrow" onclick="OpenidConnect.Friends.toggle_friend_row(event,this);">
      <div class="openidconnect_friend_photo_wrapper">
        <div class="openidconnect_friend_selector">
          <input style='display: none;' type="checkbox" value="" class="checkbox openidconnect_friend_id"/>
        </div>
        <div class="openidconnect_friend_service"></div>
        <img class='openidconnect_friend_photo' border='0'src="">
      </div>
      <div class="openidconnect_friend_details">
        <div class="openidconnect_friend_name"></div>
        <div class="openidconnect_friend_status"></div>
      </div>
    </div>

    <div id="openidconnect_nofriends"> <div style='width: 100px; text-align: center; margin: 30px auto;'><?php echo $this->translate('socialdna_socialfriends_nofriends') ?></div> </div>
  
  </div>

</div>


<script type="text/javascript">
  OpenidConnect.Friends.lang_cap1 = '<?php echo $this->translate('socialdna_socialfriends_can_message') ?>';
  //en4.$(document).ready( function() {ldelim} OpenidConnect.Friends.get_friends(); {rdelim} );
  en4.core.runonce.add( function() { OpenidConnect.Friends.get_friends(); } );
</script>


<?php else: ?>

  <br>
  <br>
  <table cellpadding='0' cellspacing='0' align='center'>
  <tr><td>

    <?php echo $this->translate('lifestream_friends_not_connected') ?> <a href="<?php echo $this->url(array(),'socialdna') ?>"><?php echo $this->translate('lifestream_friends_connect1') ?></a> <?php echo $this->translate('lifestream_friends_connect2') ?><br><br>
    
    <div style="width: 160px; margin: 0px auto">
      <?php foreach($this->enabled_openid_services as $openid_service): ?>
      <div class="facebookwall_servicelogo"><a href="<?php echo $this->url(array(), 'socialdna') ?>"><img border='0' width=16 height=16 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_mini'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></a></div>
      <?php endforeach; ?>
      <div style="clear: both"></div>    
    </div>

  </td></tr>
  </table>

  <br>
  <br>

<?php endif; ?>
