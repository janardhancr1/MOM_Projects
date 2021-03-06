<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: editphotos.tpl 7249 2010-09-01 04:15:19Z john $
 * @author     Sami
 */
?>
<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?> 
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

<div class="layout_middle">
<div class="headline_header">
	<img src='./application/modules/Album/externals/images/album_image48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->htmlLink($this->album->getHref(), $this->album->getTitle()) ?> (<?php echo $this->translate(array('%s photo', '%s photos', $this->album->count()),$this->locale()->toNumber($this->album->count())) ?>)
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/albums/manage'>Back to My Albums</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Choose title and description for this album');?></div>
</div>
<div>
<!--
<h3>
  <?php echo $this->htmlLink($this->album->getHref(), $this->album->getTitle()) ?>
  (<?php echo $this->translate(array('%s photo', '%s photos', $this->album->count()),$this->locale()->toNumber($this->album->count())) ?>)
</h3>
-->

<?php if( $this->paginator->count() > 0 ): ?>
  <br />
  <?php echo $this->paginationControl($this->paginator); ?>
<?php endif; ?>


<form action="<?php echo $this->escape($this->form->getAction()) ?>" method="<?php echo $this->escape($this->form->getMethod()) ?>">
  <?php echo $this->form->album_id; ?>
  <ul class='albums_editphotos'>
    <?php foreach( $this->paginator as $photo ): ?>
      <li>
        <div class="albums_editphotos_photo">
          <?php echo $this->htmlLink($photo->getHref(), $this->itemPhoto($photo, 'thumb.normal'))  ?>
        </div>
        <div class="albums_editphotos_info">
          <?php
            $key = $photo->getGuid();
            echo $this->form->getSubForm($key)->render($this);
          ?>
    <div class="albums_editphotos_cover">
            <input type="radio" name="cover" value="<?php echo $photo->getIdentity() ?>" <?php if( $this->album->photo_id == $photo->getIdentity() ): ?> checked="checked"<?php endif; ?> />
    </div>
    <div class="albums_editphotos_label">
            <label><?php echo $this->translate('Album Cover');?></label>
    </div>
        </div>
      </li>
    <?php endforeach; ?>

    <?php echo $this->form->submit->render(); ?>
</form>


<?php if( $this->paginator->count() > 0 ): ?>
  <br />
  <?php echo $this->paginationControl($this->paginator); ?>
<?php endif; ?>
</div>