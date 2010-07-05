<?php /* Smarty version 2.6.14, created on 2010-06-24 16:19:18
         compiled from classifieds_home.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'classifieds_home.tpl', 15, false),)), $this);
?><?php
SELanguage::_preload_multi(4500007,646);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<div style='float: left; width: 680px; padding: 0px 5px 5px 10px;'>
<div class='page_header'><img src='./images/icons/classified_classified48.gif' border='0' class='icon_big'><?php echo SELanguage::_get(4500007); ?>
<div class="page_header_small">Classified listings are a great way to list something for sale or find items.</div>
</div>

<div class='portal_spacer'>
</div>
<div style='border: 1px solid #BBBBBB; width:98%;padding: 5px;background: #F2F2F2;'>
<form action='browse_classifieds.php' method='post' name="seBrowseClassifieds">
<input type='hidden' name='task' value='dosearch' />
<input type='hidden' name='classifiedcat_id' value='<?php echo ((is_array($_tmp=@$this->_tpl_vars['classifiedcat_id'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
' />
<input type='hidden' name='p' value='<?php echo ((is_array($_tmp=@$this->_tpl_vars['p'])) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1)); ?>
' />
<table width='100%'>
	</tr>
		<td width="75%">
			<?php echo SELanguage::_get(646); ?> <input type='text' class='qsearch' name='classified_search' value='<?php echo $this->_tpl_vars['classified_search']; ?>
' style='width:250px' onfocus="if(this.value == 'What are you looking for?') this.value='';" onblur="if(this.value.length == 0) this.value='What are you looking for?';">
			&nbsp;<input type="submit" value="<?php echo SELanguage::_get(646); ?>" class="button" />
		</td>
		<td width="25%">
			<div class='mom_div_small'><a href='user_classified.php' class='mom_div_small'><img src='./images/icons/plus16.gif' border='0' class='button'>Go To My Classifieds</a></div>
		</td>
	</tr>
	</table>	
</form>
</div>

<div class='classi_left'>
<table width='100%'>
  	<tr>
  	<td valign='top'>
  		<?php $this->assign('i', ((is_array($_tmp=@$this->_tpl_vars['i'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0))); ?>
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
  		<table>
  		<tr>
  		<td>
	  		<img src='../images/classifieds/<?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_title']); ?>.gif' border='0' alt='' >
	  	</td>
	  	<td>
	  	<a class="classi_left" href='browse_classifieds.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&classifiedcat_id=<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_id']; ?>
'>
  			<font size="2"><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_title']); ?></font>
  		</a>
  		</td>
  		</tr>
  		</table>
  		<?php $this->assign('i', $this->_tpl_vars['i']+1); ?>
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
            <div style='font-weight: normal;padding-top:1px;padding-left:5px'>
            <img src='../images/classifieds/bullet.gif' border='0' alt='' >
            <a class="classi_left" href='browse_classifieds.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&classifiedcat_id=<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats'][$this->_sections['subcat_loop']['index']]['subcat_id']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats'][$this->_sections['subcat_loop']['index']]['subcat_title']); ?></a></div>
            <?php if ($this->_tpl_vars['i'] % 34 == 0): ?>
          	</td><td valign='top'>
          <?php endif; ?>
          <?php $this->assign('i', $this->_tpl_vars['i']+1); ?>
          <?php endfor; endif; ?>
          <?php if ($this->_tpl_vars['i'] % 34 == 0): ?>
          	<br/></td><td valign='top'>
          <?php endif; ?>
  		<?php endfor; endif; ?>
  	</td>
	</tr>
	</table>
</div>
<div style='float:left;width:165px;padding:5px'>
<div class='classi_menu_link_container'>
	Most Recent Listings
</div>
<div style='background:#ECECED;color:Black;width:140px;height:500px;padding:10px'>
<div style='clear: both; height: 10px;'></div>
	<?php unset($this->_sections['classified_loop']);
$this->_sections['classified_loop']['name'] = 'classified_loop';
$this->_sections['classified_loop']['loop'] = is_array($_loop=$this->_tpl_vars['classifieds']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['classified_loop']['show'] = true;
$this->_sections['classified_loop']['max'] = $this->_sections['classified_loop']['loop'];
$this->_sections['classified_loop']['step'] = 1;
$this->_sections['classified_loop']['start'] = $this->_sections['classified_loop']['step'] > 0 ? 0 : $this->_sections['classified_loop']['loop']-1;
if ($this->_sections['classified_loop']['show']) {
    $this->_sections['classified_loop']['total'] = $this->_sections['classified_loop']['loop'];
    if ($this->_sections['classified_loop']['total'] == 0)
        $this->_sections['classified_loop']['show'] = false;
} else
    $this->_sections['classified_loop']['total'] = 0;
if ($this->_sections['classified_loop']['show']):

            for ($this->_sections['classified_loop']['index'] = $this->_sections['classified_loop']['start'], $this->_sections['classified_loop']['iteration'] = 1;
                 $this->_sections['classified_loop']['iteration'] <= $this->_sections['classified_loop']['total'];
                 $this->_sections['classified_loop']['index'] += $this->_sections['classified_loop']['step'], $this->_sections['classified_loop']['iteration']++):
$this->_sections['classified_loop']['rownum'] = $this->_sections['classified_loop']['iteration'];
$this->_sections['classified_loop']['index_prev'] = $this->_sections['classified_loop']['index'] - $this->_sections['classified_loop']['step'];
$this->_sections['classified_loop']['index_next'] = $this->_sections['classified_loop']['index'] + $this->_sections['classified_loop']['step'];
$this->_sections['classified_loop']['first']      = ($this->_sections['classified_loop']['iteration'] == 1);
$this->_sections['classified_loop']['last']       = ($this->_sections['classified_loop']['iteration'] == $this->_sections['classified_loop']['total']);
?>
	<div style='font-weight: bold; font-size: 12px;padding:5px'>
      <a class='classi_most' href='<?php echo $this->_tpl_vars['url']->url_create('classified',$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified_author']->user_info['user_username'],$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_id']); ?>
'>
        <?php echo $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_title']; ?>

      </a>
    </div>
   <?php endfor; endif; ?>
</div>

</div>
<form>
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