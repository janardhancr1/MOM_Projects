<?php /* Smarty version 2.6.14, created on 2010-06-24 16:28:23
         compiled from admin_levels_classifiedsettings.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'admin_levels_classifiedsettings.tpl', 11, false),array('modifier', 'count', 'admin_levels_classifiedsettings.tpl', 11, false),array('modifier', 'in_array', 'admin_levels_classifiedsettings.tpl', 175, false),)), $this);
?><?php
SELanguage::_preload_multi(288,282,4500001,4500012,191,4500013,4500014,4500156,4500157,4500158,4500017,4500018,4500019,4500020,4500021,4500022,4500024,4500023,4500025,4500026,4500027,4500028,4500029,4500030,4500031,4500032,4500033,4500034,4500035,4500036,4500037,4500038,4500039,4500041,4500042,4500043,4500040,4500044,4500045,4500046,4500048,4500047,4500140,4500141,173,285,286,287);
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

  <h2><?php echo SELanguage::_get(4500001); ?></h2>
  <?php echo SELanguage::_get(4500012); ?>
  <br />
  <br />
  
  
    <?php if ($this->_tpl_vars['result'] != 0): ?>
    <div class='success'><img src='../images/success.gif' class='icon' border='0'> <?php echo SELanguage::_get(191); ?></div>
  <?php endif; ?>
  
    <?php if ($this->_tpl_vars['is_error'] != 0): ?>
    <div class='error'><img src='../images/error.gif' class='icon' border='0'> <?php echo SELanguage::_get($this->_tpl_vars['is_error']); ?></div>
  <?php endif; ?>
  
  
  <form action='admin_levels_classifiedsettings.php' name='info' method='POST'>
  
  
  <table cellpadding='0' cellspacing='0' width='600'>
    <tr>
      <td class='header'><?php echo SELanguage::_get(4500013); ?></td>
    </tr>
    <tr>
      <td class='setting1'><?php echo SELanguage::_get(4500014); ?></td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
            <td><input type='radio' name='level_classified_allow' id='level_classified_allow_3' value='3'<?php if ($this->_tpl_vars['level_info']['level_classified_allow'] == 3): ?> checked<?php endif; ?> />&nbsp;</td>
            <td><label for='level_classified_allow_3'><?php echo SELanguage::_get(4500156); ?></label></td>
          </tr>
          <tr>
            <td><input type='radio' name='level_classified_allow' id='level_classified_allow_1' value='1'<?php if ($this->_tpl_vars['level_info']['level_classified_allow'] == 1): ?> checked<?php endif; ?> />&nbsp;</td>
            <td><label for='level_classified_allow_1'><?php echo SELanguage::_get(4500157); ?></label></td>
          </tr>
          <tr>
            <td><input type='radio' name='level_classified_allow' id='level_classified_allow_0' value='0'<?php if ($this->_tpl_vars['level_info']['level_classified_allow'] == 0): ?> checked<?php endif; ?> />&nbsp;</td>
            <td><label for='level_classified_allow_0'><?php echo SELanguage::_get(4500158); ?></label></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <br />
  
  
  <table cellpadding='0' cellspacing='0' width='600'>
    <tr>
      <td class='header'><?php echo SELanguage::_get(4500017); ?></td>
    </tr>
    
    <tr>
      <td class='setting1'><?php echo SELanguage::_get(4500018); ?></td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
            <td><input type='radio' name='level_classified_photo' id='level_classified_photo_1' value='1'<?php if ($this->_tpl_vars['level_info']['level_classified_photo']): ?> checked<?php endif; ?> />&nbsp;</td>
            <td><label for='level_classified_photo_1'><?php echo SELanguage::_get(4500019); ?></label></td>
          </tr>
          <tr>
            <td><input type='radio' name='level_classified_photo' id='level_classified_photo_0' value='0'<?php if (! $this->_tpl_vars['level_info']['level_classified_photo']): ?> checked<?php endif; ?> />&nbsp;</td>
            <td><label for='level_classified_photo_0'><?php echo SELanguage::_get(4500020); ?></label></td>
          </tr>
        </table>
      </td>
    </tr>
    
    <tr>
      <td class='setting1'><?php echo SELanguage::_get(4500021); ?></td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
            <td><?php echo SELanguage::_get(4500022); ?> &nbsp;</td>
            <td><input type='text' class='text' name='level_classified_photo_width' value='<?php echo $this->_tpl_vars['level_info']['level_classified_photo_width']; ?>
' maxlength='3' size='3' /> &nbsp;</td>
            <td><?php echo SELanguage::_get(4500024); ?></td>
          </tr>
          <tr>
            <td><?php echo SELanguage::_get(4500023); ?> &nbsp;</td>
            <td><input type='text' class='text' name='level_classified_photo_height' value='<?php echo $this->_tpl_vars['level_info']['level_classified_photo_height']; ?>
' maxlength='3' size='3' /> &nbsp;</td>
            <td><?php echo SELanguage::_get(4500024); ?></td>
          </tr>
        </table>
      </td>
    </tr>
    
    <tr>
      <td class='setting1'><?php echo SELanguage::_get(4500025); ?></td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
            <td><?php echo SELanguage::_get(4500026); ?> &nbsp;</td>
            <td><input type='text' class='text' name='level_classified_photo_exts' value='<?php echo $this->_tpl_vars['level_classified_photo_exts']; ?>
' size='40' maxlength='50' /></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <br />
  
  
  <table cellpadding='0' cellspacing='0' width='600'>
    <tr>
      <td class='header'><?php echo SELanguage::_get(4500027); ?></td>
    </tr>
    
    <tr>
      <td class='setting1'><?php echo SELanguage::_get(4500028); ?></td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
            <td><input type='text' class='text' size='2' name='level_classified_entries' maxlength='3' value='<?php echo $this->_tpl_vars['level_info']['level_classified_entries']; ?>
' /></td>
            <td>&nbsp; <?php echo SELanguage::_get(4500029); ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <br />
  
  
  <table cellpadding='0' cellspacing='0' width='600'>
    <tr>
      <td class='header'><?php echo SELanguage::_get(4500030); ?></td>
    </tr>
    
    <tr>
      <td class='setting1'><?php echo SELanguage::_get(4500031); ?></td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
          <td><input type='radio' name='level_classified_search' id='classified_search_1' value='1'<?php if ($this->_tpl_vars['level_info']['level_classified_search']): ?> checked<?php endif; ?> /></td>
          <td><label for='classified_search_1'><?php echo SELanguage::_get(4500032); ?></label>&nbsp;&nbsp;</td>
          </tr>
          <tr>
          <td><input type='radio' name='level_classified_search' id='classified_search_0' value='0'<?php if (! $this->_tpl_vars['level_info']['level_classified_search']): ?> checked<?php endif; ?> /></td>
          <td><label for='classified_search_0'><?php echo SELanguage::_get(4500033); ?></label>&nbsp;&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    
    <tr>
      <td class='setting1'><?php echo SELanguage::_get(4500034); ?></td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
        <?php $_from = $this->_tpl_vars['privacy_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
          <tr>
            <td><input type='checkbox' name='level_classified_privacy[]' id='privacy_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if (((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['classified_privacy']) : in_array($_tmp, $this->_tpl_vars['classified_privacy']))): ?> checked<?php endif; ?> /></td>
            <td><label for='privacy_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label>&nbsp;&nbsp;</td>
          </tr>
        <?php endforeach; endif; unset($_from); ?>
        </table>
      </td>
    </tr>
    
    <tr>
      <td class='setting1'><?php echo SELanguage::_get(4500035); ?></td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
        <?php $_from = $this->_tpl_vars['comment_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
          <tr>
            <td><input type='checkbox' name='level_classified_comments[]' id='comments_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if (((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['classified_comments']) : in_array($_tmp, $this->_tpl_vars['classified_comments']))): ?> checked<?php endif; ?> /></td>
            <td><label for='comments_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label>&nbsp;&nbsp;</td>
          </tr>
        <?php endforeach; endif; unset($_from); ?>
        </table>
      </td>
    </tr>
  </table>
  <br />
  

  <table cellpadding='0' cellspacing='0' width='600'>
  <tr>
    <td class='header'><?php echo SELanguage::_get(4500036); ?></td>
  </tr>
  
  <tr>
    <td class='setting1'><?php echo SELanguage::_get(4500037); ?></td>
  </tr>
  <tr>
    <td class='setting2'>
      <textarea name='level_classified_album_exts' rows='2' cols='40' class='text' style='width: 100%;'><?php echo $this->_tpl_vars['level_classified_album_exts']; ?>
</textarea>
    </td>
  </tr>
  
  <tr>
    <td class='setting1'><?php echo SELanguage::_get(4500038); ?></td>
  </tr>
  <tr>
    <td class='setting2'>
      <textarea name='level_classified_album_mimes' rows='2' cols='40' class='text' style='width: 100%;'><?php echo $this->_tpl_vars['level_classified_album_mimes']; ?>
</textarea>
    </td>
  </tr>
  
  <tr>
    <td class='setting1'><?php echo SELanguage::_get(4500039); ?></td>
  </tr>
  <tr>
    <td class='setting2'>
      <select name='level_classified_album_storage' class='text'>
        <option value='102400'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 102400): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500041), 100); ?></option>
        <option value='204800'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 204800): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500041), 200); ?></option>
        <option value='512000'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 512000): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500041), 500); ?></option>
        <option value='1048576'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 1048576): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 1); ?></option>
        <option value='2097152'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 2097152): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 2); ?></option>
        <option value='3145728'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 3145728): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 3); ?></option>
        <option value='4194304'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 4194304): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 4); ?></option>
        <option value='5242880'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 5242880): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 5); ?></option>
        <option value='6291456'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 6291456): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 6); ?></option>
        <option value='7340032'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 7340032): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 7); ?></option>
        <option value='8388608'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 8388608): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 8); ?></option>
        <option value='9437184'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 9437184): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 9); ?></option>
        <option value='10485760'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 10485760): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 10); ?></option>
        <option value='15728640'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 15728640): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 15); ?></option>
        <option value='20971520'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 20971520): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 20); ?></option>
        <option value='26214400'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 26214400): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 25); ?></option>
        <option value='52428800'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 52428800): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 50); ?></option>
        <option value='78643200'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 78643200): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 75); ?></option>
        <option value='104857600'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 104857600): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 100); ?></option>
        <option value='209715200'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 209715200): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 200); ?></option>
        <option value='314572800'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 314572800): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 300); ?></option>
        <option value='419430400'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 419430400): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 400); ?></option>
        <option value='524288000'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 524288000): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 500); ?></option>
        <option value='629145600'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 629145600): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 600); ?></option>
        <option value='734003200'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 734003200): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 700); ?></option>
        <option value='838860800'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 838860800): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 800); ?></option>
        <option value='943718400'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 943718400): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500042), 900); ?></option>
        <option value='1073741824'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 1073741824): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500043), 1); ?></option>
        <option value='2147483648'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 2147483648): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500043), 2); ?></option>
        <option value='5368709120'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 5368709120): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500043), 5); ?></option>
        <option value='10737418240'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 10737418240): ?> SELECTED<?php endif; ?>><?php echo sprintf(SELanguage::_get(4500043), 10); ?></option>
        <option value='0'<?php if ($this->_tpl_vars['level_info']['level_classified_album_storage'] == 0): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(4500040); ?></option>
      </select>
    </td>
  </tr>
  
  <tr>
    <td class='setting1'><?php echo SELanguage::_get(4500044); ?></td>
  </tr>
  <tr>
    <td class='setting2'>
      <input type='text' class='text' size='5' name='level_classified_album_maxsize' maxlength='6' value='<?php echo $this->_tpl_vars['level_classified_album_maxsize']; ?>
'> <?php echo sprintf(SELanguage::_get(4500041), ''); ?>
    </td>
  </tr>
  
  <tr>
    <td class='setting1'><?php echo SELanguage::_get(4500045); ?></td>
  </tr>
  <tr>
    <td class='setting2'>
      <table cellpadding='0' cellspacing='0'>
        <tr>
          <td><?php echo SELanguage::_get(4500046); ?> &nbsp;</td>
          <td><input type='text' class='text' name='level_classified_album_width' value='<?php echo $this->_tpl_vars['level_info']['level_classified_album_width']; ?>
' maxlength='4' size='3'> &nbsp;</td>
          <td><?php echo SELanguage::_get(4500048); ?></td>
        </tr>
        <tr>
          <td><?php echo SELanguage::_get(4500047); ?> &nbsp;</td>
          <td><input type='text' class='text' name='level_classified_album_height' value='<?php echo $this->_tpl_vars['level_info']['level_classified_album_height']; ?>
' maxlength='4' size='3'> &nbsp;</td>
          <td><?php echo SELanguage::_get(4500048); ?></td>
        </tr>
      </table>
    </td>
  </tr>
  </table>
  <br />
  
  
  <table cellpadding='0' cellspacing='0' width='600'>
    <tr>
      <td class='header'><?php echo SELanguage::_get(4500140); ?></td>
    </tr>
    <tr>
      <td class='setting1'><?php echo SELanguage::_get(4500141); ?></td>
    </tr>
    <tr>
      <td class='setting2'>
        <input type='text' class='text' name='level_classified_html' value='<?php echo $this->_tpl_vars['level_classified_html']; ?>
' size='60' />
      </td>
    </tr>
  </table>
  <br />
  
  
  <?php $this->assign('langBlockTemp', SE_Language::_get(173));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' /><?php 

  ?>
  <input type='hidden' name='task' value='dosave' />
  <input type='hidden' name='level_id' value='<?php echo $this->_tpl_vars['level_info']['level_id']; ?>
' />
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
  <div style='height: 2500px;'>&nbsp;</div>
</td>
</tr>
</table>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>