<?php
class Socialdna_LinkController extends Core_Controller_Action_Standard
{
  public function indexAction()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');
    
    $viewer = Engine_Api::_()->user()->getViewer();
    
    // requires user
    if( !$viewer->getIdentity() )
    {
      return $this->_helper->redirector->gotoRoute(array(), 'default', true);
    }

    $request = $this->getRequest();

    $openid_session = $request->get('openidsession');
    $openid_service = $request->get('openidservice');
    $task = $request->get('task');
    $next = $request->get('next','');

    $service = Engine_Api::_()->getApi('core', 'socialdna');

    $openid_service_info = $service->getService($openid_service);
    
    // no service or disabled
    if(empty($openid_service_info)) {
      return $this->_helper->redirector->gotoRoute(array(), 'default', true);
    }
    
    // user already connected
    if($service->isUserConnected($viewer->getIdentity(),$openid_service)) {
      return $this->_helper->redirector->gotoRoute(array(), 'default', true);
    }

    $service->getOpenidapi($openid_session, $openid_service);
    
    // check if already linked to another account
    $user_id = $service->getUserIdFromService($service->openid_user_id, $openid_service);
    
    $already_linked = false;
    
    if($user_id != 0) {
      $already_linked = true;
    }
    
    if(($task == 'confirmlink') && !$already_linked) {
      $service->linkUserToOpenid($viewer->getIdentity());
      $service->updateSession($openid_session, $openid_service, $viewer->getIdentity());
      $service->destroySession();

      
      if(!empty($next)) {

        if($next == 'socialdna_facebook') {
          $next = Zend_Controller_Front::getInstance()->getRouter()->assemble(array(
                    'module'      => 'socialdna',
                    'controller'  => 'index',
                    'action'      => 'facebook'),
                  'default');
        } elseif($next == 'socialdna_facebookinvite') {
          $next = Zend_Controller_Front::getInstance()->getRouter()->assemble(array(
                    'module'      => 'socialdna',
                    'controller'  => 'index',
                    'action'      => 'facebookinvite'),
                  'default');
        }

        return $this->_redirect($next, array('prependBase' => false));

      } else {

        return $this->_helper->redirector->gotoRoute(array('action' => 'home'), 'user_general');

      }

    }
    

    $openid_user_fullname = $service->getOpenidFieldValue('name');
    if($openid_user_fullname == '') {

      $openid_user_fullname = $service->getOpenidFieldValue('first_name') . ' ' . $service->getOpenidFieldValue('last_name');
      $openid_user_fullname = trim($openid_user_fullname);
      
    }
    $openid_user_thumb = $service->getOpenidFieldValue('pic_square');
    if($openid_user_thumb == '') {
      $openid_user_thumb = $service->getOpenidFieldValue('pic_big');
    }


    $this->view->openid_session = $openid_session;
    $this->view->openid_service = $openid_service;
    $this->view->openid_service_info = $openid_service_info;
            
    $this->view->openid_user_fullname  = $openid_user_fullname;
    $this->view->openid_user_thumb = $openid_user_thumb;
    $this->view->openid_service = $openid_service;
    $this->view->user_full_name = $viewer->getTitle();
    $this->view->next = $next;
    
    $this->view->already_linked = $already_linked;
    
  }
}