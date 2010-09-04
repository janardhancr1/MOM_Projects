<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Create.php 6038 2010-05-29 02:07:34Z jung $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Classified_Form_Create extends Engine_Form
{
	public $_error = array();

	public function init()
	{
		//$this->setTitle('Post New Listing')
		// ->setDescription('Compose your new classified listing below, then click "Post Listing" to publish the listing.')
		$this->setAttrib('name', 'classifieds_create');

		$this->addElement('Text', 'title', array(
      'label' => 'Listing Title',
      'allowEmpty' => false,
      'required' => true,
      'filters' => array(
        'StripTags',
		new Engine_Filter_Censor(),
		new Engine_Filter_StringLength(array('max' => '63')),
		)));

		$user = Engine_Api::_()->user()->getViewer();
		$user_level = Engine_Api::_()->user()->getViewer()->level_id;

		// init to
		$this->addElement('Text', 'tags',array(
      'label'=>'Tags (Keywords)',
      'autocomplete' => 'off',
      'description' => 'Separate tags with commas.',
      'filters' => array(
		new Engine_Filter_Censor(),
		),
		));
		$this->tags->getDecorator("Description")->setOption("placement", "append");

		// prepare categories
		$categories = Engine_Api::_()->classified()->getCategories();
		if (count($categories)!=0){
			$categories_prepared[0]= "";
			foreach ($categories as $category){
				$categories_prepared[$category->category_id]= $category->category_name;
			}

			// category field
			$this->addElement('Select', 'category_id', array(
            'label' => 'Category',
            'multiOptions' => $categories_prepared,
			'onchange' => 'javascript:getSubCats(this.value);',
			));
		}

		$sub_prepared[0]= "";
		if($_SESSION['catid'])
		{
			$catid = $_SESSION['catid'];
			$subcategories = Engine_Api::_()->classified()->getSubCategories($catid);
			foreach($subcategories as $subcategory)
			{
				$sub_prepared[$subcategory->category_id]= $subcategory->category_name;
			}
		}
		// sub category field
		$this->addElement('Select', 'sub_category_id', array(
            'label' => 'Sub Category',
            'multiOptions' => $sub_prepared,
      		'style' => 'width:153px',
		));

		$this->addElement('Textarea', 'body', array(
      'label' => 'Description',
      'filters' => array(
        'StripTags',
		new Engine_Filter_HtmlSpecialChars(),
		new Engine_Filter_EnableLinks(),
		new Engine_Filter_Censor(),
		),
		));
		$allowed_upload = Engine_Api::_()->authorization()->getPermission($user_level, 'classified', 'photo');
		if($allowed_upload){
			$this->addElement('File', 'photo', array(
        'label' => 'Main Photo'
        ));
        $this->photo->addValidator('Extension', false, 'jpg,png,gif');
		}
		// Add subforms
		if (!$this->_item){
			$customFields = new Classified_Form_Custom_Fields();
		}
		else $customFields = new Classified_Form_Custom_Fields(array('item'=>$this->getItem()));

		$this->addSubForms(array(
      'customField' => $customFields
		));

		// View
		$availableLabels = array(
      'everyone'       => 'Everyone',
      'owner_network' => 'Friends and Networks',
      'owner_member_member'  => 'Friends of Friends',
      'owner_member'         => 'Friends Only',
      'owner'          => 'Just Me'
      );

      $options = (array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('classified', $user, 'auth_view');
      $options = array_intersect_key($availableLabels, array_flip($options));

      $this->addElement('Select', 'auth_view', array(
      'label' => 'Privacy',
      'description' => 'Who may see this classified listing?',
      'multiOptions' => $options,
      'value' => 'everyone',
      ));
      $this->auth_view->getDecorator('Description')->setOption('placement', 'append');

      $options =(array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('classified', $user, 'auth_comment');
      $options = array_intersect_key($availableLabels, array_flip($options));

      // Comment
      $this->addElement('Select', 'auth_comment', array(
      'label' => 'Comment Privacy',
      'description' => 'Who may post comments on this classified listing?',
      'multiOptions' => $options,
      'value' => 'everyone',
      ));
      $this->auth_comment->getDecorator('Description')->setOption('placement', 'append');


      $this->addElement('Button', 'submit', array(
      'label' => 'Post Listing',
      'type' => 'submit',
      'decorators' => array(array('ViewScript', array(
        'viewScript' => '_formButtonCancel.tpl',
        'class'      => 'form element'
        )))));

	}

}