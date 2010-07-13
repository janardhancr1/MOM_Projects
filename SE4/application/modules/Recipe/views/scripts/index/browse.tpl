<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: browse.tpl 6398 2010-06-16 23:33:03Z steve $
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

<div class='layout_right'>
  <?php echo $this->search_form->render($this) ?>
  <?php if($this->can_create):?>
    <div class="quicklinks">
      <ul>
        <li>
          <a href='<?php echo $this->url(array(), 'recipe_create') ?>' class='buttonlink icon_poll_new'>
            <?php echo $this->translate('Create New Recipe') ?>
          </a>
        </li>
      </ul>
    </div>
  <?php endif;?>

  <script type="text/javascript">
  //<![CDATA[
    $('browse_recipes_by').addEvent('change', function(){
      $(this).getParent('form').submit();
    });
  //]]>
  </script>
</div>
<div class='layout_middle'>
  <?php if (0 == count($this->paginator) ): ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('There are no recipes yet.') ?>
        <?php if ($this->can_create): ?>
        <?php echo $this->translate('Why don\'t you %1$screate one%2$s', '<a href="'.$this->url(array(), 'recipe_create').'">', '</a>') ?>
        <?php endif; ?>
      </span>
    </div>
  <?php else: // $this->recipes is NOT empty ?>
    <ul class="recipes_browse">
      <?php foreach ($this->paginator as $recipe): ?>
      <li id="recipe-item-<?php echo $recipe->recipe_id ?>">
        <?php echo $this->htmlLink(
                      $recipe->getHref(),
                      $this->itemPhoto($recipe->getOwner(), 'thumb.icon', $recipe->getOwner()->username),
                      array('class' => 'recipes_browse_photo')
        ) ?>
        <div class="recipes_browse_info">
          <h3>
            <?php echo $this->htmlLink($recipe->getHref(), $recipe->recipe_name) ?>
          </h3>
          <div class="recipes_browse_info_date">
            <?php echo $this->translate('Posted by %s', $this->htmlLink($recipe->getOwner(), $recipe->getOwner()->getTitle())) ?>
            <?php echo $this->timestamp($recipe->creation_date) ?>
            <?php echo $this->translate(array('%s view', '%s views', $recipe->views), $this->locale()->toNumber($recipe->views)) ?>
          </div>
          <?php if (!empty($recipe->recipe_description)): ?>
            <div class="recipes_browse_info_desc">
              <?php  echo $recipe->recipe_description ?>
            </div>
          <?php endif; ?>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; // $this->recipes is NOT empty ?>
  <?php echo $this->paginationControl($this->paginator, null, null, null, array('recipe_search'=>$this->search)); ?>
</div>
