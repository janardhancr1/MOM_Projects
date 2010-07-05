<?php /* Smarty version 2.6.14, created on 2010-05-26 07:18:02
         compiled from admin_recipe.tpl */
?><?php
SELanguage::_preload_multi(7000001,7000026,191,192,7000023,7000024,7000025,7000109,7000110,173);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h2><?php echo SELanguage::_get(7000001); ?></h2>
<?php echo SELanguage::_get(7000026); ?>
<br />
<br />

<?php if ($this->_tpl_vars['result'] == 1): ?>
  <div class='success'><img src='../images/success.gif' class='icon' border='0'> <?php echo SELanguage::_get(191); ?></div>
<?php endif; ?>

<form action='admin_poll.php' method='post'>


<table cellpadding='0' cellspacing='0' width='600'>
  <tr>
    <td class='header'><?php echo SELanguage::_get(192); ?></td>
  </tr>
  <tr>
    <td class='setting1'><?php echo SELanguage::_get(7000023); ?></td>
  </tr>
<tr>
<td class='setting2'>
  <table cellpadding='2' cellspacing='0'>
  <tr>
    <td><input type='radio' name='setting_permission_poll' id='setting_poll_enabled_1' value='1'<?php if ($this->_tpl_vars['setting']['setting_permission_poll']): ?> CHECKED<?php endif; ?>></td>
    <td><label for='setting_poll_enabled_1'><?php echo SELanguage::_get(7000024); ?></label></td>
  </tr>
  <tr>
    <td><input type='radio' name='setting_permission_poll' id='setting_poll_enabled_0' value='0'<?php if (! $this->_tpl_vars['setting']['setting_permission_poll']): ?> CHECKED<?php endif; ?>></td>
    <td><label for='setting_poll_enabled_0'><?php echo SELanguage::_get(7000025); ?></label></td>
  </tr>
  </table>
</td>
</tr>
</table>
<br />



<table cellpadding='0' cellspacing='0' width='600'>
  <tr>
    <td class='header'><?php echo SELanguage::_get(7000109); ?></td>
  </tr>
  <tr>
    <td class='setting1'><?php echo SELanguage::_get(7000110); ?></td>
  </tr>
  <tr>
    <td class='setting2'><input type='text' class='text' name='setting_poll_html' value='<?php echo $this->_tpl_vars['setting']['setting_poll_html']; ?>
' maxlength='250' size='60' /></td>
  </tr>
</table>
<br />



<?php $this->assign('langBlockTemp', SE_Language::_get(173));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
'><?php 

  ?>
<input type='hidden' name='task' value='dosave'>


</form>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>