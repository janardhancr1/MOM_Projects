<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: view.tpl 6585 2010-06-25 02:17:06Z steve $
 * @author     Steve
 */
?>

<div class="layout_middle">
<div class="headline_header">
	<img src='./application/modules/Answer/externals/images/ans_ans48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Momburbia Answers');?>
    <div class="smallheadline"><?php echo $this->translate('Ask, Answer and Explore. Questions and Answers on everything relating to being a mom.');?></div>
</div>
<div class='answer_view'>
	<ul class="answers_browse">
      <li id="recipe-item-<?php echo $this->answer->answer_id ?>">
        <?php echo $this->htmlLink($this->answer->getHref(), $this->itemPhoto($this->owner, 'thumb.icon'), array('class' => 'answers_browse_photo')) ?>
        <div class="recipes_browse_info">
          <?php echo $this->answer->title ?>
          
          <div class="recipes_browse_info_date">
              <?php echo $this->timestamp($this->answer->creation_date) ?>
          </div>
      </li>
    </ul>
    
    
    
     <?php if (0 == count($this->paginator) ): ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('There are no answers yet.') ?>
      </span>
    </div>
  <?php else: // $this->answers is NOT empty ?>
    <ul class="answers_browse">
      <?php foreach ($this->paginator as $answer): ?>
      <li id="answer-item-<?php echo $answer->answer_id ?>">
        <?php echo $this->htmlLink(
                      $answer->getHref(),
                      $this->itemPhoto($answer->getOwner(), 'thumb.icon', $answer->getOwner()->username),
                      array('class' => 'answers_browse_photo')
        ) ?>
        <div class="answers_browse_info">
        <div class="answers_browse_info_desc">
        	<?php  echo "Answer: ".$answer->answer_description ?>
        </div>
          <div class="answers_browse_info_date">
            <?php echo $this->translate('Answered by %s', $this->htmlLink($answer->getOwner(), $answer->getOwner()->getTitle())) ?>
            <?php echo $this->timestamp($answer->creation_date) ?>
          </div>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; // $this->answers is NOT empty ?>
  <?php echo $this->paginationControl($this->paginator, null, null, null, array('answer_search'=>$this->search)); ?>
</div>
  <?php
  	if($this->viewer != $this->answer->user_id) 
  		echo $this->form->render($this) 
  ?>
</div>
</div>
