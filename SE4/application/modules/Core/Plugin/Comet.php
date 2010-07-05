<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Comet.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Plugin_Comet implements Engine_Comet_Handler_Interface
{
  protected $_comet;

  protected $_name = 'core';

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
    return array(
      'time' => time()
    );
  }

  public function onApplicationModeComet(Engine_Hooks_Event $event)
  {
    $event->addResponse($this);
  }
}