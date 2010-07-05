{include file='header.tpl'}
{* $Id: user_recipe_new.tpl 12 2009-01-11 06:04:12Z john $ *}
<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'>Top Rated Recipes</div>
<div style='float: left; width: 680px; padding: 0px 5px 0px 5px;'>
<form action='recipes_recent.php' method='post' name="seSearchRecipes">
<input type='hidden' name='p' value='{$p|default:1}' />
<table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
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