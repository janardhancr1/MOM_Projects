<?php /* Smarty version 2.6.14, created on 2010-05-30 16:43:32
         compiled from user_recipe.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'user_recipe.tpl', 39, false),array('modifier', 'truncate', 'user_recipe.tpl', 77, false),array('modifier', 'escape', 'user_recipe.tpl', 86, false),)), $this);
?><?php
SELanguage::_preload_multi(7000037,7000039,7000040,7000041,7000042,646,182,7000035,7000036,183,7000046,7000047,7000055,7000114,7000115,7000122,507,7000121,7000057,7000048,7000056,175,39,7000043,7000044);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style="padding-left:2px">
<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<img src='./images/icons/recipe_recipe48.png' border='0' class='icon_big'>
<div class='page_header'><?php echo SELanguage::_get(7000037); ?></div>
<div><?php echo SELanguage::_get(7000039); ?></div>

<div style='margin-top: 20px;'>
  <div class='button' style='float: left;'>
    <a href='user_recipe_new.php'><img src='./images/icons/recipe_new16.png' border='0' class='button'><?php echo SELanguage::_get(7000040); ?></a>
  </div>
  <div class='button' style='float: left; padding-left: 20px;'>
    <a href="javascript:void(0);" onClick="this.blur();if($('recipe_search').style.display=='none') <?php echo '{'; ?>
 $('recipe_search').style.display='block'; $('recipe_searchtext').focus(); <?php echo '} else {'; ?>
 $('recipe_search').style.display='none'; <?php echo '}'; ?>
"><img src='./images/icons/search16.gif' border='0' class='button'><?php echo SELanguage::_get(7000041); ?></a>
  </div>
  <div style='clear: both; height: 0px;'></div>
</div>

<div class='recipe_search' id='recipe_search' style='width: 550px; margin-top: 10px; text-align: center;<?php if ($this->_tpl_vars['search'] == ""): ?> display: none;<?php endif; ?>'>
  <form action='user_recipe.php' name='searchform' method='post'>
  <table cellpadding='0' cellspacing='0' align='center'>
    <tr>
      <td><?php echo SELanguage::_get(7000042); ?>&nbsp;</td>
      <td><input type='text' name='search' maxlength='100' size='30' value='<?php echo $this->_tpl_vars['search']; ?>
' class='text' id='recipe_searchtext'>&nbsp;</td>
      <td><?php $this->assign('langBlockTemp', SE_Language::_get(646));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
'><?php 

  ?></td>
    </tr>
  </table>
  <input type='hidden' name='s' value='<?php echo $this->_tpl_vars['s']; ?>
'>
  <input type='hidden' name='p' value='<?php echo $this->_tpl_vars['p']; ?>
'>
  </form>
</div>

<?php if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div class='center'>
    <?php if ($this->_tpl_vars['p'] != 1): ?>
      <a href='user_recipe.php?s=<?php echo $this->_tpl_vars['s']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a>
    <?php else: ?>
      <font class='disabled'>&#171; <?php echo SELanguage::_get(182); ?></font>
    <?php endif; ?>
    &nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
      <?php echo sprintf(SELanguage::_get(7000035), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_recipes']); ?>
    <?php else: ?>
      <?php echo sprintf(SELanguage::_get(7000036), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_recipes']); ?>
    <?php endif; ?>
    &nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?>
      <a href='user_recipe.php?s=<?php echo $this->_tpl_vars['s']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a>
    <?php else: ?>
      <font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font>
    <?php endif; ?>
  </div>
  <br />
<?php endif; ?>
<br />
<?php 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(7000046,7000047,7000055,7000114,7000115));
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

<script type='text/javascript' src="./include/js/class_recipe.js"></script>
<script type='text/javascript'>
<!--
  SocialEngine.recipes = new SocialEngineAPI.recipes();
  SocialEngine.RegisterModule(SocialEngine.recipes);
//-->
</script>

  
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
<div style='width: 550px;' id='serecipe_<?php echo $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_id']; ?>
' class="seRecipeRow recipe">
  <table cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td class='recipe_left' width='100%'>
        <div class='recipe_title'>
          <?php echo ((is_array($_tmp=$this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>

        </div>
        <div class='recipe_stats'>
          <?php $this->assign('recipe_datecreated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_datecreated'])); ?>
          <?php echo sprintf(SELanguage::_get(7000122), $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_views']); ?>
          - <?php echo sprintf(SELanguage::_get(507), $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['total_comments']); ?>
          - <?php echo sprintf(SELanguage::_get($this->_tpl_vars['recipe_datecreated'][0]), $this->_tpl_vars['recipe_datecreated'][1]); ?>
        </div>
        <?php if ($this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_description'] != ""): ?>
          <div style='margin-top: 8px; margin-bottom: 8px;'><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('truncate', true, $_tmp, 197, "...", true) : smarty_modifier_truncate($_tmp, 197, "...", true)); ?>
</div>
        <?php endif; ?>
        <div class='recipe_options'>
                    <div style='float: left;'><a href='<?php echo $this->_tpl_vars['url']->url_create('recipe',$this->_tpl_vars['user']->user_info['user_username'],$this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_id']); ?>
'><img src='./images/icons/recipe_recipe16.png' border='0' class='button'><?php echo SELanguage::_get(7000121); ?></a></div>
            
                    <div style='float: left; padding-left: 15px;'><a href='user_recipe_edit.php?recipe_id=<?php echo $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_id']; ?>
'><img src='./images/icons/recipe_edit16.gif' border='0' class='button'><?php echo SELanguage::_get(7000057); ?></a></div>
            
                    <div class="serecipesDelete" style='float: left; padding-left: 15px;'><a href='javascript:void(0);' onclick="SocialEngine.recipes.deleterecipe(<?php echo $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_id']; ?>
);"><img src='./images/icons/recipe_delete16.gif' border='0' class='button'><?php echo SELanguage::_get(7000048); ?></a></div>
          <div style='clear: both; height: 0px;'></div>
        </div>
      </td>
    </tr>
  </table>
</div>
<?php endfor; endif; ?>

<div style='clear: both; height: 0px;'></div>

<div style='display: none;' id='confirmrecipedelete'>
  <div style='margin-top: 10px;'>
    <?php echo SELanguage::_get(7000056); ?>
  </div>
  <br>
  <input type='button' class='button' value='<?php echo SELanguage::_get(175); ?>' onClick='parent.TB_remove();parent.SocialEngine.recipes.deleterecipeConfirm(parent.SocialEngine.recipes.currentConfirmDeleteID);'> <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='parent.TB_remove();'>
</div>

<?php if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div class='center'>
    <?php if ($this->_tpl_vars['p'] != 1): ?>
      <a href='user_recipe.php?s=<?php echo $this->_tpl_vars['s']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a>
    <?php else: ?>
      <font class='disabled'>&#171; <?php echo SELanguage::_get(182); ?></font>
    <?php endif; ?>
    &nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
      <?php echo sprintf(SELanguage::_get(7000035), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_recipes']); ?>
    <?php else: ?>
      <?php echo sprintf(SELanguage::_get(7000036), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_recipes']); ?>
    <?php endif; ?>
    &nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?>
      <a href='user_recipe.php?s=<?php echo $this->_tpl_vars['s']; ?>
&search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a>
    <?php else: ?>
      <font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font>
    <?php endif; ?>
  </div>
  <br />
<?php endif; 
 if ($this->_tpl_vars['total_recipes'] == 0 && ! empty ( $this->_tpl_vars['search'] )): ?>

  <br>
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='result'><img src='./images/icons/bulb16.gif' border='0' class='icon'><?php echo SELanguage::_get(7000043); ?></td></tr>
  </table>
  
<?php endif; ?>



<div<?php if ($this->_tpl_vars['total_recipes'] > 0): ?> style='display: none;'<?php endif; ?> id='recipenullmessage'>
  <br>    
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='result'><img src='./images/icons/bulb16.gif' border='0' class='icon'><?php echo SELanguage::_get(7000044); ?></td></tr>
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