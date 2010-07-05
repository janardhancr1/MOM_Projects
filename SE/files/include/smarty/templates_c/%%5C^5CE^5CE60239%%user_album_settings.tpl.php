<?php /* Smarty version 2.6.14, created on 2010-05-26 12:15:31
         compiled from user_album_settings.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'user_album_settings.tpl', 44, false),)), $this);
?><?php
SELanguage::_preload_multi(1000056,1000111,1000097,191,1000112,1000113,1000106,1000110,1000108,1000109,173,39);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<table cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td valign='top'>

  <img src='./images/icons/album_image48.gif' border='0' class='icon_big'>
  <div class='page_header'><?php echo SELanguage::_get(1000056); ?></div>
  <div><?php echo SELanguage::_get(1000111); ?></div>

</td>
<td valign='top' align='right'>

  <table cellpadding='0' cellspacing='0' width='130'>
  <tr><td class='button' nowrap='nowrap'><a href='user_album.php'><img src='./images/icons/back16.gif' border='0' class='button'><?php echo SELanguage::_get(1000097); ?></a></td></tr>
  </table>

</td>
</tr>
</table>

<br>

<?php if ($this->_tpl_vars['result'] != 0): ?>
  <table cellpadding='0' cellspacing='0'>
  <tr>
  <td class='success'><img src='./images/success.gif' border='0' class='icon'> <?php echo SELanguage::_get(191); ?></td>
  </tr>
  </table><br>
<?php endif; ?>

<form action='user_album_settings.php' method='post'>

<?php if ($this->_tpl_vars['user']->level_info['level_album_style'] == 1): ?>
  <div><b><?php echo SELanguage::_get(1000112); ?></b></div>
  <div class='form_desc'><?php echo SELanguage::_get(1000113); ?></div>
  <textarea name='style_album' rows='17' cols='50' style='width: 100%; font-family: courier, serif;'><?php echo $this->_tpl_vars['style_album']; ?>
</textarea>
  <br><br>
<?php endif; 
 if (count($this->_tpl_vars['level_album_profile']) > 1): ?>
  <div><b><?php echo SELanguage::_get(1000106); ?></b></div>
  <div class='form_desc'><?php echo SELanguage::_get(1000110); ?></div>
  <table cellpadding='0' cellspacing='0' class='editprofile_options'>
  <tr><td><input type='radio' value='tab' id='user_profile_album_tab' name='user_profile_album'<?php if ($this->_tpl_vars['user']->user_info['user_profile_album'] == 'tab'): ?> CHECKED<?php endif; ?>></td><td><label for='user_profile_album_tab'><?php echo SELanguage::_get(1000108); ?></label></td></tr>
  <tr><td><input type='radio' value='side' id='user_profile_album_side' name='user_profile_album'<?php if ($this->_tpl_vars['user']->user_info['user_profile_album'] == 'side'): ?> CHECKED<?php endif; ?>></td><td><label for='user_profile_album_side'><?php echo SELanguage::_get(1000109); ?></label></td></tr>
  </table>
  <br>
<?php endif; ?>

<table cellpadding='0' cellspacing='0'>
<tr>
<td>
  <input type='submit' class='button' value='<?php echo SELanguage::_get(173); ?>'>&nbsp;
  <input type='hidden' name='task' value='dosave'>
  </form>
</td>
<td>
  <form action='user_album.php' method='get'>
  <input type='submit' class='button' value='<?php echo SELanguage::_get(39); ?>'>
</td>
</tr>
</table>
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