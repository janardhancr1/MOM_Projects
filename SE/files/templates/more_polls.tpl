{include file='header.tpl'}

{* $Id: polls.tpl 59 2009-02-13 03:25:54Z john $ *}
<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<table cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td valign='top'>
<div class='page_header'>{$polltypeheader}</div>

</td>
<td valign='top' align='right'>

  <table cellpadding='0' cellspacing='0' width='150'>
  <tr><td class='button' nowrap='nowrap'><a href='browse_polls.php'><img src='./images/icons/back16.gif' border='0' class='button'>Back to Polls</a></td></tr>
  </table>

</td>
</tr>
</table>

<br />


{* JAVASCRIPT *}
{lang_javascript ids=2500028,2500034,2500114,2500115}

<script type='text/javascript' src="./include/js/class_poll.js"></script>
<script type='text/javascript'>
<!--
  SocialEngine.Polls = new SocialEngineAPI.Polls();
  SocialEngine.RegisterModule(SocialEngine.Polls);
//-->
</script>


{* POLL RESULTS TEMPLATE *}
<div id="pollResultTemplate" style="display:none;">
  <div class="pollResult">
    <div class="pollResultLabel"></div>
    <div class="pollResultBar"></div>
    <span class="pollResultPercentage"></span>
    <span class="pollResultVotes"></span>
  </div>
</div>

<table>
<tr>
<td colspan='2'>
{* DISPLAY PAGINATION MENU IF APPLICABLE *}
{if $maxpage > 1}
  <div class='center'>
    {if $p != 1}
      <a href='more_polls.php?type={$polltype}&s={$s}&search={$search}&p={math equation="p-1" p=$p}'>&#171; {lang_print id=182}</a>
    {else}
      <font class='disabled'>&#171; {lang_print id=182}</font>
    {/if}
    &nbsp;|&nbsp;
    {if $p_start==$p_end}
      {lang_sprintf id=2500035 1=$p_start 2=$total_polls}
    {else}
      {lang_sprintf id=2500036 1=$p_start 2=$p_end 3=$total_polls}
    {/if}
    &nbsp;|&nbsp;
    {if $p != $maxpage}
      <a href='more_polls.php?type={$polltype}&s={$s}&search={$search}&p={math equation="p+1" p=$p}'>{lang_print id=183} &#187;</a>
    {else}
      <font class='disabled'>{lang_print id=183} &#187;</font>
    {/if}
  </div>
  <br />
{/if}
</td>
</tr>
<tr>
<td>
{section name=poll_loop loop=$todays_polls}

    <div class='polls_browse_item' style='width: 620px; height: 80px; padding:5px'>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td style='vertical-align: top; padding-left: 0px;'>
        <div style='font-weight: bold; font-size: 13px;'>
          <img src="./images/icons/poll_poll16.gif" class='button' style='float: left;'>
          <a href='{$url->url_create("poll", $todays_polls[poll_loop]->poll_owner->user_info.user_username, $todays_polls[poll_loop]->poll_info.poll_id)}'>{$todays_polls[poll_loop]->poll_info.poll_title|truncate:30:"...":true}</a>
        </div>
        <div class='polls_browse_date'>
          {assign var='poll_datecreated' value=$datetime->time_since($todays_polls[poll_loop]->poll_info.poll_datecreated)}{capture assign="created"}{lang_sprintf id=$poll_datecreated[0] 1=$poll_datecreated[1]}{/capture}
          {lang_sprintf id=2500108 1=$created 2=$url->url_create("profile", $todays_polls[poll_loop]->poll_owner->user_info.user_username) 3=$todays_polls[poll_loop]->poll_owner->user_displayname}
        </div>
        <div style="margin-top: 5px;">
          {lang_sprintf id=2500028 1=$todays_polls[poll_loop]->poll_info.poll_totalvotes},
          {lang_sprintf id=507 1=$todays_polls[poll_loop]->poll_info.total_comments},
          {lang_sprintf id=949 1=$todays_polls[poll_loop]->poll_info.poll_views}
        </div>
        <div style='margin-top: 10px;'>
          {$todays_polls[poll_loop]->poll_info.poll_desc|escape:html|truncate:75:"...":true}
        </div>
      </td>
      </tr>
      </table>
    </div>
    
    {cycle values="<div style='clear: both; height: 10px;'></div>"}
  {/section}
 </td>
 </tr>
 <tr>
 <td  colspan='2'>
{* DISPLAY PAGINATION MENU IF APPLICABLE *}
{if $maxpage > 1}
  <div class='center'>
    {if $p != 1}
      <a href='more_polls.php?type={$polltype}&s={$s}&search={$search}&p={math equation="p-1" p=$p}'>&#171; {lang_print id=182}</a>
    {else}
      <font class='disabled'>&#171; {lang_print id=182}</font>
    {/if}
    &nbsp;|&nbsp;
    {if $p_start==$p_end}
      {lang_sprintf id=2500035 1=$p_start 2=$total_polls}
    {else}
      {lang_sprintf id=2500036 1=$p_start 2=$p_end 3=$total_polls}
    {/if}
    &nbsp;|&nbsp;
    {if $p != $maxpage}
      <a href='more_polls.php?type={$polltype}&s={$s}&search={$search}&p={math equation="p+1" p=$p}'>{lang_print id=183} &#187;</a>
    {else}
      <font class='disabled'>{lang_print id=183} &#187;</font>
    {/if}
  </div>
  <br>
{/if}
 </td>
 </tr>
 </table>
</div>
{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>
{include file='footer.tpl'}