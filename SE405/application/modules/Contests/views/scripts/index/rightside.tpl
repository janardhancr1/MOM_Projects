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
<table width="100%">
<tr>
<?php $i=0; ?>
  <?php foreach( $this->users as $user ): ?>
   <td width="33%">
      <div class='newestmembers_info'>
        <div class='newestmembers_name'>
          <?php echo $this->htmlLink($user->getHref(), $user->getTitle()) ?>
        </div>
        <div class='newestmembers_date'>
          <?php echo $this->htmlLink($user->getHref(), $this->itemPhoto($user, 'thumb.icon'), array('class' => 'newestmembers_thumb')) ?>
        </div>
      </div>
    </td>
     <?php
     $i++;
     if ($i%3 == 0)
     echo "</tr><tr><td colspan='3'>&nbsp;</tr><tr>";
     ?>
  <?php endforeach; ?>
</tr>
 </table>
</div>
<div class="generic_layout_container layout_user_list_signups">
<h3>Popular Members</h3>
<table width="100%">
<tr>
<?php $i=0; ?>
  <?php foreach( $this->popularusers as $user ): ?>
   <td width="33%">
      <div class='newestmembers_info'>
        <div class='newestmembers_name'>
          <?php echo $this->htmlLink($user->getHref(), $user->getTitle()) ?>
        </div>
        <div class='newestmembers_date'>
          <?php echo $this->htmlLink($user->getHref(), $this->itemPhoto($user, 'thumb.icon'), array('class' => 'newestmembers_thumb')) ?>
        </div>
      </div>
    </td>
     <?php
     $i++;
     if ($i%3 == 0)
     echo "</tr><tr><td colspan='3'>&nbsp;</tr><tr>";
     ?>
  <?php endforeach; ?>
</tr>
 </table>
</div>
</div>