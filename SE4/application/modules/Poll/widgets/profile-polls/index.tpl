<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6438 2010-06-17 23:39:55Z jung $
 * @author     Steve
 */
?>

<ul class="recipes_browse">
  <?php foreach ($this->paginator as $item): ?>
    <li>
      <div class='recipes_browse_info'>
        <?php echo $this->htmlLink(array('route'=>'recipe_view', 'user_id'=>$item->user_id, 'recipe_id'=>$item->recipe_id), $item->getTitle()) ?>
        <div class='recipes_browse_info_date'>
          <?php echo $this->translate('Posted') ?> <?php echo $this->timestamp($item->creation_date) ?>
        </div>
        <div class='recipes_browse_info_desc'>
          <?php echo $item->description ?>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
<?php if($this->paginator->getTotalItemCount() > $this->items_per_page):?>
  <?php echo $this->htmlLink($this->url(array('user_id' => Engine_Api::_()->core()->getSubject()->getIdentity()), 'recipe_browse'), $this->translate('View All Recipes'), array('class' => 'buttonlink item_icon_recipe')) ?>
<?php endif;?>