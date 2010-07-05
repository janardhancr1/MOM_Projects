<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Comet
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Interface.php 2739 2010-01-16 11:53:01Z john $
 */

/**
 * @category   Engine
 * @package    Engine_Comet
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
interface Engine_Comet_Handler_Interface
{
  /**
   * Get the name of this handler
   *
   * @return string
   */
  public function getName();

  /**
   * Set the comet instance
   * 
   * @param Engine_Comet $comet
   */
  public function setComet(Engine_Comet $comet);

  /**
   * Get the comet instance
   *
   * @return Engine_Comet
   */
  public function getComet();

  /**
   * Do the dirty work
   *
   * @return mixed Data to send
   */
  public function runComet();
}