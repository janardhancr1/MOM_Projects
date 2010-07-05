<?php /* Smarty version 2.6.14, created on 2010-05-29 16:04:20
         compiled from user_recipe_edit.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'user_recipe_edit.tpl', 318, false),)), $this);
?><?php
SELanguage::_preload_multi(7000061,7000062,7000063,7000064,7000065,7000066);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'>Edit Recipe</div>
<table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td>
                            <fieldset>
                                <legend class="grayHeader">Recipe Details</legend>
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
								<?php endif; ?>
                                <form action='user_recipe_edit.php' method='POST'>
                                <table width="100%" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="recipe_title">
                                                            Recipe Name: &nbsp;<small>(required)</small></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type='text' class='recipe' maxlength='100' name='recipe_name' value='<?php echo $this->_tpl_vars['recipe_name']; ?>
'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>Make it short, simple and descriptive</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="recipe_title">
                                                            Description: &nbsp; <small>(required)</small></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <textarea rows='2' cols='80' name='recipe_desc'><?php echo $this->_tpl_vars['recipe_desc']; ?>
</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>Give more details about your recipe. What does it go well with? Why do you like
                                                            it? Make people want to try it!</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="recipe_title">
                                                            Tags
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type='text' class='recipe' maxlength='255' name='recipe_tags' value='<?php echo $this->_tpl_vars['recipe_tags']; ?>
'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>Separate tags with a space. Tags are used to classify your recipe, so use as
                                                            many tags as you can to make it easy to find. E.g. chicken rice low fat quick</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="recipe_title">
                                                            Preparation Time
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type='text' class='recipe' maxlength='100' name='recipe_prep_tm' value='<?php echo $this->_tpl_vars['recipe_prep_tm']; ?>
'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>E.g. 10 mins, 1 hour etc.</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="recipe_title">
                                                            Cooking Time
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type='text' class='recipe' maxlength='100' name='recipe_cook_tm' value='<?php echo $this->_tpl_vars['recipe_cook_tm']; ?>
'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>E.g. 10 mins, 1 hour etc.</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="recipe_title">
                                                            How many people does it serve?
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type='text' class='recipe' maxlength='100' name='recipe_serve_to' value='<?php echo $this->_tpl_vars['recipe_serve_to']; ?>
'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>E.g. 10 mins, 1 hour etc.</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="recipe_title">
                                                            Difficulty
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                    	<select name='recipe_difficulty'>
                                                    		<option value="Easy" <?php if ($this->_tpl_vars['recipe_difficulty'] == 'Easy'): ?> SELECTED <?php endif; ?>>Easy - for beginners</option>
                                                    		<option value="Medium" <?php if ($this->_tpl_vars['recipe_difficulty'] == 'Medium'): ?> SELECTED <?php endif; ?>>Medium - some experience needed</option>
                                                    		<option value="Difficult" <?php if ($this->_tpl_vars['recipe_difficulty'] == 'Difficult'): ?> SELECTED <?php endif; ?>>Difficult - for experienced cooks</option>
                                                    	</select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>E.g. 10 mins, 1 hour etc.</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="recipe_title">
                                                            Ingredients <small>(required)</small>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <textarea rows='2' cols='80' name='recipe_ingre'><?php echo $this->_tpl_vars['recipe_ingre']; ?>
</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>Please include quantites, unit of measurement and item for all ingredients.</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="3">
                                                <tr>
                                                    <td>
                                                        <div class="recipe_title">
                                                            Method <small>(required)</small>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <textarea rows='2' cols='80' name='recipe_method'><?php echo $this->_tpl_vars['recipe_method']; ?>
</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <small>Try and split your method into logical steps, and make sure all the ingredients
                                                            you mention are listed above.</small>
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="recipe_title">
                                                <h3>
                                                    Additional Information
                                                </h3>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                                <input type='checkbox' name='recipe_vege' id='recipe_vege' value='1' <?php if (! empty ( $this->_tpl_vars['recipe_vege'] )): ?> checked <?php endif; ?> >
                                                <label for='recipe_vege'> Suitable for vegetarians?</label></b>
                                            <br />
                                            <span class="checkboxtip">This recipe should contain no meat, fish, seafood, gelatin
                                                or marshmallow (unless specified as a vegetarian version) (see <a href="http://en.wikipedia.org/wiki/Vegetarian"
                                                    target="_blank">Wikipedia</a> for more info)</span>
                                            <hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                            	<input type='checkbox' name='recipe_vegan' id='recipe_vegan' value='1' <?php if (! empty ( $this->_tpl_vars['recipe_vegan'] )): ?> checked <?php endif; ?>>
                                                <label for='recipe_vegan'> Suitable for vegans?</label>
                                                </b>
                                            <br />
                                            <span class="checkboxtip">This recipe should contain no meat, fish, seafood, eggs, dairy,
                                                honey, gelatin or marshmallow (unless specified as a vegetarian version) (see <a
                                                    href="http://en.wikipedia.org/wiki/Vegan" target="_blank">Wikipedia</a> for
                                                more info)</span><hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                            	<input type='checkbox' name='recipe_dairy' id='recipe_dairy' value='1' <?php if (! empty ( $this->_tpl_vars['recipe_dairy'] )): ?> checked <?php endif; ?>>
                                                <label for='recipe_dairy'> Dairy free?</label>
                                                </b>
                                            <br />
                                            <span class="checkboxtip">Is this recipe suitable for people on a dairy free diet?</span><hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                            	<input type='checkbox' name='recipe_gluten' id='recipe_gluten' value='1' <?php if (! empty ( $this->_tpl_vars['recipe_gluten'] )): ?> checked <?php endif; ?>>
                                                <label for='recipe_gluten'> Gluten free?</label>
                                                </b>
                                            <br />
                                            <span class="checkboxtip">Is this recipe suitable for people on a gluten free diet?</span><hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                            	<input type='checkbox' name='recipe_nut' id='recipe_nut' value='1' <?php if (! empty ( $this->_tpl_vars['recipe_nut'] )): ?> checked <?php endif; ?>>
                                                <label for='recipe_nut'> Nut free?</label>
                                                </b>
                                            <br />
                                            <span class="checkboxtip">Is this recipe suitable for people on a nut free recipe?</span><hr />
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>
                                    											  <?php if (count($this->_tpl_vars['privacy_options']) > 1 || count($this->_tpl_vars['comment_options']) > 1): ?>
										    <div id='settings_show' class='recipe_settings_link'>
										      <a href="javascript:void(0);" onclick="javascript:$('entry_settings').style.display='block';$('settings_show').style.display='none';"><?php echo SELanguage::_get(7000061); ?></a>
										    </div>
										  <?php endif; ?>
										
										  <div id='entry_settings' class='recipe_settings' style='display: none; margin-top: 7px;'>
										    										    <?php if ($this->_tpl_vars['user']->level_info['level_recipe_search'] == 1): ?>
										      <b><?php echo SELanguage::_get(7000062); ?></b>
										      <table cellpadding='0' cellspacing='0'>
										        <tr>
										          <td><input type='radio' name='recipe_search' id='recipe_search_1' value='1' <?php if ($this->_tpl_vars['recipe_search']): ?> checked='checked'<?php endif; ?>></td>
										          <td><label for='recipe_search_1'><?php echo SELanguage::_get(7000063); ?></label></td>
										        </tr>
										        <tr>
										          <td><input type='radio' name='recipe_search' id='recipe_search_0' value='0' <?php if (! $this->_tpl_vars['recipe_search']): ?> checked='checked'<?php endif; ?>></td>
										          <td><label for='recipe_search_0'><?php echo SELanguage::_get(7000064); ?></label></td>
										        </tr>
										      </table>
										    <?php endif; ?>
										
										    										    <?php if ($this->_tpl_vars['user']->level_info['level_recipe_search'] == 1 && ( count($this->_tpl_vars['privacy_options']) > 1 || count($this->_tpl_vars['comment_options']) > 1 )): ?><br><?php endif; ?>
										
										    										    <?php if (count($this->_tpl_vars['privacy_options']) > 1): ?>
										      <b><?php echo SELanguage::_get(7000065); ?></b>
										      <table cellpadding='0' cellspacing='0'>
										      <?php $_from = $this->_tpl_vars['privacy_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['privacy_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['privacy_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['privacy_loop']['iteration']++;
?>
										        <tr>
										        <td><input type='radio' name='recipe_privacy' id='privacy_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['recipe_privacy'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
										        <td><label for='privacy_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
										        </tr>
										      <?php endforeach; endif; unset($_from); ?>
										      </table>
										    <?php endif; ?>
										
										    										    <?php if (count($this->_tpl_vars['privacy_options']) > 1 && count($this->_tpl_vars['comment_options']) > 1): ?><br><?php endif; ?>
										
										    										    <?php if (count($this->_tpl_vars['comment_options']) > 1): ?>
										      <b><?php echo SELanguage::_get(7000066); ?></b>
										      <table cellpadding='0' cellspacing='0'>
										      <?php $_from = $this->_tpl_vars['comment_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['comment_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['comment_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['comment_loop']['iteration']++;
?>
										        <tr>
										        <td><input type='radio' name='recipe_comments' id='comments_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['recipe_comments'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
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
                                        <td>
                                        	<input type="submit" class="recipeBtn" value="Save Recipe" >
                                        	<input type="button" class="recipeBtn" value="Cancel" >
                                        </td>
                                    </tr>
                                </table>
                                <input type='hidden' name='task' value='doedit'>
                                <input type='hidden' name='recipe_id' value='<?php echo $this->_tpl_vars['recipe_id']; ?>
'>
                                </form>
                            </fieldset>
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