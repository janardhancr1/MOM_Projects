<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: install.tpl 6600 2010-06-28 19:24:04Z john $
 * @author     John
 */
?>

<?php if( !$this->queryError ): ?>

  <?php echo $this->form->render($this) ?>

<?php else: ?>

  <ul>
    <?php foreach( $this->errors as $error ): ?>
      <li>
        <?php echo $error ?>
      </li>
    <?php endforeach; ?>
  </ul>

<?php endif; ?>
