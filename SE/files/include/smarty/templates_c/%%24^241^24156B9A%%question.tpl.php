<?php /* Smarty version 2.6.14, created on 2010-05-31 14:26:22
         compiled from question.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'question.tpl', 23, false),array('modifier', 'strlen', 'question.tpl', 89, false),array('modifier', 'count', 'question.tpl', 104, false),array('modifier', 'time_until', 'question.tpl', 125, false),array('modifier', 'qa_br2nl', 'question.tpl', 162, false),array('modifier', 'qa_nbsp2space', 'question.tpl', 162, false),)), $this);
?><?php
SELanguage::_preload_multi(27003406,27003416,27003405,27003470,27003472,27003471,27003404,27003473,27003474,27003475,27003447,27003407,27003411,27003410,27003412,27003413,27003424,27003408,27003423,27003476,27003477,27003422,27003419,27003426,27003427,27003428,27003425,27003420,27003421);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='float: left; width: 685px; padding: 0px 0px 5px 5px;'>

    <?php if ($this->_tpl_vars['error'] > 0): ?>
    <br>
    <table cellpadding='0' cellspacing='0' align='center'>
      <tr>
        <td class='result'>
          <img src='./images/icons/bulb16.gif' border='0' class='icon' />
          <?php echo SELanguage::_get(27003406); ?>
        </td>
      </tr>
    </table>
  <?php endif; ?>


  <div class='qa_question_wrapper'>
  	<div class='qa_answer_profile'>
	  <a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['question_owner']->user_info['user_username']); ?>
'>
		<img src='<?php echo $this->_tpl_vars['question_owner']->user_photo("./images/nophoto.gif",'TRUE'); ?>
' border='0' width='60' height='60' />
		<br/><?php echo ((is_array($_tmp=$this->_tpl_vars['question_owner']->user_info['user_displayname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 18, "...", true) : smarty_modifier_truncate($_tmp, 18, "...", true)); ?>

		
	  </a>
	</div>
	<div class='qa_question_top'>
	<?php $this->assign('action_date', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['question']->time)); ?>
	<div class='qa_question_date'><?php echo sprintf(SELanguage::_get($this->_tpl_vars['action_date'][0]), $this->_tpl_vars['action_date'][1]); ?></div>
	<p class='qa_q_state'><?php echo SELanguage::_get($this->_tpl_vars['question']->state_lang_id); ?></p>
	<h1 class='qa_question_title'><?php echo $this->_tpl_vars['question']->title; ?>
</h1>
	<div class='qa_text'><?php echo $this->_tpl_vars['question']->text; ?>
</div>
	</div>
	<div class='qa_question_bottom'>
	<a href="javascript:TB_show('<?php echo SELanguage::_get(27003416); ?>', 'user_report.php?return_url=<?php echo $this->_tpl_vars['url']->url_current(); ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');"><?php echo SELanguage::_get(27003416); ?></a>
	</div>
  </div>


<table cellpadding='0' cellspacing='0' width='100%' style='margin-top: 10px;'>
<tr>
<td style='width: 200px; vertical-align: top;'>



  <div class='qa_categories_box'>
  	<h2><?php echo SELanguage::_get(27003405); ?></h2>
	<?php unset($this->_sections['cat_loop']);
$this->_sections['cat_loop']['name'] = 'cat_loop';
$this->_sections['cat_loop']['loop'] = is_array($_loop=$this->_tpl_vars['qacats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cat_loop']['show'] = true;
$this->_sections['cat_loop']['max'] = $this->_sections['cat_loop']['loop'];
$this->_sections['cat_loop']['step'] = 1;
$this->_sections['cat_loop']['start'] = $this->_sections['cat_loop']['step'] > 0 ? 0 : $this->_sections['cat_loop']['loop']-1;
if ($this->_sections['cat_loop']['show']) {
    $this->_sections['cat_loop']['total'] = $this->_sections['cat_loop']['loop'];
    if ($this->_sections['cat_loop']['total'] == 0)
        $this->_sections['cat_loop']['show'] = false;
} else
    $this->_sections['cat_loop']['total'] = 0;
if ($this->_sections['cat_loop']['show']):

            for ($this->_sections['cat_loop']['index'] = $this->_sections['cat_loop']['start'], $this->_sections['cat_loop']['iteration'] = 1;
                 $this->_sections['cat_loop']['iteration'] <= $this->_sections['cat_loop']['total'];
                 $this->_sections['cat_loop']['index'] += $this->_sections['cat_loop']['step'], $this->_sections['cat_loop']['iteration']++):
$this->_sections['cat_loop']['rownum'] = $this->_sections['cat_loop']['iteration'];
$this->_sections['cat_loop']['index_prev'] = $this->_sections['cat_loop']['index'] - $this->_sections['cat_loop']['step'];
$this->_sections['cat_loop']['index_next'] = $this->_sections['cat_loop']['index'] + $this->_sections['cat_loop']['step'];
$this->_sections['cat_loop']['first']      = ($this->_sections['cat_loop']['iteration'] == 1);
$this->_sections['cat_loop']['last']       = ($this->_sections['cat_loop']['iteration'] == $this->_sections['cat_loop']['total']);
?>
	<?php ob_start(); 
 echo SELanguage::_get($this->_tpl_vars['qacats'][$this->_sections['cat_loop']['index']]['cat_title']); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('cat_string_name', ob_get_contents());ob_end_clean(); ?>
	<p class='<?php echo $this->_tpl_vars['qacats'][$this->_sections['cat_loop']['index']]['cat_class']; ?>
'><a href='<?php echo $this->_tpl_vars['url']->url_create('question_cat',@NULL,$this->_tpl_vars['qacats'][$this->_sections['cat_loop']['index']]['cat_id'],$this->_tpl_vars['cat_string_name']); ?>
'><?php echo $this->_tpl_vars['cat_string_name']; ?>
</a></p>
	<?php endfor; endif; ?>
  </div>

	<?php if ($this->_tpl_vars['qa_ad_id'] > 0): ?>
	<?php echo $this->_tpl_vars['ads']->ads_display($this->_tpl_vars['qa_ad_id']); ?>

	<?php endif; ?>

</td>
<td style='vertical-align: top; padding-left: 10px;'>
	<?php if ($this->_tpl_vars['question']->state == @QA_STATE_RESOLVED): ?>
  <p class='qa_h2_best_answer'><?php echo SELanguage::_get(27003470); ?></p> - <?php if ($this->_tpl_vars['question']->best_answer_selected == 1): 
 echo SELanguage::_get(27003472); 
 else: 
 echo SELanguage::_get(27003471); 
 endif; ?>
  <div class='qa_best_answer_wrapper'>
  	<div class='qa_answer_profile'>
	  <a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['best_answer']['author']->user_info['user_username']); ?>
'>
		<img src='<?php echo $this->_tpl_vars['best_answer']['author']->user_photo("./images/nophoto.gif",'TRUE'); ?>
' border='0' width='60' height='60' />
		<br/><?php echo ((is_array($_tmp=$this->_tpl_vars['best_answer']['author']->user_info['user_displayname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 18, "...", true) : smarty_modifier_truncate($_tmp, 18, "...", true)); ?>

		
	  </a>
	</div>
	<div class='qa_best_answer_top'>
	<?php $this->assign('answer_submitted', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['best_answer']['answer_time'])); ?>
	<?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['answer_submitted'][0]), $this->_tpl_vars['answer_submitted'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('submitted', ob_get_contents());ob_end_clean(); ?>
	<div class='qa_question_date'><?php echo sprintf(SELanguage::_get(27003404), $this->_tpl_vars['submitted']); ?></div>
	<?php echo $this->_tpl_vars['best_answer']['answer_text']; ?>

	<div class='qa_askers_rating'>
	<?php if ($this->_tpl_vars['question']->best_answer_selected == 1): ?>
	<?php echo SELanguage::_get(27003473); ?>
	<?php else: ?>
	<?php echo SELanguage::_get(27003474); ?>
	<?php endif; ?>
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
	<?php if ($this->_sections['rating']['index'] <= $this->_tpl_vars['question']->best_answer_rating): ?>
	<img src = "./images/icons/qa_rating_star2.png" class='qa_star' />
	<?php else: ?>
	<img src = "./images/icons/qa_rating_star1.png" class='qa_star' />
	<?php endif; ?>
	<?php endfor; endif; ?>
	</div>
	<?php if ($this->_tpl_vars['question']->best_answer_selected == 1 && ((is_array($_tmp=$this->_tpl_vars['question']->best_answer_comment)) ? $this->_run_mod_handler('strlen', true, $_tmp) : strlen($_tmp)) > 0): ?>
	<div class='qa_askers_comment'>
	<span><?php echo SELanguage::_get(27003475); ?></span> <?php echo $this->_tpl_vars['question']->best_answer_comment; ?>

	</div>
	<?php endif; ?>
	</div>
	<div class='qa_best_answer_bottom'>
	<a href="javascript:TB_show('<?php echo SELanguage::_get(27003416); ?>', 'user_report.php?return_url=<?php echo $this->_tpl_vars['url']->url_current(); ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');"><?php echo SELanguage::_get(27003416); ?></a>
	</div>
  </div>
	

	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['question']->state == @QA_STATE_RESOLVED): ?>
  <p class='qa_h2_answer'><?php echo SELanguage::_get(27003447); ?> (<?php echo count($this->_tpl_vars['answers']); ?>
)</p>
	<?php else: ?>
  <p class='qa_h2_answer'><?php echo SELanguage::_get(27003407); ?> (<?php echo count($this->_tpl_vars['answers']); ?>
)</p>
  	<?php endif; ?>
	<?php if ($this->_tpl_vars['user_answer_id'] == 0 && $this->_tpl_vars['question_owner']->user_info['user_id'] != $this->_tpl_vars['user']->user_info['user_id'] && $this->_tpl_vars['user']->user_exists): ?>
	<?php if ($this->_tpl_vars['question']->state == @QA_STATE_NEW || $this->_tpl_vars['question']->state == @QA_STATE_SELECTING): ?>
	<div class='qa_button' id='qa_answer_button'><?php echo SELanguage::_get(27003411); ?></div><div class='qa_button_r' id='qa_answer_button_r'>&nbsp;</div>
	<div id='qa_answer_form' >
	<p><?php echo SELanguage::_get(27003410); ?></p>
	<form action="question.php" method="post">
	<input type="hidden" name="task" value="submit_answer" />
	<input type="hidden" name="qid" value="<?php echo $this->_tpl_vars['question']->q_id; ?>
" />
	<input type="hidden" name="user" value="<?php echo $this->_tpl_vars['question']->user_username; ?>
" />
	<textarea name='answer_text' id='qa_answer_text' ></textarea>
	<input type="submit" class='button' value='<?php echo SELanguage::_get(27003412); ?>' /> <input type='button' class='button' id='qa_answer_cancel' value='<?php echo SELanguage::_get(27003413); ?>' />
	</form>
	</div>
	<?php endif; ?>
	<?php endif; ?>

  <?php if ($this->_tpl_vars['question_owner']->user_info['user_id'] == $this->_tpl_vars['user']->user_info['user_id'] && $this->_tpl_vars['question']->state == @QA_STATE_SELECTING): ?>
  <?php $this->assign('time_remaining', ((is_array($_tmp=$this->_tpl_vars['question']->time)) ? $this->_run_mod_handler('time_until', true, $_tmp, $this->_tpl_vars['question']->ttl) : time_until($_tmp, $this->_tpl_vars['question']->ttl))); ?>
  <?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['time_remaining'][0]), $this->_tpl_vars['time_remaining'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('ttl_end', ob_get_contents());ob_end_clean(); ?>
  <?php echo sprintf(SELanguage::_get(27003424), $this->_tpl_vars['ttl_end']); ?>
  <?php endif; ?>
  <?php if (count($this->_tpl_vars['answers']) == 0 && $this->_tpl_vars['question_owner']->user_info['user_id'] != $this->_tpl_vars['user']->user_info['user_id'] && $this->_tpl_vars['user']->user_exists && ( $this->_tpl_vars['question']->state == @QA_STATE_NEW || $this->_tpl_vars['question']->state == @QA_STATE_SELECTING )): ?>
  <br/><p><strong><?php echo SELanguage::_get(27003408); ?></strong></p>
  <?php else: ?>
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
  <div class='qa_answer'><a name='a_<?php echo $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['answer_id']; ?>
'></a>
   	<div class='qa_answer_profile'>
   		<a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['author']->user_info['user_username']); ?>
'>
            <img src='<?php echo $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['author']->user_photo("./images/nophoto.gif",'TRUE'); ?>
' border='0' width='60' height='60' />			
          </a><br/>
   		<a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['author']->user_info['user_username']); ?>
'>
            <?php echo $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['author']->user_info['user_displayname']; ?>

          </a>
	</div>
   	<div class='qa_answer_content'>
	<?php $this->assign('answer_submitted', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['answer_time'])); ?>
	<?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['answer_submitted'][0]), $this->_tpl_vars['answer_submitted'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('submitted', ob_get_contents());ob_end_clean(); ?>
	<div class='qa_question_date'><?php echo sprintf(SELanguage::_get(27003404), $this->_tpl_vars['submitted']); ?></div>
	<?php echo $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['answer_text']; ?>

	</div>
	<?php if ($this->_tpl_vars['question_owner']->user_info['user_id'] == $this->_tpl_vars['user']->user_info['user_id'] && ( $this->_tpl_vars['question']->state == @QA_STATE_SELECTING || $this->_tpl_vars['question']->state == @QA_STATE_UNDECIDED || $this->_tpl_vars['question']->state == @QA_STATE_TIEBREAKER )): ?>
	<div class='qa_button qa_best_answer_button' xqa_aid='<?php echo $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['answer_id']; ?>
'><?php echo SELanguage::_get(27003423); ?></div><div class='qa_button_r'>&nbsp;</div>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['author']->user_info['user_id'] == $this->_tpl_vars['user']->user_info['user_id'] && ( $this->_tpl_vars['question']->state == @QA_STATE_NEW || $this->_tpl_vars['question']->state == @QA_STATE_SELECTING )): ?>
	<div class='qa_button' id='qa_edit_answer'><?php echo SELanguage::_get(27003476); ?></div><div class='qa_button_r'>&nbsp;</div>
	<?php endif; ?>
  </div>
	<?php if ($this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['author']->user_info['user_id'] == $this->_tpl_vars['user']->user_info['user_id'] && ( $this->_tpl_vars['question']->state == @QA_STATE_NEW || $this->_tpl_vars['question']->state == @QA_STATE_SELECTING )): ?>
	<div id='qa_edit_answer_form'>
	<form action="question.php" method="post">
	<input type="hidden" name="task" value="edit_answer" />
	<input type="hidden" name="qid" value="<?php echo $this->_tpl_vars['question']->q_id; ?>
" />
	<input type="hidden" name="aid" value="<?php echo $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['answer_id']; ?>
" />
	<input type="hidden" name="user" value="<?php echo $this->_tpl_vars['question']->user_username; ?>
" />
	<textarea name='answer_text' id='qa_edit_answer_text' ><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['answer_text'])) ? $this->_run_mod_handler('qa_br2nl', true, $_tmp) : qa_br2nl($_tmp)))) ? $this->_run_mod_handler('qa_nbsp2space', true, $_tmp) : qa_nbsp2space($_tmp)); ?>
</textarea>
	<input type="submit" class='button' value='<?php echo SELanguage::_get(27003477); ?>' /> <input type='button' class='button' id='qa_edit_answer_cancel' value='<?php echo SELanguage::_get(27003413); ?>' />
	</form>	
	</div>
	<?php endif; ?>
  	<div style='float:right'>
	<a href="javascript:TB_show('<?php echo SELanguage::_get(27003416); ?>', 'user_report.php?return_url=<?php echo $this->_tpl_vars['url']->url_current(); ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');"><?php echo SELanguage::_get(27003416); ?></a>
	</div>
	<div class='qa_question_answer_bottom_bar'>
	<div id='answer_<?php echo $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['answer_id']; ?>
_rate' class='qa_rate' xqa_rating='<?php echo $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['answer_rating_value']; ?>
' xqa_id='<?php echo $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['answer_id']; ?>
' xqa_type='answer' xqa_rating_allowed='<?php echo $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['rating_allowed']; ?>
' xqa_user_id='<?php echo $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['author']->user_info['user_id']; ?>
' xqa_has_rated='<?php echo $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['has_rated']; ?>
'></div> <?php echo sprintf(SELanguage::_get(27003422), $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['answer_rating_value'], $this->_tpl_vars['setting']['setting_qa_max_rating'], $this->_tpl_vars['answers'][$this->_sections['answer_loop']['index']]['answer_rating_raters_num']); ?>
	</div>
  <?php endfor; endif; ?>
  <?php endif; ?>
</td>
</tr>
</table>


<?php echo '
<script type=\'text/javascript\'>
<!--
window.addEvent(\'domready\', function(){
'; 
 if ($this->_tpl_vars['user_answer_id'] == 0 && $this->_tpl_vars['question_owner']->user_info['user_id'] != $this->_tpl_vars['user']->user_info['user_id'] && $this->_tpl_vars['user']->user_exists && ( $this->_tpl_vars['question']->state == @QA_STATE_NEW || $this->_tpl_vars['question']->state == @QA_STATE_SELECTING )): 
 echo '
	textarea_autogrow(\'qa_answer_text\');
	
	var answerSlide = new Fx.Slide(\'qa_answer_form\').chain(function() {
		$(\'qa_answer_form\').getParent().setStyle(\'height\',\'auto\');	
	});
	
	answerSlide.hide();
	$(\'qa_answer_button\').addEvent(\'click\', function(e){
		e.stop();
		$(\'qa_answer_form\').getParent().setStyle(\'clear\',\'both\');	
		answerSlide.slideIn();
		$(\'qa_answer_button\').setProperty(\'disabled\',\'disabled\');
	});
	$(\'qa_answer_cancel\').addEvent(\'click\', function(e){
		e.stop();
		answerSlide.slideOut();
		$(\'qa_answer_button\').removeProperty(\'disabled\');
	});

'; ?>

	<?php endif; 
 echo '

'; ?>

	<?php if ($this->_tpl_vars['user_answer_id'] > 0 && ( $this->_tpl_vars['question']->state == @QA_STATE_NEW || $this->_tpl_vars['question']->state == @QA_STATE_SELECTING )): 
 echo '
	textarea_autogrow(\'qa_edit_answer_text\');

	var editAnswerSlideCurr = new Fx.Slide($(\'qa_edit_answer\').getParent()).chain(function() {
		$(\'qa_edit_answer\').getParent().getParent().setStyle(\'height\',\'auto\');	
	});

	var editAnswerSlide = new Fx.Slide(\'qa_edit_answer_form\').chain(function() {
		$(\'qa_edit_answer_form\').getParent().setStyle(\'height\',\'auto\');	
	});
	editAnswerSlide.hide();
	$(\'qa_edit_answer\').addEvent(\'click\', function(e){
		e.stop();
		$(\'qa_edit_answer\').getParent().getParent().setStyle(\'clear\',\'both\');	
		editAnswerSlide.slideIn();
		editAnswerSlideCurr.slideOut();
		$(\'qa_edit_answer\').setProperty(\'disabled\',\'disabled\');
	});
	$(\'qa_edit_answer_cancel\').addEvent(\'click\', function(e){
		e.stop();
		editAnswerSlide.slideOut();
		editAnswerSlideCurr.slideIn();
		$(\'qa_edit_answer\').removeProperty(\'disabled\');
	});
'; ?>

	<?php endif; 
 echo '
	
});



//-->
</script>
'; ?>



<a href='javascript:void(0)' id='qa_rating_star_a' class='qaStars' style='display:none; border: none;' title='<?php if (! $this->_tpl_vars['user']->user_exists): 
 echo SELanguage::_get(27003419); 
 endif; ?>'><img border="0" src='./images/icons/qa_rating_star1.png'/></a>

<div id='qa_best_answer_form' class='qa_best_answer_form' style='display:none;'>
<form action="question.php" method="post">
<input type="hidden" name="task" value="submit_best_answer" />
<input type="hidden" name="qid" value="<?php echo $this->_tpl_vars['question']->q_id; ?>
" />
<input type="hidden" name="user" value="<?php echo $this->_tpl_vars['question']->user_username; ?>
" />
<input type="hidden" name="aid" class='qa_aid' />
<input type="hidden" name="rating" class='qa_rating' value='0'/>
<table>
<tr><td><?php echo SELanguage::_get(27003426); ?></td><td>
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
<img src = "./images/icons/qa_rating_star1.png" class='qa_star' xqa_rating_num='<?php echo $this->_sections['rating']['index']; ?>
'/>
<?php endfor; endif; ?>
</td></tr>
<tr><td valign="top" align="right"><?php echo SELanguage::_get(27003427); ?></td><td><textarea name='comment_text' class='qa_best_answer_comment' ></textarea></td></tr>
<tr><td></td><td><input type="submit" class='button' value='<?php echo SELanguage::_get(27003428); ?>' />&nbsp;&nbsp;<input type='button' class='button qa_best_answer_cancel' value='<?php echo SELanguage::_get(27003413); ?>' /></td></tr>
</table>
</form>
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
preload_full = new Image();
preload_full.src = "./images/icons/qa_rating_star2.png";
preload_partial = new Image();
preload_partial.src = "./images/icons/qa_rating_star2_half.png";
preload_empty = new Image();
preload_empty.src = "./images/icons/qa_rating_star1.png";

qa_max_rating =  '; 
 echo $this->_tpl_vars['setting']['setting_qa_max_rating']; 
 echo ';

var qaTips;

window.addEvent(\'domready\', function(){	
	$$(\'div.qa_rate\').each(function(el) {	
		qaFillStars(el);
		var rating = el.get(\'xqa_rating\');
		qaSetStars(el,rating);
	});

	'; 
 if ($this->_tpl_vars['question_owner']->user_info['user_id'] == $this->_tpl_vars['user']->user_info['user_id'] && ( $this->_tpl_vars['question']->state == @QA_STATE_SELECTING || $this->_tpl_vars['question']->state == @QA_STATE_UNDECIDED || $this->_tpl_vars['question']->state == @QA_STATE_TIEBREAKER )): 
 echo '

	$$(\'div.qa_best_answer_button\').each(function(el) {		
		var aid = el.get(\'xqa_aid\');
		el.addEvent(\'click\', function(e) {
			e.stop();
			$$(\'div.qa_best_answer_form_open\').each(function(el2) {	
				el2.slide(\'out\').destroy();
			});
			var formEl = $(\'qa_best_answer_form\').clone();
			formEl.getElement(\'input.qa_aid\').setProperty(\'value\', el.get(\'xqa_aid\'))
			formEl.getElement(\'input.qa_rating\').setProperty(\'value\', 0)
			formEl.setStyle(\'display\',\'\');
			formEl.addClass(\'qa_best_answer_form_open\');
			formEl.inject($(el).getParent());
			formEl.slide(\'hide\');
			formEl.getParent().setStyle(\'clear\',\'both\');	
			formEl.slide(\'in\');
			
			$$(\'div.qa_best_answer_form_open img.qa_star\').each(function(imgEl) {	
				imgEl.addEvent(\'mouseover\', function(e) {
					e.stop();
					qaSetImgStars(imgEl.getParent(), imgEl.get(\'xqa_rating_num\'));
				});
				imgEl.addEvent(\'mouseout\', function(e) {
					e.stop();
					qaSetImgStars(imgEl.getParent(), formEl.getElement(\'input.qa_rating\').getProperty(\'value\'));
				});
				imgEl.addEvent(\'click\', function(e) {
					e.stop();
					formEl.getElement(\'input.qa_rating\').setProperty(\'value\', imgEl.get(\'xqa_rating_num\'))
				});		
			});

			formEl.getElement(\'input.qa_best_answer_cancel\').addEvent(\'click\', function(e) {
				e.stop();
				$$(\'div.qa_best_answer_form_open\').each(function(el2) {	
					el2.slide(\'out\').destroy();
				});	
			});

		});
	});
	'; 
 endif; 
 echo '

	qaTips = new Tips($$(\'.qaStars\'));

});


function qaFillStars(el) {
	el.set(\'html\',\'\');
	var rating_allowed = el.get(\'xqa_rating_allowed\');
	var has_rated = el.get(\'xqa_has_rated\');
	var answer_user_id = el.get(\'xqa_user_id\');
	var star_num = 1;
	for (i=0;i<qa_max_rating;i++) {
		var starEl = $(\'qa_rating_star_a\').clone();
		starEl.setStyle(\'display\',\'\');
		'; 
 if ($this->_tpl_vars['question']->state == @QA_STATE_RESOLVED): 
 echo '
		starEl.set(\'title\',"'; 
 echo SELanguage::_get(27003425); 
 echo '");
		'; 
 else: 
 echo '
		if (answer_user_id == \''; 
 echo $this->_tpl_vars['user']->user_info['user_id']; 
 echo '\') {
			starEl.set(\'title\',"'; 
 echo SELanguage::_get(27003420); 
 echo '");
		} else if (has_rated == 1) {
			starEl.set(\'title\',"'; 
 echo SELanguage::_get(27003421); 
 echo '");
		};
		'; 
 endif; 
 echo '
		var imgEl = starEl.getElement(\'img\');
		imgEl.set(\'xqa_rating_num\', star_num++);
		imgEl.set(\'width\', 16);
		imgEl.set(\'height\', 16);
		'; 
 if ($this->_tpl_vars['question']->state != @QA_STATE_RESOLVED): 
 echo '
		if (rating_allowed == 1) {
			imgEl.addEvent(\'mouseover\', function(e) {
				e.stop();
				if (el.get(\'xqa_rating_allowed\') == 1) {
					qaSetStars(el, this.get(\'xqa_rating_num\'));
				}
			});
			imgEl.addEvent(\'click\', function(e) {
				e.stop();
				if (el.get(\'xqa_rating_allowed\') == 1) {
					qaRate(el, this.get(\'xqa_rating_num\'));
				}
			});		
			imgEl.addEvent(\'mouseout\', function(e) {
				e.stop();
				var rating = el.get(\'xqa_rating\');
				qaSetStars(el, rating);
			});
		}
		'; 
 endif; 
 echo '
		starEl.inject($(el));
	}
}

function qaSetStars(el,rating) {
	var fulls = Math.floor(parseFloat(rating)+0.25);
	var partials = Math.floor(parseFloat(rating)+0.75) - fulls;
	el.getElements(\'a\').each(function(aEl) {
		imgEl=aEl.getElement(\'img\');
		var rating_num = imgEl.get(\'xqa_rating_num\');
		if (rating_num <= fulls) {
			imgEl.set(\'src\', preload_full.src);
		} else if (rating_num <= fulls + partials) {
			imgEl.set(\'src\', preload_partial.src);
		} else {
			imgEl.set(\'src\', preload_empty.src);
		} 
	});
}

function qaSetImgStars(el,rating) {
	var fulls = Math.floor(parseFloat(rating)+0.25);
	var partials = Math.floor(parseFloat(rating)+0.75) - fulls;
	el.getElements(\'img\').each(function(imgEl) {
		var rating_num = imgEl.get(\'xqa_rating_num\');
		if (rating_num <= fulls) {
			imgEl.set(\'src\', preload_full.src);
		} else if (rating_num <= fulls + partials) {
			imgEl.set(\'src\', preload_partial.src);
		} else {
			imgEl.set(\'src\', preload_empty.src);
		} 
	});
}

function qaRate(el, qa_rating) {
	qa_id = el.get(\'xqa_id\');
	qa_type = el.get(\'xqa_type\');
	var jsonRequest = new Request.JSON({url: "'; 
 echo $this->_tpl_vars['url']->url_base; 
 echo '/qa_rating.php", onSuccess: function(data){
    	if (data.error==\'\') {
	    	if (data.qa_reload==\'1\') {
				window.location.reload();
			} else {
			if (data.qa_rating_allowed == 1) {
				el.set(\'xqa_rating\',data.qa_rating_value);	
				el.set(\'xqa_rating_allowed\',0);	
				el.set(\'xqa_has_rated\',1);	
				qaFillStars(el);
				qaSetStars(el,data.qa_rating_value);
				qaTips = new Tips($$(\'.qaStars\'));
			}
			}
		} else {
			alert(data.error);
		}
	}}).get({\'qa_id\': qa_id, \'qa_type\': qa_type, \'qa_rating\': qa_rating, \'task\': \'rate\'});
}
//-->
</script>
'; 
 $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>