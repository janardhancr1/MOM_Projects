<?php /* Smarty version 2.6.14, created on 2010-05-31 17:29:08
         compiled from user_questions.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars_decode', 'user_questions.tpl', 46, false),array('modifier', 'truncate', 'user_questions.tpl', 176, false),array('modifier', 'qa_state_name', 'user_questions.tpl', 184, false),array('function', 'math', 'user_questions.tpl', 152, false),array('function', 'cycle', 'user_questions.tpl', 167, false),)), $this);
?><?php
SELanguage::_preload_multi(27003059,27003450,27003451,27003432,27003434,27003433,27003435,27003437,27003436,27003431,27003413,27003460,27003461,27003462,27003171,27003173,182,184,185,183,27003140,27003175,27003174,27003401,27003500,27003501);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='float: left; width: 685px; padding: 0px 0px 5px 5px;'>
<?php if ($this->_tpl_vars['user']->level_info['level_qa_allow']): ?>
<div class='qa_ask_new'><a href='javascript:void(0)' id='qa_ask_link'><img src='./images/qa_question_add.gif' border='0' class='button' /><?php echo SELanguage::_get(27003059); ?></a></div>
<?php endif; ?>
<div>
  <img src='./images/icons/qa_qa48.gif' border='0' class='icon_big' />
  <div class='page_header'><?php echo SELanguage::_get(27003450); ?></div>
  <?php echo SELanguage::_get(27003451); ?>
</div>

<?php if ($this->_tpl_vars['user']->level_info['level_qa_allow']): ?>
<div id='qa_question_form' >
<form action="question_ask.php" method="post" id='qa_ask'>
<input type="hidden" name="task" value="submit_question" />
<p><?php echo SELanguage::_get(27003432); ?></p>
<div id='qa_title_cnt'><?php echo SELanguage::_get(27003434); ?><span id='qa_title_cnt_num'></span></div>
<input type='text' name='question_title' id='qa_title_text' maxlength='120' class="validate['required','length[10,-1]'] text-input"/>
<p><?php echo SELanguage::_get(27003433); ?></p>
<textarea name='question_text' id='qa_question_text' ></textarea>
<p>Tags - help moms find your question, i.e.</p>
<input type='text' name='question_tags' id='qa_title_tag' maxlength='120'/>
<p>Choose question category</p>
<?php echo SELanguage::_get(27003435); ?>&nbsp;<select name='question_catid' id='cat_select' class="validate['required']">
<option value='-1'><?php echo SELanguage::_get(27003437); ?></option>
<?php $_from = $this->_tpl_vars['qacats_ask']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['qacat']):
?>
<option value='<?php echo $this->_tpl_vars['qacat']['cat_id']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['qacat']['cat_title']); ?></option>
<?php endforeach; endif; unset($_from); ?> 
</select>  &nbsp;&nbsp;<?php echo SELanguage::_get(27003436); ?>&nbsp;<select name='question_subcatid' id='subcat_select'></select><br/>
<br/>
<input type="submit" class='button' value='<?php echo SELanguage::_get(27003431); ?>'  id='qa_submit'/> <input type='button' class='button' id='qa_ask_cancel' value='<?php echo SELanguage::_get(27003413); ?>' />
</form>
</div>
<?php endif; 
 if ($this->_tpl_vars['user']->level_info['level_qa_allow']): ?>
<link media="screen" type="text/css" href="include/js/formcheck/theme/classic/formcheck.css" rel="stylesheet" /> 
<script type="text/javascript" src="include/js/formcheck/formcheck.js"></script> 
<script type='text/javascript'>
<!--
var cats = [
<?php $_from = $this->_tpl_vars['qacats_ask']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cats'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cats']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['qacat']):
        $this->_foreach['cats']['iteration']++;
?>
  [<?php echo $this->_tpl_vars['qacat']['cat_id']; ?>
, [ <?php unset($this->_sections['subcat_loop']);
$this->_sections['subcat_loop']['name'] = 'subcat_loop';
$this->_sections['subcat_loop']['loop'] = is_array($_loop=$this->_tpl_vars['qacat']['subcats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['subcat_loop']['show'] = true;
$this->_sections['subcat_loop']['max'] = $this->_sections['subcat_loop']['loop'];
$this->_sections['subcat_loop']['step'] = 1;
$this->_sections['subcat_loop']['start'] = $this->_sections['subcat_loop']['step'] > 0 ? 0 : $this->_sections['subcat_loop']['loop']-1;
if ($this->_sections['subcat_loop']['show']) {
    $this->_sections['subcat_loop']['total'] = $this->_sections['subcat_loop']['loop'];
    if ($this->_sections['subcat_loop']['total'] == 0)
        $this->_sections['subcat_loop']['show'] = false;
} else
    $this->_sections['subcat_loop']['total'] = 0;
if ($this->_sections['subcat_loop']['show']):

            for ($this->_sections['subcat_loop']['index'] = $this->_sections['subcat_loop']['start'], $this->_sections['subcat_loop']['iteration'] = 1;
                 $this->_sections['subcat_loop']['iteration'] <= $this->_sections['subcat_loop']['total'];
                 $this->_sections['subcat_loop']['index'] += $this->_sections['subcat_loop']['step'], $this->_sections['subcat_loop']['iteration']++):
$this->_sections['subcat_loop']['rownum'] = $this->_sections['subcat_loop']['iteration'];
$this->_sections['subcat_loop']['index_prev'] = $this->_sections['subcat_loop']['index'] - $this->_sections['subcat_loop']['step'];
$this->_sections['subcat_loop']['index_next'] = $this->_sections['subcat_loop']['index'] + $this->_sections['subcat_loop']['step'];
$this->_sections['subcat_loop']['first']      = ($this->_sections['subcat_loop']['iteration'] == 1);
$this->_sections['subcat_loop']['last']       = ($this->_sections['subcat_loop']['iteration'] == $this->_sections['subcat_loop']['total']);
?>
  <?php ob_start(); 
 echo SELanguage::_get($this->_tpl_vars['qacat']['subcats'][$this->_sections['subcat_loop']['index']]['cat_title']); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('qa_tmp_title', ob_get_contents());ob_end_clean(); ?>
[<?php echo $this->_tpl_vars['qacat']['subcats'][$this->_sections['subcat_loop']['index']]['cat_id']; ?>
, '<?php echo ((is_array($_tmp=$this->_tpl_vars['qa_tmp_title'])) ? $this->_run_mod_handler('htmlspecialchars_decode', true, $_tmp) : htmlspecialchars_decode($_tmp)); ?>
']<?php if (! $this->_sections['subcat_loop']['last']): ?>, <?php endif; 
 endfor; endif; ?> ] ]<?php if (! ($this->_foreach['cats']['iteration'] == $this->_foreach['cats']['total'])): ?>, 
<?php endif; 
 endforeach; endif; unset($_from); ?>
];

<?php echo '

formcheckLanguage = {
	required: "'; 
 echo SELanguage::_get(27003460); 
 echo '",
	lengthmin: "'; 
 echo SELanguage::_get(27003461); 
 echo '",
	select: "'; 
 echo SELanguage::_get(27003462); 
 echo '"
}
window.addEvent(\'domready\', function(){
	textarea_autogrow(\'qa_question_text\');
	
    new FormCheck(\'qa_ask\', {
            display : {
                titlesInsteadNames : false,
				indicateErrors: 2
            }
		});

	var questionSlide = new Fx.Slide(\'qa_question_form\').chain(function() {
		$(\'qa_question_form\').getParent().setStyle(\'height\',\'auto\');	
	});
	questionSlide.hide();
	
	$(\'qa_ask_link\').addEvent(\'click\', function(e){
		e.stop();
		$(\'qa_question_form\').getParent().setStyle(\'clear\',\'both\');	
		questionSlide.slideIn();
	});

	$(\'qa_ask_cancel\').addEvent(\'click\', function(e){
		e.stop();
		questionSlide.slideOut();
	});

	$(\'cat_select\').addEvent(\'change\', function(e){
		updateSubcats();
	});
	
	$(\'qa_title_text\').addEvent(\'keyup\', function(e){
		updateTitleCnt();
	});

	updateSubcats();
	updateTitleCnt();

});


function updateSubcats() {
	$(\'subcat_select\').erase(\'html\');
	if ($(\'cat_select\').get(\'value\') > 0) {
		var newOption = new Element(\'option\', {
			\'value\': -1,
			\'text\': \''; 
 echo SELanguage::_get(27003437); 
 echo '\'
		});
		newOption.inject($(\'subcat_select\'));
	}
	for(cat in cats){
		if (cats[cat][0] == $(\'cat_select\').get(\'value\')) {
			for(i=0;i<cats[cat][1].length;i++){				
				var newOption = new Element(\'option\', {
					\'value\': cats[cat][1][i][0],
					\'text\': cats[cat][1][i][1]
				});
				newOption.inject($(\'subcat_select\'));
			}
		}
	}
}

function updateTitleCnt() {
	$(\'qa_title_cnt_num\').set(\'html\', 120-$(\'qa_title_text\').get(\'value\').length);
}
//-->
</script>
'; 
 endif; 
 if ($this->_tpl_vars['user']->level_info['level_qa_allow'] != 0 && ( $this->_tpl_vars['total_questions'] > 0 || $this->_tpl_vars['total_answers'] > 0 )): ?>
<div class='qa_user_status_column'>
	<?php if ($this->_tpl_vars['qa_ad_id'] > 0): ?>
	<?php echo $this->_tpl_vars['ads']->ads_display($this->_tpl_vars['qa_ad_id']); ?>

	<?php endif; ?>
</div>

<ul class='qa_tabs_ul'>
<li class='qa_tabs_li' id='qa_tab_q'><a href='javascript:void(0)' id='qa_tab_q_a'><?php echo SELanguage::_get(27003171); ?> (<?php echo $this->_tpl_vars['total_questions']; ?>
)</a></li>
<li class='qa_tabs_li' id='qa_tab_a'><a href='javascript:void(0)' id='qa_tab_a_a'><?php echo SELanguage::_get(27003173); ?> (<?php echo $this->_tpl_vars['total_answers']; ?>
)</a></li>
</ul>
<div class='qa_user_questions_content'>
<div  id='qa_div_q'>

    <?php if ($this->_tpl_vars['maxpage_q'] > 1): ?>
    <div class='question_pages_top'>
    <?php if ($this->_tpl_vars['p_q'] != 1): ?><a href='user_questions.php?s_q=<?php echo $this->_tpl_vars['s_q']; ?>
&v_q=<?php echo $this->_tpl_vars['v_q']; ?>
&p_q=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p_q']), $this);?>
&t=0'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?>&#171; <?php echo SELanguage::_get(182); 
 endif; ?>
    &nbsp;|&nbsp;&nbsp;
    <?php if ($this->_tpl_vars['p_start_q'] == $this->_tpl_vars['p_end_q']): ?>
      <b><?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start_q'], $this->_tpl_vars['total_questions']); ?></b>
    <?php else: ?>
      <b><?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start_q'], $this->_tpl_vars['p_end_q'], $this->_tpl_vars['total_questions']); ?></b>
    <?php endif; ?>
    &nbsp;&nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p_q'] != $this->_tpl_vars['maxpage_q']): ?><a href='user_questions.php?s_q=<?php echo $this->_tpl_vars['s_q']; ?>
&v_q=<?php echo $this->_tpl_vars['v_q']; ?>
&p_q=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p_q']), $this);?>
&t=0'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: 
 echo SELanguage::_get(183); ?> &#187;<?php endif; ?>
    </div>
  <?php endif; ?>

    <?php unset($this->_sections['question_loop']);
$this->_sections['question_loop']['name'] = 'question_loop';
$this->_sections['question_loop']['loop'] = is_array($_loop=$this->_tpl_vars['questions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['question_loop']['show'] = true;
$this->_sections['question_loop']['max'] = $this->_sections['question_loop']['loop'];
$this->_sections['question_loop']['step'] = 1;
$this->_sections['question_loop']['start'] = $this->_sections['question_loop']['step'] > 0 ? 0 : $this->_sections['question_loop']['loop']-1;
if ($this->_sections['question_loop']['show']) {
    $this->_sections['question_loop']['total'] = $this->_sections['question_loop']['loop'];
    if ($this->_sections['question_loop']['total'] == 0)
        $this->_sections['question_loop']['show'] = false;
} else
    $this->_sections['question_loop']['total'] = 0;
if ($this->_sections['question_loop']['show']):

            for ($this->_sections['question_loop']['index'] = $this->_sections['question_loop']['start'], $this->_sections['question_loop']['iteration'] = 1;
                 $this->_sections['question_loop']['iteration'] <= $this->_sections['question_loop']['total'];
                 $this->_sections['question_loop']['index'] += $this->_sections['question_loop']['step'], $this->_sections['question_loop']['iteration']++):
$this->_sections['question_loop']['rownum'] = $this->_sections['question_loop']['iteration'];
$this->_sections['question_loop']['index_prev'] = $this->_sections['question_loop']['index'] - $this->_sections['question_loop']['step'];
$this->_sections['question_loop']['index_next'] = $this->_sections['question_loop']['index'] + $this->_sections['question_loop']['step'];
$this->_sections['question_loop']['first']      = ($this->_sections['question_loop']['iteration'] == 1);
$this->_sections['question_loop']['last']       = ($this->_sections['question_loop']['iteration'] == $this->_sections['question_loop']['total']);
?>

    <div class='qa_question' style='<?php echo smarty_function_cycle(array('name' => 'rightspacer','values' => "margin-right: 10px;,"), $this);?>
'>
      <table cellpadding='0' cellspacing='0' width='100%'>
      <tr>
      <td class='qa_question_main'>
        <?php if ($this->_tpl_vars['questions'][$this->_sections['question_loop']['index']]['question_time'] > 0): ?>
	  <?php $this->assign('question_time', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['questions'][$this->_sections['question_loop']['index']]['question_time'])); ?>
	  <?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['question_time'][0]), $this->_tpl_vars['question_time'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('updateddate', ob_get_contents());ob_end_clean(); ?>
          <div class='qa_question_date'><?php echo sprintf(SELanguage::_get(27003140), $this->_tpl_vars['updateddate']); ?></div>
        <?php endif; ?>
        <div class='qa_question_title'><a href='<?php echo $this->_tpl_vars['url']->url_create('question','',$this->_tpl_vars['questions'][$this->_sections['question_loop']['index']]['question_author']->user_info['user_username'],$this->_tpl_vars['questions'][$this->_sections['question_loop']['index']]['question_id']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['questions'][$this->_sections['question_loop']['index']]['question_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 96, "...", true) : smarty_modifier_truncate($_tmp, 96, "...", true)); ?>
</a></div>
        <div style='margin-top: 10px;'><?php echo ((is_array($_tmp=$this->_tpl_vars['questions'][$this->_sections['question_loop']['index']]['question_text'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 175, "...", true) : smarty_modifier_truncate($_tmp, 175, "...", true)); ?>
</div>
      </td>
      </tr>
	  <tr>
	  <td class='qa_question_info'>
	  <?php ob_start(); 
 echo SELanguage::_get($this->_tpl_vars['questions'][$this->_sections['question_loop']['index']]['subcat_name_langid']); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('subcat_string_name', ob_get_contents());ob_end_clean(); ?>
	  <?php ob_start(); ?><a href='<?php echo $this->_tpl_vars['url']->url_create('question_cat','',$this->_tpl_vars['questions'][$this->_sections['question_loop']['index']]['subcat_id'],$this->_tpl_vars['subcat_string_name']); ?>
'><?php echo $this->_tpl_vars['subcat_string_name']; ?>
</a><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('subcat_name', ob_get_contents());ob_end_clean(); ?>
	  <?php echo sprintf(SELanguage::_get(27003175), $this->_tpl_vars['subcat_name']); ?> - <?php echo sprintf(SELanguage::_get(27003174), $this->_tpl_vars['questions'][$this->_sections['question_loop']['index']]['question_num_answers']); ?> - <?php echo ((is_array($_tmp=$this->_tpl_vars['questions'][$this->_sections['question_loop']['index']]['question_state'])) ? $this->_run_mod_handler('qa_state_name', true, $_tmp) : qa_state_name($_tmp)); ?>

	  </td>
	  </tr>
      </table>
    </div>
    <?php echo smarty_function_cycle(array('values' => ",<div name='bottomspacer' style='clear: both; height: 10px;'></div>"), $this);?>

    
  <?php endfor; endif; ?>

    <?php if ($this->_tpl_vars['maxpage_q'] > 1): ?>
    <div class='question_pages_bottom'>
    <?php if ($this->_tpl_vars['p_q'] != 1): ?><a href='user_questions.php?s_q=<?php echo $this->_tpl_vars['s_q']; ?>
&v_q=<?php echo $this->_tpl_vars['v_q']; ?>
&p_q=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p_q']), $this);?>
&t=0'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?>&#171; <?php echo SELanguage::_get(182); 
 endif; ?>
    &nbsp;|&nbsp;&nbsp;
    <?php if ($this->_tpl_vars['p_start_q'] == $this->_tpl_vars['p_end_q']): ?>
      <b><?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start_q'], $this->_tpl_vars['total_questions']); ?></b>
    <?php else: ?>
      <b><?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start_q'], $this->_tpl_vars['p_end_q'], $this->_tpl_vars['total_questions']); ?></b>
    <?php endif; ?>
    &nbsp;&nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p_q'] != $this->_tpl_vars['maxpage_q']): ?><a href='user_questions.php?s_q=<?php echo $this->_tpl_vars['s_q']; ?>
&v_q=<?php echo $this->_tpl_vars['v_q']; ?>
&p_q=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p_q']), $this);?>
&t=0'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: 
 echo SELanguage::_get(183); ?> &#187;<?php endif; ?>
    </div>
  <?php endif; ?>

  <div style='clear: both; height: 0px;'></div>
</div>


<div  id='qa_div_a'>
 
    <?php if ($this->_tpl_vars['maxpage_a'] > 1): ?>
    <div class='question_pages_top'>
    <?php if ($this->_tpl_vars['p_a'] != 1): ?><a href='user_questions.php?s_a=<?php echo $this->_tpl_vars['s_a']; ?>
&v_a=<?php echo $this->_tpl_vars['v_a']; ?>
&p_a=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p_a']), $this);?>
&t=1'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?>&#171; <?php echo SELanguage::_get(182); 
 endif; ?>
    &nbsp;|&nbsp;&nbsp;
    <?php if ($this->_tpl_vars['p_start_a'] == $this->_tpl_vars['p_end_a']): ?>
      <b><?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start_a'], $this->_tpl_vars['total_answers']); ?></b>
    <?php else: ?>
      <b><?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start_a'], $this->_tpl_vars['p_end_a'], $this->_tpl_vars['total_answers']); ?></b>
    <?php endif; ?>
    &nbsp;&nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p_a'] != $this->_tpl_vars['maxpage_a']): ?><a href='user_questions.php?s_a=<?php echo $this->_tpl_vars['s_a']; ?>
&v_a=<?php echo $this->_tpl_vars['v_a']; ?>
&p_a=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p_a']), $this);?>
&t=1'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: 
 echo SELanguage::_get(183); ?> &#187;<?php endif; ?>
    </div>
  <?php endif; ?>


    <?php unset($this->_sections['answer_loop']);
$this->_sections['answer_loop']['name'] = 'answer_loop';
$this->_sections['answer_loop']['loop'] = is_array($_loop=$this->_tpl_vars['answers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['answer_loop']['show'] = true;
$this->_sections['answer_loop']['max'] = $this->_sections['answer_loop']['loop'];
$this->_sections['answer_loop']['step'] = 1;
$this->_sections['answer_loop']['start'] = $this->_sections['answer_loop']['step'] > 0 ? 0 : $this->_sections['answer_loop']['loop']-1;
if ($this->_sections['answer_loop']['show']) {
    $this->_sections['answer_loop']['total'] = $this->_sections['answer_loop']['loop'];
    if ($this->_sections['answer_loop']['total'] == 0)
        $this->_sections['answer_loop']['show'] = false;
} else
    $this->_sections['answer_loop']['total'] = 0;
if ($this->_sections['answer_loop']['show']):

            for ($this->_sections['answer_loop']['index'] = $this->_sections['answer_loop']['start'], $this->_sections['answer_loop']['iteration'] = 1;
                 $this->_sections['answer_loop']['iteration'] <= $this->_sections['answer_loop']['total'];
                 $this->_sections['answer_loop']['index'] += $this->_sections['answer_loop']['step'], $this->_sections['answer_loop']['iteration']++):
$this->_sections['answer_loop']['rownum'] = $this->_sections['answer_loop']['iteration'];
$this->_sections['answer_loop']['index_prev'] = $this->_sections['answer_loop']['index'] - $this->_sections['answer_loop']['step'];
$this->_sections['answer_loop']['index_next'] = $this->_sections['answer_loop']['index'] + $this->_sections['answer_loop']['step'];
$this->_sections['answer_loop']['first']      = ($this->_sections['answer_loop']['iteration'] == 1);
$this->_sections['answer_loop']['last']       = ($this->_sections['answer_loop']['iteration'] == $this->_sections['answer_loop']['total']);
?>

    <div class='qa_question' style='<?php echo smarty_function_cycle(array('name' => 'rightspacer','values' => "margin-right: 10px;,"), $this);?>
'>
      <table cellpadding='0' cellspacing='0' width='100%'>
      <tr>
      <td class='qa_question_main'>
        <?php if ($this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_time'] > 0): ?>
	  <?php $this->assign('question_time', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_time'])); ?>
	  <?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['question_time'][0]), $this->_tpl_vars['question_time'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('updateddate', ob_get_contents());ob_end_clean(); ?>
          <div class='qa_question_date'><?php echo sprintf(SELanguage::_get(27003140), $this->_tpl_vars['updateddate']); ?></div>
        <?php endif; ?>
        <div class='qa_question_title'><a href='<?php echo $this->_tpl_vars['url']->url_create('question','',$this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_author']->user_info['user_username'],$this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_id']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 96, "...", true) : smarty_modifier_truncate($_tmp, 96, "...", true)); ?>
</a></div>
        <div style='margin-top: 10px;'><?php echo ((is_array($_tmp=$this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_text'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 175, "...", true) : smarty_modifier_truncate($_tmp, 175, "...", true)); ?>
</div>
      </td>
      </tr>
	  <tr>
	  <td class='qa_question_info'>
	  <?php ob_start(); 
 echo SELanguage::_get($this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['subcat_name_langid']); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('subcat_string_name', ob_get_contents());ob_end_clean(); ?>
	  <?php ob_start(); ?><a href='<?php echo $this->_tpl_vars['url']->url_create('question_cat','',$this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['subcat_id'],$this->_tpl_vars['subcat_string_name']); ?>
'><?php echo $this->_tpl_vars['subcat_string_name']; ?>
</a><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('subcat_name', ob_get_contents());ob_end_clean(); ?>
	<?php ob_start(); ?><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_author']->user_info['user_username']); ?>
'><?php echo $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_author']->user_info['user_displayname']; ?>
</a><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('question_leader', ob_get_contents());ob_end_clean(); ?>
	  <?php echo sprintf(SELanguage::_get(27003175), $this->_tpl_vars['subcat_name']); ?> - <?php echo sprintf(SELanguage::_get(27003401), $this->_tpl_vars['question_leader']); ?> - <?php echo sprintf(SELanguage::_get(27003174), $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_num_answers']); ?> - <?php echo ((is_array($_tmp=$this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_state'])) ? $this->_run_mod_handler('qa_state_name', true, $_tmp) : qa_state_name($_tmp)); ?>

	  </td>
	  </tr>
	  <tr>
	  <td class='qa_question_answer'>
        <?php if ($this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_user_answer']['answer_time'] > 0): ?>
	  <?php $this->assign('answer_time', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_user_answer']['answer_time'])); ?>
	  <?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['answer_time'][0]), $this->_tpl_vars['answer_time'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('updateddate', ob_get_contents());ob_end_clean(); ?>
          <div class='qa_question_date'><?php echo sprintf(SELanguage::_get(27003140), $this->_tpl_vars['updateddate']); ?></div>
        <?php endif; ?>
        <div style='margin-top: 10px;margin-bottom: 4px;'><?php echo ((is_array($_tmp=$this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_user_answer']['answer_text'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 175, "...", true) : smarty_modifier_truncate($_tmp, 175, "...", true)); ?>
</div>
		<?php if ($this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_state'] == @QA_STATE_RESOLVED): ?>
			<?php if ($this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_best_answer_id'] == $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_user_answer']['answer_id']): ?>
				<?php if ($this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_best_answer_selected'] == 1): ?>
				<?php echo SELanguage::_get(27003500); ?> 	
				<?php $this->assign('best_answer_rating', $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_best_answer_rating']); ?>
				<?php else: ?>
				<?php echo SELanguage::_get(27003501); ?> 	
				<?php $this->assign('best_answer_rating', ($this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_user_answer']['answer_rating_value']+0.25)); ?>				
				<?php endif; ?>
				<?php $this->assign('best_answer_rating_half', ($this->_tpl_vars['best_answer_rating']+0.5)); ?>	
				<?php unset($this->_sections['rating']);
$this->_sections['rating']['name'] = 'rating';
$this->_sections['rating']['start'] = (int)1;
$this->_sections['rating']['loop'] = is_array($_loop=$this->_tpl_vars['setting']['setting_qa_max_rating']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rating']['show'] = true;
$this->_sections['rating']['max'] = $this->_sections['rating']['loop'];
$this->_sections['rating']['step'] = 1;
if ($this->_sections['rating']['start'] < 0)
    $this->_sections['rating']['start'] = max($this->_sections['rating']['step'] > 0 ? 0 : -1, $this->_sections['rating']['loop'] + $this->_sections['rating']['start']);
else
    $this->_sections['rating']['start'] = min($this->_sections['rating']['start'], $this->_sections['rating']['step'] > 0 ? $this->_sections['rating']['loop'] : $this->_sections['rating']['loop']-1);
if ($this->_sections['rating']['show']) {
    $this->_sections['rating']['total'] = min(ceil(($this->_sections['rating']['step'] > 0 ? $this->_sections['rating']['loop'] - $this->_sections['rating']['start'] : $this->_sections['rating']['start']+1)/abs($this->_sections['rating']['step'])), $this->_sections['rating']['max']);
    if ($this->_sections['rating']['total'] == 0)
        $this->_sections['rating']['show'] = false;
} else
    $this->_sections['rating']['total'] = 0;
if ($this->_sections['rating']['show']):

            for ($this->_sections['rating']['index'] = $this->_sections['rating']['start'], $this->_sections['rating']['iteration'] = 1;
                 $this->_sections['rating']['iteration'] <= $this->_sections['rating']['total'];
                 $this->_sections['rating']['index'] += $this->_sections['rating']['step'], $this->_sections['rating']['iteration']++):
$this->_sections['rating']['rownum'] = $this->_sections['rating']['iteration'];
$this->_sections['rating']['index_prev'] = $this->_sections['rating']['index'] - $this->_sections['rating']['step'];
$this->_sections['rating']['index_next'] = $this->_sections['rating']['index'] + $this->_sections['rating']['step'];
$this->_sections['rating']['first']      = ($this->_sections['rating']['iteration'] == 1);
$this->_sections['rating']['last']       = ($this->_sections['rating']['iteration'] == $this->_sections['rating']['total']);
?>
				<?php if ($this->_sections['rating']['index'] <= $this->_tpl_vars['best_answer_rating']): ?>
				<img src = "./images/icons/qa_rating_star2.png" class='qa_star' />
				<?php else: ?>
					<?php if ($this->_sections['rating']['index'] <= $this->_tpl_vars['best_answer_rating_half']): ?>
					<img src = "./images/icons/qa_rating_star2_half.png" class='qa_star' />
					<?php else: ?>
					<img src = "./images/icons/qa_rating_star1.png" class='qa_star' />
					<?php endif; ?>
				<?php endif; ?>
				<?php endfor; endif; ?>
			<?php endif; ?>
		<?php endif; ?>
      </td>
      </tr>
      </table>
    </div>
    <?php echo smarty_function_cycle(array('values' => ",<div name='bottomspacer' style='clear: both; height: 10px;'></div>"), $this);?>

    
  <?php endfor; endif; ?>

    <?php if ($this->_tpl_vars['maxpage_a'] > 1): ?>
    <div class='question_pages_bottom'>
    <?php if ($this->_tpl_vars['p_a'] != 1): ?><a href='user_questions.php?s_a=<?php echo $this->_tpl_vars['s_a']; ?>
&v_a=<?php echo $this->_tpl_vars['v_a']; ?>
&p_a=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p_a']), $this);?>
&t=1'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?>&#171; <?php echo SELanguage::_get(182); 
 endif; ?>
    &nbsp;|&nbsp;&nbsp;
    <?php if ($this->_tpl_vars['p_start_a'] == $this->_tpl_vars['p_end_a']): ?>
      <b><?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start_a'], $this->_tpl_vars['total_answers']); ?></b>
    <?php else: ?>
      <b><?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start_a'], $this->_tpl_vars['p_end_a'], $this->_tpl_vars['total_answers']); ?></b>
    <?php endif; ?>
    &nbsp;&nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p_a'] != $this->_tpl_vars['maxpage_a']): ?><a href='user_questions.php?s_a=<?php echo $this->_tpl_vars['s_a']; ?>
&v_a=<?php echo $this->_tpl_vars['v_a']; ?>
&p_a=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p_a']), $this);?>
&t=1'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: 
 echo SELanguage::_get(183); ?> &#187;<?php endif; ?>
    </div>
  <?php endif; ?>

  <div style='clear: both; height: 0px;'></div>
 </div>
  
</div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'rightside.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='clear: both; height: 10px;'></div>
<?php echo '
<script type=\'text/javascript\'>
<!--
window.addEvent(\'domready\', function(){	
	var questionSlide = new Fx.Slide(\'qa_div_q\');
	var answerSlide = new Fx.Slide(\'qa_div_a\');
	
	'; ?>

	<?php if ($this->_tpl_vars['t'] == 0): ?>
	answerSlide.hide();
	$('qa_tab_q').addClass('qa_tab_selected');
	<?php else: ?>
	questionSlide.hide();
	$('qa_tab_a').addClass('qa_tab_selected');
	<?php endif; ?>
	<?php echo '

	$(\'qa_tab_q_a\').addEvent(\'click\', function(e){
		answerSlide.hide();
		questionSlide.show();
		$(\'qa_tab_a\').removeClass(\'qa_tab_selected\');
		$(\'qa_tab_q\').addClass(\'qa_tab_selected\');
	});
	$(\'qa_tab_a_a\').addEvent(\'click\', function(e){
		questionSlide.hide();
		answerSlide.show();
		$(\'qa_tab_q\').removeClass(\'qa_tab_selected\');
		$(\'qa_tab_a\').addClass(\'qa_tab_selected\');
	});
});
//-->
</script>
'; 
 endif; 
 $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>