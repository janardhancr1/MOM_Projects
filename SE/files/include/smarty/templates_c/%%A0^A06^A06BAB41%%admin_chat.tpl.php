<?php /* Smarty version 2.6.14, created on 2010-05-26 07:18:43
         compiled from admin_chat.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'admin_chat.tpl', 81, false),)), $this);
?><?php
SELanguage::_preload_multi(3500003,3501002,191,3501004,3501023,3501024,3501025,3501026,3501027,3501028,3501029,3501012,3501013,3501011,3501015,3501016,3501017,3501018,3501005,3501006,3501007,3501019,3501020,3501030,3501031,173);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h2><?php echo SELanguage::_get(3500003); ?></h2>
<?php echo SELanguage::_get(3501002); ?>
<br />
<br />

<?php if ($this->_tpl_vars['result'] == 1): ?>
  <div class='success'><img src='../images/success.gif' class='icon' border='0'> <?php echo SELanguage::_get(191); ?></div>
<?php elseif ($this->_tpl_vars['result'] == 2): ?>
  <div class='success'><img src='../images/success.gif' class='icon' border='0'> <?php echo sprintf(SELanguage::_get(3501004), $this->_tpl_vars['chatuser_kicked']); ?></div>
<?php endif; ?>



<form action='admin_chat.php' method='post'>

<table cellpadding='0' cellspacing='0' width='600'>
  <tr>
    <td class='header'><?php echo SELanguage::_get(3501023); ?></td>
  </tr>
  <tr>
    <td class='setting1'><?php echo SELanguage::_get(3501024); ?></td>
  </tr>
  <tr>
    <td class='setting2'>
      <table cellpadding='2' cellspacing='0'>
        <tr>
          <td>
            <input type='radio' name='setting_chat_enabled' id='setting_chat_enabled_1' value='1'<?php if ($this->_tpl_vars['setting']['setting_chat_enabled']): ?> CHECKED<?php endif; ?> />
          </td>
          <td>
            <label for='setting_chat_enabled_1'><?php echo SELanguage::_get(3501025); ?></label>
          </td>
        </tr>
        <tr>
          <td>
            <input type='radio' name='setting_chat_enabled' id='setting_chat_enabled_0' value='0'<?php if (! $this->_tpl_vars['setting']['setting_chat_enabled']): ?> CHECKED<?php endif; ?> />
          </td>
          <td>
            <label for='setting_chat_enabled_0'><?php echo SELanguage::_get(3501026); ?></label>
          </td>
        </tr>
      </table>
    </td>
  </tr>
    <td class='setting1'>
      <?php echo SELanguage::_get(3501027); ?>
    </td>
  </tr>
  <tr>
    <td class='setting2'>
      <table cellpadding='2' cellspacing='0'><tr><td>
        <input type='radio' name='setting_im_enabled' id='setting_im_enabled_1' value='1'<?php if ($this->_tpl_vars['setting']['setting_im_enabled']): ?> CHECKED<?php endif; ?> />
      </td><td>
        <label for='setting_im_enabled_1'><?php echo SELanguage::_get(3501028); ?></label>
      </td></tr>
      <tr><td>
        <input type='radio' name='setting_im_enabled' id='setting_im_enabled_0' value='0'<?php if (! $this->_tpl_vars['setting']['setting_im_enabled']): ?> CHECKED<?php endif; ?> />
      </td><td>
        <label for='setting_im_enabled_0'><?php echo SELanguage::_get(3501029); ?></label></td>
      </tr></table>
    </td>
  </tr>
</table>
<br />



<table cellpadding='0' cellspacing='0' width='600'>
  <tr>
    <td class='header'><?php echo SELanguage::_get(3501012); ?></td>
  </tr>
  <tr>
    <td class='setting1'><?php echo SELanguage::_get(3501013); ?></td>
  </tr>
  <tr>
    <td class='setting2'>
      <input type="text" class="text" name="setting_chat_update" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['setting']['setting_chat_update'])) ? $this->_run_mod_handler('default', true, $_tmp, 2) : smarty_modifier_default($_tmp, 2)); ?>
" />
      <label><?php echo SELanguage::_get(3501011); ?></label>
    </td>
  </tr>
</table>
<br />



<table cellpadding='0' cellspacing='0' width='600'>
  <tr>
    <td class='header'><?php echo SELanguage::_get(3501015); ?></td>
  </tr>
  <tr>
    <td class='setting1'><?php echo SELanguage::_get(3501016); ?></td>
  </tr>
  <tr>
    <td class='setting2'>
      <table cellpadding='2' cellspacing='0'>
        <tr>
          <td><input type='radio' name='setting_chat_showphotos' id='setting_chat_showphotos_1' value='1'<?php if ($this->_tpl_vars['setting']['setting_chat_showphotos']): ?> checked<?php endif; ?>></td>
          <td><label for='setting_chat_showphotos_1'><?php echo SELanguage::_get(3501017); ?></label></td>
        </tr>
        <tr>
          <td><input type='radio' name='setting_chat_showphotos' id='setting_chat_showphotos_0' value='0'<?php if (! $this->_tpl_vars['setting']['setting_chat_showphotos']): ?> checked<?php endif; ?>></td>
          <td><label for='setting_chat_showphotos_0'><?php echo SELanguage::_get(3501018); ?></label></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br />



<table cellpadding='0' cellspacing='0' width='600'>
  <tr>
    <td class='header'><?php echo SELanguage::_get(3501005); ?></td>
  </tr>
  <tr>
    <td class='setting1'><?php echo SELanguage::_get(3501006); ?></td>
  </tr>
  <tr>
    <td class='setting2'>
      <?php unset($this->_sections['chatusers_loop']);
$this->_sections['chatusers_loop']['name'] = 'chatusers_loop';
$this->_sections['chatusers_loop']['loop'] = is_array($_loop=$this->_tpl_vars['chatusers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['chatusers_loop']['show'] = true;
$this->_sections['chatusers_loop']['max'] = $this->_sections['chatusers_loop']['loop'];
$this->_sections['chatusers_loop']['step'] = 1;
$this->_sections['chatusers_loop']['start'] = $this->_sections['chatusers_loop']['step'] > 0 ? 0 : $this->_sections['chatusers_loop']['loop']-1;
if ($this->_sections['chatusers_loop']['show']) {
    $this->_sections['chatusers_loop']['total'] = $this->_sections['chatusers_loop']['loop'];
    if ($this->_sections['chatusers_loop']['total'] == 0)
        $this->_sections['chatusers_loop']['show'] = false;
} else
    $this->_sections['chatusers_loop']['total'] = 0;
if ($this->_sections['chatusers_loop']['show']):

            for ($this->_sections['chatusers_loop']['index'] = $this->_sections['chatusers_loop']['start'], $this->_sections['chatusers_loop']['iteration'] = 1;
                 $this->_sections['chatusers_loop']['iteration'] <= $this->_sections['chatusers_loop']['total'];
                 $this->_sections['chatusers_loop']['index'] += $this->_sections['chatusers_loop']['step'], $this->_sections['chatusers_loop']['iteration']++):
$this->_sections['chatusers_loop']['rownum'] = $this->_sections['chatusers_loop']['iteration'];
$this->_sections['chatusers_loop']['index_prev'] = $this->_sections['chatusers_loop']['index'] - $this->_sections['chatusers_loop']['step'];
$this->_sections['chatusers_loop']['index_next'] = $this->_sections['chatusers_loop']['index'] + $this->_sections['chatusers_loop']['step'];
$this->_sections['chatusers_loop']['first']      = ($this->_sections['chatusers_loop']['iteration'] == 1);
$this->_sections['chatusers_loop']['last']       = ($this->_sections['chatusers_loop']['iteration'] == $this->_sections['chatusers_loop']['total']);
?>
        <a href='admin_chat.php?task=kick&chatuser_id=<?php echo $this->_tpl_vars['chatusers'][$this->_sections['chatusers_loop']['index']]['chatuser_id']; ?>
'><?php echo $this->_tpl_vars['chatusers'][$this->_sections['chatusers_loop']['index']]['chatuser_user_username']; ?>
</a>
        <?php if ($this->_sections['chatusers_loop']['last'] != true): ?>, <?php endif; ?> 
      <?php endfor; else: ?>
        <?php echo SELanguage::_get(3501007); ?>
      <?php endif; ?>
    </td>
  </tr>
</table>
<br />



<table cellpadding='0' cellspacing='0' width='600'><tr><td class='header'>
  <?php echo SELanguage::_get(3501019); ?>
</td></tr>
<tr><td class='setting1'>
  <?php echo SELanguage::_get(3501020); ?>
</td></tr>
<tr><td class='setting2'>
  <textarea name='chatbanned' cols='40' rows='3' style='width: 100%;'><?php unset($this->_sections['chatbanned_loop']);
$this->_sections['chatbanned_loop']['name'] = 'chatbanned_loop';
$this->_sections['chatbanned_loop']['loop'] = is_array($_loop=$this->_tpl_vars['chatbanned']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['chatbanned_loop']['show'] = true;
$this->_sections['chatbanned_loop']['max'] = $this->_sections['chatbanned_loop']['loop'];
$this->_sections['chatbanned_loop']['step'] = 1;
$this->_sections['chatbanned_loop']['start'] = $this->_sections['chatbanned_loop']['step'] > 0 ? 0 : $this->_sections['chatbanned_loop']['loop']-1;
if ($this->_sections['chatbanned_loop']['show']) {
    $this->_sections['chatbanned_loop']['total'] = $this->_sections['chatbanned_loop']['loop'];
    if ($this->_sections['chatbanned_loop']['total'] == 0)
        $this->_sections['chatbanned_loop']['show'] = false;
} else
    $this->_sections['chatbanned_loop']['total'] = 0;
if ($this->_sections['chatbanned_loop']['show']):

            for ($this->_sections['chatbanned_loop']['index'] = $this->_sections['chatbanned_loop']['start'], $this->_sections['chatbanned_loop']['iteration'] = 1;
                 $this->_sections['chatbanned_loop']['iteration'] <= $this->_sections['chatbanned_loop']['total'];
                 $this->_sections['chatbanned_loop']['index'] += $this->_sections['chatbanned_loop']['step'], $this->_sections['chatbanned_loop']['iteration']++):
$this->_sections['chatbanned_loop']['rownum'] = $this->_sections['chatbanned_loop']['iteration'];
$this->_sections['chatbanned_loop']['index_prev'] = $this->_sections['chatbanned_loop']['index'] - $this->_sections['chatbanned_loop']['step'];
$this->_sections['chatbanned_loop']['index_next'] = $this->_sections['chatbanned_loop']['index'] + $this->_sections['chatbanned_loop']['step'];
$this->_sections['chatbanned_loop']['first']      = ($this->_sections['chatbanned_loop']['iteration'] == 1);
$this->_sections['chatbanned_loop']['last']       = ($this->_sections['chatbanned_loop']['iteration'] == $this->_sections['chatbanned_loop']['total']);

 echo $this->_tpl_vars['chatbanned'][$this->_sections['chatbanned_loop']['index']]['chatbanned_user_username']; 
 if ($this->_sections['chatbanned_loop']['last'] != true): ?>, <?php endif; 
 endfor; endif; ?></textarea>
</td></tr></table>
<br />


<table cellpadding='0' cellspacing='0' width='600'>
  <tr>
    <td class='header'><?php echo SELanguage::_get(3501030); ?></td>
  </tr>
  <tr>
    <td class='setting1'><?php echo SELanguage::_get(3501031); ?></td>
  </tr>
  <tr>
    <td class='setting2'><input type='text' class='text' name='setting_im_html' value='<?php echo $this->_tpl_vars['setting']['setting_im_html']; ?>
' maxlength='250' size='60' /></td>
  </tr>
</table>
<br />


<input type='hidden' name='task' value='dosave' />
<input type='submit' class='button' value='<?php echo SELanguage::_get(173); ?>' />
</form>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>