<?php /* Smarty version 2.6.14, created on 2010-06-01 15:11:33
         compiled from browse_albums.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'browse_albums.tpl', 53, false),array('function', 'cycle', 'browse_albums.tpl', 109, false),array('modifier', 'truncate', 'browse_albums.tpl', 99, false),)), $this);
?><?php
SELanguage::_preload_multi(1000123,1000128,1000129,1000130,1000131,1000132,1000133,182,184,185,183,1000172,1000124);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'><img src='./images/icons/album_image48.gif' border='0' class='icon_big'><?php echo SELanguage::_get(1000123); ?>
<div class="page_header_small">Create, share and view picture albums from moms everywhere!</div>
</div>

<div style='padding: 7px 10px 7px 10px; background: #F2F2F2; border: 1px solid #BBBBBB; margin: 10px 0px 10px 0px; font-weight: bold;'>
<table>
	<tr>
	<td width="50%">
	  <table cellpadding='0' cellspacing='0'>
	  <tr>
	  <td>
	    <?php echo SELanguage::_get(1000128); ?>&nbsp;
	  </td>
	  <td>
	    <select class='small' name='v' onchange="window.location.href='browse_albums.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v='+this.options[this.selectedIndex].value;">
	    <option value='0'<?php if ($this->_tpl_vars['v'] == '0'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(1000129); ?></option>
	    <?php if ($this->_tpl_vars['user']->user_exists): ?><option value='1'<?php if ($this->_tpl_vars['v'] == '1'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(1000130); ?></option><?php endif; ?>
	    </select>
	  </td>
	  <td style='padding-left: 20px;'>
	    <?php echo SELanguage::_get(1000131); ?>&nbsp;
	  </td>
	  <td>
	    <select class='small' name='s' onchange="window.location.href='browse_albums.php?v=<?php echo $this->_tpl_vars['v']; ?>
&s='+this.options[this.selectedIndex].value;">
	    <option value='album_dateupdated DESC'<?php if ($this->_tpl_vars['s'] == 'album_dateupdated DESC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(1000132); ?></option>
	    <option value='album_datecreated DESC'<?php if ($this->_tpl_vars['s'] == 'album_datecreated DESC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(1000133); ?></option>
	    </select>
	  </td>
	  </tr>
	  </table>
	</td>
	<td width="50%">
	<table cellpadding='0' cellspacing='0' align="right">
	  <tr>
	  <td valign="top">
	  	<div class='mom_div_small'><a href='user_album.php' class='mom_div_small'><img src='./images/icons/plus16.gif' border='0' class='button'>Go to My Photo Albums</a></div>
	  </td>
	  </tr>
	  </table>
  	</td>
  </tr>
  </table>
</div>


<?php if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div style='text-align: center; padding-bottom: 10px;'>
  <?php if ($this->_tpl_vars['p'] != 1): ?><a href='browse_albums.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&p=<?php echo smarty_function_math(array('equation' => 'p-1','p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?>&#171; <?php echo SELanguage::_get(182); 
 endif; ?>
  &nbsp;|&nbsp;&nbsp;
  <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
    <b><?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_albums']); ?></b>
  <?php else: ?>
    <b><?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_albums']); ?></b>
  <?php endif; ?>
  &nbsp;&nbsp;|&nbsp;
  <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?><a href='browse_albums.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&p=<?php echo smarty_function_math(array('equation' => 'p+1','p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: 
 echo SELanguage::_get(183); ?> &#187;<?php endif; ?>
  </div>
<?php endif; ?>



<div>

  <?php unset($this->_sections['album_loop']);
$this->_sections['album_loop']['name'] = 'album_loop';
$this->_sections['album_loop']['loop'] = is_array($_loop=$this->_tpl_vars['albums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['album_loop']['show'] = true;
$this->_sections['album_loop']['max'] = $this->_sections['album_loop']['loop'];
$this->_sections['album_loop']['step'] = 1;
$this->_sections['album_loop']['start'] = $this->_sections['album_loop']['step'] > 0 ? 0 : $this->_sections['album_loop']['loop']-1;
if ($this->_sections['album_loop']['show']) {
    $this->_sections['album_loop']['total'] = $this->_sections['album_loop']['loop'];
    if ($this->_sections['album_loop']['total'] == 0)
        $this->_sections['album_loop']['show'] = false;
} else
    $this->_sections['album_loop']['total'] = 0;
if ($this->_sections['album_loop']['show']):

            for ($this->_sections['album_loop']['index'] = $this->_sections['album_loop']['start'], $this->_sections['album_loop']['iteration'] = 1;
                 $this->_sections['album_loop']['iteration'] <= $this->_sections['album_loop']['total'];
                 $this->_sections['album_loop']['index'] += $this->_sections['album_loop']['step'], $this->_sections['album_loop']['iteration']++):
$this->_sections['album_loop']['rownum'] = $this->_sections['album_loop']['iteration'];
$this->_sections['album_loop']['index_prev'] = $this->_sections['album_loop']['index'] - $this->_sections['album_loop']['step'];
$this->_sections['album_loop']['index_next'] = $this->_sections['album_loop']['index'] + $this->_sections['album_loop']['step'];
$this->_sections['album_loop']['first']      = ($this->_sections['album_loop']['iteration'] == 1);
$this->_sections['album_loop']['last']       = ($this->_sections['album_loop']['iteration'] == $this->_sections['album_loop']['total']);
?>

        <?php if ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_id'] == 0): ?>
      <?php $this->assign('album_cover_src', './images/icons/folder_big.gif'); ?>
    <?php else: ?>
            <?php if ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'jpeg' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'jpg' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'gif' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'png' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'bmp'): ?>
        <?php $this->assign('album_cover_dir', $this->_tpl_vars['url']->url_userdir($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_author']->user_info['user_id'])); ?>
        <?php $this->assign('album_cover_src', ($this->_tpl_vars['album_cover_dir']).($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_id'])."_thumb.jpg"); ?>
            <?php elseif ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mp3' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mp4' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'wav'): ?>
        <?php $this->assign('album_cover_src', './images/icons/audio_big.gif'); ?>
            <?php elseif ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mpeg' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mpg' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mpa' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'avi' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'swf' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mov' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'ram' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'rm'): ?>
        <?php $this->assign('album_cover_src', './images/icons/video_big.gif'); ?>
            <?php else: ?>
        <?php $this->assign('album_cover_src', './images/icons/file_big.gif'); ?>
      <?php endif; ?>
    <?php endif; ?>


      <div class='albums_browse_item' style='width: 130px; float: left;'>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td style='vertical-align: top;'>
      <div style='border:1px solid #CCCCCC;text-align:center'>
        <a href='<?php echo $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_author']->user_info['user_username'],$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']); ?>
'><img src='<?php echo $this->_tpl_vars['album_cover_src']; ?>
' border='0' width='100' height='100'></a>
       </div>
        <div style='font-weight: bold; font-size: 13px;'><a href='<?php echo $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_author']->user_info['user_username'],$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>
</a></div>
        <div class='album_browse_date'>
          <?php $this->assign('album_dateupdated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_dateupdated'])); 
 ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['album_dateupdated'][0]), $this->_tpl_vars['album_dateupdated'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('updated', ob_get_contents());ob_end_clean(); ?>
          <?php echo sprintf(SELanguage::_get(1000172), $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_files']); ?> - <?php echo sprintf(SELanguage::_get(1000124), $this->_tpl_vars['updated'], $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_author']->user_info['user_username']), $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_author']->user_displayname); ?>
        </div>
      </td>
      </tr>
      </table>
    </div>

    <?php echo smarty_function_cycle(array('values' => ",,,<div style='clear: both; height: 10px;'></div>"), $this);?>

  <?php endfor; endif; ?>

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