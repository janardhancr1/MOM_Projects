<?php /* Smarty version 2.6.14, created on 2010-05-26 14:10:04
         compiled from group.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'group.tpl', 98, false),array('modifier', 'count', 'group.tpl', 213, false),array('modifier', 'replace', 'group.tpl', 229, false),array('modifier', 'choptext', 'group.tpl', 229, false),array('modifier', 'default', 'group.tpl', 628, false),array('function', 'math', 'group.tpl', 305, false),array('function', 'cycle', 'group.tpl', 458, false),)), $this);
?><?php
SELanguage::_preload_multi(2000159,2000223,2000203,2000165,2000160,2000225,2000224,2000174,2000226,2000227,2000228,2000229,2000230,2000231,2000118,2000232,2000233,854,2000254,2000094,2000255,2000256,2000253,2000220,2000221,646,2000222,182,184,185,183,509,849,2000179,2000180,2000182,2000178,876,838,784,839,2000251,2000252,2000257,2000258,2000259,2000260,2000261,1071,835,2000262,155,2000263,2000265,2000266,2000267,175,39,187,787,829,830,831,832,833,834,856,891,1025,1026,1032,1034);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<div class='page_header'><?php echo $this->_tpl_vars['group']->group_info['group_title']; ?>
</div>

<table width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td class='profile_leftside' width='200'>

    <?php if ($this->_tpl_vars['group']->user_rank != -1): ?>
    <?php echo '
    <script type=\'text/javascript\'>
    <!--
      function subscribe_update(is_subscribed)
      {
        if(is_subscribed == \'1\')
        {
          $(\'is_subscribed\').style.display = \'none\';
          $(\'is_unsubscribed\').style.display = \'block\';
        }
        else
        {
          $(\'is_subscribed\').style.display = \'block\';
          $(\'is_unsubscribed\').style.display = \'none\';
        }
      }
    //-->
    </script>
    '; ?>

  <?php endif; ?>

    <table cellpadding='0' cellspacing='0' width='100%' style='margin-bottom: 10px;'>
  <tr>
  <td class='profile_photo' width='182'><img class='photo' src='<?php echo $this->_tpl_vars['group']->group_photo("./images/nophoto.gif"); ?>
' border='0' /></td>
  </tr>
  </table>

  <table class='profile_menu' cellpadding='0' cellspacing='0' width='100%'>

    <?php if ($this->_tpl_vars['group']->user_rank >= 2): ?>
      <tr>
        <td class='profile_menu1'>
          <a href="user_group_edit.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
"><img src='./images/icons/group_settings16.gif' border='0' class='button' /><?php echo SELanguage::_get(2000159); ?></a>
        </td>
      </tr>
  <?php endif; ?>
  
    <?php if ($this->_tpl_vars['group']->user_rank == -1 && $this->_tpl_vars['user']->user_exists == 1 && ( int ) $this->_tpl_vars['user']->level_info['level_group_allow'] & 2): ?>
    <?php if ($this->_tpl_vars['group']->groupmember_info['groupmember_id'] != 0 && $this->_tpl_vars['group']->groupmember_info['groupmember_approved'] != 1): ?>
      <tr>
        <td class='profile_menu1'>
          <div class='nolink'><img src='./images/icons/group_join16.gif' border='0' class='icon' /><?php echo SELanguage::_get(2000223); ?></div>
        </td>
      </tr>
    <?php elseif ($this->_tpl_vars['group']->groupmember_info['groupmember_id'] != 0 && $this->_tpl_vars['group']->groupmember_info['groupmember_approved'] == 1): ?>
      <tr>
        <td class='profile_menu1'>
          <a href="javascript:TB_show('<?php echo SELanguage::_get(2000203); ?>', 'user_group_manage.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');"><img src='./images/icons/group_join16.gif' border='0' class='icon' /><?php echo SELanguage::_get(2000203); ?></a>
        </td>
      </tr>
    <?php else: ?>
      <tr>
        <td class='profile_menu1'>
          <a href="javascript:TB_show('<?php echo SELanguage::_get(2000165); ?>', 'user_group_manage.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');"><img src='./images/icons/group_join16.gif' border='0' class='icon' /><?php echo SELanguage::_get(2000165); ?></a>
        </td>
      </tr>
    <?php endif; ?>
  <?php endif; ?>

    <?php if ($this->_tpl_vars['group']->user_rank != -1): ?>
    <tr>
      <td class='profile_menu1'>
        <a href="javascript:TB_show('<?php echo SELanguage::_get(2000160); ?>', 'user_group_manage.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');"><img src='./images/icons/group_leave16.gif' border='0' class='icon' /><?php echo SELanguage::_get(2000160); ?></a></td></tr>
  <?php endif; ?>

    <?php if ($this->_tpl_vars['group']->user_rank != -1): ?>
    <tr><td class='profile_menu1'>
      <div id='is_subscribed'<?php if (! $this->_tpl_vars['is_subscribed']): ?> style='display: none;'<?php endif; ?>><a href="javascript:TB_show('<?php echo SELanguage::_get(2000225); ?>', 'user_group_subscribe.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');"><img src='./images/icons/group_unsubscribe16.gif' border='0' class='icon' /><?php echo SELanguage::_get(2000225); ?></a></div>
      <div id='is_unsubscribed'<?php if ($this->_tpl_vars['is_subscribed']): ?> style='display: none;'<?php endif; ?>><a href="javascript:TB_show('<?php echo SELanguage::_get(2000224); ?>', 'user_group_subscribe.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');"><img src='./images/icons/group_subscribe16.gif' border='0' class='icon' /><?php echo SELanguage::_get(2000224); ?></a></div>
    </td></tr>
  <?php endif; ?>

    <?php if ($this->_tpl_vars['allowed_to_invite']): ?>
    <tr><td class='profile_menu1'><a href='javascript:void(0)' onClick="TB_show('<?php echo SELanguage::_get(2000174); ?>', 'user_group_invite.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&TB_iframe=true&height=300&width=450', '', '../images/trans.gif');"><img src='./images/icons/group_invite16.gif' border='0' class='icon' /><?php echo SELanguage::_get(2000174); ?></a></td></tr>
  <?php endif; ?>

    <tr>
  <td class='profile_menu1'><a href="javascript:TB_show('<?php echo SELanguage::_get(2000226); ?>', 'user_report.php?return_url=<?php echo ((is_array($_tmp=$this->_tpl_vars['url']->url_current())) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');"><img src='./images/icons/report16.gif' class='icon' border='0' /><?php echo SELanguage::_get(2000226); ?></a></td>
  </tr>

  </table>


    <?php if ($this->_tpl_vars['is_group_private'] != 0): ?>

        </td>
    <td class='profile_rightside'>
    
      <img src='./images/icons/error48.gif' border='0' class='icon_big' />
      <div class='page_header'><?php echo SELanguage::_get(2000227); ?></div>
      <?php echo SELanguage::_get(2000228); ?>

    <?php else: ?>

        <table cellpadding='0' cellspacing='0' width='100%' style='margin-top: 10px;'>
    <tr>
    <td class='header'><?php echo SELanguage::_get(2000229); ?></td>
    </tr>
    <tr>
    <td class='profile'>
      <?php unset($this->_sections['officer_loop']);
$this->_sections['officer_loop']['name'] = 'officer_loop';
$this->_sections['officer_loop']['loop'] = is_array($_loop=$this->_tpl_vars['officers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['officer_loop']['show'] = true;
$this->_sections['officer_loop']['max'] = $this->_sections['officer_loop']['loop'];
$this->_sections['officer_loop']['step'] = 1;
$this->_sections['officer_loop']['start'] = $this->_sections['officer_loop']['step'] > 0 ? 0 : $this->_sections['officer_loop']['loop']-1;
if ($this->_sections['officer_loop']['show']) {
    $this->_sections['officer_loop']['total'] = $this->_sections['officer_loop']['loop'];
    if ($this->_sections['officer_loop']['total'] == 0)
        $this->_sections['officer_loop']['show'] = false;
} else
    $this->_sections['officer_loop']['total'] = 0;
if ($this->_sections['officer_loop']['show']):

            for ($this->_sections['officer_loop']['index'] = $this->_sections['officer_loop']['start'], $this->_sections['officer_loop']['iteration'] = 1;
                 $this->_sections['officer_loop']['iteration'] <= $this->_sections['officer_loop']['total'];
                 $this->_sections['officer_loop']['index'] += $this->_sections['officer_loop']['step'], $this->_sections['officer_loop']['iteration']++):
$this->_sections['officer_loop']['rownum'] = $this->_sections['officer_loop']['iteration'];
$this->_sections['officer_loop']['index_prev'] = $this->_sections['officer_loop']['index'] - $this->_sections['officer_loop']['step'];
$this->_sections['officer_loop']['index_next'] = $this->_sections['officer_loop']['index'] + $this->_sections['officer_loop']['step'];
$this->_sections['officer_loop']['first']      = ($this->_sections['officer_loop']['iteration'] == 1);
$this->_sections['officer_loop']['last']       = ($this->_sections['officer_loop']['iteration'] == $this->_sections['officer_loop']['total']);
?>
        <div>
          <a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['officers'][$this->_sections['officer_loop']['index']]['member']->user_info['user_username']); ?>
'><?php echo $this->_tpl_vars['officers'][$this->_sections['officer_loop']['index']]['member']->user_displayname; ?>
</a><?php if ($this->_tpl_vars['officers'][$this->_sections['officer_loop']['index']]['groupmember_rank'] == 2): ?> <?php echo SELanguage::_get(2000230); 
 endif; ?>
            <?php if ($this->_tpl_vars['officers'][$this->_sections['officer_loop']['index']]['groupmember_title'] != "" && $this->_tpl_vars['group']->groupowner_level_info['level_group_titles'] == 1): ?>
            <div class='group_officer_title'><?php echo $this->_tpl_vars['officers'][$this->_sections['officer_loop']['index']]['groupmember_title']; ?>
</div>
          <?php endif; ?>
          <?php if (! $this->_sections['officer_loop']['last']): ?><div style='height: 4px;'></div><?php endif; ?>
        </div>
      <?php endfor; endif; ?>
    </td>
    </tr>
    </table>
    

    </td>
  <td class='profile_rightside'>
  
        <?php echo '
    <script type=\'text/javascript\'>
    <!--
      var visible_tab = \''; 
 echo $this->_tpl_vars['v']; 
 echo '\';
      function loadGroupTab(tabId)
      {
        if(tabId == visible_tab)
        {
          return false;
        }
        if( $(\'group_\'+tabId) )
        {
          $(\'group_tabs_\'+tabId).className=\'group_tab2\';
          $(\'group_\'+tabId).style.display = "block";
          if($(\'group_tabs_\'+visible_tab))
          {
            $(\'group_tabs_\'+visible_tab).className=\'group_tab\';
            $(\'group_\'+visible_tab).style.display = "none";
          }
          visible_tab = tabId;
        }
      }
    //-->
    </script>
    '; ?>

    
        <table cellpadding='0' cellspacing='0'>
    <tr>
    <td valign='bottom'><table cellpadding='0' cellspacing='0'><tr><td class='group_tab<?php if ($this->_tpl_vars['v'] == 'group'): ?>2<?php endif; ?>' id='group_tabs_group' onMouseUp="this.blur()" nowrap='nowrap'><a href='javascript:void(0);' onMouseDown="loadGroupTab('group')" onMouseUp="this.blur()"><?php echo SELanguage::_get(2000231); ?></a></td></tr></table></td>
    <?php if ($this->_tpl_vars['total_members_all'] != 0): ?><td valign='bottom'><table cellpadding='0' cellspacing='0'><td class='group_tab<?php if ($this->_tpl_vars['v'] == 'members'): ?>2<?php endif; ?>' id='group_tabs_members' onMouseUp="this.blur()"><a href='javascript:void(0);' onMouseDown="loadGroupTab('members');" onMouseUp="this.blur()"><?php echo SELanguage::_get(2000118); ?></a></td></tr></table></td><?php endif; ?>
    <?php if ($this->_tpl_vars['allowed_to_upload'] != 0 || $this->_tpl_vars['total_files'] != 0): ?><td valign='bottom'><table cellpadding='0' cellspacing='0'><td class='group_tab<?php if ($this->_tpl_vars['v'] == 'photos'): ?>2<?php endif; ?>' id='group_tabs_photos' onMouseUp="this.blur()"><a href='javascript:void(0);' onMouseDown="loadGroupTab('photos');" onMouseUp="this.blur()"><?php echo SELanguage::_get(2000232); ?></a></td></tr></table></td><?php endif; ?>
    <?php if ($this->_tpl_vars['allowed_to_discuss'] != 0 || $this->_tpl_vars['total_topics'] != 0): ?><td valign='bottom'><table cellpadding='0' cellspacing='0'><td class='group_tab<?php if ($this->_tpl_vars['v'] == 'discussions'): ?>2<?php endif; ?>' id='group_tabs_discussions' onMouseUp="this.blur()"><a href='javascript:void(0);' onMouseDown="loadGroupTab('discussions');" onMouseUp="this.blur()"><?php echo SELanguage::_get(2000233); ?></a></td></tr></table></td><?php endif; ?>
    <?php if ($this->_tpl_vars['allowed_to_comment'] == 1 || $this->_tpl_vars['total_comments'] != 0): ?><td valign='bottom'><table cellpadding='0' cellspacing='0'><td class='group_tab<?php if ($this->_tpl_vars['v'] == 'comments'): ?>2<?php endif; ?>' id='group_tabs_comments' onMouseUp="this.blur()"><a href='javascript:void(0);' onMouseDown="loadGroupTab('comments');" onMouseUp="this.blur()"><?php echo SELanguage::_get(854); ?></a></td></tr></table></td><?php endif; ?>
    <td width='100%' class='group_tab_end'>&nbsp;</td>
    </tr>
    </table>
    
    <div class='group_content'>
    
    
        <div id='group_group'<?php if ($this->_tpl_vars['v'] != 'group'): ?> style='display: none;'<?php endif; ?>>
    
            <div style='margin-bottom: 10px;'>
        <div class='group_headline'><?php echo SELanguage::_get(2000254); ?></div>
        <table cellpadding='0' cellspacing='0'>
          <tr><td width='100' valign='top' nowrap='nowrap'><?php echo SELanguage::_get(2000094); ?></td><td><?php echo $this->_tpl_vars['group']->group_info['group_title']; ?>
</td></tr>
          <?php if ($this->_tpl_vars['group']->group_info['group_desc'] != ""): ?><tr><td valign='top' nowrap='nowrap'><?php echo SELanguage::_get(2000255); ?></td><td><?php echo $this->_tpl_vars['group']->group_info['group_desc']; ?>
</td></tr><?php endif; ?>
          <tr>
            <td valign='top' nowrap='nowrap'><?php echo SELanguage::_get(2000256); ?></td>
            <td><?php if ($this->_tpl_vars['groupcat_info']['subcat_dependency'] == 0): ?><a href='browse_groups.php?groupcat_id=<?php echo $this->_tpl_vars['groupcat_info']['subcat_id']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['groupcat_info']['subcat_title']); ?></a><?php else: ?><a href='browse_groups.php?groupcat_id=<?php echo $this->_tpl_vars['groupcat_info']['cat_id']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['groupcat_info']['cat_title']); ?></a> - <a href='browse_groups.php?groupcat_id=<?php echo $this->_tpl_vars['groupcat_info']['subcat_id']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['groupcat_info']['subcat_title']); ?></a><?php endif; ?></td>
          </tr>
          <?php unset($this->_sections['cat_loop']);
$this->_sections['cat_loop']['name'] = 'cat_loop';
$this->_sections['cat_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cat_loop']['show'] = true;
$this->_sections['cat_loop']['max'] = $this->_sections['cat_loop']['loop'];
$this->_sections['cat_loop']['step'] = 1;
$this->_sections['cat_loop']['start'] = $this->_sections['cat_loop']['step'] > 0 ? 0 : $this->_sections['cat_loop']['loop']-1;
if ($this->_sections['cat_loop']['show']) {
    $this->_sections['cat_loop']['total'] = $this->_sections['cat_loop']['loop'];
    if ($this->_sections['cat_loop']['total'] == 0)
        $this->_sections['cat_loop']['show'] = false;
} else
    $this->_sections['cat_loop']['total'] = 0;
if ($this->_sections['cat_loop']['show']):

            for ($this->_sections['cat_loop']['index'] = $this->_sections['cat_loop']['start'], $this->_sections['cat_loop']['iteration'] = 1;
                 $this->_sections['cat_loop']['iteration'] <= $this->_sections['cat_loop']['total'];
                 $this->_sections['cat_loop']['index'] += $this->_sections['cat_loop']['step'], $this->_sections['cat_loop']['iteration']++):
$this->_sections['cat_loop']['rownum'] = $this->_sections['cat_loop']['iteration'];
$this->_sections['cat_loop']['index_prev'] = $this->_sections['cat_loop']['index'] - $this->_sections['cat_loop']['step'];
$this->_sections['cat_loop']['index_next'] = $this->_sections['cat_loop']['index'] + $this->_sections['cat_loop']['step'];
$this->_sections['cat_loop']['first']      = ($this->_sections['cat_loop']['iteration'] == 1);
$this->_sections['cat_loop']['last']       = ($this->_sections['cat_loop']['iteration'] == $this->_sections['cat_loop']['total']);
?>
            <?php unset($this->_sections['field_loop']);
$this->_sections['field_loop']['name'] = 'field_loop';
$this->_sections['field_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['field_loop']['show'] = true;
$this->_sections['field_loop']['max'] = $this->_sections['field_loop']['loop'];
$this->_sections['field_loop']['step'] = 1;
$this->_sections['field_loop']['start'] = $this->_sections['field_loop']['step'] > 0 ? 0 : $this->_sections['field_loop']['loop']-1;
if ($this->_sections['field_loop']['show']) {
    $this->_sections['field_loop']['total'] = $this->_sections['field_loop']['loop'];
    if ($this->_sections['field_loop']['total'] == 0)
        $this->_sections['field_loop']['show'] = false;
} else
    $this->_sections['field_loop']['total'] = 0;
if ($this->_sections['field_loop']['show']):

            for ($this->_sections['field_loop']['index'] = $this->_sections['field_loop']['start'], $this->_sections['field_loop']['iteration'] = 1;
                 $this->_sections['field_loop']['iteration'] <= $this->_sections['field_loop']['total'];
                 $this->_sections['field_loop']['index'] += $this->_sections['field_loop']['step'], $this->_sections['field_loop']['iteration']++):
$this->_sections['field_loop']['rownum'] = $this->_sections['field_loop']['iteration'];
$this->_sections['field_loop']['index_prev'] = $this->_sections['field_loop']['index'] - $this->_sections['field_loop']['step'];
$this->_sections['field_loop']['index_next'] = $this->_sections['field_loop']['index'] + $this->_sections['field_loop']['step'];
$this->_sections['field_loop']['first']      = ($this->_sections['field_loop']['iteration'] == 1);
$this->_sections['field_loop']['last']       = ($this->_sections['field_loop']['iteration'] == $this->_sections['field_loop']['total']);
?>
              <tr>
                <td valign='top' nowrap='nowrap'><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_title']); ?>:</td>
                <td><div class='profile_field_value'><?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_value_formatted']; ?>
</div></td>
              </tr>
            <?php endfor; endif; ?>
          <?php endfor; endif; ?>
        </table>
      </div>

            <?php if (count($this->_tpl_vars['actions']) > 0): ?>
        <div style='margin-bottom: 10px;'>
          <div class='group_headline'><?php echo SELanguage::_get(2000253); ?></div>
          <?php unset($this->_sections['actions_loop']);
$this->_sections['actions_loop']['name'] = 'actions_loop';
$this->_sections['actions_loop']['loop'] = is_array($_loop=$this->_tpl_vars['actions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['actions_loop']['max'] = (int)20;
$this->_sections['actions_loop']['show'] = true;
if ($this->_sections['actions_loop']['max'] < 0)
    $this->_sections['actions_loop']['max'] = $this->_sections['actions_loop']['loop'];
$this->_sections['actions_loop']['step'] = 1;
$this->_sections['actions_loop']['start'] = $this->_sections['actions_loop']['step'] > 0 ? 0 : $this->_sections['actions_loop']['loop']-1;
if ($this->_sections['actions_loop']['show']) {
    $this->_sections['actions_loop']['total'] = min(ceil(($this->_sections['actions_loop']['step'] > 0 ? $this->_sections['actions_loop']['loop'] - $this->_sections['actions_loop']['start'] : $this->_sections['actions_loop']['start']+1)/abs($this->_sections['actions_loop']['step'])), $this->_sections['actions_loop']['max']);
    if ($this->_sections['actions_loop']['total'] == 0)
        $this->_sections['actions_loop']['show'] = false;
} else
    $this->_sections['actions_loop']['total'] = 0;
if ($this->_sections['actions_loop']['show']):

            for ($this->_sections['actions_loop']['index'] = $this->_sections['actions_loop']['start'], $this->_sections['actions_loop']['iteration'] = 1;
                 $this->_sections['actions_loop']['iteration'] <= $this->_sections['actions_loop']['total'];
                 $this->_sections['actions_loop']['index'] += $this->_sections['actions_loop']['step'], $this->_sections['actions_loop']['iteration']++):
$this->_sections['actions_loop']['rownum'] = $this->_sections['actions_loop']['iteration'];
$this->_sections['actions_loop']['index_prev'] = $this->_sections['actions_loop']['index'] - $this->_sections['actions_loop']['step'];
$this->_sections['actions_loop']['index_next'] = $this->_sections['actions_loop']['index'] + $this->_sections['actions_loop']['step'];
$this->_sections['actions_loop']['first']      = ($this->_sections['actions_loop']['iteration'] == 1);
$this->_sections['actions_loop']['last']       = ($this->_sections['actions_loop']['iteration'] == $this->_sections['actions_loop']['total']);
?>
            <div id='action_<?php echo $this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_id']; ?>
' class='profile_action'>
              <table cellpadding='0' cellspacing='0'>
                <tr>
                  <td valign='top'><img src='./images/icons/<?php echo $this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_icon']; ?>
' border='0' class='icon'></td>
                  <td valign='top' width='100%'>
                    <div class='profile_action_date'>
                      <?php $this->assign('action_date', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_date'])); ?>
                      <?php echo sprintf(SELanguage::_get($this->_tpl_vars['action_date'][0]), $this->_tpl_vars['action_date'][1]); ?>
                    </div>
                    <?php $this->assign('action_media', ''); ?>
                    <?php if ($this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_media'] !== FALSE): 
 ob_start(); 
 unset($this->_sections['action_media_loop']);
$this->_sections['action_media_loop']['name'] = 'action_media_loop';
$this->_sections['action_media_loop']['loop'] = is_array($_loop=$this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_media']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['action_media_loop']['show'] = true;
$this->_sections['action_media_loop']['max'] = $this->_sections['action_media_loop']['loop'];
$this->_sections['action_media_loop']['step'] = 1;
$this->_sections['action_media_loop']['start'] = $this->_sections['action_media_loop']['step'] > 0 ? 0 : $this->_sections['action_media_loop']['loop']-1;
if ($this->_sections['action_media_loop']['show']) {
    $this->_sections['action_media_loop']['total'] = $this->_sections['action_media_loop']['loop'];
    if ($this->_sections['action_media_loop']['total'] == 0)
        $this->_sections['action_media_loop']['show'] = false;
} else
    $this->_sections['action_media_loop']['total'] = 0;
if ($this->_sections['action_media_loop']['show']):

            for ($this->_sections['action_media_loop']['index'] = $this->_sections['action_media_loop']['start'], $this->_sections['action_media_loop']['iteration'] = 1;
                 $this->_sections['action_media_loop']['iteration'] <= $this->_sections['action_media_loop']['total'];
                 $this->_sections['action_media_loop']['index'] += $this->_sections['action_media_loop']['step'], $this->_sections['action_media_loop']['iteration']++):
$this->_sections['action_media_loop']['rownum'] = $this->_sections['action_media_loop']['iteration'];
$this->_sections['action_media_loop']['index_prev'] = $this->_sections['action_media_loop']['index'] - $this->_sections['action_media_loop']['step'];
$this->_sections['action_media_loop']['index_next'] = $this->_sections['action_media_loop']['index'] + $this->_sections['action_media_loop']['step'];
$this->_sections['action_media_loop']['first']      = ($this->_sections['action_media_loop']['iteration'] == 1);
$this->_sections['action_media_loop']['last']       = ($this->_sections['action_media_loop']['iteration'] == $this->_sections['action_media_loop']['total']);
?><a href='<?php echo $this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_media'][$this->_sections['action_media_loop']['index']]['actionmedia_link']; ?>
'><img src='<?php echo $this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_media'][$this->_sections['action_media_loop']['index']]['actionmedia_path']; ?>
' border='0' width='<?php echo $this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_media'][$this->_sections['action_media_loop']['index']]['actionmedia_width']; ?>
' class='recentaction_media'></a><?php endfor; endif; 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('action_media', ob_get_contents());ob_end_clean(); 
 endif; ?>
                    <?php $this->_tpl_vars['action_text'] = vsprintf(SELanguage::_get($this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_text']), $this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_vars']);; ?>
                    <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['action_text'])) ? $this->_run_mod_handler('replace', true, $_tmp, "[media]", $this->_tpl_vars['action_media']) : smarty_modifier_replace($_tmp, "[media]", $this->_tpl_vars['action_media'])))) ? $this->_run_mod_handler('choptext', true, $_tmp, 50, "<br>") : smarty_modifier_choptext($_tmp, 50, "<br>")); ?>

                  </td>
                </tr>
              </table>
            </div>
          <?php endfor; endif; ?>
        </div>
      <?php endif; ?>
      
    </div>
    





        <?php if ($this->_tpl_vars['total_members_all'] != 0): ?>
      <div id='group_members'<?php if ($this->_tpl_vars['v'] != 'members'): ?> style='display: none;'<?php endif; ?>>

                <?php echo '
        <script type="text/javascript">
        <!-- 
	  function friend_update(status, id) {
	    if(status == \'pending\') {
	      if($(\'addfriend_\'+id))
	        $(\'addfriend_\'+id).style.display = \'none\';
	    } else if(status == \'remove\') {
	      if($(\'addfriend_\'+id))
	        $(\'addfriend_\'+id).style.display = \'none\';
	    }
	  }
        //-->
        </script>
        '; ?>


	<table cellpadding='0' cellspacing='0' width='100%'>
	<tr>
	<td valign='top'>
          <div class='group_headline'><?php echo SELanguage::_get(2000220); ?> (<?php echo $this->_tpl_vars['total_members']; ?>
)</div>
	</td>
	<td valign='top' align='right'>
	  <?php if ($this->_tpl_vars['search'] == ""): ?>
	    <div id='group_members_searchbox_link'>
	      <a href='javascript:void(0);' onClick="$('group_members_searchbox_link').style.display='none';$('group_members_searchbox').style.display='block';$('group_members_searchbox_input').focus();"><?php echo SELanguage::_get(2000221); ?></a>
	    </div>
	  <?php endif; ?>
	  <div id='group_members_searchbox' style='text-align: right;<?php if ($this->_tpl_vars['search'] == ""): ?> display: none;<?php endif; ?>'>
	    <form action='group.php' method='post'>
	    <input type='text' maxlength='100' size='30' class='text' name='search' value='<?php echo $this->_tpl_vars['search']; ?>
' id='group_members_searchbox_input' />
	    <input type='submit' class='button' value='<?php echo SELanguage::_get(646); ?>' />
	    <input type='hidden' name='p' value='<?php echo $this->_tpl_vars['p_members']; ?>
' />
	    <input type='hidden' name='v' value='members' />
	    <input type='hidden' name='group_id' value='<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
' />
	    </form>
	  </div>
	</td>
	</tr>
	</table>

		<?php if ($this->_tpl_vars['search'] != "" && $this->_tpl_vars['total_members'] == 0): ?>
	  <br>
	  <table cellpadding='0' cellspacing='0'>
	  <tr><td class='result'>
	    <img src='./images/icons/bulb16.gif' border='0' class='icon'><?php echo SELanguage::_get(2000222); ?>
	  </td></tr>
	  </table>
	<?php endif; ?>

        	<?php if ($this->_tpl_vars['maxpage_members'] > 1): ?>
	  <div style='text-align: center;'>
	    <?php if ($this->_tpl_vars['p_members'] != 1): ?><a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['group']->group_info['group_id']); ?>
&v=members&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p_members']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?><font class='disabled'>&#171; <?php echo SELanguage::_get(182); ?></font><?php endif; ?>
	    <?php if ($this->_tpl_vars['p_start_members'] == $this->_tpl_vars['p_end_members']): ?>
	      &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start_members'], $this->_tpl_vars['total_members']); ?> &nbsp;|&nbsp; 
	    <?php else: ?>
	      &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start_members'], $this->_tpl_vars['p_end_members'], $this->_tpl_vars['total_members']); ?> &nbsp;|&nbsp; 
	    <?php endif; ?>
	    <?php if ($this->_tpl_vars['p_members'] != $this->_tpl_vars['maxpage_members']): ?><a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['group']->group_info['group_id']); ?>
&v=members&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p_members']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: ?><font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font><?php endif; ?>
	  </div>
	<?php endif; ?>

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
          <div class='group_members_result' style='overflow: hidden;'>
            <div class='group_members_photo'>
	      <a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_username']); ?>
'><img src='<?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_photo('./images/nophoto.gif'); ?>
' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_photo('./images/nophoto.gif'),'90','90','w'); ?>
' border='0' alt="<?php echo sprintf(SELanguage::_get(509), $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_displayname_short); ?>" class='photo'></a>
            </div>
            <div class='profile_friend_info'>
              <div class='profile_friend_name'><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_username']); ?>
'><?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_displayname; ?>
</a></div>
	      <div class='profile_friend_details'>
	        <?php if ($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_dateupdated'] != 0): ?><div><?php echo SELanguage::_get(849); ?> <?php $this->assign('last_updated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_dateupdated'])); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['last_updated'][0]), $this->_tpl_vars['last_updated'][1]); ?></div><?php endif; ?>
		<?php ob_start(); 
 if ($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_rank'] == 2): 
 echo SELanguage::_get(2000179); 
 elseif ($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_rank'] == 1 && $this->_tpl_vars['group']->groupowner_level_info['level_group_officers'] == 1): 
 echo SELanguage::_get(2000180); 
 endif; 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('member_rank', ob_get_contents());ob_end_clean(); ?>
	        <div><?php if ($this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_title'] != "" && $this->_tpl_vars['group']->groupowner_level_info['level_group_titles'] == 1): 
 echo sprintf(SELanguage::_get(2000182), $this->_tpl_vars['member_rank'], $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['groupmember_title']); 
 elseif ($this->_tpl_vars['member_rank'] != ""): 
 echo sprintf(SELanguage::_get(2000178), $this->_tpl_vars['member_rank']); 
 endif; ?></div>
	      </div>
            </div>
	    <div class='profile_friend_options'>
              <?php if (! $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->is_viewers_friend && ! $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->is_viewer_blocklisted && $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_id'] != $this->_tpl_vars['user']->user_info['user_id'] && $this->_tpl_vars['user']->user_exists != 0): ?><div id='addfriend_<?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_id']; ?>
'><a href="javascript:TB_show('<?php echo SELanguage::_get(876); ?>', 'user_friends_manage.php?user=<?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_username']; ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');"><?php echo SELanguage::_get(838); ?></a></div><?php endif; ?>
              <?php if (! $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->is_viewer_blocklisted && ( $this->_tpl_vars['user']->level_info['level_message_allow'] == 2 || ( $this->_tpl_vars['user']->level_info['level_message_allow'] == 1 && $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->is_viewers_friend ) ) && $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_id'] != $this->_tpl_vars['user']->user_info['user_id']): ?><a href="javascript:TB_show('<?php echo SELanguage::_get(784); ?>', 'user_messages_new.php?to_user=<?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_displayname; ?>
&to_id=<?php echo $this->_tpl_vars['members'][$this->_sections['member_loop']['index']]['member']->user_info['user_username']; ?>
&TB_iframe=true&height=400&width=450', '', './images/trans.gif');"><?php echo SELanguage::_get(839); ?></a><?php endif; ?>
            </div>
	    <div style='clear: both;'></div>
          </div>
	  <?php if (! $this->_sections['member_loop']['last']): ?><div style='clear: both; height: 8px;'></div><?php endif; ?>
        <?php endfor; endif; ?>


        	<?php if ($this->_tpl_vars['maxpage_members'] > 1): ?>
	  <div style='text-align: center;'>
	    <?php if ($this->_tpl_vars['p_members'] != 1): ?><a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['group']->group_info['group_id']); ?>
&v=members&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p_members']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?><font class='disabled'>&#171; <?php echo SELanguage::_get(182); ?></font><?php endif; ?>
	    <?php if ($this->_tpl_vars['p_start_members'] == $this->_tpl_vars['p_end_members']): ?>
	      &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start_members'], $this->_tpl_vars['total_members']); ?> &nbsp;|&nbsp; 
	    <?php else: ?>
	      &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start_members'], $this->_tpl_vars['p_end_members'], $this->_tpl_vars['total_members']); ?> &nbsp;|&nbsp; 
	    <?php endif; ?>
	    <?php if ($this->_tpl_vars['p_members'] != $this->_tpl_vars['maxpage_members']): ?><a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['group']->group_info['group_id']); ?>
&v=members&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p_members']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: ?><font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font><?php endif; ?>
	  </div>
	<?php endif; ?>

      </div>
    <?php endif; ?>
    



        <?php if ($this->_tpl_vars['allowed_to_upload'] != 0 || $this->_tpl_vars['total_files'] != 0): ?>

            <div id='group_photos'<?php if ($this->_tpl_vars['v'] != 'photos'): ?> style='display: none;'<?php endif; ?>>

        <div>
         <div class='group_headline' style='float: left;'><?php echo SELanguage::_get(2000232); ?> (<span id='group_<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
_totalfiles'><?php echo $this->_tpl_vars['total_files']; ?>
</span>)</div>
          <?php if ($this->_tpl_vars['allowed_to_upload']): ?>
            <div style='float: right; padding-left: 10px;'>
              <a href="javascript:TB_show('<?php echo SELanguage::_get(2000251); ?>', 'user_group_upload.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&TB_iframe=true&height=300&width=500', '', './images/trans.gif');"><img src='./images/icons/group_addimages16.gif' border='0' class='button' style='float: left;'><?php echo SELanguage::_get(2000251); ?></a>
              <div style='clear: both; height: 0px;'></div>
            </div>
	  <?php endif; ?>
          <div style='clear: both; height: 0px;'></div>
        </div>

                <div id="group_<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
_nofiles" style='display: none;'><img src='./images/icons/bulb16.gif' border='0' class='icon'><?php echo SELanguage::_get(2000252); ?></div>
        <div id="group_<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
_files" style='margin-left: auto; margin-right: auto;'></div>
      
        <?php 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(182,183,184,185));
$javascript_lang_import_first = TRUE;
if( is_array($javascript_lang_import_list) && !empty($javascript_lang_import_list) )
{
  echo "\n<script type='text/javascript'>\n<!--\n";
  echo "SocialEngine.Language.Import({\n";
  foreach( $javascript_lang_import_list as $javascript_import_id )
  {
    if( !$javascript_lang_import_first ) echo ",\n";
    echo "  ".$javascript_import_id." : '".addslashes(SE_Language::_get($javascript_import_id))."'";
    $javascript_lang_import_first = FALSE;
  }
  echo "\n});\n//-->\n</script>\n";
}
 ?>


        <script type="text/javascript" src="./include/js/class_group_files.js"></script>      

        <script type="text/javascript">
        
          SocialEngine.GroupFiles = new SocialEngineAPI.GroupFiles({
	    'paginate' : true,
	    'cpp' : 18,

	    'group_id' : <?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
,
	    'group_dir' : '<?php echo $this->_tpl_vars['group']->group_dir($this->_tpl_vars['group']->group_info['group_id']); ?>
'
          });
        
          SocialEngine.RegisterModule(SocialEngine.GroupFiles);

          function getFiles(direction)
          {
            SocialEngine.GroupFiles.getFiles(direction);
          }

        </script>

      </div>

    <?php endif; ?>
    






        <?php if ($this->_tpl_vars['allowed_to_discuss'] != 0 || $this->_tpl_vars['total_topics'] != 0): ?>

      <div id='group_discussions'<?php if ($this->_tpl_vars['v'] != 'discussions'): ?> style='display: none;'<?php endif; ?>>

        <div>
          <div class='group_headline' style='float: left;'><?php echo SELanguage::_get(2000257); ?> (<?php echo $this->_tpl_vars['total_topics']; ?>
)</div>
          <?php if ($this->_tpl_vars['allowed_to_discuss']): ?>
            <div style='float: right;'>
              <a href='group_discussion_post.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'><img src='./images/icons/group_discussion_post16.gif' border='0' class='button' style='float: left;'><?php echo SELanguage::_get(2000258); ?></a>
              <div style='clear: both; height: 0px;'></div>
            </div>
          <?php endif; ?>
          <div style='clear: both; height: 0px;'></div>
        </div>

                <?php if ($this->_tpl_vars['total_topics'] == 0): ?>
          <br>
          <table cellpadding='0' cellspacing='0'>
          <tr><td class='result'>
            <img src='./images/icons/bulb16.gif' border='0' class='icon'><?php echo SELanguage::_get(2000259); ?>
          </td></tr>
          </table>
        <?php endif; ?>

                <?php if ($this->_tpl_vars['maxpage_topics'] > 1): ?>
          <div style='text-align: center;'>
            <?php if ($this->_tpl_vars['p_topics'] != 1): ?><a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['group']->group_info['group_id']); ?>
&v=discussions&p=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p_topics']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?><font class='disabled'>&#171; <?php echo SELanguage::_get(182); ?></font><?php endif; ?>
            <?php if ($this->_tpl_vars['p_start_topics'] == $this->_tpl_vars['p_end_topics']): ?>
              &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start_topics'], $this->_tpl_vars['total_topics']); ?> &nbsp;|&nbsp; 
            <?php else: ?>
              &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start_topics'], $this->_tpl_vars['p_end_topics'], $this->_tpl_vars['total_topics']); ?> &nbsp;|&nbsp; 
            <?php endif; ?>
            <?php if ($this->_tpl_vars['p_topics'] != $this->_tpl_vars['maxpage_topics']): ?><a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['group']->group_info['group_id']); ?>
&v=discussions&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p_topics']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: ?><font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font><?php endif; ?>
          </div>
        <?php endif; ?>


        <table cellpadding='0' cellspacing='0' width='100%' class='group_discussion_table' style='margin-top: 5px; margin-bottom: 5px;'>
        <?php unset($this->_sections['topic_loop']);
$this->_sections['topic_loop']['name'] = 'topic_loop';
$this->_sections['topic_loop']['loop'] = is_array($_loop=$this->_tpl_vars['topics']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['topic_loop']['show'] = true;
$this->_sections['topic_loop']['max'] = $this->_sections['topic_loop']['loop'];
$this->_sections['topic_loop']['step'] = 1;
$this->_sections['topic_loop']['start'] = $this->_sections['topic_loop']['step'] > 0 ? 0 : $this->_sections['topic_loop']['loop']-1;
if ($this->_sections['topic_loop']['show']) {
    $this->_sections['topic_loop']['total'] = $this->_sections['topic_loop']['loop'];
    if ($this->_sections['topic_loop']['total'] == 0)
        $this->_sections['topic_loop']['show'] = false;
} else
    $this->_sections['topic_loop']['total'] = 0;
if ($this->_sections['topic_loop']['show']):

            for ($this->_sections['topic_loop']['index'] = $this->_sections['topic_loop']['start'], $this->_sections['topic_loop']['iteration'] = 1;
                 $this->_sections['topic_loop']['iteration'] <= $this->_sections['topic_loop']['total'];
                 $this->_sections['topic_loop']['index'] += $this->_sections['topic_loop']['step'], $this->_sections['topic_loop']['iteration']++):
$this->_sections['topic_loop']['rownum'] = $this->_sections['topic_loop']['iteration'];
$this->_sections['topic_loop']['index_prev'] = $this->_sections['topic_loop']['index'] - $this->_sections['topic_loop']['step'];
$this->_sections['topic_loop']['index_next'] = $this->_sections['topic_loop']['index'] + $this->_sections['topic_loop']['step'];
$this->_sections['topic_loop']['first']      = ($this->_sections['topic_loop']['iteration'] == 1);
$this->_sections['topic_loop']['last']       = ($this->_sections['topic_loop']['iteration'] == $this->_sections['topic_loop']['total']);
?>
          <tr>
          <td class='group_discussion_topic<?php echo smarty_function_cycle(array('values' => "1,1,1,2,2,2"), $this);?>
' nowrap='nowrap' style='text-align: center;' width='40'>
            <?php echo sprintf(SELanguage::_get(2000260), $this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['total_posts']-1); ?>
          </td>
          <td class='group_discussion_topic<?php echo smarty_function_cycle(array('values' => "1,1,1,2,2,2"), $this);?>
'>
            <table cellpadding='0' cellspacing='0'>
            <tr>
            <td style='vertical-align: top;'>
              <?php if (! $this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['grouptopic_closed']): ?>
                <div><img src='./images/icons/group_discussion16.gif' border='0' class='icon'></div>
              <?php else: ?>
                <div><img src='./images/icons/group_discussion_closed16.gif' border='0' class='icon'></div>
              <?php endif; ?>
              <?php if ($this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['grouptopic_sticky']): ?>
                <div><img src='./images/icons/group_discussion_stickied16.gif' border='0' class='icon' /></div>
              <?php endif; ?>
            </td>
            <td style='vertical-align: top;'>
              <div style='font-weight: bold;'>
                <a href='<?php echo $this->_tpl_vars['url']->url_create('group_discussion',@NULL,$this->_tpl_vars['group']->group_info['group_id'],$this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['grouptopic_id']); ?>
'>
                  <?php echo $this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['grouptopic_subject']; ?>

                </a>
              </div>
              <div style='color: #777777; font-size: 9px;'>
                <?php $this->assign('datecreated_vars', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['grouptopic_date'])); ?>
                <?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['datecreated_vars'][0]), $this->_tpl_vars['datecreated_vars'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('datecreated', ob_get_contents());ob_end_clean(); ?>
                <?php if ($this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['creator']->user_exists): ?>
                  <?php echo sprintf(SELanguage::_get(2000261), $this->_tpl_vars['datecreated'], $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['creator']->user_info['user_username']), $this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['creator']->user_displayname); ?>
                <?php else: ?>
                  <?php if ($this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['grouptopic_creatoruser_id'] != 0): ?>
                    <?php ob_start(); 
 echo SELanguage::_get(1071); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('creator', ob_get_contents());ob_end_clean(); ?>
                  <?php else: ?>
                    <?php ob_start(); 
 echo SELanguage::_get(835); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('creator', ob_get_contents());ob_end_clean(); ?>
                  <?php endif; ?>
                  <?php echo sprintf(SELanguage::_get(2000261), $this->_tpl_vars['datecreated'], $this->_tpl_vars['creator']); ?>
                <?php endif; ?>
                - <?php echo sprintf(SELanguage::_get(2000262), $this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['grouptopic_views']); ?>
                <?php if ($this->_tpl_vars['group']->user_rank == 2 || $this->_tpl_vars['group']->user_rank == 1): ?>
                 - [ <a href='javascript:void(0);' onClick="confirmDelete('<?php echo $this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['grouptopic_id']; ?>
')"><?php echo SELanguage::_get(155); ?></a> ]
                <?php endif; ?>
              </div>
            </td>
            </tr>
            </table>
          </td>
          <td class='group_discussion_topic<?php echo smarty_function_cycle(array('values' => "1,1,1,2,2,2"), $this);?>
_end' nowrap='nowrap'>
            <table cellpadding='0' cellspacing='0' width='100%'>
            <tr>
            <td width='1'>
              <img src='<?php if ($this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['lastposter']->user_exists): 
 echo $this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['lastposter']->user_photo("./images/nophoto.gif",'TRUE'); 
 else: ?>./images/nophoto.gif<?php endif; ?>' class='photo' width='35' height='35' />
            </td>
            <td style='padding-left: 8px;'>
              <div>
                <?php if ($this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['lastposter']->user_exists): ?>
                  <?php echo sprintf(SELanguage::_get(2000263), $this->_tpl_vars['url']->url_create('group_discussion_post',@NULL,$this->_tpl_vars['group']->group_info['group_id'],$this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['grouptopic_id'],$this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['grouppost_id']), $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['lastposter']->user_info['user_username']), $this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['lastposter']->user_displayname); ?>
                <?php else: ?>
                  <?php if ($this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['grouppost_authoruser_id'] != 0): ?>
                    <?php ob_start(); 
 echo SELanguage::_get(1071); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('lastposter', ob_get_contents());ob_end_clean(); ?>
                  <?php else: ?>
                    <?php ob_start(); 
 echo SELanguage::_get(835); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('lastposter', ob_get_contents());ob_end_clean(); ?>
                  <?php endif; ?>
                  <?php echo sprintf(SELanguage::_get(2000265), $this->_tpl_vars['url']->url_create('group_discussion_post',@NULL,$this->_tpl_vars['group']->group_info['group_id'],$this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['grouptopic_id'],$this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['grouppost_id']), $this->_tpl_vars['lastposter']); ?>
                <?php endif; ?>
              </div>
              <div>
                <?php $this->assign('grouppost_date', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['topics'][$this->_sections['topic_loop']['index']]['grouppost_date'])); ?>
                <?php echo sprintf(SELanguage::_get($this->_tpl_vars['grouppost_date'][0]), $this->_tpl_vars['grouppost_date'][1]); ?>
              </div>
            </td>
            </tr>
            </table>
          </td>
          </tr>
        <?php endfor; endif; ?>
        </table>


                <?php if ($this->_tpl_vars['maxpage_topics'] > 1): ?>
          <div style='text-align: center;'>
            <?php if ($this->_tpl_vars['p_topics'] != 1): ?><a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['group']->group_info['group_id']); ?>
&v=discussions&p=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p_topics']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?><font class='disabled'>&#171; <?php echo SELanguage::_get(182); ?></font><?php endif; ?>
            <?php if ($this->_tpl_vars['p_start_topics'] == $this->_tpl_vars['p_end_topics']): ?>
              &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start_topics'], $this->_tpl_vars['total_topics']); ?> &nbsp;|&nbsp; 
            <?php else: ?>
              &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start_topics'], $this->_tpl_vars['p_end_topics'], $this->_tpl_vars['total_topics']); ?> &nbsp;|&nbsp; 
            <?php endif; ?>
            <?php if ($this->_tpl_vars['p_topics'] != $this->_tpl_vars['maxpage_topics']): ?><a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['group']->group_info['group_id']); ?>
&v=discussions&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p_topics']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: ?><font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font><?php endif; ?>
          </div>
        <?php endif; ?>

      </div>


      <?php if ($this->_tpl_vars['group']->user_rank == 2 || $this->_tpl_vars['group']->user_rank == 1): ?>
                <?php echo '
        <script type="text/javascript">
        <!-- 
        var topic_id = 0;
        function confirmDelete(id) {
          topic_id = id;
          TB_show(\''; 
 echo SELanguage::_get(2000266); 
 echo '\', \'#TB_inline?height=150&width=300&inlineId=confirmdelete\', \'\', \'../images/trans.gif\');
        }
  
        function deleteTopic() {
          window.location = \''; 
 echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['group']->group_info['group_id']); 
 echo '&v=discussions&p='; 
 echo $this->_tpl_vars['p_topics']; 
 echo '&task=topic_delete&grouptopic_id=\'+topic_id;
        }
        //-->
        </script>
        '; ?>



                <div style='display: none;' id='confirmdelete'>
          <div style='margin-top: 10px;'>
            <?php echo SELanguage::_get(2000267); ?>
          </div>
          <br>
          <input type='button' class='button' value='<?php echo SELanguage::_get(175); ?>' onClick='parent.TB_remove();parent.deleteTopic();'> <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='parent.TB_remove();'>
        </div>
      <?php endif; ?>

    <?php endif; ?>
    





        <?php if ($this->_tpl_vars['allowed_to_comment'] != 0 || $this->_tpl_vars['total_comments'] != 0): ?>


            <div id='group_comments'<?php if ($this->_tpl_vars['v'] != 'comments'): ?> style='display: none;'<?php endif; ?>>

            <div id="group_<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
_postcomment"></div>
      <div id="group_<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
_comments" style='margin-left: auto; margin-right: auto;'></div>
      
      <?php 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(39,155,175,182,183,184,185,187,784,787,829,830,831,832,833,834,835,854,856,891,1025,1026,1032,1034,1071));
$javascript_lang_import_first = TRUE;
if( is_array($javascript_lang_import_list) && !empty($javascript_lang_import_list) )
{
  echo "\n<script type='text/javascript'>\n<!--\n";
  echo "SocialEngine.Language.Import({\n";
  foreach( $javascript_lang_import_list as $javascript_import_id )
  {
    if( !$javascript_lang_import_first ) echo ",\n";
    echo "  ".$javascript_import_id." : '".addslashes(SE_Language::_get($javascript_import_id))."'";
    $javascript_lang_import_first = FALSE;
  }
  echo "\n});\n//-->\n</script>\n";
}
 ?>
      
      <?php echo '
      <style type=\'text/css\'>
	div.comment_headline {
	  font-size: 13px; 
	  margin-bottom: 7px;
	  font-weight: bold;
	  padding: 0px;
	  border: none;
	  background: none;
	  color: #555555;
	}
      </style>
      '; ?>


      <script type="text/javascript">
        
        SocialEngine.GroupComments = new SocialEngineAPI.Comments({
            'canComment' : <?php if ($this->_tpl_vars['allowed_to_comment']): ?>true<?php else: ?>false<?php endif; ?>,
            'commentHTML' : '<?php echo ((is_array($_tmp=$this->_tpl_vars['setting']['setting_comment_html'])) ? $this->_run_mod_handler('replace', true, $_tmp, ",", ", ") : smarty_modifier_replace($_tmp, ",", ", ")); ?>
',
            'commentCode' : <?php if ($this->_tpl_vars['setting']['setting_comment_code']): ?>true<?php else: ?>false<?php endif; ?>,
            
            'type' : 'group',
            'typeIdentifier' : 'group_id',
            'typeID' : <?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
,
            
            'typeTab' : 'groups',
            'typeCol' : 'group',
            
            'initialTotal' : <?php echo ((is_array($_tmp=@$this->_tpl_vars['total_comments'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
,
            
            'paginate' : true,
            'cpp' : 10,
            
            'object_owner' : 'group',
            'object_owner_id' : <?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>

        });
        
        SocialEngine.RegisterModule(SocialEngine.GroupComments);
       
        // Backwards
        function addComment(is_error, comment_body, comment_date)
        {
          SocialEngine.GroupComments.addComment(is_error, comment_body, comment_date);
        }
        
        function getComments(direction)
        {
          SocialEngine.GroupComments.getComments(direction);
        }

      </script>


      </div>

    <?php endif; ?>
    


  <?php endif; ?>
      </div>


  </div>


</td>
</tr>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>