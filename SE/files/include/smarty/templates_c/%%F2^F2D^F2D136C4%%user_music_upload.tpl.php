<?php /* Smarty version 2.6.14, created on 2010-06-02 16:49:34
         compiled from user_music_upload.tpl */
?><?php
SELanguage::_preload_multi(4000067,4000068,4000069,4000073,4000072,4000070,4000071);
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
      
      <img src='./images/icons/music_music48.gif' border='0' class='icon_big'>
      <div class='page_header'><?php echo SELanguage::_get(4000067); ?></div>
      <div><?php echo SELanguage::_get(4000068); ?></div>
      
    </td>
    <td valign='top' align='right'>
      
      <table cellpadding='0' cellspacing='0' width='150'>
      <tr><td class='button' nowrap='nowrap'><a href='user_music.php'><img src='./images/icons/back16.gif' border='0' class='button'><?php echo SELanguage::_get(4000069); ?></a></td></tr>
      </table>
      
    </td>
  </tr>
</table>
<br />


<?php if ($this->_tpl_vars['files_left'] > 0): ?>

  <div style='float:left;'><img src='./images/icons/bulb16.gif' border='0' class='icon'></div><div style='float:left;'><b><?php echo SELanguage::_get(4000073); ?></b></div><br><br>


  <div>
    <?php echo sprintf(SELanguage::_get(4000072), $this->_tpl_vars['space_left']); ?><br />
    <?php echo sprintf(SELanguage::_get(4000070), $this->_tpl_vars['max_filesize']); ?><br />
    <?php echo sprintf(SELanguage::_get(4000071), $this->_tpl_vars['allowed_exts']); ?>
  </div>
  <br />
  <br />


  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'user_upload.tpl', 'smarty_include_vars' => array('action' => 'user_music_upload.php','session_id' => $this->_tpl_vars['session_id'],'upload_token' => $this->_tpl_vars['upload_token'],'show_uploader' => $this->_tpl_vars['show_uploader'],'inputs' => $this->_tpl_vars['inputs'],'file_result' => $this->_tpl_vars['file_result'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 
 endif; ?>

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