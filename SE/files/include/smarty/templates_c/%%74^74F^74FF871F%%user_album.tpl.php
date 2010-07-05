<?php /* Smarty version 2.6.14, created on 2010-06-24 16:19:00
         compiled from user_album.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'user_album.tpl', 84, false),)), $this);
?><?php
SELanguage::_preload_multi(1000055,1000059,1000056,1000061,1000062,1000063,1000064,1000065,1000066,1000067,1000068,1000069,1000070,1000114,1000071,1000072,1000054,1000053,175,39);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<table cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td valign='top'>

  <img src='./images/icons/album_image48.gif' border='0' class='icon_big' />
<div class='page_header'><?php echo SELanguage::_get(1000055); ?></div>
<div class='mom_div_small'>
Create a new album today and share it with friends
</div>

</td>
<td valign='top' align='right'>

  <table cellpadding='0' cellspacing='0' width='150'>
  <tr><td class='button' nowrap='nowrap'><a href='browse_albums.php'><img src='./images/icons/back16.gif' border='0' class='button'>Back to Photos</a></td></tr>
  </table>

</td>
</tr>
</table>



<div style='margin-top: 20px;'>
  <div class='button' style='float: left;'>
    <a href='user_album_add.php'><img src='./images/icons/plus16.gif' border='0' class='button'><?php echo SELanguage::_get(1000059); ?></a>
  </div>
  <div class='button' style='float: left; padding-left: 20px;'>
    <a href='user_album_settings.php'><img src='./images/icons/album_settings16.gif' border='0' class='button'><?php echo SELanguage::_get(1000056); ?></a>
  </div>
  <div style='clear: both; height: 0px;'></div>
</div>

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
      <?php $this->assign('album_cover_dir', $this->_tpl_vars['url']->url_userdir($this->_tpl_vars['user']->user_info['user_id'])); ?>
      <?php $this->assign('album_cover_src', ($this->_tpl_vars['album_cover_dir']).($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_id'])."_thumb.jpg"); ?>
        <?php elseif ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mp3' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mp4' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'wav'): ?>
      <?php $this->assign('album_cover_src', './images/icons/audio_big.gif'); ?>
        <?php elseif ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mpeg' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mpg' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mpa' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'avi' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'swf' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mov' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'ram' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'rm'): ?>
      <?php $this->assign('album_cover_src', './images/icons/video_big.gif'); ?>
        <?php else: ?>
      <?php $this->assign('album_cover_src', './images/icons/file_big.gif'); ?>
    <?php endif; ?>
  <?php endif; ?>


  <div class='album' style='width: 550px;' id='album_<?php echo $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']; ?>
'>
    <table cellpadding='0' cellspacing='0' width='100%'>
      <tr>
        <td class='album_left' width='1'>
          <div class='album_photo' style='width: 140px; height: 140px;'>
            <table cellpadding='0' cellspacing='0' width='140' height='140'>
              <tr>
                <td>
                  <a href='user_album_update.php?album_id=<?php echo $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']; ?>
'>
                    <img src='<?php echo $this->_tpl_vars['album_cover_src']; ?>
' border='0' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['album_cover_src'],'140','140','w'); ?>
' />
                  </a>
                </td>
              </tr>
            </table>
          </div>
        </td>
        <td class='album_right' width='100%'>
          <div class='album_title'>
            <a href='user_album_update.php?album_id=<?php echo $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']; ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>
</a>
          </div>
          <?php if ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_desc'] != ""): ?>
            <div style='margin-bottom: 8px;'><?php echo ((is_array($_tmp=$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_desc'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 197, "...", true) : smarty_modifier_truncate($_tmp, 197, "...", true)); ?>
</div>
          <?php endif; ?>
          <div class='album_stats'>
            <?php echo SELanguage::_get(1000061); ?>
            <?php $this->assign('album_datecreated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_datecreated'])); ?>
            <?php echo sprintf(SELanguage::_get($this->_tpl_vars['album_datecreated'][0]), $this->_tpl_vars['album_datecreated'][1]); ?>
            <br />
            <?php if ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_dateupdated'] != 0): ?>
              <?php echo SELanguage::_get(1000062); ?>
              <?php $this->assign('album_dateupdated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_dateupdated'])); ?>
              <?php echo sprintf(SELanguage::_get($this->_tpl_vars['album_dateupdated'][0]), $this->_tpl_vars['album_dateupdated'][1]); ?>
              <br />
            <?php endif; ?>
            <?php echo SELanguage::_get(1000063); ?> <?php echo sprintf(SELanguage::_get(1000064), $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_files'], $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_space']); ?><br />
            <?php echo SELanguage::_get(1000065); ?> <?php echo sprintf(SELanguage::_get(1000066), $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_views']); ?><br />
            <?php echo SELanguage::_get(1000067); ?> <?php echo SELanguage::_get($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_privacy']); ?>
            <div class='album_options'>
              <div style='float: left;'>
                <a href='<?php echo $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['user']->user_info['user_username'],$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']); ?>
'>
                  <img src='./images/icons/album_album16.gif' border='0' class='button' />
                  <?php echo SELanguage::_get(1000068); ?>
                </a>
              </div>
              <div style='float: left; padding-left: 15px;'>
                <a href='user_album_update.php?album_id=<?php echo $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']; ?>
'>
                  <img src='./images/icons/album_edit16.gif' border='0' class='button' />
                  <?php echo SELanguage::_get(1000069); ?>
                </a>
              </div>
              <div style='float: left; padding-left: 15px;'>
                <a href='javascript:void(0);' onClick="SocialEngine.Album.deleteAlbum(<?php echo $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']; ?>
);">
                  <img src='./images/icons/album_delete16.gif' border='0' class='button' />
                  <?php echo SELanguage::_get(1000070); ?>
                </a>
              </div>
              <div class="seAlbumActionMoveup" style='float: left; padding-left: 8px;<?php if ($this->_sections['album_loop']['first'] == true): ?>display:none;<?php endif; ?>'>
                <a href='javascript:void(0);' onclick="SocialEngine.Album.moveupAlbum(<?php echo $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']; ?>
);">
                  <img src='./images/icons/album_moveup16.gif' border='0' class='button' />
                  <?php echo SELanguage::_get(1000114); ?>
                </a>
              </div>
              <div style='clear: both; height: 0px;'></div>
            </div>
          </div>
        </td>
      </tr>
    </table>
  </div>

<?php endfor; endif; ?>
<div style='clear: both; height: 0px;'></div>

<?php if ($this->_tpl_vars['albums_total'] == 0): ?>
  <br />
  <table cellpadding='0' cellspacing='0'>
    <tr>
      <td class='result'>
        <img src='./images/icons/bulb16.gif' border='0' class='icon' />
        <?php echo SELanguage::_get(1000071); ?>
        <a href='user_album_add.php'><?php echo SELanguage::_get(1000072); ?></a>
      </td>
    </tr>
  </table>
<?php endif; 
 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(1000054));
$javascript_lang_import_first = TRUE;
if( is_array($javascript_lang_import_list) && !empty($javascript_lang_import_list) )
{
  echo "\n<script type='text/javascript'>\n<!--\n";
  echo "SocialEngine.Language.Import({\n";
  foreach( $javascript_lang_import_list as $javascript_import_id )
  {
    if( !$javascript_lang_import_first ) echo ",\n";
    echo "  ".$javascript_import_id." : '".addslashes(SE_Language::_get($javascript_import_id))."'";
    $javascript_lang_import_first = FALSE;
  }
  echo "\n});\n//-->\n</script>\n";
}
 ?>
<script type="text/javascript" src="./include/js/class_album.js"></script>
<script type="text/javascript">
<!-- 
  SocialEngine.Album = new SocialEngineAPI.Album();
  SocialEngine.RegisterModule(SocialEngine.Album);
//-->
</script>


<div style='display: none;' id='confirmdelete'>
  <div style='margin-top: 10px;'>
    <?php echo SELanguage::_get(1000053); ?>
  </div>
  <br />
  <input type='button' class='button' value='<?php echo SELanguage::_get(175); ?>' onClick='parent.TB_remove();parent.SocialEngine.Album.deleteAlbumConfirm();' />
  <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='parent.TB_remove();' />
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