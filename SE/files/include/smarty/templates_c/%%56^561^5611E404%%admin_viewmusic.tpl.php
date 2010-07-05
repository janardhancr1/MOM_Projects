<?php /* Smarty version 2.6.14, created on 2010-03-28 07:43:23
         compiled from admin_viewmusic.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin_viewmusic.tpl', 154, false),)), $this);
?><?php
SELanguage::_preload_multi(4000031,4000032,4000033,4000034,1002,4000038,4000039,39,4000037,4000035,4000036,87,88,153,155,788,175);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h2><?php echo SELanguage::_get(4000031); ?></h2>
<?php echo SELanguage::_get(4000032); ?>
<br />
<br />

<form action='admin_viewmusic.php' method='POST'>
<table cellpadding='0' cellspacing='0' width='400' align='center'>
  <tr>
    <td align='center'>
      <div class='box'>
        <table cellpadding='0' cellspacing='0' align='center'>
          <tr>
            <td>
              <?php echo SELanguage::_get(4000033); ?>
              <br />
              <input type='text' class='text' name='f_title' value='<?php echo $this->_tpl_vars['f_title']; ?>
' size='15' maxlength='100' />
              &nbsp;
            </td>
            <td>
              <?php echo SELanguage::_get(4000034); ?>
              <br>
              <input type='text' class='text' name='f_owner' value='<?php echo $this->_tpl_vars['f_owner']; ?>
' size='15' maxlength='50' />
              &nbsp;
            </td>
            <td>
              &nbsp;
              <?php $this->assign('langBlockTemp', SE_Language::_get(1002));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' /><?php 

  ?>
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
</table>
<input type='hidden' name='s' value='<?php echo $this->_tpl_vars['s']; ?>
' />
</form>
<br />


<?php if ($this->_tpl_vars['task'] == 'delete'): ?>
  
  <table cellpadding='0' cellspacing='0' width='100%'><tr><td class='page'>
    
    <img src='../images/icons/music_music48.gif' border='0' class='icon_big'>
    <div class='page_header'><?php echo SELanguage::_get(4000038); ?></div>
    <div><?php echo SELanguage::_get(4000039); ?></div>
    <br />
    
    <table cellpadding='0' cellspacing='0'>
      <tr>
        <td>
          <form action='admin_viewmusic.php' method='post'>
          <?php $this->assign('langBlockTemp', SE_Language::_get(4000038));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' />&nbsp;<?php 

  ?>
          <input type='hidden' name='task' value='dodelete' />
          <input type='hidden' name='music_id' value='<?php echo $this->_tpl_vars['music_id']; ?>
' />
          <input type='hidden' name='owner' value='<?php echo $this->_tpl_vars['owner']; ?>
' />
          </form>
        </td>
        <td>
          <form action='admin_viewmusic.php' method='get'>
          <?php $this->assign('langBlockTemp', SE_Language::_get(39));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' /><?php 

  ?>
          </form>
        </td>
      </tr>
    </table>
    
  </td>
  </tr>
  </table>


<?php elseif ($this->_tpl_vars['total_music'] == 0): ?>

  <table cellpadding='0' cellspacing='0' width='400' align='center'><tr><td align='center'>
    <div class='box' style='width: 300px;'><b><?php echo SELanguage::_get(4000037); ?></b></div>
  </td></tr></table>
  <br />


<?php else: ?>

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
  <script type="text/javascript" src="../include/js/class_music.js"></script>
  <script type="text/javascript">
    SocialEngine.Music = new SocialEngineAPI.Music();
    SocialEngine.Music.options.ajaxURL = \'admin_viewmusic.php\';
    SocialEngine.RegisterModule(SocialEngine.Music);
  </script>
  '; ?>

  
  
    <?php echo '
  <script language=\'JavaScript\'> 
  <!---
  var checkboxcount = 1;
  function doCheckAll() {
    if(checkboxcount == 0) {
      with (document.items) {
      for (var i=0; i < elements.length; i++) {
      if (elements[i].type == \'checkbox\') {
      elements[i].checked = false;
      }}
      checkboxcount = checkboxcount + 1;
      }
    } else
      with (document.items) {
      for (var i=0; i < elements.length; i++) {
      if (elements[i].type == \'checkbox\') {
      elements[i].checked = true;
      }}
      checkboxcount = checkboxcount - 1;
      }
  }
  // -->
  </script>
  '; ?>


  <div class='pages'>
    <?php echo sprintf(SELanguage::_get(4000035), $this->_tpl_vars['total_music']); ?>
    &nbsp;|&nbsp;
    <?php echo SELanguage::_get(4000036); ?>
    <?php unset($this->_sections['page_loop']);
$this->_sections['page_loop']['name'] = 'page_loop';
$this->_sections['page_loop']['loop'] = is_array($_loop=$this->_tpl_vars['pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['page_loop']['show'] = true;
$this->_sections['page_loop']['max'] = $this->_sections['page_loop']['loop'];
$this->_sections['page_loop']['step'] = 1;
$this->_sections['page_loop']['start'] = $this->_sections['page_loop']['step'] > 0 ? 0 : $this->_sections['page_loop']['loop']-1;
if ($this->_sections['page_loop']['show']) {
    $this->_sections['page_loop']['total'] = $this->_sections['page_loop']['loop'];
    if ($this->_sections['page_loop']['total'] == 0)
        $this->_sections['page_loop']['show'] = false;
} else
    $this->_sections['page_loop']['total'] = 0;
if ($this->_sections['page_loop']['show']):

            for ($this->_sections['page_loop']['index'] = $this->_sections['page_loop']['start'], $this->_sections['page_loop']['iteration'] = 1;
                 $this->_sections['page_loop']['iteration'] <= $this->_sections['page_loop']['total'];
                 $this->_sections['page_loop']['index'] += $this->_sections['page_loop']['step'], $this->_sections['page_loop']['iteration']++):
$this->_sections['page_loop']['rownum'] = $this->_sections['page_loop']['iteration'];
$this->_sections['page_loop']['index_prev'] = $this->_sections['page_loop']['index'] - $this->_sections['page_loop']['step'];
$this->_sections['page_loop']['index_next'] = $this->_sections['page_loop']['index'] + $this->_sections['page_loop']['step'];
$this->_sections['page_loop']['first']      = ($this->_sections['page_loop']['iteration'] == 1);
$this->_sections['page_loop']['last']       = ($this->_sections['page_loop']['iteration'] == $this->_sections['page_loop']['total']);
?>
      <?php if ($this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['link']): ?>
        <?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>

      <?php else: ?>
        <a href='admin_viewmusic.php?s=<?php echo $this->_tpl_vars['s']; ?>
&p=<?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>
</a>
      <?php endif; ?>
    <?php endfor; endif; ?>
  </div>
  
  <form action='admin_viewmusic.php' method='post' name='items'>
  <table cellpadding='0' cellspacing='0' class='list'>
    <tr>
      <td class='header' width='10'><input type='checkbox' name='select_all' onClick='javascript:doCheckAll()' /></td>
      <td class='header' width='10' style='padding-left: 0px;'><a class='header' href='admin_viewmusic.php?s=<?php echo $this->_tpl_vars['i']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(87); ?></a></td>
      <td class='header'><a class='header' href='admin_viewmusic.php?s=<?php echo $this->_tpl_vars['t']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(4000033); ?></a></td>
      <td class='header'><a class='header' href='admin_viewmusic.php?s=<?php echo $this->_tpl_vars['o']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(4000034); ?></a></td>
      <td class='header' width='100'><a class='header' href='admin_viewmusic.php?s=<?php echo $this->_tpl_vars['d']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(88); ?></a></td>
      <td class='header' width='100'><?php echo SELanguage::_get(153); ?></td>
    </tr>
    
    <?php unset($this->_sections['music_loop']);
$this->_sections['music_loop']['name'] = 'music_loop';
$this->_sections['music_loop']['loop'] = is_array($_loop=$this->_tpl_vars['entries']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <?php $this->assign('media_dir', $this->_tpl_vars['url']->url_userdir($this->_tpl_vars['entries'][$this->_sections['music_loop']['index']]['music_user_id'])); ?>
    <?php $this->assign('media_path', ".".($this->_tpl_vars['media_dir']).($this->_tpl_vars['entries'][$this->_sections['music_loop']['index']]['music_id']).".".($this->_tpl_vars['entries'][$this->_sections['music_loop']['index']]['music_ext'])); ?>
    <tr class='<?php echo smarty_function_cycle(array('values' => "background1,background2"), $this);?>
 seMusicRow' id="seMusic_<?php echo $this->_tpl_vars['entries'][$this->_sections['music_loop']['index']]['music_id']; ?>
">
      <td class='item' style='padding-right: 0px;'><input type='checkbox' name='delete_entry[]' value='<?php echo $this->_tpl_vars['entries'][$this->_sections['music_loop']['index']]['music_id']; ?>
'></td>
      <td class='item' style='padding-left: 0px;'><?php echo $this->_tpl_vars['entries'][$this->_sections['music_loop']['index']]['music_id']; ?>
</td>
      <td class='item'>
        <object width="17" height="17" data="../images/music_button.swf?song_url=<?php echo $this->_tpl_vars['media_path']; ?>
&autoload=false&" type="application/x-shockwave-flash">
        <param value="../images/music_button.swf?song_url=<?php echo $this->_tpl_vars['media_path']; ?>
" name="movie"/>
        <img width="17" height="17" alt="" src="noflash.gif"/>
        </object>
        <?php echo $this->_tpl_vars['entries'][$this->_sections['music_loop']['index']]['music_title']; ?>

      </td>
      <td class='item'><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['entries'][$this->_sections['music_loop']['index']]['music_uploader']->user_info['user_username']); ?>
' target='_blank'><?php echo $this->_tpl_vars['entries'][$this->_sections['music_loop']['index']]['music_uploader']->user_displayname; ?>
</a></td>
      <td class='item'><?php echo $this->_tpl_vars['datetime']->cdate($this->_tpl_vars['setting']['setting_dateformat'],$this->_tpl_vars['datetime']->timezone($this->_tpl_vars['entries'][$this->_sections['music_loop']['index']]['music_date'],$this->_tpl_vars['setting']['setting_timezone'])); ?>
</td>
      <td class='item'>
        [ <a href="javascript:void(0);" onclick="SocialEngine.Music.deleteMusic(<?php echo $this->_tpl_vars['entries'][$this->_sections['music_loop']['index']]['music_id']; ?>
);"><?php echo SELanguage::_get(155); ?></a> ]
              </td>
    </tr>
    <?php endfor; endif; ?>
    
  </table>
  <br />

  <table cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td>
        <?php $this->assign('langBlockTemp', SE_Language::_get(788));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' /><?php 

  ?>
      </td>
      <td align='right' valign='top'>
        <div class='pages2'>
          <?php echo sprintf(SELanguage::_get(4000035), $this->_tpl_vars['total_music']); ?>
          &nbsp;|&nbsp;
          <?php echo SELanguage::_get(4000036); ?>
          <?php unset($this->_sections['page_loop']);
$this->_sections['page_loop']['name'] = 'page_loop';
$this->_sections['page_loop']['loop'] = is_array($_loop=$this->_tpl_vars['pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['page_loop']['show'] = true;
$this->_sections['page_loop']['max'] = $this->_sections['page_loop']['loop'];
$this->_sections['page_loop']['step'] = 1;
$this->_sections['page_loop']['start'] = $this->_sections['page_loop']['step'] > 0 ? 0 : $this->_sections['page_loop']['loop']-1;
if ($this->_sections['page_loop']['show']) {
    $this->_sections['page_loop']['total'] = $this->_sections['page_loop']['loop'];
    if ($this->_sections['page_loop']['total'] == 0)
        $this->_sections['page_loop']['show'] = false;
} else
    $this->_sections['page_loop']['total'] = 0;
if ($this->_sections['page_loop']['show']):

            for ($this->_sections['page_loop']['index'] = $this->_sections['page_loop']['start'], $this->_sections['page_loop']['iteration'] = 1;
                 $this->_sections['page_loop']['iteration'] <= $this->_sections['page_loop']['total'];
                 $this->_sections['page_loop']['index'] += $this->_sections['page_loop']['step'], $this->_sections['page_loop']['iteration']++):
$this->_sections['page_loop']['rownum'] = $this->_sections['page_loop']['iteration'];
$this->_sections['page_loop']['index_prev'] = $this->_sections['page_loop']['index'] - $this->_sections['page_loop']['step'];
$this->_sections['page_loop']['index_next'] = $this->_sections['page_loop']['index'] + $this->_sections['page_loop']['step'];
$this->_sections['page_loop']['first']      = ($this->_sections['page_loop']['iteration'] == 1);
$this->_sections['page_loop']['last']       = ($this->_sections['page_loop']['iteration'] == $this->_sections['page_loop']['total']);
?>
            <?php if ($this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['link']): ?>
              <?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>

            <?php else: ?>
              <a href='admin_viewmusic.php?s=<?php echo $this->_tpl_vars['s']; ?>
&p=<?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>
</a>
            <?php endif; ?>
          <?php endfor; endif; ?>
        </div>
      </td>
    </tr>
  </table>
  
  <input type='hidden' name='task' value='delete_selected' />
  <input type='hidden' name='p' value='<?php echo $this->_tpl_vars['p']; ?>
' />
  <input type='hidden' name='s' value='<?php echo $this->_tpl_vars['s']; ?>
' />
  <input type='hidden' name='f_title' value='<?php echo $this->_tpl_vars['f_title']; ?>
' />
  <input type='hidden' name='f_owner' value='<?php echo $this->_tpl_vars['f_owner']; ?>
' />
  </form>
  
  
    <div style='display: none;' id='confirmmusicdelete'>
    <div style='margin-top: 10px;'>
      <?php echo SELanguage::_get(4000039); ?>
    </div>
    <br>
    <input type='button' class='button' value='<?php echo SELanguage::_get(175); ?>' onClick='parent.TB_remove();parent.SocialEngine.Music.deleteMusicConfirm(parent.SocialEngine.Music.currentConfirmDeleteID);'> <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='parent.TB_remove();'>
  </div>

<?php endif; 
 $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>