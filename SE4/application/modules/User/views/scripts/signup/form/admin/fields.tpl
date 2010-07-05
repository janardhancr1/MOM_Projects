<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: fields.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     Sami
 */
?>

<?php
  /* Include the common user-end field switching javascript */
  echo $this->partial('_jsSwitch.tpl', 'fields', array('topLevelId' => 0))
?>

<?php echo $this->form->render($this) ?>
