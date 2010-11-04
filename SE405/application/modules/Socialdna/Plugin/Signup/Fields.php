<?php

class Socialdna_Plugin_Signup_Fields extends Core_Plugin_FormSequence_Abstract
{
  protected $_name = 'fields';

  protected $_title = 'Profile Information';

  protected $_formClass = 'User_Form_Signup_Fields';

  protected $_script = array('signup/form/fields.tpl', 'user');

  protected $_adminFormClass = 'User_Form_Admin_Signup_Fields';

  protected $_adminScript = array('admin-signup/fields.tpl', 'user');

  public function getForm()
  {
    
    if( is_null($this->_form) )
    {
      $formArgs = array();

      // Preload profile type field stuff
      $profileTypeField = $this->getProfileTypeField();

      if( $profileTypeField ) {

        $accountSession = new Zend_Session_Namespace('Socialdna_Plugin_Signup_Account');

        $profileTypeValue = @$accountSession->data['profile_type'];
        if( $profileTypeValue ) {
          $formArgs = array(
            'topLevelId' => $profileTypeField->field_id,
            'topLevelValue' => $profileTypeValue,
          );
        }
      }
      

      // Create form
      Engine_Loader::loadClass($this->_formClass);
      $class = $this->_formClass;
      $this->_form = new $class($formArgs);
      $data = $this->getSession()->data;

      if( !empty($data) )
      {
        foreach( $data as $key => $val )
        {
          $el = $this->_form->getElement($key);
          if( $el )
          {
            $el->setValue($val);
          }
        }
      }

      // show only requested fields
      $fields_ignore = array('submit');
      
      $fields = Engine_Api::_()->getDbTable('settings','socialdna')->getSetting('socialdna.signup_required_fields');
      $fields = explode(',', $fields);
      
      foreach($this->_form->getElements() as $key => $val) {
        if(!in_array($key, $fields) && !in_array($key, $fields_ignore)) {
          $this->_form->removeElement($key);
        }
      }
      
      // Setup required fields for Fields_Form_Standard::isValid satisfaction
      foreach($this->_form->getElements() as $key => $element) {
        if($element->isRequired() && !isset($_POST[$key])) {
          $_POST[$key] = '';
        }
      }
    }

    return $this->_form;
  }




  public function getFullForm()
  {
    
    {
      $formArgs = array();

      // Preload profile type field stuff
      $profileTypeField = $this->getProfileTypeField();

      if( $profileTypeField ) {

        $accountSession = new Zend_Session_Namespace('Socialdna_Plugin_Signup_Account');

        $profileTypeValue = @$accountSession->data['profile_type'];
        if( $profileTypeValue ) {
          $formArgs = array(
            'topLevelId' => $profileTypeField->field_id,
            'topLevelValue' => $profileTypeValue,
          );
        }
      }

      // Create form
      Engine_Loader::loadClass($this->_formClass);
      $class = $this->_formClass;

      $_form = new $class($formArgs);
      $data = $this->getSession()->data;

      if( !empty($data) )
      {
        foreach( $data as $key => $val )
        {
          //$el = $this->_form->getElement($key);
          $el = $_form->getElement($key);
          if( $el )
          {
            $el->setValue($val);
          }
        }
      }
      
    }

    return $_form;
  }

  public function onView()
  {
  }
  
  public function onSubmit(Zend_Controller_Request_Abstract $request)
  {

    // Form was valid
    if( $this->getForm()->isValid($request->getPost()) )
    {

      $this->getSession()->data = $this->getForm()->getProcessedValues();
      $this->getSession()->active = false;
      $this->onSubmitIsValid();
      return true;
    }

    // Form was not valid
    else
    {
      //echo "form is invalid";exit;
      $this->getSession()->active = true;
      $this->onSubmitNotIsValid();
      return false;
    }
  }



  
  public function onSubmitNotIsValid() {

  
    // if just landed and got errors - clear them
    $session = $this->getSession(); //new Zend_Session_Namespace('Socialdna_Signup');

    // not first landing ?
    if(isset($session->landing)) {
      return;
    }
    
    $session->landing = 1;

    // hide errors
    $this->_form->removeDecorator('FormErrors');
    
  }



  
  public function onProcess()
  {
    $viewer = Engine_Api::_()->user()->getViewer();
    // Get the newly created viewer

    // Preload profile type field stuff
    $profileTypeField = $this->getProfileTypeField();
    if( $profileTypeField ) {

      $accountSession = new Zend_Session_Namespace('Socialdna_Plugin_Signup_Account');
      $profileTypeValue = @$accountSession->data['profile_type'];
      if( $profileTypeValue ) {
        $values = Engine_Api::_()->fields()->getFieldsValues($viewer);
        $valueRow = $values->createRow();
        $valueRow->field_id = $profileTypeField->field_id;
        $valueRow->item_id = $viewer->getIdentity();
        $valueRow->value = $profileTypeValue;
        $valueRow->save();
      }
    }

    $form = $this->getFullForm()->setItem($viewer);
    $form->setProcessedValues($this->getSession()->data);

    // add custom fields which are available but were not displayed during signup
    //$data = $this->getSession()->data;
    
    $mapdata = array();

    $service = Engine_Api::_()->getApi('core', 'socialdna');
    $service->mapCustomOpenidFields($mapdata, true, true);

    if( !empty($mapdata) )
    {
      foreach( $mapdata as $key => $val )
      {
        $el = $form->getElement($key);
        if( $el && is_null($el->getValue()) && ($val !== ''))
        {
          $el->setValue($val);
        }
      }
    }
    
    $form->saveValues();

    $aliasValues = Engine_Api::_()->fields()->getFieldsValuesByAlias($viewer);
    $viewer->setDisplayName($aliasValues);
    $viewer->save();
  }

  public function getProfileTypeField() {
    $topStructure = Engine_Api::_()->fields()->getFieldStructureTop('user');
    if( count($topStructure) == 1 && $topStructure[0]->getChild()->type == 'profile_type' ) {
      return $topStructure[0]->getChild();
    }
    return null;
  }
}


