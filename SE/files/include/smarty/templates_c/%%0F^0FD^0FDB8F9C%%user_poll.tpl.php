<?php /* Smarty version 2.6.14, created on 2010-06-24 16:34:23
         compiled from user_poll.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'user_poll.tpl', 57, false),array('modifier', 'truncate', 'user_poll.tpl', 95, false),array('modifier', 'escape', 'user_poll.tpl', 105, false),)), $this);
?><?php
SELanguage::_preload_multi(2500037,2500040,2500041,2500042,646,182,2500035,2500036,183,2500046,2500047,2500055,2500114,2500115,2500028,2500122,507,2500121,2500057,2500048,2500056,175,39,2500043,2500044);
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
<img src='./images/icons/poll_poll48.gif' border='0' class='icon_big'>
<div class='page_header'>&nbsp;<?php echo SELanguage::_get(2500037); ?></div>
<div class='mom_div_small'>
&nbsp;Create a Poll or Tell Others What you Think
</div>

</td>
<td valign='top' align='right'>

  <table cellpadding='0' cellspacing='0' width='150'>
  <tr><td class='button' nowrap='nowrap'><a href='browse_polls.php'><img src='./images/icons/back16.gif' border='0' class='button'>Back to Polls</a></td></tr>
  </table>

</td>
</tr>
</table>

<div style='margin-top: 20px;'>
  <div class='button' style='float: left;'>
    <a href='user_poll_new.php'><img src='./images/icons/poll_new16.gif' border='0' class='button'><?php echo SELanguage::_get(2500040); ?></a>
  </div>
  <div class='button' style='float: left; padding-left: 20px;'>
    <a href="javascript:void(0);" onClick="this.blur();if($('poll_search').style.display=='none') <?php echo '{'; ?>
 $('poll_search').style.display='block'; $('poll_searchtext').focus(); <?php echo '} else {'; ?>
 $('poll_search').style.display='none'; <?php echo '}'; ?>
"><img src='./images/icons/search16.gif' border='0' class='button'><?php echo SELanguage::_get(2500041); ?></a>
  </div>
  <div style='clear: both; height: 0px;'></div>
</div>

<div class='poll_search' id='poll_search' style='width: 550px; margin-top: 10px; text-align: center;<?php if ($this->_tpl_vars['search'] == ""): ?> display: none;<?php endif; ?>'>
  <form action='user_poll.php' name='searchform' method='post'>
  <table cellpadding='0' cellspacing='0' align='center'>
    <tr>
      <td><?php echo SELanguage::_get(2500042); ?>&nbsp;</td>
      <td><input type='text' name='search' maxlength='100' size='30' value='<?php echo $this->_tpl_vars['search']; ?>
' class='text' id='poll_searchtext'>&nbsp;</td>
      <td><?php $this->assign('langBlockTemp', SE_Language::_get(646));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
'><?php 

  ?></td>
    </tr>
  </table>
  <input type='hidden' name='s' value='<?php echo $this->_tpl_vars['s']; ?>
'>
  <input type='hidden' name='p' value='<?php echo $this->_tpl_vars['p']; ?>
'>
  </form>
</div>

<?php if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div class='center'>
    <?php if ($this->_tpl_vars['p'] != 1): ?>
      <a href='user_poll.php?s=<?php echo $this->_tpl_vars['s']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a>
    <?php else: ?>
      <font class='disabled'>&#171; <?php echo SELanguage::_get(182); ?></font>
    <?php endif; ?>
    &nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
      <?php echo sprintf(SELanguage::_get(2500035), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_polls']); ?>
    <?php else: ?>
      <?php echo sprintf(SELanguage::_get(2500036), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_polls']); ?>
    <?php endif; ?>
    &nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?>
      <a href='user_poll.php?s=<?php echo $this->_tpl_vars['s']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a>
    <?php else: ?>
      <font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font>
    <?php endif; ?>
  </div>
  <br />
<?php endif; 
 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(2500046,2500047,2500055,2500114,2500115));
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

<script type='text/javascript' src="./include/js/class_poll.js"></script>
<script type='text/javascript'>
<!--
  SocialEngine.Polls = new SocialEngineAPI.Polls();
  SocialEngine.RegisterModule(SocialEngine.Polls);
//-->
</script>

  
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
<div style='width: 550px;' id='sePoll_<?php echo $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_id']; ?>
' class="sePollRow poll">
  <table cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td class='poll_left' width='100%'>
        <div class='poll_title'>
          <?php echo ((is_array($_tmp=$this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>

        </div>
        <div class='poll_stats'>
          <?php $this->assign('poll_datecreated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_datecreated'])); ?>
          <?php echo sprintf(SELanguage::_get(2500028), $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_totalvotes']); ?>
          - <?php echo sprintf(SELanguage::_get(2500122), $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_views']); ?>
          - <?php echo sprintf(SELanguage::_get(507), $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['total_comments']); ?>
          - <?php echo sprintf(SELanguage::_get($this->_tpl_vars['poll_datecreated'][0]), $this->_tpl_vars['poll_datecreated'][1]); ?>
        </div>
        <?php if ($this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_desc'] != ""): ?>
          <div style='margin-top: 8px; margin-bottom: 8px;'><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_desc'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('truncate', true, $_tmp, 197, "...", true) : smarty_modifier_truncate($_tmp, 197, "...", true)); ?>
</div>
        <?php endif; ?>
        <div class='poll_options'>
                    <div style='float: left;'><a href='<?php echo $this->_tpl_vars['url']->url_create('poll',$this->_tpl_vars['user']->user_info['user_username'],$this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_id']); ?>
'><img src='./images/icons/poll_poll16.gif' border='0' class='button'><?php echo SELanguage::_get(2500121); ?></a></div>
            
                    <div style='float: left; padding-left: 15px;'><a href='user_poll_edit.php?poll_id=<?php echo $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_id']; ?>
'><img src='./images/icons/poll_edit16.gif' border='0' class='button'><?php echo SELanguage::_get(2500057); ?></a></div>
            
                    <div class="sePollsClose" style='float: left; padding-left: 15px;<?php if ($this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_closed']): ?> display: none;<?php endif; ?>'><a href='javascript:void(0);' onclick="SocialEngine.Polls.togglePoll(<?php echo $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_id']; ?>
, true );"><img src='./images/icons/poll_close16.gif' border='0' class='button'><?php echo SELanguage::_get(2500047); ?></a></div>
          <div class="sePollsOpen"  style='float: left; padding-left: 15px;<?php if (! $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_closed']): ?> display: none;<?php endif; ?>'><a href='javascript:void(0);' onclick="SocialEngine.Polls.togglePoll(<?php echo $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_id']; ?>
, false);"><img src='./images/icons/poll_open16.gif' border='0' class='button'><?php echo SELanguage::_get(2500046); ?></a></div>
            
                    <div class="sePollsDelete" style='float: left; padding-left: 15px;'><a href='javascript:void(0);' onclick="SocialEngine.Polls.deletePoll(<?php echo $this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_id']; ?>
);"><img src='./images/icons/poll_delete16.gif' border='0' class='button'><?php echo SELanguage::_get(2500048); ?></a></div>
          <div style='clear: both; height: 0px;'></div>
        </div>
      </td>
    </tr>
  </table>
</div>
<?php endfor; endif; ?>

<div style='clear: both; height: 0px;'></div>

<div style='display: none;' id='confirmpolldelete'>
  <div style='margin-top: 10px;'>
    <?php echo SELanguage::_get(2500056); ?>
  </div>
  <br>
  <input type='button' class='button' value='<?php echo SELanguage::_get(175); ?>' onClick='parent.TB_remove();parent.SocialEngine.Polls.deletePollConfirm(parent.SocialEngine.Polls.currentConfirmDeleteID);'> <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='parent.TB_remove();'>
</div>

<?php if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div class='center'>
    <?php if ($this->_tpl_vars['p'] != 1): ?>
      <a href='user_poll.php?s=<?php echo $this->_tpl_vars['s']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a>
    <?php else: ?>
      <font class='disabled'>&#171; <?php echo SELanguage::_get(182); ?></font>
    <?php endif; ?>
    &nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
      <?php echo sprintf(SELanguage::_get(2500035), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_polls']); ?>
    <?php else: ?>
      <?php echo sprintf(SELanguage::_get(2500036), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_polls']); ?>
    <?php endif; ?>
    &nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?>
      <a href='user_poll.php?s=<?php echo $this->_tpl_vars['s']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a>
    <?php else: ?>
      <font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font>
    <?php endif; ?>
  </div>
  <br />
<?php endif; 
 if ($this->_tpl_vars['total_polls'] == 0 && ! empty ( $this->_tpl_vars['search'] )): ?>

  <br>
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='result'><img src='./images/icons/bulb16.gif' border='0' class='icon'><?php echo SELanguage::_get(2500043); ?></td></tr>
  </table>
  
<?php endif; ?>



<div<?php if ($this->_tpl_vars['total_polls'] > 0): ?> style='display: none;'<?php endif; ?> id='pollnullmessage'>
  <br>    
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='result'><img src='./images/icons/bulb16.gif' border='0' class='icon'><?php echo SELanguage::_get(2500044); ?></td></tr>
  </table>
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