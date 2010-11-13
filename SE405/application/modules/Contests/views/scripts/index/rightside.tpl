<div class='layout_right'>

<script type="text/javascript">

 function processClick(adcampaign_id, ad_id) {
    (new Request.JSON({
      'format': 'json',
      'url' : '<?php echo $this->url(array('module' => 'core', 'controller' => 'utility', 'action' => 'advertisement'), 'default', true) ?>',
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
<?php if(!$this->_noRender1) { ?>
<div class="generic_layout_container layout_core_ad_campaign">
<div style="float:right;color:#B2BCC0;font-family:Georgia;font-size:10px;">Advertisement&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="clear:both;"></div>
<div style="vertical-align: middle;" onclick="javascript:processClick(<?php echo $this->campaign1->adcampaign_id.", ".$this->ad1->ad_id?>)">
  <?php echo $this->ad1->html_code; ?>
</div>
</div>
<?php }?>
<?php if(!$this->_noRender1) { ?>
<div class="generic_layout_container layout_core_ad_campaign">
<div style="float:right;color:#B2BCC0;font-family:Georgia;font-size:10px;">Advertisement&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="clear:both;"></div>
<div style="vertical-align: middle;" onclick="javascript:processClick(<?php echo $this->campaign2->adcampaign_id.", ".$this->ad2->ad_id?>)">
  <?php echo $this->ad2->html_code; ?>
</div>
</div>
<?php }?>
<div class="generic_layout_container layout_user_list_signups">
<h3>Newest Members</h3>
 <ul>
  <?php foreach( $this->users as $user ): ?>
    <li>
      <?php echo $this->htmlLink($user->getHref(), $this->itemPhoto($user, 'thumb.icon'), array('class' => 'newestmembers_thumb')) ?>
      <div class='newestmembers_info'>
        <div class='newestmembers_name'>
          <?php echo $this->htmlLink($user->getHref(), $user->getTitle()) ?>
        </div>
        <div class='newestmembers_date'>
          <?php echo $this->timestamp($user->creation_date) ?>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
</div>
<div class="generic_layout_container layout_user_list_popular">
<h3>Popular Members</h3>
 <ul>
  <?php foreach( $this->popularusers as $user ): ?>
    <li>
      <?php echo $this->htmlLink($user->getHref(), $this->itemPhoto($user, 'thumb.icon'), array('class' => 'popularmembers_thumb')) ?>
      <div class='popularmembers_info'>
        <div class='popularmembers_name'>
          <?php echo $this->htmlLink($user->getHref(), $user->getTitle()) ?>
        </div>
        <div class='popularmembers_friends'>
          <?php echo $this->translate(array('%s friend', '%s friends', $user->member_count),$this->locale()->toNumber($user->member_count)) ?>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
 
</div>
</div>