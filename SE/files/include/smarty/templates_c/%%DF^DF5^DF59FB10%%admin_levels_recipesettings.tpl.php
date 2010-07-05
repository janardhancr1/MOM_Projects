<?php /* Smarty version 2.6.14, created on 2010-03-29 01:53:41
         compiled from admin_levels_recipesettings.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'admin_levels_recipesettings.tpl', 11, false),array('modifier', 'count', 'admin_levels_recipesettings.tpl', 11, false),array('modifier', 'in_array', 'admin_levels_recipesettings.tpl', 111, false),)), $this);
?><?php
SELanguage::_preload_multi(288,282,7000001,7000006,191,7000007,7000008,7000141,7000142,7000143,7000144,7000011,7000012,7000013,7000014,7000015,7000016,7000017,7000018,7000019,7000020,7000021,7000022,173,285,286,287);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h2><?php echo sprintf(SELanguage::_get(288), $this->_tpl_vars['level_name']); ?></h2>
<?php echo SELanguage::_get(282); ?>

<table cellspacing='0' cellpadding='0' width='100%' style='margin-top: 20px;'>
<tr>
<td class='vert_tab0'>&nbsp;</td>
<td valign='top' class='pagecell' rowspan='<?php echo smarty_function_math(array('equation' => "x+5",'x' => count($this->_tpl_vars['level_menu'])), $this);?>
'>

  <h2><?php echo SELanguage::_get(7000001); ?></h2>
  <?php echo SELanguage::_get(7000006); ?>
  <br />
  <br />

  <?php if (! empty ( $this->_tpl_vars['result'] )): ?>
    <div class='success'><img src='../images/success.gif' class='icon' border='0' /> <?php echo SELanguage::_get(191); ?></div>
  <?php endif; ?>

  <?php if (! empty ( $this->_tpl_vars['is_error'] )): ?>
    <div class='error'><img src='../images/error.gif' class='icon' border='0' /> <?php if (is_numeric ( $this->_tpl_vars['is_error'] )): 
 echo SELanguage::_get($this->_tpl_vars['is_error']); 
 else: 
 echo $this->_tpl_vars['is_error']; 
 endif; ?></div>
  <?php endif; ?>
  
  
  <form action='admin_levels_recipesettings.php' name='info' method='post'>
  
  <table cellpadding='0' cellspacing='0' width='600'>
    <tr>
      <td class='header'><?php echo SELanguage::_get(7000007); ?></td>
    </tr>
    <tr>
      <td class='setting1'><?php echo SELanguage::_get(7000008); ?></td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
            <td><input type='radio' name='level_recipe_allow' id='level_recipe_allow_7' value='7'<?php if ($this->_tpl_vars['level_info']['level_recipe_allow'] == 7): ?> checked<?php endif; ?> />&nbsp;</td>
            <td><label for='level_recipe_allow_7'><?php echo SELanguage::_get(7000141); ?></label></td>
          </tr>
          <tr>
            <td><input type='radio' name='level_recipe_allow' id='level_recipe_allow_3' value='3'<?php if ($this->_tpl_vars['level_info']['level_recipe_allow'] == 3): ?> checked<?php endif; ?> />&nbsp;</td>
            <td><label for='level_recipe_allow_3'><?php echo SELanguage::_get(7000142); ?></label></td>
          </tr>
          <tr>
            <td><input type='radio' name='level_recipe_allow' id='level_recipe_allow_1' value='1'<?php if ($this->_tpl_vars['level_info']['level_recipe_allow'] == 1): ?> checked<?php endif; ?> />&nbsp;</td>
            <td><label for='level_recipe_allow_1'><?php echo SELanguage::_get(7000143); ?></label></td>
          </tr>
          <tr>
            <td><input type='radio' name='level_recipe_allow' id='level_recipe_allow_0' value='0'<?php if ($this->_tpl_vars['level_info']['level_recipe_allow'] == 0): ?> checked<?php endif; ?> />&nbsp;</td>
            <td><label for='level_recipe_allow_0'><?php echo SELanguage::_get(7000144); ?></label></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <br />
  
  
  <table cellpadding='0' cellspacing='0' width='600'>
    <tr>
      <td class='header'><?php echo SELanguage::_get(7000011); ?></td>
    </tr>
      <td class='setting1'><?php echo SELanguage::_get(7000012); ?></td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
            <td><input type='text' class='text' size='2' name='level_recipe_entries' maxlength='3' value='<?php echo $this->_tpl_vars['entries_value']; ?>
'></td>
            <td>&nbsp;<?php echo sprintf(SELanguage::_get(7000013), ''); ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <br />
  
  
  <table cellpadding='0' cellspacing='0' width='600'>
    <tr>
      <td class='header'><?php echo SELanguage::_get(7000014); ?></td>
    </tr>
    <tr>
      <td class='setting1'><b><?php echo SELanguage::_get(7000015); ?></b><br /><?php echo SELanguage::_get(7000016); ?></td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
            <td><input type='radio' name='level_recipe_search' id='recipe_search_1' value='1'<?php if ($this->_tpl_vars['recipe_search']): ?> CHECKED<?php endif; ?>></td>
            <td><label for='recipe_search_1'><?php echo SELanguage::_get(7000017); ?></label>&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td><input type='radio' name='level_recipe_search' id='recipe_search_0' value='0'<?php if (! $this->_tpl_vars['recipe_search']): ?> CHECKED<?php endif; ?>></td>
            <td><label for='recipe_search_0'><?php echo SELanguage::_get(7000018); ?></label>&nbsp;&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td class='setting1'><b><?php echo SELanguage::_get(7000019); ?></b><br /><?php echo SELanguage::_get(7000020); ?></td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <?php $_from = $this->_tpl_vars['privacy_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
          <tr>
            <td><input type='checkbox' name='level_recipe_privacy[]' id='privacy_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if (((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['recipe_privacy']) : in_array($_tmp, $this->_tpl_vars['recipe_privacy']))): ?> CHECKED<?php endif; ?>></td>
            <td><label for='privacy_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label>&nbsp;&nbsp;</td>
          </tr>
          <?php endforeach; endif; unset($_from); ?>
        </table>
      </td>
    </tr>
    <tr>
      <td class='setting1'><?php echo SELanguage::_get(7000021); ?></b><br /><?php echo SELanguage::_get(7000022); ?></td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
        <?php $_from = $this->_tpl_vars['comment_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
          <tr><td><input type='checkbox' name='level_recipe_comments[]' id='comment_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if (((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['recipe_comments']) : in_array($_tmp, $this->_tpl_vars['recipe_comments']))): ?> CHECKED<?php endif; ?>></td><td><label for='comment_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label>&nbsp;&nbsp;</td></tr>
        <?php endforeach; endif; unset($_from); ?>
        </table>
      </td>
    </tr>
  </table>
  
  <br>
  
  <?php $this->assign('langBlockTemp', SE_Language::_get(173));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
'><?php 

  ?>
  <input type='hidden' name='task' value='dosave'>
  <input type='hidden' name='level_id' value='<?php echo $this->_tpl_vars['level_id']; ?>
'>
  </form>
  
</td>
</tr>

<tr><td width='100' nowrap='nowrap' class='vert_tab'><div style='width: 100px;'><a href='admin_levels_edit.php?level_id=<?php echo $this->_tpl_vars['level_id']; ?>
'><?php echo SELanguage::_get(285); ?></a></div></td></tr>
<tr><td width='100' nowrap='nowrap' class='vert_tab' style='border-top: none;'><div style='width: 100px;'><a href='admin_levels_usersettings.php?level_id=<?php echo $this->_tpl_vars['level_id']; ?>
'><?php echo SELanguage::_get(286); ?></a></div></td></tr>
<tr><td width='100' nowrap='nowrap' class='vert_tab' style='border-top: none;'><div style='width: 100px;'><a href='admin_levels_messagesettings.php?level_id=<?php echo $this->_tpl_vars['level_id']; ?>
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
  <div style='height: 760px;'>&nbsp;</div>
</td>
</tr>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>