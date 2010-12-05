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

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>  

<div class="layout_middle">
<div class="headline_header">
	<img src='./application/modules/Answer/externals/images/ans_ans48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Momburbia Answers');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/answers'>Back to Questions</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Questions and Answers on everything relating to being a mom.');?></div>
</div>
<div class='answer_view'>
	<ul class="answers_browse">
      <li id="recipe-item-<?php echo $this->answer->answer_id ?>" style="border-bottom-width: 1px;margin-bottom:15px">
        <?php echo $this->htmlLink($this->answer->getHref(), $this->itemPhoto($this->owner, 'thumb.icon'), array('class' => 'answers_browse_photo')) ?>
        <div class="answers_browse_info">
          <?php echo $this->answer->title ?>
          <div class="answers_browse_info_date">
			<?php if (!empty($this->answer->description)): ?>
				<?php echo $this->answer->description ?>
			<?php endif; ?>
		</div>
		<div class="answers_browse_info_date">
			<?php if (!empty($this->answer->answer_tags)): ?>
				<?php echo $this->translate('Tags: ');?>
				<?php echo $this->answer->answer_tags ?>
			<?php endif; ?>
		</div>
		 <?php if (!$this->answer->anonymous): ?>
		  <div class="answers_browse_info_date">
          	  <?php echo $this->translate('Asked by %s', $this->htmlLink($this->answer->getOwner(), $this->answer->getOwner()->getTitle())) ?>
              <?php echo $this->timestamp($this->answer->creation_date) ?>
          </div>
          <?php else: ?>
          <div class="answers_browse_info_date">
          	  <?php echo $this->translate('Asked by <font color="#D60077">anonymous</font>', $this->htmlLink($this->answer->getOwner(), $this->answer->getOwner()->getTitle())) ?>
              <?php echo $this->timestamp($this->answer->creation_date) ?>
          </div>
         <?php endif; ?>
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
      <li id="answer-item-<?php echo $answer->post_id ?>" <?php if($answer->is_closed) echo "style=\"background-color:#F2F2F2;\"" ?> >
        <?php echo $this->htmlLink(
                      $answer->getHref(),
                      $this->itemPhoto($answer->getOwner(), 'thumb.icon', $answer->getOwner()->username),
                      array('class' => 'answers_browse_photo')
        ) ?>
        <div class="answers_browse_info">
        <div class="answers_browse_info_desc">
        	<?php  echo $this->translate('%s: %s', $this->htmlLink($answer->getOwner(), $answer->getOwner()->getTitle()), $answer->answer_description); ?>
        </div>
          <div class="recipes_browse_info_date">
            <?php echo $this->translate('Answered ') ?>
            <?php echo $this->timestamp($answer->creation_date) ?>
            <?php 
            if($this->viewer_id == $this->answer->user_id)
            {
            	$this->acceptform->getElement('post_id')->setValue($answer->post_id);
            	
            	if($answer->is_closed)
            	{
           ?>
           <div class="buttonlabel">
 			<span>Accpeted Answer</span>
 		</div>    
           <?php
           		}
            	else
            	   echo $this->acceptform->render($this);
            } 
            ?>
          </div>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; // $this->answers is NOT empty ?>
  <?php echo $this->paginationControl($this->paginator, null, null, null, array('answer_search'=>$this->search)); ?>
</div>
  <?php
  	if($this->viewer_id != $this->answer->user_id) 
  		echo $this->form->render($this);
  ?>
</div>
</div>
