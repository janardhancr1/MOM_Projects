<?php /* Smarty version 2.6.14, created on 2010-06-24 16:58:35
         compiled from browse_polls.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'browse_polls.tpl', 80, false),array('modifier', 'escape', 'browse_polls.tpl', 92, false),array('function', 'cycle', 'browse_polls.tpl', 99, false),)), $this);
?><?php
SELanguage::_preload_multi(2500005,2500101,2500103,2500104,2500102,2500105,2500106,2500107,2500108,2500028,507,949);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'><img src='./images/icons/poll_poll48.gif' border='0' class='icon_big'><?php echo SELanguage::_get(2500005); ?>
<div class="page_header_small">Create a Poll or Tell Others What you Think</div>
</div>

<div style='padding: 7px 10px 7px 10px; background: #F2F2F2; border: 1px solid #BBBBBB; margin: 10px 0px 10px 0px; font-weight: bold;'>
  	<table cellpadding='0' cellspacing='0' width='100%'>
  	<tr>
  		<td width="50%">
			<table cellpadding='0' cellspacing='0'>
			<tr>
		  		<td>
		    		<?php echo SELanguage::_get(2500101); ?>&nbsp;
		  		</td>
		  		<td>
		    		<select class='small' name='v' onchange="window.location.href='browse_polls.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v='+this.options[this.selectedIndex].value;">
		      			<option value='0'<?php if ($this->_tpl_vars['v'] == '0'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(2500103); ?></option>
		      			<?php if ($this->_tpl_vars['user']->user_exists): ?><option value='1'<?php if ($this->_tpl_vars['v'] == '1'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(2500104); ?></option><?php endif; ?>
		    		</select>
		  		</td>
		  		<td style='padding-left: 20px;'>
		    		<?php echo SELanguage::_get(2500102); ?>&nbsp;
		  		</td>
		  		<td>
			    	<select class='small' name='s' onchange="window.location.href='browse_polls.php?v=<?php echo $this->_tpl_vars['v']; ?>
&s='+this.options[this.selectedIndex].value;">
			      		<option value='poll_datecreated DESC'<?php if ($this->_tpl_vars['s'] == 'poll_datecreated DESC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(2500105); ?></option>
			      		<option value='poll_totalvotes DESC'<?php if ($this->_tpl_vars['s'] == 'poll_totalvotes DESC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(2500106); ?></option>
			      		<option value='poll_views DESC'<?php if ($this->_tpl_vars['s'] == 'poll_views DESC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(2500107); ?></option>
			    	</select>
		  		</td>
			</tr>
		</table>
	</td>
  	<td width="50%" align="right">
	  	<table cellpadding='0' cellspacing='0'>
	  		<tr>
	  			<td>
	  				<div class='mom_div_small'><a href='user_poll.php' class='mom_div_small'><img src='./images/icons/plus16.gif' border='0' class='button'>Go to My Polls</a></div>
	  			</td>
	  		</tr>
	  	</table>
  	</td>
  </tr>
  </table>
</div>

<table width='480px'>
<tr>
<td>
	<div class='page_header_small' style='float:left;'>
		Today's Polls 
	</div>
</td>
<td>
	<div class='page_header_xxsmall' style='padding-left:30px'><a href='more_polls.php?type=todays'>Click to see more </a></div>
</td>
</td>
</tr>
</table>

<div>
  <?php if ($this->_tpl_vars['todays_total'] <= 0): ?>
  <div class='polls_browse_item' style='width: 620px; height: 80px; float: left;font-size:30px'>
  	<center>
  		No Polls Yet Today
  	<center>
  </div>
  <?php endif; ?>
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

    <div class='polls_browse_item' style='width: 310px; height: 80px; float: left;'>
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
    
    <?php echo smarty_function_cycle(array('values' => ",<div style='clear: both; height: 10px;'></div>"), $this);?>

  <?php endfor; endif; ?>

</div>
<div style='clear: both; height: 10px;'></div>
<table width='480px'>
<tr>
<td>
	<div class='page_header_small' style='float:left'>
		Most Popular Polls
	</div>
</td>
<td>
	<div class='page_header_xxsmall' style='padding-left:30px'><a href='more_polls.php?type=popular'>Click to see more </a></div>
</td>
</tr>
</table>

<?php unset($this->_sections['poll_loop']);
$this->_sections['poll_loop']['name'] = 'poll_loop';
$this->_sections['poll_loop']['loop'] = is_array($_loop=$this->_tpl_vars['popular_polls']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

    <div class='polls_browse_item' style='width: 450px; height: 30px; float: left;'>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td style='vertical-align: top; padding-left: 0px;'>
        <div style='font-weight: bold; font-size: 13px;'>
          <img src="./images/icons/poll_poll16.gif" class='button' style='float: left;'>
          <a href='<?php echo $this->_tpl_vars['url']->url_create('poll',$this->_tpl_vars['popular_polls'][$this->_sections['poll_loop']['index']]->poll_owner->user_info['user_username'],$this->_tpl_vars['popular_polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_id']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['popular_polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>
</a>
        </div>
        <div class='polls_browse_date'>
          <?php $this->assign('poll_datecreated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['popular_polls'][$this->_sections['poll_loop']['index']]->poll_info['poll_datecreated'])); 
 ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['poll_datecreated'][0]), $this->_tpl_vars['poll_datecreated'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('created', ob_get_contents());ob_end_clean(); ?>
          <?php echo sprintf(SELanguage::_get(2500108), $this->_tpl_vars['created'], $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['polls'][$this->_sections['poll_loop']['index']]->poll_owner->user_info['user_username']), $this->_tpl_vars['popular_polls'][$this->_sections['poll_loop']['index']]->poll_owner->user_displayname); ?>
        </div>
      </td>
      </tr>
      </table>
    </div>
   <div style='clear: both; height: 10px;'></div>
  <?php endfor; endif; ?>

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