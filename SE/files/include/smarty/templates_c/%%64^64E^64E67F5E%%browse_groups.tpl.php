<?php /* Smarty version 2.6.14, created on 2010-05-26 14:32:00
         compiled from browse_groups.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'browse_groups.tpl', 56, false),array('modifier', 'strip_tags', 'browse_groups.tpl', 105, false),array('modifier', 'truncate', 'browse_groups.tpl', 105, false),array('function', 'math', 'browse_groups.tpl', 71, false),)), $this);
?><?php
SELanguage::_preload_multi(2000007,1000128,2000127,2000128,1000131,2000129,2000130,2000132,182,184,185,183,2000133,2000134);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'><img src='./images/icons/group_group48.gif' border='0' class='icon_big'><?php echo SELanguage::_get(2000007); ?>
<div class="page_header_small">Find a group to join or create a new one and invite your friends.</div>
</div>
<div style='padding-left: 50px;padding-top:10px;padding-bottom:10px' >

</div>
<div>

<div style='float:left;padding: 10px; background: #F2F2F2; border: 1px solid #BBBBBB; font-weight: bold;width:650px'>

    <div style='float:left;text-align: center; line-height: 16px;width:30%'>
      <?php echo SELanguage::_get(1000128); ?>&nbsp;
      <select class='group_small' name='v' onchange="window.location.href='browse_groups.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v='+this.options[this.selectedIndex].value;">
      <option value='0'<?php if ($this->_tpl_vars['v'] == '0'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(2000127); ?></option>
      <?php if ($this->_tpl_vars['user']->user_exists): ?><option value='1'<?php if ($this->_tpl_vars['v'] == '1'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(2000128); ?></option><?php endif; ?>
      </select>
    </div>

    <div style='float:left;text-align: center; line-height: 16px;padding-left:5px;width:30%'>
      <?php echo SELanguage::_get(1000131); ?>&nbsp;
      <select class='group_small' name='s' onchange="window.location.href='browse_groups.php?v=<?php echo $this->_tpl_vars['v']; ?>
&s='+this.options[this.selectedIndex].value;">
      <option value='group_totalmembers DESC'<?php if ($this->_tpl_vars['s'] == 'group_totalmembers DESC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(2000129); ?></option>
      <option value='group_datecreated DESC'<?php if ($this->_tpl_vars['s'] == 'group_datecreated DESC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(2000130); ?></option>
      </select>
    </div>
    
    <div style='float:left;text-align: center; line-height: 16px;padding-left:5px;width:20%'>
      Groups:
      <select class='group_small' name='grpCart' onchange="window.location.href='browse_groups.php?v=<?php echo $this->_tpl_vars['v']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&groupcat_id='+this.options[this.selectedIndex].value;">
      <?php unset($this->_sections['cat_loop']);
$this->_sections['cat_loop']['name'] = 'cat_loop';
$this->_sections['cat_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cat_loop']['show'] = true;
$this->_sections['cat_loop']['max'] = $this->_sections['cat_loop']['loop'];
$this->_sections['cat_loop']['step'] = 1;
$this->_sections['cat_loop']['start'] = $this->_sections['cat_loop']['step'] > 0 ? 0 : $this->_sections['cat_loop']['loop']-1;
if ($this->_sections['cat_loop']['show']) {
    $this->_sections['cat_loop']['total'] = $this->_sections['cat_loop']['loop'];
    if ($this->_sections['cat_loop']['total'] == 0)
        $this->_sections['cat_loop']['show'] = false;
} else
    $this->_sections['cat_loop']['total'] = 0;
if ($this->_sections['cat_loop']['show']):

            for ($this->_sections['cat_loop']['index'] = $this->_sections['cat_loop']['start'], $this->_sections['cat_loop']['iteration'] = 1;
                 $this->_sections['cat_loop']['iteration'] <= $this->_sections['cat_loop']['total'];
                 $this->_sections['cat_loop']['index'] += $this->_sections['cat_loop']['step'], $this->_sections['cat_loop']['iteration']++):
$this->_sections['cat_loop']['rownum'] = $this->_sections['cat_loop']['iteration'];
$this->_sections['cat_loop']['index_prev'] = $this->_sections['cat_loop']['index'] - $this->_sections['cat_loop']['step'];
$this->_sections['cat_loop']['index_next'] = $this->_sections['cat_loop']['index'] + $this->_sections['cat_loop']['step'];
$this->_sections['cat_loop']['first']      = ($this->_sections['cat_loop']['iteration'] == 1);
$this->_sections['cat_loop']['last']       = ($this->_sections['cat_loop']['iteration'] == $this->_sections['cat_loop']['total']);
?>
      <option value='$cats[cat_loop].cat_id'><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_title']); ?></option>
      <?php unset($this->_sections['subcat_loop']);
$this->_sections['subcat_loop']['name'] = 'subcat_loop';
$this->_sections['subcat_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['subcat_loop']['show'] = true;
$this->_sections['subcat_loop']['max'] = $this->_sections['subcat_loop']['loop'];
$this->_sections['subcat_loop']['step'] = 1;
$this->_sections['subcat_loop']['start'] = $this->_sections['subcat_loop']['step'] > 0 ? 0 : $this->_sections['subcat_loop']['loop']-1;
if ($this->_sections['subcat_loop']['show']) {
    $this->_sections['subcat_loop']['total'] = $this->_sections['subcat_loop']['loop'];
    if ($this->_sections['subcat_loop']['total'] == 0)
        $this->_sections['subcat_loop']['show'] = false;
} else
    $this->_sections['subcat_loop']['total'] = 0;
if ($this->_sections['subcat_loop']['show']):

            for ($this->_sections['subcat_loop']['index'] = $this->_sections['subcat_loop']['start'], $this->_sections['subcat_loop']['iteration'] = 1;
                 $this->_sections['subcat_loop']['iteration'] <= $this->_sections['subcat_loop']['total'];
                 $this->_sections['subcat_loop']['index'] += $this->_sections['subcat_loop']['step'], $this->_sections['subcat_loop']['iteration']++):
$this->_sections['subcat_loop']['rownum'] = $this->_sections['subcat_loop']['iteration'];
$this->_sections['subcat_loop']['index_prev'] = $this->_sections['subcat_loop']['index'] - $this->_sections['subcat_loop']['step'];
$this->_sections['subcat_loop']['index_next'] = $this->_sections['subcat_loop']['index'] + $this->_sections['subcat_loop']['step'];
$this->_sections['subcat_loop']['first']      = ($this->_sections['subcat_loop']['iteration'] == 1);
$this->_sections['subcat_loop']['last']       = ($this->_sections['subcat_loop']['iteration'] == $this->_sections['subcat_loop']['total']);
?>
      <option value='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats'][$this->_sections['subcat_loop']['index']]['subcat_id']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats'][$this->_sections['subcat_loop']['index']]['subcat_title']); ?></option>
      <?php endfor; endif; ?>
      <?php endfor; endif; ?>
      </select>
    </div>
    
    <div style='float:left; line-height: 16px;padding-left:15px;width:15%'>
     <div class='mom_div_small'><a href='user_group.php' class='mom_div_small'><img src='./images/icons/plus16.gif' border='0' class='button'>My Groups</a></div>
    </div>

	
  </div>
<div style='float:left;width:670px'>
<table cellpadding='0' cellspacing='0' width='100%' style='margin-top: 10px;'>
<tr>
<td style='vertical-align: top; width:100%'>

    <?php if (count($this->_tpl_vars['groups']) == 0): ?>
    <br>
    <table cellpadding='0' cellspacing='0' align='center'>
      <tr>
        <td class='result'>
          <img src='./images/icons/bulb16.gif' border='0' class='icon' />
          <?php echo SELanguage::_get(2000132); ?>
        </td>
      </tr>
    </table>
  <?php endif; ?>

    <?php if ($this->_tpl_vars['maxpage'] > 1): ?>
    <div class='group_pages_top'>
    <?php if ($this->_tpl_vars['p'] != 1): ?><a href='browse_groups.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&groupcat_id=<?php echo $this->_tpl_vars['groupcat_id']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?>&#171; <?php echo SELanguage::_get(182); 
 endif; ?>
    &nbsp;|&nbsp;&nbsp;
    <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
      <b><?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_groups']); ?></b>
    <?php else: ?>
      <b><?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_groups']); ?></b>
    <?php endif; ?>
    &nbsp;&nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?><a href='browse_groups.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&groupcat_id=<?php echo $this->_tpl_vars['groupcat_id']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: 
 echo SELanguage::_get(183); ?> &#187;<?php endif; ?>
    </div>
  <?php endif; ?>

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
  <div style='padding: 10px; border: 1px solid #CCCCCC; margin-bottom: 10px;'>
    <table cellpadding='0' cellspacing='0'>
      <tr>
        <td>
          <a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_id']); ?>
'>
            <img src='<?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_photo("./images/nophoto.gif",'TRUE'); ?>
' border='0' width='60' height='60' />
          </a>
        </td>
        <td style='vertical-align: top; padding-left: 10px;'>
          <div style='font-weight: bold; font-size: 13px;'>
            <a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_id']); ?>
'>
              <?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_title']; ?>

            </a>
          </div>
          <div style='color: #777777; font-size: 9px; margin-bottom: 5px;'>
            <?php $this->assign('group_dateupdated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_dateupdated'])); ?>
            <?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['group_dateupdated'][0]), $this->_tpl_vars['group_dateupdated'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('updated', ob_get_contents());ob_end_clean(); ?>
            <?php ob_start(); ?><a href='<?php echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group_leader']->user_info['user_username']); ?>
'><?php echo $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group_leader']->user_displayname; ?>
</a><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('group_leader', ob_get_contents());ob_end_clean(); ?>
            <?php echo sprintf(SELanguage::_get(2000133), $this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group_members'], $this->_tpl_vars['group_leader']); ?> - <?php echo sprintf(SELanguage::_get(2000134), $this->_tpl_vars['updated']); ?>
          </div>
          <div>
            <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['groups'][$this->_sections['group_loop']['index']]['group']->group_info['group_desc'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 300, "...", true) : smarty_modifier_truncate($_tmp, 300, "...", true)); ?>

          </div>
        </td>
      </tr>
    </table>
  </div>
  <?php endfor; endif; ?>

    <?php if ($this->_tpl_vars['maxpage'] > 1): ?>
    <div class='group_pages_bottom'>
    <?php if ($this->_tpl_vars['p'] != 1): ?><a href='browse_groups.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&groupcat_id=<?php echo $this->_tpl_vars['groupcat_id']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a><?php else: ?>&#171; <?php echo SELanguage::_get(182); 
 endif; ?>
    &nbsp;|&nbsp;&nbsp;
    <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
      <b><?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_groups']); ?></b>
    <?php else: ?>
      <b><?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_groups']); ?></b>
    <?php endif; ?>
    &nbsp;&nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?><a href='browse_groups.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&groupcat_id=<?php echo $this->_tpl_vars['groupcat_id']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a><?php else: 
 echo SELanguage::_get(183); ?> &#187;<?php endif; ?>
    </div>
  <?php endif; ?>

</td>
</tr>
</table>
</div>
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