<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: BackupController.php 6641 2010-06-30 01:22:51Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class BackupController extends Zend_Controller_Action implements Engine_Observer_Interface
{
  protected $_export;

  public function init()
  {
    // Check if already logged in
    if( !Zend_Registry::get('Zend_Auth')->getIdentity() ) {
      return $this->_helper->redirector->gotoRoute(array(), 'default', true);
    }
  }
  
  public function indexAction()
  {
    
  }

  public function createAction()
  {
    set_time_limit(600);
    
    include_once 'Archive/Tar.php';
    $archiveFileName = APPLICATION_PATH . '/temporary/backup/' . time() . '.tar';
    $archiveSoucePath = APPLICATION_PATH;

    $archive = new Archive_Tar($archiveFileName);
    
    // Add files
    $path = APPLICATION_PATH;
    $tmpPath = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'temporary';
    $files = array();
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
    foreach( $it as $file ) {
      $pathname = $file->getPathname();
      if( $file->isFile() ) {
        if( substr($pathname, 0, strlen($tmpPath)) == $tmpPath ) {
          continue;
        } else {
          $files[] = $pathname;
        }
      }
    }
    $ret = $archive->addModify($files, '', $path);
    if( PEAR::isError($ret) ) {
      throw new Engine_Exception($ret->getMessage());
    }
    
    // Add temporary structure only
    /*
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($tmpPath), RecursiveIteratorIterator::SELF_FIRST);
    foreach( $it as $file ) {
      if( $file->isFile() ) {
        continue;
      } else {
        $path = str_replace(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'temporary' . DIRECTORY_SEPARATOR, '', $file->getPathname());
        $path .= DIRECTORY_SEPARATOR . 'index.html';
        $archive->addString($path, '');
      }
    }
     * 
     */
    
    // Export database
    $dbTempFile = $this->_createTemporaryFile();
    $db = Zend_Registry::get('Zend_Db');
    $export = Engine_Db_Export::factory($db, array(
      'listeners' => array($this),
    ));
    $this->_export = $export;
    $export->write($dbTempFile);
    unlink($dbTempFile);


  }

  public function downloadAction()
  {
    
  }

  public function restoreAction()
  {
    
  }

  public function deleteAction()
  {
    
  }

  protected function _createTemporaryFile()
  {
    $file = tempnam('/tmp', 'en4_install_backup');
    if( !$file ) {
      throw new Engine_Exception('Unable to create temp file');
    }
    return $file;
  }

  public function notify($event)
  {
    
  }
}