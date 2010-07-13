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

<div class='layout_middle'>
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
		 <div class="recipes_browse_options">
         <?php echo $this->htmlLink(array('route' => 'recipe_delete', 'recipe_id' => $recipe->recipe_id), $this->translate('Delete Recipe'), array(
            'class'=>'buttonlink smoothbox icon_poll_delete'
           )) ?>
          <a href='<?php echo $this->url(array('recipe_id' => $recipe->recipe_id), 'recipe_edit', true) ?>' class='buttonlink icon_recipe_edit'><?php echo $this->translate('Edit Recipe');?></a>
        </div>
        <div class="recipes_browse_info">
          <?php echo $this->htmlLink($recipe->getHref(), $recipe->recipe_name) ?>
          
          <div class="recipes_browse_info_date">
              <?php echo $this->translate('Posted by %s', $this->htmlLink($this->users[$recipe->user_id], $this->users[$recipe->user_id]->getTitle())) ?>
              <?php echo $this->timestamp($recipe->creation_date) ?>
              -
              <?php echo $this->translate(array('%s view', '%s views', $recipe->views), $this->locale()->toNumber($recipe->views)) ?>
          </div>
          
          <?php if (!empty($recipe->recipe_description)): ?>
            <div class="recipes_browse_info_desc">
              <?php echo $recipe->recipe_description ?>
            </div>
          <?php endif; ?>
         
         
      </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; // $this->recipes is NOT empty ?>
  <?php echo $this->paginationControl($this->paginator); ?>
</div>