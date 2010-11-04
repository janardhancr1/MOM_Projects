<?php

class Socialdna_Plugin_Signup_Photo extends Core_Plugin_FormSequence_Abstract
{
  protected $_name = 'account';

  protected $_title = 'Add Your Photo';

  protected $_formClass = 'Socialdna_Form_Dummy';
  

  protected $_script = array('signup/form/photo.tpl', 'user');

  protected $_adminFormClass = 'User_Form_Admin_Signup_Photo';

  protected $_adminScript = array('admin-signup/photo.tpl', 'user');

  protected $_skip;

  protected $_coordinates;

  
  public function onSubmit(Zend_Controller_Request_Abstract $request)
  {

    $this->setActive(false);
    $this->onSubmitIsValid();
    return true;
    
  }

  
  public function onProcess()
  {

    $service = Engine_Api::_()->getApi('core', 'socialdna');

    $viewer = Engine_Api::_()->user()->getViewer();
    
    try {

      $service->downloadProfilePhoto($viewer);
      
    } catch (Exception $ex) {
      
    }

  }

}