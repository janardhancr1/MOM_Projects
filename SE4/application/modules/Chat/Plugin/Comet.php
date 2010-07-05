<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Chat
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Comet.php 6509 2010-06-22 23:49:13Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Chat
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Chat_Plugin_Comet implements Engine_Comet_Handler_Interface
{
  protected $_comet;

  protected $_name = 'chat';

  public function getName()
  {
    return $this->_name;
  }

  public function setComet(Engine_Comet $comet)
  {
    $this->_comet = $comet;
    return $this;
  }

  public function getComet()
  {
    if( null === $this->_comet )
    {
      throw new Activity_Model_Exception('No comet instance set');
    }

    return $this->_comet;
  }

  public function runComet()
  {
    /*
    return  array(
      'time' => time()
    );
     */
  }

  public function onApplicationModeComet(Engine_Hooks_Event $event)
  {
    $event->addResponse($this);
  }
}