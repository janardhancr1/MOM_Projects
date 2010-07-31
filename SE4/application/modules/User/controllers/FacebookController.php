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
						/*$user['email'] = $me['email'];
						$user['password'] = 'password';
						return $this->authenticate($user);*/
						return $this->_helper->redirector->gotoRoute(array('action' => 'home'), 'user_general');
					} else {
						return $this->_helper->redirector->gotoRoute(array(), 'user_signup');
						/*
						$fb_data = array();
						$fb_data["email"] = $me['email'];
						$fb_data["username"] = preg_replace('/[^A-Za-z]/', '', $me['name']);
						$fb_data["password"] = 'password';
						$maps    = Engine_Api::_()->fields()->getFieldsMaps('user');

						foreach (array('gender', 'first_name', 'last_name', 'birthdate') as $field_alias) {
							if (isset($me[$field_alias])) {
								$field    = Engine_Api::_()->fields()->getFieldsObjectsByAlias('user', $field_alias);
								$field_id = $field[$field_alias]['field_id'];
								foreach ($maps as $map) {
									if ($field_id == $map->child_id) {
										$fb_data[$map->getKey()] = $me[$field_alias];
									}
								}
							}
						}
						$this->getSession()->data = $fb_data;
						$user = Engine_Api::_()->getDbtable('users', 'user')->createRow();
						$user->setFromArray($fb_data);
						$user->save();
						Engine_Api::_()->user()->setViewer($user);
						
						return $this->authenticate($user);*/
					}
				} catch (Exception $e) {
					throw $e;
				}
			}
		}
	}

	public function authenticate($data)
	{
		$authResult = Engine_Api::_()->user()->authenticate($data["email"], $data["password"]);
		$authCode = $authResult->getCode();
		Engine_Api::_()->user()->setViewer();
			
		// Increment sign-in count
		Engine_Api::_()->getDbtable('statistics', 'core')->increment('user.logins');

		// Test activity @todo remove
		$viewer = Engine_Api::_()->user()->getViewer();
		if( $viewer->getIdentity() )
		{
			$viewer->lastlogin_date = date("Y-m-d H:i:s");
			$viewer->lastlogin_ip   = $_SERVER['REMOTE_ADDR'];
			$viewer->save();
			Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($viewer, $viewer, 'login');
		}

		// Assign sid to view for json context
		$this->view->status = true;
		$this->view->message = Zend_Registry::get('Zend_Translate')->_('Login successful');
		$this->view->sid = Zend_Session::getId();
		$this->view->sname = Zend_Session::getOptions('name');

		return $this->_helper->redirector->gotoRoute(array('action' => 'home'), 'user_general');
	}
}