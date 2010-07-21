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
</div>
<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Answer/externals/images/ans_ans48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('My Questions');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/answers'>Back to Questions</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Questions and Answers on everything relating to being a mom.');?></div>
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

 <div style='padding-top:20px;padding-right:10px;width:690px'>
  <?php if (0 == count($this->paginator) ): ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('There are no questions yet.') ?>
        <?php if (TRUE): // @todo check if user is allowed to create a recipe ?>
        <?php echo $this->translate('Why don\'t you %1$screate one%2$s', '<a href="'.$this->url(array(), 'recipe_create').'">', '</a>') ?>
        <?php endif; ?>
      </span>
    </div>
  <?php else: // $this->answers is NOT empty ?>
    <ul class="answers_browse">
      <?php foreach ($this->paginator as $answer): ?>
      <li id="recipe-item-<?php echo $answer->answer_id ?>">
        <?php echo $this->htmlLink($answer->getHref(), $this->itemPhoto($this->owner, 'thumb.icon'), array('class' => 'answers_browse_photo')) ?>
        <div class="recipes_browse_info">
          <?php echo $this->htmlLink($answer->getHref(), $answer->answer_title) ?>
          
          <div class="recipes_browse_info_date">
              <?php echo $this->timestamp($answer->creation_date) ?>
          </div>
         
      </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; // $this->answers is NOT empty ?>
  <?php echo $this->paginationControl($this->paginator); ?>
</div>