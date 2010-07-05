<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manage.tpl 6159 2010-06-05 02:12:43Z alex $
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

<div class="headline">
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
</div>

<div class='layout_right'>
  <?php echo $this->form->render($this) ?>
  <?php if( $this->can_create): ?>
  <div class="quicklinks">
    <ul>
      <li>
        <a href='<?php echo $this->url(array(), 'classified_create', true) ?>' class='buttonlink icon_classified_new'><?php echo $this->translate('Post New Listing');?></a>
      </li>
    </ul>
  </div>
  <?php endif; ?>
</div>

<div class='layout_middle'>
  <?php if ($this->current_count >= $this->quota):?>
    <div class="tip">
      <span>
        <?php echo $this->translate('You have already created the maximum number of listings allowed. If you would like to create a new listing, please delete an old one first.');?>
      </span>
    </div>
    <br/>
  <?php endif; ?>
  <?php if( $this->paginator->getTotalItemCount() > 0 ): ?>
    <ul class="classifieds_browse">
      <?php foreach( $this->paginator as $item ): ?>
        <li>
          <div class='classifieds_browse_photo'>
            <?php echo $this->htmlLink($item->getHref(), $this->itemPhoto($item, 'thumb.normal')) ?>
          </div>
          <div class='classifieds_browse_options'>
            <a href='<?php echo $this->url(array('classified_id' => $item->classified_id), 'classified_edit', true) ?>' class='buttonlink icon_classified_edit'><?php echo $this->translate('Edit Listing');?></a>
            <?php if( $this->allowed_upload ): ?>
              <?php echo $this->htmlLink(array(
                  'route' => 'classified_extended',
                  'controller' => 'photo',
                  'action' => 'upload',
                  'subject' => $item->getGuid(),
                ), $this->translate('Add Photos'), array(
                  'class' => 'buttonlink icon_classified_photo_new'
              )) ?>
            <?php endif; ?>

            <?php if( !$item->closed ): ?>
              <a href='<?php echo $this->url(array('classified_id' => $item->classified_id, 'closed' => 1), 'classified_close', true) ?>' class='buttonlink icon_classified_close'><?php echo $this->translate('Close Listing');?></a>
            <?php else: ?>
              <a href='<?php echo $this->url(array('classified_id' => $item->classified_id, 'closed' => 0), 'classified_close', true) ?>' class='buttonlink icon_classified_open'><?php echo $this->translate('Open Listing');?></a>
            <?php endif; ?>

            <a href='<?php echo $this->url(array('classified_id' => $item->classified_id), 'classified_delete', true) ?>' class='buttonlink icon_classified_delete'><?php echo $this->translate('Delete Listing');?></a>
          </div>
          <div class='classifieds_browse_info'>
            <div class='classifieds_browse_info_title'>
              <h3>
                <?php echo $this->htmlLink($item->getHref(), $item->getTitle()) ?>
                <?php if( $item->closed ): ?>
                  <img alt="close" src='application/modules/Classified/externals/images/close.png'/>
                <?php endif;?>
              </h3>
            </div>
            <div class='classifieds_browse_info_date'>
              <?php echo $this->timestamp(strtotime($item->creation_date)) ?>
              -
              <?php echo $this->translate('posted by');?> <?php echo $this->htmlLink($item->getOwner()->getHref(), $item->getOwner()->getTitle()) ?>
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

  <?php elseif($this->search): ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('You do not have any classified listing that match your search criteria.');?>
      </span>
    </div>
  <?php else:?>
    <div class="tip">
      <span>
        <?php echo $this->translate('You do not have any classified listings.');?>
        <?php if ($this->can_create): ?>
          <?php echo $this->translate('Get started by <a href=\'%1$s\'>posting</a> a new listing.', $this->url(array(), 'classified_create'));?>
        <?php endif; ?>
      </span>
    </div>
  <?php endif; ?>
  <?php echo $this->paginationControl($this->paginator, null, array("pagination/pagination.tpl","classified")); ?>
</div>
