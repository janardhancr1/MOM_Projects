<?php /* Smarty version 2.6.14, created on 2010-06-04 02:08:01
         compiled from profile_classified.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'profile_classified.tpl', 20, false),array('modifier', 'strip_tags', 'profile_classified.tpl', 22, false),)), $this);
?><?php
SELanguage::_preload_multi(4500007,4500064,1500121);
SELanguage::load();
?>

<?php if ($this->_tpl_vars['owner']->level_info['level_classified_allow'] && $this->_tpl_vars['total_classifieds']): ?>

  <div class='profile_headline'><?php echo SELanguage::_get(4500007); ?> (<?php echo $this->_tpl_vars['total_classifieds']; ?>
)</div>
  <div>
        <?php unset($this->_sections['classified_loop']);
$this->_sections['classified_loop']['name'] = 'classified_loop';
$this->_sections['classified_loop']['loop'] = is_array($_loop=$this->_tpl_vars['classifieds']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['classified_loop']['max'] = (int)5;
$this->_sections['classified_loop']['show'] = true;
if ($this->_sections['classified_loop']['max'] < 0)
    $this->_sections['classified_loop']['max'] = $this->_sections['classified_loop']['loop'];
$this->_sections['classified_loop']['step'] = 1;
$this->_sections['classified_loop']['start'] = $this->_sections['classified_loop']['step'] > 0 ? 0 : $this->_sections['classified_loop']['loop']-1;
if ($this->_sections['classified_loop']['show']) {
    $this->_sections['classified_loop']['total'] = min(ceil(($this->_sections['classified_loop']['step'] > 0 ? $this->_sections['classified_loop']['loop'] - $this->_sections['classified_loop']['start'] : $this->_sections['classified_loop']['start']+1)/abs($this->_sections['classified_loop']['step'])), $this->_sections['classified_loop']['max']);
    if ($this->_sections['classified_loop']['total'] == 0)
        $this->_sections['classified_loop']['show'] = false;
} else
    $this->_sections['classified_loop']['total'] = 0;
if ($this->_sections['classified_loop']['show']):

            for ($this->_sections['classified_loop']['index'] = $this->_sections['classified_loop']['start'], $this->_sections['classified_loop']['iteration'] = 1;
                 $this->_sections['classified_loop']['iteration'] <= $this->_sections['classified_loop']['total'];
                 $this->_sections['classified_loop']['index'] += $this->_sections['classified_loop']['step'], $this->_sections['classified_loop']['iteration']++):
$this->_sections['classified_loop']['rownum'] = $this->_sections['classified_loop']['iteration'];
$this->_sections['classified_loop']['index_prev'] = $this->_sections['classified_loop']['index'] - $this->_sections['classified_loop']['step'];
$this->_sections['classified_loop']['index_next'] = $this->_sections['classified_loop']['index'] + $this->_sections['classified_loop']['step'];
$this->_sections['classified_loop']['first']      = ($this->_sections['classified_loop']['iteration'] == 1);
$this->_sections['classified_loop']['last']       = ($this->_sections['classified_loop']['iteration'] == $this->_sections['classified_loop']['total']);
?>
    <div class='profile_classified'>
      <table cellpadding='0' cellspacing='0'>
        <tr>
          <td valign='top'>
            <a href='<?php echo $this->_tpl_vars['url']->url_create('classified',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_id']); ?>
'>
              <img src='./images/icons/classified_classified16.gif' border='0' class='icon' />
            </a>
          </td>
          <td valign='top'>
            <div class='profile_classified_title'><a href='<?php echo $this->_tpl_vars['url']->url_create('classified',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_id']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 35, "...", true) : smarty_modifier_truncate($_tmp, 35, "...", true)); ?>
</a></div>
            <div class='profile_classified_date'><?php echo SELanguage::_get(4500064); ?> <?php $this->assign('classified_date', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_date'])); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['classified_date'][0]), $this->_tpl_vars['classified_date'][1]); ?></div>
            <div class='profile_classified_body'><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_body'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 160, "...", true) : smarty_modifier_truncate($_tmp, 160, "...", true)); ?>
</div>
          </td>
        </tr>
      </table>
    </div>
    <?php endfor; endif; ?>
        <?php if ($this->_tpl_vars['total_classifieds'] > 5): ?>
    <div style='border-top: 1px solid #DDDDDD; padding-top: 10px;'>
      <div style='float: left;'>
        <a href='<?php echo $this->_tpl_vars['url']->url_create('classifieds',$this->_tpl_vars['owner']->user_info['user_username']); ?>
'>
          <img src='./images/icons/classified_classified16.gif' border='0' class='button' style='float: left;' />
          <?php echo SELanguage::_get(1500121); ?>
        </a>
      </div>
      <div style='clear: both; height: 0px;'></div>
    </div>
    <?php endif; ?>
  </div>
  
<?php endif; ?>