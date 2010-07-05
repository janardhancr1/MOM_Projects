<?php /* Smarty version 2.6.14, created on 2010-05-29 16:02:01
         compiled from recipe.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'recipe.tpl', 12, false),array('modifier', 'default', 'recipe.tpl', 152, false),)), $this);
?><?php
SELanguage::_preload_multi(39,155,175,182,183,184,185,187,784,787,829,830,831,832,833,834,835,854,856,891,1025,1026,1032,1034,1071);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td colspan="2">
                            <h1>
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['recipe_object']->recipe_info['recipe_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 75, "...", true) : smarty_modifier_truncate($_tmp, 75, "...", true)); ?>
</h1>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h4>
                                <?php echo $this->_tpl_vars['recipe_object']->recipe_info['recipe_description']; ?>
</h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="styleLine">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <div class="recipe_title" style="float: left;">
                                    Rate this Recipe: &nbsp;
                                </div>
                                								<div>
								<iframe name='rateframe' id='rateframe' src="<?php echo $this->_tpl_vars['url']->url_base; ?>
/rate.php?object_table=se_recipes&object_primary=recipe_id&object_id=<?php echo $this->_tpl_vars['recipe_object']->recipe_info['recipe_id']; ?>
" scrolling='no' frameborder='0' style='width:200px;height:25px;'></iframe>
								</div>
								<br>
								 
                            </div>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" rowspan="4">
                        	<?php if (! empty ( $this->_tpl_vars['recipe_object']->recipe_info['recipe_photo'] )): ?>
                            <img src="./uploads_recipes/<?php echo $this->_tpl_vars['recipe_object']->recipe_info['recipe_photo']; ?>
"/>
                            <?php else: ?>
                            <img src="./images/nophoto.gif" />
                            <?php endif; ?>
                        </td>
                        <td width="50%" valign="top">
                            <span class="recipe_title">Difficulty:</span>
                            <?php echo $this->_tpl_vars['recipe_object']->recipe_info['recipe_difficulty']; ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="recipe_title">Preparation Time :</span>
                            <?php echo $this->_tpl_vars['recipe_object']->recipe_info['recipe_prep_tm']; ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="recipe_title">Cooking Time :</span>
                            <?php echo $this->_tpl_vars['recipe_object']->recipe_info['recipe_cook_tm']; ?>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="recipe_title">Server To : </span>
                            <?php echo $this->_tpl_vars['recipe_object']->recipe_info['recipe_serve_to']; ?>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="recipe_title">
                                Ingredients</div>
                        </td>
                        <td>
                            <div class="recipe_title">
                                Method</div>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>
                            <?php echo $this->_tpl_vars['recipe_object']->recipe_info['recipe_ingredients']; ?>

                        </td>
                        <td>
                            <?php echo $this->_tpl_vars['recipe_object']->recipe_info['recipe_method']; ?>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="recipe_title">Tags</span>: <?php echo $this->_tpl_vars['recipe_object']->recipe_info['recipe_tags']; ?>
</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="styleLine">
                            </div>
                        </td>
                    </tr>
                    <?php if (! empty ( $this->_tpl_vars['myRecipe'] )): ?>
                    <tr>
                    	<td colspan="2">
                    		<form action="recipes_favorite.php" method="post">
                    		<input type="submit" value="Add to Favorite" class="button">
                    		<input type="hidden" value="<?php echo $this->_tpl_vars['recipe_object']->recipe_info['recipe_id']; ?>
" name="recipe_id">
                    		</form>
                    	</td>
                    </tr>
                    <?php endif; ?>
                </table>
            </td>
        </tr>
    </table>

<div style='margin-left: auto; margin-right: auto;'>

  <div id="recipe_<?php echo $this->_tpl_vars['recipe_object']->recipe_info['recipe_id']; ?>
_postcomment"></div>
  <div id="recipe_<?php echo $this->_tpl_vars['recipe_object']->recipe_info['recipe_id']; ?>
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
    
    SocialEngine.RecipeComments = new SocialEngineAPI.Comments({
      'canComment' : <?php if ($this->_tpl_vars['allowed_to_comment']): ?>true<?php else: ?>false<?php endif; ?>,
      'commentCode' : <?php if ($this->_tpl_vars['setting']['setting_comment_code']): ?>true<?php else: ?>false<?php endif; ?>,
      'commentHTML' : '<?php echo $this->_tpl_vars['setting']['setting_comment_html']; ?>
',
      
      'type' : 'recipe',
      'typeIdentifier' : 'recipe_id',
      'typeID' : <?php echo $this->_tpl_vars['recipe_object']->recipe_info['recipe_id']; ?>
,
      
      'typeTab' : 'recipes',
      'typeCol' : 'recipe',
      
      'initialTotal' : <?php echo ((is_array($_tmp=@$this->_tpl_vars['total_comments'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
,
      
      'paginate' : false,
      'cpp' : 20
    });
    
    SocialEngine.RegisterModule(SocialEngine.RecipeComments);
    
    // Backwards
    function addComment(is_error, comment_body, comment_date)
    {
      SocialEngine.RecipeComments.addComment(is_error, comment_body, comment_date);
    }
    
    function getComments(direction)
    {
      SocialEngine.RecipeComments.getComments(direction);
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