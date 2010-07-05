<?php /* Smarty version 2.6.14, created on 2010-05-26 14:33:39
         compiled from user_group_edit_member.tpl */
?><?php
SELanguage::_preload_multi(2000192,2000193,2000179,2000181,2000180,2000194,2000195,173,39);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header_global.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 
 if ($this->_tpl_vars['result'] != 0): ?>

    <?php echo '
  <script type="text/javascript">
  <!-- 
  setTimeout("window.parent.location.reload(true);", "1000");
  //-->
  </script>
  '; ?>


  <br><div><?php echo SELanguage::_get($this->_tpl_vars['result']); ?></div>



<?php else: ?>

  <div style='text-align:left; padding-left: 10px; padding-top: 10px;'>
  <form action='user_group_edit_member.php' method='post'>
  <table cellpadding='0' cellspacing='0'>

    <?php if ($this->_tpl_vars['group']->groupowner_level_info['level_group_titles'] == 1): ?>
    <tr>
    <td align='right' nowrap='nowrap'><?php echo SELanguage::_get(2000192); ?>&nbsp;</td>
    <td><input type='text' name='member_title' class='text' size='40' maxlength='50' value='<?php echo $this->_tpl_vars['groupmember_info']['groupmember_title']; ?>
'></td>
    </tr>
  <?php endif; ?>

    <?php if ($this->_tpl_vars['group']->user_rank == 2): ?>
    <tr>
    <td align='right' nowrap='nowrap' style='padding-top: 5px;'><?php echo SELanguage::_get(2000193); ?>&nbsp;</td>
    <td style='padding-top: 5px;'>
      <select name='member_rank' id='member_rank' onChange="<?php echo 'if($(\'warning\')) { if(this.options[this.selectedIndex].value == 2) { $(\'warning\').style.display = \'block\'; } else { $(\'warning\').style.display = \'none\'; }}'; ?>
" class='group_select'>
      <?php if ($this->_tpl_vars['groupmember_info']['groupmember_rank'] == 2): ?>
        <option value='2'<?php if ($this->_tpl_vars['groupmember_info']['groupmember_rank'] == 2): ?> selected='selected'<?php endif; ?>><?php echo SELanguage::_get(2000179); ?></option>
      <?php else: ?>
        <option value='0'<?php if ($this->_tpl_vars['groupmember_info']['groupmember_rank'] == 0): ?> selected='selected'<?php endif; ?>><?php echo SELanguage::_get(2000181); ?></option>
        <?php if ($this->_tpl_vars['group']->groupowner_level_info['level_group_officers'] == 1): ?><option value='1'<?php if ($this->_tpl_vars['groupmember_info']['groupmember_rank'] == 1): ?> selected='selected'<?php endif; ?>><?php echo SELanguage::_get(2000180); ?></option><?php endif; ?>
        <option value='2'<?php if ($this->_tpl_vars['groupmember_info']['groupmember_rank'] == 2): ?> selected='selected'<?php endif; ?>><?php echo SELanguage::_get(2000179); ?></option>
      <?php endif; ?>
      </select>
    </td>
    </tr>
  <?php endif; ?>

    <?php if ($this->_tpl_vars['groupmember_info']['groupmember_rank'] == 2): ?>
    <tr>
    <td>&nbsp;</td>
    <td><div class='form_desc' style='padding: 10px 0px 10px 0px;'><?php echo sprintf(SELanguage::_get(2000194), $this->_tpl_vars['group']->group_info['group_id']); ?></div></td>
    </tr>
    <?php else: ?>
    <tr>
    <td>&nbsp;</td>
    <td><div id='warning' class='form_desc' style='display: none;'><?php echo SELanguage::_get(2000195); ?></div></td>
    </tr>
  <?php endif; ?>

  <tr>
  <td>&nbsp;</td>
  <td>
    <table cellpadding='0' cellspacing='0'>
    <tr>
    <td>
      <input type='submit' class='button' value='<?php echo SELanguage::_get(173); ?>'>&nbsp;
      <input type='hidden' name='group_id' value='<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'>
      <input type='hidden' name='groupmember_id' value='<?php echo $this->_tpl_vars['groupmember_info']['groupmember_id']; ?>
'>
      <input type='hidden' name='task' value='save_do'>
    </td>
    <td>
      <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='parent.TB_remove()'>
    </td>
    </tr>
    </table>
  </td>
  </tr>
  </table>
  </form>

<?php endif; ?>

</body>
</html>