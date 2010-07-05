<?php /* Smarty version 2.6.14, created on 2010-06-04 17:04:03
         compiled from home.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'home.tpl', 32, false),array('modifier', 'choptext', 'home.tpl', 32, false),array('modifier', 'count', 'home.tpl', 155, false),array('modifier', 'replace', 'home.tpl', 175, false),)), $this);
?><?php
SELanguage::_preload_multi(509,589,2500028,773,1113,1344,743,744,745,746,747);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>








<table width='100%' cellspacing='0' cellpadding='0'>
<tr>
<td valign='top' style='border-right: 1px solid #DDDDDD'>
<div style='float: left; width: 200px;padding-left:1px;height:600px'>
   <?php if ($this->_tpl_vars['user']->user_exists): ?>
    <div class='portal_login'>
      <div style='padding-bottom: 5px;padding-right: 5px;float:left'><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['user']->user_info['user_username']); ?>
'><img src='<?php echo $this->_tpl_vars['user']->user_photo("./images/nophoto.gif"); ?>
' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['user']->user_photo("./images/nophoto.gif"),'70','70','w'); ?>
' border='0' class='photo' alt="<?php echo sprintf(SELanguage::_get(509), $this->_tpl_vars['user']->user_info['user_username']); ?>" /></a></div>
      <div style='float:left;height:20px;width:105px;text-align:left;color: #D60077;font-size:12px'><?php echo $this->_tpl_vars['user']->user_displayname_short; ?>
</div>
      <div style='float:left;height:25px;width:105px;text-align:left;color: #BEB800'><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['user']->user_info['user_username']); ?>
' style="color: #BEB800">View My Profile</a></div>
    </div>
    <div class='portal_spacer'></div>
  <?php endif; ?>
  
    <?php if (! empty ( $this->_tpl_vars['site_statistics'] )): ?>
    <div class='header'>Today's Poll Question</div>
    <div class='portal_content'>
      <?php if (! empty ( $this->_tpl_vars['poll_info'] )): ?>
      <div style='float:left;padding-right: 5px'><img src='./images/icons/poll_poll48.gif' border='0' class='icon'></div>
      <div style='float:left'><a href='<?php echo $this->_tpl_vars['url']->url_create('poll',$this->_tpl_vars['poll_info']['SUBMITTEDBY'],$this->_tpl_vars['poll_info']['poll_id']); ?>
'><?php if ($this->_tpl_vars['poll_info']['poll_title'] == ""): 
 echo SELanguage::_get(589); 
 else: 
 echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['poll_info']['poll_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...", true) : smarty_modifier_truncate($_tmp, 20, "...", true)))) ? $this->_run_mod_handler('choptext', true, $_tmp, 20, "<br>") : smarty_modifier_choptext($_tmp, 20, "<br>")); 
 endif; ?></a></div>
      <br/>
      <div><?php echo sprintf(SELanguage::_get(2500028), $this->_tpl_vars['poll_info']['poll_totalvotes']); ?></div>
      <?php else: ?>
		No Poll Yet
		<?php endif; ?>
    </div>
    <div class='portal_spacer'></div>
  <?php endif; ?>
  
    <?php if (! empty ( $this->_tpl_vars['site_statistics'] )): ?>
    <div class='header'>Today's Recipe Post</div>
    <div class='portal_content'>
    	<?php if (! empty ( $this->_tpl_vars['recipe_info'] )): ?>
      	<div style='float:left;padding-right: 5px'><?php if (! empty ( $this->_tpl_vars['recipe_info']['recipe_photo'] )): ?>
		<img src="<?php echo $this->_tpl_vars['recipe_info']['recipe_photo']; ?>
" width="40" height="40" />
		<?php else: ?>
		<img src="./images/nophoto.gif" width="40" height="40" />
		<?php endif; ?></div>
		<div style='float:left'><a href=''>
		<a href="recipe.php?user=<?php echo $this->_tpl_vars['recipe_info']['SUBMITTEDBY']; ?>
&recipe_id=<?php echo $this->_tpl_vars['recipe_info']['recipe_id']; ?>
">
                                    <?php echo ((is_array($_tmp=$this->_tpl_vars['recipe_info']['recipe_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...", true) : smarty_modifier_truncate($_tmp, 20, "...", true)); ?>
</a></div><br/>
		<div><?php echo $this->_tpl_vars['recipe_info']['recipe_totalcomments']; ?>
&nbsp;comment(s)</div>
		<?php else: ?>
		No Recipe Yet
		<?php endif; ?>
    </div>
    <div class='portal_spacer'></div>
  <?php endif; ?>
  <div class='header'></div>
    
    <div class='portal_spacer'></div>

</div>



















</td>
<td valign='top'>
<div style='float: left; width: 485px; padding: 0px 5px 0px 5px;'>
    <div>
            <?php 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(773,1113,1344,743,744,745,746,747));
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
      <script type="text/javascript">
      <!-- 
      SocialEngine.Viewer.user_status = \''; 
 echo SELanguage::_get(1344); 
 echo '\';
      //-->
      </script>
      '; ?>

      
      <div id='ajax_status'>
      	<script>
      		SocialEngine.Viewer.userStatusChangeHome();
      	</script>
      </div>
     </div>
    <br />
    
  <?php if (count($this->_tpl_vars['actions']) > 0): ?>
    <div class='portal_whatsnew'>

            <?php if ($this->_tpl_vars['ads']->ad_feed != ""): ?>
        <div class='portal_action' style='display: block; visibility: visible; padding-bottom: 10px;'><?php echo $this->_tpl_vars['ads']->ad_feed; ?>
</div>
      <?php endif; ?>

            <?php unset($this->_sections['actions_loop']);
$this->_sections['actions_loop']['name'] = 'actions_loop';
$this->_sections['actions_loop']['loop'] = is_array($_loop=$this->_tpl_vars['actions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['actions_loop']['max'] = (int)10;
$this->_sections['actions_loop']['show'] = true;
if ($this->_sections['actions_loop']['max'] < 0)
    $this->_sections['actions_loop']['max'] = $this->_sections['actions_loop']['loop'];
$this->_sections['actions_loop']['step'] = 1;
$this->_sections['actions_loop']['start'] = $this->_sections['actions_loop']['step'] > 0 ? 0 : $this->_sections['actions_loop']['loop']-1;
if ($this->_sections['actions_loop']['show']) {
    $this->_sections['actions_loop']['total'] = min(ceil(($this->_sections['actions_loop']['step'] > 0 ? $this->_sections['actions_loop']['loop'] - $this->_sections['actions_loop']['start'] : $this->_sections['actions_loop']['start']+1)/abs($this->_sections['actions_loop']['step'])), $this->_sections['actions_loop']['max']);
    if ($this->_sections['actions_loop']['total'] == 0)
        $this->_sections['actions_loop']['show'] = false;
} else
    $this->_sections['actions_loop']['total'] = 0;
if ($this->_sections['actions_loop']['show']):

            for ($this->_sections['actions_loop']['index'] = $this->_sections['actions_loop']['start'], $this->_sections['actions_loop']['iteration'] = 1;
                 $this->_sections['actions_loop']['iteration'] <= $this->_sections['actions_loop']['total'];
                 $this->_sections['actions_loop']['index'] += $this->_sections['actions_loop']['step'], $this->_sections['actions_loop']['iteration']++):
$this->_sections['actions_loop']['rownum'] = $this->_sections['actions_loop']['iteration'];
$this->_sections['actions_loop']['index_prev'] = $this->_sections['actions_loop']['index'] - $this->_sections['actions_loop']['step'];
$this->_sections['actions_loop']['index_next'] = $this->_sections['actions_loop']['index'] + $this->_sections['actions_loop']['step'];
$this->_sections['actions_loop']['first']      = ($this->_sections['actions_loop']['iteration'] == 1);
$this->_sections['actions_loop']['last']       = ($this->_sections['actions_loop']['iteration'] == $this->_sections['actions_loop']['total']);
?>
        <div id='action_<?php echo $this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_id']; ?>
' class='portal_action<?php if ($this->_sections['actions_loop']['first']): ?>_top<?php endif; ?>'>
          <table cellpadding='0' cellspacing='0'>
          <tr>
          <td valign='top'><img src='./images/icons/<?php echo $this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_icon']; ?>
' border='0' class='icon' alt='' /></td>
          <td valign='top' width='100%'>
            <?php $this->assign('action_date', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_date'])); ?>
            <div class='portal_action_date'><?php echo sprintf(SELanguage::_get($this->_tpl_vars['action_date'][0]), $this->_tpl_vars['action_date'][1]); ?></div>
            <?php $this->assign('action_media', ''); ?>
            <?php if ($this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_media'] !== FALSE): 
 ob_start(); 
 unset($this->_sections['action_media_loop']);
$this->_sections['action_media_loop']['name'] = 'action_media_loop';
$this->_sections['action_media_loop']['loop'] = is_array($_loop=$this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_media']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['action_media_loop']['show'] = true;
$this->_sections['action_media_loop']['max'] = $this->_sections['action_media_loop']['loop'];
$this->_sections['action_media_loop']['step'] = 1;
$this->_sections['action_media_loop']['start'] = $this->_sections['action_media_loop']['step'] > 0 ? 0 : $this->_sections['action_media_loop']['loop']-1;
if ($this->_sections['action_media_loop']['show']) {
    $this->_sections['action_media_loop']['total'] = $this->_sections['action_media_loop']['loop'];
    if ($this->_sections['action_media_loop']['total'] == 0)
        $this->_sections['action_media_loop']['show'] = false;
} else
    $this->_sections['action_media_loop']['total'] = 0;
if ($this->_sections['action_media_loop']['show']):

            for ($this->_sections['action_media_loop']['index'] = $this->_sections['action_media_loop']['start'], $this->_sections['action_media_loop']['iteration'] = 1;
                 $this->_sections['action_media_loop']['iteration'] <= $this->_sections['action_media_loop']['total'];
                 $this->_sections['action_media_loop']['index'] += $this->_sections['action_media_loop']['step'], $this->_sections['action_media_loop']['iteration']++):
$this->_sections['action_media_loop']['rownum'] = $this->_sections['action_media_loop']['iteration'];
$this->_sections['action_media_loop']['index_prev'] = $this->_sections['action_media_loop']['index'] - $this->_sections['action_media_loop']['step'];
$this->_sections['action_media_loop']['index_next'] = $this->_sections['action_media_loop']['index'] + $this->_sections['action_media_loop']['step'];
$this->_sections['action_media_loop']['first']      = ($this->_sections['action_media_loop']['iteration'] == 1);
$this->_sections['action_media_loop']['last']       = ($this->_sections['action_media_loop']['iteration'] == $this->_sections['action_media_loop']['total']);
?><a href='<?php echo $this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_media'][$this->_sections['action_media_loop']['index']]['actionmedia_link']; ?>
'><img src='<?php echo $this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_media'][$this->_sections['action_media_loop']['index']]['actionmedia_path']; ?>
' border='0' width='<?php echo $this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_media'][$this->_sections['action_media_loop']['index']]['actionmedia_width']; ?>
' class='recentaction_media' alt='' /></a><?php endfor; endif; 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('action_media', ob_get_contents());ob_end_clean(); 
 endif; ?>
            <?php $this->_tpl_vars['action_text'] = vsprintf(SELanguage::_get($this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_text']), $this->_tpl_vars['actions'][$this->_sections['actions_loop']['index']]['action_vars']);; ?>
            <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['action_text'])) ? $this->_run_mod_handler('replace', true, $_tmp, "[media]", $this->_tpl_vars['action_media']) : smarty_modifier_replace($_tmp, "[media]", $this->_tpl_vars['action_media'])))) ? $this->_run_mod_handler('choptext', true, $_tmp, 50, "<br>") : smarty_modifier_choptext($_tmp, 50, "<br>")); ?>

                </td>
          </tr>
          </table>
        </div>
      <?php endfor; endif; ?>
    </div>
    <div class='portal_spacer'></div>
  <?php endif; ?>

</div>





</td>
<td valign='top'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'rightside.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td>
</tr>
</table>







<div style='clear: both;'></div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>