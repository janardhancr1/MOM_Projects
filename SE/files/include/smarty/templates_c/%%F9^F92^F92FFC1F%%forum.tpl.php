<?php /* Smarty version 2.6.14, created on 2010-06-04 02:23:45
         compiled from forum.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'forum.tpl', 33, false),)), $this);
?><?php
SELanguage::_preload_multi(6000056,6000114,6000113,6000057,6000058,6000059,6000060,6000008,6000095,1071,835);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>

<div class='page_header'><img src='./images/icons/forum_forum16_1.gif' border='0' class='icon_big'><?php echo SELanguage::_get(6000056); ?>
<div class="page_header_small">Share your opinion on products and services moms use daily</div>
</div>

<?php if ($this->_tpl_vars['setting']['setting_forum_status'] == 2 && ! $this->_tpl_vars['forum_is_moderator']): ?>

  <br>
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='result'><img src='./images/icons/bulb16.gif' class='icon'><?php echo SELanguage::_get(6000114); ?></td>
  </table>

<?php else: ?>


    <?php if ($this->_tpl_vars['setting']['setting_forum_status'] == 2): ?>
    <table cellpadding='0' cellspacing='0'>
    <tr><td class='result' style='text-align: left;'><?php echo SELanguage::_get(6000113); ?></td>
    </table>
  <?php endif; ?>

    <?php unset($this->_sections['forumcat_loop']);
$this->_sections['forumcat_loop']['name'] = 'forumcat_loop';
$this->_sections['forumcat_loop']['loop'] = is_array($_loop=$this->_tpl_vars['forumcats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['forumcat_loop']['show'] = true;
$this->_sections['forumcat_loop']['max'] = $this->_sections['forumcat_loop']['loop'];
$this->_sections['forumcat_loop']['step'] = 1;
$this->_sections['forumcat_loop']['start'] = $this->_sections['forumcat_loop']['step'] > 0 ? 0 : $this->_sections['forumcat_loop']['loop']-1;
if ($this->_sections['forumcat_loop']['show']) {
    $this->_sections['forumcat_loop']['total'] = $this->_sections['forumcat_loop']['loop'];
    if ($this->_sections['forumcat_loop']['total'] == 0)
        $this->_sections['forumcat_loop']['show'] = false;
} else
    $this->_sections['forumcat_loop']['total'] = 0;
if ($this->_sections['forumcat_loop']['show']):

            for ($this->_sections['forumcat_loop']['index'] = $this->_sections['forumcat_loop']['start'], $this->_sections['forumcat_loop']['iteration'] = 1;
                 $this->_sections['forumcat_loop']['iteration'] <= $this->_sections['forumcat_loop']['total'];
                 $this->_sections['forumcat_loop']['index'] += $this->_sections['forumcat_loop']['step'], $this->_sections['forumcat_loop']['iteration']++):
$this->_sections['forumcat_loop']['rownum'] = $this->_sections['forumcat_loop']['iteration'];
$this->_sections['forumcat_loop']['index_prev'] = $this->_sections['forumcat_loop']['index'] - $this->_sections['forumcat_loop']['step'];
$this->_sections['forumcat_loop']['index_next'] = $this->_sections['forumcat_loop']['index'] + $this->_sections['forumcat_loop']['step'];
$this->_sections['forumcat_loop']['first']      = ($this->_sections['forumcat_loop']['iteration'] == 1);
$this->_sections['forumcat_loop']['last']       = ($this->_sections['forumcat_loop']['iteration'] == $this->_sections['forumcat_loop']['total']);
?>
    <?php if (count($this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums']) != 0): ?>
      <div class='forum_wrapper'>
      <table cellpadding='0' cellspacing='0' width='100%'>
      <tr><td class='forum_cat' colspan='5'><?php echo SELanguage::_get($this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forumcat_title']); ?></td></tr>
      <tr>
      <td class='forum_label' style='width: 1px;' nowrap='nowrap'>&nbsp;</td>
      <td class='forum_label' style='width: 50%;' nowrap='nowrap'><?php echo SELanguage::_get(6000057); ?></td>
      <td class='forum_label' style='text-align: center;' nowrap='nowrap'><?php echo SELanguage::_get(6000058); ?></td>
      <td class='forum_label' style='text-align: center;' nowrap='nowrap'><?php echo SELanguage::_get(6000059); ?></td>
      <td class='forum_label' style='width: 50%;' nowrap='nowrap'><?php echo SELanguage::_get(6000060); ?></td>
      </tr>

            <?php unset($this->_sections['forum_loop']);
$this->_sections['forum_loop']['name'] = 'forum_loop';
$this->_sections['forum_loop']['loop'] = is_array($_loop=$this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['forum_loop']['show'] = true;
$this->_sections['forum_loop']['max'] = $this->_sections['forum_loop']['loop'];
$this->_sections['forum_loop']['step'] = 1;
$this->_sections['forum_loop']['start'] = $this->_sections['forum_loop']['step'] > 0 ? 0 : $this->_sections['forum_loop']['loop']-1;
if ($this->_sections['forum_loop']['show']) {
    $this->_sections['forum_loop']['total'] = $this->_sections['forum_loop']['loop'];
    if ($this->_sections['forum_loop']['total'] == 0)
        $this->_sections['forum_loop']['show'] = false;
} else
    $this->_sections['forum_loop']['total'] = 0;
if ($this->_sections['forum_loop']['show']):

            for ($this->_sections['forum_loop']['index'] = $this->_sections['forum_loop']['start'], $this->_sections['forum_loop']['iteration'] = 1;
                 $this->_sections['forum_loop']['iteration'] <= $this->_sections['forum_loop']['total'];
                 $this->_sections['forum_loop']['index'] += $this->_sections['forum_loop']['step'], $this->_sections['forum_loop']['iteration']++):
$this->_sections['forum_loop']['rownum'] = $this->_sections['forum_loop']['iteration'];
$this->_sections['forum_loop']['index_prev'] = $this->_sections['forum_loop']['index'] - $this->_sections['forum_loop']['step'];
$this->_sections['forum_loop']['index_next'] = $this->_sections['forum_loop']['index'] + $this->_sections['forum_loop']['step'];
$this->_sections['forum_loop']['first']      = ($this->_sections['forum_loop']['iteration'] == 1);
$this->_sections['forum_loop']['last']       = ($this->_sections['forum_loop']['iteration'] == $this->_sections['forum_loop']['total']);
?>
        <tr>
        <td class='forum_list0' style='vertical-align: top;'><?php if ($this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['is_read']): ?><img src='./images/icons/forum_old32.gif' border='0'><?php else: ?><img src='./images/icons/forum_new32.gif' border='0'><?php endif; ?></td>
        <td class='forum_list1' style='vertical-align: top;'>
          <div class='forum_list_title'><a href='forum_view.php?forum_id=<?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['forum_id']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['forum_title']); ?></a></div>
          <div class='forum_list_desc'><?php echo SELanguage::_get($this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['forum_desc']); ?></div>
          <?php if (count($this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['forum_mods']) != 0): ?>
           <div class='forum_list_moderators'>
              <?php echo SELanguage::_get(6000008); ?> 
              <?php unset($this->_sections['mod_loop']);
$this->_sections['mod_loop']['name'] = 'mod_loop';
$this->_sections['mod_loop']['loop'] = is_array($_loop=$this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['forum_mods']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['mod_loop']['show'] = true;
$this->_sections['mod_loop']['max'] = $this->_sections['mod_loop']['loop'];
$this->_sections['mod_loop']['step'] = 1;
$this->_sections['mod_loop']['start'] = $this->_sections['mod_loop']['step'] > 0 ? 0 : $this->_sections['mod_loop']['loop']-1;
if ($this->_sections['mod_loop']['show']) {
    $this->_sections['mod_loop']['total'] = $this->_sections['mod_loop']['loop'];
    if ($this->_sections['mod_loop']['total'] == 0)
        $this->_sections['mod_loop']['show'] = false;
} else
    $this->_sections['mod_loop']['total'] = 0;
if ($this->_sections['mod_loop']['show']):

            for ($this->_sections['mod_loop']['index'] = $this->_sections['mod_loop']['start'], $this->_sections['mod_loop']['iteration'] = 1;
                 $this->_sections['mod_loop']['iteration'] <= $this->_sections['mod_loop']['total'];
                 $this->_sections['mod_loop']['index'] += $this->_sections['mod_loop']['step'], $this->_sections['mod_loop']['iteration']++):
$this->_sections['mod_loop']['rownum'] = $this->_sections['mod_loop']['iteration'];
$this->_sections['mod_loop']['index_prev'] = $this->_sections['mod_loop']['index'] - $this->_sections['mod_loop']['step'];
$this->_sections['mod_loop']['index_next'] = $this->_sections['mod_loop']['index'] + $this->_sections['mod_loop']['step'];
$this->_sections['mod_loop']['first']      = ($this->_sections['mod_loop']['iteration'] == 1);
$this->_sections['mod_loop']['last']       = ($this->_sections['mod_loop']['iteration'] == $this->_sections['mod_loop']['total']);
?>
                <?php if ($this->_sections['mod_loop']['first'] != TRUE): ?>, <?php endif; ?>
                <a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['forum_mods'][$this->_sections['mod_loop']['index']]->user_info['user_username']); ?>
'><?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['forum_mods'][$this->_sections['mod_loop']['index']]->user_displayname; ?>
</a>
              <?php endfor; endif; ?>
            </div>
          <?php endif; ?>

        </td>
        <td class='forum_list1' style='text-align: center;'><?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['forum_totaltopics']; ?>
</td>
        <td class='forum_list1' style='text-align: center;'><?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['forum_totalreplies']; ?>
</td>
        <td class='forum_list1'>
  
	  	  <?php if ($this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost']): ?>

                        <?php if ($this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['author']->user_exists): ?>

              <table cellpadding='0' cellspacing='0'>
              <tr>
              <td class='forum_list_photo'><img src='<?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['author']->user_photo("./images/nophoto.gif"); ?>
' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['author']->user_photo("./images/nophoto.gif"),'40','40','w'); ?>
'></td>
              <td class='forum_list_lastpost'>
                <a href='forum_topic.php?forum_id=<?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['forum_id']; ?>
&topic_id=<?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['forumtopic_id']; ?>
&post_id=<?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['forumpost_id']; ?>
#post_<?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['forumpost_id']; ?>
'><?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['forumtopic_subject']; ?>
</a>
	        <?php ob_start(); ?><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['author']->user_info['user_username']); ?>
'><?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['author']->user_displayname; ?>
</a><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('lastpost_user', ob_get_contents());ob_end_clean(); ?>
                <div>
	          <?php echo sprintf(SELanguage::_get(6000095), $this->_tpl_vars['lastpost_user']); ?>
	          <?php $this->assign('lastpost_date_basic', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['forumpost_date'])); ?>
	          - <?php echo sprintf(SELanguage::_get($this->_tpl_vars['lastpost_date_basic'][0]), $this->_tpl_vars['lastpost_date_basic'][1]); ?>
                </div>
              </td>
              </tr>
              </table>

	    	    <?php else: ?>

              <table cellpadding='0' cellspacing='0'>
              <tr>
              <td class='forum_list_photo'><img src='./images/nophoto.gif' width='40'></td>
              <td class='forum_list_lastpost'>
                <a href='forum_topic.php?forum_id=<?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['forum_id']; ?>
&topic_id=<?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['forumtopic_id']; ?>
&post_id=<?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['forumpost_id']; ?>
#post_<?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['forumpost_id']; ?>
'><?php echo $this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['forumtopic_subject']; ?>
</a>
	        <?php ob_start(); 
 if ($this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['forumpost_authoruser_id'] != 0): 
 echo SELanguage::_get(1071); 
 else: 
 echo SELanguage::_get(835); 
 endif; 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('lastpost_user', ob_get_contents());ob_end_clean(); ?>
                <div>
	          <?php echo sprintf(SELanguage::_get(6000095), $this->_tpl_vars['lastpost_user']); ?>
	          <?php $this->assign('lastpost_date_basic', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['forumcats'][$this->_sections['forumcat_loop']['index']]['forums'][$this->_sections['forum_loop']['index']]['lastpost_info']['forumpost_date'])); ?>
	          - <?php echo sprintf(SELanguage::_get($this->_tpl_vars['lastpost_date_basic'][0]), $this->_tpl_vars['lastpost_date_basic'][1]); ?>
                </div>
              </td>
              </tr>
              </table>

	    <?php endif; ?>

	  	  <?php else: ?>

	  <?php endif; ?>
        </td>
        </tr>
      <?php endfor; endif; ?>

      </table>
      </div>
    <?php endif; ?>
  <?php endfor; endif; 
 endif; ?>
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