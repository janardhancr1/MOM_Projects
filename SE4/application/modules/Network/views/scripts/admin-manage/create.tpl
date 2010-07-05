<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Network
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: create.tpl 6522 2010-06-23 01:52:35Z shaun $
 * @author     Sami
 * @author     John
 */
?>

<?php echo $this->partial('_formAdminJs.tpl', array('form' => $this->form)) ?>

<div class="settings">
  <?php echo $this->form->render($this) ?>
</div>
