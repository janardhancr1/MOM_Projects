<?php /* Smarty version 2.6.14, created on 2010-03-28 07:42:04
         compiled from admin_viewvideos.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin_viewvideos.tpl', 101, false),)), $this);
?><?php
SELanguage::_preload_multi(5500085,5500086,5500087,5500088,1002,5500089,5500145,5500146,175,39,5500090,1005,87,153,589,5500091,155,788);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h2><?php echo SELanguage::_get(5500085); ?></h2>
<?php echo SELanguage::_get(5500086); ?>
<br />
<br />

<table cellpadding='0' cellspacing='0' width='400' align='center'>
<tr>
<td align='center'>
<div class='box'>
<table cellpadding='0' cellspacing='0' align='center'>
<form action='admin_viewvideos.php' method='POST'>
<tr>
<td><?php echo SELanguage::_get(5500087); ?><br><input type='text' class='text' name='f_title' value='<?php echo $this->_tpl_vars['f_title']; ?>
' size='15' maxlength='50'>&nbsp;</td>
<td><?php echo SELanguage::_get(5500088); ?><br><input type='text' class='text' name='f_owner' value='<?php echo $this->_tpl_vars['f_owner']; ?>
' size='15' maxlength='50'>&nbsp;&nbsp;</td>
<td><input type='submit' class='button' value='<?php echo SELanguage::_get(1002); ?>'></td>
<input type='hidden' name='s' value='<?php echo $this->_tpl_vars['s']; ?>
'>
</form>
</tr>
</table>
</div>
</td></tr></table>

<br>

<?php if ($this->_tpl_vars['total_videos'] == 0): ?>

  <table cellpadding='0' cellspacing='0' width='400' align='center'>
  <tr>
  <td align='center'>
    <div class='box' style='width: 300px;'><b><?php echo SELanguage::_get(5500089); ?></b></div>
  </td>
  </tr>
  </table>
  <br>

<?php else: ?>

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

  var video_id = 0;
  function confirmDelete(id) {
    video_id = id;
    TB_show(\''; 
 echo SELanguage::_get(5500145); 
 echo '\', \'#TB_inline?height=150&width=300&inlineId=confirmdelete\', \'\', \'../images/trans.gif\');
  }

  function deleteVideo() {
    window.location = \'admin_viewvideos.php?task=deletevideo&video_id=\'+video_id+\'&s='; 
 echo $this->_tpl_vars['s']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; 
 echo '\';
  }
  // -->
  </script>
  '; ?>


    <div style='display: none;' id='confirmdelete'>
    <div style='margin-top: 10px;'>
      <?php echo SELanguage::_get(5500146); ?>
    </div>
    <br>
    <input type='button' class='button' value='<?php echo SELanguage::_get(175); ?>' onClick='parent.TB_remove();parent.deleteVideo();'> <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='parent.TB_remove();'>
  </div>

  <div class='pages'><?php echo sprintf(SELanguage::_get(5500090), $this->_tpl_vars['total_videos']); ?> &nbsp;|&nbsp; <?php echo SELanguage::_get(1005); ?> <?php unset($this->_sections['page_loop']);
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

 if ($this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['link'] == '1'): 
 echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; 
 else: ?><a href='admin_viewvideos.php?s=<?php echo $this->_tpl_vars['s']; ?>
&p=<?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>
</a><?php endif; ?> <?php endfor; endif; ?></div>

  <form action='admin_viewvideos.php' method='post' name='items'>
  <table cellpadding='0' cellspacing='0' class='list'>
  <tr>
  <td class='header' width='10'><input type='checkbox' name='select_all' onClick='javascript:doCheckAll()'></td>
  <td class='header' width='10' style='padding-left: 0px;'><a class='header' href='admin_viewvideos.php?s=<?php echo $this->_tpl_vars['i']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(87); ?></a></td>
  <td class='header'><a class='header' href='admin_viewvideos.php?s=<?php echo $this->_tpl_vars['t']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(5500087); ?></a></td>
  <td class='header'><a class='header' href='admin_viewvideos.php?s=<?php echo $this->_tpl_vars['u']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(5500088); ?></a></td>
  <td class='header' width='100'><?php echo SELanguage::_get(153); ?></td>
  </tr>
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
    <?php $this->assign('video_url', $this->_tpl_vars['url']->url_create('video',$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_author']->user_info['user_username'],$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id'])); ?>
    <tr class='<?php echo smarty_function_cycle(array('values' => "background1,background2"), $this);?>
'>
    <td class='item' style='padding-right: 0px;'><input type='checkbox' name='delete_video_<?php echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']; ?>
' value='1'></td>
    <td class='item' style='padding-left: 0px;'><?php echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']; ?>
</td>
    <td class='item'><?php if ($this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_title'] == ""): ?><i><?php echo SELanguage::_get(589); ?></i><?php else: 
 echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_title']; 
 endif; ?>&nbsp;</td>
    <td class='item'><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_author']->user_info['user_username']); ?>
' target='_blank'><?php echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_author']->user_displayname; ?>
</a></td>
    <td class='item'>[ <a href='admin_loginasuser.php?user_id=<?php echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_author']->user_info['user_id']; ?>
&return_url=<?php echo $this->_tpl_vars['url']->url_encode($this->_tpl_vars['video_url']); ?>
' target='_blank'><?php echo SELanguage::_get(5500091); ?></a> ] [ <a href="javascript:void(0);" onClick="confirmDelete('<?php echo $this->_tpl_vars['videos'][$this->_sections['video_loop']['index']]['video_id']; ?>
');"><?php echo SELanguage::_get(155); ?></a> ]</td>
    </tr>
  <?php endfor; endif; ?>
  </table>

  <table cellpadding='0' cellspacing='0' width='100%'>
  <tr>
  <td>
    <br>
    <input type='submit' class='button' value='<?php echo SELanguage::_get(788); ?>'>
    <input type='hidden' name='task' value='delete'>
    <input type='hidden' name='s' value='<?php echo $this->_tpl_vars['s']; ?>
'>
    <input type='hidden' name='p' value='<?php echo $this->_tpl_vars['p']; ?>
'>
    <input type='hidden' name='f_title' value='<?php echo $this->_tpl_vars['f_title']; ?>
'>
    <input type='hidden' name='f_owner' value='<?php echo $this->_tpl_vars['f_owner']; ?>
'>
    </form>
  </td>
  <td align='right' valign='top'>
    <div class='pages2'><?php echo sprintf(SELanguage::_get(5500090), $this->_tpl_vars['total_videos']); ?> &nbsp;|&nbsp; <?php echo SELanguage::_get(1005); ?> <?php unset($this->_sections['page_loop']);
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

 if ($this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['link'] == '1'): 
 echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; 
 else: ?><a href='admin_viewvideos.php?s=<?php echo $this->_tpl_vars['s']; ?>
&p=<?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>
</a><?php endif; ?> <?php endfor; endif; ?></div>
  </td>
  </tr>
  </table>

<?php endif; 
 $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>