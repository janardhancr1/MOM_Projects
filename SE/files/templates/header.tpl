
{* $Id: header.tpl 287 2010-01-07 23:46:33Z steve $ *}

{* INCLUDE HEADER CODE *}
{include file="header_global.tpl"}

{if $smarty.const.SE_DEBUG && $admin->admin_exists}{include file="header_debug.tpl"}{/if}

<div id="smoothbox_container"></div>



{* BEGIN CENTERING TABLE *}
<table cellpadding='0' cellspacing='0' class='body' align='center' bgcolor='White'>
<tr>
<td width='100%'>



{* START TOPBAR *}
<div style='width:100%;'>
<table cellpadding='0' cellspacing='0' style='width: 100%; padding-top:5px; align='center'>
<tr>
	<td>
		{* SHOW LOGIN FORM IF USER IS NOT LOGGED IN *}
  		{if !$user->user_exists}
		<table cellpadding='0' cellspacing='0' align='right' style='padding-right: 4px;' width="100%">
			<tr>
				<td width="75%" align='Right'>
					<input type='checkbox' class='checkbox' name='persistent' value='1' id='rememberme' />
					<label for='rememberme' style='color:#D60077'>{lang_print id=660}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
				<td style='padding-left: 6px;' width="15%" align='Right'>
					<a class="momlink" href='lostpass.php'>{lang_print id=675}</a>
				</td>
				<td style='padding-left: 6px;' width="10%">
					&nbsp;
				</td>
			</tr>
		</table>
		{* SHOW HELLO MESSAGE IF USER IS LOGGED IN *}
  		{else}
  		<table cellpadding='0' cellspacing='0' align='right' style='padding: 0px 2px 2px 2px;' width="100%">
			<tr>
				<td width="45%" align='left' style='padding-left: 5px;'>
					<a class="momlink" href='invite.php'>Invite Moms you Know</a>
					<div class='newupdates' id='newupdates' style='display: none;'>
			        <div class='newupdates_content'>
			            <a href='javascript:void(0);' class='newupdates' onClick="SocialEngine.Viewer.userNotifyPopup(); return false;">
			            {assign var="notify_total" value=$notifys.total_grouped}
			            {lang_sprintf id=1019 1="<span id='notify_total'>`$notify_total`</span>"}
			            </a>
			            &nbsp;&nbsp; 
			            <a href='javascript:void(0);' class='newupdates' onClick="SocialEngine.Viewer.userNotifyHide(); return false;">X</a>
			          </div>
			      </div>
				</td>
				<td width="55%" align='Right' style='padding-right: 5px;'>
					<form method="POST" id="user_logout" action="user_logout.php" style="display:inline;margin:0;"><a class="momlink" href='user_logout.php?token={$token}' onclick="$('user_logout').submit(); return false;">{lang_print id=26}</a></form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a class="momlink" href='user_account.php'>{lang_print id=655}</a>
				</td>
			</tr>
		</table>
		{/if}
	</td>
</tr>
</table>

<div class='red_bar' style='padding:1px'>
{* SHOW LOGIN FORM IF USER IS NOT LOGGED IN *}
 {if !$user->user_exists}
<form action='login.php' method='post'>
<table cellpadding='0' cellspacing='0' align='Right' width="100%">
	<tr>
		<td width="75%" align='Right'>
			<input type='text' name='email' size='25' maxlength='100' value='{lang_print id=89}' onfocus="if(this.value == 'Email') this.value='';" onblur="if(this.value.length == 0) this.value='Email';" />
		</td>
		<td style='padding-left: 6px;' width="15%" align='Right'>
			<input type='password' name='password' id='passid1' size='25' maxlength='100' value='' style='display:none;' onblur="showText();" />
			<input type='text' name='password_text' id='passid2' size='25' maxlength='100' value='{lang_print id=29}' onfocus="showPass();"  />
		</td>
		<td style='padding-left: 6px;' width="10%" align='left'>
			<input type='submit' class='button' value='{lang_print id=30}' />
		</td>
	</tr>
	{if !empty($setting.setting_login_code)}
	<tr>
		<td style='padding-top: 6px;'>
			<table cellpadding='0' cellspacing='0'>
				<tr>
					<td>
						<input type='text' name='login_secure' class='text' size='6' maxlength='10' />&nbsp;
					</td>
					<td>
						<table cellpadding='0' cellspacing='0'>
							<tr>
								<td align='center'>
									<img src='./images/secure.php' id='secure_image' border='0' height='20' width='67' class='signup_code' alt='' /><br />
									<a href="javascript:void(0);" onClick="$('secure_image').src = './images/secure.php?' + (new Date()).getTime();">{lang_print id=975}</a>
								</td>
								<td>{capture assign=tip}{lang_print id=691}{/capture}<img src='./images/icons/tip.gif' border='0' class='Tips1' title='{$tip|escape:quotes}' alt='' /></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	{/if}
</table>
<noscript><input type='hidden' name='javascript_disabled' value='1' /></noscript>
<input type='hidden' name='task' value='dologin' />
<input type='hidden' name='ip' value='{$ip}' />
</form>
{* SHOW HELLO MESSAGE IF USER IS LOGGED IN *}
 {else}
 <table cellpadding='0' cellspacing='0' style='padding: 2px;' width="100%">
	<tr>
		<td valign="bottom" align="left" style='padding-left: 5px;'>
			<div style='font-size:14px'>
			<a class="top_menu_item" href='user_messages.php'>{lang_print id=654}</a> &nbsp; &nbsp; &nbsp;
			<a class="top_menu_item" href='user_friends.php'>{lang_print id=653}</a> &nbsp; &nbsp; &nbsp;
			<a class="top_menu_item" href='profile.php?user={$user->user_info.user_username}'>{lang_print id=652}</a>
			</div> 
		</td>
	</tr>
</table>
 {/if}
</div>

  {* LOGO AND SEARCH *}
  <table cellpadding='0' cellspacing='0' style='width: 100%; align='center'>
  <tr>
  <td align='left' valign='middle' style='padding-left:5px'>
    <a href='./home.php'><img src='./images/logo_new.gif' border='0' alt='' /></a>
  </td>
  <td align='right' valign='top'>
  	<span class='leader_text'>Advertisement&nbsp;&nbsp;&nbsp;&nbsp;</span>
  	{* PAGE-TOP ADVERTISEMENT BANNER *}
	  {if $ads->ad_top != ""}
	    <div class='ad_top' style='display: block; visibility: visible;'>{$ads->ad_top}</div>
	  {/if}
  </td>
  </tr>
  </table>

</div>
{* END TOP BAR *}






{* START TOP MENU *}
<table cellpadding='0' cellspacing='0' style='width: 100%;' align='center'>
<tr>
<td nowrap='nowrap' class='top_menu'>
  <div class='top_menu_link_container'>
  	<div class='top_menu_link_start'></div>
    <div class='top_menu_link'>
      <a href='home.php' class='top_menu_item'>
        {lang_print id=645}
      </a>
    </div>
    <div class='top_menu_link_end'></div>
  </div>
  
  <div class='top_menu_link_container'>
  	<div class='top_menu_link_start'></div>
    <div class='top_menu_link'>
      <a href='invite.php' class='top_menu_item'>
        {lang_print id=647}
      </a>
    </div>
    <div class='top_menu_link_end'></div>
  </div>
  
  <div class='top_menu_link_container'>
  	<div class='top_menu_link_start'></div>
    <div class='top_menu_link'>
      <a href='browse_contests.php' class='top_menu_item'>
        Contests
      </a>
    </div>
    <div class='top_menu_link_end'></div>
  </div>

  {* SHOW ANY PLUGIN MENU ITEMS *}
  {hook_foreach name=menu_main var=menu_main_args complete=menu_main_complete max=9}
    <div class='top_menu_link_container'>
      <div class='top_menu_link_start'></div>	
      <div class='top_menu_link'>
        <a href='{$menu_main_args.file}' class='top_menu_item'>
          {lang_print id=$menu_main_args.title}
        </a>
      </div>
      <div class='top_menu_link_end'></div>
    </div>
  {/hook_foreach}
  
  {if !$menu_main_complete}
    <div class='top_menu_link_container top_menu_main_link_container'>
      <div class='top_menu_link_start'></div>
      <div class='top_menu_link top_menu_main_link'>
        <a href="javascript:void(0);" onclick="$('menu_main_dropdown').style.display = ( $('menu_main_dropdown').style.display=='none' ? 'inline' : 'none' ); this.blur(); return false;" class='top_menu_item'>
          {lang_print id=1316}
        </a>
      </div>
      <div class='top_menu_link_end'></div>
      <div class='menu_main_dropdown' id='menu_main_dropdown' style='display: none;'>
        
          {* SHOW ANY PLUGIN MENU ITEMS *}
          {hook_foreach name=menu_main var=menu_main_args start=9}
          <div class='menu_main_item_dropdown'>
            <a href='{$menu_main_args.file}' class='menu_main_item' style="text-align: left;">
              {lang_print id=$menu_main_args.title}
            </a>
          </div>
          {/hook_foreach}
        
      </div>
    </div>
  {/if}

</td>
</tr>
</table>
{* END TOP MENU *}



{* USER NOTIFICATIONS *}
{if $user->user_exists}
{lang_javascript ids=1198,1199}
<script type='text/javascript'>
<!--
var notify_update_interval;
window.addEvent('domready', function() {ldelim}
  SocialEngine.Viewer.userNotifyGenerate({$se_javascript->generateNotifys($notifys)});
  SocialEngine.Viewer.userNotifyShow();
  notify_update_interval = (function() {ldelim}
    if( notify_update_interval ) SocialEngine.Viewer.userNotifyUpdate();
  {rdelim}).periodical(60 * 1000);
{rdelim});
//-->
</script>
<div style='display: none;' id='newupdates_popup'></div>
{/if}
 



<table cellpadding='0' cellspacing='0' align='center' style='width: 100%;'>
<tr>

{* SHOW LEFT-SIDE ADVERTISEMENT BANNER *}
{if $ads->ad_left != ""}
  <td valign='top'><div class='ad_left' style='display: block; visibility: visible;'>{$ads->ad_left}</div></td>
{/if}

<td valign='top'>

{* START MAIN LAYOUT *}
<div class='content'>

  {* SHOW BELOW-MENU ADVERTISEMENT BANNER *}
  {if $ads->ad_belowmenu != ""}<div class='ad_belowmenu' style='display: block; visibility: visible;'>{$ads->ad_belowmenu}</div>{/if}
