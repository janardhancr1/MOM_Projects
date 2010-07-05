<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: upload.tpl 6551 2010-06-23 23:59:46Z shaun $
 * @author     John
 */
?>
<div>
  <?php echo $this->htmlLink(array('action' => 'index', 'reset' => false), $this->translate('Back to File Manager')) ?>
</div>

<br />

<div class="error">
  <?php echo $this->error ?>
</div>