<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: delete.tpl 6551 2010-06-23 23:59:46Z shaun $
 * @author     John
 */
?>
<?php if( !$this->status ): ?>
  <?php echo $this->form->render($this) ?>
<?php else: ?>
  <?php echo $this->translate('Deleted') ?>
  <script type="text/javascript">
    var fileindex = '<?php echo sprintf('%d', $this->fileIndex) ?>';
    setTimeout(function() {
      //parent.$('admin_file_' + fileindex).destroy();
      parent.window.location.replace( parent.window.location.href );
      parent.Smoothbox.close();
    }, 1000);
  </script>
<?php endif; ?>