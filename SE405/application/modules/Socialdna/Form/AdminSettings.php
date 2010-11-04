<?php

class Socialdna_Form_AdminSettings extends Engine_Form
{
  public $saved_successfully = FALSE;

  public function init()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');
    
    $this
      ->setTitle('Global Settings')
      ->setDescription('Global Social DNA Settings.');


    $this->addElement('Text', 'api_key', array(
      'label' => 'API Key',
      'description' => 'Please find this parameter in the client area.',
      'value' => $settings->getSetting('socialdna.openidconnect.api_key', ''),
    ));
    $this->api_key->getDecorator('Description')->setOption('placement', 'append');
    $this->api_key->setAttrib('style', 'width:250px');

    $this->addElement('Text', 'secret', array(
      'label' => 'API Secret',
      'description' => 'Please find this parameter in the client area.',
      'value' => $settings->getSetting('socialdna.openidconnect.secret', '')
    ));
    $this->secret->getDecorator('Description')->setOption('placement', 'append');
    $this->secret->setAttrib('style', 'width:250px');

    $this->addElement('Text', 'rpurl', array(
      'label' => 'Relaying URL',
      'description' => "Please find this parameter in the client area. The Relaying URL will look like yoursitename.openidgo.com",
      'value' => $settings->getSetting('socialdna.openidconnect.rpurl', '')
    ));
    $this->rpurl->getDecorator('Description')->setOption('placement', 'append');
    $this->rpurl->setAttrib('style', 'width:250px');


    $this->addElement('Radio', 'login_page_hook', array(
      'label' => 'Replace Login page?',
      'description' => 'Your login page can be automatically replaced with the attached social icons. Select no if you have customized the login page and plan to add the icons manually.',
      'multiOptions' => array(
        1 => 'Yes, auto-replace the login page.',
        0 => 'No, do not replace the login page.',
      ),
      'value' => Semods_Utils::getSetting('socialdna_login_page_hook', 1)
    ));

    $this->addElement('Radio', 'signup_page_hook', array(
      'label' => 'Replace Signup page?',
      'description' => 'Your signup page can be automatically replaced with the attached social icons. Select no if you have customized the signup page and plan to add the icons manually.',
      'multiOptions' => array(
        1 => 'Yes, auto-replace the signup page.',
        0 => 'No, do not replace the signup page.',
      ),
      'value' => Semods_Utils::getSetting('socialdna_signup_page_hook', 1)
    ));


    // Add submit button
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true,
    ));
    
  }
  
  
  public function saveAdminSettings()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');
    
    $value = $this->getElement('api_key')->getValue();
    if(!preg_match('/^[A-Fa-f0-9]{32}$/',$value)) {
      $this->addError('100010334');
      return false;
    }
    $settings->setSetting('socialdna.openidconnect.api_key', $value);

    $value = $this->getElement('secret')->getValue();
    if(!preg_match('/^[A-Fa-f0-9]{32}$/',$value)) {
      $this->addError('100010335');
      return false;
    }
    $settings->setSetting('socialdna.openidconnect.secret', $value);

    Semods_Utils::setSetting('socialdna_signup_page_hook', (int)$this->getElement('signup_page_hook')->getValue());
    Semods_Utils::setSetting('socialdna_login_page_hook', (int)$this->getElement('login_page_hook')->getValue());
    
    Semods_Utils::setSetting('socialdna.openidconnect.rpurl', $this->getElement('rpurl')->getValue());

    // FB API 

    $setting_openidconnect_facebook_api_key = Semods_Utils::getSetting('socialdna.facebook_api_key','');
    $setting_openidconnect_facebook_secret = Semods_Utils::getSetting('socialdna.facebook_secret','');
    
    
    if($setting_openidconnect_facebook_api_key != '') {
      $publisherapi = Engine_Api::_()->getApi('core', 'socialdna')->getPublisherapi();
      $result = $publisherapi->set_application_settings(1, $setting_openidconnect_facebook_api_key, $setting_openidconnect_facebook_secret);

      Engine_Api::_()->getDbTable('services','socialdna')
            ->update(array('openidservice_branding_key'     => $setting_openidconnect_facebook_api_key,
                           'openidservice_branding_secret'  => $setting_openidconnect_facebook_secret),
                     array( "openidservice_id = ?" => 1));

    }

    
    $this->saved_successfully = true;

    $this->addNotice('Settings were successfully saved.');

  }
  


  
}