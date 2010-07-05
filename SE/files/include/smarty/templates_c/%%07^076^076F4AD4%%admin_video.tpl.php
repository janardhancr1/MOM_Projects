<?php /* Smarty version 2.6.14, created on 2010-05-26 07:18:10
         compiled from admin_video.tpl */
?><?php
SELanguage::_preload_multi(5500117,5500118,191,192,5500119,5500120,5500121,5500122,5500123,5500124,5500125,5500126,5500127,5500128,5500129,5500132,5500131,5500130,5500133,5500134,5500135,5500136,5500137,5500138,5500139,173);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>






<h2><?php echo SELanguage::_get(5500117); ?></h2>
<?php echo SELanguage::_get(5500118); ?>
<br />
<br />

<?php if ($this->_tpl_vars['result'] != 0): ?>
  <div class='success'><img src='../images/success.gif' class='icon' border='0'> <?php echo SELanguage::_get(191); ?></div>
<?php endif; ?>

<form action='admin_video.php' method='POST'>


<table cellpadding='0' cellspacing='0' width='600'>
<td class='header'><?php echo SELanguage::_get(192); ?></td>
</tr>
<td class='setting1'>
  <?php echo SELanguage::_get(5500119); ?>
</td>
</tr>
<tr>
<td class='setting2'>
  <table cellpadding='2' cellspacing='0'>
  <tr>
  <td><input type='radio' name='setting_permission_video' id='permission_video_1' value='1'<?php if ($this->_tpl_vars['setting']['setting_permission_video'] == 1): ?> checked='checked'<?php endif; ?>></td>
  <td><label for='permission_video_1'><?php echo SELanguage::_get(5500120); ?></label></td>
  </tr>
  <tr>
  <td><input type='radio' name='setting_permission_video' id='permission_video_0' value='0'<?php if ($this->_tpl_vars['setting']['setting_permission_video'] == 0): ?> checked='checked'<?php endif; ?>></td>
  <td><label for='permission_video_0'><?php echo SELanguage::_get(5500121); ?></label></td>
  </tr>
  </table>
</td>
</tr>
</table>

<br>

<table cellpadding='0' cellspacing='0' width='600'>
<tr>
<td class='header'><?php echo SELanguage::_get(5500122); ?></td>
</tr>
<tr>
<td class='setting1'>
<?php echo SELanguage::_get(5500123); ?>
</td>
</tr>
<tr>
<td class='setting2'>
<input type='text' class='text' name='setting_video_ffmpeg_path' value='<?php echo $this->_tpl_vars['setting']['setting_video_ffmpeg_path']; ?>
' maxlength='255' size='60'>
</td>
</tr>
</table>


<br>

<table cellpadding='0' cellspacing='0' width='600'>
<tr>
<td class='header'><?php echo SELanguage::_get(5500124); ?></td>
</tr>
<tr>
<td class='setting1'>
<?php echo SELanguage::_get(5500125); ?> <br>
<?php echo SELanguage::_get(5500126); ?>
</td>
</tr>
<tr>
<td class='setting2'>
<textarea name='setting_video_mimes' rows='3' cols='40' class='text' style='width: 100%;'><?php echo $this->_tpl_vars['setting']['setting_video_mimes']; ?>
</textarea>
</td>
</tr>
<tr>
<td class='setting1'>
<?php echo SELanguage::_get(5500127); ?><br>
<?php echo SELanguage::_get(5500126); ?>
</td>
</tr>
<tr>
<td class='setting2'>
<textarea name='setting_video_exts' rows='3' cols='40' class='text' style='width: 100%;'><?php echo $this->_tpl_vars['setting']['setting_video_exts']; ?>
</textarea>
</td>
</tr>
</table>


<br>

<table cellpadding='0' cellspacing='0' width='600'>
<tr>
<td class='header'><?php echo SELanguage::_get(5500128); ?></td>
</tr>
<tr>
<td class='setting1'>
<?php echo SELanguage::_get(5500129); ?>
</td>
</tr>
<tr>
<td class='setting2'>
<?php echo SELanguage::_get(5500132); ?>: <input type='text' class='text' name='setting_video_width' value='<?php echo $this->_tpl_vars['setting']['setting_video_width']; ?>
' maxlength='4' size='5'>px &nbsp; <?php echo SELanguage::_get(5500131); ?>: <input type='text' class='text' name='setting_video_height' value='<?php echo $this->_tpl_vars['setting']['setting_video_height']; ?>
' maxlength='4' size='5'>px 
</td>
</tr>
<tr>
<td class='setting1'>
<?php echo SELanguage::_get(5500130); ?>
</td>
</tr>
<tr>
<td class='setting2'>
<?php echo SELanguage::_get(5500132); ?>: <input type='text' class='text' name='setting_video_thumb_width' value='<?php echo $this->_tpl_vars['setting']['setting_video_thumb_width']; ?>
' maxlength='4' size='5'>px &nbsp; <?php echo SELanguage::_get(5500131); ?>: <input type='text' class='text' name='setting_video_thumb_height' value='<?php echo $this->_tpl_vars['setting']['setting_video_thumb_height']; ?>
' maxlength='4' size='5'>px 
</td>
</tr>
</table>


<br>

<table cellpadding='0' cellspacing='0' width='600'>
<tr>
<td class='header'><?php echo SELanguage::_get(5500133); ?></td>
</tr>
<tr>
<td class='setting1'>
<?php echo SELanguage::_get(5500134); ?>
</td>
</tr>
<tr>
<td class='setting2'>
<input type='text' class='text' name='setting_video_max_jobs' value='<?php echo $this->_tpl_vars['setting']['setting_video_max_jobs']; ?>
' maxlength='5' size='4'> <?php echo SELanguage::_get(5500135); ?>
</td>
</tr>
</table>

<br>


<table cellpadding='0' cellspacing='0' width='600'>
<td class='header'><?php echo SELanguage::_get(5500136); ?></td>
</tr>
<td class='setting1'>
  <?php echo SELanguage::_get(5500137); ?>
</td>
</tr>
<tr>
<td class='setting2'>
  <table cellpadding='2' cellspacing='0'>
  <tr>
  <td><input type='radio' name='setting_video_cronjob' id='setting_video_cronjob_1' value='1'<?php if ($this->_tpl_vars['setting']['setting_video_cronjob'] == 1): ?> checked='checked'<?php endif; ?>></td>
  <td><label for='setting_video_cronjob_1'><?php echo SELanguage::_get(5500138); ?></label></td>
  </tr>
  <tr>
  <td><input type='radio' name='setting_video_cronjob' id='setting_video_cronjob_0' value='0'<?php if ($this->_tpl_vars['setting']['setting_video_cronjob'] == 0): ?> checked='checked'<?php endif; ?>></td>
  <td><label for='setting_video_cronjob_0'><?php echo SELanguage::_get(5500139); ?></label></td>
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