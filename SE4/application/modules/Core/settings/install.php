<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: install.php 6684 2010-07-02 00:57:13Z john $
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Install extends Engine_Package_Installer_Module
{
  protected function _runCustomQueries()
  {
    $i = 0;
    
    // Hack to add 4.0.0rc1 -> 4.0.0rc2 during 4.0.0rc2 -> 4.0.0
    $db = $this->getDb();
    $cols = $db->query('SHOW COLUMNS FROM `engine4_core_tasks` LIKE \'success_last\'')->fetch();
    if( empty($cols) || empty($cols['Field']) ) {
      $contents = file_get_contents(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'my-upgrade-4.0.0rc1-4.0.0rc2.sql');
      foreach( Engine_Package_Utilities::sqlSplit($contents) as $sqlFragment ) {
        //try {
          $db->query($sqlFragment);
          $i++;
        //} catch( Exception $e ) {
        //  return $this->_error('Query failed with error: ' . $e->getMessage());
        //}
      }
    }

    return $i;
  }
}