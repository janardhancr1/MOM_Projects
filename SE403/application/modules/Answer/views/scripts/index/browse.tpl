<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: browse.tpl 6398 2010-06-16 23:33:03Z steve $
 * @author     Steve
 */
?>

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>  

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Answer/externals/images/ans_ans48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Momburbia Answers');?></div>
    <div class="smallheadline"><?php echo $this->translate('Questions and Answers on everything relating to being a mom.');?></div>
</div>
<div>
<?php echo $this->search_form->render($this) ?>
</div>
 <div style='padding-top:20px;padding-right:10px;width:690px'>
  <?php if (0 == count($this->paginator) ): ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('There are no questions yet.') ?>
        <?php if ($this->can_create): ?>
        <?php echo $this->translate('Why don\'t you %1$screate one%2$s', '<a href="'.$this->url(array(), 'answer_create').'">', '</a>') ?>
        <?php endif; ?>
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
          <h3>
            <?php echo $this->htmlLink($answer->getHref(), $answer->title) ?>
          </h3>
          <div class="answers_browse_info_date">
            <?php echo $this->translate('Asked by %s', $this->htmlLink($answer->getOwner(), $answer->getOwner()->getTitle())) ?>
            <?php echo $this->timestamp($answer->creation_date) ?>
          </div>
          <?php if (!empty($answer->description)): ?>
            <div class="answers_browse_info_desc">
              <?php  echo $answer->description ?>
            </div>
          <?php endif; ?>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; // $this->answers is NOT empty ?>
  <?php echo $this->paginationControl($this->paginator, null, null, null, array('answer_search'=>$this->search)); ?>
</div>
</div>
