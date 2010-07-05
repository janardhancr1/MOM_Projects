<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     Jung
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Form_Admin_Widget_Logo extends Engine_Form
{
  public function init()
  {
    // Set form attributes
    $this->setTitle('Site Logo');
    $this->setDescription('Shows your site-wide main logo or title.  IIImages are uploaded via the File Media Manager.');
    $this->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()));

    $logo_options   = array();
    $logo_options[] = 'Text-only (No logo)';
    foreach (glob(APPLICATION_PATH . "/public/admin/{*.gif,*.jpg,*.jpeg,*.png}", GLOB_BRACE) as $file) {
      $logo_options["public/admin/".basename($file)] = basename($file);
    }
    $this->addElement('Select', 'logo', array(
      'label' => 'Site Logo',
      'multiOptions' => $logo_options,
    ));


    // init submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true,
    ));
  }
}