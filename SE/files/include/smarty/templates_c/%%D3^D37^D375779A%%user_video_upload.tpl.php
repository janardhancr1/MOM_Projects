<?php /* Smarty version 2.6.14, created on 2010-06-01 04:21:51
         compiled from user_video_upload.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'user_video_upload.tpl', 112, false),)), $this);
?><?php
SELanguage::_preload_multi(5500186,5500104,5500197,5500004,5500111,5500191,5500192,5500078,5500079,5500190,5500196,5500014,5500015,5500016,5500017,5500018,5500158,1000090,1000091,5500173);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<table cellpadding='0' cellspacing='0' style="width:100%;">
  <tr>
    <td valign='top'>
      <img src='./images/icons/video_video48.gif' border='0' class='icon_big' />
      
      <div class='page_header'><?php if ($this->_tpl_vars['task'] == 'youtube'): 
 echo SELanguage::_get(5500186); 
 else: 
 echo SELanguage::_get(5500104); 
 endif; ?></div>
      <div><?php if ($this->_tpl_vars['task'] == 'youtube'): 
 echo SELanguage::_get(5500197); 
 else: 
 echo SELanguage::_get(5500004); 
 endif; ?></div>
    </td>
    <td valign='top'>
      <table cellpadding='0' cellspacing='0' align="right">
        <tr>
          <td class='button' nowrap='nowrap'>
            <a href='user_video.php'>
              <img src='./images/icons/back16.gif' border='0' class='button' />
              <?php echo SELanguage::_get(5500111); ?>
            </a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br />


<?php if ($this->_tpl_vars['task'] == 'youtube' && $this->_tpl_vars['user']->level_info['level_video_allow'] && ! empty ( $this->_tpl_vars['setting']['setting_video_ffmpeg_path'] )): ?>
  <table cellpadding='0' cellspacing='0'>
    <tr>
      <td>
        <div><img src="./images/icons/bulb16.gif" class='button' /><a href="user_video_upload.php?task=create"><?php echo SELanguage::_get(5500191); ?></a></div>
      </td>
    </tr>
  </table>
  <br />
<?php endif; 
 if ($this->_tpl_vars['task'] == 'create' && $this->_tpl_vars['user']->level_info['level_youtube_allow']): ?>
  <table cellpadding='0' cellspacing='0'>
    <tr>
      <td>
        <div><img src="./images/icons/bulb16.gif" class='button' /><a href="user_video_upload.php?task=youtube"><?php echo SELanguage::_get(5500192); ?></a></div>
      </td>
    </tr>
  </table>
  <br />
<?php endif; 
 if ($this->_tpl_vars['is_error'] != 0): ?>
  <table cellpadding='0' cellspacing='0'>
    <tr>
      <td class='result'>
        <div class='error'><img src='./images/error.gif' border='0' class='icon' /> <?php echo SELanguage::_get($this->_tpl_vars['is_error']); ?></div>
      </td>
    </tr>
  </table>
  <br />
<?php endif; 
 if ($this->_tpl_vars['task'] == 'youtube' || $this->_tpl_vars['task'] == 'create'): ?>

  <form name='uploadForm' action='user_video_upload.php?task=<?php if ($this->_tpl_vars['task'] == 'youtube'): ?>doembed<?php else: ?>docreate<?php endif; ?>' method='post' id='uploadForm'>

  <b><?php echo SELanguage::_get(5500078); ?></b><br />
  <input name='video_title' type='text' class='text' maxlength='50' size='30' value='<?php echo $this->_tpl_vars['video']->video_info['video_title']; ?>
'>
  <br />
  <br />
  
  
  <b><?php echo SELanguage::_get(5500079); ?></b><br>
  <textarea name='video_desc' rows='6' cols='50'><?php echo $this->_tpl_vars['video']->video_info['video_desc']; ?>
</textarea>
  <br />
  <br />
  

  <?php if ($this->_tpl_vars['task'] == 'youtube'): ?>
  <b><?php echo SELanguage::_get(5500190); ?></b><br />
  <?php echo SELanguage::_get(5500196); ?><br />
  <input name='video_url' id='video_url' type='text' class='text' value='<?php echo $this->_tpl_vars['video_last_url']; ?>
' size='30' >
  <br />
  <br />
  <?php endif; ?>
  
  
    <?php if ($this->_tpl_vars['user']->level_info['level_video_search'] == 1): ?>
    <b><?php echo SELanguage::_get(5500014); ?></b><br>
    <table cellpadding='0' cellspacing='0'>
      <tr>
        <td><input type='radio' name='video_search' id='video_search_1' value='1'<?php if ($this->_tpl_vars['video']->video_info['video_search']): ?> checked='checked'<?php endif; ?>></td>
        <td><label for='video_search_1'><?php echo SELanguage::_get(5500015); ?></label></td>
      </tr>
      <tr>
        <td><input type='radio' name='video_search' id='video_search_0' value='0'<?php if (! $this->_tpl_vars['video']->video_info['video_search']): ?> checked='checked'<?php endif; ?>></td>
        <td><label for='video_search_0'><?php echo SELanguage::_get(5500016); ?></label></td>
      </tr>
    </table>
    <br />
  <?php endif; ?>

    <?php if (count($this->_tpl_vars['privacy_options']) > 1): ?>
    <b><?php echo SELanguage::_get(5500017); ?></b><br>
    <table cellpadding='0' cellspacing='0'>
      <?php $_from = $this->_tpl_vars['privacy_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['privacy_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['privacy_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['privacy_loop']['iteration']++;
?>
      <tr>
        <td><input type='radio' name='video_privacy' id='privacy_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['video']->video_info['video_privacy'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
        <td><label for='privacy_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
      </tr>
      <?php endforeach; endif; unset($_from); ?>
    </table>
    <br />
  <?php endif; ?>

    <?php if (count($this->_tpl_vars['comment_options']) > 1): ?>
    <b><?php echo SELanguage::_get(5500018); ?></b><br>
    <table cellpadding='0' cellspacing='0'>
    <?php $_from = $this->_tpl_vars['comment_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['comment_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['comment_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['comment_loop']['iteration']++;
?>
      <tr>
      <td><input type='radio' name='video_comments' id='comments_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['video']->video_info['video_comments'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
      <td><label for='comments_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
    <br />
  <?php endif; ?>
  
  <?php if ($this->_tpl_vars['task'] == 'youtube'): ?>
  <input type='hidden' name='video_type' value='1' />
  <input type='submit' class='button' name='submit' value='<?php echo SELanguage::_get(5500186); ?>' id='fallback_submit' />&nbsp;&nbsp;
  <?php else: ?>
  <input type='hidden' name='video_type' value='0' />
  <input type='submit' class='button' name='submit' value='<?php echo SELanguage::_get(5500158); ?>' id='fallback_submit' />&nbsp;&nbsp;
  <?php endif; ?>
  
  </form>

<?php endif; 
 if ($this->_tpl_vars['task'] == 'upload'): ?>
  <div id="div_upload">
  <?php if (! empty ( $this->_tpl_vars['allowed_exts'] )): 
 echo sprintf(SELanguage::_get(1000090), $this->_tpl_vars['allowed_exts']); ?><br /><?php endif; ?>
  <?php echo sprintf(SELanguage::_get(1000091), $this->_tpl_vars['max_filesize']); ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'user_upload.tpl', 'smarty_include_vars' => array('action' => 'user_video_upload.php','session_id' => $this->_tpl_vars['session_id'],'upload_token' => $this->_tpl_vars['upload_token'],'show_uploader' => $this->_tpl_vars['show_uploader'],'inputs' => $this->_tpl_vars['inputs'],'file_result' => $this->_tpl_vars['file_result'],'max_files' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  </div>
<?php endif; 
 if ($this->_tpl_vars['task'] == 'complete'): ?>
  <table cellpadding='0' cellspacing='0'>
    <tr>
      <td class='result'>
        <div class='success' style='text-align: left;'> 
          <?php echo SELanguage::_get(5500173); ?>
        </div>
      </td>
    </tr>
  </table>
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