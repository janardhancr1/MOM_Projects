<?php /* Smarty version 2.6.14, created on 2010-06-24 16:18:55
         compiled from browse_answers.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars_decode', 'browse_answers.tpl', 138, false),array('modifier', 'count', 'browse_answers.tpl', 274, false),array('modifier', 'qa_state_name', 'browse_answers.tpl', 307, false),array('function', 'cycle', 'browse_answers.tpl', 231, false),)), $this);
?><?php
SELanguage::_preload_multi(27003123,27003433,27003435,27003437,27003436,27003460,27003461,27003462,27003048,27003400,27003401,27003402,27003403,27003404);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'><img src='./images/icons/ans_ans48.gif' border='0' class='icon_big'>Momburbia <?php echo SELanguage::_get(27003123); ?>
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
			<p><?php echo SELanguage::_get(27003433); ?></p>
			<textarea name='question_text' id='qa_question_text' ></textarea>
			<p>Tags - help moms find your question, i.e.</p>
			<input type='text' name='question_tags' id='qa_title_tag' maxlength='120'/>
			<p style='margin-bottom:5px'>Choose question category</p>
			<?php echo SELanguage::_get(27003435); ?>&nbsp;<select name='question_catid' id='cat_select' class="validate['required']">
			<option value='-1'><?php echo SELanguage::_get(27003437); ?></option>
			<?php $_from = $this->_tpl_vars['qacats_ask']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['qacat']):
?>
			<option value='<?php echo $this->_tpl_vars['qacat']['cat_id']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['qacat']['cat_title']); ?></option>
			<?php endforeach; endif; unset($_from); ?> 
			</select>  &nbsp;&nbsp;
			<br /><?php echo SELanguage::_get(27003436); ?>&nbsp;<select name='question_subcatid' id='subcat_select'></select><br/>
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

<?php if ($this->_tpl_vars['user']->level_info['level_qa_allow']): ?>
<div id='qa_question_form' >
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
	
	/*$(\'qa_ask_link\').addEvent(\'click\', function(e){
		e.stop();
		$(\'qa_question_form\').getParent().setStyle(\'clear\',\'both\');	
		questionSlide.slideIn();
	});

	$(\'qa_ask_cancel\').addEvent(\'click\', function(e){
		e.stop();
		questionSlide.slideOut();
	});*/

	$(\'cat_select\').addEvent(\'change\', function(e){
		updateSubcats();
	});
	
	$(\'qa_title_text\').addEvent(\'keyup\', function(e){
		updateTitleCnt();
	});

	updateSubcats();
	//updateTitleCnt();

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
 endif; ?>

<table cellpadding='0' cellspacing='0' width='100%' style='margin-top: 10px;'>
<tr>
<td style='width: 100%; vertical-align: top;'>
  <div style='margin-top: 10px; padding: 5px; background: #F2F2F2; border: 1px solid #BBBBBB; margin: 0px 0px 10px 0px; font-weight: bold;'>
  	<table width='100%'>
  	<tr>
  	<td valign='top'>
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
	<?php echo smarty_function_cycle(array('values' => ",,,,,,</td><td valign='top'>"), $this);?>

	<?php endfor; endif; ?>
	</td>
	</tr>
	</table>	
  </div>

	<?php if ($this->_tpl_vars['qa_ad_id'] > 0): ?>
	<?php echo $this->_tpl_vars['ads']->ads_display($this->_tpl_vars['qa_ad_id']); ?>

	<?php endif; ?>
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
     <?php if (count($this->_tpl_vars['recentquestions']) == 0): ?>
    <br>
    <table cellpadding='0' cellspacing='0' align='center'>
      <tr>
        <td class='result'>
          <img src='./images/icons/bulb16.gif' border='0' class='icon' />
          <?php echo SELanguage::_get(27003048); ?>
        </td>
      </tr>
    </table>
  <?php endif; ?>	
  <?php unset($this->_sections['question_loop']);
$this->_sections['question_loop']['name'] = 'question_loop';
$this->_sections['question_loop']['loop'] = is_array($_loop=$this->_tpl_vars['recentquestions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <div style='padding: 5px;'>
    <table cellpadding='0' cellspacing='0'>
      <tr>
        <td>
          <a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['recentquestions'][$this->_sections['question_loop']['index']]['question_author']->user_info['user_username']); ?>
'>
            <img src='<?php echo $this->_tpl_vars['recentquestions'][$this->_sections['question_loop']['index']]['question_author']->user_photo("./images/nophoto.gif",'TRUE'); ?>
' border='0' width='60' height='60' />
          </a>
        </td>
        <td style='vertical-align: top; padding-left: 10px;'>
          <div style='font-weight: bold; font-size: 10pt;'>
            <a href='<?php echo $this->_tpl_vars['url']->url_create('question',@NULL,$this->_tpl_vars['recentquestions'][$this->_sections['question_loop']['index']]['question_author']->user_info['user_username'],$this->_tpl_vars['recentquestions'][$this->_sections['question_loop']['index']]['question_id']); ?>
'>
              <?php echo $this->_tpl_vars['recentquestions'][$this->_sections['question_loop']['index']]['question_title']; ?>

            </a>
          </div>
          <div style='color: #777777; font-size: 7pt; margin-bottom: 5px;'>
          	<img src='./images/qa_li.gif' border='0' alt='' />
            <?php $this->assign('question_dateupdated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['recentquestions'][$this->_sections['question_loop']['index']]['question_time'])); ?>
            <?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['question_dateupdated'][0]), $this->_tpl_vars['question_dateupdated'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('updated', ob_get_contents());ob_end_clean(); ?>
            <?php ob_start(); ?><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['recentquestions'][$this->_sections['question_loop']['index']]['question_author']->user_info['user_username']); ?>
'><?php echo $this->_tpl_vars['recentquestions'][$this->_sections['question_loop']['index']]['question_author']->user_info['user_displayname']; ?>
</a><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('question_leader', ob_get_contents());ob_end_clean(); ?>
	  		<?php ob_start(); 
 echo SELanguage::_get($this->_tpl_vars['recentquestions'][$this->_sections['question_loop']['index']]['subcat_name_langid']); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('subcat_string_name', ob_get_contents());ob_end_clean(); ?>
            <?php ob_start(); ?><a href='<?php echo $this->_tpl_vars['url']->url_create('question_cat',@NULL,$this->_tpl_vars['recentquestions'][$this->_sections['question_loop']['index']]['question_subcat_id'],$this->_tpl_vars['subcat_string_name']); ?>
'><?php echo $this->_tpl_vars['subcat_string_name']; ?>
</a><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('question_cat', ob_get_contents());ob_end_clean(); ?>
            <?php echo sprintf(SELanguage::_get(27003400), $this->_tpl_vars['question_cat']); ?> - <?php echo sprintf(SELanguage::_get(27003401), $this->_tpl_vars['question_leader']); ?> - <?php if ($this->_tpl_vars['recentquestions'][$this->_sections['question_loop']['index']]['question_num_answers'] == 1): 
 echo sprintf(SELanguage::_get(27003402), $this->_tpl_vars['recentquestions'][$this->_sections['question_loop']['index']]['question_num_answers']); 
 else: 
 echo sprintf(SELanguage::_get(27003403), $this->_tpl_vars['recentquestions'][$this->_sections['question_loop']['index']]['question_num_answers']); 
 endif; ?> - <?php echo sprintf(SELanguage::_get(27003404), $this->_tpl_vars['updated']); ?> - <?php echo ((is_array($_tmp=$this->_tpl_vars['recentquestions'][$this->_sections['question_loop']['index']]['question_state'])) ? $this->_run_mod_handler('qa_state_name', true, $_tmp) : qa_state_name($_tmp)); ?>

          </div>
        </td>
      </tr>
    </table>
  </div>
  <?php endfor; endif; ?>
</div>
<div id='popular' style='display: none;'>
    <?php if (count($this->_tpl_vars['popularquestions']) == 0): ?>
    <br>
    <table cellpadding='0' cellspacing='0' align='center'>
      <tr>
        <td class='result'>
          <img src='./images/icons/bulb16.gif' border='0' class='icon' />
          <?php echo SELanguage::_get(27003048); ?>
        </td>
      </tr>
    </table>
  <?php endif; ?>	
  <?php unset($this->_sections['question_loop']);
$this->_sections['question_loop']['name'] = 'question_loop';
$this->_sections['question_loop']['loop'] = is_array($_loop=$this->_tpl_vars['popularquestions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <div style='padding: 5px;'>
    <table cellpadding='0' cellspacing='0'>
      <tr>
        <td>
          <a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['popularquestions'][$this->_sections['question_loop']['index']]['question_author']->user_info['user_username']); ?>
'>
            <img src='<?php echo $this->_tpl_vars['popularquestions'][$this->_sections['question_loop']['index']]['question_author']->user_photo("./images/nophoto.gif",'TRUE'); ?>
' border='0' width='60' height='60' />
          </a>
        </td>
        <td style='vertical-align: top; padding-left: 10px;'>
          <div style='font-weight: bold; font-size: 10pt;'>
            <a href='<?php echo $this->_tpl_vars['url']->url_create('question',@NULL,$this->_tpl_vars['popularquestions'][$this->_sections['question_loop']['index']]['question_author']->user_info['user_username'],$this->_tpl_vars['popularquestions'][$this->_sections['question_loop']['index']]['question_id']); ?>
'>
              <?php echo $this->_tpl_vars['popularquestions'][$this->_sections['question_loop']['index']]['question_title']; ?>

            </a>
          </div>
          <div style='color: #777777; font-size: 7pt; margin-bottom: 5px;'>
            <img src='./images/qa_li.gif' border='0' alt='' />
            <?php $this->assign('question_dateupdated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['popularquestions'][$this->_sections['question_loop']['index']]['question_time'])); ?>
            <?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['question_dateupdated'][0]), $this->_tpl_vars['question_dateupdated'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('updated', ob_get_contents());ob_end_clean(); ?>
            <?php ob_start(); ?><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['popularquestions'][$this->_sections['question_loop']['index']]['question_author']->user_info['user_username']); ?>
'><?php echo $this->_tpl_vars['popularquestions'][$this->_sections['question_loop']['index']]['question_author']->user_info['user_displayname']; ?>
</a><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('question_leader', ob_get_contents());ob_end_clean(); ?>
	  		<?php ob_start(); 
 echo SELanguage::_get($this->_tpl_vars['popularquestions'][$this->_sections['question_loop']['index']]['subcat_name_langid']); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('subcat_string_name', ob_get_contents());ob_end_clean(); ?>
            <?php ob_start(); ?><a href='<?php echo $this->_tpl_vars['url']->url_create('question_cat',@NULL,$this->_tpl_vars['popularquestions'][$this->_sections['question_loop']['index']]['question_subcat_id'],$this->_tpl_vars['subcat_string_name']); ?>
'><?php echo $this->_tpl_vars['subcat_string_name']; ?>
</a><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('question_cat', ob_get_contents());ob_end_clean(); ?>
            <?php echo sprintf(SELanguage::_get(27003400), $this->_tpl_vars['question_cat']); ?> - <?php echo sprintf(SELanguage::_get(27003401), $this->_tpl_vars['question_leader']); ?> - <?php if ($this->_tpl_vars['popularquestions'][$this->_sections['question_loop']['index']]['question_num_answers'] == 1): 
 echo sprintf(SELanguage::_get(27003402), $this->_tpl_vars['popularquestions'][$this->_sections['question_loop']['index']]['question_num_answers']); 
 else: 
 echo sprintf(SELanguage::_get(27003403), $this->_tpl_vars['popularquestions'][$this->_sections['question_loop']['index']]['question_num_answers']); 
 endif; ?> - <?php echo sprintf(SELanguage::_get(27003404), $this->_tpl_vars['updated']); ?> - <?php echo ((is_array($_tmp=$this->_tpl_vars['popularquestions'][$this->_sections['question_loop']['index']]['question_state'])) ? $this->_run_mod_handler('qa_state_name', true, $_tmp) : qa_state_name($_tmp)); ?>

          </div>
        </td>
      </tr>
    </table>
  </div>
  <?php endfor; endif; ?>
</div>

</div>

<?php echo '
    <script type=\'text/javascript\'>
    <!--
      var visible_tab = \'recent\';
      function loadTab(tabId)
      {
      	$(\'recent\').style.display = "none";
      	$(\'popular\').style.display = "none";
      	
      	$(tabId).style.display = "block";
      }
    //-->
    </script>
    '; 
 $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'rightside.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='clear: both; height: 10px;'></div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>