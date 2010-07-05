{include file='header.tpl'}

{* $Id: browse_polls.tpl 246 2009-11-14 03:30:06Z phil $ *}
<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'><img src='./images/icons/poll_poll48.gif' border='0' class='icon_big'>{lang_print id=2500005}
<div class="page_header_small">Create a Poll or Tell Others What you Think</div>
</div>

<div style='padding: 7px 10px 7px 10px; background: #F2F2F2; border: 1px solid #BBBBBB; margin: 10px 0px 10px 0px; font-weight: bold;'>
  	<table cellpadding='0' cellspacing='0' width='100%'>
  	<tr>
  		<td width="50%">
			<table cellpadding='0' cellspacing='0'>
			<tr>
		  		<td>
		    		{lang_print id=2500101}&nbsp;
		  		</td>
		  		<td>
		    		<select class='small' name='v' onchange="window.location.href='browse_polls.php?s={$s}&v='+this.options[this.selectedIndex].value;">
		      			<option value='0'{if $v == "0"} SELECTED{/if}>{lang_print id=2500103}</option>
		      			{if $user->user_exists}<option value='1'{if $v == "1"} SELECTED{/if}>{lang_print id=2500104}</option>{/if}
		    		</select>
		  		</td>
		  		<td style='padding-left: 20px;'>
		    		{lang_print id=2500102}&nbsp;
		  		</td>
		  		<td>
			    	<select class='small' name='s' onchange="window.location.href='browse_polls.php?v={$v}&s='+this.options[this.selectedIndex].value;">
			      		<option value='poll_datecreated DESC'{if $s == "poll_datecreated DESC"} SELECTED{/if}>{lang_print id=2500105}</option>
			      		<option value='poll_totalvotes DESC'{if $s == "poll_totalvotes DESC"} SELECTED{/if}>{lang_print id=2500106}</option>
			      		<option value='poll_views DESC'{if $s == "poll_views DESC"} SELECTED{/if}>{lang_print id=2500107}</option>
			    	</select>
		  		</td>
			</tr>
		</table>
	</td>
  	<td width="50%" align="right">
	  	<table cellpadding='0' cellspacing='0'>
	  		<tr>
	  			<td>
	  				<div class='mom_div_small'><a href='user_poll.php' class='mom_div_small'><img src='./images/icons/plus16.gif' border='0' class='button'>Go to My Polls</a></div>
	  			</td>
	  		</tr>
	  	</table>
  	</td>
  </tr>
  </table>
</div>

<table width='480px'>
<tr>
<td>
	<div class='page_header_small' style='float:left;'>
		Today's Polls 
	</div>
</td>
<td>
	<div class='page_header_xxsmall' style='padding-left:30px'><a href='more_polls.php?type=todays'>Click to see more </a></div>
</td>
</td>
</tr>
</table>

<div>
  {if $todays_total <= 0 }
  <div class='polls_browse_item' style='width: 620px; height: 80px; float: left;font-size:30px'>
  	<center>
  		No Polls Yet Today
  	<center>
  </div>
  {/if}
  {section name=poll_loop loop=$todays_polls}

    <div class='polls_browse_item' style='width: 310px; height: 80px; float: left;'>
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
    
    {cycle values=",<div style='clear: both; height: 10px;'></div>"}
  {/section}

</div>
<div style='clear: both; height: 10px;'></div>
<table width='480px'>
<tr>
<td>
	<div class='page_header_small' style='float:left'>
		Most Popular Polls
	</div>
</td>
<td>
	<div class='page_header_xxsmall' style='padding-left:30px'><a href='more_polls.php?type=popular'>Click to see more </a></div>
</td>
</tr>
</table>

{section name=poll_loop loop=$popular_polls}

    <div class='polls_browse_item' style='width: 450px; height: 30px; float: left;'>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td style='vertical-align: top; padding-left: 0px;'>
        <div style='font-weight: bold; font-size: 13px;'>
          <img src="./images/icons/poll_poll16.gif" class='button' style='float: left;'>
          <a href='{$url->url_create("poll", $popular_polls[poll_loop]->poll_owner->user_info.user_username, $popular_polls[poll_loop]->poll_info.poll_id)}'>{$popular_polls[poll_loop]->poll_info.poll_title|truncate:30:"...":true}</a>
        </div>
        <div class='polls_browse_date'>
          {assign var='poll_datecreated' value=$datetime->time_since($popular_polls[poll_loop]->poll_info.poll_datecreated)}{capture assign="created"}{lang_sprintf id=$poll_datecreated[0] 1=$poll_datecreated[1]}{/capture}
          {lang_sprintf id=2500108 1=$created 2=$url->url_create("profile", $polls[poll_loop]->poll_owner->user_info.user_username) 3=$popular_polls[poll_loop]->poll_owner->user_displayname}
        </div>
      </td>
      </tr>
      </table>
    </div>
   <div style='clear: both; height: 10px;'></div>
  {/section}

</div>
{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>

{include file='footer.tpl'}