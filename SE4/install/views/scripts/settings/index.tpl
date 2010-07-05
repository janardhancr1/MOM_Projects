<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>

<?php
  // Navigation
  echo $this->render('_managerMenu.tpl')
?>

<h2>
  Manager Settings
</h2>


<?php echo $this->form->render($this) ?>