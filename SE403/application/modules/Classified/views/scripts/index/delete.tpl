<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: delete.tpl 6537 2010-06-23 22:51:46Z shaun $
 * @author     Jung
 */
?>
<!--
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
</div>-->

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Classified/externals/images/classified_classified48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Delete Classified Listing?');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/classifieds/manage'>Back to My Classifieds</a></div>
	</div>
    <div class="smallheadline"></div>
</div>
<div style='padding-top:20px;padding-right:10px;width:690px'>
<div class='global_form'>
  <form method="post" class="global_form">
    <div>
      <div>
      <p>
        <?php echo $this->translate('Are you sure that you want to delete the classified listing with the title "%1$s" last modified %2$s? It will not be recoverable after being deleted.', $this->classified->title,$this->timestamp($this->classified->modified_date)); ?>
      </p>
      <br />
      <p>
        <input type="hidden" name="confirm" value="true"/>
        <button type='submit'><?php echo $this->translate('Delete');?></button>
        <?php echo $this->translate('or');?> <a href='<?php echo $this->url(array(), 'classified_manage', true) ?>'><?php echo $this->translate('cancel');?></a>
      </p>
    </div>
    </div>
  </form>
</div>
</div>