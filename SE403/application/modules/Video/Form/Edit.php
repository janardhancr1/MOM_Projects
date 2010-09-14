<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Edit.php 7244 2010-09-01 01:49:53Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Video_Form_Edit extends Engine_Form
{
  public function init()
  {
    $this->setTitle('Edit Video')
      ->setAttrib('name', 'video_edit');
    $user = Engine_Api::_()->user()->getViewer();

    $this->addElement('Text', 'title', array(
      'label' => 'Video Title',
      'required' => true,
      'notEmpty' => true,
      'validators' => array(
        'NotEmpty',
      ),
      'filters' => array(
        //new Engine_Filter_HtmlSpecialChars(),
        'StripTags',
        new Engine_Filter_Censor(),
        new Engine_Filter_StringLength(array('max' => '100'))
      )
    ));
    $this->title->getValidator('NotEmpty')->setMessage("Please specify an video title");
    
    // init tag
    $this->addElement('Text', 'tags',array(
      'label'=>'Tags (Keywords)',
      'autocomplete' => 'off',
      'description' => 'Separate tags with commas.'
    ));
    $this->tags->getDecorator("Description")->setOption("placement", "append");

    $this->addElement('Textarea', 'description', array(
      'label' => 'Video Description',
      'rows' => 2,
      'maxlength' => '512',
      'filters' => array(
        'StripTags',
        //new Engine_Filter_HtmlSpecialChars(),
        new Engine_Filter_Censor(),
        new Engine_Filter_EnableLinks(),
      )
    ));

    // prepare categories
    $categories = Engine_Api::_()->video()->getCategories();
    $categories_prepared[0]= "";
    foreach ($categories as $category){
      $categories_prepared[$category->category_id]= $category->category_name;
    }

    // category field
    $this->addElement('Select', 'category_id', array(
          'label' => 'Category',
          'multiOptions' => $categories_prepared
        ));
    
    $this->addElement('Checkbox', 'search', array(
      'label' => "Show this video in search results",
    ));

    
    $availableLabels = array(
      'everyone'       => 'Everyone',
      'owner_network' => 'Friends and Networks',
      'owner_member_member'  => 'Friends of Friends',
      'owner_member'         => 'Friends Only',
      'owner'          => 'Just Me'
    );

    $options = (array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('video', $user, 'auth_view');
    $options = array_intersect_key($availableLabels, array_flip($options));


    // View
    $this->addElement('Select', 'auth_view', array(
      'label' => 'Privacy',
      'description' => 'Who may see this video?',
      'multiOptions' => $options,
      'value' => 'everyone',
    ));
    $this->auth_view->getDecorator('Description')->setOption('placement', 'append');

    // Comment
    $options =(array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('video', $user, 'auth_comment');
    $options = array_intersect_key($availableLabels, array_flip($options));

    // Comment
    $this->addElement('Select', 'auth_comment', array(
      'label' => 'Comment Privacy',
      'description' => 'Who may post comments on this video?',
      'multiOptions' => $options,
      'value' => 'everyone',
    ));
    $this->auth_comment->getDecorator('Description')->setOption('placement', 'append');

    $this->addElement('Button', 'submit', array(
      'label' => 'Save Video',
      'type' => 'submit',
      'decorators' => array(array('ViewScript', array(
        'viewScript' => '_formButtonCancel.tpl',
        'class'      => 'form element'
    )))));

  }
}
