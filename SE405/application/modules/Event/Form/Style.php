<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Style.php 7244 2010-09-01 01:49:53Z john $
 * @author     Sami
 */

/**
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     Sami
 */
class Event_Form_Style extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Meetup Styles')
      ->setMethod('post')
      ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()))
      ->setAttrib('class', 'global_form_popup')
      ;

    $this->removeDecorator('FormWrapper');

    $this->addElement('Textarea', 'style', array(
      'label' => 'Custom Meetup Styles',
      'description' => 'You can change the colors, fonts, and styles of your Meetup by adding CSS code below. The contents of the text area below will be output between <style> tags on your Meetup.'
    ));
    $this->style->getDecorator('Description')->setOption('placement', 'APPEND');

    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true,
      'decorators' => array(
        'ViewHelper',
      ),
    ));

    $this->addElement('Cancel', 'cancel', array(
      'label' => 'cancel',
      'link' => true,
      'prependText' => ' or ',
      'onclick' => 'parent.Smoothbox.close();',
      'decorators' => array(
        'ViewHelper',
      ),
    ));

    $this->addDisplayGroup(array('submit', 'cancel'), 'buttons');

    $this->addElement('Hidden', 'id');
  }
}