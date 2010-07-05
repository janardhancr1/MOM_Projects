<?php /* Smarty version 2.6.14, created on 2010-05-31 03:05:39
         compiled from user_poll_edit.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'user_poll_edit.tpl', 48, false),)), $this);
?><?php
SELanguage::_preload_multi(2500057,2500058,2500070,2500059,2500060,2500061,2500062,2500063,2500064,2500065,2500066,39);
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

  <img src='./images/icons/poll_poll48.gif' border='0' class='icon_big'>
  <div class='page_header'><?php echo SELanguage::_get(2500057); ?></div>
  <div><?php echo SELanguage::_get(2500058); ?></div>

</td>
<td valign='top' align='right'>

  <table cellpadding='0' cellspacing='0' width='130'>
  <tr><td class='button' nowrap='nowrap'><a href='user_poll.php'><img src='./images/icons/back16.gif' border='0' class='button'><?php echo SELanguage::_get(2500070); ?></a></td></tr>
  </table>

</td>
</tr>
</table>
<br />


<?php if (! empty ( $this->_tpl_vars['is_error'] )): ?>
  <table cellpadding='0' cellspacing='0'><tr>
    <td class='error'><img src='./images/error.gif' border='0' class='icon'><?php echo SELanguage::_get($this->_tpl_vars['is_error']); ?></td>
  </tr></table>
  <br />
<?php endif; ?>


<form action='user_poll_edit.php' method='post'>

<table cellpadding='0' cellspacing='0'>
  <tr>
    <td class='form1'><?php echo SELanguage::_get(2500059); ?></td>
    <td class='form2'><input type='text' name='poll_title' class='text' maxlength='200' value='<?php echo $this->_tpl_vars['poll_title']; ?>
' style='width: 300px;'></td>
  </tr>
  <tr>
    <td class='form1'><?php echo SELanguage::_get(2500060); ?></td>
    <td class='form2'>
      <textarea name='poll_desc' rows='5' cols='50' class='text' style='width: 300px;'><?php echo $this->_tpl_vars['poll_desc']; ?>
</textarea>
      <br>
            <?php if (count($this->_tpl_vars['privacy_options']) > 1 || count($this->_tpl_vars['comment_options']) > 1): ?>
        <div id='settings_show' class='poll_settings_link'>
          <a href="javascript:void(0);" onclick="javascript:$('entry_settings').style.display='block';$('settings_show').style.display='none';"><?php echo SELanguage::_get(2500061); ?></a>
        </div>
      <?php endif; ?>

      <div id='entry_settings' class='poll_settings' style='display: none; margin-top: 7px;'>
                <?php if ($this->_tpl_vars['search_polls'] == 1): ?>
          <b><?php echo SELanguage::_get(2500062); ?></b>
          <table cellpadding='0' cellspacing='0'>
            <tr>
              <td><input type='radio' name='poll_search' id='poll_search_1' value='1'<?php if ($this->_tpl_vars['poll_search']): ?> CHECKED<?php endif; ?>></td>
              <td><label for='poll_search_1'><?php echo SELanguage::_get(2500063); ?></label></td>
            </tr>
            <tr>
              <td><input type='radio' name='poll_search' id='poll_search_0' value='0'<?php if (! $this->_tpl_vars['poll_search']): ?> CHECKED<?php endif; ?>></td>
              <td><label for='poll_search_0'><?php echo SELanguage::_get(2500064); ?></label></td>
            </tr>
          </table>
        <?php endif; ?>

                <?php if ($this->_tpl_vars['search_polls'] == 1 && ( count($this->_tpl_vars['privacy_options']) > 1 || count($this->_tpl_vars['comment_options']) > 1 )): ?><br><?php endif; ?>

                <?php if (count($this->_tpl_vars['privacy_options']) > 1): ?>
          <b><?php echo SELanguage::_get(2500065); ?></b>
          <table cellpadding='0' cellspacing='0'>
          <?php $_from = $this->_tpl_vars['privacy_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['privacy_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['privacy_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['privacy_loop']['iteration']++;
?>
            <tr>
            <td><input type='radio' name='poll_privacy' id='privacy_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['poll_privacy'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
            <td><label for='privacy_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
            </tr>
          <?php endforeach; endif; unset($_from); ?>
          </table>
        <?php endif; ?>

                <?php if (count($this->_tpl_vars['privacy_options']) > 1 && count($this->_tpl_vars['comment_options']) > 1): ?><br><?php endif; ?>

                <?php if (count($this->_tpl_vars['comment_options']) > 1): ?>
          <b><?php echo SELanguage::_get(2500066); ?></b>
          <table cellpadding='0' cellspacing='0'>
          <?php $_from = $this->_tpl_vars['comment_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['comment_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['comment_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['comment_loop']['iteration']++;
?>
            <tr>
            <td><input type='radio' name='poll_comments' id='comments_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['poll_comments'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
            <td><label for='comments_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
            </tr>
          <?php endforeach; endif; unset($_from); ?>
          </table>
        <?php endif; ?>
      </div>
    </td>
  </tr>
  <tr>
    <td class='form1'>&nbsp;</td>
    <td class='form2'>
      
      <table cellpadding='0' cellspacing='0'>
        <tr>
          <td>
            <?php $this->assign('langBlockTemp', SE_Language::_get(2500057));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
'><?php 

  ?>&nbsp;
            <input type='hidden' name='task' value='doedit'>
            <input type='hidden' name='poll_id' value='<?php echo $this->_tpl_vars['poll_id']; ?>
'>
            </form>
          </td>
          <td>
            <form action='user_poll.php' method='get'>
            <?php $this->assign('langBlockTemp', SE_Language::_get(39));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
'><?php 

  ?>
            </form>
          </td>
        </tr>
      </table>
      
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