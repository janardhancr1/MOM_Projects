<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: edit.tpl 7244 2010-09-01 01:49:53Z john $
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

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Video/externals/images/video_video48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Edit Video');?><div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/videos/manage'>Back to My Videos</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Edit video today and share it with friends.');?></div>
</div>
<div style='padding-top:20px;width:690px'>
<?php
  echo $this->form->render();
?>
</div>