{include file='header.tpl'}
<div style='float: left; width: 685px; padding: 0px 0px 5px 5px;'>
{if $user->level_info.level_qa_allow}
<div class='qa_ask_new'><a href='javascript:void(0)' id='qa_ask_link'><img src='./images/qa_question_add.gif' border='0' class='button' />{lang_print id=27003059}</a></div>
{/if}
<div>
  <img src='./images/icons/qa_qa48.gif' border='0' class='icon_big' />
  <div class='page_header'>{lang_print id=27003450}</div>
  {lang_print id=27003451}
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

{* BEGIN QUESTIONS *}
{if $user->level_info.level_qa_allow != 0 AND ($total_questions > 0 OR $total_answers > 0)}
<div class='qa_user_status_column'>
{*<div class='qa_user_status' >
</div>*}
	{if $qa_ad_id > 0}
	{$ads->ads_display($qa_ad_id)}
	{/if}
</div>

<ul class='qa_tabs_ul'>
<li class='qa_tabs_li' id='qa_tab_q'><a href='javascript:void(0)' id='qa_tab_q_a'>{lang_print id=27003171} ({$total_questions})</a></li>
<li class='qa_tabs_li' id='qa_tab_a'><a href='javascript:void(0)' id='qa_tab_a_a'>{lang_print id=27003173} ({$total_answers})</a></li>
</ul>
<div class='qa_user_questions_content'>
<div  id='qa_div_q'>
{*  <div class='profile_headline'>
    {lang_print id=27003171} ({$total_questions})
  </div>  *}

  {* DISPLAY PAGINATION MENU IF APPLICABLE *}
  {if $maxpage_q > 1}
    <div class='question_pages_top'>
    {if $p_q != 1}<a href='user_questions.php?s_q={$s_q}&v_q={$v_q}&p_q={math equation="p-1" p=$p_q}&t=0'>&#171; {lang_print id=182}</a>{else}&#171; {lang_print id=182}{/if}
    &nbsp;|&nbsp;&nbsp;
    {if $p_start_q == $p_end_q}
      <b>{lang_sprintf id=184 1=$p_start_q 2=$total_questions}</b>
    {else}
      <b>{lang_sprintf id=185 1=$p_start_q 2=$p_end_q 3=$total_questions}</b>
    {/if}
    &nbsp;&nbsp;|&nbsp;
    {if $p_q != $maxpage_q}<a href='user_questions.php?s_q={$s_q}&v_q={$v_q}&p_q={math equation="p+1" p=$p_q}&t=0'>{lang_print id=183} &#187;</a>{else}{lang_print id=183} &#187;{/if}
    </div>
  {/if}

  {* LOOP THROUGH FIRST QUESTIONS *}
  {section name=question_loop loop=$questions}

    <div class='qa_question' style='{cycle name='rightspacer' values="margin-right: 10px;,"}'>
      <table cellpadding='0' cellspacing='0' width='100%'>
      <tr>
      <td class='qa_question_main'>
        {if $questions[question_loop].question_time > 0}
	  {assign var="question_time" value=$datetime->time_since($questions[question_loop].question_time)}
	  {capture assign='updateddate'}{lang_sprintf id=$question_time[0] 1=$question_time[1]}{/capture}
          <div class='qa_question_date'>{lang_sprintf id=27003140 1=$updateddate}</div>
        {/if}
        <div class='qa_question_title'><a href='{$url->url_create('question', '', $questions[question_loop].question_author->user_info.user_username, $questions[question_loop].question_id)}'>{$questions[question_loop].question_title|truncate:96:"...":true}</a></div>
        <div style='margin-top: 10px;'>{$questions[question_loop].question_text|truncate:175:"...":true}</div>
      </td>
      </tr>
	  <tr>
	  <td class='qa_question_info'>
	  {capture assign='subcat_string_name'}{lang_print id=$questions[question_loop].subcat_name_langid}{/capture}
	  {capture assign='subcat_name'}<a href='{$url->url_create('question_cat', '', $questions[question_loop].subcat_id,$subcat_string_name)}'>{$subcat_string_name}</a>{/capture}
	  {lang_sprintf id=27003175 1=$subcat_name} - {lang_sprintf id=27003174 1=$questions[question_loop].question_num_answers} - {$questions[question_loop].question_state|qa_state_name}
	  </td>
	  </tr>
      </table>
    </div>
    {cycle values=",<div name='bottomspacer' style='clear: both; height: 10px;'></div>"}
    
  {/section}

  {* DISPLAY PAGINATION MENU IF APPLICABLE *}
  {if $maxpage_q > 1}
    <div class='question_pages_bottom'>
    {if $p_q != 1}<a href='user_questions.php?s_q={$s_q}&v_q={$v_q}&p_q={math equation="p-1" p=$p_q}&t=0'>&#171; {lang_print id=182}</a>{else}&#171; {lang_print id=182}{/if}
    &nbsp;|&nbsp;&nbsp;
    {if $p_start_q == $p_end_q}
      <b>{lang_sprintf id=184 1=$p_start_q 2=$total_questions}</b>
    {else}
      <b>{lang_sprintf id=185 1=$p_start_q 2=$p_end_q 3=$total_questions}</b>
    {/if}
    &nbsp;&nbsp;|&nbsp;
    {if $p_q != $maxpage_q}<a href='user_questions.php?s_q={$s_q}&v_q={$v_q}&p_q={math equation="p+1" p=$p_q}&t=0'>{lang_print id=183} &#187;</a>{else}{lang_print id=183} &#187;{/if}
    </div>
  {/if}

  <div style='clear: both; height: 0px;'></div>
</div>


<div  id='qa_div_a'>
 {* <div class='profile_headline'>
    {lang_print id=27003173} ({$total_answers})
  </div>  *}

  {* DISPLAY PAGINATION MENU IF APPLICABLE *}
  {if $maxpage_a > 1}
    <div class='question_pages_top'>
    {if $p_a != 1}<a href='user_questions.php?s_a={$s_a}&v_a={$v_a}&p_a={math equation="p-1" p=$p_a}&t=1'>&#171; {lang_print id=182}</a>{else}&#171; {lang_print id=182}{/if}
    &nbsp;|&nbsp;&nbsp;
    {if $p_start_a == $p_end_a}
      <b>{lang_sprintf id=184 1=$p_start_a 2=$total_answers}</b>
    {else}
      <b>{lang_sprintf id=185 1=$p_start_a 2=$p_end_a 3=$total_answers}</b>
    {/if}
    &nbsp;&nbsp;|&nbsp;
    {if $p_a != $maxpage_a}<a href='user_questions.php?s_a={$s_a}&v_a={$v_a}&p_a={math equation="p+1" p=$p_a}&t=1'>{lang_print id=183} &#187;</a>{else}{lang_print id=183} &#187;{/if}
    </div>
  {/if}


  {* LOOP THROUGH FIRST ANSWERS *}
  {section name=answer_loop loop=$answers}

    <div class='qa_question' style='{cycle name='rightspacer' values="margin-right: 10px;,"}'>
      <table cellpadding='0' cellspacing='0' width='100%'>
      <tr>
      <td class='qa_question_main'>
        {if $answers[answer_loop].question_time > 0}
	  {assign var="question_time" value=$datetime->time_since($answers[answer_loop].question_time)}
	  {capture assign='updateddate'}{lang_sprintf id=$question_time[0] 1=$question_time[1]}{/capture}
          <div class='qa_question_date'>{lang_sprintf id=27003140 1=$updateddate}</div>
        {/if}
        <div class='qa_question_title'><a href='{$url->url_create('question', '', $answers[answer_loop].question_author->user_info.user_username, $answers[answer_loop].question_id)}'>{$answers[answer_loop].question_title|truncate:96:"...":true}</a></div>
        <div style='margin-top: 10px;'>{$answers[answer_loop].question_text|truncate:175:"...":true}</div>
      </td>
      </tr>
	  <tr>
	  <td class='qa_question_info'>
	  {capture assign='subcat_string_name'}{lang_print id=$answers[answer_loop].subcat_name_langid}{/capture}
	  {capture assign='subcat_name'}<a href='{$url->url_create('question_cat', '', $answers[answer_loop].subcat_id,$subcat_string_name)}'>{$subcat_string_name}</a>{/capture}
	{capture assign='question_leader'}<a href='{$url->url_create("profile", $answers[answer_loop].question_author->user_info.user_username)}'>{$answers[answer_loop].question_author->user_info.user_displayname}</a>{/capture}
	  {lang_sprintf id=27003175 1=$subcat_name} - {lang_sprintf id=27003401 1=$question_leader} - {lang_sprintf id=27003174 1=$answers[answer_loop].question_num_answers} - {$answers[answer_loop].question_state|qa_state_name}
	  </td>
	  </tr>
	  <tr>
	  <td class='qa_question_answer'>
        {if $answers[answer_loop].question_user_answer.answer_time > 0}
	  {assign var="answer_time" value=$datetime->time_since($answers[answer_loop].question_user_answer.answer_time)}
	  {capture assign='updateddate'}{lang_sprintf id=$answer_time[0] 1=$answer_time[1]}{/capture}
          <div class='qa_question_date'>{lang_sprintf id=27003140 1=$updateddate}</div>
        {/if}
        <div style='margin-top: 10px;margin-bottom: 4px;'>{$answers[answer_loop].question_user_answer.answer_text|truncate:175:"...":true}</div>
		{if $answers[answer_loop].question_state == $smarty.const.QA_STATE_RESOLVED}
			{if $answers[answer_loop].question_best_answer_id == $answers[answer_loop].question_user_answer.answer_id}
				{if $answers[answer_loop].question_best_answer_selected == 1}
				{lang_print id=27003500} 	
				{assign var='best_answer_rating' value=$answers[answer_loop].question_best_answer_rating}
				{else}
				{lang_print id=27003501} 	
				{assign var='best_answer_rating' value=`$answers[answer_loop].question_user_answer.answer_rating_value+0.25`}				
				{/if}
				{assign var='best_answer_rating_half' value=`$best_answer_rating+0.5`}	
				{section name=rating start=1 loop=$setting.setting_qa_max_rating+1}
				{if $smarty.section.rating.index <= $best_answer_rating}
				<img src = "./images/icons/qa_rating_star2.png" class='qa_star' />
				{else}
					{if $smarty.section.rating.index <= $best_answer_rating_half}
					<img src = "./images/icons/qa_rating_star2_half.png" class='qa_star' />
					{else}
					<img src = "./images/icons/qa_rating_star1.png" class='qa_star' />
					{/if}
				{/if}
				{/section}
			{/if}
		{/if}
      </td>
      </tr>
      </table>
    </div>
    {cycle values=",<div name='bottomspacer' style='clear: both; height: 10px;'></div>"}
    
  {/section}

  {* DISPLAY PAGINATION MENU IF APPLICABLE *}
  {if $maxpage_a > 1}
    <div class='question_pages_bottom'>
    {if $p_a != 1}<a href='user_questions.php?s_a={$s_a}&v_a={$v_a}&p_a={math equation="p-1" p=$p_a}&t=1'>&#171; {lang_print id=182}</a>{else}&#171; {lang_print id=182}{/if}
    &nbsp;|&nbsp;&nbsp;
    {if $p_start_a == $p_end_a}
      <b>{lang_sprintf id=184 1=$p_start_a 2=$total_answers}</b>
    {else}
      <b>{lang_sprintf id=185 1=$p_start_a 2=$p_end_a 3=$total_answers}</b>
    {/if}
    &nbsp;&nbsp;|&nbsp;
    {if $p_a != $maxpage_a}<a href='user_questions.php?s_a={$s_a}&v_a={$v_a}&p_a={math equation="p+1" p=$p_a}&t=1'>{lang_print id=183} &#187;</a>{else}{lang_print id=183} &#187;{/if}
    </div>
  {/if}

  <div style='clear: both; height: 0px;'></div>
 </div>
  
</div>
</div>

{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>
{literal}
<script type='text/javascript'>
<!--
window.addEvent('domready', function(){	
	var questionSlide = new Fx.Slide('qa_div_q');
	var answerSlide = new Fx.Slide('qa_div_a');
	
	{/literal}
	{if $t == 0}
	answerSlide.hide();
	$('qa_tab_q').addClass('qa_tab_selected');
	{else}
	questionSlide.hide();
	$('qa_tab_a').addClass('qa_tab_selected');
	{/if}
	{literal}

	$('qa_tab_q_a').addEvent('click', function(e){
		answerSlide.hide();
		questionSlide.show();
		$('qa_tab_a').removeClass('qa_tab_selected');
		$('qa_tab_q').addClass('qa_tab_selected');
	});
	$('qa_tab_a_a').addEvent('click', function(e){
		questionSlide.hide();
		answerSlide.show();
		$('qa_tab_q').removeClass('qa_tab_selected');
		$('qa_tab_a').addClass('qa_tab_selected');
	});
});
//-->
</script>
{/literal}


{/if}

{include file='footer.tpl'}