<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: IndexController.php 7253 2010-09-01 20:40:55Z jung $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class User_IndexController extends Core_Controller_Action_Standard
{
  public function init()
  {
	if( !$this->_helper->requireUser()->isValid() ) return;
  }
  
  public function indexAction()
  {

  }
  
    public function inviteAction()
	{
		if( !$this->_executeSearch() ) {
			throw new Exception('error');
		}

		$vuser = Engine_Api::_()->user()->getViewer();
		$this->view->maxOptions = 10;
		$this->view->inviteForm = $inviteForm = new User_Form_Invite();

		if($this->getRequest()->isPost() && $this->view->form->isValid($this->getRequest()->getPost()))
		{
			if( !$inviteForm->isValid($this->getRequest()->getPost()) )
			{
				return;
			}
			$values = $this->view->inviteForm->getValues();
			try
			{
				$valid = $this->view->inviteForm->validate();
				if (empty($valid))
				return;
					
				$options = array();
				foreach ($_POST['optionsArray'] as $option)
				if (strlen(trim($option)))
				$options[] = strip_tags(trim($option));

				$body = $values['message'];
					
				$mail = new Zend_Mail();
				$from = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.invite.from');
				$fromname = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.invite.fromname');
				$subject = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.invite.subject');

				$mail->setFrom($from, $fromname);
				foreach($options as $key => $value)
				{
					$mail->addTo($value, $value);
				}
				$mail->setSubject($subject . ' - ' .$vuser->username);
				$mail->setBodyText($body);

				//$mail->send();

				$inviteForm->addNotice(Zend_Registry::get('Zend_Translate')->_('Your invite has been sent to your friends'));
				$inviteForm->clearElements();
				$this->view->maxOptions = 11;
				//return $this->_redirect("members");
			} catch (Exception $e) {
				throw $e;
			}
		}
		/*$inviteMessage = new Zend_Mail_Transport_Sendmail();
		 $inviteMessage->recipients = 'janardhancr@gmail.com';
		 $inviteMessage->body = 'This is sample message';
		 $inviteMessage->subject = 'test message';
		 $inviteMessage->_sendMail();*/
	}

  public function homeAction()
  {
    // check public settings
    $require_check = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.general.browse', 1);
    if(!$require_check){
      if( !$this->_helper->requireUser()->isValid() ) return;
    }

    if( !Engine_Api::_()->user()->getViewer()->getIdentity() )
    {
      return $this->_helper->redirector->gotoRoute(array(), 'home', true);
    }
    $this->_helper->content->render();
    //$this->_helper->content->setNoRender()->render();
  }

  public function browseAction()
  {
    if( !$this->_executeSearch() ) {
      throw new Exception('error');
    }

    if( $this->_getParam('ajax') ) {
      $this->renderScript('_browseUsers.tpl');
    }
  }
  
  protected function _executeSearch()
  {
    // Check form
    $form = new User_Form_Search(array(
      'type' => 'user'
    ));

    if( !$form->isValid($this->_getAllParams()) ) {
      $this->view->error = true;
      return false;
    }

    $this->view->form = $form;

    // Get search params
    $page = (int)  $this->_getParam('page', 1);
    $ajax = (bool) $this->_getParam('ajax', false);
    $options = $form->getValues();

    // Get table info
    $table = Engine_Api::_()->getItemTable('user');
    $userTableName = $table->info('name');

    $searchTable = Engine_Api::_()->fields()->getTable('user', 'search');
    $searchTableName = $searchTable->info('name');

    //extract($options); // displayname
    $profile_type = @$options['profile_type'];
    $displayname = @$options['displayname'];
    extract($options['extra']); // is_online, has_photo, submit

    // Contruct query
    $select = $table->select()
      //->setIntegrityCheck(false)
      ->from($userTableName)
      ->joinLeft($searchTableName, "`{$searchTableName}`.`item_id` = `{$userTableName}`.`user_id`", null)
      //->group("{$userTableName}.user_id")
      ->where("{$userTableName}.search = ?", 1)
      ->where("{$userTableName}.enabled = ?", 1)
      ->order("{$userTableName}.displayname ASC");

    // Build the photo and is online part of query
    if( !empty($has_photo) ) {
      $select->where($userTableName.'.photo_id != ?', "0");
    }

    if( !empty($is_online) ) {
      $select
        ->joinRight("engine4_user_online", "engine4_user_online.user_id = `{$userTableName}`.user_id", null)
        ->group("engine4_user_online.user_id")
        ->where($userTableName.'.user_id != ?', "0");
    }

    // Add displayname
    if( !empty($displayname) ) {
      $select->where("`{$userTableName}`.`displayname` LIKE ?", "%{$displayname}%");
    }

    // Build search part of query
    $searchParts = Engine_Api::_()->fields()->getSearchQuery('user', $options);
    foreach( $searchParts as $k => $v ) {
      $select->where("`{$searchTableName}`.{$k}", $v);
    }

    // Build paginator
    $paginator = Zend_Paginator::factory($select);
    $paginator->setItemCountPerPage(10);
    $paginator->setCurrentPageNumber($page);
    
    $this->view->page = $page;
    $this->view->ajax = $ajax;
    $this->view->users = $paginator;
    $this->view->totalUsers = $paginator->getTotalItemCount();
    $this->view->userCount = $paginator->getCurrentItemCount();

    return true;
  }
}