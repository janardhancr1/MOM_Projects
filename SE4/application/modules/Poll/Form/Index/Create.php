<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Create.php 6241 2010-06-10 01:54:01Z jung $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Poll_Form_Index_Create extends Engine_Form
{
  public function init()
  {
    //$this->setTitle('Create Poll')
    //     ->setDescription('Create your poll below, then click "Create Poll" to start your poll.');
    
    $auth = Engine_Api::_()->authorization()->context;
    $user = Engine_Api::_()->user()->getViewer();

    $this->addElement('text', 'title', array(
        'label' => 'Poll Title',
        'required' => true,
        'maxlength' => 63,
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '63'))
        ),
      ));
    $this->addElement('textarea', 'description', array(
        'label' => 'Description',
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '400'))
        ),
      ));

    $this->addElement('textarea', 'options', array(
        'label' => 'Possible Answers',
        'style' => 'display:none;',
      ));

    // View

    $availableLabels = array(
      'everyone'       => 'Everyone',
      'owner_network' => 'Friends and Networks',
      'owner_member_member'  => 'Friends of Friends',
      'owner_member'         => 'Friends Only',
      'owner'          => 'Just Me'
    );

    // Init profile view

    $options = (array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('poll', $user, 'auth_view');
    $options = array_intersect_key($availableLabels, array_flip($options));


    $this->addElement('Select', 'auth_view', array(
      'label' => 'Privacy',
      'description' => 'Who may see this poll?',
      'multiOptions' => $options,
      'value' => 'everyone',
    ));
    $this->auth_view->getDecorator('Description')->setOption('placement', 'append');



    // Comment
    // Init profile comment
    $options =(array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('poll', $user, 'auth_comment');
    $options = array_intersect_key($availableLabels, array_flip($options));

    $this->addElement('Select', 'auth_comment', array(
      'label' => 'Comment Privacy',
      'description' => 'Who may post comments on this poll?',
      'multiOptions' => $options,
      'value' => 'everyone',
    ));
    $this->auth_comment->getDecorator('Description')->setOption('placement', 'append');

    $this->addElement('button', 'submit', array(
        'label' => 'Create Poll',
        'type' => 'submit'
      ));
  }

  public function save()
  {
    $db_polls       = Engine_Api::_()->poll()->api()->getDbtable('polls', 'poll');
    $db_pollOptions = Engine_Api::_()->poll()->api()->getDbtable('options', 'poll');
    $censor         = new Engine_Filter_Censor();
    
    // @todo find a better way to trick Zend_Form
    $options = array();
    foreach ($_POST['optionsArray'] as $option)
      if (strlen(trim($option)))
        $options[] = strip_tags(trim($option));
    $max_options = Engine_Api::_()->getApi('settings', 'core')->getSetting('polls.maxOptions', 15);
    while (count($options) > $max_options)
      array_pop($options);

    if (count($options) < 2) {
      $this->setErrors(array('You must provide at least two possible answers.'));
      return false;
    }

    // try/catch being done in controller
    $poll = $db_polls->createRow();
    $poll->user_id       = Engine_Api::_()->user()->getViewer()->getIdentity();
    $poll->is_closed     = 0;
    $poll->title         = $this->getElement('title')->getValue();
    $poll->description   = $this->getElement('description')->getValue();
    $poll->creation_date = date('Y-m-d H:i:s');
    $poll->save();

    #foreach ($this->getElement('options')->getValue() as $option) {
    foreach ($options as $option) {
      if (trim($option) != '') {
        $row = $db_pollOptions->createRow();
        $row->poll_id      = $poll->poll_id;
        $row->poll_option  = $censor->filter(trim($option));
        $row->save();
      }
    }

    return $poll->poll_id;

  }
}