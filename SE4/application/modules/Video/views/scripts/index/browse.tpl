<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: browse.tpl 6159 2010-06-05 02:12:43Z alex $
 * @author     Jung
 */
?>
<!--
<div class="headline">
  <h2>
    <?php echo $this->translate('Videos');?>
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

  <!--<?php if($this->can_create):?>
  <div class="quicklinks">
    <ul>
      <li>
      <?php echo $this->htmlLink(array('route' => 'video_general', 'action' => 'create'), $this->translate('Post New Video'), array(
        'class' => 'buttonlink icon_video_new'
      )) ?>
     </ul>
  </div>
  <?php endif; ?>-->
</div>

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Video/externals/images/video_video48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Videos ');?></div>
    <div class="smallheadline"><?php echo $this->translate('Create, share and view videos from moms everywhere!');?></div>
</div>
<div>
<?php echo $this->form->render($this) ?>
 <div style='padding-top:10px;padding-right:10px;width:690px'>
  <?php if( $this->tag ): ?>
    <h3>
      <?php echo $this->translate('Videos using the tag');?> #<?php echo $this->tag;?> <a href="<?php echo $this->url(array('module' => 'video', 'controller' => 'index', 'action' => 'browse'), 'default', true) ?>">(x)</a>
    </h3>
  <?php endif; ?>

  <?php if( $this->paginator->getTotalItemCount() > 0 ): ?>

  <ul class="videos_browse">
    <?php foreach( $this->paginator as $item ): ?>
      <li>
        
        <div class="video_thumb_wrapper">
          <?php if ($item->duration):?>
          <span class="video_length">
            <?php
              if( $item->duration>360 ) $duration = gmdate("H:i:s", $item->duration); else $duration = gmdate("i:s", $item->duration);
              if ($duration[0] =='0') $duration = substr($duration,1); echo $duration;
            ?>
          </span>
          <?php endif;?>
          <?php
            if ($item->photo_id) echo $this->htmlLink($item->getHref(), $this->itemPhoto($item, 'thumb.normal'));
            else echo '<img alt="" src="application/modules/Video/externals/images/video.png">';
          ?>
        </div>
        <a class="video_title" href='<?php echo $item->getHref();?>'><?php echo $item->getTitle();?></a>
        <div class="video_author"><?php echo $this->translate('By');?> <?php echo $this->htmlLink($item->getOwner()->getHref(), $item->getOwner()->getTitle()) ?></div>
        <div class="video_stats">
          <span class="video_views"><?php echo $item->view_count;?> <?php echo $this->translate('views');?></span>
          <?php if($item->rating>0):?>
            <?php for($x=1; $x<=$item->rating; $x++): ?><span class="rating_star"></span><?php endfor; ?><?php if((round($item->rating)-$item->rating)>0):?><span class="rating_star_half"></span><?php endif; ?>
          <?php endif; ?>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
  <?php elseif( $this->category ):?>
    <div class="tip">
      <span>
        <?php echo $this->translate('Nobody has posted a video with that criteria.');?>
      </span>
    </div>
  <?php else:?>
    <div class="tip">
      <span>
        <?php echo $this->translate('Nobody has created a video yet.');?>
        <?php if ($this->can_create):?>
          <?php echo $this->translate('Be the first to %1$spost%2$s one!', '<a href="'.$this->url(array('action' => 'create'), "video_general").'">', '</a>'); ?>
        <?php endif; ?>
      </span>
    </div>
  <?php endif; ?>
  <?php echo $this->paginationControl($this->paginator); ?>
</div>
</div>
