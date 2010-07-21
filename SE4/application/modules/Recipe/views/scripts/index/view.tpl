<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: view.tpl 6585 2010-06-25 02:17:06Z steve $
 * @author     Steve
 */
?>

<?php if (empty($this->recipe)): ?>
  <?php echo $this->translate('The recipe you are looking for does not exist or has been deleted.') ?>
<?php return; endif; ?>
<h2>
  <?php echo $this->translate('%s\'s Recipes', $this->htmlLink($this->owner, $this->owner->getTitle())) ?>
</h2>

<div class="layout_middle">
<div class='recipes_view'>

  <form action="<?php echo $this->url() ?>" method="POST" onsubmit="return false;">
  <div>
  	<?php echo $this->htmlLink(
                      $this->recipe->getHref(),
                      $this->itemPhoto($this->recipe->getOwner(), 'thumb.icon', $this->recipe->getOwner()->username),
                      array('class' => 'recipes_browse_photo')
        ) ?>
  </div>
  	<div>
	    <h3>
	      <?php echo $this->recipe->title ?>
	    </h3>
    </div>
    <div class="recipe_desc">
      <?php echo $this->recipe->description ?>
    </div>
     <?php if (!empty($this->recipe->recipe_difficulty)): ?>
        <div>
				<b><?php echo $this->translate('Difficulty: ');?></b><?php echo $this->recipe->recipe_difficulty ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($this->recipe->recipe_prep_tm)): ?>
        <div>
				<b><?php echo $this->translate('Preparation Time: ');?></b><?php echo $this->recipe->recipe_prep_tm ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($this->recipe->recipe_cook_tm)): ?>
        <div>
				<b><?php echo $this->translate('Cooking Time: ');?></b><?php echo $this->recipe->recipe_cook_tm ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($this->recipe->recipe_serve_to)): ?>
        <div>
				<b><?php echo $this->translate('Server To: ');?></b><?php echo $this->recipe->recipe_serve_to ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($this->recipe->recipe_difficulty)): ?>
        <div>
				<b><?php echo $this->translate('Difficulty: ');?></b><?php echo $this->recipe->recipe_difficulty ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($this->recipe->recipe_ingredients)): ?>
        <div>
				<b><?php echo $this->translate('Ingredients: ');?></b><?php echo $this->recipe->recipe_ingredients ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($this->recipe->recipe_method)): ?>
        <div>
				<b><?php echo $this->translate('Method: ');?></b><?php echo $this->recipe->recipe_method ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($this->recipe->recipe_tags)): ?>
        <div>
				<b><?php echo $this->translate('Tags: ');?></b><?php echo $this->recipe->recipe_tags ?>
        </div>
      <?php endif; ?>  
    <div class="recipe_stats">
        &nbsp; <?php echo $this->translate(array('%s view', '%s views', $this->recipe->views), $this->locale()->toNumber($this->recipe->views)) ?>
    </div>
  </form>

  <?php echo $this->action("list", "comment", "core", array("type"=>"recipe", "id"=>$this->recipe->recipe_id)) ?>

</div>
</div>

