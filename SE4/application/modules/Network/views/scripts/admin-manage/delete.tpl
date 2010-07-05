<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Network
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: delete.tpl 6522 2010-06-23 01:52:35Z shaun $
 * @author     Sami
 * @author     John
 */
?>

<?php if( @$this->form ): ?>
  <?php echo $this->form->render($this) ?>
<?php endif; ?>

<?php if( @$this->status ): ?>
  <script type="text/javascript">
    setTimeout(function() {
      parent.Smoothbox.close();
      parent.window.location.replace( parent.window.location.href );
    }, 1000);
  </script>
<?php endif; ?>
