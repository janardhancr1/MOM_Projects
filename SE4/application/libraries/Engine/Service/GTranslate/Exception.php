<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Service_GTranslate
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Exception.php 6072 2010-06-02 02:36:45Z john $
 * @author     John Boehr <j@webligo.com>
 */

/**
 * @category   Engine
 * @package    Engine_Service_GTranslate
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John Boehr <j@webligo.com>
 */
class Engine_Service_GTranslate_Exception extends Exception
{
  public function __construct($string) {
    parent::__construct($string, 0);
  }

  public function __toString() {
    return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
  }
}