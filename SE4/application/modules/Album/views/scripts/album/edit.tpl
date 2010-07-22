<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: edit.tpl 6541 2010-06-23 23:03:28Z shaun $
 * @author     Sami
 */
?>


<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>  

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Album/externals/images/album_image48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Add New Photos');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/albums/manage'>Back to My Albums</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Choose photos on your computer to add to this album.');?></div>
</div>
<div>

<?php
  echo $this->form->render();
?>
</div>
