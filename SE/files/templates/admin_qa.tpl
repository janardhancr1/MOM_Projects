{include file='admin_header.tpl'}

<h2>{lang_print id=27003005}</h2>
{lang_print id=27003008}
<br />
<br />


{* JAVASCRIPT FOR ADDING CATEGORIES*}
{literal}
<script type="text/javascript">
<!-- 
var categories;
var cat_type = 'vt_qa';
var showCatFields = 0;
var showSubcatFields = 0;
var subcatTab = 0;
var hideSearch = 1;
var hideDisplay = 1;
var hideSpecial = 1;

function createSortable(divId, handleClass) {
	new Sortables($(divId), {handle:handleClass, onComplete: function() { changeorder(this.serialize(), divId); }});
}

Sortables.implement({
	serialize: function(){
		var serial = [];
		this.list.getChildren().each(function(el, i){
			serial[i] = el.getProperty('id');
		}, this);
		return serial;
	}
});


window.addEvent('domready', function(){	createSortable('categories', 'img.handle_cat'); });

//-->
</script>
{/literal}

{* INCLUDE JAVASCRIPT AND FIELD DIV *}
{include file='admin_fields_js.tpl'}





{if $result != 0}
  <div class='success'><img src='../images/success.gif' class='icon' border='0'> {lang_print id=191}</div>
{/if}


<form action='admin_qa.php' method='POST'>

<table cellpadding='0' cellspacing='0' width='600'>
<td class='header'>{lang_print id=192}</td>
</tr>
<td class='setting1'>
  {lang_print id=27003274}
</td>
</tr>
<tr>
<td class='setting2'>
  <table cellpadding='2' cellspacing='0'>
  <tr>
  <td><input type='radio' name='setting_permission_qa' id='permission_qa_1' value='1'{if $setting.setting_permission_qa == 1} CHECKED{/if}></td>
  <td><label for='permission_qa_1'>{lang_print id=27003275}</label></td>
  </tr>
  <tr>
  <td><input type='radio' name='setting_permission_qa' id='permission_qa_0' value='0'{if $setting.setting_permission_qa == 0} CHECKED{/if}></td>
  <td><label for='permission_qa_0'>{lang_print id=27003276}</label></td>
  </tr>
  </table>
</td>
</tr>
</table>

<br>

{*<table cellpadding='0' cellspacing='0' width='600'>
<tr>
<td class='header'>{lang_print id=27003277}</td>
</tr>
<td class='setting1'>
{lang_print id=27003278}
</td></tr><tr><td class='setting2'>
  <table cellpadding='0' cellspacing='0'>
  <tr><td><input type='radio' name='setting_qa_code' id='code_1' value='1'{if $setting.setting_qa_code == 1} CHECKED{/if}>&nbsp;</td><td><label for='code_1'>{lang_print id=27003279}</label></td></tr>
  <tr><td><input type='radio' name='setting_qa_code' id='code_0' value='0'{if $setting.setting_qa_code == 0} CHECKED{/if}>&nbsp;</td><td><label for='code_0'>{lang_print id=27003280}</label></td></tr>
  </table>
</td></tr></table>

<br>*}

{*<table cellpadding='0' cellspacing='0' width='600'>
<tr>
<td class='header'>{lang_print id=27003330}</td>
</tr>
<tr>
<td class='setting1'>
{lang_print id=27003331}
</td>
</tr>
<tr>
<td class='setting2'>
<input type='text' class='text' name='setting_qa_html' value='{$setting.setting_qa_html}' maxlength='250' size='60'>
</td>
</tr>
</table>
  
<br>*}

<table cellpadding='0' cellspacing='0' width='600'>
<tr><td class='header'>{lang_print id=27003281}</td></tr>
<tr><td class='setting1'>
{lang_print id=27003282}
</td></tr><tr><td class='setting2'>


  {* SHOW ADD CATEGORY LINK *}
  <div style='font-weight: bold;'>&nbsp;{lang_print id=27003283} - <a href='javascript:addcat();'>[{lang_print id=104}]</a></div>

  <div id='categories' style='padding-left: 5px; font-size: 8pt;'>

  {* LOOP THROUGH CATEGORIES *}
  {section name=cat_loop loop=$cats}

    {* CATEGORY DIV *}
    <div id='cat_{$cats[cat_loop].cat_id}'>

      {* SHOW CATEGORY *}
      <div style='font-weight: bold;'><img src='../images/folder_open_yellow.gif' border='0' class='handle_cat' style='vertical-align: middle; margin-right: 5px; cursor: move;'><span id='cat_{$cats[cat_loop].cat_id}_span'><a href='javascript:editcat("{$cats[cat_loop].cat_id}", "0");' id='cat_{$cats[cat_loop].cat_id}_title'>{lang_print id=$cats[cat_loop].cat_title}</a></span></div>

      {* SHOW ADD SUBCATEGORY LINK *}
      <div style='padding-left: 20px; padding-top: 3px; padding-bottom: 3px;'>{lang_print id=1202} - <a href='javascript:addsubcat("{$cats[cat_loop].cat_id}");'>[{lang_print id=1203}]</a></div>

      {* JAVASCRIPT FOR SORTING CATEGORIES AND FIELDS *}
      {literal}
      <script type="text/javascript">
      <!-- 
      window.addEvent('domready', function(){ createSortable('subcats_{/literal}{$cats[cat_loop].cat_id}{literal}', 'img.handle_subcat_{/literal}{$cats[cat_loop].cat_id}{literal}'); });
      //-->
      </script>
      {/literal}

      {* SUBCATEGORY DIV *}
      <div id='subcats_{$cats[cat_loop].cat_id}' style='padding-left: 20px;'>

        {* LOOP THROUGH SUBCATEGORIES *}
        {section name=subcat_loop loop=$cats[cat_loop].subcats}
          <div id='cat_{$cats[cat_loop].subcats[subcat_loop].subcat_id}' style='padding-left: 15px;'>
            <div><img src='../images/folder_open_green.gif' border='0' class='handle_subcat_{$cats[cat_loop].cat_id}' style='vertical-align: middle; margin-right: 5px; cursor: move;'><span id='cat_{$cats[cat_loop].subcats[subcat_loop].subcat_id}_span'><a href='javascript:editcat("{$cats[cat_loop].subcats[subcat_loop].subcat_id}", "{$cats[cat_loop].cat_id}");' id='cat_{$cats[cat_loop].subcats[subcat_loop].subcat_id}_title'>{lang_print id=$cats[cat_loop].subcats[subcat_loop].subcat_title}</a></span></div>
          </div>
        {/section}

      </div>

      {* JAVASCRIPT FOR SORTING CATEGORIES AND FIELDS *}
      {literal}
      <script type="text/javascript">
      <!-- 
      window.addEvent('domready', function(){ createSortable('fields_{/literal}{$cats[cat_loop].cat_id}{literal}', 'img.handle_field_{/literal}{$cats[cat_loop].cat_id}{literal}'); });
      //-->
      </script>
      {/literal}

    </div>
  {/section}

  </div>



</td></tr></table>
  
<br>

<table cellpadding='0' cellspacing='0' width='600'>
<tr>
<td class='header'>{lang_print id=27003334}</td>
</tr>
<tr>
<td class='setting1'>
{lang_print id=27003335}
</td>
</tr>
<tr>
<td class='setting2'>
<select name='setting_qa_max_rating'>
{section name=loop start=2 loop=11}
<option value='{$smarty.section.loop.index}' {if $smarty.section.loop.index == $setting.setting_qa_max_rating}selected='selected'{/if}>{$smarty.section.loop.index}</option>
{/section}
</select>
</td>
</tr>
</table>

<br>

<table cellpadding='0' cellspacing='0' width='600'>
<tr>
<td class='header'>{lang_print id=27003336}</td>
</tr>
<tr>
<td class='setting1'>
{lang_print id=27003337}
</td>
</tr>
<tr>
<td class='setting2'>
<select name='setting_qa_vote_time_default'>
{section name=loop start=1 loop=30}
<option value='{$smarty.section.loop.index }' {if $smarty.section.loop.index * 86400 == $setting.setting_qa_vote_time_default}selected='selected'{/if}>{$smarty.section.loop.index}</option>
{/section}
</select> {lang_print id=27003340}
</td>
</tr>
{*<tr>
<td class='setting1'>
{lang_print id=27003338}
</td>
</tr>
<tr>
<td class='setting2'>
<input type='checkbox' name='setting_qa_user_vote_time_enabled' {if $setting.setting_qa_user_vote_time_enabled == 1} checked='checked'{/if} maxlength='250' size='30'>
</td>
</tr>*}
<tr>
<td class='setting1'>
{lang_print id=27003339}
</td>
</tr>
<tr>
<td class='setting2'>
<select name='setting_qa_select_time_min'>
{section name=loop start=1 loop=48}
<option value='{$smarty.section.loop.index}' {if $smarty.section.loop.index * 3600 == $setting.setting_qa_select_time_min}selected='selected'{/if}>{$smarty.section.loop.index}</option>
{/section}
</select> {lang_print id=27003341}
</td>
</tr>
<tr>
<td class='setting1'>
{lang_print id=27003342}
</td>
</tr>
<tr>
<td class='setting2'>
<select name='setting_qa_voting_time'>
{section name=loop start=1 loop=30}
<option value='{$smarty.section.loop.index}' {if $smarty.section.loop.index * 86400 == $setting.setting_qa_voting_time}selected='selected'{/if}>{$smarty.section.loop.index}</option>
{/section}
</select> {lang_print id=27003340}
</td>
</tr>
</table>
<br>

<table cellpadding='0' cellspacing='0' width='600'>
<tr>
<td class='header'>{lang_print id=27003332}</td>
</tr>
<tr>
<td class='setting1'>
{lang_print id=27003333}
</td>
</tr>
<tr>
<td class='setting2'>
<input type='text' class='text' name='setting_qa_ad_ids' value='{$setting.setting_qa_ad_ids}' maxlength='250' size='30'>
</td>
</tr>
</table>

<br>

<input type='submit' class='button' value='{lang_print id=173}'>
<input type='hidden' name='task' value='dosave'>
</form>


{include file='admin_footer.tpl'}