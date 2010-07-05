<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Comet.php 6505 2010-06-22 23:27:39Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Activity_Plugin_Comet implements Engine_Comet_Handler_Interface
{
  protected $_comet;

  protected $_name = 'activity';

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
    $viewer = Engine_Api::_()->user()->getViewer();
    if( $viewer->getIdentity() && Engine_Api::_()->getDbtable('notifications', 'activity')->checkNotifications($viewer) )
    {
      $count = Engine_Api::_()->getDbtable('notifications', 'activity')->hasNotifications($viewer);
      return array(
        'count' => $count,
        'text' => $count . ' updates',
      );
    }
    return false;
  }

  public function onApplicationModeComet(Engine_Hooks_Event $event)
  {
    $event->addResponse($this);
  }
}