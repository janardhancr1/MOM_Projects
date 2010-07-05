<?php /* Smarty version 2.6.14, created on 2010-05-31 03:23:42
         compiled from album.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'album.tpl', 14, false),array('function', 'cycle', 'album.tpl', 43, false),array('modifier', 'truncate', 'album.tpl', 46, false),)), $this);
?><?php
SELanguage::_preload_multi(1000141,182,184,185,183);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'>
  <?php echo sprintf(SELanguage::_get(1000141), $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['owner']->user_info['user_username']), $this->_tpl_vars['owner']->user_displayname, $this->_tpl_vars['url']->url_create('albums',$this->_tpl_vars['owner']->user_info['user_username'])); ?> &#187; <?php echo $this->_tpl_vars['album_info']['album_title']; ?>

</div>

<?php if ($this->_tpl_vars['album_info']['album_desc'] != ""): ?><div><?php echo $this->_tpl_vars['album_info']['album_desc']; ?>
</div><?php endif; 
 if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div style='text-align: center;padding-top:10px;'>
  <?php if ($this->_tpl_vars['p'] != 1): ?><a href='<?php echo $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['album_info']['album_id']); ?>
/&p=<?php echo smarty_function_math(array('equation' => 'p-1','p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?><font class='disabled'>&#171; <?php echo SELanguage::_get(182); ?></font><?php endif; ?>
  <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
    &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_files']); ?> &nbsp;|&nbsp; 
  <?php else: ?>
    &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_files']); ?> &nbsp;|&nbsp; 
  <?php endif; ?>
  <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?><a href='<?php echo $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['album_info']['album_id']); ?>
/&p=<?php echo smarty_function_math(array('equation' => 'p+1','p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: ?><font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font><?php endif; ?>
  </div>
<?php endif; 
 unset($this->_sections['files_loop']);
$this->_sections['files_loop']['name'] = 'files_loop';
$this->_sections['files_loop']['loop'] = is_array($_loop=$this->_tpl_vars['files']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['files_loop']['show'] = true;
$this->_sections['files_loop']['max'] = $this->_sections['files_loop']['loop'];
$this->_sections['files_loop']['step'] = 1;
$this->_sections['files_loop']['start'] = $this->_sections['files_loop']['step'] > 0 ? 0 : $this->_sections['files_loop']['loop']-1;
if ($this->_sections['files_loop']['show']) {
    $this->_sections['files_loop']['total'] = $this->_sections['files_loop']['loop'];
    if ($this->_sections['files_loop']['total'] == 0)
        $this->_sections['files_loop']['show'] = false;
} else
    $this->_sections['files_loop']['total'] = 0;
if ($this->_sections['files_loop']['show']):

            for ($this->_sections['files_loop']['index'] = $this->_sections['files_loop']['start'], $this->_sections['files_loop']['iteration'] = 1;
                 $this->_sections['files_loop']['iteration'] <= $this->_sections['files_loop']['total'];
                 $this->_sections['files_loop']['index'] += $this->_sections['files_loop']['step'], $this->_sections['files_loop']['iteration']++):
$this->_sections['files_loop']['rownum'] = $this->_sections['files_loop']['iteration'];
$this->_sections['files_loop']['index_prev'] = $this->_sections['files_loop']['index'] - $this->_sections['files_loop']['step'];
$this->_sections['files_loop']['index_next'] = $this->_sections['files_loop']['index'] + $this->_sections['files_loop']['step'];
$this->_sections['files_loop']['first']      = ($this->_sections['files_loop']['iteration'] == 1);
$this->_sections['files_loop']['last']       = ($this->_sections['files_loop']['iteration'] == $this->_sections['files_loop']['total']);
?>

    <?php if ($this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'jpeg' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'jpg' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'gif' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'png' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'bmp'): ?>
    <?php $this->assign('file_dir', $this->_tpl_vars['url']->url_userdir($this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_author']->user_info['user_id'])); ?>
    <?php $this->assign('file_src', ($this->_tpl_vars['file_dir']).($this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id'])."_thumb.jpg"); ?>
    <?php elseif ($this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'mp3' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'mp4' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'wav'): ?>
    <?php $this->assign('file_src', './images/icons/audio_big.gif'); ?>
    <?php elseif ($this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'mpeg' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'mpg' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'mpa' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'avi' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'swf' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'mov' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'ram' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'rm'): ?>
    <?php $this->assign('file_src', './images/icons/video_big.gif'); ?>
    <?php else: ?>
    <?php $this->assign('file_src', './images/icons/file_big.gif'); ?>
  <?php endif; ?>

    <?php echo smarty_function_cycle(array('name' => 'startrow','values' => "<table cellpadding='0' cellspacing='0' align='center'><tr>,,,,"), $this);?>

    <td style='padding: 15px 15px 15px 0px; text-align: center; vertical-align: middle;'>
    <?php echo ((is_array($_tmp=$this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...", true) : smarty_modifier_truncate($_tmp, 20, "...", true)); ?>
&nbsp;
    <div class='album_thumb2' style='width: 120; text-align: center; vertical-align: middle;'>
      <a href='<?php echo $this->_tpl_vars['url']->url_create('album_file',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['album_info']['album_id'],$this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']); ?>
'><img src='<?php echo $this->_tpl_vars['file_src']; ?>
' border='0' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['file_src'],'120','120','w'); ?>
'></a>
    </div>
  </td>
    <?php if ($this->_sections['files_loop']['last'] == true): ?>
    </tr></table>
  <?php else: ?>
    <?php echo smarty_function_cycle(array('name' => 'endrow','values' => ",,,,</tr></table>"), $this);?>

  <?php endif; 
 endfor; endif; 
 if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div style='text-align: center;padding-top:10px;'>
  <?php if ($this->_tpl_vars['p'] != 1): ?><a href='<?php echo $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['album_info']['album_id']); ?>
/&p=<?php echo smarty_function_math(array('equation' => 'p-1','p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?><font class='disabled'>&#171; <?php echo SELanguage::_get(182); ?></font><?php endif; ?>
  <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
    &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_files']); ?> &nbsp;|&nbsp; 
  <?php else: ?>
    &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_files']); ?> &nbsp;|&nbsp; 
  <?php endif; ?>
  <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?><a href='<?php echo $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['album_info']['album_id']); ?>
/&p=<?php echo smarty_function_math(array('equation' => 'p+1','p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: ?><font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font><?php endif; ?>
  </div>
<?php endif; ?>
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