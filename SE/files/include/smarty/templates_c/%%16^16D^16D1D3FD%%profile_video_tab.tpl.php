<?php /* Smarty version 2.6.14, created on 2010-06-01 15:12:25
         compiled from profile_video_tab.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'profile_video_tab.tpl', 25, false),array('function', 'cycle', 'profile_video_tab.tpl', 41, false),)), $this);
?><?php
SELanguage::_preload_multi(5500098,589,5500070);
SELanguage::load();
?>

<?php if (( $this->_tpl_vars['owner']->level_info['level_video_allow'] != 0 || $this->_tpl_vars['owner']->level_info['level_youtube_allow'] != 0 ) && $this->_tpl_vars['total_videos'] > 0): ?>


  <div class='profile_headline'>
    <?php echo SELanguage::_get(5500098); ?> (<?php echo $this->_tpl_vars['total_videos']; ?>
)
  </div>

    <?php unset($this->_sections['video_loop']);
$this->_sections['video_loop']['name'] = 'video_loop';
$this->_sections['video_loop']['loop'] = is_array($_loop=$this->_tpl_vars['videos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['video_loop']['show'] = true;
$this->_sections['video_loop']['max'] = $this->_sections['video_loop']['loop'];
$this->_sections['video_loop']['step'] = 1;
$this->_sections['video_loop']['start'] = $this->_sections['video_loop']['step'] > 0 ? 0 : $this->_sections['video_loop']['loop']-1;
if ($this->_sections['video_loop']['show']) {
    $this->_sections['video_loop']['total'] = $this->_sections['video_loop']['loop'];
    if ($this->_sections['video_loop']['total'] == 0)
        $this->_sections['video_loop']['show'] = false;
} else
    $this->_sections['video_loop']['total'] = 0;
if ($this->_sections['video_loop']['show']):

            for ($this->_sections['video_loop']['index'] = $this->_sections['video_loop']['start'], $this->_sections['video_loop']['iteration'] = 1;
                 $this->_sections['video_loop']['iteration'] <= $this->_sections['video_loop']['total'];
                 $this->_sections['video_loop']['index'] += $this->_sections['video_loop']['step'], $this->_sections['video_loop']['iteration']++):
$this->_sections['video_loop']['rownum'] = $this->_sections['video_loop']['iteration'];
$this->_sections['video_loop']['index_prev'] = $this->_sections['video_loop']['index'] - $this->_sections['video_loop']['step'];
$this->_sections['video_loop']['index_next'] = $this->_sections['video_loop']['index'] + $this->_sections['video_loop']['step'];
$this->_sections['video_loop']['first']      = ($this->_sections['video_loop']['iteration'] == 1);
$this->_sections['video_loop']['last']       = ($this->_sections['video_loop']['iteration'] == $this->_sections['video_loop']['total']);
?>    

        <?php if ($this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_title'] == ""): 
 ob_start(); 
 echo SELanguage::_get(589); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('video_title', ob_get_contents());ob_end_clean(); 
 else: 
 $this->assign('video_title', $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_title']); 
 endif; ?>

    <div class='videoTab' style='width: 300px;'>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td style='vertical-align: top;'>
        <a href='<?php echo $this->_tpl_vars['url']->url_create('video',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']); ?>
'><img src='<?php if ($this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_thumb']): 
 echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_dir']; 
 echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']; ?>
_thumb.jpg<?php else: ?>./images/video_placeholder.gif<?php endif; ?>' border='0' width='<?php echo $this->_tpl_vars['setting']['setting_video_thumb_width']; ?>
' height='<?php echo $this->_tpl_vars['setting']['setting_video_thumb_height']; ?>
'></a>
      </td>
      <td style='vertical-align: top; padding-left: 7px;'>
        <div class='video_row_title'><a href='<?php echo $this->_tpl_vars['url']->url_create('video',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['video_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 45, '...', true) : smarty_modifier_truncate($_tmp, 45, '...', true)); ?>
</a></div>
        <div class='video_row_info'><?php echo sprintf(SELanguage::_get(5500070), $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_views']); ?></div>
        <div>
          <?php unset($this->_sections['full_loop']);
$this->_sections['full_loop']['name'] = 'full_loop';
$this->_sections['full_loop']['start'] = (int)0;
$this->_sections['full_loop']['loop'] = is_array($_loop=$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_rating_full']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['full_loop']['show'] = true;
$this->_sections['full_loop']['max'] = $this->_sections['full_loop']['loop'];
$this->_sections['full_loop']['step'] = 1;
if ($this->_sections['full_loop']['start'] < 0)
    $this->_sections['full_loop']['start'] = max($this->_sections['full_loop']['step'] > 0 ? 0 : -1, $this->_sections['full_loop']['loop'] + $this->_sections['full_loop']['start']);
else
    $this->_sections['full_loop']['start'] = min($this->_sections['full_loop']['start'], $this->_sections['full_loop']['step'] > 0 ? $this->_sections['full_loop']['loop'] : $this->_sections['full_loop']['loop']-1);
if ($this->_sections['full_loop']['show']) {
    $this->_sections['full_loop']['total'] = min(ceil(($this->_sections['full_loop']['step'] > 0 ? $this->_sections['full_loop']['loop'] - $this->_sections['full_loop']['start'] : $this->_sections['full_loop']['start']+1)/abs($this->_sections['full_loop']['step'])), $this->_sections['full_loop']['max']);
    if ($this->_sections['full_loop']['total'] == 0)
        $this->_sections['full_loop']['show'] = false;
} else
    $this->_sections['full_loop']['total'] = 0;
if ($this->_sections['full_loop']['show']):

            for ($this->_sections['full_loop']['index'] = $this->_sections['full_loop']['start'], $this->_sections['full_loop']['iteration'] = 1;
                 $this->_sections['full_loop']['iteration'] <= $this->_sections['full_loop']['total'];
                 $this->_sections['full_loop']['index'] += $this->_sections['full_loop']['step'], $this->_sections['full_loop']['iteration']++):
$this->_sections['full_loop']['rownum'] = $this->_sections['full_loop']['iteration'];
$this->_sections['full_loop']['index_prev'] = $this->_sections['full_loop']['index'] - $this->_sections['full_loop']['step'];
$this->_sections['full_loop']['index_next'] = $this->_sections['full_loop']['index'] + $this->_sections['full_loop']['step'];
$this->_sections['full_loop']['first']      = ($this->_sections['full_loop']['iteration'] == 1);
$this->_sections['full_loop']['last']       = ($this->_sections['full_loop']['iteration'] == $this->_sections['full_loop']['total']);
?>
	    <img src='./images/icons/video_rating_full_small.gif' border='0'>
  	  <?php endfor; endif; ?>
	  <?php if ($this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_rating_part']): ?><img src='./images/icons/video_rating_part_small.gif' border='0'><?php endif; ?>
          <?php unset($this->_sections['none_loop']);
$this->_sections['none_loop']['name'] = 'none_loop';
$this->_sections['none_loop']['start'] = (int)0;
$this->_sections['none_loop']['loop'] = is_array($_loop=$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_rating_none']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['none_loop']['show'] = true;
$this->_sections['none_loop']['max'] = $this->_sections['none_loop']['loop'];
$this->_sections['none_loop']['step'] = 1;
if ($this->_sections['none_loop']['start'] < 0)
    $this->_sections['none_loop']['start'] = max($this->_sections['none_loop']['step'] > 0 ? 0 : -1, $this->_sections['none_loop']['loop'] + $this->_sections['none_loop']['start']);
else
    $this->_sections['none_loop']['start'] = min($this->_sections['none_loop']['start'], $this->_sections['none_loop']['step'] > 0 ? $this->_sections['none_loop']['loop'] : $this->_sections['none_loop']['loop']-1);
if ($this->_sections['none_loop']['show']) {
    $this->_sections['none_loop']['total'] = min(ceil(($this->_sections['none_loop']['step'] > 0 ? $this->_sections['none_loop']['loop'] - $this->_sections['none_loop']['start'] : $this->_sections['none_loop']['start']+1)/abs($this->_sections['none_loop']['step'])), $this->_sections['none_loop']['max']);
    if ($this->_sections['none_loop']['total'] == 0)
        $this->_sections['none_loop']['show'] = false;
} else
    $this->_sections['none_loop']['total'] = 0;
if ($this->_sections['none_loop']['show']):

            for ($this->_sections['none_loop']['index'] = $this->_sections['none_loop']['start'], $this->_sections['none_loop']['iteration'] = 1;
                 $this->_sections['none_loop']['iteration'] <= $this->_sections['none_loop']['total'];
                 $this->_sections['none_loop']['index'] += $this->_sections['none_loop']['step'], $this->_sections['none_loop']['iteration']++):
$this->_sections['none_loop']['rownum'] = $this->_sections['none_loop']['iteration'];
$this->_sections['none_loop']['index_prev'] = $this->_sections['none_loop']['index'] - $this->_sections['none_loop']['step'];
$this->_sections['none_loop']['index_next'] = $this->_sections['none_loop']['index'] + $this->_sections['none_loop']['step'];
$this->_sections['none_loop']['first']      = ($this->_sections['none_loop']['iteration'] == 1);
$this->_sections['none_loop']['last']       = ($this->_sections['none_loop']['iteration'] == $this->_sections['none_loop']['total']);
?>
	    <img src='./images/icons/video_rating_none_small.gif' border='0'>
	  <?php endfor; endif; ?>
        </div>
      </td>
      </tr>
      </table>
    </div>

    <?php echo smarty_function_cycle(array('values' => ",<div style='clear: both; height: 0px;'></div>"), $this);?>


  <?php endfor; endif; ?>
  <div style='clear: both; height: 0px;'></div>

<?php endif; ?>