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
class Answer_Form_Index_Create extends Engine_Form
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
    
     $this->addElement('Text', 'title', array(
      'size' => '50',
      'maxlength' => '100',
      'value' => 'What Would You Like to Know?',
     'onfocus' => "if(this.value == 'What Would You Like to Know?') this.value='';",
     'onblur'=> "if(this.value.length == 0) this.value='What Would You Like to Know?';",
    ));
    
	$this->addElement('Text', 'description',array(
      'label'=>'Additional Details (Optional)',
	  'size' => '50',
      'maxlength' => '100',
    ));
    // init to
    $this->addElement('Text', 'tags',array(
      'label'=>'Tags - help moms find your question, i.e.', 
      'size' => '50',
      'maxlength' => '100',
    ));
  
    
    // prepare categories
    $categories = Engine_Api::_()->answer()->getCategories();
    if (count($categories)!=0){
      $categories_prepared[0]= "";
      foreach ($categories as $category){
        $categories_prepared[$category->category_id]= $category->category_name;
        
      }

      // category field
      $this->addElement('Select', 'category_id', array(
            'label' => 'Category',
            'multiOptions' => $categories_prepared
          ));
    }

    $this->addElement('Button', 'submit', array(
      'label' => 'Ask Question',
      'type' => 'submit',
    ));
    

  }
  
 public function save()
  {
    $db_answer       = Engine_Api::_()->answer()->api()->getDbtable('answers', 'answer');
    $censor         = new Engine_Filter_Censor();
    
    // try/catch being done in controller
    $answer = $db_answer->createRow();
    $answer->user_id        = Engine_Api::_()->user()->getViewer()->getIdentity();
    $answer->is_closed       = 0;
    $answer->title    		 = $this->getElement('title')->getValue();
    $answer->description     = $this->getElement('description')->getValue();
    $answer->answer_tags     = $this->getElement('tags')->getValue();
    $answer->answer_cat_id   = $this->getElement('category_id')->getValue();
    $answer->creation_date   = date('Y-m-d H:i:s');
    
    $answer->save();
    return $answer->answer_id;

  }

}