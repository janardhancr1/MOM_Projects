<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: view.tpl 6541 2010-06-23 23:03:28Z shaun $
 * @author     Sami
 */
?>
<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>  

<div class="layout_middle">
<h2>
  <?php echo $this->translate('%1$s\'s Album: %2$s', $this->album->getOwner()->__toString(), $this->album->getTitle()); ?>
</h2>

<div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/albums'>Back to Photos</a></div>

<?php if (""!=$this->album->getDescription()): ?>
  <p>
    <?php echo $this->album->getDescription() ?>
  </p>
  <br />
<?php endif ?>

<?php if ($this->mine || $this->can_edit):?>
  <div class="album_options">
    <?php echo $this->htmlLink(array('route' => 'album_general', 'action' => 'upload', 'album_id' => $this->album->album_id), $this->translate('Add More Photos'), array(
      'class' => 'buttonlink icon_photos_new'
    )) ?>
    <?php echo $this->htmlLink(array('route' => 'album_specific', 'action' => 'editphotos', 'album_id' => $this->album->album_id), $this->translate('Manage Photos'), array(
      'class' => 'buttonlink icon_photos_manage'
    )) ?>
    <?php echo $this->htmlLink(array('route' => 'album_specific', 'action' => 'edit', 'album_id' => $this->album->album_id), $this->translate('Edit Settings'), array(
      'class' => 'buttonlink icon_photos_settings'
    )) ?>
    <?php echo $this->htmlLink(array('route' => 'album_specific', 'action' => 'delete', 'album_id' => $this->album->album_id, 'format' => 'smoothbox'), $this->translate('Delete Album'), array(
      'class' => 'buttonlink smoothbox icon_photos_delete'
    )) ?>
  </div>
<?php endif;?>


  <ul class="thumbs thumbs_nocaptions">
    <?php foreach( $this->paginator as $photo ): ?>
      <li>
        <a class="thumbs_photo" href="<?php echo $photo->getHref(); ?>">
          <span style="background-image: url(<?php echo $photo->getPhotoUrl('thumb.normal'); ?>);"></span>
        </a>
      </li>
    <?php endforeach;?>
  </ul>
  <?php if( $this->paginator->count() > 0 ): ?>
    <br />
    <?php echo $this->paginationControl($this->paginator); ?>
  <?php endif; ?>

  <?php echo $this->action("list", "comment", "core", array("type"=>"album", "id"=>$this->album->getIdentity())); ?>

</div>