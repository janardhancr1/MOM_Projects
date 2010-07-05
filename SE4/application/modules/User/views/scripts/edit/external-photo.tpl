<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: external-photo.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>
<div style="padding: 10px;">
  <?php echo $this->form->setAttrib('class', 'global_form_popup')->render($this) ?>

  <?php echo $this->itemPhoto($this->photo) ?>
</div>