<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Translate
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Interface.php 6072 2010-06-02 02:36:45Z john $
 * @author     John Boehr <j@webligo.com>
 */

/**
 * @category   Engine
 * @package    Engine_Translate
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John Boehr <j@webligo.com>
 */
interface Engine_Translate_Writer_Interface
{
  public function getTranslation($key);

  public function getTranslations($key = null);

  public function removeTranslation($key);

  public function setTranslation($key, $value);

  public function setTranslations(array $data);
}