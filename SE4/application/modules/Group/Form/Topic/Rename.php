<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Rename.php 6516 2010-06-23 01:15:53Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Group_Form_Topic_Rename extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Rename Topic')
      ;

    $this->addElement('Text', 'title', array(
      'label' => 'Title',
      'allowEmpty' => false,
      'required' => true,
      'validators' => array(
        array('StringLength', true, array(1, 64)),
      ),
      'filters' => array(
        new Engine_Filter_Censor(),
      ),
    ));

    $this->addElement('Button', 'submit', array(
      'type' => 'submit',
      'label' => 'Rename Topic',
    ));

    $this->addElement('Cancel', 'cancel', array(
      'label' => 'Cancel',
      'onclick' => 'parent.Smoothbox.close();',
    ));
  }
}