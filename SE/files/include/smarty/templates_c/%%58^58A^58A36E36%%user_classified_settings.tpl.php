<?php /* Smarty version 2.6.14, created on 2010-05-29 15:45:30
         compiled from user_classified_settings.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'unserialize', 'user_classified_settings.tpl', 59, false),array('modifier', 'in_array', 'user_classified_settings.tpl', 60, false),array('modifier', 'count', 'user_classified_settings.tpl', 60, false),)), $this);
?><?php
SELanguage::_preload_multi(4500115,4500116,4500102,191,4500117,4500118,4500119,4500120,173);
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
      
      <img src='./images/icons/classified_classified48.gif' border='0' class='icon_big' />
      <div class='page_header'><?php echo SELanguage::_get(4500115); ?></div>
      <div><?php echo SELanguage::_get(4500116); ?></div>
      
    </td>
    <td valign='top' align='right'>
      
      <table cellpadding='0' cellspacing='0'>
        <tr>
          <td class='button' nowrap='nowrap'>
            <a href='user_classified.php'><img src='./images/icons/back16.gif' border='0' class='button' /><?php echo SELanguage::_get(4500102); ?></a>
          </td>
        </tr>
      </table>
      
    </td>
  </tr>
</table>
<br />


<?php if ($this->_tpl_vars['result'] != 0): ?>
  <table cellpadding='0' cellspacing='0'>
    <tr>
      <td class='success'>
        <img src='./images/success.gif' border='0' class='icon' />
        <?php echo SELanguage::_get(191); ?>
      </td>
    </tr>
  </table>
<?php endif; ?>
<br />


<form action='user_classified_settings.php' method='post'>

<?php if ($this->_tpl_vars['user']->level_info['level_classified_style']): ?>
  <div><b><?php echo SELanguage::_get(4500117); ?></b></div>
  <div class='form_desc'><?php echo SELanguage::_get(4500118); ?></div>
  <textarea name='style_classified' rows='17' cols='50' style='width: 100%; font-family: courier, serif;'><?php echo $this->_tpl_vars['style_classified']; ?>
</textarea>
  <br />
  <br />
<?php endif; ?>

<div><b><?php echo SELanguage::_get(4500119); ?></b></div>
<br />

<?php $this->assign('comment_options', ((is_array($_tmp=$this->_tpl_vars['user']->level_info['level_blog_comments'])) ? $this->_run_mod_handler('unserialize', true, $_tmp) : unserialize($_tmp))); 
 if (! ( ((is_array($_tmp='0')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['comment_options']) : in_array($_tmp, $this->_tpl_vars['comment_options'])) ) || count($this->_tpl_vars['comment_options']) != 1): ?>
  <table cellpadding='0' cellspacing='0' class='editprofile_options'>
    <tr>
      <td><input type='checkbox' value='1' id='classifiedcomment' name='usersetting_notify_classifiedcomment'<?php if ($this->_tpl_vars['user']->usersetting_info['usersetting_notify_classifiedcomment']): ?> checked<?php endif; ?>></td>
      <td><label for='classifiedcomment'><?php echo SELanguage::_get(4500120); ?></label></td>
    </tr>
  </table>
  <br />
  <br />
<?php endif; 
 $this->assign('langBlockTemp', SE_Language::_get(173));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' /><?php 

  ?>
<input type='hidden' name='task' value='dosave' />
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