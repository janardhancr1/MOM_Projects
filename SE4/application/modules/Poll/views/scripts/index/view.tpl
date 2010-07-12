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
    <h3>
      <?php echo $this->recipe->title ?>
    </h3>
    <div class="recipe_desc">
      <?php echo $this->recipe->description ?>
    </div>
    <ul id="recipe_options" class="recipe_options">
      <?php foreach ($this->recipeOptions as $i => $option): ?>
      <li id="recipe_item_option_<?php echo $option->recipe_option_id ?>">
        <div class="recipe_has_voted" <?php echo ($this->hasVoted?'':'style="display:none;"') ?>>
          <div class="recipe_option">
            <?php echo $option->recipe_option ?>
          </div>
          <?php $pct = $this->votes
                     ? floor(100*($option->votes/$this->votes))
                     : 0;
                if (!$pct)
                  $pct = 1;
                // NOTE: recipe-answer graph & text is actually rendered via
                // javascript.  The following HTML is there as placeholders
                // and for javascript backwards compatibility (though
                // javascript is required for voting).
           ?>
          <div id="recipe-answer-<?php echo $option->recipe_option_id ?>" class='recipe_answer recipe-answer-<?php echo (($i%8)+1) ?>' style='width: <?php echo .7*$pct; // set width to 70% of its real size to as to fit text label too ?>%;'>
            &nbsp;
          </div>
          <div class="recipe_answer_total">
            <?php echo $this->translate(array('%s vote', '%s votes', $option->votes), $this->locale()->toNumber($option->votes)) ?>
            (<?php echo $this->locale()->toNumber($option->votes ? $pct : 0) ?>%)
          </div>
        </div>
        <div class="recipe_not_voted" <?php echo ($this->hasVoted?'style="display:none;"':'') ?> >
          <div class="recipe_radio" id="recipe_radio_<?php echo $option->recipe_option_id ?>">
            <input id="recipe_option_<?php echo $option->recipe_option_id ?>" 
                   type="radio" name="recipe_options" value="<?php echo $option->recipe_option_id ?>"
                   <?php if ($this->hasVoted == $option->recipe_option_id): ?>checked="true"<?php endif; ?>
                   <?php if ($this->hasVoted && !$this->canChangeVote): ?>disabled="true"<?php endif; ?>
                   />
          </div>
          <label for="recipe_option_<?php echo $option->recipe_option_id ?>">
            <?php echo $option->recipe_option ?>
          </label>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
    <div class="recipe_stats">
      <a href='javascript:void(0);' onClick='toggleRecipeResults(); this.blur();' id="recipe_toggleResultsLink">
        <?php echo $this->translate($this->hasVoted ? 'Show Questions' : 'Show Results' ) ?></a>
        &nbsp;|&nbsp; <?php echo $this->htmlLink(Array('module'=>'activity', 'controller'=>'index', 'action'=>'share', 'route'=>'default', 'type'=>'recipe', 'id'=>$this->recipe->getIdentity(), 'format' => 'smoothbox'), $this->translate("Share"), array('class' => 'smoothbox')); ?>
        &nbsp;|&nbsp; <?php echo $this->htmlLink(Array('module'=>'core', 'controller'=>'report', 'action'=>'create', 'route'=>'default', 'subject'=>$this->recipe->getGuid(), 'format' => 'smoothbox'), $this->translate("Report"), array('class' => 'smoothbox')); ?>
        &nbsp;|&nbsp; <span id="recipe_vote_total"><?php echo $this->translate(array('%s vote', '%s votes', $this->votes), $this->locale()->toNumber($this->votes)) ?></span>
        &nbsp;|&nbsp; <?php echo $this->translate(array('%s view', '%s views', $this->recipe->views), $this->locale()->toNumber($this->recipe->views)) ?>
    </div>
  </form>

  <?php echo $this->action("list", "comment", "core", array("type"=>"recipe", "id"=>$this->recipe->recipe_id)) ?>

</div>
</div>


<script type="text/javascript">
//<![CDATA[
var toggleRecipeResults = function() {
  if ('none' == $$('#recipe_options div.recipe_has_voted')[0].getStyle('display')) {
    $$('#recipe_options div.recipe_has_voted').show();
    $$('#recipe_options div.recipe_not_voted').hide();
    $('recipe_toggleResultsLink').set('text', '<?php echo $this->translate('Show Questions') ?>');
  } else {
    $$('#recipe_options div.recipe_has_voted').hide();
    $$('#recipe_options div.recipe_not_voted').show();
    $('recipe_toggleResultsLink').set('text', '<?php echo $this->translate('Show Results') ?>')
  }
}
var renderRecipeResults = function (recipeAnswers, recipe_votes_total) {
    if (recipeAnswers && 'array' == $type(recipeAnswers)) {
        recipeAnswers.each(function(option) {
            var div = $('recipe-answer-'+option.recipe_option_id);
            var pct = recipe_votes_total > 0
                    ? Math.floor(100*(option.votes / recipe_votes_total))
                    : 1;
            if (pct < 1)
                pct = 1;
            // set width to 70% of actual width to fit text on same line
            div.style.width = (.7*pct)+'%';
            div.getNext('div.recipe_answer_total')
               .set('text',  option.votesTranslated + ' ('+(option.votes?pct:'0')+'%)');
            <?php if (!$this->canChangeVote && $this->hasVoted): ?>
              $$('.recipe_radio input').set('disabled', true);
            <?php endif ?>
        });
    }
}
<?php if ($this->viewer_id): ?>
var recipeVote = function(el) {
  var url = '<?php echo $this->url(array(), 'recipe_vote') ?>';
  var recipe_id = '<?php echo $this->recipe->getIdentity() ?>';
  new Request.JSON({
    url: url,
    method: 'post',
    onRequest: function() {
      $('recipe_radio_' + el.value).toggleClass('recipe_radio_loading');
    },
    onComplete: function(responseJSON) {
      $('recipe_radio_' + el.value).toggleClass('recipe_radio_loading');
      if ($type(responseJSON)=='object' && responseJSON.error) {
        Smoothbox.open( new Element('div', {
          'html': responseJSON.error + '<br /><br /><?php echo $this->formButton('Close', 'Close', array('onclick'=>'parent.Smoothbox.close()')) ?>'
        }));
      } else {
        $('recipe_vote_total').set('text', responseJSON.votes_total+' vote'+(responseJSON.votes_total==1?'':'s'));
        renderRecipeResults(responseJSON.recipeOptions, responseJSON.votes_total);        
        toggleRecipeResults();
      }
      <?php if (!$this->canChangeVote): ?>$$('.recipe_radio input').set('disabled', true);<?php endif; ?>
    }
  }).send('format=json&recipe_id='+recipe_id+'&option_id='+el.value)
}

<?php else: ?>
var recipeVote = function(el) {
  window.location.href = '<?php echo $this->url(array(), 'user_login') ?>';
}
<?php endif; ?>

en4.core.runonce.add(function(){
  $$('.recipe_radio input').addEvent('click', function(){ recipeVote(this); });
});

//]]>
</script>