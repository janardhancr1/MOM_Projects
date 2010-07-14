<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: browse.tpl 6541 2010-06-23 23:03:28Z shaun $
 * @author     Sami
 */
?>

<!--
<div class="headline">
  <h2>
    <?php echo $this->translate('Photo Albums');?>
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

  <!--<div class="quicklinks">
    <ul>
      <li>
        <?php echo $this->htmlLink(array('route' => 'album_general', 'action' => 'upload'), $this->translate('Add New Photos'), array(
          'class' => 'buttonlink icon_photos_new'
        )) ?>
      </li>
    </ul>
  </div>-->
 
</div>

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Album/externals/images/album_image48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Photo Albums');?></div>
    <div class="smallheadline"><?php echo $this->translate('Create, share and view picture albums from moms everywhere!');?></div>
  </h2>
  
</div>
<div>
<?php echo $this->search_form->render($this) ?>
 <script type="text/javascript">
  //<![CDATA[
    $('sort').addEvent('change', function(){
      $(this).getParent('form').submit();
    });
    $('category_id').addEvent('change', function(){
      $(this).getParent('form').submit();
    });
  //]]>
  </script>
 </div>
 <div style='padding-top:5px;width:690px'>
  <?php if( $this->paginator->getTotalItemCount() > 0 ): ?>

    <ul class="thumbs">
      <?php foreach( $this->paginator as $album ): ?>
        <li>
          <a class="thumbs_photo" href="<?php echo $album->getHref(); ?>">
            <span style="background-image: url(<?php echo $album->getPhotoUrl('thumb.normal'); ?>);"></span>
          </a>
          <p class="thumbs_info">
            <span class="thumbs_title">
              <?php echo $this->htmlLink($album, $this->string()->chunk(substr($album->getTitle(), 0, 45), 10)) ?>
            </span>
            <?php echo $this->translate('By');?>
            <?php echo $this->htmlLink($album->getOwner()->getHref(), $album->getOwner()->getTitle(), array('class' => 'thumbs_author')) ?>
            <br />
            <?php echo $this->translate(array('%s photo', '%s photos', $album->count()),$this->locale()->toNumber($album->count())) ?>
          </p>
        </li>
      <?php endforeach;?>
    </ul>



    <!--
    <ul class='thumbs'>
      <?php foreach( $this->paginator as $album ): ?>
        <li>
          <div class='album_thumb_wrapper'>
            <?php echo $this->htmlLink($album->getHref(), $this->itemPhoto($album, 'thumb.normal')) ?>
          </div>
          <p>
            
            <span>
              <?php echo $this->translate('By');?> <?php echo $this->htmlLink($album->getOwner()->getHref(), $album->getOwner()->getTitle()) ?>
            </span>
            <span>
              <?php echo $this->translate(array('%s photo', '%s photos', $album->count()),$this->locale()->toNumber($album->count())) ?>
            </span>
          </p>
        </li>
      <?php endforeach;?>
    </ul>
    -->


    <?php if( $this->paginator->count() > 1 ): ?>
      <br />
      <?php echo $this->paginationControl($this->paginator, null, null); ?>
    <?php endif; ?>
  <?php else: ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('Nobody has created an album yet.');?>
        <?php if (TRUE): // @todo check if user is allowed to create an album ?>
          <?php echo $this->translate('Be the first to %1$screate%2$s one!', '<a href="'.$this->url(array('action' => 'upload')).'">', '</a>'); ?>
        <?php endif; ?>
      </span>
    </div>
  <?php endif; ?>
 </div>
</div>