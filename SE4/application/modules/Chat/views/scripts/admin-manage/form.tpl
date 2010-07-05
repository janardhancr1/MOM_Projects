<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Chat
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: form.tpl 6509 2010-06-22 23:49:13Z shaun $
 * @author     John
 */
?>

<?php if( $this->form ): ?>

  <?php echo $this->form->render($this) ?>

<?php else: ?>

  <div>
    <?php echo $this->translate("Changes saved.") ?>
  </div>

  <script type="text/javascript">
    (function() {
      parent.window.location = parent.window.location.href;
      parent.Smoothbox.close();
    }).delay(1000);
  </script>

<?php endif; ?>