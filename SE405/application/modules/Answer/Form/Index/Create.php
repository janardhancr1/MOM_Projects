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
		$this->addElement('Text', 'title', array(
     'label'=>'Your Question', 
      'maxlength' => '100',
      'value' => 'What Would You Like to Know?',
     'onfocus' => "if(this.value == 'What Would You Like to Know?') this.value='';",
     'onblur'=> "if(this.value.length == 0) this.value='What Would You Like to Know?';",
		));

		$this->addElement('Textarea', 'description',array(
      'label'=>'Additional Details (Optional)',
	  'style' => 'width:200px',
      'maxlength' => '100',
		));
		// init to
		$this->addElement('Text', 'tags',array(
      'label'=>'Tags',
      'description' => '(help moms find your question i.e. sleeping, feeding, crying)', 
      'maxlength' => '100',
      'class' => 'tags_input',
		));

		$this->tags->getDecorator('Description')->setOption('placement', 'append');

		// prepare categories
		$categories = Engine_Api::_()->answer()->getCategories();
		if (count($categories)!=0){
			$categories_prepared[0]= "";
			foreach ($categories as $category){
				//if($category->parent_cat_id == 0)
				//{
					$categories_prepared[$category->category_id]= $category->category_name;
				//}
			}

			// category field
			$this->addElement('Select', 'category_id', array(
            'label' => 'Category',
            'multiOptions' => $categories_prepared,
      		'style' => 'width:202px',
      		'onchange' => 'javascript:getSubCats(this.value);',
			));
		}

		$sub_prepared[0]= "";
		if(isset($_SESSION['catid']))
		{
			$catid = $_SESSION['catid'];
			$subcategories = Engine_Api::_()->answer()->getSubCategories($catid);
			foreach($subcategories as $subcategory)
			{
				$sub_prepared[$subcategory->category_id]= $subcategory->category_name;
			}
		}
		// sub category field
		$this->addElement('Select', 'sub_cat_id', array(
            'label' => 'Sub Category',
            'multiOptions' => $sub_prepared,
      		'style' => 'width:202px',
		));
		
		$this->addElement('Checkbox', 'anonymous', array(
            'label' => 'Anonymous',
		));


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
		$answer->user_id         	= Engine_Api::_()->user()->getViewer()->getIdentity();
		$answer->is_closed       	= 0;
		$answer->title    			= $this->getElement('title')->getValue();
		$answer->description     	= $this->getElement('description')->getValue();
		$answer->answer_tags     	= $this->getElement('tags')->getValue();
		$answer->answer_cat_id   	= $this->getElement('category_id')->getValue();
		$answer->answer_sub_cat_id	= $this->getElement('sub_cat_id')->getValue();
		$answer->anonymous	        = $this->getElement('anonymous')->getValue();
		$answer->creation_date   	= date('Y-m-d H:i:s');

		$answer->save();
		$answers_array = array();
		$answers_array[0] = $answer->answer_id;
		$answers_array[1] = $answer->anonymous;
		return $answers_array;

	}
}