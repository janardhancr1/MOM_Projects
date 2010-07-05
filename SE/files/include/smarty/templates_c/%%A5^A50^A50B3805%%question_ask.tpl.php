<?php /* Smarty version 2.6.14, created on 2010-05-31 16:52:14
         compiled from question_ask.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars_decode', 'question_ask.tpl', 40, false),)), $this);
?><?php
SELanguage::_preload_multi(27003432,27003434,27003433,27003435,27003437,27003436,27003431,27003460,27003461,27003462);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



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
	<?php $_from = $this->_tpl_vars['qacats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['qacat']):
?>
	<option value='<?php echo $this->_tpl_vars['qacat']['cat_id']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['qacat']['cat_title']); ?></option>
	<?php endforeach; endif; unset($_from); ?> 
	</select>  &nbsp;&nbsp;<?php echo SELanguage::_get(27003436); ?>&nbsp;<select name='question_subcatid' id='subcat_select'></select><br/>
	<input type="submit" class='button' value='<?php echo SELanguage::_get(27003431); ?>'  id='qa_submit'/> 
	</form>
	</div>
	<?php endif; 
 if ($this->_tpl_vars['user']->level_info['level_qa_allow']): ?>
<link media="screen" type="text/css" href="include/js/formcheck/theme/classic/formcheck.css" rel="stylesheet" /> 
<script type="text/javascript" src="include/js/formcheck/formcheck.js"></script> 
<script type='text/javascript'>
<!--
var cats = [
<?php $_from = $this->_tpl_vars['qacats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cats'] = array('total' => count($_from), 'iteration' => 0);
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
	
	$(\'cat_select\').addEvent(\'change\', function(e){
		updateSubcats();
	});
	
	$(\'qa_title_text\').addEvent(\'keyup\', function(e){
		updateTitleCnt();
	});

	updateSubcats();
	updateTitleCnt();

    new FormCheck(\'qa_ask\', {
            display : {
                titlesInsteadNames : false,
				indicateErrors: 2
            }
		});
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
 $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>