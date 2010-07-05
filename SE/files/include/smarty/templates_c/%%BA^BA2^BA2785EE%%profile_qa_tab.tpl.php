<?php /* Smarty version 2.6.14, created on 2010-05-31 14:34:00
         compiled from profile_qa_tab.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'profile_qa_tab.tpl', 18, false),array('modifier', 'truncate', 'profile_qa_tab.tpl', 27, false),array('modifier', 'qa_state_name', 'profile_qa_tab.tpl', 35, false),)), $this);
?><?php
SELanguage::_preload_multi(27003171,27003173,27003140,27003175,27003174,27003401,27003500,27003501);
SELanguage::load();
?>
<?php if ($this->_tpl_vars['owner']->level_info['level_qa_allow'] != 0 && ( $this->_tpl_vars['total_questions'] > 0 || $this->_tpl_vars['total_answers'] > 0 )): ?>

<ul class='qa_tabs_ul'>
<li class='qa_tabs_li' id='qa_tab_q'><a href='javascript:void(0)' id='qa_tab_q_a'><?php echo SELanguage::_get(27003171); ?> (<?php echo $this->_tpl_vars['total_questions']; ?>
)</a></li>
<li class='qa_tabs_li' id='qa_tab_a'><a href='javascript:void(0)' id='qa_tab_a_a'><?php echo SELanguage::_get(27003173); ?> (<?php echo $this->_tpl_vars['total_answers']; ?>
)</a></li>
</ul>
<div class='qa_profile_content'>
<div  id='qa_div_q'>
  <div class='profile_headline'>
    <?php echo SELanguage::_get(27003171); ?> (<?php echo $this->_tpl_vars['total_questions']; ?>
)
  </div>

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
'><?php echo ((is_array($_tmp=$this->_tpl_vars['questions'][$this->_sections['question_loop']['index']]['question_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 48, "...", true) : smarty_modifier_truncate($_tmp, 48, "...", true)); ?>
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
  <div style='clear: both; height: 0px;'></div>
</div>


<div  id='qa_div_a'>
  <div class='profile_headline'>
    <?php echo SELanguage::_get(27003173); ?> (<?php echo $this->_tpl_vars['total_answers']; ?>
)
  </div>

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
'><?php echo ((is_array($_tmp=$this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['question_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 48, "...", true) : smarty_modifier_truncate($_tmp, 48, "...", true)); ?>
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
  <div style='clear: both; height: 0px;'></div>
 </div>
  
</div>

<?php echo '
<script type=\'text/javascript\'>
<!--
window.addEvent(\'domready\', function(){	
	var questionSlide = new Fx.Slide(\'qa_div_q\');
	var answerSlide = new Fx.Slide(\'qa_div_a\');
	
	answerSlide.hide();
	$(\'qa_tab_q\').addClass(\'qa_tab_selected\');

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
 endif; ?>