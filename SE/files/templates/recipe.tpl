{include file='header.tpl'}

{* $Id: recipe.tpl 162 2009-04-30 01:43:11Z john $ *}
<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td colspan="2">
                            <h1>
                                {$recipe_object->recipe_info.recipe_name|truncate:75:"...":true}</h1>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h4>
                                {$recipe_object->recipe_info.recipe_description}</h4>
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
                                {* BEGIN RATING *}
								<div>
								<iframe name='rateframe' id='rateframe' src="{$url->url_base}/rate.php?object_table=se_recipes&object_primary=recipe_id&object_id={$recipe_object->recipe_info.recipe_id}" scrolling='no' frameborder='0' style='width:200px;height:25px;'></iframe>
								</div>
								<br>
								{* END RATING *} 
                            </div>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" rowspan="4">
                        	{if !empty($recipe_object->recipe_info.recipe_photo) }
                            <img src="./uploads_recipes/{$recipe_object->recipe_info.recipe_photo}"/>
                            {else}
                            <img src="./images/nophoto.gif" />
                            {/if}
                        </td>
                        <td width="50%" valign="top">
                            <span class="recipe_title">Difficulty:</span>
                            {$recipe_object->recipe_info.recipe_difficulty}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="recipe_title">Preparation Time :</span>
                            {$recipe_object->recipe_info.recipe_prep_tm}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="recipe_title">Cooking Time :</span>
                            {$recipe_object->recipe_info.recipe_cook_tm}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="recipe_title">Server To : </span>
                            {$recipe_object->recipe_info.recipe_serve_to}
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
                            {$recipe_object->recipe_info.recipe_ingredients}
                        </td>
                        <td>
                            {$recipe_object->recipe_info.recipe_method}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="recipe_title">Tags</span>: {$recipe_object->recipe_info.recipe_tags}</td>
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
                    {if !empty($myRecipe)}
                    <tr>
                    	<td colspan="2">
                    		<form action="recipes_favorite.php" method="post">
                    		<input type="submit" value="Add to Favorite" class="button">
                    		<input type="hidden" value="{$recipe_object->recipe_info.recipe_id}" name="recipe_id">
                    		</form>
                    	</td>
                    </tr>
                    {/if}
                </table>
            </td>
        </tr>
    </table>

{* DISPLAY POST COMMENT BOX *}
<div style='margin-left: auto; margin-right: auto;'>

  <div id="recipe_{$recipe_object->recipe_info.recipe_id}_postcomment"></div>
  <div id="recipe_{$recipe_object->recipe_info.recipe_id}_comments" style='margin-left: auto; margin-right: auto;'></div>
  
  {lang_javascript ids=39,155,175,182,183,184,185,187,784,787,829,830,831,832,833,834,835,854,856,891,1025,1026,1032,1034,1071}
  
  <script type="text/javascript">
    
    SocialEngine.RecipeComments = new SocialEngineAPI.Comments({ldelim}
      'canComment' : {if $allowed_to_comment}true{else}false{/if},
      'commentCode' : {if $setting.setting_comment_code}true{else}false{/if},
      'commentHTML' : '{$setting.setting_comment_html}',
      
      'type' : 'recipe',
      'typeIdentifier' : 'recipe_id',
      'typeID' : {$recipe_object->recipe_info.recipe_id},
      
      'typeTab' : 'recipes',
      'typeCol' : 'recipe',
      
      'initialTotal' : {$total_comments|default:0},
      
      'paginate' : false,
      'cpp' : 20
    {rdelim});
    
    SocialEngine.RegisterModule(SocialEngine.RecipeComments);
    
    // Backwards
    function addComment(is_error, comment_body, comment_date)
    {ldelim}
      SocialEngine.RecipeComments.addComment(is_error, comment_body, comment_date);
    {rdelim}
    
    function getComments(direction)
    {ldelim}
      SocialEngine.RecipeComments.getComments(direction);
    {rdelim}
    
  </script>
  
</div>

</div>
{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>
{include file='footer.tpl'}