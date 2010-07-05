<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: type-delete.tpl 6514 2010-06-23 00:40:24Z shaun $
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
      parent.onTypeDelete();
      parent.Smoothbox.close();
    }).delay(1000);
  </script>

<?php endif; ?>