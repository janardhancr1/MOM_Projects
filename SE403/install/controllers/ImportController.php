<?php

class ImportController extends Zend_Controller_Action
{
  /**
   * @var Zend_Cache_Core
   */
  protected $_cache;

  /**
   * @var string
   */
  protected $_platform;

  /**
   * @var Zend_Db_Adapter_Abstract
   */
  protected $_fromDb;

  /**
   * @var string
   */
  protected $_fromPath;

  /**
   * @var Zend_Db_Adapter_Abstract
   */
  protected $_toDb;

  /**
   * @var string
   */
  protected $_toPath;


  public function init()
  {
    // Get cache
    if( !Zend_Registry::isRegistered('Cache') ) {
      throw new Engine_Exception('Caching is required, please ensure temporary/cache is writable.');
    }
    $oldCache = Zend_Registry::get('Cache');

    // Make new cache
    $this->_cache = Zend_Cache::factory('Core', $oldCache->getBackend(), array(
      'cache_id_prefix'           => 'engine4installimport',
      'lifetime'                  => 86400,
      'ignore_user_abort'         => true,
      'automatic_serialization'   => true,
    ));

    // Get existing token
    $token = $this->_cache->load('token');
    
    // Check if already logged in
    if( !Zend_Registry::get('Zend_Auth')->getIdentity() ) {
      // Check if token matches
      if( null == $this->_getParam('token') ) {
        return $this->_helper->redirector->gotoRoute(array(), 'default', true);
      } else if( $token !== $this->_getParam('token')) {
        echo Zend_Json::encode(array(
          'status' => false,
          'erros' => 'Invalid token',
        ));
        exit();
      }
    }
    
    // Add path to autoload
    Zend_Registry::get('Autoloader')->addResourceType('import', 'import', 'Import');

  }

  public function indexAction()
  {
    
  }



  // Version 3

  public function version3InstructionsAction()
  {
    $this->view->dbHasContent = $this->_dbHasContent();
  }

  public function version3Action()
  {
    // Set platform
    $this->_platform = 'version3';

    // Clean cache
    $this->_cache->clean();

    // Make form
    $this->view->form = $form = new Install_Form_Import_Version3();

    // Populate steps
    $steps = $this->_listMigrators($this->_platform);
    $form->disabledSteps->setMultiOptions(array_combine($steps, $steps));

    // Check post
    if( !$this->getRequest()->isPost() ) {
      return;
    }

    // Check valid
    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }

    $values = $form->getValues();

    // get params
    $params = $values;
    unset($params['path']);
    unset($params['mode']);

    // Check for installation
    $requiredFiles = array(
      'help_tos.php',
      'user_home.php',
      'include/database_config.php',
      'include/smarty',
      'templates',
      'uploads_user',
    );
    foreach( $requiredFiles as $requiredFile ) {
      $requiredFileAbs = $values['path'] . '/' . $requiredFile;
      if( !file_exists($requiredFileAbs) ) {
        return $form->addError('Version 3 installation not detected in the specified path. The missing file was: ' . $requiredFileAbs);
      }
    }
    
    // Setup
    try {
      $this->_setupVersion3($values['path'], APPLICATION_PATH);
    } catch( Exception $e ) {
      return $form->addError($e->getMessage());
    }

    // Check for a couple v3 tables (don't bother doing this in setup)
    $requiredTables = array(
      'se_pms',
      'se_users',
    );

    foreach( $requiredTables as $requiredTable ) {
      $sql = 'SHOW TABLES LIKE ' . $this->_fromDb->quote($requiredTable);
      $ret = $this->_fromDb->query($sql)->fetchColumn(0);
      if( empty($ret) ) {
        return $form->addError('Version 3 database missing required table: ' . $requiredTable);
      }
    }

    // Store config locations in cache
    $this->_cache->save($values['path'], 'fromPath');
    $this->_cache->save(APPLICATION_PATH, 'toPath');
    $this->_cache->save($params, 'params');
    $this->_cache->save(microtime(true), 'startTime');
    $this->_cache->save((array) $values['disabledSteps'], 'disabledSteps');


    
    
    // Do import

    // Split mode
    if( $values['mode'] == 'split' ) {
      $this->view->token = $token = md5(time() . get_class($this) . rand(1000000, 9999999));
      $this->_cache->save($token, 'token');
      return $this->_helper->viewRenderer->setScriptAction('version3-split');
    }

    // All-at-once mode
    else {
      // Set time limit
      $importStartTime = time();
      set_time_limit(0);

      //$params = array();
      $messages = array();
      $hasError = false;
      $hasWarning = false;
      foreach( $this->_getAllMigrators($this->_platform, $params, $values['disabledSteps']) as $migrator ) {
        if( in_array(array_pop(explode('_', get_class($migrator))), (array) @$values['disabledSteps']) ) continue;
        
        $migrator->run();
        $messages = array_merge($messages, $migrator->getMessages());
        $hasError |= $migrator->hasError();
        $hasWarning |= $migrator->hasWarning();
        unset($migrator);
      }

      $importEndTime = time();
      $importDeltaTime = $importEndTime - $importStartTime;

      $this->view->status = 1;
      $this->view->messages = $messages;
      $this->view->hasError = $hasError;
      $this->view->hasWarning = $hasWarning;
      $this->view->form = null;
      $this->view->importDeltaTime = $importDeltaTime;
    }
  }

  public function version3RemoteAction()
  {
    // Set platform
    $this->_platform = 'version3';
    
    $starttime = microtime(true);
    set_time_limit(0);
    


    // Check token
    $token = $this->_cache->load('token');
    if( $token !== $this->_getParam('token') ) {
      echo Zend_Json::encode(array(
        'status' => false,
        'error' => 'Bad token',
      ));
      die();
    }




    // Check cache
    if( !$this->_cache ) {
      echo Zend_Json::encode(array(
        'status' => false,
        'error' => 'No cache',
      ));
      die();
    }




    // Setup
    try {
      $this->_setupVersion3($this->_cache->load('fromPath'), $this->_cache->load('toPath'));
    } catch( Exception $e ) {
      echo Zend_Json::encode(array(
        'status' => false,
        'error' => $e->getMessage(),
      ));
      exit();
    }



    // Params
    if( false == ($params = $this->_cache->load('params')) || !is_array($params) ) {
      $params = array();
    }
    
    $disabledSteps = (array) $this->_cache->load('disabledSteps');


    
    // Check for index or build if not found
    if( false == ($index = $this->_cache->load('objectindex')) ) {
      $index = array();
      $migrators = $this->_getAllMigrators($this->_platform, $params, $disabledSteps);
      foreach( $migrators as $migrator ) {
        $class = get_class($migrator);
        $key = 'object' . $class;
        $index[] = $key;
        $this->_cache->save($migrator, $key);
      }
      $this->_cache->save($index, 'objectindex');
    }




    // Check for the last migrator executed
    if( false == ($last = $this->_cache->load('objectlast')) ) {
      $last = 0;
    }



    // Calculate time running
    $startTime = $this->_cache->load('startTime');
    $endTime = microtime(true);
    $deltaTime = $endTime - $startTime;
    $hours = floor($deltaTime / 3600);
    $minutes = floor(($deltaTime % 3600) / 60);
    $seconds = floor((($deltaTime % 3600) % 60));

    $deltaTimeStr = '';
    $deltaTimeStr .= $this->view->translate(array('%d hour', '%d hours', $hours), $hours);
    $deltaTimeStr .= ', ';
    $deltaTimeStr .= $this->view->translate(array('%d minute', '%d minutes', $minutes), $minutes);
    $deltaTimeStr .= ', ';
    $deltaTimeStr .= $this->view->translate(array('%d second', '%d seconds', $seconds), $seconds);
    $deltaTimeStr .= ' (';
    $deltaTimeStr .= $this->view->translate(array('%s second total', '%s seconds total', $deltaTime), number_format($deltaTime));
    $deltaTimeStr .= ') ';



    
    // Check if we're done
    if( $last >= count($index) ) {
      echo Zend_Json::encode(array(
        'status' => true,
        'complete' => true,
        'error' => 'Complete',
        'hasError' => $this->_cache->load('haserror'),
        'hasWarning' => $this->_cache->load('haswarning'),
        'deltaTime' => $deltaTime,
        'deltaTimeStr' => $deltaTimeStr,
        'migratorCurrent' => $last + 1,
        'migratorTotal' => count($index),
      ));
      die();
    }




    // Get the migrator
    $key = $index[$last];
    $migrator = $this->_cache->load($key);
    if( !$migrator instanceof Install_Import_Abstract ) {
      echo Zend_Json::encode(array(
        'status' => false,
        'error' => 'Missing migrator',
      ));
      die();
    }




    // Repopulate config
    $migrator->setOptions(array(
      'fromDb' => $this->_fromDb,
      'toDb' => $this->_toDb,
      'fromPath' => $this->_fromPath,
      'toPath' => $this->_toPath,
      'cache' => $this->_cache,
      'batchCount' => 500,
      'params' => $params,
    ));




    // Run migrator (if not disabled)
    if( !in_array(array_pop(explode('_', get_class($migrator))), $disabledSteps) ) {
      $migrator->run();
    }




    // Check if migrator is done
    if( $migrator->isComplete() ) {
      // Use next in next request
      $last++;
      $this->_cache->save($last, 'objectlast');
    }



    // Put the migrator back
    $this->_cache->save($migrator, $key);



    // Store error/warning flags for later
    if( $migrator->hasError() ) {
      $this->_cache->save(true, 'haserror');
    }
    if( $migrator->hasWarning() ) {
      $this->_cache->save(true, 'haswarning');
    }


    // Send back progress report
    echo Zend_Json::encode(array(
      'status' => true,
      'className' => get_class($migrator),
      'hasError' => $migrator->hasError(),
      'hasWarning' => $migrator->hasWarning(),
      'messages' => $migrator->getMessages(),
      'deltaTime' => $deltaTime,
      'deltaTimeStr' => $deltaTimeStr,
      'migratorCurrent' => $last + 1,
      'migratorTotal' => count($index),
    ));



    exit();
  }



  // Ning
  
  public function ningInstructionsAction()
  {
    $this->view->dbHasContent = $this->_dbHasContent();
  }

  public function ningAction()
  {
    $this->_platform = 'ning';

    $this->view->form = $form = new Install_Form_Import_Ning();

    if( !$this->getRequest()->isPost() ) {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }

    $values = $form->getValues();

    $path = $values['path'];
    if( !file_exists($path . '/ning-members.json') ) {
      return $form->addError('Ning json data was not detected in the specified path');
    }

    $this->_fromPath = $path;
    $this->_toDb = Zend_Registry::get('Zend_Db');
    $this->_toPath = APPLICATION_PATH;

    $params = array(
      'passwordRegeneration' => $values['passwordRegeneration'],
      'mailFromAddress' => $values['mailFromAddress'],
      'mailSubject' => $values['mailSubject'],
      'mailTemplate' => $values['mailTemplate'],
    );
    
    // Set time limit
    set_time_limit(0);

    $messages = array();
    $hasError = false;
    foreach( $this->_getAllMigrators($this->_platform, $params) as $migrator ) {
      $migrator->run();
      $messages = array_merge($messages, $migrator->getMessages());
      $hasError |= $migrator->hasError();
      unset($migrator);
    }

    $this->view->status = 1;
    $this->view->messages = $messages;
    $this->view->hasError = $hasError;
    $this->view->form = null;
  }

  protected function _listMigrators($platform)
  {
    $types = array();
    $path = APPLICATION_PATH . '/install/import/' . ucfirst($platform);
    foreach( scandir($path) as $child ) {
      if( strlen($child) <= 4 ) continue;
      if( substr($child, -4) !== '.php' ) continue;
      if( stripos($child, 'Abstract') !== false ) continue;
      $types[] = substr($child, 0, -4);
    }
    return $types;
  }

  protected function _getAllMigrators($platform, array $params = array(), array $disabledSteps = array())
  {
    $migrators = array();
    $priorities = array();
    //$requires = array();
    foreach( $this->_listMigrators($platform) as $type ) {
      if( in_array($type, $disabledSteps) ) continue;
      $migrator = $this->_getMigrator($platform, $type, $params);
      $priorities[$type] = $migrator->getPriority();
      //$requires[$type] = $migrator->getRequires();
      //if( !is_array($requires[$type]) || count($requires[$type]) < 1 ) {
      //  unset($requires[$type]);
      //}
      $migrators[$type] = $migrator;
    }
    arsort($priorities);

    $sortedMigrators = array();
    foreach( $priorities as $type => $priority ) {
      $sortedMigrators[] = $migrators[$type];
    }

    return $sortedMigrators;
  }

  /**
   * @param string $platform
   * @param string $type
   * @return Install_Import_Abstract
   */
  protected function _getMigrator($platform, $type, array $params = array())
  {
    $class = 'Install_Import_' .
      ucfirst($platform) . '_' .
      str_replace(' ', '', ucwords(trim(preg_replace('/[^a-zA-Z0-9_]+/', ' ', $type))));
    
    if( !class_exists($class, false) ) {
      $autoloader = Zend_Registry::get('Autoloader');
      $autoloader->autoload($class);
      if( !class_exists($class, false) ) {
        throw new Engine_Exception('Class not found: ' . $class);
      }
    }

    return new $class(array(
      'fromDb' => $this->_fromDb,
      'toDb' => $this->_toDb,
      'fromPath' => $this->_fromPath,
      'toPath' => $this->_toPath,
      'cache' => $this->_cache,
      'params' => $params,
    ));
  }





  // More utility
  
  protected function _setupVersion3($fromPath, $toPath)
  {
    // Check from path exists
    if( !is_dir($fromPath) ) {
      throw new Engine_Exception('Specified path is not a version 3 installation');
    }

    // Check to path exists
    if( !is_dir($toPath) ) {
      throw new Engine_Exception('Specified path is not a version 4 installation');
    }

    // Check from database config file
    $fromDbConfigFile = $fromPath . '/include/database_config.php';
    if( !is_file($fromDbConfigFile) ) {
      throw new Engine_Exception('Version 3 database config was not found.');
    }

    // Check to database config file
    $toDbConfigFile = $toPath . '/application/settings/database.php';
    if( !is_file($toDbConfigFile) ) {
      throw new Engine_Exception('Version 4 database config was not found.');
    }
    
    // Get from database config
    $fromDbConfig = $this->_importValues($fromDbConfigFile);
    if( !$fromDbConfig ||
        !is_array($fromDbConfig) ||
        empty($fromDbConfig['database_host']) ||
        empty($fromDbConfig['database_username']) ||
        empty($fromDbConfig['database_password']) ||
        empty($fromDbConfig['database_name']) ) {
      throw new Engine_Exception('Invalid version 3 database configuration.');
    }

    // Get to database config
    $toDbConfig = include $toDbConfigFile;
    if( !is_array($toDbConfig) ||
        empty($toDbConfig['adapter']) ||
        empty($toDbConfig['params']) ) {
      throw new Engine_Exception('Invalid version 4 database configuration.');
    }

    // Make from adapter and check connection
    $fromDbConfig = array(
      'adapter' => $toDbConfig['adapter'],
      'params' => array(
        'host' => $fromDbConfig['database_host'],
        'username' => $fromDbConfig['database_username'],
        'password' => $fromDbConfig['database_password'],
        'dbname' => $fromDbConfig['database_name'],
        'charset' => $toDbConfig['params']['charset'],
        'adapterNamespace' => $toDbConfig['params']['adapterNamespace'],
      ),
    );
    try {
      $fromDb = Zend_db::factory($fromDbConfig['adapter'], $fromDbConfig['params']);
      $fromDb->getServerVersion(); // Forces connection
    } catch( Exception $e ) {
      throw new Engine_Exception('Database connection error: ' . $e->getMessage());
    }

    // Make to adapter and check connection
    try {
      $toDb = Zend_db::factory($toDbConfig['adapter'], $toDbConfig['params']);
      $toDb->getServerVersion(); // Forces connection
    } catch( Exception $e ) {
      throw new Engine_Exception('Database connection error: ' . $e->getMessage());
    }

    // Save all info for later
    $this->_fromDb = $fromDb;
    $this->_fromPath = $fromPath;
    $this->_toDb = $toDb;
    $this->_toPath = $toPath;
  }

  protected function _importValues($file)
  {
    include $file;
    return array_diff_key(get_defined_vars(), $GLOBALS, array('file' => null));
  }

  protected function _dbHasContent()
  {
    // Check for db
    $db = Zend_Registry::get('Zend_Db');
    if( !($db instanceof Zend_Db_Adapter_Abstract) ) {
      throw new Engine_Exception('SocialEngine has not yet been installed.');
    }
    
    $limits = array(
      'engine4_users' => 1,
      'engine4_activity_actions' => 10,
      'engine4_album_albums' => 0,
      'engine4_blog_blogs' => 0,
      'engine4_classified_classifieds' => 0,
      'engine4_event_events' => 0,
      //'engine4_forum_forums'
      'engine4_group_groups' => 0,
      'engine4_music_playlist_songs' => 0,
      'engine4_poll_polls' => 0,
      'engine4_video_videos' => 0,
    );

    foreach( $limits as $table => $limit ) {
      try {
        // Check if table exists
        $col = $db->query('SHOW TABLES LIKE ' . $db->quote($table))->fetchColumn(0);
        if( !$col ) {
          continue;
        }

        // Get count
        $count = $db->select()
          ->from($table, new Zend_Db_Expr('COUNT(*)'))
          ->query()
          ->fetchColumn(0)
          ;

        if( $count > $limit ) {
          return true;
        }

      } catch( Exception $e ) {
        // Silence
      }
    }

    return false;
  }
}