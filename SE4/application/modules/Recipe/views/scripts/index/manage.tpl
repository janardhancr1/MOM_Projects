<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manage.tpl 6160 2010-06-05 02:20:37Z alex $
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
    <?php echo $this->translate('My Recipes');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/recipes'>Back to Recipes</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Upload new Recipe today and share it with friends.');?></div>
</div>
<?php if($this->can_create):?>
    <div>
      <ul>
        <li>
          <a href='<?php echo $this->url(array(), 'recipe_create') ?>' class='buttonlink icon_recipe_new'>
            <?php echo $this->translate('Create New Recipe') ?>
          </a>
        </li>
      </ul>
    </div>
  <?php endif;?>
 <div style='padding-top:20px;padding-right:10px;width:690px'>
  <?php if (0 == count($this->paginator) ): ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('There are no recipes yet.') ?>
        <?php if (TRUE): // @todo check if user is allowed to create a recipe ?>
        <?php echo $this->translate('Why don\'t you %1$screate one%2$s', '<a href="'.$this->url(array(), 'recipe_create').'">', '</a>') ?>
        <?php endif; ?>
      </span>
    </div>
  <?php else: // $this->recipes is NOT empty ?>
    <ul class="recipes_browse">
      <?php foreach ($this->paginator as $recipe): ?>
      <li id="recipe-item-<?php echo $recipe->recipe_id ?>">
        <?php echo $this->htmlLink($recipe->getHref(), $this->itemPhoto($this->owner, 'thumb.icon'), array('class' => 'recipes_browse_photo')) ?>
        <div class="recipes_browse_info">
          <?php echo $this->htmlLink($recipe->getHref(), $recipe->title) ?>
          
          <div class="recipes_browse_info_date">
              <?php echo $this->translate('Posted by %s', $this->htmlLink($this->users[$recipe->user_id], $this->users[$recipe->user_id]->getTitle())) ?>
              <?php echo $this->timestamp($recipe->creation_date) ?>
              -
              <?php echo $this->translate(array('%s view', '%s views', $recipe->views), $this->locale()->toNumber($recipe->views)) ?>
          </div>
          
          <?php if (!empty($recipe->description)): ?>
            <div class="recipes_browse_info_desc">
              <?php echo $recipe->description ?>
            </div>
          <?php endif; ?>
         <div class="recipes_browse_options">
         <a href='<?php echo $this->url(array('recipe_id' => $recipe->recipe_id), 'recipe_edit', true) ?>' class='buttonlink icon_recipe_edit'><?php echo $this->translate('Edit Recipe');?></a>
         <?php echo $this->htmlLink(array('route' => 'recipe_delete', 'recipe_id' => $recipe->recipe_id), $this->translate('Delete Recipe'), array(
            'class'=>'buttonlink smoothbox icon_poll_delete'
           )) ?>
        </div>
         
      </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; // $this->recipes is NOT empty ?>
  <?php echo $this->paginationControl($this->paginator); ?>
</div>