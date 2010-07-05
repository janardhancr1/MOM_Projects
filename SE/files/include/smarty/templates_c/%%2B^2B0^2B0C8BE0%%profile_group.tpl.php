<?php /* Smarty version 2.6.14, created on 2010-05-31 14:33:59
         compiled from profile_group.tpl */
?><?php
SELanguage::_preload_multi(2000007);
SELanguage::load();
?>

<?php if ($this->_tpl_vars['total_groups'] != 0): ?>
<table cellpadding='0' cellspacing='0' width='100%' style='margin-bottom: 10px;'>
  <tr>
    <td class='header'>
      <?php echo SELanguage::_get(2000007); ?> (<?php echo $this->_tpl_vars['total_groups']; ?>
)
    </td>
  </tr>
  <tr>
    <td class='profile'>
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
      <a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_id']); ?>
'>
        <?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_title']; ?>

      </a>
      <?php if (! $this->_sections['group_loop']['last']): ?>,<?php endif; ?>
      <?php endfor; endif; ?>
    </td>
  </tr>
</table>
<?php endif; ?>