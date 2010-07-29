<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Search.php 6532 2010-06-23 22:17:37Z shaun $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Poll_Form_Index_Search extends Engine_Form
{
  public function init()
  {
    $this
      ->setAttribs(array(
        'id' => 'filter_form',
        'class' => 'global_search_box',
      ))
      ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array('page'=>1)));

    parent::init();
    
    $this->addElement('Text', 'poll_search', array(
      'label' => 'Search Polls:'
    ));

    $this->addElement('Select', 'browse_polls_by', array(
      'label' => 'Browse By:',
      'multiOptions' => array(
        'recent' => 'Most Recent',
        'popular' => 'Most Popular',
      ),
    ));

    $content = Zend_Registry::get('Zend_Translate')->_("<img src='./application/modules/Core/externals/images/plus16.gif' border='0' class='button' style='padding-left:30px'>&nbsp;<a href='/index.php/polls/manage'>Go to My Polls</a>");
	$this->addElement('Dummy', 'my_groups', array(
      'content' => $content,
    ));
  }
}