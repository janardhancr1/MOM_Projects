<?php /* Smarty version 2.6.14, created on 2010-06-04 02:00:04
         compiled from rightside.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'rightside.tpl', 16, false),array('modifier', 'regex_replace', 'rightside.tpl', 19, false),array('modifier', 'truncate', 'rightside.tpl', 19, false),)), $this);
?><?php
SELanguage::_preload_multi(666,667,668,669,670);
SELanguage::load();
?><div style='float: right; width: 300px;'>
<?php if ($this->_tpl_vars['ads']->ad_right != ""): ?>
  <div class='ad_right' width='1' style='display: table-cell; visibility: visible;'><?php echo $this->_tpl_vars['ads']->ad_right; ?>
</div>
<?php endif; ?>
<div>
	<a href='invite.php'><img src='./images/inviteimage.gif' border='0' alt='' /></a>
</div>
    <div class='header'><?php echo SELanguage::_get(666); ?></div>
  <div class='portal_content'>
    <?php if (! empty ( $this->_tpl_vars['signups'] )): ?>
    <table cellpadding='0' cellspacing='0' align='center'>
      <?php unset($this->_sections['signups_loop']);
$this->_sections['signups_loop']['name'] = 'signups_loop';
$this->_sections['signups_loop']['loop'] = is_array($_loop=$this->_tpl_vars['signups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['signups_loop']['max'] = (int)6;
$this->_sections['signups_loop']['show'] = true;
if ($this->_sections['signups_loop']['max'] < 0)
    $this->_sections['signups_loop']['max'] = $this->_sections['signups_loop']['loop'];
$this->_sections['signups_loop']['step'] = 1;
$this->_sections['signups_loop']['start'] = $this->_sections['signups_loop']['step'] > 0 ? 0 : $this->_sections['signups_loop']['loop']-1;
if ($this->_sections['signups_loop']['show']) {
    $this->_sections['signups_loop']['total'] = min(ceil(($this->_sections['signups_loop']['step'] > 0 ? $this->_sections['signups_loop']['loop'] - $this->_sections['signups_loop']['start'] : $this->_sections['signups_loop']['start']+1)/abs($this->_sections['signups_loop']['step'])), $this->_sections['signups_loop']['max']);
    if ($this->_sections['signups_loop']['total'] == 0)
        $this->_sections['signups_loop']['show'] = false;
} else
    $this->_sections['signups_loop']['total'] = 0;
if ($this->_sections['signups_loop']['show']):

            for ($this->_sections['signups_loop']['index'] = $this->_sections['signups_loop']['start'], $this->_sections['signups_loop']['iteration'] = 1;
                 $this->_sections['signups_loop']['iteration'] <= $this->_sections['signups_loop']['total'];
                 $this->_sections['signups_loop']['index'] += $this->_sections['signups_loop']['step'], $this->_sections['signups_loop']['iteration']++):
$this->_sections['signups_loop']['rownum'] = $this->_sections['signups_loop']['iteration'];
$this->_sections['signups_loop']['index_prev'] = $this->_sections['signups_loop']['index'] - $this->_sections['signups_loop']['step'];
$this->_sections['signups_loop']['index_next'] = $this->_sections['signups_loop']['index'] + $this->_sections['signups_loop']['step'];
$this->_sections['signups_loop']['first']      = ($this->_sections['signups_loop']['iteration'] == 1);
$this->_sections['signups_loop']['last']       = ($this->_sections['signups_loop']['iteration'] == $this->_sections['signups_loop']['total']);
?>
      <?php echo smarty_function_cycle(array('name' => 'startrow','values' => "<tr>,,"), $this);?>

      <td class='portal_member' valign="bottom"<?php if (( ~ $this->_sections['signups_loop']['index'] & 1 ) && $this->_sections['signups_loop']['last']): ?> colspan="3" style="width:100%;"<?php else: ?> style="width:33%;"<?php endif; ?>>
        <?php if (! empty ( $this->_tpl_vars['signups'][$this->_sections['signups_loop']['index']] )): ?>
          <a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['signups'][$this->_sections['signups_loop']['index']]->user_info['user_username']); ?>
'><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['signups'][$this->_sections['signups_loop']['index']]->user_displayname)) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/&#039;/", "'") : smarty_modifier_regex_replace($_tmp, "/&#039;/", "'")))) ? $this->_run_mod_handler('truncate', true, $_tmp, 15, "...", true) : smarty_modifier_truncate($_tmp, 15, "...", true)); ?>
</a><br />
          <a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['signups'][$this->_sections['signups_loop']['index']]->user_info['user_username']); ?>
'><img src='<?php echo $this->_tpl_vars['signups'][$this->_sections['signups_loop']['index']]->user_photo("./images/nophoto.gif",'TRUE'); ?>
' class='photo' width='60' height='60' border='0' alt='' /></a>
        <?php endif; ?>
      </td>
      <?php echo smarty_function_cycle(array('name' => 'endrow','values' => ",,</tr>"), $this);?>

      <?php endfor; endif; ?>
      </table>
    <?php else: ?>
      <?php echo SELanguage::_get(667); ?>
    <?php endif; ?>
  </div>
  <div class='portal_spacer'></div>

    <?php if ($this->_tpl_vars['setting']['setting_connection_allow'] != 0): ?>
    <div class='header'><?php echo SELanguage::_get(668); ?></div>
    <div class='portal_content'>
    <?php if (! empty ( $this->_tpl_vars['friends'] )): ?>
    <table cellpadding='0' cellspacing='0' align='center'>
      <?php unset($this->_sections['friends_loop']);
$this->_sections['friends_loop']['name'] = 'friends_loop';
$this->_sections['friends_loop']['loop'] = is_array($_loop=$this->_tpl_vars['friends']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['friends_loop']['max'] = (int)6;
$this->_sections['friends_loop']['show'] = true;
if ($this->_sections['friends_loop']['max'] < 0)
    $this->_sections['friends_loop']['max'] = $this->_sections['friends_loop']['loop'];
$this->_sections['friends_loop']['step'] = 1;
$this->_sections['friends_loop']['start'] = $this->_sections['friends_loop']['step'] > 0 ? 0 : $this->_sections['friends_loop']['loop']-1;
if ($this->_sections['friends_loop']['show']) {
    $this->_sections['friends_loop']['total'] = min(ceil(($this->_sections['friends_loop']['step'] > 0 ? $this->_sections['friends_loop']['loop'] - $this->_sections['friends_loop']['start'] : $this->_sections['friends_loop']['start']+1)/abs($this->_sections['friends_loop']['step'])), $this->_sections['friends_loop']['max']);
    if ($this->_sections['friends_loop']['total'] == 0)
        $this->_sections['friends_loop']['show'] = false;
} else
    $this->_sections['friends_loop']['total'] = 0;
if ($this->_sections['friends_loop']['show']):

            for ($this->_sections['friends_loop']['index'] = $this->_sections['friends_loop']['start'], $this->_sections['friends_loop']['iteration'] = 1;
                 $this->_sections['friends_loop']['iteration'] <= $this->_sections['friends_loop']['total'];
                 $this->_sections['friends_loop']['index'] += $this->_sections['friends_loop']['step'], $this->_sections['friends_loop']['iteration']++):
$this->_sections['friends_loop']['rownum'] = $this->_sections['friends_loop']['iteration'];
$this->_sections['friends_loop']['index_prev'] = $this->_sections['friends_loop']['index'] - $this->_sections['friends_loop']['step'];
$this->_sections['friends_loop']['index_next'] = $this->_sections['friends_loop']['index'] + $this->_sections['friends_loop']['step'];
$this->_sections['friends_loop']['first']      = ($this->_sections['friends_loop']['iteration'] == 1);
$this->_sections['friends_loop']['last']       = ($this->_sections['friends_loop']['iteration'] == $this->_sections['friends_loop']['total']);
?>
      <?php echo smarty_function_cycle(array('name' => 'startrow2','values' => "<tr>,,"), $this);?>

      <td class='portal_member' valign="bottom"<?php if (( ~ $this->_sections['friends_loop']['index'] & 1 ) && $this->_sections['friends_loop']['last']): ?> colspan="2" style="width:100%;"<?php else: ?> style="width:33%;"<?php endif; ?>>
        <?php if (! empty ( $this->_tpl_vars['friends'][$this->_sections['friends_loop']['index']] )): ?>
        <a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['friends'][$this->_sections['friends_loop']['index']]['friend']->user_info['user_username']); ?>
'><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['friends'][$this->_sections['friends_loop']['index']]['friend']->user_displayname)) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/&#039;/", "'") : smarty_modifier_regex_replace($_tmp, "/&#039;/", "'")))) ? $this->_run_mod_handler('truncate', true, $_tmp, 15, "...", true) : smarty_modifier_truncate($_tmp, 15, "...", true)); ?>
</a><br />
        <a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['friends'][$this->_sections['friends_loop']['index']]['friend']->user_info['user_username']); ?>
'><img src='<?php echo $this->_tpl_vars['friends'][$this->_sections['friends_loop']['index']]['friend']->user_photo("./images/nophoto.gif",'TRUE'); ?>
' class='photo' width='60' height='60' border='0' alt='' /></a><br />
        <?php echo sprintf(SELanguage::_get(669), $this->_tpl_vars['friends'][$this->_sections['friends_loop']['index']]['total_friends']); ?>
        <?php endif; ?>
      </td>
      <?php echo smarty_function_cycle(array('name' => 'endrow2','values' => ",,</tr>"), $this);?>

      <?php endfor; endif; ?>
      </table>
    <?php else: ?>
      <?php echo SELanguage::_get(670); ?>
    <?php endif; ?>
    </div>
    <div class='portal_spacer'></div>
  <?php endif; ?>

</div>