<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Tasks.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Model_DbTable_Tasks extends Engine_Db_Table
{
  protected $_interval;
  
  protected $_key;

  protected $_mode;

  protected $_pid;

  protected $_timeout;


  protected $_externalKey;

  protected $_externalPid;

  protected $_isExecuting = false;

  protected $_isShutdownRegistered = false;


  protected $_executingTask;

  protected $_log;

  protected $_pendingTasks;

  protected $_tasks;

  

  // Config

  public function getInterval()
  {
    if( null === $this->_interval ) {
      $this->_interval = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.tasks.interval', 60);
    }
    return $this->_interval;
  }

  public function getKey()
  {
    if( null === $this->_key ) {
      $key = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.tasks.key');
      // Generate a new key
      if( !$key ) {
        $key = sprintf('%08x', (integer) sprintf('%u', crc32(time() . mt_rand(0, time()))));
        Engine_Api::_()->getApi('settings', 'core')->setSetting('core.tasks.key', $key);
      }
      $this->_key = $key;
    }
    return $key;
  }

  public function getMode()
  {
    if( null === $this->_mode ) {
      $this->_mode = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.tasks.mode', 'curl');
    }
    return $this->_mode;
  }
  
  public function getPid()
  {
    if( null === $this->_pid ) {
      $this->_pid = (integer) sprintf('%u', crc32(time() . mt_rand(0, time())));
    }
    return $this->_pid;
  }

  public function getTimeout()
  {
    if( null === $this->_timeout ) {
      $this->_timeout = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.tasks.timeout', 900);
    }
    return $this->_timeout;
  }

  public function setExternalKey($key)
  {
    $this->_externalKey = $key;
    return $this;
  }

  public function getExternalKey()
  {
    if( null === $this->_externalKey ) {
      if( isset($_GET['key']) ) {
        $key = $_GET['key'];
      } else if( isset($_POST['key']) ) {
        $key = $_POST['key'];
      } else if( isset($_COOKIE['key']) ) {
        $key = $_COOKIE['key'];
      } else {
        $key = false;
      }
      $this->_externalKey = $key;
    }
    return $this->_externalKey;
  }

  public function setExternalPid($pid)
  {
    $this->_externalPid = $pid;
    return $this;
  }

  public function getExternalPid()
  {
    if( null === $this->_externalPid ) {
      if( isset($_GET['pid']) ) {
        $pid = $_GET['pid'];
      } else if( isset($_POST['pid']) ) {
        $pid = $_POST['pid'];
      } else if( isset($_COOKIE['pid']) ) {
        $pid = $_COOKIE['pid'];
      } else {
        $pid = false;
      }
      $this->_externalPid = $pid;
    }
    return $this->_externalPid;
  }

  /**
   * Get our logger
   * 
   * @return Zend_Log
   */
  public function getLog()
  {
    if( null === $this->_log ) {
      $log = new Zend_Log();
      $log->addWriter(new Zend_Log_Writer_Stream(APPLICATION_PATH . '/temporary/log/tasks.log'));
      $this->_log = $log;
    }
    return $this->_log;
  }


  
  // Triggering

  public function shouldTrigger()
  {
    // Log
    if( APPLICATION_ENV == 'development' ) {
      $this->getLog()->log('Trigger Check: ' . $this->getPid(), Zend_Log::NOTICE);
    }

    // Get base interval
    $table = Engine_Api::_()->getDbtable('settings', 'core');
    $row = $table->fetchRow(array(
      'name = ?' => 'core.tasks.last',
    ));
    if( null === $row ) {
      $table->insert(array(
        'name' => 'core.tasks.last',
        'value' => rand(1, 1000),
      ));
      // Cancel if we're initializing
      return false;
    } else {
      $lastTrigger = $row->value;
    }

    // Get the pid
    $row = $table->fetchRow(array(
      'name = ?' => 'core.tasks.pid',
    ));
    $lastPid = ( !$row || empty($row->value) ? false : $row->value );

    // If we are still executing, make sure delta is larger than the ther interval or timeout
    if( $lastPid && time() < $lastTrigger + max($this->getInterval(), $this->getTimeout()) ) {
      return false;
    }
    // Otherwise, if empty, make sure delta is larger than the min of interval and timeout
    else if( !$lastPid && time() < $lastTrigger + min($this->getInterval(), $this->getTimeout()) ) {
      return false;
    }

    // Update last execution
    $affected = $table->update(array(
      'value' => time(),
    ), array(
      'name = ?' => 'core.tasks.last',
      'value = ?' => $lastTrigger,
    ));

    if( $affected !== 1 ) {
      return false;
    }

    // Update pid
    $table->update(array(
      'value' => $this->getPid(),
    ), array(
      'name = ?' => 'core.tasks.pid',
    ));

    // Log
    if( APPLICATION_ENV == 'development' ) {
      $this->getLog()->log('Trigger Pass: ' . $this->getPid(), Zend_Log::NOTICE);
    }
    
    // Okay, let's go!
    return true;
  }

  public function trigger()
  {
    if( !$this->shouldTrigger() ) {
      return $this;
    }

    $mode = $this->getMode();
    $method = '_trigger' . ucfirst($mode);

    // Unknown mode
    if( !method_exists($this, $method) ) {
      throw new Core_Model_Exception('Unsupported mode: ' . $mode);
    }

    $prev = ignore_user_abort(true);

    $this->$method();
    
    ignore_user_abort($prev);
    
    return $this;
  }

  protected function _triggerCurl()
  {
    global $generalConfig;
    $code = null;
    if( !empty($generalConfig['maintenance']['code']) ) {
      $code = $generalConfig['maintenance']['code'];
    }

    // Setup
    $host = $_SERVER['HTTP_HOST'];
    $addr = '127.0.0.1'; // $_SERVER['SERVER_ADDR']
    $port = ( !empty($_SERVER['SERVER_PORT']) ? (integer) $_SERVER['SERVER_PORT'] : 80 );
    $path = Zend_Controller_Front::getInstance()->getRouter()->assemble(array('controller' => 'utility', 'action' => 'tasks'), 'default', true)
      . '?notrigger=1'
      . '&key=' . $this->getKey()
      . '&pid=' . $this->getPid()
      ;
    $url = 'http://' . $host . $path;
    
    // Set options
    $multi_handle = curl_multi_init();
    $curl_handle = curl_init();

    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_PORT, $port);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Host: ' . $_SERVER['HTTP_HOST']));

    // Try to handle basic htauth
    if( !empty($_SERVER['PHP_AUTH_USER']) && !empty($_SERVER['PHP_AUTH_PW']) ) {
      curl_setopt($curl_handle, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($curl_handle, CURLOPT_USERPWD, $_SERVER['PHP_AUTH_USER'] . ':' . $_SERVER['PHP_AUTH_PW']);
    }

    // Try to handle maintenance mode
    if( $code ) {
      curl_setopt($curl_handle, CURLOPT_COOKIE, 'en4_maint_code=' . $code);
    }
    
    curl_multi_add_handle($multi_handle, $curl_handle);
    
    $active = null;
    //execute the handles
    do {
        $mrc = curl_multi_exec($multi_handle, $active);
    } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    
    /*
    while ($active && $mrc == CURLM_OK) {
        if (curl_multi_select($multi_handle) != -1) {
            do {
                $mrc = curl_multi_exec($multi_handle, $active);
            } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        }
    }
     * 
     */
  }

  protected function _triggerSocket()
  {
    global $generalConfig;
    $code = null;
    if( !empty($generalConfig['maintenance']['code']) ) {
      $code = $generalConfig['maintenance']['code'];
    }

    // Setup
    $host = $_SERVER['HTTP_HOST'];
    $addr = '127.0.0.1'; // $_SERVER['SERVER_ADDR']
    $port = ( !empty($_SERVER['SERVER_PORT']) ? (integer) $_SERVER['SERVER_PORT'] : 80 );
    $path = Zend_Controller_Front::getInstance()->getRouter()->assemble(array('controller' => 'utility', 'action' => 'tasks'), 'default', true)
      . '?notrigger=1'
      . '&key=' . $this->getKey()
      . '&pid=' . $this->getPid()
      ;
    $url = 'http://' . $host . $path;

    // Connect
    $handle = fsockopen($addr, $port, $errno, $errstr, 0.5);
    stream_set_blocking($handle, 1);
    if( !$handle ) {
      //echo "$errstr ($errno)<br />\n";
      return;
    } else {
      $out = "GET {$path} HTTP/1.1\r\n";
      $out .= "Host: {$host}\r\n";
      if( !empty($code) ) {
        $out .= "Cookie: en4_maint_code={$code}\r\n";
      }
      $out .= "Connection: Close\r\n\r\n";

      fwrite($handle, $out);

      // Can't close or the remote connection will cancel
      //fclose($handle);
    }
  }



  // Tasks

  public function getTasks()
  {
    if( null === $this->_tasks ) {
      $this->_tasks = $this->fetchAll();
    }
    return $this->_tasks;
  }

  public function getPendingTasks()
  {
    if( null === $this->_pendingTasks ) {
      // Let's also re-calculate the minimum interval
      $min = 86400;

      // Check all tasks
      $this->_pendingTasks = array();
      foreach( $this->getTasks() as $task ) {
        $min = min($min, $task->timeout);
        if( $this->shouldTaskExecute($task, false) ) {
          $this->_pendingTasks[] = $task;
        }
      }
      
      // Validate and update minimum interval, if necessary
      if( $min < 60 ) {
        $min = 60;
      } else if( $min > 86400 ) {
        $min = 86400;
      }
      if( $min != $this->getInterval() ) {
        $this->_interval = $min;
        Engine_Api::_()->getApi('settings', 'core')->setSetting('core.tasks.interval', $min);
      }
    }

    return $this->_pendingTasks;
  }

  public function hasPendingTasks()
  {
    return ( count($this->getPendingTasks()) > 0 );
  }



  // Execution

  public function shouldExecute()
  {
    // Log
    if( APPLICATION_ENV == 'development' ) {
      $this->getLog()->log('Execution Check: ' . $this->getPid(), Zend_Log::NOTICE);
    }

    // Check passkey
    if( $this->getExternalKey() != $this->getKey() ) {
      return false;
    }

    // Check pid/mode
    $dbPid = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.tasks.pid');
    if( $this->getMode() != 'none' && $this->getMode() != 'cron' && $this->getExternalPid() != $dbPid ) {
      return false;
    }

    // Check for pending tasks
    if( !$this->hasPendingTasks() ) {
      return false;
    }

    // Log
    if( APPLICATION_ENV == 'development' ) {
      $this->getLog()->log('Execution Pass: ' . $this->getPid(), Zend_Log::NOTICE);
    }

    return true;
  }
  
  public function execute()
  {
    $prev = ignore_user_abort(true);

    // Check if we should execute
    if( !$this->shouldExecute() ) {
      ignore_user_abort($prev);
      return $this;
    }
    
    // Register fatal error handler
    if( !$this->_isShutdownRegistered ) {
      register_shutdown_function(array($this, 'handleShutdown'));
      $this->_isShutdownRegistered = true;
    }

    // Signal execution start
    $this->_isExecuting = true;

    // Run pending tasks
    foreach( $this->getPendingTasks() as $task ) {
      // Check if they were run in the background while other tasks were executing
      if( $this->shouldTaskExecute($task) ) {
        $this->_executeTask($task);
      }
    }

    // Clear pid
    $table = Engine_Api::_()->getDbtable('settings', 'core');
    $table->update(array(
      'value' => '',
    ), array(
      'name = ?' => 'core.tasks.pid',
    ));

    // Signal execution end
    $this->_isExecuting = false;

    // Log
    if( APPLICATION_ENV == 'development' ) {
      $this->getLog()->log('Execution Complete: ' . $this->getPid(), Zend_Log::NOTICE);
    }

    // Restore
    ignore_user_abort($prev);

    return $this;
  }

  public function executeTask(Engine_Db_Table_Row $task)
  {
    // Register fatal error handler
    if( !$this->_isShutdownRegistered ) {
      register_shutdown_function(array($this, 'handleShutdown'));
      $this->_isShutdownRegistered = true;
    }

    // Signal execution start
    $this->_isExecuting = true;

    $this->_executeTask($task);
    
    // Signal execution end
    $this->_isExecuting = false;

    return $this;
  }
  
  protected function _executeTask(Engine_Db_Table_Row $task)
  {
    // Log
    if( APPLICATION_ENV == 'development' ) {
      $this->getLog()->log('Task Execution Check: ' . $task->title, Zend_Log::NOTICE);
    }

    // Update task using where (this will prevent double executions)
    $affected = $task->getTable()->update(array(
      'executing' => 1,
      'executing_id' => $this->getPid(),
      'started_last' => time(),
      'started_count' => new Zend_Db_Expr('started_count + 1'),
    ), array(
      'task_id = ?' => $task->task_id,
      'executing = ?' => 0,
      'executing_id = ?' => 0,
    ));

    // Refresh
    $task->refresh();
    
    // If not affected cancel
    if( $affected !== 1 ) {
      // $task->executing_id != $this->getPid()
      return $this;
    }

    // Log
    if( APPLICATION_ENV == 'development' ) {
      $this->getLog()->log('Task Execution Pass: ' . $task->title, Zend_Log::NOTICE);
    }
    
    // Set executing task
    $this->_executingTask = $task;

    $status = false;

    try
    {
      $plugin = Engine_Api::_()->loadClass($task->plugin);
      if( $plugin instanceof Core_Plugin_Task_Abstract ) {
        $plugin->execute();
      } else if( method_exists($plugin, 'executeTask') ) {
        $plugin->executeTask();
      } else {
        throw new Engine_Exception('Task ' . $task->plugin . ' does not have an execute or executeTask method');
      }
      $status = true;
    }
    catch( Exception $e )
    {
      $status = false;
    }

    // Update task
    $task->executing = false;
    $task->executing_id = 0;
    $task->completed_count++;
    $task->completed_last = time();
    if( $status ) {
      $task->success_count++;
      $task->success_last = time();
    } else {
      $task->failure_count++;
      $task->failure_last = time();
    }
    $task->save();
    
    // Remove executing task
    $this->_executingTask = null;

    // Log
    if( APPLICATION_ENV == 'development' ) {
      $this->getLog()->log('Task Execution Complete: ' . $task->title, Zend_Log::NOTICE);
    }

    return $this;
  }



  // Utility
  
  public function handleShutdown()
  {
    if( $this->_isExecuting ) {
      // This means there was a fatal error during execution
      $db = $this->getAdapter();

      // Log
      if( APPLICATION_ENV == 'development' ) {
        $this->getLog()->log('Execution Error: ' . $this->getPid(), Zend_Log::NOTICE);
      }
      
      // Let's call rollback just in case the fatal error happened inside a transaction
      // This will restore autocommit
      $db->rollBack();

      // Cleanup executing task
      if( $this->_executingTask instanceof Zend_Db_Table_Row_Abstract ) {
        $task = $this->_executingTask;
        // Cleanup executing task
        $task->executing = false;
        $task->executing_id = 0;
        $task->failure_count++;
        $task->failure_last = time();
        $task->completed_count++;
        $task->completed_last = time();
        $task->save();
      }
    }
  }
  
  public function shouldTaskExecute(Engine_Db_Table_Row $task, $refresh = true)
  {
    // Refresh to check if run in separate thread
    if( $refresh ) {
      $task->refresh();
    }
    // Don't start executing tasks unless they have been executing for > 15 minutes
    // We assume that 15 min means they have died and failed to cancel executing status
    if( $task->executing && (time() < $task->started_last + $this->getTimeout()) ) {
      // Update the task, assuming it has timed out
      $task->executing = false;
      $task->executing_id = 0;
      $task->save();
      return false;
    }
    // Tasks is not ready to be executed again yet
    if( time() < $task->started_last + $task->timeout ) {
      return false;
    }
    if( time() < $task->completed_last + $task->timeout ) {
      return false;
    }
    // Task is ready
    return true;
  }

  protected function _resetStats()
  {
    /*
UPDATE engine4_core_settings SET value='' WHERE name='core.tasks.pid';
UPDATE engine4_core_settings SET value='' WHERE name='core.tasks.last';
UPDATE engine4_core_tasks SET executing=0, executing_id=0, started_last=0,
  started_count=0, completed_last=0, completed_count=0, failure_last=0,
  success_last=0, success_count=0 WHERE 1;
     */
    $this->update(array(
      'executing' => 0,
      'executing_id' => 0,
      'started_last' => 0,
      'started_count' => 0,
      'completed_last' => 0,
      'completed_count' => 0,
      'failure_last' => 0,
      'failure_count' => 0,
      'success_last' => 0,
      'success_count' => 0,
    ), array(
      '1' => '1',
    ));
  }
}