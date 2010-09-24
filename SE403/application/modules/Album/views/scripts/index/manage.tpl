<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manage.tpl 7244 2010-09-01 01:49:53Z john $
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
<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>  

<div class="layout_middle">
<div class="headline_header">
	<img src='./application/modules/Album/externals/images/album_image48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('My Albums');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/albums'>Back to Photos</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Create a new album today and share it with friends.');?></div>
</div>
<div>
    <ul>
      <li>
        <?php echo $this->htmlLink(array('route' => 'album_general', 'action' => 'upload'), $this->translate('Add New Photos'), array(
          'class' => 'buttonlink icon_photos_new'
        )) ?>
      </li>
    </ul>
  </div>
 <div style='padding-top:20px;padding-right:10px;width:690px'>
  <?php if( $this->paginator->getTotalItemCount() > 0 ): ?>
    <ul class='albums_manage'>
      <?php foreach( $this->paginator as $album ): ?>
        <li>
          <div class="albums_manage_photo">
            <?php echo $this->htmlLink($album->getHref(), $this->itemPhoto($album, 'thumb.normal')) ?>
          </div>
          <div class="albums_manage_info">
            <h3><?php echo $this->htmlLink($album->getHref(), $album->getTitle()) ?></h3>
            <div class="albums_manage_info_photos">
              <?php echo $this->translate(array('%s photo', '%s photos', $album->count()),$this->locale()->toNumber($album->count())) ?>
            </div>
            <div class="albums_manage_info_desc">
              <?php echo $album->getDescription() ?>
            </div>
          </div>
          <div class="albums_manage_options">
            <?php echo $this->htmlLink(array('route' => 'album_specific', 'action' => 'editphotos', 'album_id' => $album->album_id), $this->translate('Manage Photos'), array(
              'class' => 'buttonlink icon_photos_manage'
            )) ?>
            <?php echo $this->htmlLink(array('route' => 'album_specific', 'action' => 'edit', 'album_id' => $album->album_id), $this->translate('Edit Settings'), array(
              'class' => 'buttonlink icon_photos_settings'
            )) ?>
            <?php echo $this->htmlLink(array('route' => 'album_specific', 'action' => 'delete', 'album_id' => $album->album_id, 'format' => 'smoothbox'), $this->translate('Delete Album'), array(
              'class' => 'buttonlink smoothbox icon_photos_delete'
            )) ?>
          </div>
        </li>
      <?php endforeach; ?>
      <?php if( $this->paginator->count() > 1 ): ?>
        <br />
        <?php echo $this->paginationControl($this->paginator, null, null); ?>
      <?php endif; ?>
    </ul>
  <?php else: ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('You do not have any albums yet.');?>
        <?php if( $this->canCreate ): ?>
          <?php echo $this->translate('Get started by %1$screating%2$s your first album!', '<a href="'.$this->url(array('action' => 'upload')).'">', '</a>'); ?>
        <?php endif; ?>
      </span>
    </div>
  <?php endif; ?>
</div>
</div>