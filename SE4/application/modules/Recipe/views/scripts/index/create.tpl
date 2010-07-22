<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: create.tpl 6336 2010-06-15 00:56:20Z steve $
 * @author     Steve
 */
?>
<!--
<div class="headline">
  <h2>
    <?php echo $this->translate('Recipes');?>
  </h2>
  <div class="tabs">
    <?php
      // Render the menu
      echo $this->navigation()
        ->menu()
        ->setContainer($this->navigation)
        ->render();
    ?>
  </div>
</div>
-->

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>  

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Recipe/externals/images/recipe_recipe48.png' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Create Recipe');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/recipes/manage'>Back to My Recipes</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Create your recipe below, then share with Moms!');?></div>
</div>
<div class='global_form'>
	<br>
  <?php echo $this->form->render($this) ?>
 </div>
  
</div>