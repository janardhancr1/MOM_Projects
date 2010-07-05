{include file='header.tpl'}
<div style='float: left; width: 685px; padding: 0px 0px 5px 5px;'>
{*<p class='qa_breadcrumb'><a href='browse_questions.php'>Home</a> > <a href='browse_questions.php?qacat_id={$question->cat_id}'>{lang_print id=$cat_title}</a> > <a href='browse_questions.php?qacat_id={$question->subcat_id}'>{lang_print id=$subcat_title}</a></p>*}

  {* ERROR *}
  {if $error > 0}
    <br>
    <table cellpadding='0' cellspacing='0' align='center'>
      <tr>
        <td class='result'>
          <img src='./images/icons/bulb16.gif' border='0' class='icon' />
          {lang_print id=27003406}
        </td>
      </tr>
    </table>
  {/if}


  <div class='qa_question_wrapper'>
  	<div class='qa_answer_profile'>
	  <a href='{$url->url_create("profile", $question_owner->user_info.user_username)}'>
		<img src='{$question_owner->user_photo("./images/nophoto.gif", TRUE)}' border='0' width='60' height='60' />
		<br/>{$question_owner->user_info.user_displayname|truncate:18:"...":true}
		
	  </a>
	</div>
	<div class='qa_question_top'>
	{assign var='action_date' value=$datetime->time_since($question->time)}
	<div class='qa_question_date'>{lang_sprintf id=$action_date[0] 1=$action_date[1]}</div>
	<p class='qa_q_state'>{lang_print id=$question->state_lang_id}</p>
	<h1 class='qa_question_title'>{$question->title}</h1>
	<div class='qa_text'>{$question->text}</div>
	</div>
	<div class='qa_question_bottom'>
	<a href="javascript:TB_show('{lang_print id=27003416}', 'user_report.php?return_url={$url->url_current()}&TB_iframe=true&height=300&width=450', '', './images/trans.gif');">{lang_print id=27003416}</a>
	</div>
  </div>


<table cellpadding='0' cellspacing='0' width='100%' style='margin-top: 10px;'>
<tr>
<td style='width: 200px; vertical-align: top;'>



  <div class='qa_categories_box'>
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
	{if  $question->state == $smarty.const.QA_STATE_RESOLVED}
  <p class='qa_h2_best_answer'>{lang_print id=27003470}</p> - {if $question->best_answer_selected == 1}{lang_print id=27003472}{else}{lang_print id=27003471}{/if}
  <div class='qa_best_answer_wrapper'>
  	<div class='qa_answer_profile'>
	  <a href='{$url->url_create("profile", $best_answer.author->user_info.user_username)}'>
		<img src='{$best_answer.author->user_photo("./images/nophoto.gif", TRUE)}' border='0' width='60' height='60' />
		<br/>{$best_answer.author->user_info.user_displayname|truncate:18:"...":true}
		
	  </a>
	</div>
	<div class='qa_best_answer_top'>
	{assign var='answer_submitted' value=$datetime->time_since($best_answer.answer_time)}
	{capture assign="submitted"}{lang_sprintf id=$answer_submitted[0] 1=$answer_submitted[1]}{/capture}
	<div class='qa_question_date'>{lang_sprintf id=27003404 1=$submitted}</div>
	{$best_answer.answer_text}
	<div class='qa_askers_rating'>
	{if $question->best_answer_selected == 1}
	{lang_print id=27003473}
	{else}
	{lang_print id=27003474}
	{/if}
	{section name=rating start=1 loop=$setting.setting_qa_max_rating+1}
	{if $smarty.section.rating.index <= $question->best_answer_rating}
	<img src = "./images/icons/qa_rating_star2.png" class='qa_star' />
	{else}
	<img src = "./images/icons/qa_rating_star1.png" class='qa_star' />
	{/if}
	{/section}
	</div>
	{if $question->best_answer_selected == 1 && $question->best_answer_comment|strlen > 0}
	<div class='qa_askers_comment'>
	<span>{lang_print id=27003475}</span> {$question->best_answer_comment}
	</div>
	{/if}
	</div>
	<div class='qa_best_answer_bottom'>
	<a href="javascript:TB_show('{lang_print id=27003416}', 'user_report.php?return_url={$url->url_current()}&TB_iframe=true&height=300&width=450', '', './images/trans.gif');">{lang_print id=27003416}</a>
	</div>
  </div>
	

	{/if}
	
	{if  $question->state == $smarty.const.QA_STATE_RESOLVED}
  <p class='qa_h2_answer'>{lang_print id=27003447} ({$answers|@count})</p>
	{else}
  <p class='qa_h2_answer'>{lang_print id=27003407} ({$answers|@count})</p>
  	{/if}
	{if $user_answer_id == 0 && $question_owner->user_info.user_id != $user->user_info.user_id && $user->user_exists}
	{if $question->state == $smarty.const.QA_STATE_NEW || $question->state == $smarty.const.QA_STATE_SELECTING }
	<div class='qa_button' id='qa_answer_button'>{lang_print id=27003411}</div><div class='qa_button_r' id='qa_answer_button_r'>&nbsp;</div>
	<div id='qa_answer_form' >
	<p>{lang_print id=27003410}</p>
	<form action="question.php" method="post">
	<input type="hidden" name="task" value="submit_answer" />
	<input type="hidden" name="qid" value="{$question->q_id}" />
	<input type="hidden" name="user" value="{$question->user_username}" />
	<textarea name='answer_text' id='qa_answer_text' ></textarea>
	<input type="submit" class='button' value='{lang_print id=27003412}' /> <input type='button' class='button' id='qa_answer_cancel' value='{lang_print id=27003413}' />
	</form>
	</div>
	{/if}
	{/if}

  {if $question_owner->user_info.user_id == $user->user_info.user_id && $question->state == $smarty.const.QA_STATE_SELECTING}
  {assign var='time_remaining' value=$question->time|time_until:$question->ttl}
  {capture assign="ttl_end"}{lang_sprintf id=$time_remaining[0] 1=$time_remaining[1]}{/capture}
  {lang_sprintf id=27003424 1=$ttl_end}
  {/if}
  {if $answers|@count == 0 && $question_owner->user_info.user_id != $user->user_info.user_id && $user->user_exists && ($question->state == $smarty.const.QA_STATE_NEW || $question->state == $smarty.const.QA_STATE_SELECTING)}
  <br/><p><strong>{lang_print id=27003408}</strong></p>
  {else}
  {section name=answer_loop loop=$answers}
  <div class='qa_answer'><a name='a_{$answers[answer_loop].answer_id}'></a>
   	<div class='qa_answer_profile'>
   		<a href='{$url->url_create("profile", $answers[answer_loop].author->user_info.user_username)}'>
            <img src='{$answers[answer_loop].author->user_photo("./images/nophoto.gif", TRUE)}' border='0' width='60' height='60' />			
          </a><br/>
   		<a href='{$url->url_create("profile", $answers[answer_loop].author->user_info.user_username)}'>
            {$answers[answer_loop].author->user_info.user_displayname}
          </a>
	</div>
   	<div class='qa_answer_content'>
	{assign var='answer_submitted' value=$datetime->time_since($answers[answer_loop].answer_time)}
	{capture assign="submitted"}{lang_sprintf id=$answer_submitted[0] 1=$answer_submitted[1]}{/capture}
	<div class='qa_question_date'>{lang_sprintf id=27003404 1=$submitted}</div>
	{$answers[answer_loop].answer_text}
	</div>
	{if  $question_owner->user_info.user_id == $user->user_info.user_id && ($question->state == $smarty.const.QA_STATE_SELECTING || $question->state == $smarty.const.QA_STATE_UNDECIDED || $question->state == $smarty.const.QA_STATE_TIEBREAKER)}
	<div class='qa_button qa_best_answer_button' xqa_aid='{$answers[answer_loop].answer_id}'>{lang_print id=27003423}</div><div class='qa_button_r'>&nbsp;</div>
	{/if}
	{if  $answers[answer_loop].author->user_info.user_id == $user->user_info.user_id && ($question->state == $smarty.const.QA_STATE_NEW || $question->state == $smarty.const.QA_STATE_SELECTING)}
	<div class='qa_button' id='qa_edit_answer'>{lang_print id=27003476}</div><div class='qa_button_r'>&nbsp;</div>
	{/if}
  </div>
	{if  $answers[answer_loop].author->user_info.user_id == $user->user_info.user_id && ($question->state == $smarty.const.QA_STATE_NEW || $question->state == $smarty.const.QA_STATE_SELECTING)}
	<div id='qa_edit_answer_form'>
	<form action="question.php" method="post">
	<input type="hidden" name="task" value="edit_answer" />
	<input type="hidden" name="qid" value="{$question->q_id}" />
	<input type="hidden" name="aid" value="{$answers[answer_loop].answer_id}" />
	<input type="hidden" name="user" value="{$question->user_username}" />
	<textarea name='answer_text' id='qa_edit_answer_text' >{$answers[answer_loop].answer_text|qa_br2nl|qa_nbsp2space}</textarea>
	<input type="submit" class='button' value='{lang_print id=27003477}' /> <input type='button' class='button' id='qa_edit_answer_cancel' value='{lang_print id=27003413}' />
	</form>	
	</div>
	{/if}
  	<div style='float:right'>
	<a href="javascript:TB_show('{lang_print id=27003416}', 'user_report.php?return_url={$url->url_current()}&TB_iframe=true&height=300&width=450', '', './images/trans.gif');">{lang_print id=27003416}</a>
	</div>
	<div class='qa_question_answer_bottom_bar'>
	<div id='answer_{$answers[answer_loop].answer_id}_rate' class='qa_rate' xqa_rating='{$answers[answer_loop].answer_rating_value}' xqa_id='{$answers[answer_loop].answer_id}' xqa_type='answer' xqa_rating_allowed='{$answers[answer_loop].rating_allowed}' xqa_user_id='{$answers[answer_loop].author->user_info.user_id}' xqa_has_rated='{$answers[answer_loop].has_rated}'></div> {lang_sprintf id=27003422 1=$answers[answer_loop].answer_rating_value 2=$setting.setting_qa_max_rating 3=$answers[answer_loop].answer_rating_raters_num}
	</div>
  {/section}
  {/if}
</td>
</tr>
</table>


{* JavaScript related to answering of question *}
{literal}
<script type='text/javascript'>
<!--
window.addEvent('domready', function(){
{/literal}
{if $user_answer_id == 0  && $question_owner->user_info.user_id != $user->user_info.user_id && $user->user_exists && ($question->state == $smarty.const.QA_STATE_NEW || $question->state == $smarty.const.QA_STATE_SELECTING)}
{literal}
	textarea_autogrow('qa_answer_text');
	
	var answerSlide = new Fx.Slide('qa_answer_form').chain(function() {
		$('qa_answer_form').getParent().setStyle('height','auto');	
	});
	
	answerSlide.hide();
	$('qa_answer_button').addEvent('click', function(e){
		e.stop();
		$('qa_answer_form').getParent().setStyle('clear','both');	
		answerSlide.slideIn();
		$('qa_answer_button').setProperty('disabled','disabled');
	});
	$('qa_answer_cancel').addEvent('click', function(e){
		e.stop();
		answerSlide.slideOut();
		$('qa_answer_button').removeProperty('disabled');
	});

{/literal}
	{/if}
{literal}

{/literal}
	{if  $user_answer_id > 0 && ($question->state == $smarty.const.QA_STATE_NEW || $question->state == $smarty.const.QA_STATE_SELECTING)}
{literal}
	textarea_autogrow('qa_edit_answer_text');

	var editAnswerSlideCurr = new Fx.Slide($('qa_edit_answer').getParent()).chain(function() {
		$('qa_edit_answer').getParent().getParent().setStyle('height','auto');	
	});

	var editAnswerSlide = new Fx.Slide('qa_edit_answer_form').chain(function() {
		$('qa_edit_answer_form').getParent().setStyle('height','auto');	
	});
	editAnswerSlide.hide();
	$('qa_edit_answer').addEvent('click', function(e){
		e.stop();
		$('qa_edit_answer').getParent().getParent().setStyle('clear','both');	
		editAnswerSlide.slideIn();
		editAnswerSlideCurr.slideOut();
		$('qa_edit_answer').setProperty('disabled','disabled');
	});
	$('qa_edit_answer_cancel').addEvent('click', function(e){
		e.stop();
		editAnswerSlide.slideOut();
		editAnswerSlideCurr.slideIn();
		$('qa_edit_answer').removeProperty('disabled');
	});
{/literal}
	{/if}
{literal}
	
});



//-->
</script>
{/literal}

{* JavaScript related to rating of answers *}

<a href='javascript:void(0)' id='qa_rating_star_a' class='qaStars' style='display:none; border: none;' title='{if !$user->user_exists}{lang_print id=27003419}{/if}'><img border="0" src='./images/icons/qa_rating_star1.png'/></a>

<div id='qa_best_answer_form' class='qa_best_answer_form' style='display:none;'>
<form action="question.php" method="post">
<input type="hidden" name="task" value="submit_best_answer" />
<input type="hidden" name="qid" value="{$question->q_id}" />
<input type="hidden" name="user" value="{$question->user_username}" />
<input type="hidden" name="aid" class='qa_aid' />
<input type="hidden" name="rating" class='qa_rating' value='0'/>
<table>
<tr><td>{lang_print id=27003426}</td><td>
{section name=rating start=1 loop=$setting.setting_qa_max_rating+1}
<img src = "./images/icons/qa_rating_star1.png" class='qa_star' xqa_rating_num='{$smarty.section.rating.index}'/>
{/section}
</td></tr>
<tr><td valign="top" align="right">{lang_print id=27003427}</td><td><textarea name='comment_text' class='qa_best_answer_comment' ></textarea></td></tr>
<tr><td></td><td><input type="submit" class='button' value='{lang_print id=27003428}' />&nbsp;&nbsp;<input type='button' class='button qa_best_answer_cancel' value='{lang_print id=27003413}' /></td></tr>
</table>
</form>
</div>
</div>

{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>
{literal}
<script type='text/javascript'>
<!--
preload_full = new Image();
preload_full.src = "./images/icons/qa_rating_star2.png";
preload_partial = new Image();
preload_partial.src = "./images/icons/qa_rating_star2_half.png";
preload_empty = new Image();
preload_empty.src = "./images/icons/qa_rating_star1.png";

qa_max_rating =  {/literal}{$setting.setting_qa_max_rating}{literal};

var qaTips;

window.addEvent('domready', function(){	
	$$('div.qa_rate').each(function(el) {	
		qaFillStars(el);
		var rating = el.get('xqa_rating');
		qaSetStars(el,rating);
	});

	{/literal}{if  $question_owner->user_info.user_id == $user->user_info.user_id && ($question->state == $smarty.const.QA_STATE_SELECTING || $question->state == $smarty.const.QA_STATE_UNDECIDED || $question->state == $smarty.const.QA_STATE_TIEBREAKER)}{literal}

	$$('div.qa_best_answer_button').each(function(el) {		
		var aid = el.get('xqa_aid');
		el.addEvent('click', function(e) {
			e.stop();
			$$('div.qa_best_answer_form_open').each(function(el2) {	
				el2.slide('out').destroy();
			});
			var formEl = $('qa_best_answer_form').clone();
			formEl.getElement('input.qa_aid').setProperty('value', el.get('xqa_aid'))
			formEl.getElement('input.qa_rating').setProperty('value', 0)
			formEl.setStyle('display','');
			formEl.addClass('qa_best_answer_form_open');
			formEl.inject($(el).getParent());
			formEl.slide('hide');
			formEl.getParent().setStyle('clear','both');	
			formEl.slide('in');
			
			$$('div.qa_best_answer_form_open img.qa_star').each(function(imgEl) {	
				imgEl.addEvent('mouseover', function(e) {
					e.stop();
					qaSetImgStars(imgEl.getParent(), imgEl.get('xqa_rating_num'));
				});
				imgEl.addEvent('mouseout', function(e) {
					e.stop();
					qaSetImgStars(imgEl.getParent(), formEl.getElement('input.qa_rating').getProperty('value'));
				});
				imgEl.addEvent('click', function(e) {
					e.stop();
					formEl.getElement('input.qa_rating').setProperty('value', imgEl.get('xqa_rating_num'))
				});		
			});

			formEl.getElement('input.qa_best_answer_cancel').addEvent('click', function(e) {
				e.stop();
				$$('div.qa_best_answer_form_open').each(function(el2) {	
					el2.slide('out').destroy();
				});	
			});

		});
	});
	{/literal}{/if}{literal}

	qaTips = new Tips($$('.qaStars'));

});


function qaFillStars(el) {
	el.set('html','');
	var rating_allowed = el.get('xqa_rating_allowed');
	var has_rated = el.get('xqa_has_rated');
	var answer_user_id = el.get('xqa_user_id');
	var star_num = 1;
	for (i=0;i<qa_max_rating;i++) {
		var starEl = $('qa_rating_star_a').clone();
		starEl.setStyle('display','');
		{/literal}{if $question->state == $smarty.const.QA_STATE_RESOLVED}{literal}
		starEl.set('title',"{/literal}{lang_print id=27003425}{literal}");
		{/literal}{else}{literal}
		if (answer_user_id == '{/literal}{$user->user_info.user_id}{literal}') {
			starEl.set('title',"{/literal}{lang_print id=27003420}{literal}");
		} else if (has_rated == 1) {
			starEl.set('title',"{/literal}{lang_print id=27003421}{literal}");
		};
		{/literal}{/if}{literal}
		var imgEl = starEl.getElement('img');
		imgEl.set('xqa_rating_num', star_num++);
		imgEl.set('width', 16);
		imgEl.set('height', 16);
		{/literal}{if $question->state != $smarty.const.QA_STATE_RESOLVED}{literal}
		if (rating_allowed == 1) {
			imgEl.addEvent('mouseover', function(e) {
				e.stop();
				if (el.get('xqa_rating_allowed') == 1) {
					qaSetStars(el, this.get('xqa_rating_num'));
				}
			});
			imgEl.addEvent('click', function(e) {
				e.stop();
				if (el.get('xqa_rating_allowed') == 1) {
					qaRate(el, this.get('xqa_rating_num'));
				}
			});		
			imgEl.addEvent('mouseout', function(e) {
				e.stop();
				var rating = el.get('xqa_rating');
				qaSetStars(el, rating);
			});
		}
		{/literal}{/if}{literal}
		starEl.inject($(el));
	}
}

function qaSetStars(el,rating) {
	var fulls = Math.floor(parseFloat(rating)+0.25);
	var partials = Math.floor(parseFloat(rating)+0.75) - fulls;
	el.getElements('a').each(function(aEl) {
		imgEl=aEl.getElement('img');
		var rating_num = imgEl.get('xqa_rating_num');
		if (rating_num <= fulls) {
			imgEl.set('src', preload_full.src);
		} else if (rating_num <= fulls + partials) {
			imgEl.set('src', preload_partial.src);
		} else {
			imgEl.set('src', preload_empty.src);
		} 
	});
}

function qaSetImgStars(el,rating) {
	var fulls = Math.floor(parseFloat(rating)+0.25);
	var partials = Math.floor(parseFloat(rating)+0.75) - fulls;
	el.getElements('img').each(function(imgEl) {
		var rating_num = imgEl.get('xqa_rating_num');
		if (rating_num <= fulls) {
			imgEl.set('src', preload_full.src);
		} else if (rating_num <= fulls + partials) {
			imgEl.set('src', preload_partial.src);
		} else {
			imgEl.set('src', preload_empty.src);
		} 
	});
}

function qaRate(el, qa_rating) {
	qa_id = el.get('xqa_id');
	qa_type = el.get('xqa_type');
	var jsonRequest = new Request.JSON({url: "{/literal}{$url->url_base}{literal}/qa_rating.php", onSuccess: function(data){
    	if (data.error=='') {
	    	if (data.qa_reload=='1') {
				window.location.reload();
			} else {
			if (data.qa_rating_allowed == 1) {
				el.set('xqa_rating',data.qa_rating_value);	
				el.set('xqa_rating_allowed',0);	
				el.set('xqa_has_rated',1);	
				qaFillStars(el);
				qaSetStars(el,data.qa_rating_value);
				qaTips = new Tips($$('.qaStars'));
			}
			}
		} else {
			alert(data.error);
		}
	}}).get({'qa_id': qa_id, 'qa_type': qa_type, 'qa_rating': qa_rating, 'task': 'rate'});
}
//-->
</script>
{/literal}


{include file='footer.tpl'}