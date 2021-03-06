<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Delete.php 6512 2010-06-23 00:27:01Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Event_Form_Topic_Delete extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Delete Topic')
      ->setDescription('Are you sure you want to delete this topic?')
      ;

    $this->addElement('Button', 'submit', array(
      'type' => 'submit',
      'label' => 'Delete Topic',
    ));

    $this->addElement('Cancel', 'cancel', array(
      'label' => 'Cancel',
      'onclick' => 'parent.Smoothbox.close();',
    ));
  }
}