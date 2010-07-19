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

<?php if (empty($this->answer)): ?>
  <?php echo $this->translate('The answer you are looking for does not exist or has been deleted.') ?>
<?php return; endif; ?>
<h2>
  <?php echo $this->translate('%s\'s Question', $this->htmlLink($this->owner, $this->owner->getTitle())) ?>
</h2>

<div class="layout_middle">
<div class='answers_view'>
	<div>
  	<?php echo $this->htmlLink(
                      $this->answer->getHref(),
                      $this->itemPhoto($this->answer->getOwner(), 'thumb.icon', $this->answer->getOwner()->username),
                      array('class' => 'answer_browse_photo')
        ) ?>
  </div>
	<div>
	    <h3>
	      <?php echo $this->answer->answer_title ?>
	    </h3>
	</div>
	          <div class="answers_browse_info_date">
              <?php echo $this->translate('Posted by %s', $this->htmlLink($this->owner, $this->owner->getTitle())) ?>
              <?php echo $this->timestamp($this->answer->creation_date) ?>
              
          </div>
</div>
</div>

