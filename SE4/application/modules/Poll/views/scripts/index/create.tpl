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
<div class='search_box'>
	<div class='page_header'>
		<img src='./application/modules/Recipe/externals/images/recipe_recipe48.gif' border='0' class='icon_big'><?php echo $this->translate('Create New Recipe');?>
		<div>
			<?php echo $this->translate('Give your new recipe a title and description. If you are asking a question with this recipe, you should put it in your title.
Allowed HTML Tags: a,b,br,font,i,img');?>
		</div>
	</div>
</div>

<div class='global_form'>
	<br>
  <?php echo $this->form->render($this) ?>
 
  
</div>