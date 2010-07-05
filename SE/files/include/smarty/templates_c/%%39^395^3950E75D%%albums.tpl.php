<?php /* Smarty version 2.6.14, created on 2010-05-31 03:28:01
         compiled from albums.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'albums.tpl', 53, false),)), $this);
?><?php
SELanguage::_preload_multi(1000138,1000139,1000140);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'>
  <?php echo sprintf(SELanguage::_get(1000138), $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['owner']->user_info['user_username']), $this->_tpl_vars['owner']->user_displayname); ?>
</div>

<?php if ($this->_tpl_vars['total_albums'] == 0): ?>
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='result'>
    <img src='./images/icons/bulb22.gif' border='0' class='icon'>
    <?php echo sprintf(SELanguage::_get(1000139), $this->_tpl_vars['owner']->user_displayname); ?>
  </td></tr>
  </table>
<?php endif; 
 unset($this->_sections['album_loop']);
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
      <?php $this->assign('album_cover_dir', $this->_tpl_vars['url']->url_userdir($this->_tpl_vars['owner']->user_info['user_id'])); ?>
      <?php $this->assign('album_cover_src', ($this->_tpl_vars['album_cover_dir']).($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_id'])."_thumb.jpg"); ?>
        <?php elseif ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mp3' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mp4' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'wav'): ?>
      <?php $this->assign('album_cover_src', './images/icons/audio_big.gif'); ?>
        <?php elseif ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mpeg' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mpg' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mpa' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'avi' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'swf' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mov' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'ram' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'rm'): ?>
      <?php $this->assign('album_cover_src', './images/icons/video_big.gif'); ?>
        <?php else: ?>
      <?php $this->assign('album_cover_src', './images/icons/file_big.gif'); ?>
    <?php endif; ?>
  <?php endif; ?>


  <div class='album' style='width: 500px;'>
    <table cellpadding='0' cellspacing='0' width='100%'>
    <tr>
    <td class='album_left' width='1'>
      <div class='album_photo' style='width: 140px; height: 140px;'>
        <a href='<?php echo $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']); ?>
'><img src='<?php echo $this->_tpl_vars['album_cover_src']; ?>
' border='0' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['album_cover_src'],'140','140','w'); ?>
'></a></div>
      </div>
    </td>
    <td class='album_right'>
      <div class='album_title'>
        <a href='<?php echo $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>
</a>
        <?php if ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_dateupdated'] != 0): ?>
          <div class='album_stats'>
	   <?php $this->assign('album_dateupdated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_dateupdated'])); ?>
	   <?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['album_dateupdated'][0]), $this->_tpl_vars['album_dateupdated'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('dateupdated', ob_get_contents());ob_end_clean(); ?>
	   <?php echo sprintf(SELanguage::_get(1000140), $this->_tpl_vars['dateupdated']); ?>
          </div>
        <?php endif; ?>

      </div>
      <div style='margin-bottom: 8px;'>
        <?php echo $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_desc']; ?>

      </div>
    </td>
    </tr>
    </table>
  </div>

<?php endfor; endif; ?>
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