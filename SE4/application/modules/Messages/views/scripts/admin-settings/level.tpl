<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Messages
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: level.tpl 6519 2010-06-23 01:41:45Z shaun $
 * @author     John
 */
?>

<div class='clear'>

  <?php
    echo $this->navigation()
      ->menu()
      ->setContainer($this->navigation)
      ->setUlClass('admin_levels_tabs')
      ->render()
  ?>

  <div class='settings'>
    <?php echo $this->form->render($this) ?>
  </div>

</div>