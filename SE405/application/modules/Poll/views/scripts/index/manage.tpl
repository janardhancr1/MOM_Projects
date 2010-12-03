<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manage.tpl 7443 2010-09-22 07:25:41Z john $
 * @author     Steve
 */
?>

<!--
<div class="headline">
  <h2>
    <?php echo $this->translate('Polls');?>
  </h2>
  <div class="tabs">
    <?php
      // Render the menu
      echo $this->navigation()
        ->menu()
        ->setContainer($this->navigation)
        ->render();
    ?>
  </div>
</div>
-->

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>

<script type="text/javascript">
  var searchPolls = function() {
    $('filter_form').submit();
  }
</script>

<!--
<div class='layout_right'>
  <?php echo $this->form->render($this) ?>

  <?php if( count($this->quickNavigation) > 0 ): ?>
    <div class="quicklinks">
      <?php
        // Render the menu
        echo $this->navigation()
          ->menu()
          ->setContainer($this->quickNavigation)
          ->render();
      ?>
    </div>
  <?php endif; ?>
</div>
-->

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Poll/externals/images/poll_poll48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <a href='/index.php/polls/manage'><?php echo $this->translate('My Polls');?></a>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/polls'>Back to Polls</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Create a Poll or Tell Others What you Think');?></div>
</div>
<div>
  <ul>
    <li>
      <a href='<?php echo $this->url(array(), 'poll_create') ?>' class='buttonlink icon_poll_new'>
        <?php echo $this->translate('Create New Poll') ?>
      </a>
    </li>
  </ul>
</div>
<div style='padding-top:20px;padding-right:10px;width:690px'>
  <?php if( 0 == count($this->paginator) ): ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('There are no polls yet.') ?>
        <?php if (TRUE): // @todo check if user is allowed to create a poll ?>
        <?php echo $this->translate('Why don\'t you %1$screate one%2$s', '<a href="'.$this->url(array('action' => 'create'), 'poll_general').'">', '</a>') ?>
        <?php endif; ?>
      </span>
    </div>

  <?php else: // $this->polls is NOT empty ?>
  
    <ul class="polls_browse">
      <?php foreach( $this->paginator as $poll ): ?>
      <li id="poll-item-<?php echo $poll->poll_id ?>">
        <?php echo $this->htmlLink($poll->getHref(), $this->itemPhoto($this->owner, 'thumb.icon'), array('class' => 'polls_browse_photo')) ?>
        <div class="polls_browse_info">
          <?php echo $this->htmlLink($poll->getHref(), $poll->getTitle()) ?>
          <div class="polls_browse_info_date">
              <?php echo $this->translate('Posted by %s', $this->htmlLink($this->owner, $this->owner->getTitle())) ?>
              <?php echo $this->timestamp($poll->creation_date) ?>
              -
              <?php echo $this->translate(array('%s vote', '%s votes', $poll->vote_count), $this->locale()->toNumber($poll->vote_count)) ?>
              -
              <?php echo $this->translate(array('%s view', '%s views', $poll->views), $this->locale()->toNumber($poll->views)) ?>
          </div>
          <?php if( '' != ($description = $poll->getDescription()) ): ?>
            <div class="polls_browse_info_desc">
              <?php echo $description ?>
            </div>
          <?php endif; ?>
        </div>
        <div class="polls_browse_options">
          <?php echo $this->htmlLink(array(
            'route' => 'poll_specific',
            'action' => 'delete',
            'poll_id' => $poll->poll_id,
            'reset' => true,
          ), $this->translate('Delete Poll'), array(
            'class' => 'buttonlink smoothbox icon_poll_delete'
          )) ?>
          <?php echo $this->htmlLink(array(
            'route' => 'poll_specific',
            'action' => 'edit',
            'poll_id' => $poll->poll_id,
            'reset' => true,
          ), $this->translate('Edit Privacy'), array(
            'class' => 'buttonlink icon_poll_edit'
          )) ?>
        </div>
        
      </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; // $this->polls is NOT empty ?>

  <?php echo $this->paginationControl($this->paginator, null, null, array(
    'pageAsQuery' => true,
    'query' => $this->formValues,
    //'params' => $this->formValues,
  )); ?>
</div>
</div>