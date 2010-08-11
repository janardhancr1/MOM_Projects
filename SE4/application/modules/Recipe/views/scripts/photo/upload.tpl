<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: upload.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     Jung
 */
?>


<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Recipe/externals/images/recipe_recipe48.png' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Add New Photos');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/recipes/manage'>Back to My Recipes</a></div>
	</div>
    <div class="smallheadline"><?php echo $this->translate('Choose photos on your computer to add to this recipe listing. (2MB maximum)');?></div>
</div>
<div style='padding-top:20px;padding-right:10px;width:690px'>

<?php echo $this->form->render($this) ?>
</div>