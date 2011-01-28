<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manage.tpl 6160 2010-06-05 02:20:37Z alex $
 * @author     Steve
 */
?>
<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>  

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Answer/externals/images/ans_ans48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <a href='/index.php/answers/manage'><?php echo $this->translate('My Questions');?></a>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/answers'>Back to Questions</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Ask the community a question and check back for answers.');?></div>
</div>
<?php if($this->can_create):?>
    <div>
      <ul>
        <li>
          <a href='<?php echo $this->url(array(), 'answer_create') ?>' class='buttonlink icon_answer_new'>
            <?php echo $this->translate('Ask New Question') ?>
          </a>
        </li>
      </ul>
    </div>
  <?php endif;?>

 <div style='padding-top:20px;padding-right:10px;width:680px'>
  <?php if (0 == count($this->paginator) ): ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('You have no questions.') ?>
        <?php if (TRUE): // @todo check if user is allowed to create a recipe ?>
        <?php echo $this->translate('Why don\'t you create one') ?>
        <?php endif; ?>
      </span>
    </div>
  <?php else: // $this->answers is NOT empty ?>
    <ul class="answers_browse">
      <?php foreach ($this->paginator as $answer): ?>
      <li id="recipe-item-<?php echo $answer->answer_id ?>">
        <?php echo $this->htmlLink($answer->getHref(), $this->itemPhoto($this->owner, 'thumb.icon'), array('class' => 'answers_browse_photo')) ?>
        <div class="recipes_browse_info">
          <?php echo $this->htmlLink($answer->getHref(), $answer->title) ?>
          
          <div class="recipes_browse_info_date">
              <?php echo $this->timestamp($answer->creation_date) ?>
          </div>
      <div class="answers_browse_options">
      <a href='<?php echo $this->url(array('answer_id' => $answer->answer_id), 'answer_edit', true) ?>' class='buttonlink icon_answer_edit'><?php echo $this->translate('Edit Question');?></a>
         <a href='<?php echo $this->url(array('answer_id' => $answer->answer_id), 'answer_delete', true) ?>' class='buttonlink icon_answer_new'><?php echo $this->translate('Delete Question');?></a>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; // $this->answers is NOT empty ?>
  <?php echo $this->paginationControl($this->paginator); ?>
</div>