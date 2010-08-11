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
      'onchange' => 'this.form.answer_search.value="";this.form.submit();',
     
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
            'label' => 'Category:',
            'multiOptions' => $categories_prepared,
      		'style' => 'width:150px',
     		'onchange' => 'this.form.answer_search.value="";this.form.submit();',
          ));
    }
    $content = Zend_Registry::get('Zend_Translate')->_("<img src='./application/modules/Core/externals/images/plus16.gif' border='0' class='button'>&nbsp;<a href='/index.php/answers/manage'>Go to My Questions</a>");
	$this->addElement('Dummy', 'my', array(
      'content' => $content,
    ));
   
  }
}