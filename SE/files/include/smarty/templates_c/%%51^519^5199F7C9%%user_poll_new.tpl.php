<?php /* Smarty version 2.6.14, created on 2010-05-31 03:03:25
         compiled from user_poll_new.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'user_poll_new.tpl', 74, false),)), $this);
?><?php
SELanguage::_preload_multi(2500075,2500076,126,2500070,2500079,2500098,2500059,2500060,2500061,2500062,2500063,2500064,2500065,2500066,2500078,2500080,2500081,39);
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
  <div class='page_header'><?php echo SELanguage::_get(2500075); ?></div>
  <div><?php echo SELanguage::_get(2500076); ?></div>
  <div><?php echo SELanguage::_get(126); ?> <?php echo $this->_tpl_vars['setting']['setting_poll_html']; ?>
</div>

</td>
<td valign='top' align='right'>

  <table cellpadding='0' cellspacing='0' width='130'>
  <tr><td class='button' nowrap='nowrap'><a href='user_poll.php'><img src='./images/icons/back16.gif' border='0' class='button'><?php echo SELanguage::_get(2500070); ?></a></td></tr>
  </table>

</td>
</tr>
</table>
<br />


<?php if (! empty ( $this->_tpl_vars['is_error'] )): ?>
  <table cellpadding='0' cellspacing='0'><tr>
    <td class='error'><img src='./images/error.gif' border='0' class='icon'>
      <?php if (! empty ( $this->_tpl_vars['is_error_sprintf_1'] )): ?>
        <?php echo sprintf(SELanguage::_get($this->_tpl_vars['is_error']), $this->_tpl_vars['is_error_sprintf_1']); ?>
      <?php else: ?>
        <?php echo SELanguage::_get($this->_tpl_vars['is_error']); ?>
      <?php endif; ?>
    </td>
  </tr></table>
  <br />
<?php endif; 
 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(2500079,2500098));
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

<div id="sePollsOptionTemplate" style="display: none;">
  <div class="sePollsOption" style='margin-top: 5px;'>
    <?php echo SELanguage::_get(2500079); ?> <span class="sePollsIndex"></span>:<br />
    <input type='text' class='text' name='poll_options[]' maxlength='200' style='width: 300px; margin-top: 3px;' />
  </div>
</div>


<form action='user_poll_new.php' method='post'>
<table cellpadding='0' cellspacing='0'>
<tr>
<td class='form1'><?php echo SELanguage::_get(2500059); ?></td>
<td class='form2'><input type='text' name='poll_title' class='text' maxlength='200' value='<?php echo $this->_tpl_vars['poll_title']; ?>
' style='width: 300px;'></td>
</tr>
<tr>
<td class='form1'><?php echo SELanguage::_get(2500060); ?></td>
<td class='form2'>
  <textarea name='poll_desc' rows='5' cols='50' class='text' style='width: 300px;'><?php echo $this->_tpl_vars['poll_desc']; ?>
</textarea>
  <br>
    <?php if (count($this->_tpl_vars['privacy_options']) > 1 || count($this->_tpl_vars['comment_options']) > 1): ?>
    <div id='settings_show' class='poll_settings_link'>
      <a href="javascript:void(0);" onclick="javascript:$('entry_settings').style.display='block';$('settings_show').style.display='none';"><?php echo SELanguage::_get(2500061); ?></a>
    </div>
  <?php endif; ?>

  <div id='entry_settings' class='poll_settings' style='display: none; margin-top: 7px;'>
        <?php if ($this->_tpl_vars['user']->level_info['level_poll_search'] == 1): ?>
      <b><?php echo SELanguage::_get(2500062); ?></b>
      <table cellpadding='0' cellspacing='0'>
        <tr>
          <td><input type='radio' name='poll_search' id='poll_search_1' value='1' <?php if ($this->_tpl_vars['poll_search']): ?> checked='checked'<?php endif; ?>></td>
          <td><label for='poll_search_1'><?php echo SELanguage::_get(2500063); ?></label></td>
        </tr>
        <tr>
          <td><input type='radio' name='poll_search' id='poll_search_0' value='0' <?php if (! $this->_tpl_vars['poll_search']): ?> checked='checked'<?php endif; ?>></td>
          <td><label for='poll_search_0'><?php echo SELanguage::_get(2500064); ?></label></td>
        </tr>
      </table>
    <?php endif; ?>

        <?php if ($this->_tpl_vars['user']->level_info['level_poll_search'] == 1 && ( count($this->_tpl_vars['privacy_options']) > 1 || count($this->_tpl_vars['comment_options']) > 1 )): ?><br><?php endif; ?>

        <?php if (count($this->_tpl_vars['privacy_options']) > 1): ?>
      <b><?php echo SELanguage::_get(2500065); ?></b>
      <table cellpadding='0' cellspacing='0'>
      <?php $_from = $this->_tpl_vars['privacy_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['privacy_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['privacy_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['privacy_loop']['iteration']++;
?>
        <tr>
        <td><input type='radio' name='poll_privacy' id='privacy_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['poll_privacy'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
        <td><label for='privacy_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
        </tr>
      <?php endforeach; endif; unset($_from); ?>
      </table>
    <?php endif; ?>

        <?php if (count($this->_tpl_vars['privacy_options']) > 1 && count($this->_tpl_vars['comment_options']) > 1): ?><br><?php endif; ?>

        <?php if (count($this->_tpl_vars['comment_options']) > 1): ?>
      <b><?php echo SELanguage::_get(2500066); ?></b>
      <table cellpadding='0' cellspacing='0'>
      <?php $_from = $this->_tpl_vars['comment_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['comment_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['comment_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['comment_loop']['iteration']++;
?>
        <tr>
        <td><input type='radio' name='poll_comments' id='comments_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['poll_comments'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
        <td><label for='comments_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
        </tr>
      <?php endforeach; endif; unset($_from); ?>
      </table>
    <?php endif; ?>
  </div>

</td>
</tr>
<tr>
<td class='form1'><?php echo SELanguage::_get(2500078); ?></td>
<td class='form2'>
  <div id='sePollOptions' style="margin-top: 2px;">
    
    <?php unset($this->_sections['poll_options_loop']);
$this->_sections['poll_options_loop']['name'] = 'poll_options_loop';
$this->_sections['poll_options_loop']['loop'] = is_array($_loop=$this->_tpl_vars['poll_options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['poll_options_loop']['show'] = true;
$this->_sections['poll_options_loop']['max'] = $this->_sections['poll_options_loop']['loop'];
$this->_sections['poll_options_loop']['step'] = 1;
$this->_sections['poll_options_loop']['start'] = $this->_sections['poll_options_loop']['step'] > 0 ? 0 : $this->_sections['poll_options_loop']['loop']-1;
if ($this->_sections['poll_options_loop']['show']) {
    $this->_sections['poll_options_loop']['total'] = $this->_sections['poll_options_loop']['loop'];
    if ($this->_sections['poll_options_loop']['total'] == 0)
        $this->_sections['poll_options_loop']['show'] = false;
} else
    $this->_sections['poll_options_loop']['total'] = 0;
if ($this->_sections['poll_options_loop']['show']):

            for ($this->_sections['poll_options_loop']['index'] = $this->_sections['poll_options_loop']['start'], $this->_sections['poll_options_loop']['iteration'] = 1;
                 $this->_sections['poll_options_loop']['iteration'] <= $this->_sections['poll_options_loop']['total'];
                 $this->_sections['poll_options_loop']['index'] += $this->_sections['poll_options_loop']['step'], $this->_sections['poll_options_loop']['iteration']++):
$this->_sections['poll_options_loop']['rownum'] = $this->_sections['poll_options_loop']['iteration'];
$this->_sections['poll_options_loop']['index_prev'] = $this->_sections['poll_options_loop']['index'] - $this->_sections['poll_options_loop']['step'];
$this->_sections['poll_options_loop']['index_next'] = $this->_sections['poll_options_loop']['index'] + $this->_sections['poll_options_loop']['step'];
$this->_sections['poll_options_loop']['first']      = ($this->_sections['poll_options_loop']['iteration'] == 1);
$this->_sections['poll_options_loop']['last']       = ($this->_sections['poll_options_loop']['iteration'] == $this->_sections['poll_options_loop']['total']);
?>
      <div id="sePolls_option_<?php echo $this->_sections['poll_options_loop']['iteration']; ?>
" class="sePollsOption"<?php if ($this->_sections['poll_options_loop']['first'] != true): ?> style='margin-top: 5px;'<?php endif; ?>>
        <?php echo SELanguage::_get(2500079); ?> <?php echo $this->_sections['poll_options_loop']['iteration']; ?>
:<br>
        <input type='text' name='poll_options[]' value='<?php echo $this->_tpl_vars['poll_options'][$this->_sections['poll_options_loop']['index']]; ?>
' class='text' maxlength='200' style='width: 300px; margin-top: 3px;'>
      </div>
    <?php endfor; endif; ?>
    
  </div>
  
  <div style='margin-top: 3px;'>
    <a href='javascript:void(0);' onClick="SocialEngine.Polls.newPollOption();"><?php echo SELanguage::_get(2500080); ?></a>
  </div>
</td>
</tr>
<tr>
<td class='form1'>&nbsp;</td>
<td class='form2'>

  <table cellpadding='0' cellspacing='0'>
  <tr>
  <td>
    <?php $this->assign('langBlockTemp', SE_Language::_get(2500081));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
'><?php 

  ?>&nbsp;
    <input type='hidden' name='task' value='doadd'>
    </form>
  </td>
  <td>
    <form action='user_poll.php' method='get'><?php $this->assign('langBlockTemp', SE_Language::_get(39));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
'><?php 

  ?>
    </form>
  </td>
  </tr>
  </table>

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