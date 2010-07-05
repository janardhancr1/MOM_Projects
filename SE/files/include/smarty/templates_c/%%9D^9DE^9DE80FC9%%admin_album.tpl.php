<?php /* Smarty version 2.6.14, created on 2010-05-26 07:17:06
         compiled from admin_album.tpl */
?><?php
SELanguage::_preload_multi(1000005,1000008,191,192,1000009,1000010,1000011,173);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h2><?php echo SELanguage::_get(1000005); ?></h2>
<?php echo SELanguage::_get(1000008); ?>

<br><br>

<?php if ($this->_tpl_vars['result'] != 0): ?>
  <div class='success'><img src='../images/success.gif' class='icon' border='0'> <?php echo SELanguage::_get(191); ?></div>
<?php endif; ?>

<form action='admin_album.php' method='POST'>


<table cellpadding='0' cellspacing='0' width='600'>
<td class='header'><?php echo SELanguage::_get(192); ?></td>
</tr>
<td class='setting1'>
  <?php echo SELanguage::_get(1000009); ?>
</td>
</tr>
<tr>
<td class='setting2'>
  <table cellpadding='2' cellspacing='0'>
  <tr>
  <td><input type='radio' name='setting_permission_album' id='permission_album_1' value='1'<?php if ($this->_tpl_vars['setting']['setting_permission_album'] == 1): ?> checked='checked'<?php endif; ?>></td>
  <td><label for='permission_album_1'><?php echo SELanguage::_get(1000010); ?></label></td>
  </tr>
  <tr>
  <td><input type='radio' name='setting_permission_album' id='permission_album_0' value='0'<?php if ($this->_tpl_vars['setting']['setting_permission_album'] == 0): ?> checked='checked'<?php endif; ?>></td>
  <td><label for='permission_album_0'><?php echo SELanguage::_get(1000011); ?></label></td>
  </tr>
  </table>
</td>
</tr>
</table>

<br>

<input type='submit' class='button' value='<?php echo SELanguage::_get(173); ?>'>
<input type='hidden' name='task' value='dosave'>
</form>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>