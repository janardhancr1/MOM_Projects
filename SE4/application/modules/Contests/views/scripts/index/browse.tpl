<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Contests
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: browse.tpl 6398 2010-06-16 23:33:03Z steve $
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
	<img src='./application/modules/Contests/externals/images/contest_contest48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Momburbia has Moms in Mind... ');?>
    <div class="smallheadline"><?php echo $this->translate('Check the contest page daily and tell other moms about the great giveaways.');?></div>
</div>
<br />

<br />
<br />
<center>
	<img src='./application/modules/Contests/externals/images/contestimage.jpg' border='0' alt='' />

<br />
<br />
<div style='text-align:center'><a href="#">Click here</a> to visit the Momburbia Contest Group and enter to win...</div>
</center>
</div>

</div>
