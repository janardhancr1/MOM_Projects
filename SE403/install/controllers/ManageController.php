<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: ManageController.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class ManageController extends Zend_Controller_Action
{
  /**
   * @var Engine_Package_Manager
   */
  protected $_packageManager;

  /**
   * @var Zend_Session_Namespace
   */
  protected $_session;

  protected $_settings;

  protected $_vfsSettings;

  public $contexts = array(
    'upload' => array(
      'json',
    ),
    'extract' => array(
      'json',
    ),
    'select-delete' => array(
      'json',
    ),
  );

  public function init()
  {
    // Check if already logged in
    if( !Zend_Registry::get('Zend_Auth')->getIdentity() ) {
      return $this->_helper->redirector->gotoRoute(array(), 'default', true);
    }

    // Check if related folders are writeable
    if( !is_writeable(APPLICATION_PATH . '/application/packages') ) {
      throw new Engine_Exception('application/packages folder is not writeable; Please CHMOD this directory to 777 and refresh this page.');
    }
    if( !is_writeable(APPLICATION_PATH . '/temporary/package') ) {
      throw new Engine_Exception('temporary/package folder is not writeable; Please CHMOD this directory to 777 and refresh this page.');
    }
    if( !is_writeable(APPLICATION_PATH . '/temporary/package/archives') ) {
      throw new Engine_Exception('temporary/package/archives folder is not writeable; Please CHMOD this directory to 777 and refresh this page.');
    }
    if( !is_writeable(APPLICATION_PATH . '/temporary/package/packages') ) {
      throw new Engine_Exception('temporary/package/packages folder is not writeable; Please CHMOD this directory to 777 and refresh this page.');
    }
    if( !is_writeable(APPLICATION_PATH . '/temporary/package/repositories') ) {
      throw new Engine_Exception('temporary/package/repositories folder is not writeable; Please CHMOD this directory to 777 and refresh this page.');
    }

    // Get manager
    $this->_packageManager = Zend_Registry::get('Engine_Package_Manager');

    // Create session namespace
    $this->_session = new Zend_Session_Namespace('InstallManageController');

    // Set db and vfs if available
    if( Zend_Registry::isRegistered('Zend_Db') && Zend_Registry::get('Zend_Db') instanceof Zend_Db_Adapter_Abstract ) {
      $this->_packageManager->setDb(Zend_Registry::get('Zend_Db'));
    }
    if( isset($this->_session->vfsInstance) && $this->_session->vfsInstance instanceof Engine_Vfs_Adapter_Abstract ) {
      $this->_packageManager->setVfs($this->_session->vfsInstance);
    }

    // Get settings
    $config = array();
    $settingsFile = APPLICATION_PATH . '/install/config/general.php';
    if( file_exists($settingsFile) ) {
      $config = include $settingsFile;
    }
    $this->view->settings = $this->_settings = array_merge(array(
      'force' => '0',
      'verbose' => '0',
      'automated' => '0',
    ), $config);

    // Get vfs config
    $vfsConfig = array();
    $vfsFile = APPLICATION_PATH . '/install/config/vfs.php';
    if( file_exists($vfsFile) ) {
      $vfsConfig = include $vfsFile;
    }
    $this->_vfsSettings = $vfsConfig;

    // Add manage socialengine title
    $this->view->headTitle()->prepend('Manage SocialEngine');
    
    // Set time limit
    set_time_limit(600);
  }

  public function indexAction()
  {
    // Check for updates
    try {
      $repo = $this->_packageManager->getRepository('socialengine.net');
      if( $repo ) {
        $remoteVersions = $repo->queryList();
      }
    } catch( Exception $e ) {
      // Silence
      $remoteVersions = array();
    }
    //$remoteVersions['core-base']['version'] = '4.0.0';
    $this->view->remoteVersions = $remoteVersions;


    
    // Try to get a list of installed modules and themes from the database
    $dbState = array();
    if( Zend_Registry::isRegistered('Zend_Db') && ($db = Zend_Registry::get('Zend_Db')) instanceof Zend_Db_Adapter_Abstract ) {
      try {
        $table = new Zend_Db_Table(array(
          'adapter' => $db,
          'name' => 'engine4_core_modules',
        ));
        foreach( $table->fetchAll() as $row ) {
          $dbState['module'][$row->name] = $row->toArray();
        }
      } catch( Exception $e ) {

      }
      try {
        $table = new Zend_Db_Table(array(
          'adapter' => $db,
          'name' => 'engine4_core_themes',
        ));
        foreach( $table->fetchAll() as $row ) {
          $dbState['theme'][$row->name] = $row->toArray();
        }
      } catch( Exception $e ) {

      }
    }
    $this->view->dbState = $dbState;


    
    // List installed packages
    $upgradeablePackages = array();
    $pendingPackages = array();
    $installedPackages = array();
    foreach( $this->_packageManager->listInstalledPackages() as $installedPackage ) {

      // Get database state
      $databaseInfo = array();
      if( isset($dbState[$installedPackage->getType()][$installedPackage->getName()]) ) {
        $databaseInfo = $dbState[$installedPackage->getType()][$installedPackage->getName()];
      }

      // Get remote version info
      $remoteInfo = array();
      if( isset($remoteVersions[$installedPackage->getGuid()]) ) {
        $remoteInfo = $remoteVersions[$installedPackage->getGuid()];
      }

      //
      if ($installedPackage->getVersion() == '4.0.0beta3' && !empty($databaseInfo['version']) && $databaseInfo['version'] == '4.0.0') {
        $this->_forward('beta-update');
        return;
      }

      // Init
      $upgradeable = false;
      $pending = false;
      $navigation = array();

      // Navigation

      // Disable
      if( isset($databaseInfo['enabled']) && $databaseInfo['enabled'] && $installedPackage->hasAction('disable') ) {
        $navigation[] = array(
          'label' => 'disable',
          'href' => $this->view->url(array('action' => 'disable')) . '?package=' . $installedPackage->getKey(),
        );
      }

      // Enable
      if( isset($databaseInfo['enabled']) && !$databaseInfo['enabled'] && $installedPackage->hasAction('enable') ) {
        $navigation[] = array(
          'label' => 'enable',
          'href' => $this->view->url(array('action' => 'enable')) . '?package=' . $installedPackage->getKey(),
        );
      }

      // Install
      if( $installedPackage->getType() == 'module' && empty($databaseInfo['version']) ) {
        $pending = true;
        $navigation[] = array(
          'label' => 'install',
          'href' => $this->view->url(array('action' => 'install')) . '?package=' . $installedPackage->getKey(),
        );
      }

      // Update/downgrade/refresh
      if( $installedPackage->getType() == 'module' && !empty($databaseInfo['version']) ) {
        switch( version_compare($databaseInfo['version'], $installedPackage->getVersion()) ) {
          case 1:
            break;
          case 0:
            break;
          case -1:
            $pending = true;
            $navigation[] = array(
              'label' => 'upgrade',
              //'href' => $this->view->url(array('action' => 'prepare')) . '?packages[]=' . $installedPackage->getKey(),
              'href' => $this->view->url(array('action' => 'install')) . '?package=' . $installedPackage->getKey(),
            );
            break;
        }
      }

      // Remove
      if( $installedPackage->hasAction('remove') ) {
        $navigation[] = array(
          'label' => 'delete',
          'href' => $this->view->url(array('action' => 'prepare')) . '?packages[]=' . $installedPackage->getKey() . '&actions[]=remove',
        );
      }

      // Add get upgrade
      if( !empty($remoteInfo) && version_compare($remoteInfo['version'], $installedPackage->getVersion(), '>') ) {
        $upgradeable = true;
        $navigation[] = array(
          'label' => 'get update (' . $remoteInfo['version'] . ')',
          'href' => 'http://www.socialengine.net/clients',
        );
      }
      
      $installedPackageInfo = array(
        'package' => $installedPackage,
        'database' => $databaseInfo,
        'remote' => $remoteInfo,
        'navigation' => $navigation,
        'upgradeable' => $upgradeable,
        'pending' => $pending,
      );

      if( $upgradeable ) {
        $upgradeablePackages[] = $installedPackageInfo;
      } else if( $pending ) {
        $pendingPackages[] = $installedPackageInfo;
      } else {
        $installedPackages[] = $installedPackageInfo;
      }
    }
    $this->view->installedPackages = array_merge($upgradeablePackages, $pendingPackages, $installedPackages);
  }
  
  public function selectAction()
  {
    $this->view->installNavigation = $this->getInstallNavigation('select');

    // Get extracted packages
    $this->view->extractedPackages = $extractedPackages = $this->_packageManager->listExtractedPackages();

    // Get available packages
    $toExtractPackages = array();
    $archiveDir = APPLICATION_PATH . '/temporary/package/archives';
    $extractDir = APPLICATION_PATH . '/temporary/package/packages';
    foreach( scandir($archiveDir) as $file ) {
      if( strtolower(substr($file, -4, 4)) != '.tar' ) {
        continue;
      }
      $partFile = substr($file, 0, -4);
      if( !is_dir($extractDir . DIRECTORY_SEPARATOR . $partFile) ) {
        $toExtractPackages[] = $file;
      }
    }
    $this->view->toExtractPackages = $toExtractPackages;
  }

  public function selectDeleteAction()
  {
    $this->_helper->contextSwitch->initContext();

    $package = $this->_getParam('package');

    // Setup
    $archiveDir = APPLICATION_PATH . '/temporary/package/archives';
    $extractDir = APPLICATION_PATH . '/temporary/package/packages';

    if( !is_string($package) ) {
      $this->view->error = 'Not a string';
      return;
    }
    
    if( strpos($package, '/') !== false || strpos($package, '\\') !== false ) {
      $this->view->error = 'No directory traversal!';
      return;
    }

    $packageArchive = $archiveDir . DIRECTORY_SEPARATOR . $package . '.tar';
    $packageDirectory = $extractDir . DIRECTORY_SEPARATOR . $package;

    if( file_exists($packageArchive) && is_file($packageArchive) ) {
      if( !@unlink($packageArchive) ) {
        $this->view->error = 'Could not remove archive file';
        return;
      }
    }

    if( file_exists($packageDirectory) && is_dir($packageDirectory) ) {
      try {
        Engine_Package_Utilities::fsRmdirRecursive($packageDirectory, true);
      } catch( Exception $e ) {
        $this->view->error = 'Could not remove extracted archive directory';
        return;
      }
    }

    $this->view->status = true;
  }

  public function extractAction()
  {
    $this->_helper->contextSwitch->initContext();

    $package = $this->_getParam('package');

    // Setup
    $archiveDir = APPLICATION_PATH . '/temporary/package/archives';
    $extractDir = APPLICATION_PATH . '/temporary/package/packages';

    // Check if archive directory is available
    if( !file_exists($archiveDir) || !is_dir($archiveDir) || !is_writeable($archiveDir) ) {
      $this->view->error = 'Archives directory missing. Please create temporary/package/archives and chmod it 0777.' . $targetDir;
      return;
    }

    // Check if extract directory is available
    if( !file_exists($extractDir) || !is_dir($extractDir) || !is_writeable($extractDir) ) {
      $this->view->error = 'Packages directory missing. Please create temporary/package/packages and chmod it 0777.' . $extractDir;
      return;
    }

    // Check if archive is a tar file
    $targetFile = $archiveDir . DIRECTORY_SEPARATOR . $package;
    if( strtolower(substr($targetFile, -4, 4)) != '.tar' ) {
      $this->view->error = 'Package is not a TAR archive.';
      return;
    }
    
    // Check if archive exists
    if( !file_exists($targetFile) ) {
      $this->view->error = 'Package does not exist.';
      return;
    }
    
    // Try to deflate archive?
    $extractFiles = array($targetFile);
    $packagesInfo = array();
    set_time_limit(300);

    $toRemove = array();

    try {
      while( count($extractFiles) > 0 ) {
        $current = array_shift($extractFiles);
        $hadPackage = false;
        $hadArchive = false;

        // Try to extract
        $outputPath = Engine_Package_Archive::inflate($current, $extractDir);

        // Check for tar files or package files
        foreach( scandir($outputPath) as $child ) {

          // Package file
          if( strtolower($child) == 'package.json' ) {
            $packageFile = new Engine_Package_Manifest($outputPath . DIRECTORY_SEPARATOR . $child);
            $packagesInfo[] = array(
              'key' => $packageFile->getKey(),
              'data' => $packageFile->toArray(),
              'html' => $this->view->packageSelect($packageFile),
            );
            $hadPackage = true;
          }

          // Tar file
          else if( strtolower(substr($child, -4)) === '.tar'  ) {
            $extractFiles[] = $outputPath . DIRECTORY_SEPARATOR . $child;
            $hadArchive = true;
          }
        }

        // Add to remove after extraction
        $toRemove[] = $current;
        if( !$hadPackage ) {
          $toRemove[] = $outputPath;
        }
      }

    } catch( Exception $e ) {
      $this->view->error = $e->getMessage();
      return;
    }

    if( empty($packagesInfo) ) {
      $this->view->error = 'No packages found in archive';
      return;
    }

    // Remove to remove
    foreach( $toRemove as $removeFile ) {
      if( is_dir($removeFile) ) {
        try {
          Engine_Package_Utilities::fsRmdirRecursive($removeFile, true);
        } catch( Exception $e ) {

        }
      } else if( is_file($removeFile) ) {
        @unlink($removeFile);
      }
    }
    
    $this->view->status = 1;
    $this->view->packagesInfo = $packagesInfo;
  }

  public function uploadAction()
  {
    $this->view->installNavigation = $this->getInstallNavigation('select');

    $this->_helper->contextSwitch->initContext();
    
    // Check method
    if( !$this->getRequest()->isPost() ) {
      return;
    }

    // Check ul bit
    if( !$this->_getParam('ul') ) {
      return;
    }

    // Process
    
    // Prepare
    $info = $_FILES['Filedata'];
    $archiveDir = APPLICATION_PATH . '/temporary/package/archives';
    $extractDir = APPLICATION_PATH . '/temporary/package/packages';
    $targetFile = $archiveDir . '/' . $info['name'];

    // Check if archive directory is available
    if( !file_exists($archiveDir) || !is_dir($archiveDir) || !is_writeable($archiveDir) ) {
      $this->view->error = 'Archives directory missing. Please create temporary/package/archives and chmod it 0777.' . $targetDir;
      return;
    }

    // Check if extract directory is available
    if( !file_exists($extractDir) || !is_dir($extractDir) || !is_writeable($extractDir) ) {
      $this->view->error = 'Packages directory missing. Please create temporary/package/packages and chmod it 0777.' . $extractDir;
      return;
    }

    // Check extension
    if( strtolower(substr($info['name'], -4, 4)) != '.tar' ) {
      $this->view->error = 'The file uploaded was not a TAR archive.';
      return;
    }

    // Check if already exists
    if( file_exists($targetFile) && !@unlink($targetFile) ) {
      $this->view->error = 'This file has already been uploaded, and the previous file could not be removed. Please try removing it manually in temporary/package/archives';
      return;
    }

    // Check if already extracted
    $outputPath = $extractDir . DIRECTORY_SEPARATOR . substr($info['name'], 0, -4);
    if( file_exists($outputPath) && is_dir($outputPath) ) {
      try {
        Engine_Package_Utilities::fsRmdirRecursive($outputPath, true);
      } catch( Exception $e ) {
        $this->view->error = 'Extract path already exists and could not be removed. Please try removing it manually in temporary/package/packages';
        return;
      }
    }

    // Try to move uploaded file
    if( !move_uploaded_file($info['tmp_name'], $targetFile) ) {
      $this->view->error = 'Unable to move file to packages directory. Please set chmod 0777 on the temporary/package/archives directory.';
      return;
    }
    
    $this->view->status = 1;
    $this->view->file = $info['name'];
  }














  /* INSTALL PROCESS -------------------------------------------------------- */

  public function prepareAction()
  {
    $skip = $this->_getParam('skip');
    if( null !== $skip ) {
      $this->_session->skipDiffErrorFiles = (bool) $skip;
      return $this->_helper->redirector->gotoRoute(array('action' => 'vfs'));
    }


    $this->view->installNavigation = $this->getInstallNavigation('prepare');


    $flush = true; // For debugging
    // Get packages
    if( $flush || empty($this->_session->packages) ) {
      // Remove packages w/ same guid
      $cleanPackages = array();
      foreach( $this->_getParam('packages') as $package ) {
        $guid = substr($package, 0, strrpos($package, '-'));
        $version = substr($package, strrpos($package, '-') + 1);
        if( !isset($cleanPackages[$guid]) || version_compare($version, $cleanPackages[$guid], '>') ) {
          $cleanPackages[$guid] = $version;
        }
      }
      $packages = array();
      foreach( $cleanPackages as $guid => $version ) {
        $packages[] = $guid . '-' . $version;
      }
      $packages = $this->_session->packages = $packages;
    } else {
      $packages = $this->_session->packages;
    }
    $this->view->packages = $packages;

    if( empty($packages) ) {
      $this->view->selectError = true;
      return;
    }

    // Get actions
    if( $flush || empty($this->_session->actions) ) {
      $actions = $this->_session->actions = $this->_getParam('actions');
    } else {
      $actions = $this->_session->actions;
    }
    $this->view->actions = $actions;

    // Get operations
    if( $flush || empty($this->_session->operations) ) {
      $operations = $this->_session->operations = $this->_packageManager->decide($packages, $this->_getParam('actions'));
    } else {
      $operations = $this->_session->operations;
    }
    $this->view->operations = $operations;

    // Get dependencies
    if( $flush || empty($this->_session->dependencies) ) {
      $dependencies = $this->_session->dependencies = $this->_packageManager->depend($operations);
    } else {
      $dependencies = $this->_session->dependencies;
    }
    $this->view->dependencies = $dependencies;

    $dependencyError = false;
    foreach( $dependencies as $dependency ) {
      $dependencyError |= $dependency->hasErrors();
    }
    $this->view->dependencyError = $dependencyError;

    // Get sanity
    $this->_session->tests = null;
    if( $flush || empty($this->_session->tests) ) {
      $tests = $this->_session->tests = $this->_packageManager->test($operations);
    } else {
      $tests = $this->_session->tests;
    }
    $this->view->tests = $tests;
    $this->view->testsMaxErrorLevel = $testsMaxErrorLevel = $tests->getMaxErrorLevel();
    $this->view->testsError = $testsError = ($testsMaxErrorLevel >= 4);

    // Get diff
    $this->_session->diffs = null;
    if( $flush || empty($this->_session->diffs) ) {
      $diffs = $this->_session->diffs = $this->_packageManager->diff($operations);
    } else {
      $diffs = $this->_session->diffs;
    }
    $this->view->diffs = $diffs;

    $diffError = false;
    foreach( $diffs as $diff ) {
      $diffError |= $diff->hasError();
    }
    $this->view->diffError = $diffError;

    // Check if we can install
    $this->view->prepareError = $prepareError = ( $dependencyError || $testsError || $diffError );
    $this->view->diffErrorOnly = $diffErrorOnly = ( !$dependencyError && !$testsError && $diffError );
  }

  public function vfsAction()
  {
    $this->view->installNavigation = $this->getInstallNavigation('vfs');

    $adapterType = $this->_getParam('adapter');
    if( null === $adapterType ) {
      $adapterType = $this->_session->vfsAdapter;
      if( null === $adapterType ) {
        $adapterType = @$this->_vfsSettings['adapter'];
      }
    }
    $previousAdapterType = $this->_getParam('previousAdapter');

    $this->view->form = $form = new Install_Form_VfsInfo(array(
      'adapterType' => $adapterType,
    ));

    if( !$this->getRequest()->isPost() || $adapterType != $previousAdapterType ) {
      if( !$adapterType ) {
        // Ignore
      } else if( $adapterType == @$this->_session->vfsAdapter ) {
        // Load from session
        $form->populate(array(
          'adapter' => $adapterType,
          'config'  => $this->_session->vfsConfig
        ));
      } else if( $adapterType == @$this->_vfsSettings['adapter'] ) {
        // Load from settings file
        $form->populate($this->_vfsSettings);
      } else {
        $form->populate(array(
          'adapter' => $adapterType,
        ));
      }
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }

    // Process
    $values = $form->getValues();
    $vfsAdapter = $values['adapter'];
    $vfsConfig = $values['config'];

    // Try to load adapter
    try {
      $vfs = Engine_Vfs::factory($vfsAdapter, $vfsConfig);
    } catch( Exception $e ) {
      $form->addError('Connection error: ' . $e->getMessage());
      return;
    }

    // Try to connect (getResource will force connect)
    try {
      $vfs->getResource();
    } catch( Exception $e ) {
      $form->addError('Connection error: ' . $e->getMessage());
      return;
    }

    // Search for target
    $path = null;
    if( !empty($vfsConfig['search']) && $vfsConfig['search'] !== '0' ) {
      $path = $vfs->findJailedPath($vfsConfig['path'], APPLICATION_PATH . '/install/ftp_search_will_look_for_this_file');
      if( !$path ) {
        $form->addError('Your installation could not be found. Please double check your connection info and starting path. Your starting path needs to be your SocialEngine path, or a parent directory of it.');
        return;
      }
      $path = dirname(dirname($path));
    } else {
      $path = $vfsConfig['path'];
    }

    // Verify path
    if( !$vfs->exists($path . '/install/ftp_search_will_look_for_this_file') ) {
      $form->addError('Specified path is not a SocialEngine install directory.');
      return;
    }

    // Save config
    $vfsConfig['path'] = $values['config']['path'] = $path;

    $vfs->changeDirectory($path);
    $this->_session->vfsInstance = $vfs;

    $this->_session->vfsAdapter = $vfsAdapter;
    $this->_session->vfsConfig = $vfsConfig;

    $this->_vfsSettings = $values;
    
    // Save for later
    $vfsSettingsData = array(
      'adapter' => $vfsAdapter,
      'config' => array_diff_key($vfsConfig, array(
        'password' => null,
        'location' => null,
        'search' => null,
      )),
    );
    @file_put_contents(APPLICATION_PATH . '/install/config/vfs.php', '<?php return ' . var_export($vfsSettingsData, true) . '?>');

    // Redirect to next step
    return $this->_helper->redirector->gotoRoute(array('action' => 'perms'));
  }

  public function permsAction()
  {
    $this->view->installNavigation = $this->getInstallNavigation('perms');

    $this->view->vfsPath = $this->_session->vfsConfig['path'];

    $skip = $this->_session->skipDiffErrorFiles;

    // Build file todo-list
    $files = array();
    $operationCount = 0;
    foreach( $this->_session->diffs as $batch ) {
      $package = $batch->package;
      $previousPackage = $batch->previousPackage;
      $packageKey = $batch->packageKey;
      // Add package file
      //$files[$packageKey]['application/packages/' . $package->getKey() . '.json'] = Engine_File_Diff::ADD;
      // Remove old package file
      //if( $previousPackage ) {
      //  $files[$packageKey]['application/packages/' . $previousPackage->getKey() . '.json'] = Engine_File_Diff::REMOVE;
      //}

      // Add the other files
      foreach( $batch->getDiffs() as $diff ) {
        $path = $diff->getRight()->getPath();
        $code = $diff->getCode();

        // Skip identical and ignore
        if( $code == 'identical' || $code == 'ignore' ) {
          continue;
        }

        // Skip diff errors if selected
        if( $skip && $diff->isError() ) {
          continue;
        }

        // Add to queue
        $files[$packageKey][$path] = $code;
        $operationCount++;
      }
    }
    $this->view->files = $this->_session->installFiles = $files;
    $this->view->operationCount = $operationCount;
    $this->_session->installFiles = $files;

    // Get vfs object
    $vfs = $this->_session->vfsInstance;

    // Check permissions
    $permResults = array();
    foreach( (array) $files as $packageKey => $packageFiles ) {
      foreach( (array) $packageFiles as $packageFile => $code ) {
        // Check for file
        try {
          $fileInfo = $vfs->info($packageFile);
          if( !$fileInfo->exists() ) {
            $fileInfo = null;
          }
        } catch( Exception $e ) {
          // This usually means it doesn't exist
          //var_dump($e->getMessage());
          $fileInfo = null;
        }
        // Find parent directory
        if( null === $fileInfo ) {
          $curPath = $packageFile;
          while( '' != trim($curPath = dirname($curPath), '/\\') ) {
            if( $vfs->isDirectory($curPath) ) {
              $parentFileInfo = $vfs->info($curPath);
              break;
            }
          }
        }
        // Do stuff
        if( null !== $fileInfo ) {
          //$permSummary[$packageKey][$packageFile] = $fileInfo->isWritable();
          $permResults[$packageKey][$fileInfo->getPath()] = $fileInfo->isWritable();
        } else if( null !== $parentFileInfo ) {
          //$permSummary[$packageKey][$packageFile] = $parentFileInfo->isWritable();
          $permResults[$packageKey][$parentFileInfo->getPath()] = $parentFileInfo->isWritable();
        } else {
          throw new Engine_Exception('could not find parent path');
        }
      }
    }

    $this->view->permResults = $permResults;
    $this->_session->permResults = $permResults;

    // Build summary
    $notWritableCount = 0;
    $permSummary = array();
    foreach( (array) $permResults as $packageKey => $packageFiles ) {
      $permSummary[$packageKey]['writable'] = 0;
      $permSummary[$packageKey]['not-writable'] = 0;
      foreach( $packageFiles as $packageFile => $isWritable ) {
        $permSummary[$packageKey][$isWritable ? 'writable' : 'not-writable']++;
        if( !$isWritable ) $notWritableCount++;
      }
    }
    $this->view->permSummary = $permSummary;
    $this->view->notWritableCount = $notWritableCount;
  }

  public function placeAction()
  {
    $this->view->installNavigation = $this->getInstallNavigation('place');

    // Get vfs object
    $vfs = $this->_session->vfsInstance;

    $skip = $this->_session->skipDiffErrorFiles;

    $this->view->placeError = false;

    // Place files
    $actionSummary = array();
    foreach( (array) $this->_session->diffs as $batch ) {
      $packageKey = $batch->packageKey;
      foreach( $batch->getDiffs() as $diff ) {

        // Skip diff errors if selected
        if( $skip && $diff->isError() ) {
          continue;
        }

        // Copy files
        $sourceBasePath = null;
        if( $batch->package ) {
          $sourceBasePath = $batch->package->getBasePath();
        }
        $source = $diff->getRight()->getPath();
        $dest = $diff->getLeft()->getPath();
        $source = $sourceBasePath . '/' . $source;
        $dest = ltrim(str_replace(APPLICATION_PATH, '', $dest), '/\\');

        // What to do, what to do
        $code = $diff->getCode();
        try {
          switch( $code ) {
            // Ignore
            case 'identical':
            case 'ignore':
              break;

            case 'add':
            case 'added':
              $vfs->makeDirectory(dirname($dest), true);
              $vfs->put($dest, $source);
              $actionSummary[$packageKey][$dest] = 'added';
              break;

            case 'added_added':
            case 'different_different':
            case 'different':
            case 'replace':
              $vfs->put($dest, $source);
              $actionSummary[$packageKey][$dest] = 'replaced';
              break;

            case 'different_removed':
            case 'remove':
            case 'removed':
              $vfs->unlink($dest);
              $actionSummary[$packageKey][$dest] = 'removed';
              break;

            default:
              throw new Exception($code);
              break;
          }
        } catch( Exception $e ) {
          // something bad happened -_-
          $this->view->placeError = true;
          $actionSummary[$packageKey][$dest] = 'failed (' . $e->getMessage() . ')';
        }
      }
    }
    $this->view->actionSummary = $actionSummary;


    // Also apply permissions
    $permSummary = array();
    foreach( $this->_session->operations as $operation ) {
      $package = $operation->getResultantPackage();
      if( !method_exists($package, 'getPermissions') ) {
        continue;
      }
      $permissions = $package->getPermissions();
      if( !is_array($permissions) || empty($permissions) ) {
        continue;
      }
      foreach( $permissions as $permission ) {
        try {
          $info = $vfs->info($permission->getPath());
          if( !$info->exists() ) {
            $permSummary[] = $permission->getPath() . ' - Does not exist';
          } else if( $info->isFile() ) {
            $vfs->mode($permission->getPath(), $permission->getMode());
          } else if( $info->isDirectory() ) {
            if( $permission->getInclusive() ) {
              $vfs->mode($permission->getPath(), $permission->getMode(), $permission->getRecursive());
            } else {
              foreach( $info->getChildren() as $child ) {
                $vfs->mode($child->getPath(), $permission->getMode(), $permission->getRecursive());
              }
            }
          } else {
            $permSummary[] = $permission->getPath() . ' - Unknown file type or missing';
          }
        } catch( Exception $e ) {
          $permSummary[] = $permission->getPath() . ' - Error - ' . $e->getMessage();
        }
      }
    }
    $this->view->permSummary = $permSummary;
  }

  public function queryAction()
  {
    $this->view->installNavigation = $this->getInstallNavigation('query');

    $operations = $this->_session->operations;
    $db = Zend_Registry::get('Zend_Db');
    $vfs = $this->_session->vfsInstance;
    $queryError = false;

    // Run all them delicious database queries

    // Run pre install
    $results = array();
    $packageTitles = array();
    foreach( $this->_packageManager->callback($operations, 'preinstall') as $result ) {
      if( !empty($result['errors']) ) {
        $queryError = true;
      }
      // Add to results
      $key = $result['operation']->getPackage()->getKey();
      $packageTitles[$key] = $result['operation']->getPackage()->getMeta()->getTitle() . ' (' . $result['operation']->getPackage()->getVersion() . ')';
      $results[$key][] = $result;
    }
    if( $queryError ) {
      $this->view->queryError = true;
      $this->view->results = $results;
      $this->view->packageTitles = $packageTitles;
      return;
    }
    
    // Run install
    $results = array();
    foreach( $this->_packageManager->callback($operations, 'install') as $result ) {
      if( !empty($result['errors']) ) {
        $queryError = true;
      }
      // Add to results
      $key = $result['operation']->getPackage()->getKey();
      $packageTitles[$key] = $result['operation']->getPackage()->getMeta()->getTitle() . ' (' . $result['operation']->getPackage()->getVersion() . ')';
      $results[$key][] = $result;
    }
    if( $queryError ) {
      $this->view->queryError = true;
      $this->view->results = $results;
      $this->view->packageTitles = $packageTitles;
      return;
    }

    // Run post install
    $results = array();
    foreach( $this->_packageManager->callback($operations, 'postinstall') as $result ) {
      if( !empty($result['errors']) ) {
        $queryError = true;
      }
      // Add to results
      $key = $result['operation']->getPackage()->getKey();
      $packageTitles[$key] = $result['operation']->getPackage()->getMeta()->getTitle() . ' (' . $result['operation']->getPackage()->getVersion() . ')';
      $results[$key][] = $result;
    }
    if( $queryError ) {
      $this->view->queryError = true;
      $this->view->results = $results;
      $this->view->packageTitles = $packageTitles;
      return;
    }
    $this->view->results = $results;
    $this->view->packageTitles = $packageTitles;
  }

  public function completeAction()
  {
    $this->view->installNavigation = $this->getInstallNavigation('complete');

    $vfs = $this->_session->vfsInstance;

    // Switch them package files
    /*
    foreach( $this->_session->operations as $operation ) {
      //// Remove old package file now?
      $previousPackage = $operation->getPreviousPackage();
      if( $previousPackage ) {
        $vfs->unlink('application/packages/' . $previousPackage->getKey() . '.json');
      }
      // Put main package file
      $package = $operation->getPackage();
      $vfs->put('application/packages/' . $package->getKey() . '.json', $package->getBasePath() . DIRECTORY_SEPARATOR . 'package.json');
    }
     * 
     */

    // Let's do some clean-up
    $this->_packageManager->cleanup($this->_session->operations);

    $this->_session->unsetAll();
  }















  public function enableAction()
  {
    $this->view->form = $form = new Install_Form_Confirm(array(
      'title' => 'Enable Package?',
      'description' => 'Are you sure you want to enable this package?',
      'submitLabel' => 'Enable Package',
      'cancelHref' => $this->view->url(array('action' => 'index')),
      'useToken' => true,
    ));

    if( !$this->getRequest()->isPost() ) {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }

    // Do the enable
    $packageName = $this->_getParam('package');
    $package = null;
    foreach( $this->_packageManager->listInstalledPackages() as $installedPackage ) {
      if( $installedPackage->getKey() == $packageName ) {
        $package = $installedPackage;
      }
    }

    // Enable/disable
    if( $package->hasAction('enable') ) {
      $operation = new Engine_Package_Manager_Operation_Enable($this->_packageManager, $package);
      $ret = $this->_packageManager->execute($operation, 'enable');
    }
    
    return $this->_helper->redirector->gotoRoute(array('action' => 'index'));
  }

  public function disableAction()
  {
    $this->view->form = $form = new Install_Form_Confirm(array(
      'title' => 'Disable Package?',
      'description' => 'Are you sure you want to disable this package?',
      'submitLabel' => 'Disable Package',
      'cancelHref' => $this->view->url(array('action' => 'index')),
      'useToken' => true,
    ));

    if( !$this->getRequest()->isPost() ) {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }

    // Do the disable
    $packageName = $this->_getParam('package');
    $package = null;
    foreach( $this->_packageManager->listInstalledPackages() as $installedPackage ) {
      if( $installedPackage->getKey() == $packageName ) {
        $package = $installedPackage;
      }
    }

    // Enable/disable
    if( $package->hasAction('disable') ) {
      $operation = new Engine_Package_Manager_Operation_Disable($this->_packageManager, $package);
      $ret = $this->_packageManager->execute($operation, 'disable');
    }
    
    return $this->_helper->redirector->gotoRoute(array('action' => 'index'));
  }

  public function installAction()
  {
    $this->view->form = $form = new Install_Form_Confirm(array(
      'title' => 'Install Package?',
      'description' => 'Are you sure you want to install this package?',
      'submitLabel' => 'Install Package',
      'cancelHref' => $this->view->url(array('action' => 'index')),
      'useToken' => true,
    ));

    if( !$this->getRequest()->isPost() ) {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }

    // Do the disable
    $packageName = $this->_getParam('package');
    $package = null;
    foreach( $this->_packageManager->listInstalledPackages() as $installedPackage ) {
      if( $installedPackage->getKey() == $packageName ) {
        $package = $installedPackage;
      }
    }

    // Enable/disable
    $operation = new Engine_Package_Manager_Operation_Install($this->_packageManager, $package);

    $errors = array();


    // Run preinstall
    $result = $this->_packageManager->execute($operation, 'preinstall');
    if( !empty($result['errors']) ) {
      $queryError = true;
      $errors = array_merge($errors, $result['errors']);
    }
    if( $queryError ) {
      $this->view->queryError = true;
      $this->view->errors = $errors;
      return;
    }

    // Run install
    $result = $this->_packageManager->execute($operation, 'install');
    if( !empty($result['errors']) ) {
      $queryError = true;
      $errors = array_merge($errors, $result['errors']);
    }
    if( $queryError ) {
      $this->view->queryError = true;
      $this->view->errors = $errors;
      return;
    }

    // Run postinstall
    $result = $this->_packageManager->execute($operation, 'postinstall');
    if( !empty($result['errors']) ) {
      $queryError = true;
      $errors = array_merge($errors, $result['errors']);
    }
    if( $queryError ) {
      $this->view->queryError = true;
      $this->view->errors = $errors;
      return;
    }


    // Redirect if no error
    if( !$queryError ) {
      return $this->_helper->redirector->gotoRoute(array('action' => 'index'));
    }
  }






  // This is used to make the beta3 appear correctly
  
  public function betaUpdateAction()
  {
    if( !$this->getRequest()->isPost() ) {
      return;
    }
    
    $db = Zend_Registry::get('Zend_Db');
    //$db = new Zend_Db_Adapter_Abstract();
    
    // Get all module info
    $select = new Zend_Db_Select($db);
    $select
      ->from('engine4_core_modules')
      ;
    
    $modules = array();
    foreach( $select->query()->fetchAll() as $row ) {
      $modules[$row['name']] = $row;
    }
    
    $errors = array();
    $installedPackages = $this->_packageManager->listInstalledPackages();
    foreach( $installedPackages as $installedPackage ) {
      if( $installedPackage->getType() !== 'module' ) continue;
      
      // Remove modules that have not been installed
      if( !isset($modules[$installedPackage->getName()]) ) {
        $packageFile = $installedPackage->getSourcePath();
        if( !@unlink($packageFile) ) {
          $errors[] = sprintf('Unable to remove package file "%s" for not installed module "%s"', $packageFile, $modules[$installedPackage->getName()]['title']);
        }
      }

      // Remove modules from content system that have not been installed
      if(!isset($modules[$installedPackage->getName()]) ) {
        $db->delete('engine4_core_content', array(
          'name LIKE ?' => $installedPackage->getName().'.%',
        ));
      }
    }
    $this->view->errors = $errors;

    // Update database
    try {
      $db->query('ALTER TABLE `engine4_core_modules` CHANGE `version` `version` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL');
    } catch( Exception $e ) {

    }
    
    $db->update('engine4_core_modules', array(
      'version' => '4.0.0beta3',
    ), array(
      'version = ?' => '4.0.0',
    ));

    // Delete pages for Groups and Events if not installed
    if (!array_key_exists('group', $modules)) {
      $page = new Zend_Db_Select($db);
      $page->from('engine4_core_pages')
           ->where('name = ?', 'group_profile_index');
      $page = $db->fetchRow($page);
      if ($page) {
        $page_id = $page['page_id'];
        $db->delete('engine4_core_pages', array(
          'page_id = ?' => $page_id
        ));
        $db->delete('engine4_core_content', array(
          'page_id = ?' => $page_id,
        ));
      }
    }
    if (!array_key_exists('event', $modules)) {
      $page = new Zend_Db_Select($db);
      $page->from('engine4_core_pages')
           ->where('name = ?', 'event_profile_index');
      $page = $db->fetchRow($page);
      if ($page) {
        $page_id = $page['page_id'];
        $db->delete('engine4_core_pages', array(
          'page_id = ?' => $page_id
        ));
        $db->delete('engine4_core_content', array(
          'page_id = ?' => $page_id
        ));
      }
    }

    $this->view->status = true;
    $this->view->modules = $modules;
  }




  public function getInstallNavigation($active = 0)
  {
    return new Zend_Navigation(array(
      array(
        'label' => 'Choose Packages',
        'uri' => 'javascript:void(0);',
        'active' => ( $active == 'select' ),
      ),
      array(
        'label' => 'Run Pre-install Check',
        'uri' => 'javascript:void(0);',
        'active' => ( $active == 'prepare' ),
      ),
      array(
        'label' => 'Enter FTP Info',
        'uri' => 'javascript:void(0);',
        'active' => ( $active == 'vfs' ),
      ),
      array(
        'label' => 'Run Permissions Check',
        'uri' => 'javascript:void(0);',
        'active' => ( $active == 'perms' ),
      ),
      array(
        'label' => 'Copy Files',
        'uri' => 'javascript:void(0);',
        'active' => ( $active == 'place' ),
      ),
      array(
        'label' => 'Update Database',
        'uri' => 'javascript:void(0);',
        'active' => ( $active == 'query' ),
      ),
      array(
        'label' => 'Complete!',
        'uri' => 'javascript:void(0);',
        'active' => ( $active == 'complete' ),
      ),
    ));
  }
}