<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Announcement
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Delete.php 6506 2010-06-22 23:34:02Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Announcement
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Announcement_Form_Admin_Delete extends Engine_Form
{
  public function init()
  {
    $this->setTitle('Delete Announcement')
      ->setDescription('Are you sure you want to delete this announcement?');

    $this->addElement('Button', 'submit', array(
      'label' => 'Delete Announcement',
      'type' => 'submit',
    ));

    $this->addElement('Button', 'cancel', array(
      'label' => 'cancel',
      'onclick' => 'window.location.href="'.Zend_Controller_Front::getInstance()->assemble().'";'
    ));
  }
}