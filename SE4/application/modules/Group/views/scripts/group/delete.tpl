<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: delete.tpl 6516 2010-06-23 01:15:53Z shaun $
 * @author		 John
 */
?>

<h2><?php echo $this->translate('Delete Group:')?> <?php echo $this->subject()->__toString() ?></h2>

<div class='tabs'>
  <?php
    echo $this->navigation()
      ->menu()
      ->setContainer($this->navigation)
      ->render()
  ?>
</div>


<?php echo $this->form->render($this) ?>