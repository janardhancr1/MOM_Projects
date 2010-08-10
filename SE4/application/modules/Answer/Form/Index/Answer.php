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
class Answer_Form_Index_Answer extends Engine_Form
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
    
	$this->addElement('Textarea', 'description',array(
      'label'=>'Your Answer',
      'maxlength' => '500',
    ));
  

    $this->addElement('Button', 'submit', array(
      'label' => 'Post Answer',
      'type' => 'submit',
    ));
  }
  
 public function save($id)
  {
    $db_answer       = Engine_Api::_()->answer()->api()->getDbtable('posts', 'answer');
    $censor         = new Engine_Filter_Censor();
    
    // try/catch being done in controller
    $answer = $db_answer->createRow();
    $answer->user_id        = Engine_Api::_()->user()->getViewer()->getIdentity();
    $answer->is_closed       = 0;
    $answer->answer_id       = $id;
    $answer->answer_description     = $this->getElement('description')->getValue();
    $answer->creation_date   = date('Y-m-d H:i:s');
    
    $answer->save();
    return $answer->post_id;

  }

}