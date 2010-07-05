<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Translate
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Ini.php 1995 2009-12-19 00:03:28Z john $
 * @todo       documentation
 */

/**
 * @category   Engine
 * @package    Engine_Translate
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Engine_Translate_Parser_Ini implements Engine_Translate_Parser_Interface
{
  public static function parse($file, array $options = array())
  {
    $data = array();
    if( !file_exists($file) )
    {
      require_once 'Zend/Translate/Exception.php';
      throw new Zend_Translate_Exception("Ini file '".$data."' not found");
    }

    return parse_ini_file($file, false);
  }
}