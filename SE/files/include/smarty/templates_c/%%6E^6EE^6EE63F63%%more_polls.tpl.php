<?php /* Smarty version 2.6.14, created on 2010-06-24 17:16:39
         compiled from more_polls.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'more_polls.tpl', 53, false),array('function', 'cycle', 'more_polls.tpl', 103, false),array('modifier', 'truncate', 'more_polls.tpl', 84, false),array('modifier', 'escape', 'more_polls.tpl', 96, false),)), $this);
?><?php
SELanguage::_preload_multi(2500028,2500034,2500114,2500115,182,2500035,2500036,183,2500108,507,949);
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
<div class='page_header'><?php echo $this->_tpl_vars['polltypeheader']; ?>
</div>

</td>
<td valign='top' align='right'>

  <table cellpadding='0' cellspacing='0' width='150'>
  <tr><td class='button' nowrap='nowrap'><a href='browse_polls.php'><img src='./images/icons/back16.gif' border='0' class='button'>Back to Polls</a></td></tr>
  </table>

</td>
</tr>
</table>

<br />


<?php 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(2500028,2500034,2500114,2500115));
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


<div id="pollResultTemplate" style="display:none;">
  <div class="pollResult">
    <div class="pollResultLabel"></div>
    <div class="pollResultBar"></div>
    <span class="pollResultPercentage"></span>
    <span class="pollResultVotes"></span>
  </div>
</div>

<table>
<tr>
<td colspan='2'>
<?php if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div class='center'>
    <?php if ($this->_tpl_vars['p'] != 1): ?>
      <a href='more_polls.php?type=<?php echo $this->_tpl_vars['polltype']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
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
      <a href='more_polls.php?type=<?php echo $this->_tpl_vars['polltype']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a>
    <?php else: ?>
      <font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font>
    <?php endif; ?>
  </div>
  <br />
<?php endif; ?>
</td>
</tr>
<tr>
<td>
<?php unset($this->_sections['poll_loop']);
$this->_sections['poll_loop']['name'] = 'poll_loop';
$this->_sections['poll_loop']['loop'] = is_array($_loop=$this->_tpl_vars['todays_polls']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

    <div class='polls_browse_item' style='width: 620px; height: 80px; padding:5px'>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td style='vertical-align: top; padding-left: 0px;'>
        <div style='font-weight: bold; font-size: 13px;'>
          <img src="./images/icons/poll_poll16.gif" class='button' style='float: left;'>
          <a href='<?php echo $this->_tpl_vars['url']->url_create('poll',$this->_tpl_vars['todays_polls'][$this->_sections['poll_loop']['index']]->poll_owner->user_info['user_username'],$this->_tpl_vars['todays_polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_id']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['todays_polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>
</a>
        </div>
        <div class='polls_browse_date'>
          <?php $this->assign('poll_datecreated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['todays_polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_datecreated'])); 
 ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['poll_datecreated'][0]), $this->_tpl_vars['poll_datecreated'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('created', ob_get_contents());ob_end_clean(); ?>
          <?php echo sprintf(SELanguage::_get(2500108), $this->_tpl_vars['created'], $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['todays_polls'][$this->_sections['poll_loop']['index']]->poll_owner->user_info['user_username']), $this->_tpl_vars['todays_polls'][$this->_sections['poll_loop']['index']]->poll_owner->user_displayname); ?>
        </div>
        <div style="margin-top: 5px;">
          <?php echo sprintf(SELanguage::_get(2500028), $this->_tpl_vars['todays_polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_totalvotes']); ?>,
          <?php echo sprintf(SELanguage::_get(507), $this->_tpl_vars['todays_polls'][$this->_sections['poll_loop']['index']]->poll_info['total_comments']); ?>,
          <?php echo sprintf(SELanguage::_get(949), $this->_tpl_vars['todays_polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_views']); ?>
        </div>
        <div style='margin-top: 10px;'>
          <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['todays_polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_desc'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('truncate', true, $_tmp, 75, "...", true) : smarty_modifier_truncate($_tmp, 75, "...", true)); ?>

        </div>
      </td>
      </tr>
      </table>
    </div>
    
    <?php echo smarty_function_cycle(array('values' => "<div style='clear: both; height: 10px;'></div>"), $this);?>

  <?php endfor; endif; ?>
 </td>
 </tr>
 <tr>
 <td  colspan='2'>
<?php if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div class='center'>
    <?php if ($this->_tpl_vars['p'] != 1): ?>
      <a href='more_polls.php?type=<?php echo $this->_tpl_vars['polltype']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
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
      <a href='more_polls.php?type=<?php echo $this->_tpl_vars['polltype']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a>
    <?php else: ?>
      <font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font>
    <?php endif; ?>
  </div>
  <br>
<?php endif; ?>
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