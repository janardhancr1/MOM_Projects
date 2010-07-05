{include file='header.tpl'}

<div style="padding-left:2px">
{* $Id: user_recipe.tpl 12 2009-01-11 06:04:12Z john $ *}
<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<img src='./images/icons/recipe_recipe48.png' border='0' class='icon_big'>
<div class='page_header'>{lang_print id=7000037}</div>
<div>{lang_print id=7000039}</div>

<div style='margin-top: 20px;'>
  <div class='button' style='float: left;'>
    <a href='user_recipe_new.php'><img src='./images/icons/recipe_new16.png' border='0' class='button'>{lang_print id=7000040}</a>
  </div>
  <div class='button' style='float: left; padding-left: 20px;'>
    <a href="javascript:void(0);" onClick="this.blur();if($('recipe_search').style.display=='none') {literal}{{/literal} $('recipe_search').style.display='block'; $('recipe_searchtext').focus(); {literal}} else {{/literal} $('recipe_search').style.display='none'; {literal}}{/literal}"><img src='./images/icons/search16.gif' border='0' class='button'>{lang_print id=7000041}</a>
  </div>
  <div style='clear: both; height: 0px;'></div>
</div>

{* SHOW SEARCH FIELD IF ANY ENTRIES EXIST *}
<div class='recipe_search' id='recipe_search' style='width: 550px; margin-top: 10px; text-align: center;{if $search == ""} display: none;{/if}'>
  <form action='user_recipe.php' name='searchform' method='post'>
  <table cellpadding='0' cellspacing='0' align='center'>
    <tr>
      <td>{lang_print id=7000042}&nbsp;</td>
      <td><input type='text' name='search' maxlength='100' size='30' value='{$search}' class='text' id='recipe_searchtext'>&nbsp;</td>
      <td>{lang_block id=646 var=langBlockTemp}<input type='submit' class='button' value='{$langBlockTemp}'>{/lang_block}</td>
    </tr>
  </table>
  <input type='hidden' name='s' value='{$s}'>
  <input type='hidden' name='p' value='{$p}'>
  </form>
</div>

{* DISPLAY PAGINATION MENU IF APPLICABLE *}
{if $maxpage > 1}
  <div class='center'>
    {if $p != 1}
      <a href='user_recipe.php?s={$s}&search={$search}&p={math equation="p-1" p=$p}'>&#171; {lang_print id=182}</a>
    {else}
      <font class='disabled'>&#171; {lang_print id=182}</font>
    {/if}
    &nbsp;|&nbsp;
    {if $p_start==$p_end}
      {lang_sprintf id=7000035 1=$p_start 2=$total_recipes}
    {else}
      {lang_sprintf id=7000036 1=$p_start 2=$p_end 3=$total_recipes}
    {/if}
    &nbsp;|&nbsp;
    {if $p != $maxpage}
      <a href='user_recipe.php?s={$s}&search={$search}&p={math equation="p+1" p=$p}'>{lang_print id=183} &#187;</a>
    {else}
      <font class='disabled'>{lang_print id=183} &#187;</font>
    {/if}
  </div>
  <br />
{/if}
<br />
{* JAVASCRIPT *}
{lang_javascript ids=7000046,7000047,7000055,7000114,7000115}

<script type='text/javascript' src="./include/js/class_recipe.js"></script>
<script type='text/javascript'>
<!--
  SocialEngine.recipes = new SocialEngineAPI.recipes();
  SocialEngine.RegisterModule(SocialEngine.recipes);
//-->
</script>

  
{section name=recipe_loop loop=$recipes}
<div style='width: 550px;' id='serecipe_{$recipes[recipe_loop].recipe_id}' class="seRecipeRow recipe">
  <table cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td class='recipe_left' width='100%'>
        <div class='recipe_title'>
          {$recipes[recipe_loop].recipe_name|truncate:30:"...":true}
        </div>
        <div class='recipe_stats'>
          {assign var='recipe_datecreated' value=$datetime->time_since($recipes[recipe_loop].recipe_datecreated)}
          {lang_sprintf id=7000122 1=$recipes[recipe_loop].recipe_views}
          - {lang_sprintf id=507 1=$recipes[recipe_loop].total_comments}
          - {lang_sprintf id=$recipe_datecreated[0] 1=$recipe_datecreated[1]}
        </div>
        {if $recipes[recipe_loop].recipe_description != ""}
          <div style='margin-top: 8px; margin-bottom: 8px;'>{$recipes[recipe_loop].recipe_description|escape:html|truncate:197:"...":true}</div>
        {/if}
        <div class='recipe_options'>
          {* VIEW *}
          <div style='float: left;'><a href='{$url->url_create("recipe", $user->user_info.user_username, $recipes[recipe_loop].recipe_id)}'><img src='./images/icons/recipe_recipe16.png' border='0' class='button'>{lang_print id=7000121}</a></div>
            
          {* EDIT *}
          <div style='float: left; padding-left: 15px;'><a href='user_recipe_edit.php?recipe_id={$recipes[recipe_loop].recipe_id}'><img src='./images/icons/recipe_edit16.gif' border='0' class='button'>{lang_print id=7000057}</a></div>
            
          {* DELETE *}
          <div class="serecipesDelete" style='float: left; padding-left: 15px;'><a href='javascript:void(0);' onclick="SocialEngine.recipes.deleterecipe({$recipes[recipe_loop].recipe_id});"><img src='./images/icons/recipe_delete16.gif' border='0' class='button'>{lang_print id=7000048}</a></div>
          <div style='clear: both; height: 0px;'></div>
        </div>
      </td>
    </tr>
  </table>
</div>
{/section}

<div style='clear: both; height: 0px;'></div>

{* HIDDEN DIV TO DISPLAY DELETE CONFIRMATION MESSAGE *}
<div style='display: none;' id='confirmrecipedelete'>
  <div style='margin-top: 10px;'>
    {lang_print id=7000056}
  </div>
  <br>
  <input type='button' class='button' value='{lang_print id=175}' onClick='parent.TB_remove();parent.SocialEngine.recipes.deleterecipeConfirm(parent.SocialEngine.recipes.currentConfirmDeleteID);'> <input type='button' class='button' value='{lang_print id=39}' onClick='parent.TB_remove();'>
</div>

{* DISPLAY PAGINATION MENU IF APPLICABLE *}
{if $maxpage > 1}
  <div class='center'>
    {if $p != 1}
      <a href='user_recipe.php?s={$s}&search={$search}&p={math equation="p-1" p=$p}'>&#171; {lang_print id=182}</a>
    {else}
      <font class='disabled'>&#171; {lang_print id=182}</font>
    {/if}
    &nbsp;|&nbsp;
    {if $p_start==$p_end}
      {lang_sprintf id=7000035 1=$p_start 2=$total_recipes}
    {else}
      {lang_sprintf id=7000036 1=$p_start 2=$p_end 3=$total_recipes}
    {/if}
    &nbsp;|&nbsp;
    {if $p != $maxpage}
      <a href='user_recipe.php?s={$s}&search={$search}&p={math equation="p+1" p=$p}'>{lang_print id=183} &#187;</a>
    {else}
      <font class='disabled'>{lang_print id=183} &#187;</font>
    {/if}
  </div>
  <br />
{/if}



{* SHOW NULL MESSAGE *}
{if $total_recipes == 0 && !empty($search)}

  <br>
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='result'><img src='./images/icons/bulb16.gif' border='0' class='icon'>{lang_print id=7000043}</td></tr>
  </table>
  
{/if}



<div{if $total_recipes>0} style='display: none;'{/if} id='recipenullmessage'>
  <br>    
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='result'><img src='./images/icons/bulb16.gif' border='0' class='icon'>{lang_print id=7000044}</td></tr>
  </table>
</div>

</div>
</div>
{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>
{include file='footer.tpl'}