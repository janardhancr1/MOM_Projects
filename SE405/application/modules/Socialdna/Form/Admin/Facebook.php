<?php

class Socialdna_Form_Admin_Facebook extends Engine_Form
{
  public $saved_successfully = FALSE;

  public function init()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');
    
    $this
      ->setTitle('Facebook Settings')
      ->setDescription('General Facebook Settings.');


    $this->addElement('Text', 'api_key', array(
      'label' => 'Facebook API Key',
      'description' => 'Please enter Facebook Api Key that you have received after creating a Facebook application for your website - should be a string 32 characters long consisting of letters and numbers. For application setup please see Help Tab.',
      'value' => Semods_Utils::getSetting('socialdna.facebook_api_key',''),
    ));
    $this->api_key->getDecorator('Description')->setOption('placement', 'append');
    $this->api_key->setAttrib('style', 'width:250px');

    $this->addElement('Text', 'secret', array(
      'label' => 'API Secret',
      'description' => 'Please enter Facebook Secret that you have received after creating a Facebook application for your website - should be a string 32 characters long consisting of letters and numbers. For application setup please see Help Tab.',
      'value' => Semods_Utils::getSetting('socialdna.facebook_secret','')
    ));
    $this->secret->getDecorator('Description')->setOption('placement', 'append');
    $this->secret->setAttrib('style', 'width:250px');


    $this->addElement('Radio', 'autologin', array(
      'label' => 'Autologin',
      'description' => 'Autologin allow users of your website to automatically login to your site whenever they are also logged in to Facebook ( users that have connected their accounts to Facebook ). According to Facebook internal study, about 80% of all Facebook users always stay logged in.',
      'multiOptions' => array(
        1 => 'Yes',
        0 => 'No',
      ),
      'value' => Semods_Utils::getSetting('socialdna.autologin',0)
    ));


    $this->addElement('Radio', 'redirect_after_openid_signup', array(
      'label' => 'Redirect to invite page?',
      'description' => 'Select whether you would like to redirect the users to the invitation page after signing up. ',
      'multiOptions' => array(
        1 => 'Redirect to the invitation page',
        0 => 'Redirect to member home (default)',
      ),
      'value' => Semods_Utils::getSetting('socialdna.redirect_after_openid_signup',1)
    ));


    $this->addElement('Radio', 'hook_logout', array(
      'label' => 'Enable Logout link hook?',
      'description' => 'Logout link hook - According to Facebook TOS, users logging out of your network should also logout from Facebook. This feature will try to take over the Logout link located on the Top Bar. If you have a customized template you can disable this feature and add the link by yourself. Please consult your template designer. Would you like to enable Logout link hook? ',
      'multiOptions' => array(
        1 => 'Yes, enable logout link hook',
        0 => 'No, disable logout link hook',
      ),
      'value' => Semods_Utils::getSetting('socialdna.hook_logout',1)
    ));


    $facebook_locale = array('en_US'  => 'English (US)',
                             'ar_AR' => 'Arabic',
                             'zh_CN' => 'Chinese (Simplified)',
                             'da_DK' => 'Danish - Dansk',
                             'nl_NL' => 'Dutch - Nederlands',
                             'fr_FR' => 'French (France)',
                             'de_DE' => 'German',
                             'el_GR' => 'Greek',
                             'it_IT' => 'Italian',
                             'pt_BR' => 'Portuguese (Brazil)',
                             'pt_PT' => 'Portuguese (Portugal)',
                             'ru_RU' => 'Russian',
                             'es_LA' => 'Spanish',
                             'es_ES' => 'Spanish (Spain)',
                             );
    
    $this->addElement('Select', 'facebook_locale', array(
      'label' => 'Facebook Language / Localization ',
      'description' => 'Please select the localization - Facebook dialogs language ',
      'multiOptions' => $facebook_locale,
      'value' => Semods_Utils::getSetting('socialdna.facebook_locale','en_US')
    ));

    $this->addElement('Text', 'facebook_inviteactiontext', array(
      'label' => 'Invitation Action text',
      'description' => 'Invitation Action text - This will be the message displayed to the inviting user encouraging him to invite his friends.',
      'value' => Semods_Utils::getSetting('socialdna.facebook_inviteactiontext','')
    ));

    $this->addElement('Textarea', 'facebook_invitemessage', array(
      'label' => 'Invitation message',
      'description' => 'Available Variables: ................................................................ [full_name] - Inviting user name ................................................ [site_name] - Public site name ................................................ [signup_link] - Invitation signup link with referrer ................ ***NOTE***: The following text MUST be present in the invitation message - "<fb:req-choice url=\'[signup_link]\' label=\'Register\'/>',
      'value' => Engine_Api::_()->getDbTable('settings','socialdna')->getSetting('socialdna.facebook_invitemessage','')
    ));
    $this->facebook_invitemessage->getDecorator('Description')->setOption('placement', 'append');


    // Add submit button
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true,
    ));
    
  }
  
  
  public function saveAdminSettings()
  {
    
    $values = $this->getValues();
    
    $value = $this->getElement('api_key')->getValue();
    if(!preg_match('/^[A-Fa-f0-9]{32}$/',$value)) {
      $this->addError('100010334');
      return false;
    }

    $value = $this->getElement('secret')->getValue();
    if(!preg_match('/^[A-Fa-f0-9]{32}$/',$value)) {
      $this->addError('100010335');
      return false;
    }
    
    Semods_Utils::setSetting('socialdna.autologin', (int)$values['autologin']);
    
    Semods_Utils::setSetting('socialdna.redirect_after_openid_signup', (int)$values['redirect_after_openid_signup']);

    Semods_Utils::setSetting('socialdna.hook_logout', (int)$values['hook_logout']);

    Semods_Utils::setSetting('socialdna.facebook_locale', $values['facebook_locale']);
    

    Semods_Utils::setSetting('socialdna.facebook_inviteactiontext', $values['facebook_inviteactiontext']);
    

    Engine_Api::_()->getDbTable('settings','socialdna')->setSetting('socialdna.facebook_invitemessage',$values['facebook_invitemessage']);



    // Talk to FB
    
    $service = Engine_Api::_()->getApi('core','socialdna');

    $openid_client = new openidfacebook($values['api_key'], $values['secret']);

    $response = $openid_client->verify_api_keys();

    if($response === false) {
      $this->addError('There was an error communicating with Facebook. Please make sure your API Key and Secret are correct. Facebook said: ' . $openid_client->error_message);
      return false;
    }



    /*** App properties ***/


    $openid_facebook = $openid_client->api_client();

    // no need for session key
    $openid_facebook_session_key = $openid_facebook->api_client->session_key;
    $openid_facebook->api_client->session_key = null;

    try {

      $openid_facebook->api_client->admin_setAppProperties( array(//'uninstall_url' => 'remove?openidservice=facebook',
                                                                  'base_domain'   => openidconnect_get_simple_cookie_domain(),
                                                                  //'email_domain'  => openidconnect_get_simple_cookie_domain(),
                                                                  'connect_url'   => openidconnect_get_base_url(),
                                                                  //'callback_url'  => 'socialdna/login?openidservice=facebook',
                                                                  )
                                                           );

      //$openid_facebook->api_client->admin_getAppProperties( array('app_id') );

    } catch (Exception $ex) {

    }


    Semods_Utils::setSetting('socialdna.facebook_api_key', $values['api_key']);
    Semods_Utils::setSetting('socialdna.facebook_secret', $values['secret']);

    // update SE settings
    Semods_Utils::setSetting('core.facebook.key', $values['api_key']);
    Semods_Utils::setSetting('core.facebook.secret', $values['secret']);
    

    // update App data
    
    // FB API 
    
    if(($values['api_key'] != '') && (Semods_Utils::getSetting('socialdna.openidconnect_api_key','') != '')) {
      $publisherapi = $service->getPublisherapi();
      $result = $publisherapi->set_application_settings(1, $values['api_key'], $values['secret']);
      Engine_Api::_()->getDbTable('services','socialdna')->update(array('openidservice_branding_key' => $values['api_key'], 'openidservice_branding_secret' => $values['secret']), "openidservice_id = 1");
    }

    
    $this->saved_successfully = true;
    
    $this->addNotice('Settings were successfully saved.');

  }
  
}