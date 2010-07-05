<?php /* Smarty version 2.6.14, created on 2010-06-02 16:43:49
         compiled from browse_music.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'browse_music.tpl', 43, false),array('function', 'cycle', 'browse_music.tpl', 88, false),array('modifier', 'truncate', 'browse_music.tpl', 73, false),)), $this);
?><?php
SELanguage::_preload_multi(4000004,4000097,4000098,4000099,4000100,4000101,4000102,182,184,185,183,4000103,4000095);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'><img src='./images/icons/music_music48.gif' border='0' class='icon_big'><?php echo SELanguage::_get(4000004); ?>
<div class="page_header_small">Share your favorite track with moms!</div>
</div>
<div style='padding: 7px 10px 7px 10px; background: #F2F2F2; border: 1px solid #BBBBBB; margin: 10px 0px 10px 0px; font-weight: bold;'>
  <table cellpadding='0' cellspacing='0' width='100%'>
  <tr>
  <td>
    <?php echo SELanguage::_get(4000097); ?>&nbsp;
  </td>
  <td>
    <select class='small' name='v' onchange="window.location.href='browse_music.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v='+this.options[this.selectedIndex].value;">
      <option value='0'<?php if ($this->_tpl_vars['v'] == '0'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(4000098); ?></option>
      <?php if ($this->_tpl_vars['user']->user_exists): ?><option value='1'<?php if ($this->_tpl_vars['v'] == '1'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(4000099); ?></option><?php endif; ?>
    </select>
  </td>
  <td style='padding-left: 20px;'>
    <?php echo SELanguage::_get(4000100); ?>&nbsp;
  </td>
  <td>
    <select class='small' name='s' onchange="window.location.href='browse_music.php?v=<?php echo $this->_tpl_vars['v']; ?>
&s='+this.options[this.selectedIndex].value;">
      <option value='music_date DESC'<?php if ($this->_tpl_vars['s'] == 'music_date DESC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(4000101); ?></option>
      <option value='music_track_num ASC'<?php if ($this->_tpl_vars['s'] == 'music_track_num ASC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(4000102); ?></option>
    </select>
  </td>
  <td>
	  	<div class='mom_div_small'><a href='user_music.php' class='mom_div_small'><img src='./images/icons/plus16.gif' border='0' class='button'>Go to My Palylist</a></div>
  </td>
  </tr>
  </table>
</div>


<?php if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div style='text-align: center; padding-bottom: 10px;'>
  <?php if ($this->_tpl_vars['p'] != 1): ?><a href='browse_music.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?>&#171; <?php echo SELanguage::_get(182); 
 endif; ?>
  &nbsp;|&nbsp;&nbsp;
  <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
    <b><?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['browse_music_total']); ?></b>
  <?php else: ?>
    <b><?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['browse_music_total']); ?></b>
  <?php endif; ?>
  &nbsp;&nbsp;|&nbsp;
  <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?><a href='browse_music.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: 
 echo SELanguage::_get(183); ?> &#187;<?php endif; ?>
  </div>
<?php endif; ?>


<div>
  <?php unset($this->_sections['browse_music_list_loop']);
$this->_sections['browse_music_list_loop']['name'] = 'browse_music_list_loop';
$this->_sections['browse_music_list_loop']['loop'] = is_array($_loop=$this->_tpl_vars['browse_music_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['browse_music_list_loop']['show'] = true;
$this->_sections['browse_music_list_loop']['max'] = $this->_sections['browse_music_list_loop']['loop'];
$this->_sections['browse_music_list_loop']['step'] = 1;
$this->_sections['browse_music_list_loop']['start'] = $this->_sections['browse_music_list_loop']['step'] > 0 ? 0 : $this->_sections['browse_music_list_loop']['loop']-1;
if ($this->_sections['browse_music_list_loop']['show']) {
    $this->_sections['browse_music_list_loop']['total'] = $this->_sections['browse_music_list_loop']['loop'];
    if ($this->_sections['browse_music_list_loop']['total'] == 0)
        $this->_sections['browse_music_list_loop']['show'] = false;
} else
    $this->_sections['browse_music_list_loop']['total'] = 0;
if ($this->_sections['browse_music_list_loop']['show']):

            for ($this->_sections['browse_music_list_loop']['index'] = $this->_sections['browse_music_list_loop']['start'], $this->_sections['browse_music_list_loop']['iteration'] = 1;
                 $this->_sections['browse_music_list_loop']['iteration'] <= $this->_sections['browse_music_list_loop']['total'];
                 $this->_sections['browse_music_list_loop']['index'] += $this->_sections['browse_music_list_loop']['step'], $this->_sections['browse_music_list_loop']['iteration']++):
$this->_sections['browse_music_list_loop']['rownum'] = $this->_sections['browse_music_list_loop']['iteration'];
$this->_sections['browse_music_list_loop']['index_prev'] = $this->_sections['browse_music_list_loop']['index'] - $this->_sections['browse_music_list_loop']['step'];
$this->_sections['browse_music_list_loop']['index_next'] = $this->_sections['browse_music_list_loop']['index'] + $this->_sections['browse_music_list_loop']['step'];
$this->_sections['browse_music_list_loop']['first']      = ($this->_sections['browse_music_list_loop']['iteration'] == 1);
$this->_sections['browse_music_list_loop']['last']       = ($this->_sections['browse_music_list_loop']['iteration'] == $this->_sections['browse_music_list_loop']['total']);
?>
    <?php $this->assign('media_dir', $this->_tpl_vars['url']->url_userdir($this->_tpl_vars['browse_music_list'][$this->_sections['browse_music_list_loop']['index']]['user_id'])); ?>
    <?php $this->assign('media_path', ($this->_tpl_vars['media_dir']).($this->_tpl_vars['browse_music_list'][$this->_sections['browse_music_list_loop']['index']]['music_id']).".".($this->_tpl_vars['browse_music_list'][$this->_sections['browse_music_list_loop']['index']]['music_ext'])); ?>
    
    <div class='music_browse_item' style='width: 310px; float: left;'>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td style='vertical-align: middle;padding-right: 3px;'>
        <div class='music_button'>
          <object width="17" height="17" data="./images/music_button.swf?song_url=<?php echo $this->_tpl_vars['media_path']; ?>
" type="application/x-shockwave-flash">
            <param value="./images/music_button.swf?song_url=<?php echo $this->_tpl_vars['media_path']; ?>
" name="movie" />
            <img width="17" height="17" alt="" src="noflash.gif" />
          </object>
        </div>
      </td>
      <td style='vertical-align: top; padding-left: 10px;'>
        <div style='font-weight: bold; font-size: 13px;'><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['browse_music_list'][$this->_sections['browse_music_list_loop']['index']]['user_username']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['browse_music_list'][$this->_sections['browse_music_list_loop']['index']]['music_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 45, "...", true) : smarty_modifier_truncate($_tmp, 45, "...", true)); ?>
</a></div>
        <div class='music_browse_date'>
          <?php $this->assign('music_date', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['browse_music_list'][$this->_sections['browse_music_list_loop']['index']]['music_date'])); 
 ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['music_date'][0]), $this->_tpl_vars['music_date'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('updated', ob_get_contents());ob_end_clean(); ?>
          <?php echo sprintf(SELanguage::_get(4000103), $this->_tpl_vars['updated'], $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['browse_music_list'][$this->_sections['browse_music_list_loop']['index']]['user_username']), $this->_tpl_vars['browse_music_list'][$this->_sections['browse_music_list_loop']['index']]['music_uploader']->user_displayname); ?>
        </div>
        <?php if ($this->_tpl_vars['user']->user_exists && $this->_tpl_vars['user']->level_info['level_music_allow_downloads']): ?>
        <div style='margin-top: 4px;'>
          <a type="application/force-download" href="<?php echo $this->_tpl_vars['media_path']; ?>
"><?php echo SELanguage::_get(4000095); ?></a>
        </div>
        <?php endif; ?>
      </td>
      </tr>
      </table>
    </div>
    
    <?php echo smarty_function_cycle(array('values' => ",<div style='clear: both; height: 10px;'></div>"), $this);?>

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