{include file='header.tpl'}

{* $Id: browse_groups.tpl 247 2009-11-14 03:30:43Z phil $ *}

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'><img src='./images/icons/group_group48.gif' border='0' class='icon_big'>{lang_print id=2000007}
<div class="page_header_small">Find a group to join or create a new one and invite your friends.</div>
</div>
<div style='padding-left: 50px;padding-top:10px;padding-bottom:10px' >

</div>
<div>

<div style='float:left;padding: 10px; background: #F2F2F2; border: 1px solid #BBBBBB; font-weight: bold;width:650px'>

    <div style='float:left;text-align: center; line-height: 16px;width:30%'>
      {lang_print id=1000128}&nbsp;
      <select class='group_small' name='v' onchange="window.location.href='browse_groups.php?s={$s}&v='+this.options[this.selectedIndex].value;">
      <option value='0'{if $v == "0"} SELECTED{/if}>{lang_print id=2000127}</option>
      {if $user->user_exists}<option value='1'{if $v == "1"} SELECTED{/if}>{lang_print id=2000128}</option>{/if}
      </select>
    </div>

    <div style='float:left;text-align: center; line-height: 16px;padding-left:5px;width:30%'>
      {lang_print id=1000131}&nbsp;
      <select class='group_small' name='s' onchange="window.location.href='browse_groups.php?v={$v}&s='+this.options[this.selectedIndex].value;">
      <option value='group_totalmembers DESC'{if $s == "group_totalmembers DESC"} SELECTED{/if}>{lang_print id=2000129}</option>
      <option value='group_datecreated DESC'{if $s == "group_datecreated DESC"} SELECTED{/if}>{lang_print id=2000130}</option>
      </select>
    </div>
    
    <div style='float:left;text-align: center; line-height: 16px;padding-left:5px;width:20%'>
      Groups:
      <select class='group_small' name='grpCart' onchange="window.location.href='browse_groups.php?v={$v}&s={$s}&groupcat_id='+this.options[this.selectedIndex].value;">
      {section name=cat_loop loop=$cats}
      <option value='$cats[cat_loop].cat_id'>{lang_print id=$cats[cat_loop].cat_title}</option>
      {section name=subcat_loop loop=$cats[cat_loop].subcats}
      <option value='{$cats[cat_loop].subcats[subcat_loop].subcat_id}'>{lang_print id=$cats[cat_loop].subcats[subcat_loop].subcat_title}</option>
      {/section}
      {/section}
      </select>
    </div>
    
    <div style='float:left; line-height: 16px;padding-left:15px;width:15%'>
     <div class='mom_div_small'><a href='user_group.php' class='mom_div_small'><img src='./images/icons/plus16.gif' border='0' class='button'>My Groups</a></div>
    </div>

	
  </div>
<div style='float:left;width:670px'>
<table cellpadding='0' cellspacing='0' width='100%' style='margin-top: 10px;'>
<tr>
<td style='vertical-align: top; width:100%'>

  {* NO GROUPS AT ALL *}
  {if $groups|@count == 0}
    <br>
    <table cellpadding='0' cellspacing='0' align='center'>
      <tr>
        <td class='result'>
          <img src='./images/icons/bulb16.gif' border='0' class='icon' />
          {lang_print id=2000132}
        </td>
      </tr>
    </table>
  {/if}

  {* DISPLAY PAGINATION MENU IF APPLICABLE *}
  {if $maxpage > 1}
    <div class='group_pages_top'>
    {if $p != 1}<a href='browse_groups.php?s={$s}&v={$v}&groupcat_id={$groupcat_id}&p={math equation="p-1" p=$p}'>&#171; {lang_print id=182}</a>{else}&#171; {lang_print id=182}{/if}
    &nbsp;|&nbsp;&nbsp;
    {if $p_start == $p_end}
      <b>{lang_sprintf id=184 1=$p_start 2=$total_groups}</b>
    {else}
      <b>{lang_sprintf id=185 1=$p_start 2=$p_end 3=$total_groups}</b>
    {/if}
    &nbsp;&nbsp;|&nbsp;
    {if $p != $maxpage}<a href='browse_groups.php?s={$s}&v={$v}&groupcat_id={$groupcat_id}&p={math equation="p+1" p=$p}'>{lang_print id=183} &#187;</a>{else}{lang_print id=183} &#187;{/if}
    </div>
  {/if}

  {section name=group_loop loop=$groups}
  <div style='padding: 10px; border: 1px solid #CCCCCC; margin-bottom: 10px;'>
    <table cellpadding='0' cellspacing='0'>
      <tr>
        <td>
          <a href='{$url->url_create("group", $smarty.const.NULL, $groups[group_loop].group->group_info.group_id)}'>
            <img src='{$groups[group_loop].group->group_photo("./images/nophoto.gif", TRUE)}' border='0' width='60' height='60' />
          </a>
        </td>
        <td style='vertical-align: top; padding-left: 10px;'>
          <div style='font-weight: bold; font-size: 13px;'>
            <a href='{$url->url_create("group", $smarty.const.NULL, $groups[group_loop].group->group_info.group_id)}'>
              {$groups[group_loop].group->group_info.group_title}
            </a>
          </div>
          <div style='color: #777777; font-size: 9px; margin-bottom: 5px;'>
            {assign var='group_dateupdated' value=$datetime->time_since($groups[group_loop].group->group_info.group_dateupdated)}
            {capture assign="updated"}{lang_sprintf id=$group_dateupdated[0] 1=$group_dateupdated[1]}{/capture}
            {capture assign='group_leader'}<a href='{$url->url_create("profile", $groups[group_loop].group_leader->user_info.user_username)}'>{$groups[group_loop].group_leader->user_displayname}</a>{/capture}
            {lang_sprintf id=2000133 1=$groups[group_loop].group_members 2=$group_leader} - {lang_sprintf id=2000134 1=$updated}
          </div>
          <div>
            {$groups[group_loop].group->group_info.group_desc|strip_tags|truncate:300:"...":true}
          </div>
        </td>
      </tr>
    </table>
  </div>
  {/section}

  {* DISPLAY PAGINATION MENU IF APPLICABLE *}
  {if $maxpage > 1}
    <div class='group_pages_bottom'>
    {if $p != 1}<a href='browse_groups.php?s={$s}&v={$v}&groupcat_id={$groupcat_id}&p={math equation="p-1" p=$p}'>&#171; {lang_print id=182}</a>{else}&#171; {lang_print id=182}{/if}
    &nbsp;|&nbsp;&nbsp;
    {if $p_start == $p_end}
      <b>{lang_sprintf id=184 1=$p_start 2=$total_groups}</b>
    {else}
      <b>{lang_sprintf id=185 1=$p_start 2=$p_end 3=$total_groups}</b>
    {/if}
    &nbsp;&nbsp;|&nbsp;
    {if $p != $maxpage}<a href='browse_groups.php?s={$s}&v={$v}&groupcat_id={$groupcat_id}&p={math equation="p+1" p=$p}'>{lang_print id=183} &#187;</a>{else}{lang_print id=183} &#187;{/if}
    </div>
  {/if}

</td>
</tr>
</table>
</div>
</div>
</div>

{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>





{include file='footer.tpl'}