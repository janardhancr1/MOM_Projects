{include file='header.tpl'}

{* $Id: user_recipe_edit.tpl 12 2009-01-11 06:04:12Z john $ *}

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
                                {* SHOW ERROR MESSAGE *}
								{if !empty($is_error)}
								  <table cellpadding='0' cellspacing='0'><tr>
								    <td class='error'><img src='./images/error.gif' border='0' class='icon'>
								      {if !empty($is_error_sprintf_1)}
								        {lang_sprintf id=$is_error 1=$is_error_sprintf_1}
								      {else}
								        {lang_print id=$is_error}
								      {/if}
								    </td>
								  </tr></table>
								  <br />
								{/if}
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
                                                        <input type='text' class='recipe' maxlength='100' name='recipe_name' value='{$recipe_name}'>
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
                                                        <textarea rows='2' cols='80' name='recipe_desc'>{$recipe_desc}</textarea>
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
                                                        <input type='text' class='recipe' maxlength='255' name='recipe_tags' value='{$recipe_tags}'>
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
                                                        <input type='text' class='recipe' maxlength='100' name='recipe_prep_tm' value='{$recipe_prep_tm}'>
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
                                                        <input type='text' class='recipe' maxlength='100' name='recipe_cook_tm' value='{$recipe_cook_tm}'>
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
                                                        <input type='text' class='recipe' maxlength='100' name='recipe_serve_to' value='{$recipe_serve_to}'>
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
                                                    		<option value="Easy" {if $recipe_difficulty == 'Easy' } SELECTED {/if}>Easy - for beginners</option>
                                                    		<option value="Medium" {if $recipe_difficulty == 'Medium' } SELECTED {/if}>Medium - some experience needed</option>
                                                    		<option value="Difficult" {if $recipe_difficulty == 'Difficult' } SELECTED {/if}>Difficult - for experienced cooks</option>
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
                                                        <textarea rows='2' cols='80' name='recipe_ingre'>{$recipe_ingre}</textarea>
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
                                                        <textarea rows='2' cols='80' name='recipe_method'>{$recipe_method}</textarea>
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
                                                <input type='checkbox' name='recipe_vege' id='recipe_vege' value='1' {if !empty($recipe_vege)} checked {/if} >
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
                                            	<input type='checkbox' name='recipe_vegan' id='recipe_vegan' value='1' {if !empty($recipe_vegan)} checked {/if}>
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
                                            	<input type='checkbox' name='recipe_dairy' id='recipe_dairy' value='1' {if !empty($recipe_dairy)} checked {/if}>
                                                <label for='recipe_dairy'> Dairy free?</label>
                                                </b>
                                            <br />
                                            <span class="checkboxtip">Is this recipe suitable for people on a dairy free diet?</span><hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                            	<input type='checkbox' name='recipe_gluten' id='recipe_gluten' value='1' {if !empty($recipe_gluten)} checked {/if}>
                                                <label for='recipe_gluten'> Gluten free?</label>
                                                </b>
                                            <br />
                                            <span class="checkboxtip">Is this recipe suitable for people on a gluten free diet?</span><hr />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>
                                            	<input type='checkbox' name='recipe_nut' id='recipe_nut' value='1' {if !empty($recipe_nut)} checked {/if}>
                                                <label for='recipe_nut'> Nut free?</label>
                                                </b>
                                            <br />
                                            <span class="checkboxtip">Is this recipe suitable for people on a nut free recipe?</span><hr />
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td>
                                    	{* SHOW SETTINGS LINK IF NECESSARY *}
										  {if $privacy_options|@count > 1 OR $comment_options|@count > 1}
										    <div id='settings_show' class='recipe_settings_link'>
										      <a href="javascript:void(0);" onclick="javascript:$('entry_settings').style.display='block';$('settings_show').style.display='none';">{lang_print id=7000061}</a>
										    </div>
										  {/if}
										
										  <div id='entry_settings' class='recipe_settings' style='display: none; margin-top: 7px;'>
										    {* SHOW SEARCH PRIVACY OPTIONS IF ALLOWED BY ADMIN *}
										    {if $user->level_info.level_recipe_search == 1}
										      <b>{lang_print id=7000062}</b>
										      <table cellpadding='0' cellspacing='0'>
										        <tr>
										          <td><input type='radio' name='recipe_search' id='recipe_search_1' value='1' {if  $recipe_search} checked='checked'{/if}></td>
										          <td><label for='recipe_search_1'>{lang_print id=7000063}</label></td>
										        </tr>
										        <tr>
										          <td><input type='radio' name='recipe_search' id='recipe_search_0' value='0' {if !$recipe_search} checked='checked'{/if}></td>
										          <td><label for='recipe_search_0'>{lang_print id=7000064}</label></td>
										        </tr>
										      </table>
										    {/if}
										
										    {* ADD SPACE IF BOTH OPTIONS ARE AVAILABLE *}
										    {if $user->level_info.level_recipe_search == 1 AND ($privacy_options|@count > 1 OR $comment_options|@count > 1)}<br>{/if}
										
										    {* SHOW PRIVACY OPTIONS *}
										    {if $privacy_options|@count > 1}
										      <b>{lang_print id=7000065}</b>
										      <table cellpadding='0' cellspacing='0'>
										      {foreach from=$privacy_options key=k item=v name=privacy_loop}
										        <tr>
										        <td><input type='radio' name='recipe_privacy' id='privacy_{$k}' value='{$k}'{if $recipe_privacy == $k} checked='checked'{/if}></td>
										        <td><label for='privacy_{$k}'>{lang_print id=$v}</label></td>
										        </tr>
										      {/foreach}
										      </table>
										    {/if}
										
										    {* ADD SPACE IF BOTH OPTIONS ARE AVAILABLE *}
										    {if $privacy_options|@count > 1 AND $comment_options|@count > 1}<br>{/if}
										
										    {* SHOW COMMENT OPTIONS *}
										    {if $comment_options|@count > 1}
										      <b>{lang_print id=7000066}</b>
										      <table cellpadding='0' cellspacing='0'>
										      {foreach from=$comment_options key=k item=v name=comment_loop}
										        <tr>
										        <td><input type='radio' name='recipe_comments' id='comments_{$k}' value='{$k}'{if $recipe_comments == $k} checked='checked'{/if}></td>
										        <td><label for='comments_{$k}'>{lang_print id=$v}</label></td>
										        </tr>
										      {/foreach}
										      </table>
										    {/if}
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
                                <input type='hidden' name='recipe_id' value='{$recipe_id}'>
                                </form>
                            </fieldset>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>
{include file='footer.tpl'}