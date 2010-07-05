<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Chat
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: IndexController.php 6509 2010-06-22 23:49:13Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Chat
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Chat_IndexController extends Core_Controller_Action_User
{
  public function indexAction()
  {
    //var_dump(Zend_Locale::getTranslation(null, 'datetime'));
    //echo strftime(Zend_Locale::getTranslation(null, 'datetime'));
    //die();
    // Get rooms
    $roomTable = Engine_Api::_()->getDbtable('rooms', 'chat');
    $select = $roomTable->select()
      ->where('public = ?', 1);

    $rooms = array();
    foreach( $roomTable->fetchAll($select) as $room ) {
      $rooms[$room->room_id] = $room->toRemoteArray();
    }
    $this->view->rooms = $rooms;
    
    $viewer = Engine_Api::_()->user()->getViewer();
    $this->view->isOperator = $viewer->authorization()->isAllowed('admin');
  }

  public function banAction()
  {
    
  }
  public function languageAction()
  {
    $this->_helper->layout->disableLayout(true);
    $this->getResponse()->setRawHeader('Content-type: application/javascript');
  }
}