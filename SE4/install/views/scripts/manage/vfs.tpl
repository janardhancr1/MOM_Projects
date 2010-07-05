<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: vfs.tpl 6641 2010-06-30 01:22:51Z john $
 * @author     John
 */
?>

<?php
  // Navigation
  echo $this->render('_managerMenu.tpl')
?>

<h2>Add Packages</h2>

<?php
  // Navigation
  echo $this->render('_installMenu.tpl')
?>

<br />


<?php if( $this->form ): ?>

  <?php echo $this->form->render($this) ?>

<?php else: ?>

  <form action="<?php echo $this->url() ?>">
    <?php echo $this->formRadio('location', null, array(), $this->paths) ?>
    <br />
    <br />
    <?php echo $this->formButton('submit', 'Select Path', array('type' => 'submit')) ?>

  </form>

<?php endif; ?>