<?php /* Smarty version 2.6.14, created on 2010-05-31 03:08:59
         compiled from poll.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'poll.tpl', 46, false),array('modifier', 'choptext', 'poll.tpl', 56, false),array('modifier', 'escape', 'poll.tpl', 102, false),array('modifier', 'default', 'poll.tpl', 130, false),array('function', 'counter', 'poll.tpl', 64, false),)), $this);
?><?php
SELanguage::_preload_multi(2500027,2500028,2500034,2500114,2500115,2500029,507,2500122,2500030,2500032,2500087,2500033,861,39,155,175,182,183,184,185,187,784,787,829,830,831,832,833,834,835,854,856,891,1025,1026,1032,1034,1071);
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
  
  <?php if ($this->_tpl_vars['poll_object']->poll_info['poll_viewonly']): ?>
  window.addEvent('domready', function()
  {
    SocialEngine.Polls.getPollData(<?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
);
  });
  <?php endif; ?>
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


<table cellpadding='0' cellspacing='0' width='100%'>
  <tr>
    <td valign='top' class='poll_view' id="sePoll<?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
">
      
            <div class='poll_view_title'>
        <?php echo ((is_array($_tmp=$this->_tpl_vars['poll_object']->poll_info['poll_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 75, "...", true) : smarty_modifier_truncate($_tmp, 75, "...", true)); ?>

      </div>
      <div class='poll_view_stats'>
        <?php ob_start(); ?><span id='poll<?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
_totalvotes'><?php echo $this->_tpl_vars['poll_object']->poll_info['poll_totalvotes']; ?>
</span><?php $this->_smarty_vars['capture']['totalVotesCode'] = ob_get_contents(); ob_end_clean(); ?>
        <?php echo sprintf(SELanguage::_get(2500029), $this->_tpl_vars['datetime']->cdate(($this->_tpl_vars['setting']['setting_dateformat']),$this->_tpl_vars['datetime']->timezone(($this->_tpl_vars['poll_object']->poll_info['poll_datecreated']),$this->_tpl_vars['global_timezone']))); ?>
        <?php echo sprintf(SELanguage::_get(2500028), $this->_smarty_vars['capture']['totalVotesCode']); ?>,
        <?php echo sprintf(SELanguage::_get(507), $this->_tpl_vars['total_comments']); ?>,
        <?php echo sprintf(SELanguage::_get(2500122), $this->_tpl_vars['poll_object']->poll_info['poll_views']); ?>
      </div>
      <div style='padding: 5px;'>
        <?php echo ((is_array($_tmp=$this->_tpl_vars['poll_object']->poll_info['poll_desc'])) ? $this->_run_mod_handler('choptext', true, $_tmp, 120, "<br>") : smarty_modifier_choptext($_tmp, 120, "<br>")); ?>

      </div>
      
            <div style='padding: 5px; font-weight: bold; display: none;' id='poll<?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
_results'></div>
      
            <div style='padding: 5px;' id='poll<?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
_vote'>
        <?php echo smarty_function_counter(array('start' => -1,'print' => 0), $this);?>

        <?php unset($this->_sections['options_loop']);
$this->_sections['options_loop']['name'] = 'options_loop';
$this->_sections['options_loop']['loop'] = is_array($_loop=$this->_tpl_vars['poll_object']->poll_info['poll_options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                <input type='radio' name="pollVoteSelect_<?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
" class="pollVoteOption" value='<?php echo smarty_function_counter(array(), $this);?>
'>
              </td>
              <td style='font-weight: bold;'>
                <label for='poll<?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
_option<?php echo $this->_sections['options_loop']['iteration']; ?>
'><?php echo $this->_tpl_vars['poll_object']->poll_info['poll_options'][$this->_sections['options_loop']['index']]; ?>
</label>
              </td>
            </tr></table>
          </div>
        <?php endfor; endif; ?>
      </div>
      
            <div id="poll<?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
_vote_actions" style='padding: 5px; margin-top: 10px;'>
        <?php if ($this->_tpl_vars['user']->level_info['level_poll_allow'] & 2): ?><a href="javascript:void(0);" onclick="SocialEngine.Polls.sendPollVote(<?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
);"><?php echo SELanguage::_get(2500030); ?></a> |<?php endif; ?>
        <a href="javascript:void(0);" onclick="SocialEngine.Polls.getPollData(<?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
);"><?php echo SELanguage::_get(2500032); ?></a>
      </div>
      
            <div id="poll<?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
_results_actions" style='padding: 5px; margin-top: 10px; display:none;'>
        <a href="javascript:void(0);" onclick="SocialEngine.Polls.pollVoteMode(<?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
);"><?php echo SELanguage::_get(2500087); ?></a>
      </div>
      
    </td>
  </tr>
</table>
<br />


<div>
  <a href='<?php echo $this->_tpl_vars['url']->url_create('polls',$this->_tpl_vars['owner']->user_info['user_username']); ?>
'>
    <img src='./images/icons/back16.gif' border='0' class='icon'>
    <?php echo sprintf(SELanguage::_get(2500033), $this->_tpl_vars['owner']->user_displayname); ?>
  </a>
  &nbsp;&nbsp;&nbsp;
  <?php $this->assign('langBlockTemp', SE_Language::_get(861));


  ?><a href="javascript:TB_show('<?php echo $this->_tpl_vars['langBlockTemp']; ?>
', 'user_report.php?return_url=<?php echo ((is_array($_tmp=$this->_tpl_vars['url']->url_current())) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');"><img src='./images/icons/report16.gif' border='0' class='icon'><?php echo $this->_tpl_vars['langBlockTemp']; ?>
</a><?php 

  ?>
</div>
<br />



<div style='margin-left: auto; margin-right: auto;'>

  <div id="poll_<?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
_postcomment"></div>
  <div id="poll_<?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
_comments" style='margin-left: auto; margin-right: auto;'></div>
  
  <?php 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(39,155,175,182,183,184,185,187,784,787,829,830,831,832,833,834,835,854,856,891,1025,1026,1032,1034,1071));
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
  
  <script type="text/javascript">
    
    SocialEngine.PollComments = new SocialEngineAPI.Comments({
      'canComment' : <?php if ($this->_tpl_vars['allowed_to_comment']): ?>true<?php else: ?>false<?php endif; ?>,
      'commentCode' : <?php if ($this->_tpl_vars['setting']['setting_comment_code']): ?>true<?php else: ?>false<?php endif; ?>,
      'commentHTML' : '<?php echo $this->_tpl_vars['setting']['setting_comment_html']; ?>
',
      
      'type' : 'poll',
      'typeIdentifier' : 'poll_id',
      'typeID' : <?php echo $this->_tpl_vars['poll_object']->poll_info['poll_id']; ?>
,
      
      'typeTab' : 'polls',
      'typeCol' : 'poll',
      
      'initialTotal' : <?php echo ((is_array($_tmp=@$this->_tpl_vars['total_comments'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
,
      
      'paginate' : false,
      'cpp' : 20
    });
    
    SocialEngine.RegisterModule(SocialEngine.PollComments);
    
    // Backwards
    function addComment(is_error, comment_body, comment_date)
    {
      SocialEngine.PollComments.addComment(is_error, comment_body, comment_date);
    }
    
    function getComments(direction)
    {
      SocialEngine.PollComments.getComments(direction);
    }
    
  </script>
  
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