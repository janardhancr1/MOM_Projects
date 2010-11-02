<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: success.tpl 7374 2010-09-14 05:02:38Z john $
 * @author     Jung
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
	<img src='./application/modules/Classified/externals/images/classified_classified48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Listing Posted');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/classifieds/manage'>Back to My Classifieds</a></div>
	</div>
    <div class="smallheadline"></div>
</div>
<div style='padding-top:20px;padding-right:10px;width:690px'>
<div class='global_form'>
  <form method="post" class="global_form">
    <div>
      <div>
      
      <p>
        <?php echo $this->translate('Your listing was successfully published. Would you like to add some photos to it?');?>
      </p>
      <br />
      <p>
        <input type="hidden" name="confirm" value="true"/>
        <button type='submit'><?php echo $this->translate('Add Photos');?></button>
        <?php echo $this->translate('or');?>
        <a href='<?php echo $this->url(array('action' => 'manage'), 'classified_general', true) ?>'>
          <?php echo $this->translate('continue to my listing');?>
        </a>
      </p>
    </div>
    </div>
  </form>
</div>
</div>