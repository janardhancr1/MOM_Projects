<?php /* Smarty version 2.6.14, created on 2010-05-26 13:50:42
         compiled from user_group.tpl */
?><?php
SELanguage::_preload_multi(2000153,2000095,2000155,2000156,2000157,2000158,2000203,2000159,2000160);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>

<div>
  <img src='./images/icons/group_group48.gif' border='0' class='icon_big' />
  <div class='page_header'><?php echo SELanguage::_get(2000153); ?></div>
  <div class='mom_div_small'>
Create a new group, invite moms, view all of your groups and join in on the conversation
</div>
</div>
<br />
<?php if (( int ) $this->_tpl_vars['user']->level_info['level_group_allow'] & 4 || $this->_tpl_vars['total_invites'] > 0): ?>
<div>
  <?php if (( int ) $this->_tpl_vars['user']->level_info['level_group_allow'] & 4): ?>
  <div class='button' style='float: left; padding-right: 20px;'>
    <a href='user_group_add.php'><img src='./images/icons/plus16.gif' border='0' class='button' /><?php echo SELanguage::_get(2000095); ?></a>
  </div>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['total_invites'] > 0): ?>
  <div class='button' style='float: left; padding-right: 20px;'>
    <a href='javascript:void(0);' onClick="$('invite_groups').style.display = 'block'; if($('noGroups')) { $('noGroups').style.display = 'none'; } this.style.display = 'none';">
      <img src='./images/icons/group_invite16.gif' border='0' class='button' />
      <?php echo sprintf(SELanguage::_get(2000155), $this->_tpl_vars['total_invites']); ?>
    </a>
  </div>
  <?php endif; ?>
  <div style='clear: both; height: 0px;'></div>
</div>
<?php endif; 
 if (! $this->_tpl_vars['total_groups']): ?>
  <div id='noGroups'>
  <br>
  <table cellpadding='0' cellspacing='0'><tr>
  <td class='result'><img src='./images/icons/bulb16.gif' border='0' class='icon' /><?php echo SELanguage::_get(2000156); ?></td>
  </tr></table>
  </div>
<?php endif; ?>

<div id='invite_groups' style='display:none;'>
  <?php unset($this->_sections['invite_loop']);
$this->_sections['invite_loop']['name'] = 'invite_loop';
$this->_sections['invite_loop']['loop'] = is_array($_loop=$this->_tpl_vars['invites']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['invite_loop']['show'] = true;
$this->_sections['invite_loop']['max'] = $this->_sections['invite_loop']['loop'];
$this->_sections['invite_loop']['step'] = 1;
$this->_sections['invite_loop']['start'] = $this->_sections['invite_loop']['step'] > 0 ? 0 : $this->_sections['invite_loop']['loop']-1;
if ($this->_sections['invite_loop']['show']) {
    $this->_sections['invite_loop']['total'] = $this->_sections['invite_loop']['loop'];
    if ($this->_sections['invite_loop']['total'] == 0)
        $this->_sections['invite_loop']['show'] = false;
} else
    $this->_sections['invite_loop']['total'] = 0;
if ($this->_sections['invite_loop']['show']):

            for ($this->_sections['invite_loop']['index'] = $this->_sections['invite_loop']['start'], $this->_sections['invite_loop']['iteration'] = 1;
                 $this->_sections['invite_loop']['iteration'] <= $this->_sections['invite_loop']['total'];
                 $this->_sections['invite_loop']['index'] += $this->_sections['invite_loop']['step'], $this->_sections['invite_loop']['iteration']++):
$this->_sections['invite_loop']['rownum'] = $this->_sections['invite_loop']['iteration'];
$this->_sections['invite_loop']['index_prev'] = $this->_sections['invite_loop']['index'] - $this->_sections['invite_loop']['step'];
$this->_sections['invite_loop']['index_next'] = $this->_sections['invite_loop']['index'] + $this->_sections['invite_loop']['step'];
$this->_sections['invite_loop']['first']      = ($this->_sections['invite_loop']['iteration'] == 1);
$this->_sections['invite_loop']['last']       = ($this->_sections['invite_loop']['iteration'] == $this->_sections['invite_loop']['total']);
?>
  <div class='group_row_invite' style='width: 600px;'>
    <table cellpadding='0' cellspacing='0'>
    <tr>
    <td style='vertical-align: top;'>
      <div class='group_row_photo'>
        <table cellpadding='0' cellspacing='0' width='140'>
          <tr>
            <td valign='top'>
              <a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['invites'][$this->_sections['invite_loop']['index']]['group']->group_info['group_id']); ?>
'>
                <img src='<?php echo $this->_tpl_vars['invites'][$this->_sections['invite_loop']['index']]['group']->group_photo("./images/nophoto.gif"); ?>
' class='photo' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['invites'][$this->_sections['invite_loop']['index']]['group']->group_photo("./images/nophoto.gif"),'128','128','w'); ?>
' border='0' />
              </a>
            </td>
          </tr>
        </table>
      </div>
    </td>
    <td class='group_row1' width='100%' style='vertical-align: top;'>
      <div class='group_row_title'>
        <a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['invites'][$this->_sections['invite_loop']['index']]['group']->group_info['group_id']); ?>
'><?php echo $this->_tpl_vars['invites'][$this->_sections['invite_loop']['index']]['group']->group_info['group_title']; ?>
</a>
      </div>
      <div class='group_row_date'>
        <?php ob_start(); ?><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['invites'][$this->_sections['invite_loop']['index']]['group_leader']->user_info['user_username']); ?>
'><?php echo $this->_tpl_vars['invites'][$this->_sections['invite_loop']['index']]['group_leader']->user_displayname; ?>
</a><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('group_leader', ob_get_contents());ob_end_clean(); ?>
        <?php echo sprintf(SELanguage::_get(2000157), $this->_tpl_vars['invites'][$this->_sections['invite_loop']['index']]['group_members'], $this->_tpl_vars['group_leader']); ?>
      </div>
      <div style='margin-top: 5px;'>
        <?php echo $this->_tpl_vars['invites'][$this->_sections['invite_loop']['index']]['group']->group_info['group_desc']; ?>

      </div>
      <div class='group_row_buttons'>
        <div class='button' style='float: left;'>
          <a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['invites'][$this->_sections['invite_loop']['index']]['group']->group_info['group_id']); ?>
'>
            <img src='./images/icons/group_group16.gif' border='0' class='button' />
            <?php echo SELanguage::_get(2000158); ?>
          </a>
        </div>
        <div class='button' style='float: left; padding-left: 20px;'>
          <a href="javascript:TB_show('<?php echo SELanguage::_get(2000203); ?>', 'user_group_manage.php?group_id=<?php echo $this->_tpl_vars['invites'][$this->_sections['invite_loop']['index']]['group']->group_info['group_id']; ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');">
            <img src='./images/icons/group_invite16.gif' border='0' class='button' />
            <?php echo SELanguage::_get(2000203); ?>
          </a>
        </div>
        <div style='clear: both; height: 0px;'></div>
      </div>
    </td>
    </tr>
    </table>
  </div>
  <?php endfor; endif; ?>
</div>

<?php unset($this->_sections['group_loop']);
$this->_sections['group_loop']['name'] = 'group_loop';
$this->_sections['group_loop']['loop'] = is_array($_loop=$this->_tpl_vars['groups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['group_loop']['show'] = true;
$this->_sections['group_loop']['max'] = $this->_sections['group_loop']['loop'];
$this->_sections['group_loop']['step'] = 1;
$this->_sections['group_loop']['start'] = $this->_sections['group_loop']['step'] > 0 ? 0 : $this->_sections['group_loop']['loop']-1;
if ($this->_sections['group_loop']['show']) {
    $this->_sections['group_loop']['total'] = $this->_sections['group_loop']['loop'];
    if ($this->_sections['group_loop']['total'] == 0)
        $this->_sections['group_loop']['show'] = false;
} else
    $this->_sections['group_loop']['total'] = 0;
if ($this->_sections['group_loop']['show']):

            for ($this->_sections['group_loop']['index'] = $this->_sections['group_loop']['start'], $this->_sections['group_loop']['iteration'] = 1;
                 $this->_sections['group_loop']['iteration'] <= $this->_sections['group_loop']['total'];
                 $this->_sections['group_loop']['index'] += $this->_sections['group_loop']['step'], $this->_sections['group_loop']['iteration']++):
$this->_sections['group_loop']['rownum'] = $this->_sections['group_loop']['iteration'];
$this->_sections['group_loop']['index_prev'] = $this->_sections['group_loop']['index'] - $this->_sections['group_loop']['step'];
$this->_sections['group_loop']['index_next'] = $this->_sections['group_loop']['index'] + $this->_sections['group_loop']['step'];
$this->_sections['group_loop']['first']      = ($this->_sections['group_loop']['iteration'] == 1);
$this->_sections['group_loop']['last']       = ($this->_sections['group_loop']['iteration'] == $this->_sections['group_loop']['total']);
?>
<div class='group_row' style='width: 600px;'>
  <table cellpadding='0' cellspacing='0'>
    <tr>
      <td style='vertical-align: top;'>
        <div class='group_row_photo'>
          <table cellpadding='0' cellspacing='0' width='140'>
            <tr>
              <td valign='top'>
                <a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_id']); ?>
'>
                  <img src='<?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_photo("./images/nophoto.gif"); ?>
' class='photo' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_photo("./images/nophoto.gif"),'128','128','w'); ?>
' border='0' />
                </a>
              </td>
            </tr>
          </table>
        </div>
      </td>
      <td class='group_row1' width='100%' style='vertical-align: top;'>
        <div class='group_row_title'>
          <a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_id']); ?>
'><?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_title']; ?>
</a>
        </div>
        <div class='group_row_date'>
          <?php ob_start(); ?><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group_leader']->user_info['user_username']); ?>
'><?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group_leader']->user_displayname; ?>
</a><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('group_leader', ob_get_contents());ob_end_clean(); ?>
          <?php echo sprintf(SELanguage::_get(2000157), $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group_members'], $this->_tpl_vars['group_leader']); ?>
        </div>
        <div style='margin-top: 5px;'>
          <?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_desc']; ?>

        </div>
        <div class='group_row_buttons'>
          <div class='button' style='float: left;'>
            <a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_id']); ?>
'>
              <img src='./images/icons/group_group16.gif' border='0' class='button' />
              <?php echo SELanguage::_get(2000158); ?>
            </a>
          </div>
          <?php if ($this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group_rank'] != 0): ?>
            <div class='button' style='float: left; padding-left: 20px;'>
              <a href='user_group_edit.php?group_id=<?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_id']; ?>
'>
                <img src='./images/icons/group_settings16.gif' border='0' class='button' />
                <?php echo SELanguage::_get(2000159); ?>
              </a>
            </div>
          <?php endif; ?>
          <div class='button' style='float: left; padding-left: 20px;'>
            <a href="javascript:TB_show('<?php echo SELanguage::_get(2000160); ?>', 'user_group_manage.php?group_id=<?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_id']; ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');">
              <img src='./images/icons/group_leave16.gif' border='0' class='button' />
              <?php echo SELanguage::_get(2000160); ?>
            </a>
          </div>
          <div style='clear: both; height: 0px;'></div>
        </div>
      </td>
    </tr>
  </table>
</div>
<?php endfor; endif; ?>

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