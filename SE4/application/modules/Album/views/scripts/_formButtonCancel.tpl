<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: _formButtonCancel.tpl 6541 2010-06-23 23:03:28Z shaun $
 * @author     Sami
 */
?>

<div id="submit-wrapper" class="form-wrapper">
  <div id="submit-label" class="form-label"> </div>
  <div id="submit-element" class="form-element">
    <button type="submit" id="done" name="done">
      <?php echo ( $this->element->getLabel() ? $this->element->getLabel() : $this->translate('Save Changes')) ?>
    </button>
      <?php echo $this->translate('or');?>
    <a href="<?php Zend_Controller_Front::getInstance()->getRouter()->assemble(array('action' => 'manage'), 'album_general', true) ?>"><?php echo $this->translate('cancel');?></a>
  </div>
</div>