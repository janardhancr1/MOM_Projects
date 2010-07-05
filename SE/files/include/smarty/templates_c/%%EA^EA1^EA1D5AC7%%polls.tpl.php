<?php /* Smarty version 2.6.14, created on 2010-05-31 03:11:01
         compiled from polls.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'polls.tpl', 36, false),array('function', 'counter', 'polls.tpl', 102, false),array('modifier', 'truncate', 'polls.tpl', 83, false),array('modifier', 'choptext', 'polls.tpl', 94, false),)), $this);
?><?php
SELanguage::_preload_multi(2500027,2500028,2500034,2500114,2500115,182,2500035,2500036,183,2500029,507,2500122,2500030,2500032,2500087);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'><?php echo sprintf(SELanguage::_get(2500027), $this->_tpl_vars['owner']->user_displayname, $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['owner']->user_info['user_username']), $this->_tpl_vars['url']->url_create('polls',$this->_tpl_vars['owner']->user_info['user_username'])); ?></div>
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


<?php if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div class='center'>
    <?php if ($this->_tpl_vars['p'] != 1): ?>
      <a href='polls.php?user=<?php echo $this->_tpl_vars['owner']->user_info['user_username']; ?>
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
      <a href='polls.php?user=<?php echo $this->_tpl_vars['owner']->user_info['user_username']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a>
    <?php else: ?>
      <font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font>
    <?php endif; ?>
  </div>
  <br />
<?php endif; 
 unset($this->_sections['polls_loop']);
$this->_sections['polls_loop']['name'] = 'polls_loop';
$this->_sections['polls_loop']['loop'] = is_array($_loop=$this->_tpl_vars['polls']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['polls_loop']['show'] = true;
$this->_sections['polls_loop']['max'] = $this->_sections['polls_loop']['loop'];
$this->_sections['polls_loop']['step'] = 1;
$this->_sections['polls_loop']['start'] = $this->_sections['polls_loop']['step'] > 0 ? 0 : $this->_sections['polls_loop']['loop']-1;
if ($this->_sections['polls_loop']['show']) {
    $this->_sections['polls_loop']['total'] = $this->_sections['polls_loop']['loop'];
    if ($this->_sections['polls_loop']['total'] == 0)
        $this->_sections['polls_loop']['show'] = false;
} else
    $this->_sections['polls_loop']['total'] = 0;
if ($this->_sections['polls_loop']['show']):

            for ($this->_sections['polls_loop']['index'] = $this->_sections['polls_loop']['start'], $this->_sections['polls_loop']['iteration'] = 1;
                 $this->_sections['polls_loop']['iteration'] <= $this->_sections['polls_loop']['total'];
                 $this->_sections['polls_loop']['index'] += $this->_sections['polls_loop']['step'], $this->_sections['polls_loop']['iteration']++):
$this->_sections['polls_loop']['rownum'] = $this->_sections['polls_loop']['iteration'];
$this->_sections['polls_loop']['index_prev'] = $this->_sections['polls_loop']['index'] - $this->_sections['polls_loop']['step'];
$this->_sections['polls_loop']['index_next'] = $this->_sections['polls_loop']['index'] + $this->_sections['polls_loop']['step'];
$this->_sections['polls_loop']['first']      = ($this->_sections['polls_loop']['iteration'] == 1);
$this->_sections['polls_loop']['last']       = ($this->_sections['polls_loop']['iteration'] == $this->_sections['polls_loop']['total']);
?>

  <?php if ($this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_viewonly']): ?>
  <script type='text/javascript'>
  <!--
    window.addEvent('domready', function()
    {
      SocialEngine.Polls.getPollData(<?php echo $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_id']; ?>
);
    });
  //-->
  </script>
  <?php endif; ?>
  
  <?php if ($this->_sections['polls_loop']['first'] != true): ?>
    <div style='margin-top: 10px; font-size: 1pt; height: 1px;'>&nbsp;</div>
  <?php endif; ?>

    <table cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td valign='top' class='poll_view' id="sePoll<?php echo $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_id']; ?>
">
        
                <div class='poll_view_title'>
          <a href="<?php echo $this->_tpl_vars['url']->url_create('poll',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_id']); ?>
">
            <?php echo ((is_array($_tmp=$this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 75, "...", true) : smarty_modifier_truncate($_tmp, 75, "...", true)); ?>

          </a>
        </div>
        <div class='poll_view_stats'>
          <?php ob_start(); ?><span id='poll<?php echo $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_id']; ?>
_totalvotes'><?php echo $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_totalvotes']; ?>
</span><?php $this->_smarty_vars['capture']['totalVotesCode'] = ob_get_contents(); ob_end_clean(); ?>
          <?php echo sprintf(SELanguage::_get(2500029), $this->_tpl_vars['datetime']->cdate(($this->_tpl_vars['setting']['setting_dateformat']),$this->_tpl_vars['datetime']->timezone(($this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_datecreated']),$this->_tpl_vars['global_timezone']))); ?>
          <?php echo sprintf(SELanguage::_get(2500028), $this->_smarty_vars['capture']['totalVotesCode']); ?>,
          <?php echo sprintf(SELanguage::_get(507), $this->_tpl_vars['total_comments']); ?>,
          <?php echo sprintf(SELanguage::_get(2500122), $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_views']); ?>
        </div>
        <div style='padding: 5px;'>
          <?php echo ((is_array($_tmp=$this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_desc'])) ? $this->_run_mod_handler('choptext', true, $_tmp, 120, "<br>") : smarty_modifier_choptext($_tmp, 120, "<br>")); ?>

        </div>
        
                <div style='padding: 5px; font-weight: bold; display: none;' id='poll<?php echo $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_id']; ?>
_results'></div>
        
                <div style='padding: 5px;' id='poll<?php echo $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_id']; ?>
_vote'>
          <?php echo smarty_function_counter(array('start' => -1,'print' => 0), $this);?>

          <?php unset($this->_sections['options_loop']);
$this->_sections['options_loop']['name'] = 'options_loop';
$this->_sections['options_loop']['loop'] = is_array($_loop=$this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['options_loop']['show'] = true;
$this->_sections['options_loop']['max'] = $this->_sections['options_loop']['loop'];
$this->_sections['options_loop']['step'] = 1;
$this->_sections['options_loop']['start'] = $this->_sections['options_loop']['step'] > 0 ? 0 : $this->_sections['options_loop']['loop']-1;
if ($this->_sections['options_loop']['show']) {
    $this->_sections['options_loop']['total'] = $this->_sections['options_loop']['loop'];
    if ($this->_sections['options_loop']['total'] == 0)
        $this->_sections['options_loop']['show'] = false;
} else
    $this->_sections['options_loop']['total'] = 0;
if ($this->_sections['options_loop']['show']):

            for ($this->_sections['options_loop']['index'] = $this->_sections['options_loop']['start'], $this->_sections['options_loop']['iteration'] = 1;
                 $this->_sections['options_loop']['iteration'] <= $this->_sections['options_loop']['total'];
                 $this->_sections['options_loop']['index'] += $this->_sections['options_loop']['step'], $this->_sections['options_loop']['iteration']++):
$this->_sections['options_loop']['rownum'] = $this->_sections['options_loop']['iteration'];
$this->_sections['options_loop']['index_prev'] = $this->_sections['options_loop']['index'] - $this->_sections['options_loop']['step'];
$this->_sections['options_loop']['index_next'] = $this->_sections['options_loop']['index'] + $this->_sections['options_loop']['step'];
$this->_sections['options_loop']['first']      = ($this->_sections['options_loop']['iteration'] == 1);
$this->_sections['options_loop']['last']       = ($this->_sections['options_loop']['iteration'] == $this->_sections['options_loop']['total']);
?>
            <div style='padding: 3px 3px 3px 0px;'>
              <table cellpadding='0' cellspacing='0'><tr>
                <td>
                  <input type='radio' name="pollVoteSelect_<?php echo $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_id']; ?>
" class="pollVoteOption" value='<?php echo smarty_function_counter(array(), $this);?>
'>
                </td>
                <td style='font-weight: bold;'>
                  <label for='poll<?php echo $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_id']; ?>
_option<?php echo $this->_sections['options_loop']['iteration']; ?>
'><?php echo $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_options'][$this->_sections['options_loop']['index']]; ?>
</label>
                </td>
              </tr></table>
            </div>
          <?php endfor; endif; ?>
        </div>
        
                <div id="poll<?php echo $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_id']; ?>
_vote_actions" style='padding: 5px; margin-top: 10px;'>
          <?php if ($this->_tpl_vars['user']->level_info['level_poll_allow'] & 2): ?><a href="javascript:void(0);" onclick="SocialEngine.Polls.sendPollVote(<?php echo $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_id']; ?>
);"><?php echo SELanguage::_get(2500030); ?></a> |<?php endif; ?>
          <a href="javascript:void(0);" onclick="SocialEngine.Polls.getPollData(<?php echo $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_id']; ?>
);"><?php echo SELanguage::_get(2500032); ?></a>
        </div>
        
                <div id="poll<?php echo $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_id']; ?>
_results_actions" style='padding: 5px; margin-top: 10px; display:none;'>
          <a href="javascript:void(0);" onclick="SocialEngine.Polls.pollVoteMode(<?php echo $this->_tpl_vars['polls'][$this->_sections['polls_loop']['index']]->poll_info['poll_id']; ?>
);"><?php echo SELanguage::_get(2500087); ?></a>
        </div>
        
      </td>
    </tr>
  </table>
  <br />

<?php endfor; endif; 
 if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div class='center'>
    <?php if ($this->_tpl_vars['p'] != 1): ?>
      <a href='polls.php?user=<?php echo $this->_tpl_vars['owner']->user_info['user_username']; ?>
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
      <a href='polls.php?user=<?php echo $this->_tpl_vars['owner']->user_info['user_username']; ?>
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