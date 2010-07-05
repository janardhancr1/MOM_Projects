{include file='header.tpl'}

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'><img src='./images/icons/ans_ans48.gif' border='0' class='icon_big'>Momburbia {lang_print id=27003123}
<div class="page_header_xxsmall">Ask, Answer and Explore.  Questions and Answers on everything relating to being a mom.</div>
</div>
<div style='clear: both; height: 10px;'></div>
	<table width='100%' cellspacing='5'>
	</tr>
		<td align='center' colspan='2'>
			<form action='browse_questions.php' method='post'>
			<input type='text' name='qsearch' class='qsearch' value='What are you looking for?' style='width:250px' onfocus="if(this.value == 'What are you looking for?') this.value='';" onblur="if(this.value.length == 0) this.value='What are you looking for?';">
			&nbsp;<input type='submit' class='btnStyle' value='Search Answers'>
			&nbsp;&nbsp;&nbsp;&nbsp;
			</form>
		</td>
	</tr>
	<tr>
		<td colspan='2'>&nbsp;</td>	
	</td>
	<tr>
		<td rowspan='2' valign='top'>
			<div style='float:left;padding: 10px; background: #F0F0F0 ; width:350px;height:360px'>
			<center>
				<div class="qa_title">Ask</div>
			</center>
			<form action="question_ask.php" method="post" id='qa_ask'>
			<input type="hidden" name="task" value="submit_question" />
			<input type='text' name='question_title' id='qa_title_text' maxlength='120' value='What Would You Like to Know?' class="validate['required','length[10,-1]'] text-input" onfocus="if(this.value == 'What Would You Like to Know?') this.value='';" onblur="if(this.value.length == 0) this.value='What Would You Like to Know?';"/>
			<p>{lang_print id=27003433}</p>
			<textarea name='question_text' id='qa_question_text' ></textarea>
			<p>Tags - help moms find your question, i.e.</p>
			<input type='text' name='question_tags' id='qa_title_tag' maxlength='120'/>
			<p style='margin-bottom:5px'>Choose question category</p>
			{lang_print id=27003435}&nbsp;<select name='question_catid' id='cat_select' class="validate['required']">
			<option value='-1'>{lang_print id=27003437}</option>
			{foreach from=$qacats_ask item=qacat}
			<option value='{$qacat.cat_id}'>{lang_print id=$qacat.cat_title}</option>
			{/foreach} 
			</select>  &nbsp;&nbsp;
			<br />{lang_print id=27003436}&nbsp;<select name='question_subcatid' id='subcat_select'></select><br/>
			<br />
			<center>
			<input type="submit" class="btnStyle" value='Ask Question'  id='qa_submit'/>
			</center> 
			</form>
			</div>
		</td>
		<td>
			<div class="explore">
			<table cellspacing='0' cellpadding='0' width="100%">
			<tr>
			<td align="center">
				<div class="qa_title">Answer</div>
			</td>
			</tr>
			<tr>
				<td align="center">
				<div class='page_header_xsmall'>Share your knowledge with other moms in the community</div>
				</td>
			</tr>
			<tr>
				<td align="center">
				&nbsp;
				</td>
			</tr>
			<tr>
				<td align="center">
				<input type="button" class="btnStyle" value="Browse Open Questions" onclick="window.location.href='browse_questions.php?qtype=open';">
				</td>
			</tr>
			<tr>
				<td align="center">
				&nbsp;
				</td>
			</tr>
			</table>
			</div>
		</td>
	</tr>
	<tr>
		<td>
		<div class="explore">
		<table cellspacing='0' cellpadding='0' width="100%">
		<tr>
		<td align="center">
			<div class="qa_title">Explore</div>
		</td>
		</tr>
		<tr>
			<td align="center">
			<div class='page_header_xsmall'>Find answers to resolved questions from moms in the community</div>
			</td>
		</tr>
		<tr>
			<td align="center">
			&nbsp;
			</td>
		</tr>
		<tr>
			<td align="center">
			<input type="button" class="btnStyle" value="Browse Resolved Questions" onclick="window.location.href='browse_questions.php?qtype=solved';">
			</td>
		</tr>
		<tr>
				<td align="center">
				&nbsp;
				</td>
			</tr>
		</table>
		</div>
		</td>
	</tr>
	</table>	
<br />
<div class='qa_page_header' style='float:left;'>
Broswe Categories -&nbsp;
</div>
<div class='qa_page_header_small'>
click on links below to help your search
</div>

{if $user->level_info.level_qa_allow}
<div id='qa_question_form' >
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
	
	/*$('qa_ask_link').addEvent('click', function(e){
		e.stop();
		$('qa_question_form').getParent().setStyle('clear','both');	
		questionSlide.slideIn();
	});

	$('qa_ask_cancel').addEvent('click', function(e){
		e.stop();
		questionSlide.slideOut();
	});*/

	$('cat_select').addEvent('change', function(e){
		updateSubcats();
	});
	
	$('qa_title_text').addEvent('keyup', function(e){
		updateTitleCnt();
	});

	updateSubcats();
	//updateTitleCnt();

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
<td style='width: 100%; vertical-align: top;'>
  <div style='margin-top: 10px; padding: 5px; background: #F2F2F2; border: 1px solid #BBBBBB; margin: 0px 0px 10px 0px; font-weight: bold;'>
  	<table width='100%'>
  	<tr>
  	<td valign='top'>
	{section name=cat_loop loop=$qacats}
	{capture assign='cat_string_name'}{lang_print id=$qacats[cat_loop].cat_title}{/capture}
	<p class='{$qacats[cat_loop].cat_class}'><a href='{$url->url_create("question_cat", $smarty.const.NULL, $qacats[cat_loop].cat_id,$cat_string_name)}'>{$cat_string_name}</a></p>
	{cycle values=",,,,,,</td><td valign='top'>"}
	{/section}
	</td>
	</tr>
	</table>	
  </div>

	{if $qa_ad_id > 0}
	{$ads->ads_display($qa_ad_id)}
	{/if}
</td>
</tr>
</tr>
<td style='vertical-align: top; padding-left: 10px;'>

 </td>
</tr>
</table>

<div class='qa_page_header'>Share what you know. Answer open Question.</div>
<table cellpadding='0' cellspacing='0' style='width: 100%;margin-top: 10px;'>
<tr style='margin-top:10px'>
<td nowrap='nowrap' style='background-color:#FFFFFF; padding-right:5px;border-bottom: 3px solid #D60077;'>
  <div class='top_menu_link_container'>
  	<div class='top_menu_link_start'></div>
    <div class='top_menu_link'>
      <a href='javascript:void(0);' class='top_menu_item' onMouseDown="loadTab('recent')" onMouseUp="this.blur()">Recent</a>
    </div>
    <div class='top_menu_link_end'></div>
  </div>
  
  <div class='top_menu_link_container'>
  	<div class='top_menu_link_start'></div>
    <div class='top_menu_link'>
    	<a href='javascript:void(0);' class='top_menu_item' onMouseDown="loadTab('popular')" onMouseUp="this.blur()">Popular</a>
    </div>
    <div class='top_menu_link_end'></div>
  </div>
	</td>
	</tr>
</table>
<div id='recent' style='display: block;'>
   {* NO QUESTIONS AT ALL *}
  {if $recentquestions|@count == 0}
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
  {section name=question_loop loop=$recentquestions}
  <div style='padding: 5px;'>
    <table cellpadding='0' cellspacing='0'>
      <tr>
        <td>
          <a href='{$url->url_create("profile", $recentquestions[question_loop].question_author->user_info.user_username)}'>
            <img src='{$recentquestions[question_loop].question_author->user_photo("./images/nophoto.gif", TRUE)}' border='0' width='60' height='60' />
          </a>
        </td>
        <td style='vertical-align: top; padding-left: 10px;'>
          <div style='font-weight: bold; font-size: 10pt;'>
            <a href='{$url->url_create("question", $smarty.const.NULL, $recentquestions[question_loop].question_author->user_info.user_username, $recentquestions[question_loop].question_id)}'>
              {$recentquestions[question_loop].question_title}
            </a>
          </div>
          <div style='color: #777777; font-size: 7pt; margin-bottom: 5px;'>
          	<img src='./images/qa_li.gif' border='0' alt='' />
            {assign var='question_dateupdated' value=$datetime->time_since($recentquestions[question_loop].question_time)}
            {capture assign="updated"}{lang_sprintf id=$question_dateupdated[0] 1=$question_dateupdated[1]}{/capture}
            {capture assign='question_leader'}<a href='{$url->url_create("profile", $recentquestions[question_loop].question_author->user_info.user_username)}'>{$recentquestions[question_loop].question_author->user_info.user_displayname}</a>{/capture}
	  		{capture assign='subcat_string_name'}{lang_print id=$recentquestions[question_loop].subcat_name_langid}{/capture}
            {capture assign='question_cat'}<a href='{$url->url_create("question_cat", $smarty.const.NULL, $recentquestions[question_loop].question_subcat_id,$subcat_string_name)}'>{$subcat_string_name}</a>{/capture}
            {lang_sprintf id=27003400 1=$question_cat} - {lang_sprintf id=27003401 1=$question_leader} - {if $recentquestions[question_loop].question_num_answers == 1}{lang_sprintf id=27003402 1=$recentquestions[question_loop].question_num_answers}{else}{lang_sprintf id=27003403 1=$recentquestions[question_loop].question_num_answers}{/if} - {lang_sprintf id=27003404 1=$updated} - {$recentquestions[question_loop].question_state|qa_state_name}
          </div>
        </td>
      </tr>
    </table>
  </div>
  {/section}
</div>
<div id='popular' style='display: none;'>
  {* NO QUESTIONS AT ALL *}
  {if $popularquestions|@count == 0}
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
  {section name=question_loop loop=$popularquestions}
  <div style='padding: 5px;'>
    <table cellpadding='0' cellspacing='0'>
      <tr>
        <td>
          <a href='{$url->url_create("profile", $popularquestions[question_loop].question_author->user_info.user_username)}'>
            <img src='{$popularquestions[question_loop].question_author->user_photo("./images/nophoto.gif", TRUE)}' border='0' width='60' height='60' />
          </a>
        </td>
        <td style='vertical-align: top; padding-left: 10px;'>
          <div style='font-weight: bold; font-size: 10pt;'>
            <a href='{$url->url_create("question", $smarty.const.NULL, $popularquestions[question_loop].question_author->user_info.user_username, $popularquestions[question_loop].question_id)}'>
              {$popularquestions[question_loop].question_title}
            </a>
          </div>
          <div style='color: #777777; font-size: 7pt; margin-bottom: 5px;'>
            <img src='./images/qa_li.gif' border='0' alt='' />
            {assign var='question_dateupdated' value=$datetime->time_since($popularquestions[question_loop].question_time)}
            {capture assign="updated"}{lang_sprintf id=$question_dateupdated[0] 1=$question_dateupdated[1]}{/capture}
            {capture assign='question_leader'}<a href='{$url->url_create("profile", $popularquestions[question_loop].question_author->user_info.user_username)}'>{$popularquestions[question_loop].question_author->user_info.user_displayname}</a>{/capture}
	  		{capture assign='subcat_string_name'}{lang_print id=$popularquestions[question_loop].subcat_name_langid}{/capture}
            {capture assign='question_cat'}<a href='{$url->url_create("question_cat", $smarty.const.NULL, $popularquestions[question_loop].question_subcat_id,$subcat_string_name)}'>{$subcat_string_name}</a>{/capture}
            {lang_sprintf id=27003400 1=$question_cat} - {lang_sprintf id=27003401 1=$question_leader} - {if $popularquestions[question_loop].question_num_answers == 1}{lang_sprintf id=27003402 1=$popularquestions[question_loop].question_num_answers}{else}{lang_sprintf id=27003403 1=$popularquestions[question_loop].question_num_answers}{/if} - {lang_sprintf id=27003404 1=$updated} - {$popularquestions[question_loop].question_state|qa_state_name}
          </div>
        </td>
      </tr>
    </table>
  </div>
  {/section}
</div>

</div>

{literal}
    <script type='text/javascript'>
    <!--
      var visible_tab = 'recent';
      function loadTab(tabId)
      {
      	$('recent').style.display = "none";
      	$('popular').style.display = "none";
      	
      	$(tabId).style.display = "block";
      }
    //-->
    </script>
    {/literal}


{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>

{include file='footer.tpl'}