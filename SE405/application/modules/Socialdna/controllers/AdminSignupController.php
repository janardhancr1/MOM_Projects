<?php

class Socialdna_AdminSignupController extends Core_Controller_Action_Admin
{

  public function indexAction()
  {
    
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_admin_main', array(), 'socialdna_admin_main_signup');

    $service_name = 'facebook';
    $service = Engine_Api::_()->getApi('core', 'socialdna');

    if($this->getRequest()->isPost()) {

      $openid_signup_required_fields = $this->getRequest()->get('openid_signup_required_fields');
      $openid_signup_required_fields = implode(',',$openid_signup_required_fields);
      
      $openid_signup_profilecat_default = $this->getRequest()->get('openid_signup_profilecat_default');
      
      Semods_Utils::setSetting('socialdna.signup_profilecat_default',$openid_signup_profilecat_default);
      
      Engine_Api::_()->getDbTable('settings','socialdna')->setSetting('socialdna.signup_required_fields',$openid_signup_required_fields);


      /* FIELDS MAPPING */
    
      $openid_fieldmap = $this->getRequest()->get('openid_fieldmap');

      // clean all
      $table = Engine_Api::_()->getDbTable('fieldmap','socialdna');
      
      $table->delete('1=1');
      
      foreach($openid_fieldmap as $fieldmap_key => $fieldmap_value) {

        // remove relation
        if($fieldmap_value == "") {

        } else {

          $table->insert(array('openidfieldmap_name'  => $fieldmap_value,
                           'openidfieldmap_field_key' => $fieldmap_key
                           ) );
          
        }
      }


        return $this->_helper->_redirector->gotoRoute(array('module' => 'socialdna', 'controller' => 'signup', 'success' => '1'), 'admin_default', true);
      
    }

      



    $fields_remap_ = $service->getFieldMap();
    
    $fields_remap = array();
      
    foreach($fields_remap_ as $field_remap) {
      $fields_remap[$field_remap['openidfieldmap_field_key']] = $field_remap;
    }
    
    
    $openid_imported_fields = Engine_Api::_()->getDbTable('settings','socialdna')->getSetting('socialdna.openid_imported_fields');      ;

    $openid_imported_fields = explode(',', $openid_imported_fields);
    sort($openid_imported_fields);

    $openid_signup_required_fields = Engine_Api::_()->getDbTable('settings','socialdna')->getSetting('socialdna.signup_required_fields');
    $openid_signup_required_fields = explode(',',$openid_signup_required_fields);

                
    $this->view->fields = $this->getFieldStructure();
    $this->view->topLevelOptions = $this->topLevelOptions;
    
    $this->view->openid_signup_profilecat_default = Semods_Utils::getSetting('socialdna.signup_profilecat_default',1);

    $this->view->openid_signup_timezone = intval(in_array("timezone",$openid_signup_required_fields));
    $this->view->openid_signup_birthday = intval(in_array("birthday",$openid_signup_required_fields));    
    $this->view->openid_signup_required_fields = $openid_signup_required_fields;    
    $this->view->fields_remap = $fields_remap;
    $this->view->openid_imported_fields = $openid_imported_fields;
    
    $this->view->success = $this->getRequest()->get('success');

  }
  







  public function getFieldStructure() {
    
    $fieldType = 'user';

    $mapData = Engine_Api::_()->getApi('core', 'fields')->getFieldsMaps($fieldType);
    $optionsData = Engine_Api::_()->getApi('core', 'fields')->getFieldsOptions($fieldType);

    // Get top level fields
    $topLevelMaps = $mapData->getRowsMatching(array('field_id' => 0, 'option_id' => 0));
    $topLevelFields = array();
    foreach( $topLevelMaps as $map ) {
      $field = $map->getChild();
      $topLevelFields[$field->field_id] = $field;
    }

    // Get top level field
    // Only allow one top level field
    if( count($topLevelFields) > 1 ) {
      throw new Engine_Exception('Only one top level field is currently allowed');
    }

    $topLevelField = array_shift($topLevelFields);

    // Only allow the "profile_type" field to be a top level field (for now)
    if( $topLevelField->type !== 'profile_type' ) {
      throw new Engine_Exception('Only profile_type can be a top level field');
    }

    // Get top level options
    $topLevelOptions = array();
    foreach( $optionsData->getRowsMatching('field_id', $topLevelField->field_id) as $option ) {
      $topLevelOptions[$option->option_id] = $option->label;
    }
    
    $this->topLevelOptions = $topLevelOptions;
    
    
    $fields = array();


    foreach($topLevelOptions as $key => $val) {

      $subfields = array();

      $secondLevelMaps = array();
      $secondLevelFields = array();

      $secondLevelMaps = $mapData->getRowsMatching('option_id', $key);
      if( !empty($secondLevelMaps) ) {
        foreach( $secondLevelMaps as $map ) {

          $field = $map->getChild();
          
          if(!$field) {
            continue;
          }

          $subfields[] = array('heading' => $field->isHeading(),
                               'key'     => $map->getKey(),
                               'label'   => $field->label
                              );
          
        }
      }


        

        
        $fields[] = array('label'   => $val,
                          'fields' => $subfields
                           );
        

    }
      
      return $fields;
      
  }


}