<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: create.tpl 6512 2010-06-23 00:27:01Z shaun $
 * @author     Sami
 */
?>

<h2>
  <?php echo $this->event->__toString()." ".$this->translate("&#187; Discussions") ?>
</h2>

<?php echo $this->form->render($this) ?>