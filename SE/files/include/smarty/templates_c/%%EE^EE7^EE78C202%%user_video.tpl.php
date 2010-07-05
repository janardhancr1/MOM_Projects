<?php /* Smarty version 2.6.14, created on 2010-06-24 16:21:13
         compiled from user_video.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'user_video.tpl', 61, false),array('modifier', 'replace', 'user_video.tpl', 89, false),array('modifier', 'count', 'user_video.tpl', 223, false),array('function', 'cycle', 'user_video.tpl', 114, false),)), $this);
?><?php
SELanguage::_preload_multi(5500025,5500103,5500106,5500186,589,5500203,5500204,5500202,5500043,5500107,5500108,5500109,5500145,5500083,5500146,175,39,5500082,5500078,5500079,5500014,5500015,5500016,5500017,5500018,173);
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
<img src='./images/icons/video_video48.gif' border='0' class='icon_big' />
<div class='page_header'><?php echo SELanguage::_get(5500025); ?></div>
<div><?php echo sprintf(SELanguage::_get(5500103), $this->_tpl_vars['videos_total']); ?></div>

</td>
<td valign='top' align='right'>

  <table cellpadding='0' cellspacing='0' width='150'>
  <tr><td class='button' nowrap='nowrap'><a href='browse_videos.php'><img src='./images/icons/back16.gif' border='0' class='button'>Back to Videos</a></td></tr>
  </table>

</td>
</tr>
</table>


<?php if ($this->_tpl_vars['videos_total'] < $this->_tpl_vars['user']->level_info['level_video_maxnum']): ?>
  <div style='margin-top: 20px;'>
    <?php if ($this->_tpl_vars['user']->level_info['level_video_allow'] && ! empty ( $this->_tpl_vars['setting']['setting_video_ffmpeg_path'] )): ?>
    <div class='button' style='float: left; margin-right:20px;'>
      <a href='user_video_upload.php?task=create'><img src='./images/icons/plus16.gif' border='0' class='button' /><?php echo SELanguage::_get(5500106); ?></a>
    </div>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['user']->level_info['level_youtube_allow']): ?>
    <div class='button' style='float:left;'>
      <a href='user_video_upload.php?task=youtube'><img src='./images/icons/youtube.gif' border='0' class='button' /><?php echo SELanguage::_get(5500186); ?></a>
    </div>
    <?php endif; ?>
    <div style='clear: both; height: 0px;'></div>
  </div>
<?php endif; ?>

<br />

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
  
  <div class='videoTab'>
    <table cellpadding='0' cellspacing='0'>
    <tr>
    <td valign='top'>
      <div class='video_photo'>
        <a href='<?php echo $this->_tpl_vars['url']->url_create('video',$this->_tpl_vars['user']->user_info['user_username'],$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']); ?>
'>
          <img src='<?php if ($this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_thumb']): 
 echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_dir']; 
 echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']; ?>
_thumb.jpg<?php else: ?>./images/video_placeholder.gif<?php endif; ?>' border='0' width='<?php echo $this->_tpl_vars['setting']['setting_video_thumb_width']; ?>
' height='<?php echo $this->_tpl_vars['setting']['setting_video_thumb_height']; ?>
' />
        </a>
      </div>
    </td>
    <td valign='top' style='padding-left: 7px; width: 300px;'>
      <div class='video_title'><a href='<?php echo $this->_tpl_vars['url']->url_create('video',$this->_tpl_vars['user']->user_info['user_username'],$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['video_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, '...', true) : smarty_modifier_truncate($_tmp, 30, '...', true)); ?>
</a></div>
      
            <?php if ($this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_is_converted'] == -1): ?>
        <div style="padding-top:2px;padding-left:15px;font-weight:bold;color:#ee3333;"><?php echo SELanguage::_get(5500203); ?></div>
      
            <?php elseif (! $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_uploaded']): ?>
        <div style="padding-top:2px;padding-left:15px;font-weight:bold;color:#ee3333;"><?php echo SELanguage::_get(5500204); ?></div>
      
            <?php elseif (! $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_is_converted']): ?>
        <div style="padding-top:2px;padding-left:15px;font-weight:bold;"><?php echo SELanguage::_get(5500202); ?></div>
      
            <?php else: ?>
        <div style="padding-top:2px;">
          <?php echo sprintf(SELanguage::_get(5500043), $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_views'], $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['total_comments']); ?> - 
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
?><img src='./images/icons/video_rating_full_small.gif' border='0' /><?php endfor; endif; ?>
          <?php if ($this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_rating_part']): ?><img src='./images/icons/video_rating_part_small.gif' border='0' /><?php endif; ?>
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
?><img src='./images/icons/video_rating_none_small.gif' border='0' /><?php endfor; endif; ?>
        </div>
      <?php endif; ?>
      
      <div class='video_options'>
                <?php if ($this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_is_converted'] == 1 && $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_uploaded']): ?>
        <div style='float: left; padding-right: 15px;'>
          <a href='javascript:void(0);' onClick="editVideo('<?php echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']; ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_title'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&#039;", "\&#039;") : smarty_modifier_replace($_tmp, "&#039;", "\&#039;")); ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_desc'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&#039;", "\&#039;") : smarty_modifier_replace($_tmp, "&#039;", "\&#039;")); ?>
', '<?php echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_search']; ?>
', '<?php echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_privacy']; ?>
', '<?php echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_comments']; ?>
');"><img src='./images/icons/video_edit16.gif' border='0' class='button' /><?php echo SELanguage::_get(5500107); ?></a>
        </div>
        <?php endif; ?>
        
                <?php if ($this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_is_converted'] == -1 || ! $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_uploaded']): ?>
        <div style='float: left; padding-right: 15px;'>
          <a href='user_video_upload.php?task=upload&video_id=<?php echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']; ?>
'><img src='./images/icons/back16.gif' border='0' class='button' />Retry Upload</a>
        </div>
        <?php endif; ?>
        
                <?php if (! $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_uploaded'] || $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_is_converted'] != 0): ?>
        <div style='float: left; padding-right: 15px;'>
          <a href='javascript:void(0);' onClick="confirmDelete('<?php echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']; ?>
');"><img src='./images/icons/video_delete16.gif' border='0' class='button' /><?php echo SELanguage::_get(5500108); ?></a>
        </div>
        <?php endif; ?>
        
        <div style='clear: both; height: 0px;'></div>
      </div>
    </td>
    </tr>
    </table>
  </div>    
  
  <?php echo smarty_function_cycle(array('values' => ",<div style='clear: both; height: 0px;'></div>"), $this);
 endfor; endif; ?>
<div style='clear: both; height: 0px;'></div>


<?php if ($this->_tpl_vars['videos_total'] == 0): ?>
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='result'>
    <img src='./images/icons/bulb16.gif' border='0' class='icon' /><?php echo SELanguage::_get(5500109); ?></div>
  </td></tr>
  </table>
<?php endif; 
 echo '
<script type="text/javascript">
<!-- 
var video_id = 0;
function confirmDelete(id)
{
  video_id = id;
  TB_show(\''; 
 echo SELanguage::_get(5500145); 
 echo '\', \'#TB_inline?height=100&width=300&inlineId=confirmdelete\', \'\', \'../images/trans.gif\');
}

function deleteVideo()
{
  var request = new Request({
    \'url\' : \'user_video.php\',
    \'method\' : \'post\',
    \'data\' : {
      \'task\' : \'delete\',
      \'video_id\' : video_id
    },
    onComplete : function()
    {
      window.location = \'user_video.php\';
    }
  }).send();
}


function editVideo(id, title, desc, search, privacy, comments)
{
  $(\'video_id\').value = id;  
  $(\'video_title\').defaultValue = title;  
  $(\'video_title\').value = title;  
  $(\'video_desc\').defaultValue = desc;  
  $(\'video_desc\').value = desc;
  if( $(\'video_search_\'+search) )
  {
    $(\'video_search_\'+search).checked = true;
    $(\'video_search_\'+search).defaultChecked = true;
  }
  if( $(\'privacy_\'+privacy) )
  {
    $(\'privacy_\'+privacy).checked = true;
    $(\'privacy_\'+privacy).defaultChecked = true;
  }
  if( $(\'comments_\'+comments) )
  {
    $(\'comments_\'+comments).checked = true;
    $(\'comments_\'+comments).defaultChecked = true;
  }
  TB_show(\''; 
 echo SELanguage::_get(5500083); 
 echo '\', \'#TB_inline?height=450&width=450&inlineId=editvideo\', \'\', \'../images/trans.gif\');
}

//-->
</script>
'; ?>


<div style='display: none;' id='confirmdelete'>
  <div style='margin-top: 10px;'>
    <?php echo SELanguage::_get(5500146); ?>
  </div>
  <br>
  <input type='button' class='button' value='<?php echo SELanguage::_get(175); ?>' onClick='parent.TB_remove();parent.deleteVideo();'> <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='parent.TB_remove();'>
</div>


<div style='display: none;' id='editvideo'>
  <form action='user_video.php' name='editForm' method='post' target='_parent'>
  <div style='margin-top: 10px;'><?php echo SELanguage::_get(5500082); ?></div>
  <br />

  <b><?php echo SELanguage::_get(5500078); ?></b><br>
  <input name='video_title' id='video_title' type='text' class='text' maxlength='50' size='30' value=''>
  <br />
  <br />

  <b><?php echo SELanguage::_get(5500079); ?></b><br>
  <textarea name='video_desc' id='video_desc' rows='6' cols='50'></textarea>
  <br />

    <?php if ($this->_tpl_vars['user']->level_info['level_video_search'] == 1): ?>
    <br>
    <b><?php echo SELanguage::_get(5500014); ?></b><br>
    <table cellpadding='0' cellspacing='0'>
      <tr><td><label><input type='radio' name='video_search' id='video_search_1' value='1' /> <?php echo SELanguage::_get(5500015); ?></label></td></tr>
      <tr><td><label><input type='radio' name='video_search' id='video_search_0' value='0' /> <?php echo SELanguage::_get(5500016); ?></label></td></tr>
    </table>
  <?php endif; ?>

    <?php if (count($this->_tpl_vars['privacy_options']) > 1): ?>
    <br />
    <b><?php echo SELanguage::_get(5500017); ?></b><br>
    <table cellpadding='0' cellspacing='0'>
    <?php $_from = $this->_tpl_vars['privacy_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['privacy_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['privacy_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['privacy_loop']['iteration']++;
?>
      <tr>
      <td><label><input type='radio' name='video_privacy' id='privacy_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
' /> <?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
  <?php endif; ?>

    <?php if (count($this->_tpl_vars['comment_options']) > 1): ?>
    <br />
    <b><?php echo SELanguage::_get(5500018); ?></b><br>
    <table cellpadding='0' cellspacing='0'>
    <?php $_from = $this->_tpl_vars['comment_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['comment_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['comment_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['comment_loop']['iteration']++;
?>
      <tr>
      <td><label><input type='radio' name='video_comments' id='comments_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
' /> <?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
  <?php endif; ?>

  <br>
  <input type='submit' class='button' value='<?php echo SELanguage::_get(173); ?>' />
  <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='parent.TB_remove();' />
  <input type='hidden' name='task' value='edit' />
  <input type='hidden' name='video_id' id='video_id' value='0' />
  </form>
  <br />
  <br />
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