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
<!--
<div class="headline">
  <h2>
    <?php echo $this->translate('Recipes');?>
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
<div class='layout_right'>
<div class="generic_layout_container layout_core_ad_campaign">

<div style="float:right;color:#B2BCC0;font-family:Georgia;font-size:10px;">Advertisement&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="clear:both;"></div>
<div style="vertical-align: middle;" onclick="javascript:processClick(2, 2)">
  <a href='' target='_blank'><img src='/public/user/1000000/1000/1/3.gif'/></a></div></div>

<div class="generic_layout_container layout_core_ad_campaign">


<!--
  

  <script type="text/javascript">
  //<![CDATA[
    $('browse_recipes_by').addEvent('change', function(){
      $(this).getParent('form').submit();
    });
  //]]>
  </script>
-->
 
</div>


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
    <ul class="recipes_browse">
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