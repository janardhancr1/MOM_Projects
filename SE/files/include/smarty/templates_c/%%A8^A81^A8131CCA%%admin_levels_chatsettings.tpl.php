<?php /* Smarty version 2.6.14, created on 2010-04-30 02:52:40
         compiled from admin_levels_chatsettings.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'admin_levels_chatsettings.tpl', 11, false),array('modifier', 'count', 'admin_levels_chatsettings.tpl', 11, false),)), $this);
?><?php
SELanguage::_preload_multi(288,282,3501021,3501022,191,3501023,3501024,3501025,3501026,3501027,3501028,3501029,173,285,286,287);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h2><?php echo sprintf(SELanguage::_get(288), $this->_tpl_vars['level_info']['level_name']); ?></h2>
<?php echo SELanguage::_get(282); ?>

<table cellspacing='0' cellpadding='0' width='100%' style='margin-top: 20px;'>
<tr>
<td class='vert_tab0'>&nbsp;</td>
<td valign='top' class='pagecell' rowspan='<?php echo smarty_function_math(array('equation' => "x+5",'x' => count($this->_tpl_vars['level_menu'])), $this);?>
'>

  <h2><?php echo SELanguage::_get(3501021); ?></h2>
  <?php echo SELanguage::_get(3501022); ?>

  <br><br>

    <?php if ($this->_tpl_vars['result'] != 0): ?>
    <div class='success'><img src='../images/success.gif' class='icon' border='0'> <?php echo SELanguage::_get(191); ?></div>
  <?php endif; ?>

    <?php if ($this->_tpl_vars['is_error'] != 0): ?>
    <div class='error'><img src='../images/error.gif' class='icon' border='0'> <?php echo $this->_tpl_vars['error_message']; ?>
</div>
  <?php endif; ?>
  
  <form action='admin_levels_chatsettings.php' method='POST'>


  
  <table cellpadding='0' cellspacing='0' width='600'><td class='header'>
    <?php echo SELanguage::_get(3501023); ?>
  </td></tr><td class='setting1'>
    <?php echo SELanguage::_get(3501024); ?>
  </td></tr>
  <tr><td class='setting2'>
        <table cellpadding='2' cellspacing='0'><tr><td>
      <input type='radio' name='level_chat_allow' id='level_chat_allow_1' value='1'<?php if ($this->_tpl_vars['level_info']['level_chat_allow']): ?> CHECKED<?php endif; ?> />
    </td><td>
      <label for='setting_chat_enabled_1'><?php echo SELanguage::_get(3501025); ?></label>
    </td></tr>
    <tr><td>
      <input type='radio' name='level_chat_allow' id='level_chat_allow_0' value='0'<?php if (! $this->_tpl_vars['level_info']['level_chat_allow']): ?> CHECKED<?php endif; ?> />
    </td><td>
      <label for='setting_chat_enabled_0'><?php echo SELanguage::_get(3501026); ?></label></td>
    </tr></table>
  </td></tr><td class='setting1'>
    <?php echo SELanguage::_get(3501027); ?>
  </td></tr>
  <tr><td class='setting2'>
        <table cellpadding='2' cellspacing='0'><tr><td>
      <input type='radio' name='level_im_allow' id='level_im_allow_1' value='1'<?php if ($this->_tpl_vars['level_info']['level_im_allow']): ?> CHECKED<?php endif; ?> />
    </td><td>
      <label for='setting_im_enabled_1'><?php echo SELanguage::_get(3501028); ?></label>
    </td></tr>
    <tr><td>
      <input type='radio' name='level_im_allow' id='level_im_allow_0' value='0'<?php if (! $this->_tpl_vars['level_info']['level_im_allow']): ?> CHECKED<?php endif; ?> />
    </td><td>
      <label for='setting_im_enabled_0'><?php echo SELanguage::_get(3501029); ?></label></td>
    </tr></table>
  </td></tr></table>
  <br />

  <input type='submit' class='button' value='<?php echo SELanguage::_get(173); ?>'>
  <input type='hidden' name='task' value='dosave'>
  <input type='hidden' name='level_id' value='<?php echo $this->_tpl_vars['level_id']; ?>
'>
  </form>

</td>
</tr>

<tr><td width='100' nowrap='nowrap' class='vert_tab'><div style='width: 100px;'><a href='admin_levels_edit.php?level_id=<?php echo $this->_tpl_vars['level_info']['level_id']; ?>
'><?php echo SELanguage::_get(285); ?></a></div></td></tr>
<tr><td width='100' nowrap='nowrap' class='vert_tab' style='border-right: none; border-top: none;'><div style='width: 100px;'><a href='admin_levels_usersettings.php?level_id=<?php echo $this->_tpl_vars['level_info']['level_id']; ?>
'><?php echo SELanguage::_get(286); ?></a></div></td></tr>
<tr><td width='100' nowrap='nowrap' class='vert_tab' style='border-top: none;'><div style='width: 100px;'><a href='admin_levels_messagesettings.php?level_id=<?php echo $this->_tpl_vars['level_info']['level_id']; ?>
'><?php echo SELanguage::_get(287); ?></a></div></td></tr>
<?php $_from = $this->_tpl_vars['global_plugins']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['plugin_k'] => $this->_tpl_vars['plugin_v']):

 unset($this->_sections['level_page_loop']);
$this->_sections['level_page_loop']['name'] = 'level_page_loop';
$this->_sections['level_page_loop']['loop'] = is_array($_loop=$this->_tpl_vars['plugin_v']['plugin_pages_level']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['level_page_loop']['show'] = true;
$this->_sections['level_page_loop']['max'] = $this->_sections['level_page_loop']['loop'];
$this->_sections['level_page_loop']['step'] = 1;
$this->_sections['level_page_loop']['start'] = $this->_sections['level_page_loop']['step'] > 0 ? 0 : $this->_sections['level_page_loop']['loop']-1;
if ($this->_sections['level_page_loop']['show']) {
    $this->_sections['level_page_loop']['total'] = $this->_sections['level_page_loop']['loop'];
    if ($this->_sections['level_page_loop']['total'] == 0)
        $this->_sections['level_page_loop']['show'] = false;
} else
    $this->_sections['level_page_loop']['total'] = 0;
if ($this->_sections['level_page_loop']['show']):

            for ($this->_sections['level_page_loop']['index'] = $this->_sections['level_page_loop']['start'], $this->_sections['level_page_loop']['iteration'] = 1;
                 $this->_sections['level_page_loop']['iteration'] <= $this->_sections['level_page_loop']['total'];
                 $this->_sections['level_page_loop']['index'] += $this->_sections['level_page_loop']['step'], $this->_sections['level_page_loop']['iteration']++):
$this->_sections['level_page_loop']['rownum'] = $this->_sections['level_page_loop']['iteration'];
$this->_sections['level_page_loop']['index_prev'] = $this->_sections['level_page_loop']['index'] - $this->_sections['level_page_loop']['step'];
$this->_sections['level_page_loop']['index_next'] = $this->_sections['level_page_loop']['index'] + $this->_sections['level_page_loop']['step'];
$this->_sections['level_page_loop']['first']      = ($this->_sections['level_page_loop']['iteration'] == 1);
$this->_sections['level_page_loop']['last']       = ($this->_sections['level_page_loop']['iteration'] == $this->_sections['level_page_loop']['total']);
?>
  <tr><td width='100' nowrap='nowrap' class='vert_tab' style='border-top: none;<?php if ($this->_tpl_vars['plugin_v']['plugin_pages_level'][$this->_sections['level_page_loop']['index']]['page'] == $this->_tpl_vars['page']): ?> border-right: none;<?php endif; ?>'><div style='width: 100px;'><a href='<?php echo $this->_tpl_vars['plugin_v']['plugin_pages_level'][$this->_sections['level_page_loop']['index']]['link']; ?>
?level_id=<?php echo $this->_tpl_vars['level_info']['level_id']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['plugin_v']['plugin_pages_level'][$this->_sections['level_page_loop']['index']]['title']); ?></a></div></td></tr>
<?php endfor; endif; 
 endforeach; endif; unset($_from); ?>

<tr>
<td class='vert_tab0'>
  <div style='height: 1800px;'>&nbsp;</div>
</td>
</tr>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>