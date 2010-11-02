<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: upload.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     Sami
 */
?>

<script type="text/javascript">
  var updateTextFields = function()
  {
    var album = document.getElementById("album");
    var name = document.getElementById("title-wrapper");
    var description = document.getElementById("description-wrapper");
    var search = document.getElementById("search-wrapper");
    if (album.value == 0)
    {
      name.style.display = "block";
      description.style.display = "block";
      search.style.display = "block";
    }
    else
    {
      name.style.display = "none";
      description.style.display = "none";
      search.style.display = "none";
    }
  }
  en4.core.runonce.add(updateTextFields);
</script>
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

<?php echo $this->form->render($this) ?>