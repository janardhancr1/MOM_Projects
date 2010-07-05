<?php /* Smarty version 2.6.14, created on 2010-03-28 07:33:03
         compiled from admin_viewgroups.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin_viewgroups.tpl', 100, false),)), $this);
?><?php
SELanguage::_preload_multi(2000084,2000085,2000094,2000086,1002,2000087,2000092,2000093,175,39,2000088,1005,87,2000089,2000090,153,2000091,155,788);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h2><?php echo SELanguage::_get(2000084); ?></h2>
<?php echo SELanguage::_get(2000085); ?>
<br />
<br />

<table cellpadding='0' cellspacing='0' width='400' align='center'>
<tr>
<td align='center'>
<div class='box'>
<table cellpadding='0' cellspacing='0' align='center'>
<tr><form action='admin_viewgroups.php' method='POST'>
<td><?php echo SELanguage::_get(2000094); ?><br><input type='text' class='text' name='f_title' value='<?php echo $this->_tpl_vars['f_title']; ?>
' size='15' maxlength='100'>&nbsp;</td>
<td><?php echo SELanguage::_get(2000086); ?><br><input type='text' class='text' name='f_owner' value='<?php echo $this->_tpl_vars['f_owner']; ?>
' size='15' maxlength='50'>&nbsp;</td>
<td><input type='submit' class='button' value='<?php echo SELanguage::_get(1002); ?>'></td>
<input type='hidden' name='s' value='<?php echo $this->_tpl_vars['s']; ?>
'>
</form>
</tr>
</table>
</div>
</td></tr></table>

<br />

<?php if ($this->_tpl_vars['total_groups'] == 0): ?>

  <table cellpadding='0' cellspacing='0' width='400' align='center'>
  <tr>
  <td align='center'>
    <div class='box' style='width: 300px;'><b><?php echo SELanguage::_get(2000087); ?></b></div>
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

  var group_id = 0;
  function confirmDelete(id) {
    group_id = id;
    TB_show(\''; 
 echo SELanguage::_get(2000092); 
 echo '\', \'#TB_inline?height=150&width=300&inlineId=confirmdelete\', \'\', \'../images/trans.gif\');
  }

  function deleteGroup() {
    window.location = \'admin_viewgroups.php?task=deletegroup&group_id=\'+group_id+\'&s='; 
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
      <?php echo SELanguage::_get(2000093); ?>
    </div>
    <br>
    <input type='button' class='button' value='<?php echo SELanguage::_get(175); ?>' onClick='parent.TB_remove();parent.deleteGroup();'> <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='parent.TB_remove();'>
  </div>
  <div class='pages'><?php echo sprintf(SELanguage::_get(2000088), $this->_tpl_vars['total_groups']); ?> &nbsp;|&nbsp; <?php echo SELanguage::_get(1005); ?> <?php unset($this->_sections['page_loop']);
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
 else: ?><a href='admin_viewgroups.php?s=<?php echo $this->_tpl_vars['s']; ?>
&p=<?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>
</a><?php endif; ?> <?php endfor; endif; ?></div>
  
  <form action='admin_viewgroups.php' method='post' name='items'>
  <table cellpadding='0' cellspacing='0' class='list'>
  <tr>
  <td class='header' width='10'><input type='checkbox' name='select_all' onClick='javascript:doCheckAll()'></td>
  <td class='header' width='10' style='padding-left: 0px;'><a class='header' href='admin_viewgroups.php?s=<?php echo $this->_tpl_vars['i']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(87); ?></a></td>
  <td class='header'><a class='header' href='admin_viewgroups.php?s=<?php echo $this->_tpl_vars['t']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(2000094); ?></a></td>
  <td class='header'><a class='header' href='admin_viewgroups.php?s=<?php echo $this->_tpl_vars['o']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(2000086); ?></a></td>
  <td class='header' width='1'><a class='header' href='admin_viewgroups.php?s=<?php echo $this->_tpl_vars['m']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(2000089); ?></a></td>
  <td class='header' width='100'><a class='header' href='admin_viewgroups.php?s=<?php echo $this->_tpl_vars['d']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(2000090); ?></a></td>
  <td class='header' width='100'><?php echo SELanguage::_get(153); ?></td>
  </tr>
  <?php unset($this->_sections['group_loop']);
$this->_sections['group_loop']['name'] = 'group_loop';
$this->_sections['group_loop']['loop'] = is_array($_loop=$this->_tpl_vars['groups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['group_loop']['show'] = true;
$this->_sections['group_loop']['max'] = $this->_sections['group_loop']['loop'];
$this->_sections['group_loop']['step'] = 1;
$this->_sections['group_loop']['start'] = $this->_sections['group_loop']['step'] > 0 ? 0 : $this->_sections['group_loop']['loop']-1;
if ($this->_sections['group_loop']['show']) {
    $this->_sections['group_loop']['total'] = $this->_sections['group_loop']['loop'];
    if ($this->_sections['group_loop']['total'] == 0)
        $this->_sections['group_loop']['show'] = false;
} else
    $this->_sections['group_loop']['total'] = 0;
if ($this->_sections['group_loop']['show']):

            for ($this->_sections['group_loop']['index'] = $this->_sections['group_loop']['start'], $this->_sections['group_loop']['iteration'] = 1;
                 $this->_sections['group_loop']['iteration'] <= $this->_sections['group_loop']['total'];
                 $this->_sections['group_loop']['index'] += $this->_sections['group_loop']['step'], $this->_sections['group_loop']['iteration']++):
$this->_sections['group_loop']['rownum'] = $this->_sections['group_loop']['iteration'];
$this->_sections['group_loop']['index_prev'] = $this->_sections['group_loop']['index'] - $this->_sections['group_loop']['step'];
$this->_sections['group_loop']['index_next'] = $this->_sections['group_loop']['index'] + $this->_sections['group_loop']['step'];
$this->_sections['group_loop']['first']      = ($this->_sections['group_loop']['iteration'] == 1);
$this->_sections['group_loop']['last']       = ($this->_sections['group_loop']['iteration'] == $this->_sections['group_loop']['total']);
?>
    <tr class='<?php echo smarty_function_cycle(array('values' => "background1,background2"), $this);?>
'>
    <td class='item' style='padding-right: 0px;'><input type='checkbox' name='delete_group_<?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_id']; ?>
' value='1'></td>
    <td class='item' style='padding-left: 0px;'><?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_id']; ?>
</td>
    <td class='item'><?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_title']; ?>
</td>
    <td class='item'><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group_leader']->user_info['user_username']); ?>
' target='_blank'><?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group_leader']->user_displayname; ?>
</a></td>
    <td class='item' align='center'><?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group_members']; ?>
</td>
    <td class='item'><?php $this->assign('group_datecreated', $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_datecreated']); 
 echo $this->_tpl_vars['datetime']->cdate($this->_tpl_vars['setting']['setting_dateformat'],$this->_tpl_vars['datetime']->timezone($this->_tpl_vars['group_datecreated'],$this->_tpl_vars['setting']['setting_timezone'])); ?>
</td>
    <td class='item'>[ <a href='admin_loginasuser.php?user_id=<?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_user_id']; ?>
&return_url=<?php echo $this->_tpl_vars['url']->url_encode(($this->_tpl_vars['url']->url_base)."group.php?group_id=".($this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_id'])); ?>
' target='_blank'><?php echo SELanguage::_get(2000091); ?></a> ] [ <a href='javascript:void(0);' onclick="confirmDelete('<?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_id']; ?>
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
    <div class='pages2'><?php echo sprintf(SELanguage::_get(2000088), $this->_tpl_vars['total_groups']); ?> &nbsp;|&nbsp; <?php echo SELanguage::_get(1005); ?> <?php unset($this->_sections['page_loop']);
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
 else: ?><a href='admin_viewgroups.php?s=<?php echo $this->_tpl_vars['s']; ?>
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