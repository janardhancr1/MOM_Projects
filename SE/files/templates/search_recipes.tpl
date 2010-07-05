{include file='header.tpl'}
{* $Id: user_recipe_new.tpl 12 2009-01-11 06:04:12Z john $ *}
<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'>Search Recipes</div>
<div style='float: left; width: 680px; padding: 0px 5px 0px 5px;'>
<form action='search_recipes.php' method='post' name="seSearchRecipes">
<input type='hidden' name='p' value='{$p|default:1}' />
<input type='hidden' name='task' value='dosearch' />
<table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <fieldset>
                    <center>
                        <table>
                            <tr>
                                <td colspan="3" align="center">
                                    Key words:&nbsp;
                                    <input type="text" name="recipe_search" value="{$recipe_search}" class="text" style="width: 200px;"></td>
                            </tr>
                            <tr>
                            	<td colspan="2">
                                    Difficulty :<select name='recipe_difficulty' class='recipe_small'>
                                    				<option value="" {if $recipe_difficulty == '' } SELECTED {/if}>--Select--</option>
                                            		<option value="Easy" {if $recipe_difficulty == 'Easy' } SELECTED {/if}>Easy - for beginners</option>
                                            		<option value="Medium" {if $recipe_difficulty == 'Medium' } SELECTED {/if}>Medium - some experience needed</option>
                                            		<option value="Difficult" {if $recipe_difficulty == 'Difficult' } SELECTED {/if}>Difficult - for experienced cooks</option>
                                            	</select>
                                </td>
                                <td>
                                    <input type="checkBox" name='recipe_dairy' id='recipe_dairy' value='1' {if !empty($recipe_dairy)} checked {/if} /> <label for='recipe_dairy'>Dairy free?</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkBox" name='recipe_vege' id='recipe_vege' value='1' {if !empty($recipe_vege)} checked {/if} /> <label for='recipe_vege'>Suitable for vegetarians?</label>
                                </td>
                                <td>
                                    <input type="checkBox" name='recipe_vegan' id='recipe_vegan' value='1' {if !empty($recipe_vegan)} checked {/if} /> <label for='recipe_vegan'>Suitable for vegans?</label>
                                </td>
                                <td>
                                    <input type="checkBox" name='recipe_photo' id='recipe_photo' value='1' {if !empty($recipe_photo)} checked {/if} /> <label for='recipe_photo'>Only show recipes with photos?</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkBox" name='recipe_gluten' id='recipe_gluten' value='1' {if !empty($recipe_gluten)} checked {/if} /> <label for='recipe_gluten'>Gluten free?</label>
                                </td>
                                <td>
                                    <input type="checkBox" name='recipe_nut' id='recipe_nut' value='1' {if !empty($recipe_nut)} checked {/if} /> <label for='recipe_nut'>Nut free?</label>
                                </td>
                                <td>
                                    <input type="checkBox" name='recipe_ingre' id='recipe_ingre' value='1' {if !empty($recipe_ingre)} checked {/if}  /> <label for='recipe_ingre'>Only search ingredients?</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <input type="checkbox" name='recipe_binder' id='recipe_binder' value='1' {if !empty($recipe_binder)} checked {/if} /><label
                                        for="recipe_binder">Only search within My Recipe Binder (your recipes
                                        and favourites)
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center">
                                    <input type="submit" value="Search" class="button">
                                </td>
                            </tr>
                        </table>
                    </center>
                </fieldset>
                <br />
                {* DISPLAY PAGINATION MENU IF APPLICABLE *}
				  {if $maxpage > 1}
				    <div class='classified_pages_top'>
				      {if $p != 1}
				        <a href='javascript:void(0);' onclick='document.seSearchRecipes.p.value={math equation="p-1" p=$p};document.seSearchRecipes.submit();'>&#171; {lang_print id=182}</a>
				      {else}
				        &#171; {lang_print id=182}
				      {/if}
				      &nbsp;|&nbsp;&nbsp;
				      {if $p_start == $p_end}
				        <b>{lang_sprintf id=184 1=$p_start 2=$total_recipes}</b>
				      {else}
				        <b>{lang_sprintf id=185 1=$p_start 2=$p_end 3=$total_recipes}</b>
				      {/if}
				      &nbsp;&nbsp;|&nbsp;
				      {if $p != $maxpage}
				        <a href='javascript:void(0);' onclick='document.seSearchRecipes.p.value={math equation="p+1" p=$p};document.seSearchRecipes.submit();'>{lang_print id=183} &#187;</a>
				      {else}
				        {lang_print id=183} &#187;
				      {/if}
				    </div>
				  {/if}
                {if $total_recipes > 0}
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
                            {section name=recipe_loop loop=$recipes}
                        <tr>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <td>
                                        	{if !empty($recipes[recipe_loop].recipe_photo) }
                                            <img src="{$recipes[recipe_loop].recipe_photo}" width="40" height="40" />
                                            {else}
                                            <img src="./images/nophoto.gif" width="40" height="40" />
                                            {/if}
                                            </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <div>
                                    <a href="recipe.php?user={$recipes[recipe_loop].SUBMITTEDBY}&recipe_id={$recipes[recipe_loop].recipe_id}">
                                      {$recipes[recipe_loop].recipe_name}
                                    </a>
                                </div>
                                <div>
                                    
                                </div>
                                <div>
                                    Submitted by:
                                    <a href="profile.php?user={$recipes[recipe_loop].SUBMITTEDBY}">
                                    {$recipes[recipe_loop].SUBMITTEDBY}</a> 
                                </div>
                            </td>
                            <td>
                                <div>
                                  {$recipes[recipe_loop].recipe_cook_tm} 
                                </div>
                            </td>
                            <td align="center">
								{* BEGIN RATING *}
								<div>
								<iframe name='rateframe' id='rateframe' src="{$url->url_base}/rate.php?object_table=se_recipes&object_primary=recipe_id&object_id={$recipes[recipe_loop].recipe_id}" scrolling='no' frameborder='0' style='width:200px;height:25px;'></iframe>
								</div>
								<br>
								{* END RATING *} 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <hr />
                            </td>
                        </tr>
                        {/section}
                        </table>
                    {elseif $total_recipes == 0}
                	<table width="100%" id="NoDataTable">
                    <tr>
                        <td>
                            <font color="red" size="3">No Recipes found..</font>
                            <br /></td>
                    </tr>
                </table>
                {/if}
            </td>
        </tr>
    </table>
    {* DISPLAY PAGINATION MENU IF APPLICABLE *}
	  {if $maxpage > 1}
	    <div class='classified_pages_top'>
	      {if $p != 1}
	        <a href='javascript:void(0);' onclick='document.seSearchRecipes.p.value={math equation="p-1" p=$p};document.seSearchRecipes.submit();'>&#171; {lang_print id=182}</a>
	      {else}
	        &#171; {lang_print id=182}
	      {/if}
	      &nbsp;|&nbsp;&nbsp;
	      {if $p_start == $p_end}
	        <b>{lang_sprintf id=184 1=$p_start 2=$total_recipes}</b>
	      {else}
	        <b>{lang_sprintf id=185 1=$p_start 2=$p_end 3=$total_recipes}</b>
	      {/if}
	      &nbsp;&nbsp;|&nbsp;
	      {if $p != $maxpage}
	        <a href='javascript:void(0);' onclick='document.seSearchRecipes.p.value={math equation="p+1" p=$p};document.seSearchRecipes.submit();'>{lang_print id=183} &#187;</a>
	      {else}
	        {lang_print id=183} &#187;
	      {/if}
	    </div>
	  {/if}

    </div>
    <div style='float: right; width: 300px;'>
	</div>
</form>
</div>
{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>
{include file='footer.tpl'}