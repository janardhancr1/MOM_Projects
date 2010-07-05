<?php /* Smarty version 2.6.14, created on 2010-05-31 03:18:15
         compiled from browse_recipes.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'browse_recipes.tpl', 23, false),)), $this);
?><?php
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

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
                                    <input type="text" name="recipe_search" value="<?php echo $this->_tpl_vars['recipe_search']; ?>
" class="text" style="width: 200px;"></td>
                                <td>
                                	<input type="submit" value="Search Recipes" class="button"/>
                                	<input type='hidden' name='p' value='<?php echo ((is_array($_tmp=@$this->_tpl_vars['p'])) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1)); ?>
' />
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