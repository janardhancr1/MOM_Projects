<?php /* Smarty version 2.6.14, created on 2010-06-01 15:10:41
         compiled from browse_videos.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'browse_videos.tpl', 57, false),array('function', 'cycle', 'browse_videos.tpl', 99, false),array('modifier', 'truncate', 'browse_videos.tpl', 84, false),)), $this);
?><?php
SELanguage::_preload_multi(5500071,5500072,5500073,5500074,5500075,5500144,5500156,182,184,185,183,589,5500023,5500070);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'>
<img src='./images/icons/video_video48.gif' border='0' class='icon_big' />
Videos
<div class="page_header_small">Create, share and view videos from moms everywhere!</div>
</div>

<div style='padding: 7px 10px 7px 10px; background: #F2F2F2; border: 1px solid #BBBBBB; margin: 10px 0px 10px 0px; font-weight: bold;'>
<table>
	<tr>
	<td width="50%">
  <table cellpadding='0' cellspacing='0'>
  <tr>
  <td>
    <?php echo SELanguage::_get(5500071); ?>&nbsp;
  </td>
  <td>
    <select class='small' name='v' onchange="window.location.href='browse_videos.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v='+this.options[this.selectedIndex].value;">
    <option value='0'<?php if ($this->_tpl_vars['v'] == '0'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(5500072); ?></option>
    <?php if ($this->_tpl_vars['user']->user_exists): ?><option value='1'<?php if ($this->_tpl_vars['v'] == '1'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(5500073); ?></option><?php endif; ?>
    </select>
  </td>
  <td style='padding-left: 20px;'>
    <?php echo SELanguage::_get(5500074); ?>&nbsp;
  </td>
  <td>
    <select class='small' name='s' onchange="window.location.href='browse_videos.php?v=<?php echo $this->_tpl_vars['v']; ?>
&s='+this.options[this.selectedIndex].value;">
    <option value='video_datecreated DESC'<?php if ($this->_tpl_vars['s'] == 'video_dateupdated DESC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(5500075); ?></option>
    <option value='video_views DESC'<?php if ($this->_tpl_vars['s'] == 'video_views DESC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(5500144); ?></option>
    <option value='video_cache_rating_weighted DESC'<?php if ($this->_tpl_vars['s'] == 'video_cache_rating_weighted DESC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(5500156); ?></option>
    </select>
  </td>
  </tr>
  </table>
  </td>
	<td width="50%">
	<table cellpadding='0' cellspacing='0' align="right">
	  <tr>
	  <td valign="top">
	  	<div class='mom_div_small'><a href='user_video.php' class='mom_div_small'><img src='./images/icons/plus16.gif' border='0' class='button'>Go to My Videos</a></div>
	  </td>
	  </tr>
	  </table>
  	</td>
  </tr>
  </table>
</div>


<?php if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div style='text-align: center; padding-bottom: 10px;'>
  <?php if ($this->_tpl_vars['p'] != 1): ?><a href='browse_videos.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&p=<?php echo smarty_function_math(array('equation' => 'p-1','p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?>&#171; <?php echo SELanguage::_get(182); 
 endif; ?>
  &nbsp;|&nbsp;&nbsp;
  <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
    <b><?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_videos']); ?></b>
  <?php else: ?>
    <b><?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_videos']); ?></b>
  <?php endif; ?>
  &nbsp;&nbsp;|&nbsp;
  <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?><a href='browse_videos.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&p=<?php echo smarty_function_math(array('equation' => 'p+1','p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: 
 echo SELanguage::_get(183); ?> &#187;<?php endif; ?>
  </div>
<?php endif; ?>


<div>

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

      <div class='videoTab' style='width: 275px;'>
	<table cellpadding='0' cellspacing='0'>
	<tr>
	<td style='vertical-align: top;'>
	  <a href='<?php echo $this->_tpl_vars['url']->url_create('video',$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_author']->user_info['user_username'],$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']); ?>
'><img src='<?php if ($this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_thumb']): 
 echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_dir']; 
 echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']; ?>
_thumb.jpg<?php else: ?>./images/video_placeholder.gif<?php endif; ?>' border='0' width='<?php echo $this->_tpl_vars['setting']['setting_video_thumb_width']; ?>
' height='<?php echo $this->_tpl_vars['setting']['setting_video_thumb_height']; ?>
'></a>
	</td>
	<td style='vertical-align: top; padding-left: 5px;'>
          <div class='video_row_title'><a href='<?php echo $this->_tpl_vars['url']->url_create('video',$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_author']->user_info['user_username'],$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['video_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 55, '...', true) : smarty_modifier_truncate($_tmp, 55, '...', true)); ?>
</a></div>
          <div class='video_row_info'><?php echo sprintf(SELanguage::_get(5500023), $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['total_comments']); ?> - <?php echo sprintf(SELanguage::_get(5500070), $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_views']); ?></div>
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
      <?php echo smarty_function_cycle(array('values' => ",,<div style='clear: both; height: 0px;'></div>"), $this);?>


  <?php endfor; endif; ?>
  <div style='clear: both; height: 0px;'></div>

</div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'rightside.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='clear: both; height: 10px;'></div>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>