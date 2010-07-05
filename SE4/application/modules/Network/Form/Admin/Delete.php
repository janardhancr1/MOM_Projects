<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Network
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Delete.php 6522 2010-06-23 01:52:35Z shaun $
 * @author     Sami
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Network
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Network_Form_Admin_Delete extends Engine_Form
{
  public function init()
  {
    $this->setTitle("Delete Network")
      ->setDescription('Are you sure you want to delete this network?');

    $this->addElement('Button', 'submit', array(
      'label' => 'Delete Network',
      'type' => 'submit',
      'ignore' => true,
      'decorators' => array('ViewHelper'),
    ));

    $this->addElement('Cancel', 'cancel', array(
      'label' => 'cancel',
      'prependText' => ' or ',
      'ignore' => true,
      'link' => true,
      'onClick' => 'parent.Smoothbox.close();',
      'decorators' => array('ViewHelper'),
    ));

    $this->addDisplayGroup(array('submit', 'cancel'), 'buttons');
  }
}