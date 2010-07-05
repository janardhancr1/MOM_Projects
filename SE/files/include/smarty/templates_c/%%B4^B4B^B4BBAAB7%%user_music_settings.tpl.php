<?php /* Smarty version 2.6.14, created on 2010-06-02 16:46:22
         compiled from user_music_settings.tpl */
?><?php
SELanguage::_preload_multi(4000054,4000055,4000069,191,4000056,4000057,4000058,4000059,4000060,4000061,4000062,173,39);
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
      
      <img src='./images/icons/music_music48.gif' border='0' class='icon_big'>
      <div class='page_header'><?php echo SELanguage::_get(4000054); ?></div>
      <div><?php echo SELanguage::_get(4000055); ?></div>
      
    </td>
    <td valign='top' align='right'>
      
      <table cellpadding='0' cellspacing='0' width='150'>
      <tr><td class='button' nowrap='nowrap'><a href='user_music.php'><img src='./images/icons/back16.gif' border='0' class='button'><?php echo SELanguage::_get(4000069); ?></a></td></tr>
      </table>
      
    </td>
  </tr>
</table>
<br />


<?php if ($this->_tpl_vars['task'] == 'dosave'): ?>
  <table cellpadding='0' cellspacing='0'><tr>
    <td class='success'><img src='./images/success.gif' border='0' class='icon'><?php echo SELanguage::_get(191); ?></td>
  </tr></table>
  <br />
<?php endif; ?>


<form action='user_music_settings.php' method='post'>

<div><b><?php echo SELanguage::_get(4000056); ?></b></div>
<table cellpadding='0' cellspacing='0'>
  <tr>
    <td><input type='radio' name='profile_autoplay' id='profile_autoplay1' value='1' <?php if ($this->_tpl_vars['profile_autoplay']): ?>checked<?php endif; ?>></td>
    <td><label for='profile_autoplay1'><?php echo SELanguage::_get(4000057); ?></label></td>
  </tr>
  <tr>
    <td><input type='radio' name='profile_autoplay' id='profile_autoplay0' value='0' <?php if (! $this->_tpl_vars['profile_autoplay']): ?>checked<?php endif; ?>></td>
    <td><label for='profile_autoplay0'><?php echo SELanguage::_get(4000058); ?></label></td>
  </tr>
</table>
<br />


<div><b><?php echo SELanguage::_get(4000059); ?></b></div>
<table cellpadding='0' cellspacing='0'>
  <tr>
    <td><input type='radio' name='site_autoplay' id='site_autoplay1' value='1' <?php if ($this->_tpl_vars['site_autoplay']): ?>checked<?php endif; ?>></td>
    <td><label for='site_autoplay1'><?php echo SELanguage::_get(4000060); ?></label></td>
  </tr>
  <tr>
    <td><input type='radio' name='site_autoplay' id='site_autoplay0' value='0' <?php if (! $this->_tpl_vars['site_autoplay']): ?>checked<?php endif; ?>></td>
    <td><label for='site_autoplay0'><?php echo SELanguage::_get(4000061); ?></label></td>
  </tr>
</table>
<br />


<?php if ($this->_tpl_vars['skins']): ?>
  <div><b><?php echo SELanguage::_get(4000062); ?></b></div>
  <select class='text' name='select_music_skin' id='select_music_skin' onChange='showPlayerSkin()' style='width: 150px;'>
  <?php unset($this->_sections['skin_loop']);
$this->_sections['skin_loop']['name'] = 'skin_loop';
$this->_sections['skin_loop']['loop'] = is_array($_loop=$this->_tpl_vars['skins']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['skin_loop']['show'] = true;
$this->_sections['skin_loop']['max'] = $this->_sections['skin_loop']['loop'];
$this->_sections['skin_loop']['step'] = 1;
$this->_sections['skin_loop']['start'] = $this->_sections['skin_loop']['step'] > 0 ? 0 : $this->_sections['skin_loop']['loop']-1;
if ($this->_sections['skin_loop']['show']) {
    $this->_sections['skin_loop']['total'] = $this->_sections['skin_loop']['loop'];
    if ($this->_sections['skin_loop']['total'] == 0)
        $this->_sections['skin_loop']['show'] = false;
} else
    $this->_sections['skin_loop']['total'] = 0;
if ($this->_sections['skin_loop']['show']):

            for ($this->_sections['skin_loop']['index'] = $this->_sections['skin_loop']['start'], $this->_sections['skin_loop']['iteration'] = 1;
                 $this->_sections['skin_loop']['iteration'] <= $this->_sections['skin_loop']['total'];
                 $this->_sections['skin_loop']['index'] += $this->_sections['skin_loop']['step'], $this->_sections['skin_loop']['iteration']++):
$this->_sections['skin_loop']['rownum'] = $this->_sections['skin_loop']['iteration'];
$this->_sections['skin_loop']['index_prev'] = $this->_sections['skin_loop']['index'] - $this->_sections['skin_loop']['step'];
$this->_sections['skin_loop']['index_next'] = $this->_sections['skin_loop']['index'] + $this->_sections['skin_loop']['step'];
$this->_sections['skin_loop']['first']      = ($this->_sections['skin_loop']['iteration'] == 1);
$this->_sections['skin_loop']['last']       = ($this->_sections['skin_loop']['iteration'] == $this->_sections['skin_loop']['total']);
?>
    <option value='<?php echo $this->_tpl_vars['skins'][$this->_sections['skin_loop']['index']]['xspfskin_id']; ?>
'<?php if ($this->_tpl_vars['skins'][$this->_sections['skin_loop']['index']]['xspfskin_id'] == $this->_tpl_vars['skin_id']): ?> selected='selected'<?php endif; ?>><?php echo $this->_tpl_vars['skins'][$this->_sections['skin_loop']['index']]['xspfskin_title']; ?>
</option>
  <?php endfor; endif; ?>	
  </select>
  <input type='hidden' name='skin_id_cache' id='skin_id_cache' value='<?php echo $this->_tpl_vars['skin_id']; ?>
'>
  <br />
  <br />
  <?php unset($this->_sections['skin_loop2']);
$this->_sections['skin_loop2']['name'] = 'skin_loop2';
$this->_sections['skin_loop2']['loop'] = is_array($_loop=$this->_tpl_vars['skins']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['skin_loop2']['show'] = true;
$this->_sections['skin_loop2']['max'] = $this->_sections['skin_loop2']['loop'];
$this->_sections['skin_loop2']['step'] = 1;
$this->_sections['skin_loop2']['start'] = $this->_sections['skin_loop2']['step'] > 0 ? 0 : $this->_sections['skin_loop2']['loop']-1;
if ($this->_sections['skin_loop2']['show']) {
    $this->_sections['skin_loop2']['total'] = $this->_sections['skin_loop2']['loop'];
    if ($this->_sections['skin_loop2']['total'] == 0)
        $this->_sections['skin_loop2']['show'] = false;
} else
    $this->_sections['skin_loop2']['total'] = 0;
if ($this->_sections['skin_loop2']['show']):

            for ($this->_sections['skin_loop2']['index'] = $this->_sections['skin_loop2']['start'], $this->_sections['skin_loop2']['iteration'] = 1;
                 $this->_sections['skin_loop2']['iteration'] <= $this->_sections['skin_loop2']['total'];
                 $this->_sections['skin_loop2']['index'] += $this->_sections['skin_loop2']['step'], $this->_sections['skin_loop2']['iteration']++):
$this->_sections['skin_loop2']['rownum'] = $this->_sections['skin_loop2']['iteration'];
$this->_sections['skin_loop2']['index_prev'] = $this->_sections['skin_loop2']['index'] - $this->_sections['skin_loop2']['step'];
$this->_sections['skin_loop2']['index_next'] = $this->_sections['skin_loop2']['index'] + $this->_sections['skin_loop2']['step'];
$this->_sections['skin_loop2']['first']      = ($this->_sections['skin_loop2']['iteration'] == 1);
$this->_sections['skin_loop2']['last']       = ($this->_sections['skin_loop2']['iteration'] == $this->_sections['skin_loop2']['total']);
?>
    <div id='skin<?php echo $this->_tpl_vars['skins'][$this->_sections['skin_loop2']['index']]['xspfskin_id']; ?>
'<?php if ($this->_tpl_vars['skins'][$this->_sections['skin_loop2']['index']]['xspfskin_id'] != $this->_tpl_vars['skin_id']): ?> style='display: none;'<?php endif; ?>>
      <img src='include/music_skins/<?php echo $this->_tpl_vars['skins'][$this->_sections['skin_loop2']['index']]['xspfskin_title']; ?>
/screenshot.jpg'>
    </div>
  <?php endfor; endif; ?>

  <?php echo '
  <script type=\'text/javascript\'>
  <!--
    function showPlayerSkin()
    {
      old_skin = document.getElementById(\'skin_id_cache\').value;
      new_skin = document.getElementById(\'select_music_skin\').value;
      $(\'skin\'+old_skin).style.display=\'none\';
      $(\'skin\'+new_skin).style.display=\'block\';
      document.getElementById(\'skin_id_cache\').value = new_skin; 
    }
  //-->
  </script>
  '; ?>

  <br />
  
<?php endif; ?>

<table cellpadding='0' cellspacing='0'>
  <tr>
    <td>
      <?php $this->assign('langBlockTemp', SE_Language::_get(173));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' />&nbsp;<?php 

  ?>
      <input type='hidden' name='task' value='dosave'>
      </form>
    </td>
    <td>
      <form action='user_music.php' method='get'>
      <?php $this->assign('langBlockTemp', SE_Language::_get(39));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' /><?php 

  ?>
      </form>
    </td>
  </tr>
</table>
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