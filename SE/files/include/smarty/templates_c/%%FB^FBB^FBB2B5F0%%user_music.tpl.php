<?php /* Smarty version 2.6.14, created on 2010-06-02 16:45:24
         compiled from user_music.tpl */
?><?php
SELanguage::_preload_multi(4000042,4000044,4000088,4000072,4000047,4000001,4000038,4000046,4000048,153,187,746,747,4000049,155,4000039,175,39,4000051,4000052);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<img src='./images/icons/music_music48.gif' border='0' class='icon_big' style="margin-bottom: 15px;">
<div class='page_header'><?php echo SELanguage::_get(4000042); ?></div>
<div>
  <?php echo SELanguage::_get(4000044); ?><br />
  <?php echo sprintf(SELanguage::_get(4000088), $this->_tpl_vars['music_total']); ?><br />
  <?php echo sprintf(SELanguage::_get(4000072), $this->_tpl_vars['space_left']); ?>
</div>


<div style='margin-top: 20px;'>
  <div class='button' style='float: left;'>
    <a href='user_music_upload.php'><img src='./images/icons/plus16.gif' border='0' class='button'><?php echo SELanguage::_get(4000047); ?></a>
  </div>
  <div class='button' style='float: left; padding-left: 20px;'>
    <a href='user_music_settings.php'><img src='./images/icons/music_settings16.gif' border='0' class='button'><?php echo SELanguage::_get(4000001); ?></a>
  </div>
  <div style='clear: both; height: 0px;'></div>
</div>
<br />


<?php if ($this->_tpl_vars['musiclist']): ?>
  
  <div id="seMusicListContainer">
  
    <?php 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(4000038));
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
    
    <?php echo '
    <script type="text/javascript" src="./include/js/class_music.js"></script>
    <script type="text/javascript">
      
      SocialEngine.Music = new SocialEngineAPI.Music();
      SocialEngine.RegisterModule(SocialEngine.Music);
      
    </script>
    '; ?>

    
    
    <form action='user_music.php' method='post'>
        <ul class="seMusicHeader" style='width: 550px;'>
      <li>
        <table cellpadding='0' cellspacing='0' class="seMusicRowInnerTable"><tr>
          <td class="seMusicMove">
          </td>
          <td class="seMusicDeleteCheckbox">
          </td>
          <td class="seMusicRowButton">
          </td>
          <td class='seMusicRowTitle'>
            <?php echo SELanguage::_get(4000046); ?>
          </td>
          <td class="seMusicRowFilesize" align='center'>
            <?php echo SELanguage::_get(4000048); ?>
          </td>
          <td class="seMusicRowActions" align='right'>
            <?php echo SELanguage::_get(153); ?>
          </td>
        </tr></table>
      </li>
    </ul>
    
    
    <ul class="userMusicList" style='width: 550px;'>
    
            <?php $this->assign('media_dir', $this->_tpl_vars['url']->url_userdir($this->_tpl_vars['user']->user_info['user_id'])); ?>
      <?php unset($this->_sections['music_loop']);
$this->_sections['music_loop']['name'] = 'music_loop';
$this->_sections['music_loop']['loop'] = is_array($_loop=$this->_tpl_vars['musiclist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['music_loop']['show'] = true;
$this->_sections['music_loop']['max'] = $this->_sections['music_loop']['loop'];
$this->_sections['music_loop']['step'] = 1;
$this->_sections['music_loop']['start'] = $this->_sections['music_loop']['step'] > 0 ? 0 : $this->_sections['music_loop']['loop']-1;
if ($this->_sections['music_loop']['show']) {
    $this->_sections['music_loop']['total'] = $this->_sections['music_loop']['loop'];
    if ($this->_sections['music_loop']['total'] == 0)
        $this->_sections['music_loop']['show'] = false;
} else
    $this->_sections['music_loop']['total'] = 0;
if ($this->_sections['music_loop']['show']):

            for ($this->_sections['music_loop']['index'] = $this->_sections['music_loop']['start'], $this->_sections['music_loop']['iteration'] = 1;
                 $this->_sections['music_loop']['iteration'] <= $this->_sections['music_loop']['total'];
                 $this->_sections['music_loop']['index'] += $this->_sections['music_loop']['step'], $this->_sections['music_loop']['iteration']++):
$this->_sections['music_loop']['rownum'] = $this->_sections['music_loop']['iteration'];
$this->_sections['music_loop']['index_prev'] = $this->_sections['music_loop']['index'] - $this->_sections['music_loop']['step'];
$this->_sections['music_loop']['index_next'] = $this->_sections['music_loop']['index'] + $this->_sections['music_loop']['step'];
$this->_sections['music_loop']['first']      = ($this->_sections['music_loop']['iteration'] == 1);
$this->_sections['music_loop']['last']       = ($this->_sections['music_loop']['iteration'] == $this->_sections['music_loop']['total']);
?>
      <?php $this->assign('media_path', ($this->_tpl_vars['media_dir']).($this->_tpl_vars['musiclist'][$this->_sections['music_loop']['index']]['music_id']).".".($this->_tpl_vars['musiclist'][$this->_sections['music_loop']['index']]['music_ext'])); ?>
      
      <li id="seMusic_<?php echo $this->_tpl_vars['musiclist'][$this->_sections['music_loop']['index']]['music_id']; ?>
" class="seMusicRow">
        <table cellpadding='0' cellspacing='0' class="seMusicRowInnerTable"><tr>
          <td class="seMusicMove">
            <img src="./images/music_move.png" class="seMusicMoveHandle" />
          </td>
          
          <td class="seMusicDeleteCheckbox">
            <input type='checkbox' name='delete_music_<?php echo $this->_tpl_vars['musiclist'][$this->_sections['music_loop']['index']]['music_id']; ?>
' value='1' />
          </td>
          
          <td class="seMusicRowButton">
            <object width="17" height="17" data="./images/music_button.swf?song_url=<?php echo $this->_tpl_vars['media_path']; ?>
" type="application/x-shockwave-flash">
              <param value="./images/music_button.swf?song_url=<?php echo $this->_tpl_vars['media_path']; ?>
" name="movie" />
              <img width="17" height="17" alt="" src="noflash.gif" />
            </object>
          </td>
          
          <td class='seMusicRowTitle music_title' id="seMusicTitle_<?php echo $this->_tpl_vars['musiclist'][$this->_sections['music_loop']['index']]['music_id']; ?>
">
            <span class="seMusicID" style="display:none;"><?php echo $this->_tpl_vars['musiclist'][$this->_sections['music_loop']['index']]['music_id']; ?>
</span>
            <span class="seMusicTitle"><?php echo $this->_tpl_vars['musiclist'][$this->_sections['music_loop']['index']]['music_title']; ?>
</span>
            <span class="seMusicTitleEditor" style="display:none;"><input type="text" class="text" style="width: 250px;"/></span>
            <span class="seMusicTitleEdit">&nbsp;(<a href="javascript:void(0);" onclick="SocialEngine.Music.editMusicTitle(<?php echo $this->_tpl_vars['musiclist'][$this->_sections['music_loop']['index']]['music_id']; ?>
);"><?php echo SELanguage::_get(187); ?></a>)</span>
            <span class="seMusicTitleSave" style="display:none;">&nbsp;(<a href="javascript:void(0);" onclick="SocialEngine.Music.saveMusicTitle(<?php echo $this->_tpl_vars['musiclist'][$this->_sections['music_loop']['index']]['music_id']; ?>
);"><?php echo SELanguage::_get(746); ?></a>)</span>
            <span class="seMusicTitleCancel" style="display:none;">&nbsp;(<a href="javascript:void(0);" onclick="SocialEngine.Music.cancelMusicTitle(<?php echo $this->_tpl_vars['musiclist'][$this->_sections['music_loop']['index']]['music_id']; ?>
);"><?php echo SELanguage::_get(747); ?></a>)</span>
          </td>
        
          <td class="seMusicRowFilesize" align='center'>
            <?php echo sprintf(SELanguage::_get(4000049), $this->_tpl_vars['musiclist'][$this->_sections['music_loop']['index']]['music_filesize']); ?>
          </td>
        
          <td class="seMusicRowActions" align='right' nowrap='nowrap'>
                        <span class="seMusicDelete"><a href="javascript:void(0);" onclick="SocialEngine.Music.deleteMusic(<?php echo $this->_tpl_vars['musiclist'][$this->_sections['music_loop']['index']]['music_id']; ?>
);"><?php echo SELanguage::_get(155); ?></a>&nbsp;</span>
          </td>
        
        </tr></table>
      </li>
      <?php endfor; endif; ?>
      
    </ul>
    <br />
    
    
        <div style='display: none;' id='confirmmusicdelete'>
      <div style='margin-top: 10px;'>
        <?php echo SELanguage::_get(4000039); ?>
      </div>
      <br />
      <?php $this->assign('langBlockTemp', SE_Language::_get(175));


  ?><input type='button' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' onClick='parent.TB_remove();parent.SocialEngine.Music.deleteMusicConfirm(parent.SocialEngine.Music.currentConfirmDeleteID);' /><?php 

  ?>
      <?php $this->assign('langBlockTemp', SE_Language::_get(39));


  ?><input type='button' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' onClick='parent.TB_remove();' /><?php 

  ?>
    </div>
    
    
    <?php $this->assign('langBlockTemp', SE_Language::_get(4000051));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' /><?php 

  ?>
    <input type='hidden' name='task' value='dodelete' />
    </form>
  
  </div>
  
<?php endif; ?>


<div id="musicnullmessage"<?php if ($this->_tpl_vars['musiclist']): ?> style="display: none;"<?php endif; ?>>
  <table cellpadding='0' cellspacing='0'><tr>
    <td class='result'><img src='./images/icons/bulb16.gif' border='0' class='icon'><?php echo SELanguage::_get(4000052); ?></td>
  </tr></table>
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