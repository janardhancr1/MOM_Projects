<?php /* Smarty version 2.6.14, created on 2010-05-31 03:22:27
         compiled from user_album_upload.tpl */
?><?php
SELanguage::_preload_multi(1000087,1000088,1000089,1000058,1000090,1000091,1000092);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<table cellpadding='0' cellspacing='0'>
<tr>
<td width='100%'>

  <img src='./images/icons/album_image48.gif' border='0' class='icon_big'>
  <div class='page_header'><?php echo SELanguage::_get(1000087); ?> <a href='<?php echo $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['user']->user_info['user_username'],$this->_tpl_vars['album_info']['album_id']); ?>
'><?php echo $this->_tpl_vars['album_info']['album_title']; ?>
</a></div>
  <div><?php echo SELanguage::_get(1000088); ?></div>

</td>
<td align='right' valign='top'>

  <table cellpadding='0' cellspacing='0' width='130'>
  <tr><td class='button' nowrap='nowrap'><a href='user_album_update.php?album_id=<?php echo $this->_tpl_vars['album_info']['album_id']; ?>
'><img src='./images/icons/back16.gif' border='0' class='button'><?php echo SELanguage::_get(1000089); ?></a></td></tr>
  </table>

</td>
</tr>
</table>

<br>

<div><?php echo sprintf(SELanguage::_get(1000058), $this->_tpl_vars['space_left']); ?><br><?php echo sprintf(SELanguage::_get(1000090), $this->_tpl_vars['allowed_exts']); ?><br><?php echo sprintf(SELanguage::_get(1000091), $this->_tpl_vars['max_filesize']); ?></div>

<?php if ($this->_tpl_vars['new_album'] == 1): ?>
  <br>
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='result'>
    <div class='success'><img src='./images/success.gif' border='0' class='icon'> <?php echo SELanguage::_get(1000092); ?></div>
  </td>
  </tr>
  </table>
<?php endif; ?>

<br>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'user_upload.tpl', 'smarty_include_vars' => array('action' => 'user_album_upload.php','session_id' => $this->_tpl_vars['session_id'],'upload_token' => $this->_tpl_vars['upload_token'],'show_uploader' => $this->_tpl_vars['show_uploader'],'inputs' => $this->_tpl_vars['inputs'],'file_result' => $this->_tpl_vars['file_result'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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