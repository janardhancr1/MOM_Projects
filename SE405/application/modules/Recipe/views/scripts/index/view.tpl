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
<script type="text/javascript">
  var pre_rate = <?php echo $this->recipe->rating;?>;
  var rated = '<?php echo $this->rated;?>';
  var recipe_id = <?php echo $this->recipe->recipe_id;?>;
  var total_votes = <?php echo $this->rating_count;?>;
  var viewer = <?php echo $this->viewer_id;?>;
  
  function rating_over(rating) {
    if (rated == 1){
      $('rating_text').innerHTML = "<?php echo $this->translate('you already rated');?>";
      //set_rating();
    }
    else if (viewer == 0){
      $('rating_text').innerHTML = "<?php echo $this->translate('please login to rate');?>";
    }
    else{
      $('rating_text').innerHTML = "<?php echo $this->translate('click to rate');?>";
      for(var x=1; x<=5; x++) {
        if(x <= rating) {
          $('rate_'+x).set('class', 'rating_star_big_generic rating_star_big');
        } else {
          $('rate_'+x).set('class', 'rating_star_big_generic rating_star_big_disabled');
        }
      }
    }
  }
  function rating_out() {
    $('rating_text').innerHTML = " <?php echo $this->translate(array('%s rating', '%s ratings', $this->rating_count),$this->locale()->toNumber($this->rating_count)) ?>";
    if (pre_rate != 0){
      set_rating();
    }
    else {
      for(var x=1; x<=5; x++) {
        $('rate_'+x).set('class', 'rating_star_big_generic rating_star_big_disabled');
      }
    }
  }

  function set_rating() {
    var rating = pre_rate;
    $('rating_text').innerHTML = "<?php echo $this->translate(array('%s rating', '%s ratings', $this->rating_count),$this->locale()->toNumber($this->rating_count)) ?>";
    for(var x=1; x<=parseInt(rating); x++) {
      $('rate_'+x).set('class', 'rating_star_big_generic rating_star_big');
    }

    for(var x=parseInt(rating)+1; x<=5; x++) {
      $('rate_'+x).set('class', 'rating_star_big_generic rating_star_big_disabled');
    }

    var remainder = Math.round(rating)-rating;
    if (remainder <= 0.5 && remainder !=0){
      var last = parseInt(rating)+1;
      $('rate_'+last).set('class', 'rating_star_big_generic rating_star_big_half');
    }
  }
  
  function rate(rating) {
    $('rating_text').innerHTML = "<?php echo $this->translate('Thanks for rating!');?>";
    for(var x=1; x<=5; x++) {
      $('rate_'+x).set('onclick', '');
    }
    (new Request.JSON({
      'format': 'json',
      'url' : '<?php echo $this->url(array('module' => 'recipe', 'controller' => 'index', 'action' => 'rate'), 'default', true) ?>',
      'data' : {
        'format' : 'json',
        'rating' : rating,
        'recipe_id': recipe_id
      },
      'onRequest' : function(){
        rated = 1;
        total_votes = total_votes+1;
        pre_rate = (pre_rate+rating)/total_votes;
        set_rating();
      },
      'onSuccess' : function(responseJSON, responseText)
      {
        $('rating_text').innerHTML = responseJSON[0].total+" ratings";
      }
    })).send();
    
  }
  
  var tagAction =function(tag){
    $('tag').value = tag;
    $('filter_form').submit();
  }
  
  en4.core.runonce.add(set_rating);
</script>

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>  

<div class="layout_middle">
<div class="button" style="float:right"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/recipes'>Back to Recipes</a></div>
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

	<?php echo $this->htmlLink($this->recipe->getHref(), $this->itemPhoto($this->recipe,'thumb.profile')) ?>
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
			<p align="justify"><?php echo nl2br($this->recipe->recipe_ingredients) ?></p>
		<?php endif; ?>
	</div>
</div>
<div>
	<div><b><?php echo $this->translate('Method: ');?></b></div>
	<div>
		<?php if (!empty($this->recipe->recipe_method)): ?>
			<p align="justify"><?php echo nl2br($this->recipe->recipe_method) ?></p>
		<?php endif; ?>
	</div>
</div>
<div>
	<b><?php echo $this->translate('Tags: ');?></b>
	<?php if (!empty($this->recipe->recipe_tags)): ?>
		<?php echo $this->recipe->recipe_tags ?>
	<?php endif; ?>  
</div>
 <div id="video_rating" class="rating" onmouseout="rating_out();">
      <span id="rate_1" class="rating_star_big_generic" <?php if (!$this->rated && $this->viewer_id):?>onclick="rate(1);"<?php endif; ?> onmouseover="rating_over(1);"></span>
      <span id="rate_2" class="rating_star_big_generic" <?php if (!$this->rated && $this->viewer_id):?>onclick="rate(2);"<?php endif; ?> onmouseover="rating_over(2);"></span>
      <span id="rate_3" class="rating_star_big_generic" <?php if (!$this->rated && $this->viewer_id):?>onclick="rate(3);"<?php endif; ?> onmouseover="rating_over(3);"></span>
      <span id="rate_4" class="rating_star_big_generic" <?php if (!$this->rated && $this->viewer_id):?>onclick="rate(4);"<?php endif; ?> onmouseover="rating_over(4);"></span>
      <span id="rate_5" class="rating_star_big_generic" <?php if (!$this->rated && $this->viewer_id):?>onclick="rate(5);"<?php endif; ?> onmouseover="rating_over(5);"></span>
      <span id="rating_text" class="rating_text"><?php echo $this->translate('click to rate');?></span>
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

