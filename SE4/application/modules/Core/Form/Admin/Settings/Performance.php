<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Performance.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Form_Admin_Settings_Performance extends Engine_Form
{
  public function init()
  {
    // Set form attributes
    $this->setTitle('Performance & Caching');
    $this->setDescription('For very large social networks, it may be necessary 
      to enable caching to improve performance. If there is a noticable decrease
      in performance on your social network, consider enabling caching below (or
      upgrading your hardware). Caching takes some load off the database server
      by storing commonly retrieved data in temporary files (file-based caching)
      or memcached (memory-based caching). If you are not familiar with caching,
      we do not recommend that you change any of these settings.');

    if (APPLICATION_ENV != 'production') {
      $this->addError('Note: your site is currently not in production mode, so caching will be disabled irregardless of these settings.');
    }

    $this->addElement('Radio', 'enable', array(
      'label' => 'Use Cache?',
      'description' => 'Enable caching? Enabling caching will decrease the CPU
          usage of your database server (resulting in a decrease of page load
          times). While some non-critical data may appear slightly out of date,
          this will usually not be noticable to users. For example, some of the
          general site statistics on your homepage may take longer to update.
          This will not be noticable if your social network is already large and
          populated with a lot of data.',
      'required' => true,
      'multiOptions' => array(
        1 => 'Yes, enable caching.',
        0 => 'No, do not enable caching.',
      ),
    ));

    $this->addElement('Text', 'lifetime', array(
      'label' => 'Cache Lifetime',
      'description' => 'If you have enabled caching above, please select the type of caching that you want to use. Memcache caching (if available) will use memory (RAM) which is not as abundant as disk space, however it will be faster than file-based caching when performing read/write operations.',
      'size' => 5,
      'maxlength' => 4,
      'required' => true,
      'allowEmpty' => false,
      'validators' => array(
        array('NotEmpty', true),
        array('Int'),
      ),
    ));

    $this->addElement('Radio', 'type', array(
      'label' => 'Caching Feature',
      'description' => 'If you have enabled caching above, please select the type of caching that you want to use. Memcache caching (if available) will use memory (RAM) which is not as abundant as disk space, however it will be faster than file-based caching when performing read/write operations.',
      'required' => true,
      'allowEmpty' => false,
      'multiOptions' => array(
        'File'      => 'File-based',
        'Memcached' => 'Memcache',
        'Apc'       => 'APC',
        'Xcache'    => 'Xcache',
      ),//Zend_Cache::$standardBackends,
      'onclick' => 'updateFields();',
    ));

    $this->addElement('Text', 'file_path', array(
      'label' => 'File-based Cache Directory',
      'description' => 'This is where the temporary files containing the cached data are stored. Folder must be writable (chmod 777). This should be a path relative to the base directory where SocialEngine is installed.',
    ));

    $this->addElement('Checkbox', 'file_locking', array(
      'label' => 'File locking?',
      'description' => 'This is used to prevent two Apache processes from trying to write to the same file at the same time. Some operating systems may not support file locking.',
    ));

    $this->addElement('Text', 'memcache_host', array(
      'label' => 'Memcache Host',
      'description' => 'Can be a domain name, hostname, or an IP address (recommended)',
    ));

    $this->addElement('Text', 'memcache_port', array(
      'label' => 'Memcache Port',
    ));

    $this->addElement('Checkbox', 'memcache_compression', array(
      'label' => 'Memcache compression?',
      'title' => 'Title?',
      'description' => 'Compression will decrease the amount of memory used, however will increase processor usage.',
    ));


    $this->addElement('Text', 'xcache_username', array(
      'label' => 'Xcache Username',
    ));

    $this->addElement('Text', 'xcache_password', array(
      'label' => 'Xcache Password',
    ));

    $this->addElement('Checkbox', 'flush', array(
      'label' => 'Flush cache?',
    ));
    
    // init submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true,
    ));
  }

  public function populate($current_cache=array()) {

    $enabled = true;
    if (isset($current_cache['frontend']['core']['caching']))
      $enabled = $current_cache['frontend']['core']['caching'];
    $this->getElement('enable')->setValue($enabled);

    $backend = Engine_Cache::getDefaultBackend();
    if (isset($current_cache['backend'])) {
      $backend = array_keys($current_cache['backend']);
      $backend = $backend[0];
    }
    $this->getElement('type')->setValue($backend);

    $file_path = $current_cache['default_file_path'];
    if (isset($current_cache['backend']['File']['cache_dir']))
      $file_path = $current_cache['backend']['File']['cache_dir'];
    $this->getElement('file_path')->setValue( $file_path );

    $file_locking = 1;
    if (isset($current_cache['backend']['File']['file_locking']))
      $file_locking = $current_cache['backend']['File']['file_locking'];
    $this->getElement('file_locking')->setValue( $file_locking );

    $lifetime = 300; // 5 minutes
    if (isset($current_cache['frontend']['core']['options']['lifetime']))
      $lifetime = $current_cache['frontend']['core']['options']['lifetime'];
    $this->getElement('lifetime')->setValue($lifetime);

    $memcache_host = '127.0.0.1';
    $memcache_port = '11211';
    if (isset($current_cache['backend']['Memcache']['servers'][0]['host']))
      $memcache_host = $current_cache['backend']['Memcache']['servers'][0]['host'];
    if (isset($current_cache['backend']['Memcache']['servers'][0]['port']))
      $memcache_port = $current_cache['backend']['Memcache']['servers'][0]['port'];
    $this->getElement('memcache_host')->setValue($memcache_host);
    $this->getElement('memcache_port')->setValue($memcache_port);


  }
}