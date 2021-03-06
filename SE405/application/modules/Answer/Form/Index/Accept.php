<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Create.php 6241 2010-06-10 01:54:01Z jung $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Answer_Form_Index_Accept extends Engine_Form
{
  public function init()
  {   
   $this
      ->setAttribs(array(
        'id' => 'filter_form',
        'class' => 'global_answer_box',
      ))
      ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()))
      ;
      
    $this->addElement('Hidden', 'post_id', array(
      'order' => 2
    ));

    $this->addElement('Button', 'submit1', array(
      'label' => 'Accept',
      'type' => 'submit',
    ));
  }

}