<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: create.tpl 6516 2010-06-23 01:15:53Z shaun $
 * @author	   John
 */
?>

<div class="headline">
  <h2>
    <?php echo $this->translate('Groups');?>
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
