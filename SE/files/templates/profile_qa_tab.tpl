
{* BEGIN QUESTIONS *}
{if $owner->level_info.level_qa_allow != 0 AND ($total_questions > 0 OR $total_answers > 0)}

<ul class='qa_tabs_ul'>
<li class='qa_tabs_li' id='qa_tab_q'><a href='javascript:void(0)' id='qa_tab_q_a'>{lang_print id=27003171} ({$total_questions})</a></li>
<li class='qa_tabs_li' id='qa_tab_a'><a href='javascript:void(0)' id='qa_tab_a_a'>{lang_print id=27003173} ({$total_answers})</a></li>
</ul>
<div class='qa_profile_content'>
<div  id='qa_div_q'>
  <div class='profile_headline'>
    {lang_print id=27003171} ({$total_questions})
  </div>

  {* LOOP THROUGH QUESTIONS *}
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
        <div class='qa_question_title'><a href='{$url->url_create('question', '', $questions[question_loop].question_author->user_info.user_username, $questions[question_loop].question_id)}'>{$questions[question_loop].question_title|truncate:48:"...":true}</a></div>
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
  <div style='clear: both; height: 0px;'></div>
</div>


<div  id='qa_div_a'>
  <div class='profile_headline'>
    {lang_print id=27003173} ({$total_answers})
  </div>

  {* LOOP THROUGH ANSWERS *}
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
        <div class='qa_question_title'><a href='{$url->url_create('question', '', $answers[answer_loop].question_author->user_info.user_username, $answers[answer_loop].question_id)}'>{$answers[answer_loop].question_title|truncate:48:"...":true}</a></div>
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
  <div style='clear: both; height: 0px;'></div>
 </div>
  
</div>

{literal}
<script type='text/javascript'>
<!--
window.addEvent('domready', function(){	
	var questionSlide = new Fx.Slide('qa_div_q');
	var answerSlide = new Fx.Slide('qa_div_a');
	
	answerSlide.hide();
	$('qa_tab_q').addClass('qa_tab_selected');

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