<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: contact.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>

<?php if( $this->status ): ?>
  <?php echo $this->message; ?>
<?php else: ?>
  <?php echo $this->form->render($this) ?>
<?php endif; ?>