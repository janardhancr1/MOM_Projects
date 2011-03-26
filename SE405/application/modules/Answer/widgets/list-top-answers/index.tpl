<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 7319 2010-09-08 21:08:45Z jung $
 * @author     John
 */
?>

<ul class="answers_browse">
 <?php foreach ($this->paginator as $answer): ?>
      <li id="answer-item-<?php echo $answer->answer_id ?>">
        <?php echo $this->htmlLink(
                      $answer->getHref(),
                      $this->itemPhoto($answer->getOwner(), 'thumb.icon'),
                      array('class' => 'answers_browse_photo')
        ) ?>
        <div class="answers_browse_info">
          <h3>
            <?php echo $this->htmlLink($answer->getHref(), $answer->title) ?>
          </h3>
          <?php if (!$answer->anonymous): ?>
          <div class="answers_browse_info_date">
            <?php echo $this->translate('Asked by %s', $this->htmlLink($answer->getOwner(), $answer->getOwner()->getTitle())) ?>
            <?php echo $this->timestamp($answer->creation_date) ?>
          </div>
          <?php else: ?>
          <div class="answers_browse_info_date">
            <?php echo $this->translate('Asked by <font color="#D60077">anonymous</font>', $this->htmlLink($answer->getOwner(), $answer->getOwner()->getTitle())) ?>
            <?php echo $this->timestamp($answer->creation_date) ?>
          </div>
          <?php endif; ?>
          <?php if (!empty($answer->description)): ?>
            <div class="answers_browse_info_desc">
              <?php  echo $answer->description ?>
            </div>
          <?php endif; ?>
        </div>
      </li>
      <?php endforeach; ?>
</ul>