<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6438 2010-06-17 23:39:55Z jung $
 * @author     Steve
 */
?>

<ul class="answers_browse">
  <?php foreach ($this->paginator as $item): ?>
    <li>
      <div class='answers_browse_info'>
        <?php echo $this->htmlLink(array('route'=>'answer_view', 'user_id'=>$item->user_id, 'answer_id'=>$item->answer_id), $item->getTitle()) ?>
        <div class='answers_browse_info_date'>
          <?php echo $this->translate('Posted') ?> <?php echo $this->timestamp($item->creation_date) ?>
        </div>
        <div class='answers_browse_info_desc'>
          <?php echo $item->description ?>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
<?php if($this->paginator->getTotalItemCount() > $this->items_per_page):?>
  <?php echo $this->htmlLink($this->url(array('user_id' => Engine_Api::_()->core()->getSubject()->getIdentity()), 'answer_browse'), $this->translate('View All Questions'), array('class' => 'buttonlink item_icon_answer')) ?>
<?php endif;?>