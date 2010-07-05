{include file='header.tpl'}
<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
{if $user->level_info.level_qa_allow}
<div class='qa_ask_new'><a href='javascript:void(0)' id='qa_ask_link'><img src='./images/qa_question_add.gif' border='0' class='button' />{lang_print id=27003059}</a></div>
{/if}
<div class='page_header'>
  {if $qacat == ""}
    {lang_print id=27003150}
  {else}
    <a href='browse_questions.php'>{lang_print id=27003150}</a> >
    {if $qasubcat == ""}
      {lang_print id=$qacat.vt_qacat_title}
    {else}
      <a href='browse_questions.php?v={$v}&s={$s}&qacat_id={$qacat.vt_qacat_id}'>{lang_print id=$qacat.vt_qacat_title}</a> >
      {lang_print id=$qasubcat.vt_qacat_title}
    {/if}
  {/if}
</div>

{if $user->level_info.level_qa_allow}
<div id='qa_question_form' >
<form action="question_ask.php" method="post" id='qa_ask'>
<input type="hidden" name="task" value="submit_question" />
<p>{lang_print id=27003432}</p>
<div id='qa_title_cnt'>{lang_print id=27003434}<span id='qa_title_cnt_num'></span></div>
<input type='text' name='question_title' id='qa_title_text' maxlength='120' class="validate['required','length[10,-1]'] text-input"/>
<p>{lang_print id=27003433}</p>
<textarea name='question_text' id='qa_question_text' ></textarea>
<p>Tags - help moms find your question, i.e.</p>
<input type='text' name='question_tags' id='qa_title_tag' maxlength='120'/>
<p>Choose question category</p>
{lang_print id=27003435}&nbsp;<select name='question_catid' id='cat_select' class="validate['required']">
<option value='-1'>{lang_print id=27003437}</option>
{foreach from=$qacats_ask item=qacat}
<option value='{$qacat.cat_id}'>{lang_print id=$qacat.cat_title}</option>
{/foreach} 
</select>  &nbsp;&nbsp;{lang_print id=27003436}&nbsp;<select name='question_subcatid' id='subcat_select'></select><br/>
<br/>
<input type="submit" class='button' value='{lang_print id=27003431}'  id='qa_submit'/> <input type='button' class='button' id='qa_ask_cancel' value='{lang_print id=27003413}' />
</form>
</div>
{/if}

{* JavaScript related to asking of question *}
{if $user->level_info.level_qa_allow}
<link media="screen" type="text/css" href="include/js/formcheck/theme/classic/formcheck.css" rel="stylesheet" /> 
<script type="text/javascript" src="include/js/formcheck/formcheck.js"></script> 
<script type='text/javascript'>
<!--
var cats = [
{foreach from=$qacats_ask item=qacat name=cats}
  [{$qacat.cat_id}, [ {section name=subcat_loop loop=$qacat.subcats}
  {capture assign=qa_tmp_title}{lang_print id=$qacat.subcats[subcat_loop].cat_title}{/capture}
[{$qacat.subcats[subcat_loop].cat_id}, '{$qa_tmp_title|htmlspecialchars_decode}']{if not $smarty.section.subcat_loop.last}, {/if}
{/section} ] ]{if not $smarty.foreach.cats.last}, 
{/if}
{/foreach}
];

{literal}

formcheckLanguage = {
	required: "{/literal}{lang_print id=27003460}{literal}",
	lengthmin: "{/literal}{lang_print id=27003461}{literal}",
	select: "{/literal}{lang_print id=27003462}{literal}"
}
window.addEvent('domready', function(){
	textarea_autogrow('qa_question_text');
	
    new FormCheck('qa_ask', {
            display : {
                titlesInsteadNames : false,
				indicateErrors: 2
            }
		});

	var questionSlide = new Fx.Slide('qa_question_form').chain(function() {
		$('qa_question_form').getParent().setStyle('height','auto');	
	});
	questionSlide.hide();
	
	$('qa_ask_link').addEvent('click', function(e){
		e.stop();
		$('qa_question_form').getParent().setStyle('clear','both');	
		questionSlide.slideIn();
	});

	$('qa_ask_cancel').addEvent('click', function(e){
		e.stop();
		questionSlide.slideOut();
	});

	$('cat_select').addEvent('change', function(e){
		updateSubcats();
	});
	
	$('qa_title_text').addEvent('keyup', function(e){
		updateTitleCnt();
	});

	updateSubcats();
	updateTitleCnt();

});


function updateSubcats() {
	$('subcat_select').erase('html');
	if ($('cat_select').get('value') > 0) {
		var newOption = new Element('option', {
			'value': -1,
			'text': '{/literal}{lang_print id=27003437}{literal}'
		});
		newOption.inject($('subcat_select'));
	}
	for(cat in cats){
		if (cats[cat][0] == $('cat_select').get('value')) {
			for(i=0;i<cats[cat][1].length;i++){				
				var newOption = new Element('option', {
					'value': cats[cat][1][i][0],
					'text': cats[cat][1][i][1]
				});
				newOption.inject($('subcat_select'));
			}
		}
	}
}

function updateTitleCnt() {
	$('qa_title_cnt_num').set('html', 120-$('qa_title_text').get('value').length);
}
//-->
</script>
{/literal}
{/if}

<table cellpadding='0' cellspacing='0' width='100%' style='margin-top: 10px;'>
<tr>
<td style='width: 200px; vertical-align: top;'>



  <div style='margin-top: 10px; padding: 5px; background: #F2F2F2; border: 1px solid #BBBBBB; margin: 0px 0px 10px 0px; font-weight: bold;'>
  	<h2>{lang_print id=27003405}</h2>
	{section name=cat_loop loop=$qacats}
	{capture assign='cat_string_name'}{lang_print id=$qacats[cat_loop].cat_title}{/capture}
	<p class='{$qacats[cat_loop].cat_class}'><a href='{$url->url_create("question_cat", $smarty.const.NULL, $qacats[cat_loop].cat_id,$cat_string_name)}'>{$cat_string_name}</a></p>
	{/section}
  </div>

	{if $qa_ad_id > 0}
	{$ads->ads_display($qa_ad_id)}
	{/if}
</td>
<td style='vertical-align: top; padding-left: 10px;'>

  {* NO QUESTIONS AT ALL *}
  {if $questions|@count == 0}
    <br>
    <table cellpadding='0' cellspacing='0' align='center'>
      <tr>
        <td class='result'>
          <img src='./images/icons/bulb16.gif' border='0' class='icon' />
          {lang_print id=27003048}
        </td>
      </tr>
    </table>
  {/if}

  {* DISPLAY PAGINATION MENU IF APPLICABLE *}
  {if $maxpage > 1}
    <div class='question_pages_top'>
    {if $p != 1}<a href='browse_questions.php?s={$s}&v={$v}&qacat_id={$vt_qacat_id}&p={math equation="p-1" p=$p}'>&#171; {lang_print id=182}</a>{else}&#171; {lang_print id=182}{/if}
    &nbsp;|&nbsp;&nbsp;
    {if $p_start == $p_end}
      <b>{lang_sprintf id=184 1=$p_start 2=$total_questions}</b>
    {else}
      <b>{lang_sprintf id=185 1=$p_start 2=$p_end 3=$total_questions}</b>
    {/if}
    &nbsp;&nbsp;|&nbsp;
    {if $p != $maxpage}<a href='browse_questions.php?s={$s}&v={$v}&qacat_id={$vt_qacat_id}&p={math equation="p+1" p=$p}'>{lang_print id=183} &#187;</a>{else}{lang_print id=183} &#187;{/if}
    </div>
  {/if}

  {section name=question_loop loop=$questions}
  <div style='padding: 10px; border: 1px solid #CCCCCC; margin-bottom: 10px;'>
    <table cellpadding='0' cellspacing='0'>
      <tr>
        <td>
          <a href='{$url->url_create("profile", $questions[question_loop].question_author->user_info.user_username)}'>
            <img src='{$questions[question_loop].question_author->user_photo("./images/nophoto.gif", TRUE)}' border='0' width='60' height='60' />
          </a>
        </td>
        <td style='vertical-align: top; padding-left: 10px;'>
          <div style='font-weight: bold; font-size: 10pt;'>
            <a href='{$url->url_create("question", $smarty.const.NULL, $questions[question_loop].question_author->user_info.user_username, $questions[question_loop].question_id)}'>
              {$questions[question_loop].question_title}
            </a>
          </div>
          <div style='color: #777777; font-size: 7pt; margin-bottom: 5px;'>
            {assign var='question_dateupdated' value=$datetime->time_since($questions[question_loop].question_time)}
            {capture assign="updated"}{lang_sprintf id=$question_dateupdated[0] 1=$question_dateupdated[1]}{/capture}
            {capture assign='question_leader'}<a href='{$url->url_create("profile", $questions[question_loop].question_author->user_info.user_username)}'>{$questions[question_loop].question_author->user_info.user_displayname}</a>{/capture}
	  		{capture assign='subcat_string_name'}{lang_print id=$questions[question_loop].subcat_name_langid}{/capture}
            {capture assign='question_cat'}<a href='{$url->url_create("question_cat", $smarty.const.NULL, $questions[question_loop].question_subcat_id,$subcat_string_name)}'>{$subcat_string_name}</a>{/capture}
            {lang_sprintf id=27003400 1=$question_cat} - {lang_sprintf id=27003401 1=$question_leader} - {if $questions[question_loop].question_num_answers == 1}{lang_sprintf id=27003402 1=$questions[question_loop].question_num_answers}{else}{lang_sprintf id=27003403 1=$questions[question_loop].question_num_answers}{/if} - {lang_sprintf id=27003404 1=$updated} - {$questions[question_loop].question_state|qa_state_name}
          </div>
          <div>
            {$questions[question_loop].question_text|strip_tags|truncate:300:"...":true}
          </div>
        </td>
      </tr>
    </table>
  </div>
  {/section}

  {* DISPLAY PAGINATION MENU IF APPLICABLE *}
  {if $maxpage > 1}
    <div class='question_pages_bottom'>
    {if $p != 1}<a href='browse_questions.php?s={$s}&v={$v}&qacat_id={$vt_qacat_id}&p={math equation="p-1" p=$p}'>&#171; {lang_print id=182}</a>{else}&#171; {lang_print id=182}{/if}
    &nbsp;|&nbsp;&nbsp;
    {if $p_start == $p_end}
      <b>{lang_sprintf id=184 1=$p_start 2=$total_questions}</b>
    {else}
      <b>{lang_sprintf id=185 1=$p_start 2=$p_end 3=$total_questions}</b>
    {/if}
    &nbsp;&nbsp;|&nbsp;
    {if $p != $maxpage}<a href='browse_questions.php?s={$s}&v={$v}&qacat_id={$vt_qacat_id}&p={math equation="p+1" p=$p}'>{lang_print id=183} &#187;</a>{else}{lang_print id=183} &#187;{/if}
    </div>
  {/if}

</td>
</tr>
</table>



</div>
{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>


{include file='footer.tpl'}