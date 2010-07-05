<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Comet
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Comet.php 6590 2010-06-25 19:40:21Z john $
 */

/**
 * @category   Engine
 * @package    Engine_Comet
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Engine_Comet
{
  // Constants
  const TYPE_GECKO = 1;
  const TYPE_OPERA = 2;
  const TYPE_TRIDENT = 3;
  const TYPE_OTHER = 4;

  const MODE_SHORT = 'short';
  const MODE_LONG = 'long';
  const MODE_COMET = 'comet';

  /**
   * Contains the run mode
   * 
   * @var integer
   */
  protected $_type;

  /**
   * Polling mode (short, long, comet)
   * 
   * @var string
   */
  protected $_mode;

  /**
   * The instance name
   * 
   * @var string
   */
  protected $_name;

  /**
   * The loop delay
   * 
   * @var integer
   */
  protected $_delay = 1000;

  /**
   * Body segments to return
   * 
   * @var array
   */
  protected $_body = array();

  /**
   * The number of times data has been sent
   * @var integer
   */
  protected $_count = 0;

  /**
   * The registered handlers
   * 
   * @var array
   */
  protected $_handlers = array();

  /**
   * Constructor
   *
   * @param array $options The options to set
   */
  public function __construct(array $options = array())
  {
    if( !empty($options['type']) ){
      $this->_type = $options['type'];
    } else {
      $this->_type = self::TYPE_GECKO;
    }

    if( !empty($options['mode']) ) {
      $this->_mode = $options['mode'];
    } else {
      $this->_mode = self::MODE_SHORT;
    }

    if( !empty($options['name']) ){
      $this->_name = $options['name'];
    } else {
      $this->_name = 'MooComet';
    }

    if( !empty($options['delay']) ) {
      $this->_delay = round($options['delay']);
    } else {
      $this->_delay = 1000;
    }

    $autoRun = !empty($options['autoRun']);

    // Register handlers
    if( !empty($options['handlers']) ) {
      $this->addHandlers($options['handlers']);
    }

    // Send headers if necessary/possible
    $sendHeaders = false;
    if( !headers_sent() ) {
      header('Cache-Control: private, no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
      header('Expires:  Mon, 26 Jul 1997 05:00:00 GMT');
      header('Pragma: no-cache');
      $sendHeaders = true;
    }

    if( !headers_sent() && $this->_type == 2 ) {
      header("Content-type: application/x-dom-event-stream");
      $sendHeaders = true;
    }
    
    if( $sendHeaders ) flush();
    
    // Auto Run
    if( $autoRun ) {
      $this->run();
    }
  }

  /**
   * Runs comet
   */
  public function run()
  {
    $sent = false;
    $state = 0;
    $start = false;
    $aborted = false;
    $start = time();
    $limit = 0;
    
    if( $this->_mode !== self::MODE_COMET ) {
      $limit = 30;
    }

    set_time_limit($limit + ceil($this->_delay / 1000) + 1);
    ignore_user_abort(false);
    register_shutdown_function(array($this, 'shutdown'));
    while( ob_get_level() > 0 ) @ob_end_flush();
    flush();
    
    do {
      // Delay
      $start ? usleep($this->_delay * 1000) : $start = true;
      // Loop
      $sent = (bool) $this->loop();
      // Should we quit?
      if( $this->_mode != self::MODE_COMET && ($sent || $this->_mode == self::MODE_SHORT) ) {
        $sent = true;
      }
      // Connection state
      $state = connection_status();
      $aborted = connection_aborted();
      $time = time();

      // Debug
      //$fh = fopen(APPLICATION_PATH . '/temporary/log/comet.log', 'a');
      //fwrite($fh, var_export(getmypid(), true) . ' - ' . var_export($state, true) . ' - ' . var_export($aborted, true) . "\n");
      //fclose($fh);
    } while ( $sent == false && $state == 0 && $aborted != true && ($limit != 0 && $time < $start + $limit) );

    // Make sure some data is sent
    if( $this->_count == 0 ) {
      $this->push(Zend_Json::encode(null));
    }
  }

  public function shutdown()
  {
  }

  /**
   * Main comet loop
   * 
   * @return boolean to quit
   */
  public function loop()
  {
    $sent = false;

    foreach( $this->_handlers as $name => $handler )
    {
      $data = $handler->runComet();
      if( $data )
      {
        $sent = true;
        $this->setBody($data, $name);
      }
    }

    // Send body
    if( !empty($this->_body) )
    {
      $this->push(Zend_Json::encode($this->_body));
      $this->_body = array();
    }

    return $sent;
  }



  // Data

  public function setBody($data, $name = null)
  {
    if( null === $name )
    {
      $name = 'default';
    }
    $this->_body[$name] = $data;
    return $this;
  }

  /**
   * Push data to the client
   * 
   * @param mixed $data The data to send
   * @return Engine_Comet
   */
  public function push($data)
  {
    $this->_count++;
    
    switch( $this->_type )
    {
      case 1:
        echo "<end />".$data;
        echo /* str_pad('',4096). */ "\n"; // Why was this being padded? To force buffer flush?
        break;

      case 2:
        print "Event: {$this->_name}\n";
        print "data: $data\n\n";
        break;

      case 3:
        print "<script type=\"text/javascript\">parent._cometObject.onRecvData('$data');</script>";
        //print "<script type=\"text/javascript\">parent._cometObject.fireEvent('onPush', ['$data']);</script>";
        break;

      case 4:
        print "<script type=\"text/javascript\">parent._cometObject.onChange('$data');</script>";
        break;
    }

    if( ob_get_level() )
    {
      ob_flush();
    }
    
    flush();

    usleep(10000); // sleep 10ms to unload the CPU

    return $this;
  }


  // Handlers

  public function addHandler(Engine_Comet_Handler_Interface $handler)
  {
    $name = $handler->getName();
    $this->_handlers[$name] = $handler;
    return $this;
  }

  public function addHandlers(array $handlers)
  {
    foreach( $handlers as $handler )
    {
      $this->addHandler($handler);
    }
    
    return $this;
  }
};
