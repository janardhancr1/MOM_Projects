<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Rsvp.php 6512 2010-06-23 00:27:01Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Event_Form_Rsvp extends Engine_Form
{
  public function init()
  {

    $select_element = new Engine_Form_Element_Radio('rsvp');
    $options = Array("Attending", "Maybe Attending", "Not Attending");
    $select_element->addMultiOptions($options);
    $this->addElement($select_element);
    $this->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()))->setMethod('POST');
  }
}