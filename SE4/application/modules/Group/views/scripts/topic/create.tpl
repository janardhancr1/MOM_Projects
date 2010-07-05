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

<h2>
  <?php echo $this->group->__toString() ?>
  <?php echo $this->translate('&#187; Discussions');?>
</h2>

<?php echo $this->form->render($this) ?>