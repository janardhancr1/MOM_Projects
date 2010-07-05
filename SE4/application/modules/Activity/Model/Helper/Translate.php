<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Translate.php 6505 2010-06-22 23:27:39Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Activity_Model_Helper_Translate extends Activity_Model_Helper_Abstract
{
  /**
   *
   * @param string $value
   * @return string
   */
  public function direct($value)
  {
    $translate = Zend_Registry::get('Zend_Translate');
    if( $translate instanceof Zend_Translate ) {
      //var_dump($value);
      $tmp = $translate->translate($value);
      //var_dump($tmp);
      return $tmp;
    } else {
      return $value;
    }
  }
}