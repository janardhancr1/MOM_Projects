<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6159 2010-06-05 02:12:43Z alex $
 * @author     Jung
 */
?>

<script type="text/javascript">
  var pageAction =function(page){
    $('page').value = page;
    $('filter_form').submit();
  }

  en4.core.runonce.add(function(){
    $$('#filter_form input[type=text]').each(function(f) {
        if (f.value == '' && f.id.match(/\min$/)) {
            new OverText(f, {'textOverride':'min','element':'span'});
            //f.set('class', 'integer_field_unselected');
        }
        if (f.value == '' && f.id.match(/\max$/)) {
            new OverText(f, {'textOverride':'max','element':'span'});
            //f.set('class', 'integer_field_unselected');
        }
    });
  });
</script>

<!--<div class="headline">
  <h2>
    <?php echo $this->translate('Classified Listings');?>
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
  <?php if( $this->can_create): ?>
    <div class="quicklinks">
      <ul>
        <li>
          <a href='<?php echo $this->url(array(), 'classified_create', true) ?>' class='buttonlink icon_classified_new'><?php echo $this->translate('Post New Listing');?></a>
        </li>
      </ul>
    </div>
  <?php endif; ?>-->
</div>

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Classified/externals/images/classified_classified48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Classifieds');?>
	</div>
    <div class="smallheadline"><?php echo $this->translate('Classified listings are a great way to list something for sale or find items.');?></div>
</div>
<div>
<?php echo $this->form->render($this) ?>
</div>
 <div style='padding-top:20px;padding-right:10px;width:690px'>
  <?php if( $this->tag ): ?>
    <h3>
      <?php echo $this->translate('Showing classified listings using the tag');?> #<?php echo $this->tag_text;?> <a href="<?php echo $this->url(array('module' => 'classified', 'controller' => 'index', 'action' => 'index'), 'default', true) ?>">(x)</a>
    </h3>
  <?php endif; ?>
  
  <?php if( $this->start_date ): ?>
    <?php foreach ($this->archive_list as $archive): ?>
      <h3>
        <?php echo $this->translate('Showing classified listings created on');?> <?php if ($this->start_date==$archive['date_start']) echo $archive['label']?> <a href="<?php echo $this->url(array('module' => 'classified', 'controller' => 'index', 'action' => 'index'), 'default', true) ?>">(x)</a>
      </h3>
    <?php endforeach; ?>
  <?php endif; ?>

  <?php if( $this->paginator->getTotalItemCount() > 0 ): ?>
    <ul class="classifieds_browse">
      <?php foreach( $this->paginator as $item ): ?>
        <li>
          <div class='classifieds_browse_photo'>
            <?php echo $this->htmlLink($item->getHref(), $this->itemPhoto($item, 'thumb.normal')) ?>
          </div>
          <div class='classifieds_browse_info'>
            <div class='classifieds_browse_info_title'>
              <h3>
              <?php echo $this->htmlLink($item->getHref(), $item->getTitle()) ?>
              <?php if( $item->closed ): ?>
                <img src='application/modules/Classified/externals/images/close.png'/>
              <?php endif;?>
              </h3>
            </div>
            <div class='classifieds_browse_info_date'>
              <?php echo $this->timestamp(strtotime($item->creation_date)) ?>
              - <?php echo $this->translate('posted by');?> <?php echo $this->htmlLink($item->getOwner()->getHref(), $item->getOwner()->getTitle()) ?>
            </div>
            <div class='classifieds_browse_info_blurb'>
              <?php $fieldStructure = Engine_Api::_()->fields()->getFieldsStructurePartial($item)?>
              <?php echo $this->fieldValueLoop($item, $fieldStructure) ?>
              <?php
                // Not mbstring compat
                echo substr(strip_tags($item->body), 0, 350); if (strlen($item->body)>349) echo "...";
              ?>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>

  <?php elseif( $this->category || $this->show == 2 || $this->search ):?>
    <div class="tip">
      <span>
        <?php echo $this->translate('Nobody has posted a classified listing with that criteria.');?>
        <?php if ($this->can_create): ?>
          <?php echo $this->translate('Be the first to %post%2$s one!', '<a href="'.$this->url(array(), 'classified_create').'">', '</a>'); ?>
        <?php endif; ?>
      </span>
    </div>
  <?php else:?>
    <div class="tip">
      <span>
        <?php echo $this->translate('Nobody has posted a classified listing yet.');?>
        <?php if ($this->can_create): ?>
          <?php echo $this->translate('Be the first to %1$spost%2$s one!', '<a href="'.$this->url(array(), 'classified_create').'">', '</a>'); ?>
        <?php endif; ?>
      </span>
    </div>
  <?php endif; ?>
  <?php echo $this->paginationControl($this->paginator, null, array("pagination/pagination.tpl","classified")); ?>
</div>