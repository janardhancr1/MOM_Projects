<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: preview.tpl 6549 2010-06-23 23:57:50Z shaun $
 * @author     Jung
 */
?>
<div class="global_form_popup">

  <h2><?php echo $this->translate("Advertisement Preview") ?></h2><br/>
  <?php echo $this->preview?>
  <br/>
  <br/>
  <a onclick="parent.Smoothbox.close();" href="javascript:void(0);" type="button" id="cancel" name="cancel">
    <?php echo $this->translate("done") ?>
  </a>

</div>