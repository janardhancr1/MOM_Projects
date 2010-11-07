<?php
class User_FacebookController extends Core_Controller_Action_Standard
{
	public function facebookAction()
	{
		if ('none' != Engine_Api::_()->getApi('settings', 'core')->core_facebook_enable) {
			$facebook = User_Model_DbTable_Facebook::getFBInstance();
			if ($facebook->getSession()) {
					
				try {

					$me  = $facebook->api('/me');
					$uid = Engine_Api::_()->getDbtable('Facebook', 'User')->fetchRow(array('facebook_uid = ?'=>$facebook->getUser()));

					if ($uid)
					$uid = $uid->user_id;
					if ($uid) {
						// prevent Facebook users with established accounts from signing up again
						Engine_Api::_()->user()->getAuth()->getStorage()->write($uid);
						return $this->_helper->redirector->gotoRoute(array('action' => 'home'), 'user_general');
					} else {
						return $this->_helper->redirector->gotoRoute(array(), 'user_signup');
					}
				} catch (Exception $e) {
					throw $e;
				}
			}
		}
	}
}