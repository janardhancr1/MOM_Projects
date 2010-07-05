{include file='header.tpl'}

{* $Id: classifieds_home.tpl 242 2009-11-14 02:54:58Z phil $ *}

<div style='float: left; width: 680px; padding: 0px 5px 5px 10px;'>
<div class='page_header'><img src='./images/icons/classified_classified48.gif' border='0' class='icon_big'>{lang_print id=4500007}
<div class="page_header_small">Classified listings are a great way to list something for sale or find items.</div>
</div>

<div class='portal_spacer'>
</div>
<div style='border: 1px solid #BBBBBB; width:98%;padding: 5px;background: #F2F2F2;'>
<form action='browse_classifieds.php' method='post' name="seBrowseClassifieds">
<input type='hidden' name='task' value='dosearch' />
<input type='hidden' name='classifiedcat_id' value='{$classifiedcat_id|default:0}' />
<input type='hidden' name='p' value='{$p|default:1}' />
<table width='100%'>
	</tr>
		<td width="75%">
			{lang_print id=646} <input type='text' class='qsearch' name='classified_search' value='{$classified_search}' style='width:250px' onfocus="if(this.value == 'What are you looking for?') this.value='';" onblur="if(this.value.length == 0) this.value='What are you looking for?';">
			&nbsp;<input type="submit" value="{lang_print id=646}" class="button" />
		</td>
		<td width="25%">
			<div class='mom_div_small'><a href='user_classified.php' class='mom_div_small'><img src='./images/icons/plus16.gif' border='0' class='button'>Go To My Classifieds</a></div>
		</td>
	</tr>
	</table>	
</form>
</div>

<div class='classi_left'>
<table width='100%'>
  	<tr>
  	<td valign='top'>
  		{assign var="i" value=$i|default:0}
  		{section name=cat_loop loop=$cats}
  		<table>
  		<tr>
  		<td>
	  		<img src='../images/classifieds/{lang_print id=$cats[cat_loop].cat_title}.gif' border='0' alt='' >
	  	</td>
	  	<td>
	  	<a class="classi_left" href='browse_classifieds.php?s={$s}&v={$v}&classifiedcat_id={$cats[cat_loop].cat_id}'>
  			<font size="2">{lang_print id=$cats[cat_loop].cat_title}</font>
  		</a>
  		</td>
  		</tr>
  		</table>
  		{assign var="i" value=$i+1}
  		{section name=subcat_loop loop=$cats[cat_loop].subcats}
            <div style='font-weight: normal;padding-top:1px;padding-left:5px'>
            <img src='../images/classifieds/bullet.gif' border='0' alt='' >
            <a class="classi_left" href='browse_classifieds.php?s={$s}&v={$v}&classifiedcat_id={$cats[cat_loop].subcats[subcat_loop].subcat_id}'>{lang_print id=$cats[cat_loop].subcats[subcat_loop].subcat_title}</a></div>
            {if $i % 34 == 0}
          	</td><td valign='top'>
          {/if}
          {assign var="i" value=$i+1}
          {/section}
          {if $i % 34 == 0}
          	<br/></td><td valign='top'>
          {/if}
  		{/section}
  	</td>
	</tr>
	</table>
</div>
<div style='float:left;width:165px;padding:5px'>
<div class='classi_menu_link_container'>
	Most Recent Listings
</div>
<div style='background:#ECECED;color:Black;width:140px;height:500px;padding:10px'>
<div style='clear: both; height: 10px;'></div>
	{section name=classified_loop loop=$classifieds}
	<div style='font-weight: bold; font-size: 12px;padding:5px'>
      <a class='classi_most' href='{$url->url_create("classified", $classifieds[classified_loop].classified_author->user_info.user_username, $classifieds[classified_loop].classified->classified_info.classified_id)}'>
        {$classifieds[classified_loop].classified->classified_info.classified_title}
      </a>
    </div>
   {/section}
</div>

</div>
<form>
</div>
{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>
{include file='footer.tpl'}