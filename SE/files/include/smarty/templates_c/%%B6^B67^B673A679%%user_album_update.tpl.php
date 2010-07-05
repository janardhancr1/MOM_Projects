<?php /* Smarty version 2.6.14, created on 2010-05-26 12:42:16
         compiled from user_album_update.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'user_album_update.tpl', 100, false),)), $this);
?><?php
SELanguage::_preload_multi(1000095,1000096,191,1000100,1000101,1000097,1000098,1000099,1000046,1000102,1000103,1000104,1000105,1000115,1000116,1000114,173);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<img src='./images/icons/album_image48.gif' border='0' class='icon_big'>
<div class='page_header'><?php echo SELanguage::_get(1000095); ?> <a href='<?php echo $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['user']->user_info['user_username'],$this->_tpl_vars['album_info']['album_id']); ?>
'><?php echo $this->_tpl_vars['album_info']['album_title']; ?>
</a></div>
<div>
  <?php echo sprintf(SELanguage::_get(1000096), $this->_tpl_vars['files_total'], $this->_tpl_vars['album_info']['album_views']); ?></b>
</div>

<br>

<?php if ($this->_tpl_vars['result'] != 0 && $this->_tpl_vars['files_total'] > 0): ?>
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='success'><img src='./images/success.gif' border='0' class='icon'> <?php echo SELanguage::_get(191); ?></td></tr>
  </table>
  <br>
<?php endif; 
 if ($this->_tpl_vars['files_total'] == 0): ?>
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='result'>
    <img src='./images/icons/bulb16.gif' border='0' class='icon'><?php echo SELanguage::_get(1000100); ?> <a href='user_album_upload.php?album_id=<?php echo $this->_tpl_vars['album_info']['album_id']; ?>
'><?php echo SELanguage::_get(1000101); ?></a>
  </td></tr></table>
  <br>
<?php endif; ?>

<div>
  <div class='button' style='float: left;'>
    <img src='./images/icons/back16.gif' border='0' class='button'><a href='user_album.php'><?php echo SELanguage::_get(1000097); ?></a>
  </div>
  <div class='button' style='float: left; padding-left: 20px;'>
    <img src='./images/icons/album_addimages16.gif' border='0' class='button'><a href='user_album_upload.php?album_id=<?php echo $this->_tpl_vars['album_info']['album_id']; ?>
'><?php echo SELanguage::_get(1000098); ?></a>
  </div>
  <div class='button' style='float: left; padding-left: 20px;'>
    <img src='./images/icons/album_edit16.gif' border='0' class='button'><a href='user_album_edit.php?album_id=<?php echo $this->_tpl_vars['album_info']['album_id']; ?>
'><?php echo SELanguage::_get(1000099); ?></a>
  </div>
  <div style='clear: both; height: 0px;'></div>
</div>

<?php if ($this->_tpl_vars['files_total'] > 0): ?>
  <form action='user_album_update.php' method='POST'>
  <?php unset($this->_sections['files_loop']);
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

        <?php if ($this->_sections['files_loop']['first']): 
 $this->assign('first_media_id', $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']); 
 endif; ?>

        <?php $this->assign('has_thumb', '0'); ?>

    <?php if ($this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'jpeg' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'jpg' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'gif' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'png' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'bmp'): ?>
      <?php $this->assign('file_dir', $this->_tpl_vars['url']->url_userdir($this->_tpl_vars['user']->user_info['user_id'])); ?>
      <?php $this->assign('file_src', ($this->_tpl_vars['file_dir']).($this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id'])."_thumb.jpg"); ?>
      <?php $this->assign('has_thumb', '1'); ?>
        <?php elseif ($this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'mp3' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'mp4' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'wav'): ?>
      <?php $this->assign('file_src', './images/icons/audio_big.gif'); ?>
        <?php elseif ($this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'mpeg' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'mpg' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'mpa' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'avi' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'swf' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'mov' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'ram' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'rm'): ?>
      <?php $this->assign('file_src', './images/icons/video_big.gif'); ?>
        <?php else: ?>
      <?php $this->assign('file_src', './images/icons/file_big.gif'); ?>
    <?php endif; ?>

    <div class='album' style='width: 670px;' id='media_<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
'>
      <a name='<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
'></a>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td class='album_left'>
        <div class='album_photo'>
          <table cellpadding='0' cellspacing='0' width='200' height='200'>
          <tr><td><a href='<?php echo $this->_tpl_vars['url']->url_create('album_file',$this->_tpl_vars['user']->user_info['user_username'],$this->_tpl_vars['album_info']['album_id'],$this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']); ?>
'><img src='<?php echo $this->_tpl_vars['file_src']; ?>
' id='file_<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
' <?php if ($this->_tpl_vars['has_thumb'] == 1): ?>width='200' height='200' <?php endif; ?>border='0' style='vertical-align: middle;'></a></td></tr>
	  </table>
	</div>
      </td>
      <td class='album_right' width='100%'>
        <div>
          <?php echo SELanguage::_get(1000046); ?><br>
          <input type='text' name='media_title_<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
' class='text' size='35' maxlength='50' value='<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_title']; ?>
'>
        </div>
        <div style='margin-top: 10px;'>
          <?php echo SELanguage::_get(1000102); ?><br>
          <textarea name='media_desc_<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
' rows='3' cols='30' style='width: 400px'><?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_desc']; ?>
</textarea>
        </div>
        <div style='margin-top: 10px;'>
          <div style='float: left;'><input type='checkbox' name='delete[]' id='delete_media_<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
' value='<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
'></div>
          <div style='float: left; padding-top: 1px;'><label for='delete_media_<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
'><?php echo SELanguage::_get(1000103); ?></label></div>
          <div style='float: left; padding-left: 10px;'><input type='radio' name='album_cover' id='album_cover_<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
' value='<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
'<?php if ($this->_tpl_vars['album_info']['album_cover'] == $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']): ?> checked='checked'<?php endif; ?>></div>
          <div style='float: left; padding-top: 1px;'><label for='album_cover_<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
'><?php echo SELanguage::_get(1000104); ?></label></div>
	  <?php if ($this->_tpl_vars['albums_total'] != 0): ?>
            <div style='float: left; padding-left: 17px;'>
	      <?php echo SELanguage::_get(1000105); ?> 
	      <select name='media_album_id_<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
' class='album_moveto'>
	      <option value='<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_album_id']; ?>
'></option>
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
	        <option value='<?php echo $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']; ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 28, "...", true) : smarty_modifier_truncate($_tmp, 28, "...", true)); ?>
</option>
	      <?php endfor; endif; ?>
	      </select>
            </div>
	  <?php endif; ?>	
          <div style='clear: both; height: 0px;'></div>
          <?php if ($this->_sections['files_loop']['first'] != true || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'jpeg' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'jpg' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'gif' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'png' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'bmp'): ?>
	    <div class='album_options2'>
              <?php if ($this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'jpeg' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'jpg' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'gif' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'png' || $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_ext'] == 'bmp'): ?>
	        <div style='float: left; padding-right: 10px;'><a href='javascript:void(0);' onClick="$('ajaxframe').src='user_album_update.php?task=rotate&dir=cc&album_id=<?php echo $this->_tpl_vars['album_info']['album_id']; ?>
&media_id=<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
';this.blur();"><img src='./images/icons/album_rotate_left16.gif' border='0' class='button'><?php echo SELanguage::_get(1000115); ?></a></div>
	        <div style='float: left; padding-right: 10px;'><a href='javascript:void(0);' onClick="$('ajaxframe').src='user_album_update.php?task=rotate&dir=c&album_id=<?php echo $this->_tpl_vars['album_info']['album_id']; ?>
&media_id=<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
';this.blur();"><img src='./images/icons/album_rotate_right16.gif' border='0' class='button'><?php echo SELanguage::_get(1000116); ?></a></div>
	      <?php endif; ?>
	      <div style='float: left; padding-right: 10px;<?php if ($this->_sections['files_loop']['first']): ?>display: none;<?php endif; ?>' id='moveup_<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
'><a href='javascript:void(0);' onClick="$('ajaxframe').src='user_album_update.php?task=moveup&album_id=<?php echo $this->_tpl_vars['album_info']['album_id']; ?>
&media_id=<?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_id']; ?>
';"><img src='./images/icons/album_moveup16.gif' border='0' class='button'><?php echo SELanguage::_get(1000114); ?></a></div>
	      <div style='clear: both; height: 0px;'></div>
	    </div>
          <?php endif; ?>
        </div>
      </td>
      </tr>
      </table>
    </div>
  <?php endfor; endif; ?>

  <br>

  <table cellpadding='0' cellspacing='0'>
  <tr>
  <td>
    <input type='submit' class='button' value='<?php echo SELanguage::_get(173); ?>'>&nbsp;
    <input type='hidden' name='task' value='doupdate'>
    <input type='hidden' name='album_id' value='<?php echo $this->_tpl_vars['album_info']['album_id']; ?>
'>
    </form>
  </td>
  </tr>
  </table>

    <?php echo '
  <script type="text/javascript">
  <!-- 

    var first_id = \''; 
 echo $this->_tpl_vars['first_media_id']; 
 echo '\';
    function reorderMedia(id, prev_id) {
      if(prev_id == first_id) {
        $(\'moveup_\'+prev_id).style.display = \'block\';
        $(\'moveup_\'+id).style.display = \'none\';
        first_id = id;
      }    
      $(\'media_\'+id).inject(\'media_\'+prev_id, \'before\');
    }
  //-->
  </script>
  '; 
 endif; ?>
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