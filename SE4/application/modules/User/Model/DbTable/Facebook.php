<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Facebook.php 6173 2010-06-07 23:03:13Z steve $
 * @author     Steve
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class User_Model_DbTable_Facebook extends Engine_Db_Table
{
  public static function getFBInstance()
  {
    $fb_appid  = Engine_Api::_()->getApi('settings', 'core')->core_facebook_appid;
    $fb_secret = Engine_Api::_()->getApi('settings', 'core')->core_facebook_secret;
    try {
      return Zend_Registry::get('Facebook_Api');
    } catch (Exception $e) {
      $facebook = new Facebook_Api(array(
        'appId'  => $fb_appid,
        'secret' => $fb_secret,
        'cookie' => true,
      ));
      Zend_Registry::set('Facebook_Api', $facebook);
      return $facebook;
    }
  }
  /**
   * Generates the button used for Facebook Connect
   *
   * @param mixed $fb_params A string or array of Facebook parameters for login
   * @param string $connect_with_facebook The string to display inside the button
   * @return String Generates HTML code for facebook login button
   */
  public static function loginButton($connect_with_facebook = 'Connect with Facebook', $prevent_reload = false)
  {
    $settings  = Engine_Api::_()->getApi('settings', 'core');
    $facebook  = self::getFBInstance();

    $fb_params = array();
    switch ($settings->core_facebook_enable) {
      case 'login':
        $fb_params['req_perms'] = 'email,user_birthday,offline_access,publish_stream';
        //$fb_params[] = 'user_birthday';
        //$fb_params[] = 'offline_access';
        //$fb_params[] = 'publish_stream';
        break;
      case 'publish':
        $fb_params[] = 'email';
        $fb_params[] = 'user_birthday';
        $fb_params[] = 'user_status';
        $fb_params[] = 'publish_stream';
        break;
      case 'none':
      default:
        return;

    }

    return '
      <div id="fb-root"></div>
      <script type="text/javascript">
      //<![CDATA[
        (function(){
          var e = document.createElement("script"); 
              e.async = true;
              e.src = document.location.protocol + "//connect.facebook.net/'.Zend_Locale::findLocale().'/all.js";
          document.getElementById("fb-root").appendChild(e);
        }());
        window.fbAsyncInit = function() {
          FB.init({
            appId: '.$settings->core_facebook_appid.',
            status: true,
            cookie: true,
            xfbml: true
          });
          FB.Event.subscribe(\'auth.sessionChange\', function(response) {
            if (response.session) {
            '.($prevent_reload?'':'window.location = "index.php/facebooksignup";').'
            }
            }); };
          (function() {
            var e = document.createElement("script"); e.async = true; e.src = document.location.protocol + "//connect.facebook.net/'.Zend_Locale::findLocale().'/all.js";
            document.getElementById("fb-root").appendChild(e);
          }());
      //]]>
      </script>
      <!--<a href="'.$facebook->getLoginUrl($fb_params).'" target="_blank" onclick="FB.login();return false;"><img src="http://static.ak.fbcdn.net/rsrc.php/z38X1/hash/6ad3z8m6.gif" border="0" alt="'.$connect_with_facebook.'" /></a>-->
      <fb:login-button perms="email,user_birthday"></fb:login-button>
      
      ';
  }
}
