<?php /* Smarty version 2.6.14, created on 2010-04-24 16:03:17
         compiled from profile_album_tab.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'profile_album_tab.tpl', 37, false),array('modifier', 'truncate', 'profile_album_tab.tpl', 44, false),)), $this);
?><?php
SELanguage::_preload_multi(1000171,1000140);
SELanguage::load();
?>

<?php if ($this->_tpl_vars['owner']->level_info['level_album_allow'] != 0 && $this->_tpl_vars['total_albums'] > 0): ?>

  <div class='profile_headline'>
    <?php echo SELanguage::_get(1000171); ?> (<?php echo $this->_tpl_vars['total_albums']; ?>
)
  </div>

    <?php if ($this->_tpl_vars['total_albums'] > 6): ?>&nbsp;[ <a href='<?php echo $this->_tpl_vars['url']->url_create('albums',$this->_tpl_vars['owner']->user_info['user_username']); ?>
'>view all</a> ]<?php endif; ?>

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

    <div class='album_item' style='width: 45%;<?php echo smarty_function_cycle(array('name' => 'rightspacer','values' => "margin-right: 10px;,"), $this);?>
'>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td style='vertical-align: top;'>
        <a href='<?php echo $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']); ?>
'><img src='<?php echo $this->_tpl_vars['album_cover_src']; ?>
' border='0' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['album_cover_src'],'75','75','w'); ?>
'></a>
      </td>
      <td class='album_item_info'>
        <div class='album_item_title'><a href='<?php echo $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 17, "...", true) : smarty_modifier_truncate($_tmp, 17, "...", true)); ?>
</a></div>
        <?php if ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_dateupdated'] > 0): ?>
	  <?php $this->assign('album_dateupdated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_dateupdated'])); ?>
	  <?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['album_dateupdated'][0]), $this->_tpl_vars['album_dateupdated'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('updateddate', ob_get_contents());ob_end_clean(); ?>
          <div class='album_item_date'><?php echo sprintf(SELanguage::_get(1000140), $this->_tpl_vars['updateddate']); ?></div>
        <?php endif; ?>
        <div style='margin-top: 10px;'><?php echo ((is_array($_tmp=$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_desc'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 75, "...", true) : smarty_modifier_truncate($_tmp, 75, "...", true)); ?>
</div>
      </td>
      </tr>
      </table>
    </div>
    <?php echo smarty_function_cycle(array('values' => ",<div name='bottomspacer' style='clear: both; height: 10px;'></div>"), $this);?>

    
  <?php endfor; endif; ?>
  <div style='clear: both; height: 0px;'></div>


<?php endif; ?>