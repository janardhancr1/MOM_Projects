<?php /* Smarty version 2.6.14, created on 2010-05-26 07:17:50
         compiled from admin_forumsettings.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'substr', 'admin_forumsettings.tpl', 75, false),)), $this);
?><?php
SELanguage::_preload_multi(6000030,6000031,191,6000035,6000036,6000037,6000038,6000039,192,6000032,6000033,6000034,6000040,6000041,6000042,6000043,6000044,6000045,6000046,6000047,6000048,6000049,6000050,6000051,173);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo SELanguage::_get(6000030); ?></h2>
<?php echo SELanguage::_get(6000031); ?>
<br />
<br />







<?php if ($this->_tpl_vars['result'] != 0): ?>
  <div class='success'><img src='../images/success.gif' class='icon' border='0'> <?php echo SELanguage::_get(191); ?></div>
<?php endif; ?>


<form action='admin_forumsettings.php' method='POST'>


<table cellpadding='0' cellspacing='0' width='600'>
<tr>
<td class='header'><?php echo SELanguage::_get(6000035); ?></td>
</tr>
<td class='setting1'>
<?php echo SELanguage::_get(6000036); ?>
</td></tr><tr><td class='setting2'>
  <table cellpadding='0' cellspacing='0'>
  <tr><td><input type='radio' name='setting_forum_status' id='status_1' value='1'<?php if ($this->_tpl_vars['setting']['setting_forum_status'] == 1): ?> CHECKED<?php endif; ?>>&nbsp;</td><td><label for='status_1'><?php echo SELanguage::_get(6000037); ?></label></td></tr>
  <tr><td><input type='radio' name='setting_forum_status' id='status_2' value='2'<?php if ($this->_tpl_vars['setting']['setting_forum_status'] == 2): ?> CHECKED<?php endif; ?>>&nbsp;</td><td><label for='status_2'><?php echo SELanguage::_get(6000038); ?></label></td></tr>
  <tr><td><input type='radio' name='setting_forum_status' id='status_0' value='0'<?php if ($this->_tpl_vars['setting']['setting_forum_status'] == 0): ?> CHECKED<?php endif; ?>>&nbsp;</td><td><label for='status_0'><?php echo SELanguage::_get(6000039); ?></label></td></tr>
  </table>
</td></tr></table>

<br>

<table cellpadding='0' cellspacing='0' width='600'>
<td class='header'><?php echo SELanguage::_get(192); ?></td>
</tr>
<td class='setting1'>
  <?php echo SELanguage::_get(6000032); ?>
</td>
</tr>
<tr>
<td class='setting2'>
  <table cellpadding='2' cellspacing='0'>
  <tr>
  <td><input type='radio' name='setting_permission_forum' id='permission_forum_1' value='1'<?php if ($this->_tpl_vars['setting']['setting_permission_forum'] == 1): ?> CHECKED<?php endif; ?>></td>
  <td><label for='permission_forum_1'><?php echo SELanguage::_get(6000033); ?></label></td>
  </tr>
  <tr>
  <td><input type='radio' name='setting_permission_forum' id='permission_forum_0' value='0'<?php if ($this->_tpl_vars['setting']['setting_permission_forum'] == 0): ?> CHECKED<?php endif; ?>></td>
  <td><label for='permission_forum_0'><?php echo SELanguage::_get(6000034); ?></label></td>
  </tr>
  </table>
</td>
</tr>
</table>

<br>

<table cellpadding='0' cellspacing='0' width='600'>
<td class='header'><?php echo SELanguage::_get(6000040); ?></td>
</tr>
<td class='setting1'>
  <?php echo SELanguage::_get(6000041); ?>
</td>
</tr>
<tr>
<td class='setting2'>
  <?php echo SELanguage::_get(6000042); ?>
  <table cellpadding='2' cellspacing='0'>
  <tr>
  <td><input type='checkbox' name='setting_forum_modprivs[0]' id='modprivs_edit' value='1'<?php if (((is_array($_tmp=$this->_tpl_vars['setting']['setting_forum_modprivs'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 1) : substr($_tmp, 0, 1)) == 1): ?> CHECKED<?php endif; ?>></td>
  <td><label for='modprivs_edit'><?php echo SELanguage::_get(6000043); ?></label></td>
  </tr>
  <tr>
  <td><input type='checkbox' name='setting_forum_modprivs[1]' id='modprivs_delete' value='1'<?php if (((is_array($_tmp=$this->_tpl_vars['setting']['setting_forum_modprivs'])) ? $this->_run_mod_handler('substr', true, $_tmp, 1, 1) : substr($_tmp, 1, 1)) == 1): ?> CHECKED<?php endif; ?>></td>
  <td><label for='modprivs_delete'><?php echo SELanguage::_get(6000044); ?></label></td>
  </tr>
  <tr>
  <td><input type='checkbox' name='setting_forum_modprivs[2]' id='modprivs_move' value='1'<?php if (((is_array($_tmp=$this->_tpl_vars['setting']['setting_forum_modprivs'])) ? $this->_run_mod_handler('substr', true, $_tmp, 2, 1) : substr($_tmp, 2, 1)) == 1): ?> CHECKED<?php endif; ?>></td>
  <td><label for='modprivs_move'><?php echo SELanguage::_get(6000045); ?></label></td>
  </tr>
  <tr>
  <td><input type='checkbox' name='setting_forum_modprivs[3]' id='modprivs_close' value='1'<?php if (((is_array($_tmp=$this->_tpl_vars['setting']['setting_forum_modprivs'])) ? $this->_run_mod_handler('substr', true, $_tmp, 3, 1) : substr($_tmp, 3, 1)) == 1): ?> CHECKED<?php endif; ?>></td>
  <td><label for='modprivs_close'><?php echo SELanguage::_get(6000046); ?></label></td>
  </tr>
  <tr>
  <td><input type='checkbox' name='setting_forum_modprivs[4]' id='modprivs_sticky' value='1'<?php if (((is_array($_tmp=$this->_tpl_vars['setting']['setting_forum_modprivs'])) ? $this->_run_mod_handler('substr', true, $_tmp, 4, 1) : substr($_tmp, 4, 1)) == 1): ?> CHECKED<?php endif; ?>></td>
  <td><label for='modprivs_sticky'><?php echo SELanguage::_get(6000047); ?></label></td>
  </tr>
  </table>
</td>
</tr>
</table>

<br>

<table cellpadding='0' cellspacing='0' width='600'>
<tr>
<td class='header'><?php echo SELanguage::_get(6000048); ?></td>
</tr>
<td class='setting1'>
<?php echo SELanguage::_get(6000049); ?>
</td></tr><tr><td class='setting2'>
  <table cellpadding='0' cellspacing='0'>
  <tr><td><input type='radio' name='setting_forum_code' id='code_1' value='1'<?php if ($this->_tpl_vars['setting']['setting_forum_code'] == 1): ?> CHECKED<?php endif; ?>>&nbsp;</td><td><label for='code_1'><?php echo SELanguage::_get(6000050); ?></label></td></tr>
  <tr><td><input type='radio' name='setting_forum_code' id='code_0' value='0'<?php if ($this->_tpl_vars['setting']['setting_forum_code'] == 0): ?> CHECKED<?php endif; ?>>&nbsp;</td><td><label for='code_0'><?php echo SELanguage::_get(6000051); ?></label></td></tr>
  </table>
</td></tr></table>
  
<br>

<input type='submit' class='button' value='<?php echo SELanguage::_get(173); ?>'>
<input type='hidden' name='task' value='dosave'>
</form>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>