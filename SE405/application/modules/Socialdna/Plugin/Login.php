<?php
class Socialdna_Plugin_Login extends Zend_Controller_Plugin_Abstract
{

  public function preDispatch(Zend_Controller_Request_Abstract $request) {
    
    // @tbd - do it via actionhelper and just replace view script?
    // catch signup, but only for the first form
    if(Semods_Utils::getSetting('socialdna_signup_page_hook', 1) == 1) {
      if( ( $request->getControllerName() == 'signup' ) && ( $request->getModuleName() == 'user' ) && ( $request->getActionName() == 'index' ) ) {
        
        $session = new Zend_Session_Namespace("User_Plugin_Signup_Account");
        if(!isset($session->active) || ($session->active == true)) {
          $request->setModuleName('socialdna');
        }
        
      }
    }

   
    
    if(Semods_Utils::getSetting('socialdna_login_page_hook', 1) == 1) {

      if($request->get('format') == 'smoothbox') {
        return;
      }

      // catch Core_ErrorController
      if( ( $request->getControllerName() == 'error' ) && ( $request->getModuleName() == 'core' ) && ( $request->getActionName() == 'requireuser' ) ) {
        $format = $request->get('format');
  
        $session = new Zend_Session_Namespace('socialdna_auth');
        $session->return_url = Zend_Controller_Front::getInstance()->getRouter()->assemble(array());
        $session->require_auth = true;
  
        $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
        $url = $redirector->getFrontController()->getRouter()->assemble(array('module' => 'socialdna', 'controller' => 'auth', 'action' => 'login', 'format' => $format ), 'default', true);
        $redirector->gotoUrlAndExit($url, array('prependBase' => false) );
        //$redirector->gotoSimple('login','','', array('format' => $format) );
      }
    
    }
    
    

/*
    if($request->get('format') == 'smoothbox') {
      
      $openidconnect_facebook_api_key = Semods_Utils::getSetting('socialdna.facebook_api_key');
      $openidconnect_facebookemail = (int)Semods_Utils::getSetting('socialdna.openidconnect_facebookemail',1);
      $facebook_locale = Semods_Utils::getSetting('socialdna.facebook_locale','en_US');
      
      if(!empty($openidconnect_facebook_api_key)) {

        $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
      
        $script = <<< EOC

var openidconnect_primary_network = 'facebook';

var openidconnect_facebook_api_key = "{$openidconnect_facebook_api_key}";
var openidconnect_facebook_user_id = "0";

//var openidconnect_autologin_url = "";
//var openidconnect_logout_url = "";
//var openidconnect_relay_url = "";
var openidconnect_fbe = "{$openidconnect_facebookemail}";

en4.core.setBaseUrl('{$redirector->getFrontController()->getRouter()->assemble(array(), 'default', true)}');

var fbHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://static.ak.");
document.write(unescape("%3Cscript src='" + fbHost + "connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/{$facebook_locale}' type='text/javascript'%3E%3C/script%3E"));

window.setTimeout(function() {
var fbHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://static.ak.");
var x = document.createElement('script');
x.type = 'text/javascript';
x.src = fbHost + "connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/{$facebook_locale}";
document.body.appendChild(x);
}, 10);

EOC;

        $secure = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 1 : 0;
        $fbHost = $secure ? 'https://ssl.' : 'http://static.ak.';
        
        $headScript = new Zend_View_Helper_HeadScript();
        //$headScript->appendFile( $fbHost . 'connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/' . $facebook_locale);
        $headScript->appendScript($script);
      }
                              
    }
*/
    
  }

}
?>
