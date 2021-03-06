<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Package
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Remove.php 6317 2010-06-12 06:10:30Z john $
 * @author     John Boehr <j@webligo.com>
 */

/**
 * @category   Engine
 * @package    Engine_Package
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John Boehr <j@webligo.com>
 */
class Engine_Package_Manager_Operation_Remove
  extends Engine_Package_Manager_Operation_Abstract
{
  public function getSourcePackage()
  {
    return $this->getPackage();
  }
  
  public function getResultantPackage()
  {
    return null;
  }

  public function doInstall()
  {

  }
}