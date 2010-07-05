<?php /* Smarty version 2.6.14, created on 2010-05-29 15:49:26
         compiled from user_recipe_upload.tpl */
?><?php
SELanguage::_preload_multi(1000088);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class='page_header'>Add Recipe Photo - <a href='recipe.php?user=<?php echo $this->_tpl_vars['recipe_info']['user_name']; ?>
&recipe_id=<?php echo $this->_tpl_vars['recipe_info']['recipe_id']; ?>
'><?php echo $this->_tpl_vars['recipe_info']['recipe_name']; ?>
</a></div>

<table cellpadding='0' cellspacing='0' style="padding:0px 2px 0px 2px">
<tr>
<td width='100%'>
  <div><?php echo SELanguage::_get(1000088); ?></div>
</td>
<td align='right' valign='top'>

  <table cellpadding='0' cellspacing='0' width='130'>
  <tr><td class='button' nowrap='nowrap'><a href='recipe.php?user=<?php echo $this->_tpl_vars['recipe_info']['user_name']; ?>
&recipe_id=<?php echo $this->_tpl_vars['recipe_info']['recipe_id']; ?>
'><img src='./images/icons/back16.gif' border='0' class='button'>Back to Recipe</a></td></tr>
  </table>

</td>
</tr>
<tr>
	<td colspan="2">You may upload files of the following types: jpg, gif, jpeg, png, bmp
	<br>You may upload files with sizes up to 2000 KB.</td>	
</tr>
<tr>
	<td colspan="2">&nbsp;</td>	
</tr>
</table>
<form action="" method="post" enctype='multipart/form-data'>
<input type="hidden" name="task" value="doupload">
<table cellpadding='0' cellspacing='0' style="padding:0px 2px 0px 2px">
<tr>
	<td width="10%">&nbsp;</td>
	<td widht="90%"><input type="file" name="recipe_photo" size='60' class='text'></td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>	
</tr>
<tr>
	<td colspan="2" align="center"><input type='submit' class='button' name='submit' value='Upload' id='fallback_submit'></td>	
</tr>
</table>
</form>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>