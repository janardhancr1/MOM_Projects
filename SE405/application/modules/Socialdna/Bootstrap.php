<?php
/**
 * SocialEngineMods
 *
 * @category   Application_Extensions
 * @package    Socialdns
 * @copyright  Copyright 2006-2010 SocialEngineMods
 * @license    http://www.socialenginemods.net/license/
 */
class Socialdna_Bootstrap extends Engine_Application_Bootstrap_Abstract
{

  public function __construct($application) {
    
    parent::__construct($application);
    
    $frontController = Zend_Controller_Front::getInstance();
    
    $frontController->registerPlugin( new Socialdna_Plugin_Login() );

    
    // this is only needed for quicksignup - only add in that controller
    // Add our special path for action helpers
    $this->initActionHelperPath();
    
    $router = $frontController->getRouter();
    
    if(Semods_Utils::getSetting('socialdna_login_page_hook', 1) == 1) {

      $routes = array(
          'user_login' => array(
            'type' => 'Zend_Controller_Router_Route_Static',
            'route' => '/login',
            'defaults' => array(
              'module' => 'socialdna',
              'controller' => 'auth',
              'action' => 'login'
            )
          ),
        );

      $router->addConfig(new Zend_Config($routes));
      
    }
    


    $headScript = new Zend_View_Helper_HeadScript();
    $headScript->appendFile('/application/modules/Socialdna/externals/scripts/socialdna.js');
    $headScript->appendFile('/application/modules/Socialdna/externals/scripts/moofacebox/moofacebox.js');

    $headLink = new Zend_View_Helper_HeadLink();
    
    // @tbd add to external lib for auto css scan
    $headLink->prependStylesheet('/application/modules/Socialdna/externals/scripts/moofacebox/moofacebox.css');
    
    $uri = Semods_Utils::g($_SERVER, 'REQUEST_URI','');
    if((strpos($uri,'lite.php') == null) && (strpos($uri,'comet.php') == null) && (strpos($uri,'mobile.php') == null) && (strpos($uri,'cometchat') == null)) {
      file_put_contents( APPLICATION_PATH_TMP . DIRECTORY_SEPARATOR . '__baseurl__.php', '<?php $base_url = \'' . $frontController->getBaseUrl() . '\'; ?>' );
    }
    
  }
  
}