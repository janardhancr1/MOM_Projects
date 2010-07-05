<?php /* Smarty version 2.6.14, created on 2010-03-28 07:33:36
         compiled from admin_viewpolls.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin_viewpolls.tpl', 106, false),array('modifier', 'truncate', 'admin_viewpolls.tpl', 109, false),)), $this);
?><?php
SELanguage::_preload_multi(2500002,2500099,2500082,2500083,1002,2500043,2500084,1005,87,2500085,2500086,2500087,2500088,2500056,155,788);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h2><?php echo SELanguage::_get(2500002); ?></h2>
<?php echo SELanguage::_get(2500099); ?>
<br />
<br />

<form action='admin_viewpolls.php' method='post'>
<table cellpadding='0' cellspacing='0' width='400' align='center'>
  <tr>
    <td align='center'>
      <div class='box'>
        <table cellpadding='0' cellspacing='0' align='center'>
          <tr>
            <td>
              <?php echo SELanguage::_get(2500082); ?>
              <br />
              <input type='text' class='text' name='f_title' value='<?php echo $this->_tpl_vars['f_title']; ?>
' size='15' maxlength='100' />
              &nbsp;
            </td>
            <td>
              <?php echo SELanguage::_get(2500083); ?>
              <br />
              <input type='text' class='text' name='f_owner' value='<?php echo $this->_tpl_vars['f_owner']; ?>
' size='15' maxlength='50' />
              &nbsp;
            </td>
            <td><?php $this->assign('langBlockTemp', SE_Language::_get(1002));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' /></td><?php 

  ?>
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


<?php if ($this->_tpl_vars['total_polls'] == 0): ?>

  <table cellpadding='0' cellspacing='0' width='400' align='center'>
    <tr>
      <td align='center'><div class='box' style='width: 300px;'><b><?php echo SELanguage::_get(2500043); ?></b></div></td>
    </tr>
  </table>
  <br />

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
  // -->
  </script>
  '; ?>


  <div class='pages'>
    <?php echo sprintf(SELanguage::_get(2500084), $this->_tpl_vars['total_polls']); ?>
    &nbsp;|&nbsp;
    <?php echo SELanguage::_get(1005); ?>
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
      <?php if ($this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['link'] == '1'): ?>
        <?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>

      <?php else: ?>
        <a href='admin_viewpolls.php?s=<?php echo $this->_tpl_vars['s']; ?>
&p=<?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>
</a>
      <?php endif; ?>
    <?php endfor; endif; ?>
  </div>
  
  
  <form action='admin_viewpolls.php' method='post' name='items'>
  <table cellpadding='0' cellspacing='0' class='list'>
    <tr>
      <td class='header' width='10'><input type='checkbox' name='select_all' onClick='javascript:doCheckAll()'></td>
      <td class='header' width='10' style='padding-left: 0px;'><a class='header' href='admin_viewpolls.php?s=<?php echo $this->_tpl_vars['i']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(87); ?></a></td>
      <td class='header' width='100%'><a class='header' href='admin_viewpolls.php?s=<?php echo $this->_tpl_vars['t']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(2500082); ?></a></td>
      <td class='header'><a class='header' href='admin_viewpolls.php?s=<?php echo $this->_tpl_vars['v']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(2500085); ?></a></td>
      <td class='header'><a class='header' href='admin_viewpolls.php?s=<?php echo $this->_tpl_vars['o']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(2500083); ?></a></td>
      <td class='header' width='150'><a class='header' href='admin_viewpolls.php?s=<?php echo $this->_tpl_vars['d']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'><?php echo SELanguage::_get(2500086); ?></a></td>
      <td class='header' width='100'><?php echo SELanguage::_get(2500087); ?></td>
    </tr>
    
    <?php unset($this->_sections['poll_loop']);
$this->_sections['poll_loop']['name'] = 'poll_loop';
$this->_sections['poll_loop']['loop'] = is_array($_loop=$this->_tpl_vars['polls']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['poll_loop']['show'] = true;
$this->_sections['poll_loop']['max'] = $this->_sections['poll_loop']['loop'];
$this->_sections['poll_loop']['step'] = 1;
$this->_sections['poll_loop']['start'] = $this->_sections['poll_loop']['step'] > 0 ? 0 : $this->_sections['poll_loop']['loop']-1;
if ($this->_sections['poll_loop']['show']) {
    $this->_sections['poll_loop']['total'] = $this->_sections['poll_loop']['loop'];
    if ($this->_sections['poll_loop']['total'] == 0)
        $this->_sections['poll_loop']['show'] = false;
} else
    $this->_sections['poll_loop']['total'] = 0;
if ($this->_sections['poll_loop']['show']):

            for ($this->_sections['poll_loop']['index'] = $this->_sections['poll_loop']['start'], $this->_sections['poll_loop']['iteration'] = 1;
                 $this->_sections['poll_loop']['iteration'] <= $this->_sections['poll_loop']['total'];
                 $this->_sections['poll_loop']['index'] += $this->_sections['poll_loop']['step'], $this->_sections['poll_loop']['iteration']++):
$this->_sections['poll_loop']['rownum'] = $this->_sections['poll_loop']['iteration'];
$this->_sections['poll_loop']['index_prev'] = $this->_sections['poll_loop']['index'] - $this->_sections['poll_loop']['step'];
$this->_sections['poll_loop']['index_next'] = $this->_sections['poll_loop']['index'] + $this->_sections['poll_loop']['step'];
$this->_sections['poll_loop']['first']      = ($this->_sections['poll_loop']['iteration'] == 1);
$this->_sections['poll_loop']['last']       = ($this->_sections['poll_loop']['iteration'] == $this->_sections['poll_loop']['total']);
?>
    <tr class='<?php echo smarty_function_cycle(array('values' => "background1,background2"), $this);?>
'>
      <td class='item' style='padding-right: 0px;'><input type='checkbox' name='delete_polls[]' value='<?php echo $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_id']; ?>
'></td>
      <td class='item' style='padding-left: 0px;'><?php echo $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_id']; ?>
</td>
      <td class='item'><?php echo ((is_array($_tmp=$this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 70, "...", true) : smarty_modifier_truncate($_tmp, 70, "...", true)); ?>
</td>
      <td class='item' align='center'><?php echo $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_totalvotes']; ?>
</td>
      <td class='item'><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_owner->user_info['user_username']); ?>
' target='_blank'><?php echo $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_owner->user_displayname; ?>
</a></td>
      <?php $this->assign('poll_date_start', $this->_tpl_vars['datetime']->timezone($this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_datecreated'],$this->_tpl_vars['global_timezone'])); ?>
      <td class='item' nowrap='nowrap'><?php echo $this->_tpl_vars['datetime']->cdate(($this->_tpl_vars['setting']['setting_dateformat'])." ".($this->_tpl_vars['poll51'])." ".($this->_tpl_vars['setting']['setting_timeformat']),$this->_tpl_vars['poll_date_start']); ?>
</td>
      <td class='item' nowrap='nowrap'>[ <a href='admin_loginasuser.php?user_id=<?php echo $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_user_id']; ?>
&return_url=<?php echo $this->_tpl_vars['url']->url_encode(($this->_tpl_vars['url']->url_base)."poll.php?user=".($this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_owner->user_info['user_username'])."&poll_id=".($this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_id'])); ?>
' target='_blank'><?php echo SELanguage::_get(2500088); ?></a> ] [ <a href="javascript:if(confirm('<?php echo SELanguage::_get(2500056); ?>')) <?php echo '{'; ?>
 location.href = 'admin_viewpolls.php?task=deleteentry&poll_id=<?php echo $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_id']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&p=<?php echo $this->_tpl_vars['p']; ?>
&f_title=<?php echo $this->_tpl_vars['f_title']; ?>
&f_owner=<?php echo $this->_tpl_vars['f_owner']; ?>
'; <?php echo '}'; ?>
"><?php echo SELanguage::_get(155); ?></a> ]</td>
    </tr>
    <?php endfor; endif; ?>
    
  </table>
  <br />

  <table cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td>
        <?php $this->assign('langBlockTemp', SE_Language::_get(788));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
'><?php 

  ?>
      </td>
      <td align='right' valign='top'>
        <div class='pages2'>
          <?php echo sprintf(SELanguage::_get(2500084), $this->_tpl_vars['total_polls']); ?>
          &nbsp;|&nbsp;
          <?php echo SELanguage::_get(1005); ?>
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
            <?php if ($this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['link'] == '1'): ?>
              <?php echo $this->_tpl_vars['pages'][$this->_sections['page_loop']['index']]['page']; ?>

            <?php else: ?>
              <a href='admin_viewpolls.php?s=<?php echo $this->_tpl_vars['s']; ?>
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
<?php endif; 
 $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>