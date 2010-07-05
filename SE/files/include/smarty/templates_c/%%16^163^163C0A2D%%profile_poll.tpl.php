<?php /* Smarty version 2.6.14, created on 2010-03-30 16:03:00
         compiled from profile_poll.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'profile_poll.tpl', 23, false),array('modifier', 'choptext', 'profile_poll.tpl', 23, false),)), $this);
?><?php
SELanguage::_preload_multi(2500005,1021,589,2500028);
SELanguage::load();
?>

<?php if ($this->_tpl_vars['owner']->level_info['level_poll_allow'] != 0 && $this->_tpl_vars['total_polls'] > 0): ?>

  <table cellpadding='0' cellspacing='0' width='100%' style='margin-bottom: 10px;'>
    <tr>
      <td class='header'>
        <?php echo SELanguage::_get(2500005); ?> (<?php echo $this->_tpl_vars['total_polls']; ?>
)
                <?php if ($this->_tpl_vars['total_polls'] > 5): ?>&nbsp;[ <a href='<?php echo $this->_tpl_vars['url']->url_create('polls',$this->_tpl_vars['owner']->user_info['user_username']); ?>
'><?php echo SELanguage::_get(1021); ?></a> ]<?php endif; ?>
      </td>
    </tr>
    <tr>
      <td class='profile'>
                <?php unset($this->_sections['poll_loop']);
$this->_sections['poll_loop']['name'] = 'poll_loop';
$this->_sections['poll_loop']['loop'] = is_array($_loop=$this->_tpl_vars['polls']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['poll_loop']['show'] = true;
$this->_sections['poll_loop']['max'] = $this->_sections['poll_loop']['loop'];
$this->_sections['poll_loop']['step'] = 1;
$this->_sections['poll_loop']['start'] = $this->_sections['poll_loop']['step'] > 0 ? 0 : $this->_sections['poll_loop']['loop']-1;
if ($this->_sections['poll_loop']['show']) {
    $this->_sections['poll_loop']['total'] = $this->_sections['poll_loop']['loop'];
    if ($this->_sections['poll_loop']['total'] == 0)
        $this->_sections['poll_loop']['show'] = false;
} else
    $this->_sections['poll_loop']['total'] = 0;
if ($this->_sections['poll_loop']['show']):

            for ($this->_sections['poll_loop']['index'] = $this->_sections['poll_loop']['start'], $this->_sections['poll_loop']['iteration'] = 1;
                 $this->_sections['poll_loop']['iteration'] <= $this->_sections['poll_loop']['total'];
                 $this->_sections['poll_loop']['index'] += $this->_sections['poll_loop']['step'], $this->_sections['poll_loop']['iteration']++):
$this->_sections['poll_loop']['rownum'] = $this->_sections['poll_loop']['iteration'];
$this->_sections['poll_loop']['index_prev'] = $this->_sections['poll_loop']['index'] - $this->_sections['poll_loop']['step'];
$this->_sections['poll_loop']['index_next'] = $this->_sections['poll_loop']['index'] + $this->_sections['poll_loop']['step'];
$this->_sections['poll_loop']['first']      = ($this->_sections['poll_loop']['iteration'] == 1);
$this->_sections['poll_loop']['last']       = ($this->_sections['poll_loop']['iteration'] == $this->_sections['poll_loop']['total']);
?>
        <table cellpadding='0' cellspacing='0' width='100%'>
          <tr>
            <td valign='top' width='1'><img src='./images/icons/poll_poll16.gif' border='0' class='icon'></td>
            <td valign='top'>
              <div><a href='<?php echo $this->_tpl_vars['url']->url_create('poll',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_id']); ?>
'><?php if ($this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_title'] == ""): 
 echo SELanguage::_get(589); 
 else: 
 echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)))) ? $this->_run_mod_handler('choptext', true, $_tmp, 20, "<br>") : smarty_modifier_choptext($_tmp, 20, "<br>")); 
 endif; ?></a></div>
              <div style='color: #888888;'><?php echo sprintf(SELanguage::_get(2500028), $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_totalvotes']); ?></div>
            </td>
          </tr>
        </table>
          <?php if ($this->_sections['poll_loop']['last'] != true): ?><div style='font-size: 1pt; margin-top: 2px; margin-bottom: 2px;'>&nbsp;</div><?php endif; ?>
        <?php endfor; endif; ?>
      </td>
    </tr>
  </table>

<?php endif; ?>