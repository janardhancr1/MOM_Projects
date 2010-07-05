<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Observer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Interface.php 6513 2010-06-23 00:36:46Z john $
 * @author     John Boehr <j@webligo.com>
 */

/**
 * @category   Engine
 * @package    Engine_Observer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
interface Engine_Observer_Interface
{
  public function notify($event);
}