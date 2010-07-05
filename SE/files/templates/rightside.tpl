{* BEGIN RIGHT COLUMN CONTENT *}
<div style='float: right; width: 300px;'>
{* SHOW RIGHT-SIDE ADVERTISEMENT BANNER *}
{if $ads->ad_right != ""}
  <div class='ad_right' width='1' style='display: table-cell; visibility: visible;'>{$ads->ad_right}</div>
{/if}
<div>
	<a href='invite.php'><img src='./images/inviteimage.gif' border='0' alt='' /></a>
</div>
  {* SHOW LAST SIGNUPS *}
  <div class='header'>{lang_print id=666}</div>
  <div class='portal_content'>
    {if !empty($signups)}
    <table cellpadding='0' cellspacing='0' align='center'>
      {section name=signups_loop loop=$signups max=6}
      {cycle name="startrow" values="<tr>,,"}
      <td class='portal_member' valign="bottom"{if (~$smarty.section.signups_loop.index & 1) && $smarty.section.signups_loop.last} colspan="3" style="width:100%;"{else} style="width:33%;"{/if}>
        {if !empty($signups[signups_loop])}
          <a href='{$url->url_create("profile",$signups[signups_loop]->user_info.user_username)}'>{$signups[signups_loop]->user_displayname|regex_replace:"/&#039;/":"'"|truncate:15:"...":true}</a><br />
          <a href='{$url->url_create("profile",$signups[signups_loop]->user_info.user_username)}'><img src='{$signups[signups_loop]->user_photo("./images/nophoto.gif", TRUE)}' class='photo' width='60' height='60' border='0' alt='' /></a>
        {/if}
      </td>
      {cycle name="endrow" values=",,</tr>"}
      {/section}
      </table>
    {else}
      {lang_print id=667}
    {/if}
  </div>
  <div class='portal_spacer'></div>

  {* SHOW MOST POPULAR USERS (MOST FRIENDS) *}
  {if $setting.setting_connection_allow != 0}
    <div class='header'>{lang_print id=668}</div>
    <div class='portal_content'>
    {if !empty($friends)}
    <table cellpadding='0' cellspacing='0' align='center'>
      {section name=friends_loop loop=$friends max=6}
      {cycle name="startrow2" values="<tr>,,"}
      <td class='portal_member' valign="bottom"{if (~$smarty.section.friends_loop.index & 1) && $smarty.section.friends_loop.last} colspan="2" style="width:100%;"{else} style="width:33%;"{/if}>
        {if !empty($friends[friends_loop])}
        <a href='{$url->url_create("profile",$friends[friends_loop].friend->user_info.user_username)}'>{$friends[friends_loop].friend->user_displayname|regex_replace:"/&#039;/":"'"|truncate:15:"...":true}</a><br />
        <a href='{$url->url_create("profile",$friends[friends_loop].friend->user_info.user_username)}'><img src='{$friends[friends_loop].friend->user_photo("./images/nophoto.gif", TRUE)}' class='photo' width='60' height='60' border='0' alt='' /></a><br />
        {lang_sprintf id=669 1=$friends[friends_loop].total_friends}
        {/if}
      </td>
      {cycle name="endrow2" values=",,</tr>"}
      {/section}
      </table>
    {else}
      {lang_print id=670}
    {/if}
    </div>
    <div class='portal_spacer'></div>
  {/if}

</div>