<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: browse.tpl 6398 2010-06-16 23:33:03Z steve $
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
</div>-->

<div class='layout_right'>
<div class="generic_layout_container layout_core_ad_campaign">
<script type="text/javascript">

 function processClick(adcampaign_id, ad_id) {
    (new Request.JSON({
      'format': 'json',
      'url' : '/utility/advertisement',
      'data' : {
        'format' : 'json',
        'adcampaign_id' : adcampaign_id,
        'ad_id' : ad_id
      },
      'onRequest' : function(){
      },
      'onSuccess' : function(responseJSON, responseText)
      {
      }
    })).send();

  }
</script>
<div style="float:right;color:#B2BCC0;font-family:Georgia;font-size:10px;">Advertisement&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="clear:both;"></div>
<div style="vertical-align: middle;" onclick="javascript:processClick(2, 2)">
  <a href='' target='_blank'><img src='/public/user/1000000/1000/1/3.gif'/></a></div></div>

<div class="generic_layout_container layout_core_ad_campaign">
<script type="text/javascript">

 function processClick(adcampaign_id, ad_id) {
    (new Request.JSON({
      'format': 'json',
      'url' : '/utility/advertisement',
      'data' : {
        'format' : 'json',
        'adcampaign_id' : adcampaign_id,
        'ad_id' : ad_id
      },
      'onRequest' : function(){
      },
      'onSuccess' : function(responseJSON, responseText)
      {
      }
    })).send();

  }

</script>
<div style="float:right;color:#B2BCC0;font-family:Georgia;font-size:10px;">Advertisement&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="clear:both;"></div>
<div style="vertical-align: middle;" onclick="javascript:processClick(3, 3)">
  <a href='' target='_blank' style='border-bottom: 1px solid #DDDDDD'><img src='/public/user/1000000/1000/1/5.gif'/></a></div></div>  
<!--
  <?php if($this->can_create):?>
    <div class="quicklinks">
      <ul>
        <li>
          <a href='<?php echo $this->url(array(), 'poll_create') ?>' class='buttonlink icon_poll_new'>
            <?php echo $this->translate('Create New Poll') ?>
          </a>
        </li>
      </ul>
    </div>
  <?php endif;?>-->
 
</div>
<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Poll/externals/images/poll_poll48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Polls');?></div>
    <div class="smallheadline"><?php echo $this->translate('Create a Poll or Tell Others What you Think');?></div>
</div>
<div>
<?php echo $this->search_form->render($this) ?>
<script type="text/javascript">
  //<![CDATA[
    $('browse_polls_by').addEvent('change', function(){
      $(this).getParent('form').submit();
    });
  //]]>
  </script>
</div>
 <div style='padding-top:20px;padding-right:10px;width:690px'>
  <?php if (0 == count($this->paginator) ): ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('There are no polls yet.') ?>
        <?php if ($this->can_create): ?>
        <?php echo $this->translate('Why don\'t you %1$screate one%2$s', '<a href="'.$this->url(array(), 'poll_create').'">', '</a>') ?>
        <?php endif; ?>
      </span>
    </div>
  <?php else: // $this->polls is NOT empty ?>
    <ul class="polls_browse">
      <?php foreach ($this->paginator as $poll): ?>
      <li id="poll-item-<?php echo $poll->poll_id ?>">
        <?php echo $this->htmlLink(
                      $poll->getHref(),
                      $this->itemPhoto($poll->getOwner(), 'thumb.icon', $poll->getOwner()->username),
                      array('class' => 'polls_browse_photo')
        ) ?>
        <div class="polls_browse_info">
          <h3>
            <?php echo $this->htmlLink($poll->getHref(), $poll->getTitle()) ?>
          </h3>
          <div class="polls_browse_info_date">
            <?php echo $this->translate('Posted by %s', $this->htmlLink($poll->getOwner(), $poll->getOwner()->getTitle())) ?>
            <?php echo $this->timestamp($poll->creation_date) ?>
            -
            <?php echo $this->translate(array('%s vote', '%s votes', $poll->voteCount()), $this->locale()->toNumber($poll->voteCount())) ?>
            -
            <?php echo $this->translate(array('%s view', '%s views', $poll->views), $this->locale()->toNumber($poll->views)) ?>
          </div>
          <?php if (!empty($poll->description)): ?>
            <div class="polls_browse_info_desc">
              <?php  echo $poll->description ?>
            </div>
          <?php endif; ?>
        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; // $this->polls is NOT empty ?>
  <?php echo $this->paginationControl($this->paginator, null, null, null, array('poll_search'=>$this->search)); ?>
</div>
