<?php

class Socialdna_AdminUsersController extends Core_Controller_Action_Admin
{
  public function indexAction()
  {

    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_admin_main', array(), 'socialdna_admin_main_users');

    $this->view->formFilter = $formFilter = new Socialdna_Form_Admin_Users_Filter();
    $page = $this->_getParam('page',1);

    $table = $this->_helper->api()->getDbtable('users', 'user');
    $userTableName = $table->info('name');

    $rTable = $this->_helper->api()->getDbtable('users', 'socialdna');
    $rName = $rTable->info('name');
    $sTable = $this->_helper->api()->getDbtable('services', 'socialdna');
    $sName = $sTable->info('name');    
    $select = $table->select()
      ->setIntegrityCheck(false)
      ->from($rTable)
      ->join($userTableName, "`{$userTableName}`.`user_id` = `{$rName}`.`openid_user_id`", '*')
      ->join($sName, "`{$rName}`.`openid_service_id` = `{$sName}`.`openidservice_id`", '*');
      
    // Process form
    $values = array();
    if( $formFilter->isValid($this->_getAllParams()) ) {
      $values = $formFilter->getValues();
    }

    foreach( $values as $key => $value ) {
      if( null === $value ) {
        unset($values[$key]);
      }
    }

    $values = array_merge(array(
      'order' => 'user_id',
      'order_direction' => 'DESC',
    ), $values);
    
    $this->view->assign($values);

    // Set up select info
    $select->order(( !empty($values['order']) ? $values['order'] : 'user_id' ) . ' ' . ( !empty($values['order_direction']) ? $values['order_direction'] : 'DESC' ));

    if( !empty($values['username']) )
    {
      $select->where('username LIKE ?', '%' . $values['username'] . '%');
    }

    if( !empty($values['email']) )
    {
      $select->where('email LIKE ?', '%' . $values['email'] . '%');
    }

    if( !empty($values['level_id']) )
    {
      $select->where('level_id = ?', $values['level_id'] );
    }
    
    if( isset($values['enabled']) && $values['enabled'] != -1 )
    {
      $select->where('enabled = ?', $values['enabled'] );
    }

    if( isset($values['network_id']) && !empty($values['network_id']) )
    {
      $select->where('openid_service_id = ?', $values['network_id'] );
    }
    
    // Make paginator
    $this->view->paginator = $paginator = Zend_Paginator::factory($select);
    $this->view->paginator = $paginator->setCurrentPageNumber( $page );


    $this->view->superAdminCount = count(Engine_Api::_()->user()->getSuperAdmins());
    $this->view->hideEmails = _ENGINE_ADMIN_NEUTER;
  }

}