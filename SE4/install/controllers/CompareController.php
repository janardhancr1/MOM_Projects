<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: CompareController.php 6641 2010-06-30 01:22:51Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class CompareController extends Zend_Controller_Action
{
  /**
   * @var Engine_Package_Manager
   */
  protected $_packageManager;

  /**
   * @var Zend_Session_Namespace
   */
  protected $_session;
  
  public function init()
  {
    // Check if already logged in
    if( !Zend_Registry::get('Zend_Auth')->getIdentity() ) {
      return $this->_helper->redirector->gotoRoute(array(), 'default', true);
    }

    // Get manager
    $this->_packageManager = Zend_Registry::get('Engine_Package_Manager');

    // Get session
    $this->_session = new Zend_Session_Namespace('InstallCompareController');
  }

  public function indexAction()
  {
    $this->view->installedPackages = $this->_packageManager->listInstalledPackages();
  }

  public function installedAction()
  {
    $packages = $this->_getParam('packages');
    $installedPackages = $this->_packageManager->listInstalledPackages();

    $packageObjects = array();
    foreach( $installedPackages as $installedPackage ) {
      if( in_array($installedPackage->getKey(), $packages) ) {
        $packageObjects[] = $installedPackage;
      }
    }

    $leftFiles = array();
    $rightFiles = array();

    foreach( $packageObjects as $package ) {
      $tmpLeftFiles = array();
      $tmpRightFiles = array();
      foreach( $package->getFileStructure(true) as $i => $tmpRightFile ) {
        if( $tmpRightFile['dir'] ) continue;
        $tmpLeftFiles[] = APPLICATION_PATH . '/' . $i;

        $tmpRightFile['exists'] = true;
        $tmpRightFile['hash'] = $tmpRightFile['sha1'];
        $tmpRightFiles[] = $tmpRightFile;
      }
      $leftFiles = array_merge($leftFiles, $tmpLeftFiles);
      $rightFiles = array_merge($rightFiles, $tmpRightFiles);
    }

    $batch = new Engine_File_Diff_Batch($leftFiles, $rightFiles);
    $batch->execute();

    $this->view->diff = $batch;
    /*
    foreach( $packageObjects as $package ) {
      //$package = new Engine_Package_Manifest();
      $leftFiles = array();
      $rightFiles = $package->getFileStructure(true);

      foreach( $rightFiles as $i => $rightFile ) {
        $leftFiles[$i] = APPLICATION_PATH . '/' . $i;
      }

      $batch = new Engine_File_Diff_Batch($leftFiles, $rightFiles);
      $batch->execute();
      var_dump($batch);
      die();
    }
     * 
     */
  }

  public function uploadAction()
  {
    if( $this->_getParam('reset', false) ) {
      unset($this->_session->comparePath);
    }

    if( empty($this->_session->comparePath) ) {
      // Check request info
      if( !$this->getRequest()->isPost() ) return;
      if( empty($_FILES['Filedata']) ) return;

      // Get tmp folder
      $tmpFolder = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'en4icmp' . DIRECTORY_SEPARATOR;

      // Make tmp folder
      if( !is_dir($tmpFolder) && !mkdir($tmpFolder, 0777, true) ) {
        throw new Engine_Exception('Unable to make directory: ' . $tmpFolder);
      }

      // Check archive extension
      $packageFile = $_FILES['Filedata']['name'];
      $packageArchive = $tmpFolder . $packageFile;
      if( strtolower(substr($packageArchive, -4)) !== '.tar' ) {
        throw new Engine_Exception('Not a TAR archive: ' . $_FILES['Filedata']['name']);
      }

      // Try to remove if it already exists
      if( file_exists($packageArchive) && !unlink($packageArchive) ) {
        throw new Engine_Exception('Unable to remove: ' . $_FILES['Filedata']['name']);
      }

      // Move package archive
      if( !move_uploaded_file($_FILES['Filedata']['tmp_name'], $packageArchive) ) {
        throw new Engine_Exception('Unable to move uploaded file: ' . $packageArchive);
      }

      // Extract package archive
      $extractedPath = Engine_Package_Archive::inflate($packageArchive, $tmpFolder);

      $this->_session->comparePath = $extractedPath;
    } else {
      $extractedPath = $this->_session->comparePath;
    }
    
    // Diff
    $packageObject = new Engine_Package_Manifest($extractedPath);

    $leftFiles = array();
    $rightFiles = array();

    foreach( $packageObject->getFileStructure(true) as $key => $tmpRightFile ) {
      if( $tmpRightFile['dir'] ) continue;

      $leftFiles[] = APPLICATION_PATH . DIRECTORY_SEPARATOR . $key;

      $tmpRightFile['exists'] = true;
      $tmpRightFile['hash'] = $tmpRightFile['sha1'];
      $rightFiles[] = $tmpRightFile;
    }

    $batch = new Engine_File_Diff_Batch($leftFiles, $rightFiles);
    $batch->execute();

    $this->view->diff = $batch;
  }

  public function diffAction()
  {
    $this->view->layout()->hideIdentifiers = true;

    if( empty($this->_session->comparePath) ) {
      throw new Engine_Exception('no path to compare');
    }
    
    $extractedPath = $this->_session->comparePath;
    $packageObject = new Engine_Package_Manifest($extractedPath);
    
    $file = $this->_getParam('file');
    $sourceFile = $packageObject->getBasePath() . '/' . $packageObject->getPath() . '/' . $file;
    $targetFile = APPLICATION_PATH . '/' . $packageObject->getPath() . '/' . $file;

    include_once 'Text/Diff.php';
    include_once 'Text/Diff/Renderer.php';
    include_once 'Text/Diff/Renderer/context.php';
    include_once 'Text/Diff/Renderer/inline.php';
    include_once 'Text/Diff/Renderer/unified.php';

    $this->view->file = $targetFile;
    $this->view->textDiff = $textDiff = new Text_Diff('auto', array(file($sourceFile, FILE_IGNORE_NEW_LINES), file($targetFile, FILE_IGNORE_NEW_LINES)));
    return;
    var_dump('-------------------------------------');
    var_dump($textDiff->getDiff());
    var_dump('-------------------------------------');

    $textDiffRenderer = new Text_Diff_Renderer_context();
    var_dump($textDiffRenderer->render($textDiff));
    var_dump('-------------------------------------');

    $textDiffRenderer = new Text_Diff_Renderer_inline();
    var_dump($textDiffRenderer->render($textDiff));
    var_dump('-------------------------------------');

    $textDiffRenderer = new Text_Diff_Renderer_unified();
    var_dump($textDiffRenderer->render($textDiff));
    var_dump('-------------------------------------');
  }
}