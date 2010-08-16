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

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>  

<div class="layout_middle">

<?php if (empty($this->recipe)): ?>
  <?php echo $this->translate('The recipe you are looking for does not exist or has been deleted.') ?>
<?php return; endif; ?>
<h2>
  <?php echo $this->translate('%s\'s Recipes', $this->htmlLink($this->owner, $this->owner->getTitle())) ?>
</h2>
<div class='recipes_view'>
<div>
	<h2>
		<?php echo $this->recipe->title ?>
	</h2>
</div>
<div>
	<?php echo $this->recipe->description ?>
</div>

<div style='height:200px;float:left; margin-right:50px'>
	<div style='vertical-align:middle'>

	<?php echo $this->htmlLink($this->recipe->getHref(), $this->itemPhoto($this->recipe)) ?>
	</div>
</div>
<div>
	<b><?php echo $this->translate('Difficulty: ');?></b>
	<?php if (!empty($this->recipe->recipe_difficulty)): ?>
		<?php echo $this->recipe->recipe_difficulty ?>
	<?php endif; ?>
</div>
<div>
	<b><?php echo $this->translate('Preparation Time: ');?></b>
	<?php if (!empty($this->recipe->recipe_prep_tm)): ?>
		<?php echo $this->recipe->recipe_prep_tm ?>
	<?php endif; ?>
</div>
<div>
	<b><?php echo $this->translate('Cooking Time: ');?></b>
	<?php if (!empty($this->recipe->recipe_cook_tm)): ?>
		<?php echo $this->recipe->recipe_cook_tm ?>
	<?php endif; ?>
</div>
<div>
	<b><?php echo $this->translate('Server To: ');?></b>
	<?php if (!empty($this->recipe->recipe_serve_to)): ?>
		<?php echo $this->recipe->recipe_serve_to ?>
	<?php endif; ?>
</div>
<div style='height:10px;clear:both'>
</div>
<div>
	<div><b><?php echo $this->translate('Ingredients: ');?></b></div>
	<div>
		<?php if (!empty($this->recipe->recipe_ingredients)): ?>
			<?php echo $this->recipe->recipe_ingredients ?>
		<?php endif; ?>
	</div>
</div>
<div>
	<div><b><?php echo $this->translate('Method: ');?></b></div>
	<div>
		<?php if (!empty($this->recipe->recipe_method)): ?>
			<?php echo $this->recipe->recipe_method ?>
		<?php endif; ?>
	</div>
</div>
<div>
	<b><?php echo $this->translate('Tags: ');?></b>
	<?php if (!empty($this->recipe->recipe_tags)): ?>
		<?php echo $this->recipe->recipe_tags ?>
	<?php endif; ?>  
</div>
  <?php foreach( $this->paginator as $photo ): ?>
    <?php if($this->recipe->photo_id != $photo->file_id):?>
    
        <div class="classifieds_thumbs_description">
          <?php if( '' != $photo->getDescription() ): ?>
            <?php echo $this->string()->chunk($photo->getDescription(), 100) ?>
          <?php endif; ?>
        </div>
        <?php echo $this->htmlImage($photo->getPhotoUrl(), $photo->getTitle(), array(
          'id' => 'media_photo'
        )); ?>
     
    <?php endif; ?>
  <?php endforeach;?><br>
<div>
	<b><?php echo $this->translate(array('%s view', '%s views', $this->recipe->views), $this->locale()->toNumber($this->recipe->views)) ?></b>
</div>

  <?php echo $this->action("list", "comment", "core", array("type"=>"recipe", "id"=>$this->recipe->recipe_id)) ?>

</div>

</div>

