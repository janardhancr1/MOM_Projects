<?php /* Smarty version 2.6.14, created on 2010-05-26 14:27:54
         compiled from user_group_edit_members.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'user_group_edit_members.tpl', 19, false),array('function', 'math', 'user_group_edit_members.tpl', 110, false),)), $this);
?><?php
SELanguage::_preload_multi(2000097,2000118,2000119,2000101,2000102,2000120,643,646,2000174,2000171,2000175,2000103,2000169,2000170,900,901,902,2000172,2000173,2000176,182,184,185,183,2000179,2000180,2000181,2000182,2000178,2000183,906,2000188,2000189,2000190,2000184,2000185,784,839,2000191,39);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<table class='tabs' cellpadding='0' cellspacing='0'>
  <tr>
    <td class='tab0'>&nbsp;</td>
    <td class='tab2' NOWRAP><a href='user_group_edit.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'><?php echo SELanguage::_get(2000097); ?></a></td><td class='tab'>&nbsp;</td>
    <td class='tab1' NOWRAP><a href='user_group_edit_members.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'><?php echo SELanguage::_get(2000118); ?></a></td><td class='tab'>&nbsp;</td>
    <td class='tab2' NOWRAP><a href='user_group_edit_settings.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'><?php echo SELanguage::_get(2000119); ?></a></td><td class='tab'>&nbsp;</td>
    <td class='tab3'>&nbsp;</td>
  </tr>
</table>

<table cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td valign='top'>
  <img src='./images/icons/group_group48.gif' border='0' class='icon_big' />
  <?php ob_start(); ?><a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['group']->group_info['group_id']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['group']->group_info['group_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>
</a><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('linked_groupname', ob_get_contents());ob_end_clean(); ?>
  <div class='page_header'><?php echo sprintf(SELanguage::_get(2000101), $this->_tpl_vars['linked_groupname']); ?></div>
  <?php echo SELanguage::_get(2000102); ?>
</td>
<td valign='top' align='right'>
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='button'><a href='user_group.php'><img src='./images/icons/back16.gif' border='0' class='button' /><?php echo SELanguage::_get(2000120); ?></a></td></tr>
  </table>
</td>
</tr>
</table>

<br />

<table cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td valign='top' width='270'>

  <div style='padding-right: 10px; padding: 10px; background: #EEEEEE; border: 1px solid #BBBBBB;'>
    <form action='user_group_edit_members.php' method='post'>
    <table cellpadding='0' cellspacing='0' align='center'>
    <tr>
    <td align='right' style='font-weight: bold;'><?php echo SELanguage::_get(643); ?>&nbsp;</td>
    <td style='padding-left: 3px;'>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td><input type='text' maxlength='100' name='search' class='group_search text' value='<?php echo $this->_tpl_vars['search']; ?>
'><input type='hidden' name='p' value='<?php echo $this->_tpl_vars['p']; ?>
'><input type='hidden' name='s' value='<?php echo $this->_tpl_vars['s']; ?>
'><input type='hidden' name='v' value='<?php echo $this->_tpl_vars['v']; ?>
'>&nbsp;</td>
      <td><input type='submit' class='button' value='<?php echo SELanguage::_get(646); ?>' style='vertical-align: middle;'><input type='hidden' name='group_id' value='<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'></td>
      </tr>
      </table>
    </td>
    <td colspan='2'>
    	<table cellpadding='0' cellspacing='0' align='center'>
	    <tr>
	    <td>
	      <a href='javascript:void(0)' onClick="TB_show('<?php echo SELanguage::_get(2000174); ?>', 'user_group_invite.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&TB_iframe=true&height=300&width=450', '', '../images/trans.gif');"><img src='./images/icons/group_invite16.gif' border='0' class='button'><?php echo SELanguage::_get(2000174); ?></a>
	    </td>
	    </tr>
	    </table>
    </td>
    </tr>
    <tr>
    <td align='right' style='font-weight: bold;'><?php echo SELanguage::_get(2000171); ?>&nbsp;</td>
    <td style='padding: 3px;'>
      <select name='v' class='group_small' onChange="window.location.href='user_group_edit_members.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&v='+this.options[this.selectedIndex].value;">
      <?php if ($this->_tpl_vars['group']->group_info['group_approval']): ?><option value='3'<?php if ($this->_tpl_vars['v'] == 3): ?> selected='selected'<?php endif; ?>><?php echo SELanguage::_get(2000175); ?></option><?php endif; ?>
      <option value='2'<?php if ($this->_tpl_vars['v'] == 2): ?> selected='selected'<?php endif; ?>><?php echo SELanguage::_get(2000103); ?></option>
      <option value='0'<?php if ($this->_tpl_vars['v'] == 0): ?> selected='selected'<?php endif; ?>><?php echo SELanguage::_get(2000169); ?></option>
      <option value='1'<?php if ($this->_tpl_vars['v'] == 1): ?> selected='selected'<?php endif; ?>><?php echo SELanguage::_get(2000170); ?></option>
      </select>
    </td>
    <td align='right' style='font-weight: bold;'><?php echo SELanguage::_get(900); ?>&nbsp;</td>
    <td style='padding: 3px;'>
      <select name='s' class='group_small' onChange="window.location.href='user_group_edit_members.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&s='+this.options[this.selectedIndex].value;">
      <option value='<?php echo $this->_tpl_vars['u']; ?>
'<?php if ($this->_tpl_vars['s'] == 'ud'): ?> selected='selected'<?php endif; ?>><?php echo SELanguage::_get(901); ?></option>
      <option value='<?php echo $this->_tpl_vars['l']; ?>
'<?php if ($this->_tpl_vars['s'] == 'ld'): ?> selected='selected'<?php endif; ?>><?php echo SELanguage::_get(902); ?></option>
      <option value='<?php echo $this->_tpl_vars['t']; ?>
'<?php if ($this->_tpl_vars['s'] == 't'): ?> selected='selected'<?php endif; ?>><?php echo SELanguage::_get(2000172); ?></option>
      <option value='<?php echo $this->_tpl_vars['r']; ?>
'<?php if ($this->_tpl_vars['s'] == 'r'): ?> selected='selected'<?php endif; ?>><?php echo SELanguage::_get(2000173); ?></option>
      </select>
    </td>
    </tr>
    </table>
    </form>
  </div>

  <div style='margin-top: 10px;'>
    
  </div>

</td>
</tr>
<tr>
<td valign='top' style='padding-left: 10px;'>

    <?php if ($this->_tpl_vars['total_members'] == 0): ?>

    <table cellpadding='0' cellspacing='0' align='center'>
    <tr>
    <td class='result'>
      <img src='./images/icons/bulb16.gif' class='icon'>
      <?php echo SELanguage::_get(2000176); ?>
    </td>
    </tr>
    </table>


  <?php else: ?>

        <div class='group_pages_top'>
      <?php if ($this->_tpl_vars['p'] != 1): ?><a href='user_group_edit_members.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => 'p-1','p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?><font class='disabled'>&#171; <?php echo SELanguage::_get(182); ?></font><?php endif; ?>
      <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
        &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_members']); ?> &nbsp;|&nbsp; 
      <?php else: ?>
        &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_members']); ?> &nbsp;|&nbsp; 
      <?php endif; ?>
      <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?><a href='user_group_edit_members.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => 'p+1','p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: ?><font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font><?php endif; ?>
    </div>
 
    <?php unset($this->_sections['member_loop']);
$this->_sections['member_loop']['name'] = 'member_loop';
$this->_sections['member_loop']['loop'] = is_array($_loop=$this->_tpl_vars['members']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['member_loop']['show'] = true;
$this->_sections['member_loop']['max'] = $this->_sections['member_loop']['loop'];
$this->_sections['member_loop']['step'] = 1;
$this->_sections['member_loop']['start'] = $this->_sections['member_loop']['step'] > 0 ? 0 : $this->_sections['member_loop']['loop']-1;
if ($this->_sections['member_loop']['show']) {
    $this->_sections['member_loop']['total'] = $this->_sections['member_loop']['loop'];
    if ($this->_sections['member_loop']['total'] == 0)
        $this->_sections['member_loop']['show'] = false;
} else
    $this->_sections['member_loop']['total'] = 0;
if ($this->_sections['member_loop']['show']):

            for ($this->_sections['member_loop']['index'] = $this->_sections['member_loop']['start'], $this->_sections['member_loop']['iteration'] = 1;
                 $this->_sections['member_loop']['iteration'] <= $this->_sections['member_loop']['total'];
                 $this->_sections['member_loop']['index'] += $this->_sections['member_loop']['step'], $this->_sections['member_loop']['iteration']++):
$this->_sections['member_loop']['rownum'] = $this->_sections['member_loop']['iteration'];
$this->_sections['member_loop']['index_prev'] = $this->_sections['member_loop']['index'] - $this->_sections['member_loop']['step'];
$this->_sections['member_loop']['index_next'] = $this->_sections['member_loop']['index'] + $this->_sections['member_loop']['step'];
$this->_sections['member_loop']['first']      = ($this->_sections['member_loop']['iteration'] == 1);
$this->_sections['member_loop']['last']       = ($this->_sections['member_loop']['iteration'] == $this->_sections['member_loop']['total']);
?>
      <div class='group_member'>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_username']); ?>
'><img src='<?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_photo('./images/nophoto.gif','TRUE'); ?>
' class='photo' width='60' height='60' border='0'></a></td>
      <td style='padding-left: 7px; vertical-align: top;' width='100%'>
        <div class='group_member_title'>
          <img src='./images/icons/user16.gif' border='0' class='icon'><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_username']); ?>
'><?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_displayname; ?>
</a>
        </div>
        <div style='padding-top: 5px;'>
	  <?php if ($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_approved'] == 1 && $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_status'] == 1): ?>
            <?php ob_start(); 
 if ($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_rank'] == 2): 
 echo SELanguage::_get(2000179); 
 elseif ($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_rank'] == 1 && $this->_tpl_vars['group']->groupowner_level_info['level_group_officers'] == 1): 
 echo SELanguage::_get(2000180); 
 else: 
 echo SELanguage::_get(2000181); 
 endif; 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('member_rank', ob_get_contents());ob_end_clean(); ?>
	    <div class='group_member_info'><?php if ($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_title'] != "" && $this->_tpl_vars['group']->groupowner_level_info['level_group_titles'] == 1): 
 echo sprintf(SELanguage::_get(2000182), $this->_tpl_vars['member_rank'], $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_title']); 
 else: 
 echo sprintf(SELanguage::_get(2000178), $this->_tpl_vars['member_rank']); 
 endif; ?></div>
	  <?php endif; ?>
	  <?php if ($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_dateupdated'] != '0'): ?>
            <div class='group_member_info'><?php echo SELanguage::_get(2000183); ?> &nbsp;<?php $this->assign('user_dateupdated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_dateupdated'])); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['user_dateupdated'][0]), $this->_tpl_vars['user_dateupdated'][1]); ?></div>
          <?php endif; ?>
	  <?php if ($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_lastlogindate'] != '0'): ?>
            <div class='group_member_info'><?php echo SELanguage::_get(906); ?> &nbsp;<?php $this->assign('user_lastlogindate', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_lastlogindate'])); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['user_lastlogindate'][0]), $this->_tpl_vars['user_lastlogindate'][1]); ?></div>
          <?php endif; ?>
        </div>
      </td>
      <td nowrap='nowrap' style='vertical-align: top;'>
        	<?php if ($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_approved'] == 0): ?>
          <div><a href='user_group_edit_members.php?task=approve&group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&groupmember_id=<?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_id']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
'><?php echo SELanguage::_get(2000188); ?></a></div>
          <div><a href='user_group_edit_members.php?task=reject&group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&groupmember_id=<?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_id']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
'><?php echo SELanguage::_get(2000189); ?></a></div>



        	<?php elseif ($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_approved'] == 1 && $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_status'] == 0): ?>
          <div><a href='user_group_edit_members.php?task=cancel&group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&groupmember_id=<?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_id']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
'><?php echo SELanguage::_get(2000190); ?></a></div>


                <?php else: ?>
                    <?php if ($this->_tpl_vars['group']->user_rank > $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_rank'] || $this->_tpl_vars['group']->user_rank == 2): ?>
            <div><a href='javascript:void(0)' onClick="TB_show('<?php echo SELanguage::_get(2000184); ?>', 'user_group_edit_member.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&groupmember_id=<?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_id']; ?>
&TB_iframe=true&height=200&width=350', '', '../images/trans.gif');"><?php echo SELanguage::_get(2000184); ?></a></div>
            <?php if ($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_id'] != $this->_tpl_vars['user']->user_info['user_id']): ?>
              <div><a href='javascript:void(0);' onClick="confirmDelete('<?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_id']; ?>
');"><?php echo SELanguage::_get(2000185); ?></a></div>
            <?php endif; ?>
          <?php endif; ?>
                    <?php if ($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_id'] != $this->_tpl_vars['user']->user_info['user_id']): ?>
            <div><a href="javascript:TB_show('<?php echo SELanguage::_get(784); ?>', 'user_messages_new.php?to_user=<?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_displayname; ?>
&to_id=<?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_username']; ?>
&TB_iframe=true&height=400&width=450', '', './images/trans.gif');"><?php echo SELanguage::_get(839); ?></a></div>
          <?php endif; ?>
        <?php endif; ?>
      </td>
      </tr>
      </table>
      </div>
    <?php endfor; endif; ?>
 
        <div class='group_pages_bottom' style='margin-top: 10px;'>
      <?php if ($this->_tpl_vars['p'] != 1): ?><a href='user_group_edit_members.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => 'p-1','p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?><font class='disabled'>&#171; <?php echo SELanguage::_get(182); ?></font><?php endif; ?>
      <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
        &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_members']); ?> &nbsp;|&nbsp; 
      <?php else: ?>
        &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_members']); ?> &nbsp;|&nbsp; 
      <?php endif; ?>
      <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?><a href='user_group_edit_members.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => 'p+1','p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: ?><font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font><?php endif; ?>
    </div>

        <?php echo '
    <script type="text/javascript">
    <!-- 
    var groupmember_id = 0;
    function confirmDelete(id) {
      groupmember_id = id;
      TB_show(\''; 
 echo SELanguage::_get(2000185); 
 echo '\', \'#TB_inline?height=150&width=300&inlineId=confirmdelete\', \'\', \'../images/trans.gif\');
    }

    function removeUser() {
      '; ?>
window.location = 'user_group_edit_members.php?task=remove&group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&groupmember_id='+groupmember_id;<?php echo '
    }
    //-->
    </script>
    '; ?>


        <div style='display: none;' id='confirmdelete'>
      <div style='margin-top: 10px;'><?php echo SELanguage::_get(2000191); ?></div>
      <br>
      <input type='button' class='button' value='<?php echo SELanguage::_get(2000185); ?>' onClick='parent.TB_remove();parent.removeUser();'>
      <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='parent.TB_remove();'>
    </div>

  <?php endif; ?>
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