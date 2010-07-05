<?php /* Smarty version 2.6.14, created on 2010-05-26 13:51:44
         compiled from user_group_edit_settings.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'user_group_edit_settings.tpl', 19, false),array('modifier', 'count', 'user_group_edit_settings.tpl', 81, false),)), $this);
?><?php
SELanguage::_preload_multi(2000097,2000118,2000119,2000135,2000136,2000120,191,2000137,2000138,2000139,2000140,2000141,2000142,2000100,2000143,2000144,2000145,2000216,2000217,2000218,2000146,2000147,2000148,2000149,2000150,2000151,2000212,2000213,2000214,2000215,173);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<table class='tabs' cellpadding='0' cellspacing='0'>
  <tr>
    <td class='tab0'>&nbsp;</td>
    <td class='tab2' NOWRAP><a href='user_group_edit.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'><?php echo SELanguage::_get(2000097); ?></a></td><td class='tab'>&nbsp;</td>
    <td class='tab2' NOWRAP><a href='user_group_edit_members.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'><?php echo SELanguage::_get(2000118); ?></a></td><td class='tab'>&nbsp;</td>
    <td class='tab1' NOWRAP><a href='user_group_edit_settings.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'><?php echo SELanguage::_get(2000119); ?></a></td><td class='tab'>&nbsp;</td>
    <td class='tab3'>&nbsp;</td>
  </tr>
</table>

<table cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td valign='top'>
  <img src='./images/icons/group_edit48.gif' border='0' class='icon_big' />
  <?php ob_start(); ?><a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['group']->group_info['group_id']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['group']->group_info['group_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>
</a><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('linked_groupname', ob_get_contents());ob_end_clean(); ?>
  <div class='page_header'><?php echo sprintf(SELanguage::_get(2000135), $this->_tpl_vars['linked_groupname']); ?></div>
  <?php echo SELanguage::_get(2000136); ?>
</td>
<td valign='top' align='right'>
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='button'><a href='user_group.php'><img src='./images/icons/back16.gif' border='0' class='button' /><?php echo SELanguage::_get(2000120); ?></a></td></tr>
  </table>
</td>
</tr>
</table>

<br />

<?php if ($this->_tpl_vars['result'] != 0): ?>
  <table cellpadding='0' cellspacing='0'><tr>
  <td class='result'><img src='./images/success.gif' border='0' class='icon' /> <?php echo SELanguage::_get(191); ?></div></td>
  </tr></table>
  <br>
<?php endif; ?>

<form action='user_group_edit_settings.php' method='post'>

<?php if ($this->_tpl_vars['group']->groupowner_level_info['level_group_style'] == 1): ?>
  <div><b><?php echo SELanguage::_get(2000137); ?></b></div>
  <div class='form_desc'><?php echo SELanguage::_get(2000138); ?></div>
  <textarea name='style_group' rows='17' cols='50' style='width: 100%; font-family: courier, serif;'><?php echo $this->_tpl_vars['style_group']; ?>
</textarea>
  <br><br>
<?php endif; 
 if ($this->_tpl_vars['group']->groupowner_level_info['level_group_approval'] == 1): ?>
  <div><b><?php echo SELanguage::_get(2000139); ?></b></div>
  <div class='form_desc'><?php echo sprintf(SELanguage::_get(2000140), $this->_tpl_vars['group']->group_info['group_id']); 
 if ($this->_tpl_vars['group']->group_info['group_approval'] == 1): ?> <?php echo SELanguage::_get(2000141); 
 endif; ?></div>
  <table cellpadding='0' cellspacing='0'>
    <tr><td><input type='radio' name='group_approval' id='group_approval0' value='0'<?php if ($this->_tpl_vars['group']->group_info['group_approval'] == 0): ?> CHECKED<?php endif; ?>></td><td><label for='group_approval0'><?php echo SELanguage::_get(2000142); ?></label></td></tr>
    <tr><td><input type='radio' name='group_approval' id='group_approval1' value='1'<?php if ($this->_tpl_vars['group']->group_info['group_approval'] == 1): ?> CHECKED<?php endif; ?>></td><td><label for='group_approval1'><?php echo SELanguage::_get(2000100); ?></label></td></tr>
  </table>
  <br><br>
<?php endif; 
 if ($this->_tpl_vars['group']->groupowner_level_info['level_group_search'] == 1): ?>
  <div><b><?php echo SELanguage::_get(2000143); ?></b></div>
  <table cellpadding='0' cellspacing='0'>
    <tr><td><input type='radio' name='group_search' id='group_search_1' value='1'<?php if ($this->_tpl_vars['group']->group_info['group_search'] == 1): ?> CHECKED<?php endif; ?>></td><td><label for='group_search_1'><?php echo SELanguage::_get(2000144); ?></label></td></tr>
    <tr><td><input type='radio' name='group_search' id='group_search_0' value='0'<?php if ($this->_tpl_vars['group']->group_info['group_search'] == 0): ?> CHECKED<?php endif; ?>></td><td><label for='group_search_0'><?php echo SELanguage::_get(2000145); ?></label></td></tr>
  </table>
  <br><br>
<?php endif; ?>

<div><b><?php echo SELanguage::_get(2000216); ?></b></div>
<table cellpadding='0' cellspacing='0'>
  <tr><td><input type='radio' name='group_invite' id='group_invite_1' value='1'<?php if ($this->_tpl_vars['group']->group_info['group_invite'] == 1): ?> CHECKED<?php endif; ?>></td><td><label for='group_invite_1'><?php echo SELanguage::_get(2000217); ?></label></td></tr>
  <tr><td><input type='radio' name='group_invite' id='group_invite_0' value='0'<?php if ($this->_tpl_vars['group']->group_info['group_invite'] == 0): ?> CHECKED<?php endif; ?>></td><td><label for='group_invite_0'><?php echo SELanguage::_get(2000218); ?></label></td></tr>
</table>
<br><br>

<?php if (count($this->_tpl_vars['privacy_options']) > 1): ?>
  <div><b><?php echo SELanguage::_get(2000146); ?></b></div>
  <div class='form_desc'><?php echo SELanguage::_get(2000147); ?></div>
  <table cellpadding='0' cellspacing='0'>
  <?php $_from = $this->_tpl_vars['privacy_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['privacy_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['privacy_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['privacy_loop']['iteration']++;
?>
    <tr>
    <td><input type='radio' name='group_privacy' id='privacy_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['group']->group_info['group_privacy'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
    <td><label for='privacy_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
  </table>
  <br><br>
<?php endif; 
 if (count($this->_tpl_vars['comment_options']) > 1): ?>
  <div><b><?php echo SELanguage::_get(2000148); ?></b></div>
  <div class='form_desc'><?php echo SELanguage::_get(2000149); ?></div>
  <table cellpadding='0' cellspacing='0'>
  <?php $_from = $this->_tpl_vars['comment_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['comment_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['comment_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['comment_loop']['iteration']++;
?>
    <tr>
    <td><input type='radio' name='group_comments' id='comment_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['group']->group_info['group_comments'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
    <td><label for='comment_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
  </table>
  <br><br>
<?php endif; 
 if (count($this->_tpl_vars['discussion_options']) > 1): ?>
  <div><b><?php echo SELanguage::_get(2000150); ?></b></div>
  <div class='form_desc'><?php echo SELanguage::_get(2000151); ?></div>
  <table cellpadding='0' cellspacing='0'>
  <?php $_from = $this->_tpl_vars['discussion_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['discussion_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['discussion_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['discussion_loop']['iteration']++;
?>
    <tr>
    <td><input type='radio' name='group_discussion' id='discussion_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['group']->group_info['group_discussion'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
    <td><label for='discussion_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
  </table>
  <br><br>
<?php endif; 
 if (count($this->_tpl_vars['upload_options']) > 1): ?>
  <div><b><?php echo SELanguage::_get(2000212); ?></b></div>
  <div class='form_desc'><?php echo SELanguage::_get(2000213); ?></div>
  <table cellpadding='0' cellspacing='0'>
  <?php $_from = $this->_tpl_vars['upload_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['upload_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['upload_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['upload_loop']['iteration']++;
?>
    <tr>
    <td><input type='radio' name='group_upload' id='upload_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['group']->group_info['group_upload'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
    <td><label for='upload_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
  </table>
  <br><br>
<?php endif; 
 if (count($this->_tpl_vars['tag_options']) > 1): ?>
  <div><b><?php echo SELanguage::_get(2000214); ?></b></div>
  <div class='form_desc'><?php echo SELanguage::_get(2000215); ?></div>
  <table cellpadding='0' cellspacing='0'>
  <?php $_from = $this->_tpl_vars['tag_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tag_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tag_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['tag_loop']['iteration']++;
?>
    <tr>
    <td><input type='radio' name='groupalbum_tag' id='tag_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['groupalbum_info']['groupalbum_tag'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
    <td><label for='tag_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
  </table>
  <br><br>
<?php endif; ?>

<input type='submit' class='button' value='<?php echo SELanguage::_get(173); ?>'>
<input type='hidden' name='group_id' value='<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'>
<input type='hidden' name='task' value='dosave'>
</form>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
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