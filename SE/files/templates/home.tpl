{include file='header.tpl'}

{* $Id: home.tpl 288 2010-01-11 20:17:09Z steve $ *}







{* BEGIN LEFT COLUMN *}
<table width='100%' cellspacing='0' cellpadding='0'>
<tr>
<td valign='top' style='border-right: 1px solid #DDDDDD'>
<div style='float: left; width: 200px;padding-left:1px;height:600px'>
 {* SHOW HELLO MESSAGE IF USER IS LOGGED IN *}
  {if $user->user_exists}
    <div class='portal_login'>
      <div style='padding-bottom: 5px;padding-right: 5px;float:left'><a href='{$url->url_create("profile",$user->user_info.user_username)}'><img src='{$user->user_photo("./images/nophoto.gif")}' width='{$misc->photo_size($user->user_photo("./images/nophoto.gif"),"70","70","w")}' border='0' class='photo' alt="{lang_sprintf id=509 1=$user->user_info.user_username}" /></a></div>
      <div style='float:left;height:20px;width:105px;text-align:left;color: #D60077;font-size:12px'>{$user->user_displayname_short}</div>
      <div style='float:left;height:25px;width:105px;text-align:left;color: #BEB800'><a href='{$url->url_create("profile",$user->user_info.user_username)}' style="color: #BEB800">View My Profile</a></div>
    </div>
    <div class='portal_spacer'></div>
  {/if}
  
  {* SHOW TODAY's POLL *}
  {if !empty($site_statistics)}
    <div class='header'>Today's Poll Question</div>
    <div class='portal_content'>
      {if !empty($poll_info)}
      <div style='float:left;padding-right: 5px'><img src='./images/icons/poll_poll48.gif' border='0' class='icon'></div>
      <div style='float:left'><a href='{$url->url_create("poll", $poll_info.SUBMITTEDBY, $poll_info.poll_id)}'>{if $poll_info.poll_title == ""}{lang_print id=589}{else}{$poll_info.poll_title|truncate:20:"...":true|choptext:20:"<br>"}{/if}</a></div>
      <br/>
      <div>{lang_sprintf id=2500028 1=$poll_info.poll_totalvotes}</div>
      {else}
		No Poll Yet
		{/if}
    </div>
    <div class='portal_spacer'></div>
  {/if}
  
  {* SHOW TODAY's RECIPE *}
  {if !empty($site_statistics)}
    <div class='header'>Today's Recipe Post</div>
    <div class='portal_content'>
    	{if !empty($recipe_info)}
      	<div style='float:left;padding-right: 5px'>{if !empty($recipe_info.recipe_photo) }
		<img src="{$recipe_info.recipe_photo}" width="40" height="40" />
		{else}
		<img src="./images/nophoto.gif" width="40" height="40" />
		{/if}</div>
		<div style='float:left'><a href=''>
		<a href="recipe.php?user={$recipe_info.SUBMITTEDBY}&recipe_id={$recipe_info.recipe_id}">
                                    {$recipe_info.recipe_name|truncate:20:"...":true}</a></div><br/>
		<div>{$recipe_info.recipe_totalcomments}&nbsp;comment(s)</div>
		{else}
		No Recipe Yet
		{/if}
    </div>
    <div class='portal_spacer'></div>
  {/if}
  <div class='header'></div>
  {* SHOW NETWORK STATISTICS 
  {if !empty($site_statistics)}
    <div class='header'>{lang_print id=511}</div>
    <div class='portal_content'>
      {foreach from=$site_statistics key=stat_name item=stat_array}
        &#149; {lang_sprintf id=$stat_array.title 1=$stat_array.stat}<br />
      {/foreach}
    </div>
    <div class='portal_spacer'></div>
  {/if}
  *}
  {* SHOW ONLINE USERS IF MORE THAN ZERO 
  {math assign='total_online_users' equation="x+y" x=$online_users[0]|@count y=$online_users[1]}
  {if $total_online_users > 0}
    <div class='header'>{lang_print id=665} ({$total_online_users})</div>
    <div class='portal_content'>
      {if $online_users[0]|@count == 0}
        {lang_sprintf id=977 1=$online_users[1]}
      {else}
        {capture assign='online_users_registered'}{section name=online_loop loop=$online_users[0]}{if $smarty.section.online_loop.rownum != 1}, {/if}<a href='{$url->url_create("profile", $online_users[0][online_loop]->user_info.user_username)}'>{$online_users[0][online_loop]->user_displayname}</a>{/section}{/capture}
        {lang_sprintf id=976 1=$online_users_registered 2=$online_users[1]}
      {/if}
    </div>
    <div class='portal_spacer'></div>
  {/if}*}

  {* SHOW LAST LOGINS 
  <div class='header'>{lang_print id=671}</div>
  <div class='portal_content'>
    {if !empty($logins)}
    <table cellpadding='0' cellspacing='0' align='center'>
      {section name=login_loop loop=$logins max=4}
      {cycle name="startrow3" values="<tr>,"}
      <td class='portal_member' valign="bottom"{if (~$smarty.section.login_loop.index & 1) && $smarty.section.login_loop.last} colspan="2" style="width:100%;"{else} style="width:50%;"{/if}>
        {if !empty($logins[login_loop])}
        <a href='{$url->url_create("profile",$logins[login_loop]->user_info.user_username)}'>{$logins[login_loop]->user_displayname|regex_replace:"/&#039;/":"'"|truncate:15:"...":true}</a><br />
        <a href='{$url->url_create("profile",$logins[login_loop]->user_info.user_username)}'><img src='{$logins[login_loop]->user_photo("./images/nophoto.gif", TRUE)}' class='photo' width='60' height='60' border='0' alt='' /></a>
        {/if}
      </td>
      {cycle name="endrow3" values=",</tr>"}
      {if (~$smarty.section.login_loop.index & 1) && $smarty.section.login_loop.last}</tr>{/if}
      {/section}
      </table>
    {else}
      {lang_print id=672}
    {/if}
  </div>*}
  <div class='portal_spacer'></div>

</div>



















</td>
<td valign='top'>
{* BEGIN MIDDLE COLUMN *}
<div style='float: left; width: 485px; padding: 0px 5px 0px 5px;'>
    <div>
      {* JAVASCRIPT FOR CHANGING STATUS - THIS IS ONLY SHOWN WHEN OWNER IS VIEWING OWN PROFILE, SO WE CAN USE VIEWER OBJECT *}
      {lang_javascript ids=773,1113,1344 range=743-747}
      {literal}
      <script type="text/javascript">
      <!-- 
      SocialEngine.Viewer.user_status = '{/literal}{lang_print id=1344}{literal}';
      //-->
      </script>
      {/literal}
      
      <div id='ajax_status'>
      	<script>
      		SocialEngine.Viewer.userStatusChangeHome();
      	</script>
      </div>
     </div>
    <br />
  {* SHOW PUBLIC VERSION OF ACTIVITY LIST *}  
  {if $actions|@count > 0}
    <div class='portal_whatsnew'>

      {* RECENT ACTIVITY ADVERTISEMENT BANNERS *}
      {if $ads->ad_feed != ""}
        <div class='portal_action' style='display: block; visibility: visible; padding-bottom: 10px;'>{$ads->ad_feed}</div>
      {/if}

      {* SHOW ACTIONS *}
      {section name=actions_loop loop=$actions max=10}
        <div id='action_{$actions[actions_loop].action_id}' class='portal_action{if $smarty.section.actions_loop.first}_top{/if}'>
          <table cellpadding='0' cellspacing='0'>
          <tr>
          <td valign='top'><img src='./images/icons/{$actions[actions_loop].action_icon}' border='0' class='icon' alt='' /></td>
          <td valign='top' width='100%'>
            {assign var='action_date' value=$datetime->time_since($actions[actions_loop].action_date)}
            <div class='portal_action_date'>{lang_sprintf id=$action_date[0] 1=$action_date[1]}</div>
            {assign var='action_media' value=''}
            {if $actions[actions_loop].action_media !== FALSE}{capture assign='action_media'}{section name=action_media_loop loop=$actions[actions_loop].action_media}<a href='{$actions[actions_loop].action_media[action_media_loop].actionmedia_link}'><img src='{$actions[actions_loop].action_media[action_media_loop].actionmedia_path}' border='0' width='{$actions[actions_loop].action_media[action_media_loop].actionmedia_width}' class='recentaction_media' alt='' /></a>{/section}{/capture}{/if}
            {lang_sprintf assign=action_text id=$actions[actions_loop].action_text args=$actions[actions_loop].action_vars}
            {$action_text|replace:"[media]":$action_media|choptext:50:"<br>"}
                </td>
          </tr>
          </table>
        </div>
      {/section}
    </div>
    <div class='portal_spacer'></div>
  {/if}

</div>





</td>
<td valign='top'>
{include file='rightside.tpl'}
</td>
</tr>
</table>







<div style='clear: both;'></div>

{include file='footer.tpl'}
