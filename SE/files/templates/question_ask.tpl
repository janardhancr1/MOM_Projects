{include file='header.tpl'}

{*<p class='qa_breadcrumb'><a href='browse_questions.php'>Home</a> > <a href='browse_questions.php?qacat_id={$question->cat_id}'>{lang_print id=$cat_title}</a> > <a href='browse_questions.php?qacat_id={$question->subcat_id}'>{lang_print id=$subcat_title}</a></p>*}


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
	{foreach from=$qacats item=qacat}
	<option value='{$qacat.cat_id}'>{lang_print id=$qacat.cat_title}</option>
	{/foreach} 
	</select>  &nbsp;&nbsp;{lang_print id=27003436}&nbsp;<select name='question_subcatid' id='subcat_select'></select><br/>
	<input type="submit" class='button' value='{lang_print id=27003431}'  id='qa_submit'/> 
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
{foreach from=$qacats item=qacat name=cats}
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
	
	$('cat_select').addEvent('change', function(e){
		updateSubcats();
	});
	
	$('qa_title_text').addEvent('keyup', function(e){
		updateTitleCnt();
	});

	updateSubcats();
	updateTitleCnt();

    new FormCheck('qa_ask', {
            display : {
                titlesInsteadNames : false,
				indicateErrors: 2
            }
		});
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




{include file='footer.tpl'}