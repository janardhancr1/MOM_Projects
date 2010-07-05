<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: upload.tpl 6541 2010-06-23 23:03:28Z shaun $
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

<?php echo $this->form->render($this) ?>