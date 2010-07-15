<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: WidgetController.php
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Answer_Form_Search extends Engine_Form
{
  public function init()
  {
  	  
    $this
      ->setAttribs(array(
        'id' => 'filter_form',
        'class' => 'global_search_box',
      ))
      ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()))
      ;

    $this->addElement('Text', 'search', array(
      'size' => '50',
      'maxlength' => '100',
    'value' => 'What are you looking for?',
    'onfocus' => "if(this.value == 'What are you looking for?') this.value='';",
    'onblur'=> "if(this.value.length == 0) this.value='What are you looking for?';",
      
    ));
    
    $this->addElement('Button', 'submit', array(
      'label' => 'Search Answers',
      'type' => 'submit',
    'class' => 'btnStyle',
    ));
    
   
  }
}