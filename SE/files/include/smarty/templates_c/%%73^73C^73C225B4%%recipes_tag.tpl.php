<?php /* Smarty version 2.6.14, created on 2010-05-29 16:00:26
         compiled from recipes_tag.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'recipes_tag.tpl', 7, false),array('function', 'math', 'recipes_tag.tpl', 24, false),)), $this);
?><?php
SELanguage::_preload_multi(182,184,185,183);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'>Search Recipes by tags</div>
<div style='float: left; width: 680px; padding: 0px 5px 0px 5px;'>
<form action='search_recipes.php' method='post' name="seSearchRecipes">
<input type='hidden' name='p' value='<?php echo ((is_array($_tmp=@$this->_tpl_vars['p'])) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1)); ?>
' />
<input type='hidden' name='task' value='dosearch' />
<table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <fieldset>
                    <center>
                        <?php unset($this->_sections['tag_loop']);
$this->_sections['tag_loop']['name'] = 'tag_loop';
$this->_sections['tag_loop']['loop'] = is_array($_loop=$this->_tpl_vars['recipe_tags']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tag_loop']['show'] = true;
$this->_sections['tag_loop']['max'] = $this->_sections['tag_loop']['loop'];
$this->_sections['tag_loop']['step'] = 1;
$this->_sections['tag_loop']['start'] = $this->_sections['tag_loop']['step'] > 0 ? 0 : $this->_sections['tag_loop']['loop']-1;
if ($this->_sections['tag_loop']['show']) {
    $this->_sections['tag_loop']['total'] = $this->_sections['tag_loop']['loop'];
    if ($this->_sections['tag_loop']['total'] == 0)
        $this->_sections['tag_loop']['show'] = false;
} else
    $this->_sections['tag_loop']['total'] = 0;
if ($this->_sections['tag_loop']['show']):

            for ($this->_sections['tag_loop']['index'] = $this->_sections['tag_loop']['start'], $this->_sections['tag_loop']['iteration'] = 1;
                 $this->_sections['tag_loop']['iteration'] <= $this->_sections['tag_loop']['total'];
                 $this->_sections['tag_loop']['index'] += $this->_sections['tag_loop']['step'], $this->_sections['tag_loop']['iteration']++):
$this->_sections['tag_loop']['rownum'] = $this->_sections['tag_loop']['iteration'];
$this->_sections['tag_loop']['index_prev'] = $this->_sections['tag_loop']['index'] - $this->_sections['tag_loop']['step'];
$this->_sections['tag_loop']['index_next'] = $this->_sections['tag_loop']['index'] + $this->_sections['tag_loop']['step'];
$this->_sections['tag_loop']['first']      = ($this->_sections['tag_loop']['iteration'] == 1);
$this->_sections['tag_loop']['last']       = ($this->_sections['tag_loop']['iteration'] == $this->_sections['tag_loop']['total']);
?>
                        <a style="font-size: <?php echo $this->_tpl_vars['recipe_tags'][$this->_sections['tag_loop']['index']]['wieght']; ?>
px;" href="<?php echo $this->_tpl_vars['recipe_tags'][$this->_sections['tag_loop']['index']]['url']; ?>
"><?php echo $this->_tpl_vars['recipe_tags'][$this->_sections['tag_loop']['index']]['tag']; ?>
</a>&nbsp;
                        <?php endfor; endif; ?>
                    </center>
                </fieldset>
                <br />
                				  <?php if ($this->_tpl_vars['maxpage'] > 1): ?>
				    <div class='classified_pages_top'>
				      <?php if ($this->_tpl_vars['p'] != 1): ?>
				        <a href='javascript:void(0);' onclick='document.seSearchRecipes.p.value=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p']), $this);?>
;document.seSearchRecipes.submit();'>&#171; <?php echo SELanguage::_get(182); ?></a>
				      <?php else: ?>
				        &#171; <?php echo SELanguage::_get(182); ?>
				      <?php endif; ?>
				      &nbsp;|&nbsp;&nbsp;
				      <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
				        <b><?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_recipes']); ?></b>
				      <?php else: ?>
				        <b><?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_recipes']); ?></b>
				      <?php endif; ?>
				      &nbsp;&nbsp;|&nbsp;
				      <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?>
				        <a href='javascript:void(0);' onclick='document.seSearchRecipes.p.value=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
;document.seSearchRecipes.submit();'><?php echo SELanguage::_get(183); ?> &#187;</a>
				      <?php else: ?>
				        <?php echo SELanguage::_get(183); ?> &#187;
				      <?php endif; ?>
				    </div>
				  <?php endif; ?>
                <?php if ($this->_tpl_vars['total_recipes'] > 0): ?>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr bgcolor="gray">
                                <th width="20%">
                                    &nbsp;</th>
                                <th width="40%" align="left">
                                    Recipe</th>
                                <th width="20%" align="left">
                                    Cooking Time</th>
                                <th width="20%">
                                    Rating</th>
                            </tr>
                            <?php unset($this->_sections['recipe_loop']);
$this->_sections['recipe_loop']['name'] = 'recipe_loop';
$this->_sections['recipe_loop']['loop'] = is_array($_loop=$this->_tpl_vars['recipes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['recipe_loop']['show'] = true;
$this->_sections['recipe_loop']['max'] = $this->_sections['recipe_loop']['loop'];
$this->_sections['recipe_loop']['step'] = 1;
$this->_sections['recipe_loop']['start'] = $this->_sections['recipe_loop']['step'] > 0 ? 0 : $this->_sections['recipe_loop']['loop']-1;
if ($this->_sections['recipe_loop']['show']) {
    $this->_sections['recipe_loop']['total'] = $this->_sections['recipe_loop']['loop'];
    if ($this->_sections['recipe_loop']['total'] == 0)
        $this->_sections['recipe_loop']['show'] = false;
} else
    $this->_sections['recipe_loop']['total'] = 0;
if ($this->_sections['recipe_loop']['show']):

            for ($this->_sections['recipe_loop']['index'] = $this->_sections['recipe_loop']['start'], $this->_sections['recipe_loop']['iteration'] = 1;
                 $this->_sections['recipe_loop']['iteration'] <= $this->_sections['recipe_loop']['total'];
                 $this->_sections['recipe_loop']['index'] += $this->_sections['recipe_loop']['step'], $this->_sections['recipe_loop']['iteration']++):
$this->_sections['recipe_loop']['rownum'] = $this->_sections['recipe_loop']['iteration'];
$this->_sections['recipe_loop']['index_prev'] = $this->_sections['recipe_loop']['index'] - $this->_sections['recipe_loop']['step'];
$this->_sections['recipe_loop']['index_next'] = $this->_sections['recipe_loop']['index'] + $this->_sections['recipe_loop']['step'];
$this->_sections['recipe_loop']['first']      = ($this->_sections['recipe_loop']['iteration'] == 1);
$this->_sections['recipe_loop']['last']       = ($this->_sections['recipe_loop']['iteration'] == $this->_sections['recipe_loop']['total']);
?>
                        <tr>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <td>
                                        	<?php if (! empty ( $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_photo'] )): ?>
                                            <img src="<?php echo $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_photo']; ?>
" width="40" height="40" />
                                            <?php else: ?>
                                            <img src="./images/nophoto.gif" width="40" height="40" />
                                            <?php endif; ?>
                                            </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <div>
                                    <a href="recipe.php?user=<?php echo $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['SUBMITTEDBY']; ?>
&recipe_id=<?php echo $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_id']; ?>
">
                                      <?php echo $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_name']; ?>

                                    </a>
                                </div>
                                <div>
                                    
                                </div>
                                <div>
                                    Submitted by:
                                    <a href="profile.php?user=<?php echo $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['SUBMITTEDBY']; ?>
">
                                    <?php echo $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['SUBMITTEDBY']; ?>
</a> 
                                </div>
                            </td>
                            <td>
                                <div>
                                  <?php echo $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_cook_tm']; ?>
 
                                </div>
                            </td>
                            <td align="center">
																<div>
								<iframe name='rateframe' id='rateframe' src="<?php echo $this->_tpl_vars['url']->url_base; ?>
/rate.php?object_table=se_recipes&object_primary=recipe_id&object_id=<?php echo $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_id']; ?>
" scrolling='no' frameborder='0' style='width:200px;height:25px;'></iframe>
								</div>
								<br>
								 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <hr />
                            </td>
                        </tr>
                        <?php endfor; endif; ?>
                        </table>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    	  <?php if ($this->_tpl_vars['maxpage'] > 1): ?>
	    <div class='classified_pages_top'>
	      <?php if ($this->_tpl_vars['p'] != 1): ?>
	        <a href='javascript:void(0);' onclick='document.seSearchRecipes.p.value=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p']), $this);?>
;document.seSearchRecipes.submit();'>&#171; <?php echo SELanguage::_get(182); ?></a>
	      <?php else: ?>
	        &#171; <?php echo SELanguage::_get(182); ?>
	      <?php endif; ?>
	      &nbsp;|&nbsp;&nbsp;
	      <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
	        <b><?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_recipes']); ?></b>
	      <?php else: ?>
	        <b><?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_recipes']); ?></b>
	      <?php endif; ?>
	      &nbsp;&nbsp;|&nbsp;
	      <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?>
	        <a href='javascript:void(0);' onclick='document.seSearchRecipes.p.value=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
;document.seSearchRecipes.submit();'><?php echo SELanguage::_get(183); ?> &#187;</a>
	      <?php else: ?>
	        <?php echo SELanguage::_get(183); ?> &#187;
	      <?php endif; ?>
	    </div>
	  <?php endif; ?>

    </div>
    <div style='float: right; width: 300px;'>
	</div>
</form>
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