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
class Answer_Form_Index_Search extends Engine_Form
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
      
    $this->addElement('Text', 'answer_search', array(
      'size' => '25',
      'maxlength' => '100',
    'value' => 'What are you looking for?',
    'onfocus' => "if(this.value == 'What are you looking for?') this.value='';",
    'onblur'=> "if(this.value.length == 0) this.value='What are you looking for?';",
    
      'onchange' => 'this.form.submit();',
    ));
     $this->addElement('Select', 'browse_answers_by', array(
      'label' => 'Browse By:',
      'multiOptions' => array(
        'recent' => 'Most Recent',
        'open' => 'Open Questions',
     	'resolved' => 'Resolved Questions',
      ),
      'onchange' => 'this.form.submit();',
     
    ));
    $content = Zend_Registry::get('Zend_Translate')->_("<img src='./application/modules/Core/externals/images/plus16.gif' border='0' class='button'>&nbsp;<a href='/index.php/answers/manage'>Go to My Questions</a>");
	$this->addElement('Dummy', 'my_groups', array(
      'content' => $content,
    ));
   
  }
}