<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: create.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>

<?php if( $this->form ): ?>

  <?php echo $this->form->render($this) ?>

<?php elseif( $this->status ): ?>

  <div><?php echo $this->translate("Changes saved!") ?></div>

  <script type="text/javascript">
    setTimeout(function() {
      parent.Smoothbox.close();
      parent.window.location.replace( parent.window.location.href )
    }, 500);
  </script>

<?php endif; ?>