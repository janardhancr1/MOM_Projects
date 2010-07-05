{include file='header.tpl'}

{* $Id: browse_polls.tpl 246 2010-03-20 03:30:06Z Janardhan $ *}
<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'><img src='./images/icons/recipe_recipe48.png' border='0' class='icon_big'>Recipes</div>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <br />
                <fieldset>
                    <center>
                    	<form action="search_recipes.php" method="post">
                        <table>
                            <tr>
                                <td>
                                    Key words:</td>
                                <td>
                                    &nbsp;</td>
                                <td>
                                    <input type="text" name="recipe_search" value="{$recipe_search}" class="text" style="width: 200px;"></td>
                                <td>
                                	<input type="submit" value="Search Recipes" class="button"/>
                                	<input type='hidden' name='p' value='{$p|default:1}' />
									<input type='hidden' name='task' value='dosearch' />
                                </td>
                            </tr>
                        </table>
                        </form>
                    </center>
                </fieldset>
                <br />
                <div class="rcp_welcome_div">
                    <h1 style="text-align: center;">
                        Welcome to Recipe Binder, the best resource for finding and sharing recipes on Momburbia</h1>
                    <br />
                    <h2>
                        Find Recipes</h2>
                   <a href="search_recipes.php"><b>Search</b></a> for recipes,
                        or just browse the recipes by <a href="recipes_tag.php"><b>tags</b></a>, <a
                            href="recipes_toprated.php"><b>top rated</b></a>, or view the most <a href="recipes_recent.php">
                                <b>recently submitted</b></a> recipes.<br />
                    <br />
                    <h2>
                        Favourites</h2>
                    If you see a recipe you like add it to &ldquo;My Recipe
                        Binder&rdquo; as a <a href="recipes_favorite.php"><b>favourite</b></a>.<br />
                    <br />
                    <h2>
                        Add Recipes</h2>
                    Got a really good recipe? Why not <a href="user_recipe_new.php">
                        <b>add it to Recipe Binder</b></a>. You can choose to share it with everyone on
                        Momburbia, or just your friends.<br />
                    <br />
                    <h2>
                        Share Recipes</h2>
                    You can <b><a href="user_recipe.php">add Recipe Binder to your profile</a></b>, so that
                        all of your friends can discover your favourite recipes. You can also <b>share recipes</b>
                        with your friends directly via the share button.<br />
                    <br />
                    <h2>
                        Ratings and Reviews</h2>
                    You can <b>rate recipes</b> and leave helpful <b>comments</b>
                        and hints. The more involved you get the more useful Recipe Binder will become!<br />
                    <br />
                </div>
            </td>
        </tr>
    </table>
</div>
{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>
{include file='footer.tpl'}