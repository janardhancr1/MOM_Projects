<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Chat
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 6509 2010-06-22 23:49:13Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Chat
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Chat_Plugin_Core
{
  public function onRenderLayoutDefault($event)
  {
    // Arg should be an instance of Zend_View
    $view = $event->getPayload();
    $viewer = Engine_Api::_()->user()->getViewer();
    
    if( $view instanceof Zend_View && $viewer->getIdentity() ) {

      // Check if enabled
      $enabled = Engine_Api::_()->getApi('settings', 'core')->getSetting('chat.im.enabled', false);
      if( !$enabled ) {
        return;
      }
      
      $identity = sprintf('%d', $viewer->getIdentity());
      $delay = Engine_Api::_()->getApi('settings', 'core')->getSetting('chat.general.delay', '5000');
      
      $script = <<<EOF
  var chatHandler;
  en4.core.runonce.add(function() {
    try {
      chatHandler = new ChatHandler({
        'baseUrl' : en4.core.baseUrl,
        'basePath' : en4.core.basePath,
        'identity' : {$identity},
        'enableChat' : false,
        'delay' : {$delay}
      });

      chatHandler.start();
      window._chatHandler = chatHandler;
    } catch( e ) {
      //if( \$type(console) ) console.log(e);
    }
  });
EOF;
      
      $view->headScript()
        ->appendFile('application/modules/Chat/externals/scripts/core.js')
        ->appendScript($script);
    }
  }

  public function onRenderLayoutAdminDefault($event)
  {
    //return $this->onRenderLayoutDefault($event);
  }
}