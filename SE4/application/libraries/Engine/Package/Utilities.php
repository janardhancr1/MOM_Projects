<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Package
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Utilities.php 6450 2010-06-18 01:28:45Z john $
 * @author     John Boehr <j@webligo.com>
 */

/**
 * @category   Engine
 * @package    Engine_Filter
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John Boehr <j@webligo.com>
 */
class Engine_Package_Utilities
{
  // FTP Helpers

  /**
   * Factory method for PEAR/Net_FTP
   * 
   * @param array $options
   * @return Net_FTP
   * @throws Engine_Package_Exception
   */
  static public function ftpFactory($options)
  {
    self::ftpInclude();
    
    extract($options);
    
    // Check if anything is empty
    if( empty($host) || empty($username) || empty($password) ) {
      throw new Engine_Package_Exception('Partial data');
    }

    // Parse host/port
    if( empty($port) || !is_numeric($port) ) {
      @list($host, $port) = @explode(':', $host);
    } else {
      @list($host) = @explode(':', $host);
    }
    if( empty($port) ) {
      $port = 21;
    }

    // Create
    $ftp = new Net_FTP();

    // Connect
    $ret = $ftp->connect($host, $port);
    if( $ftp->isError($ret) ) {
      throw new Engine_Package_Exception('Unable to connect to FTP server');
    }

    // Login
    $ret = $ftp->login($username, $password);
    if( $ftp->isError($ret) ) {
      throw new Engine_Package_Exception('Unable to login to FTP server');
    }

    return $ftp;
  }
  
  static public function ftpSearch(Net_FTP $ftp, $pattern, $path = '/', $stopOnMatch = false)
  {
    self::ftpInclude();
    
    $results = array();

    // Check pattern type
    if( !is_array($pattern) && !is_string($pattern) ) {
      throw new Engine_Package_Exception('invalid pattern');
    }
    $type = ( is_array($pattern) ? 'list' : ( $pattern[0] == '/' ? 'regex' : 'name' ) );

    // Check path
    if( empty($path) ) {
      throw new Engine_Package_Exception('invalid path');
    }

    // Change dir
    $ret = $ftp->cd($path);
    if( $ftp->isError($ret) ) {
      throw new Engine_Exception($ret->getMessage(), $ret->getCode());
    }

    // List files
    $ret = $ftp->ls();
    if( $ftp->isError($ret) ) {
      throw new Engine_Exception($ret->getMessage(), $ret->getCode());
    }

    // Check files
    $dirs = array();
    foreach( $ret as $info ) {
      $fullPath = rtrim($path, '/') . '/' . $info['name'];
      // DEBUG
      //var_dump($fullPath);@flush();@ob_flush();
      if( $info['is_dir'] == 'd' ) {
        $dirs[] = $fullPath;
      }
      switch( $type ) {
        case 'list':
          if( in_array($info['name'], $pattern) ) {
            $results[] = $fullPath;
            if( $stopOnMatch ) {
              return $results;
            }
          }
          break;
        case 'regex':
          if( preg_match($pattern, $info['name']) ) { // We could use the full path here (to give access to subdirectories)
            $results[] = $fullPath;
            if( $stopOnMatch ) {
              return $results;
            }
          }
          break;
        case 'name':
          if( $pattern == $info['name'] ) {
            $results[] = $fullPath;
            if( $stopOnMatch ) {
              return $results;
            }
          }
          break;
        default:
          throw new Engine_Package_Exception('invalid pattern');
          break;
      }
    }

    // Recurse into directories
    foreach( $dirs as $dir ) {
      $safeDir = rtrim($dir, '/') . '/'; // Check to make sure this is correct
      try {
        $childResults = self::ftpSearch($ftp, $pattern, $safeDir);
        $results = array_merge($results, $childResults);
      } catch( Exception $e ) {
        continue; // @todo should we throw or ignore?
      }
    }

    return $results;
  }

  static public function ftpLsRecursive(Net_FTP $ftp, $dir, $mode = null)
  {
    self::ftpInclude();

    if( null === $mode ) {
      $mode = NET_FTP_DIRS_FILES;
    }

    // Ls
    $ret = $ftp->ls($dir, $mode);
    if( PEAR::isError($ret) ) {
      throw new Engine_Package_Exception($ret->getMessage());
    }

    $results = $ret;
    $subdirs = array();
    
    foreach( $results as &$result ) {
      $result['name'] = rtrim($dir, '/') . '/' . $result['name'];
      if( $result['is_dir'] == 'd' ) {
        $subdirs[] = $result['name'];
      }
    }

    foreach( $subdirs as $subdir ) {
      try {
        $childResults = self::ftpLsRecursive($ftp, $subdir . '/', $mode);
      } catch( Exception $e ) {
        continue; // @todo should we throw or ignore?
      }
      $results = array_merge($results, $childResults);
    }

    return $results;
  }

  static public function chmodRecursiveSoft(Net_FTP $ftp, $target, $permissions)
  {
    $stats = array('success' => 0, 'failure' => 0);

    // chmod target
    $ret = $ftp->chmod($target, $permissions);
    if( PEAR::isError($ret) ) {
      $stats['failure']++;
      //throw new Engine_Package_Exception($ret->getMessage());
    } else {
      $stats['success']++;
    }
    
    $files = self::ftpLsRecursive($ftp, $target);
    //var_dump($files);
    foreach( $files as $file ) {
      $ret = $ftp->chmod($file['name'], $permissions);
      if( PEAR::isError($ret) ) {
        $stats['failure']++;
        //throw new Engine_Package_Exception($ret->getMessage());
      } else {
        $stats['success']++;
      }
    }

    return $stats;
  }

  static public function ftpInclude()
  {
    // Create
    if( !function_exists('ftp_connect') ) {
      include_once 'Net/FTP/Socket.php';
      if( !function_exists('ftp_connect') ) {
        throw new Engine_Package_Exception('Unable to load ftp emulation layer.');
      }
    }
    if( !class_exists('Net_FTP', false) ) {
      include_once 'Net/FTP.php';
      if( !class_exists('Net_FTP', false) ) {
        throw new Engine_Package_Exception('Unable to load class Net_FTP.');
      }
    }
  }




  // Sql helpers

  static public function sqlSplit($sql)
  {
    $stripCommentsPattern = '~' . preg_quote('/**', '~') . '.+?' . preg_quote('*/', '~') . '~ms';
    $stripSingleLineCommentsPattern = '~[\n\r]+--[^\n\r]*~m';
    $stripExtraWhitespace = '~[\n\r]+~';

    $sql = preg_replace($stripCommentsPattern, '', $sql);
    $sql = preg_replace($stripSingleLineCommentsPattern, '', $sql);
    $sql = preg_replace($stripExtraWhitespace, "\n", $sql);

    $queries = preg_split("/;+(?=([^'|^\\\']*['|\\\'][^'|^\\\']*['|\\\'])*[^'|^\\\']*[^'|^\\\']$)/m", $sql);
    $queries = array_map('trim', $queries);
    $queries = array_filter($queries);
    
    return $queries;
  }








  // Fs helpers
  
  static public function fsCopyRecursive($source, $dest)
  {
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::KEY_AS_PATHNAME), RecursiveIteratorIterator::SELF_FIRST);
    foreach( $it as $item ) {
      $partial = str_replace($source, '', $item->getPathname());
      $fDest = rtrim($dest, '/\\') . $partial;
      // Ignore errors on mkdir (only fail if the file fails to copy
      if( $item->isDir() ) {
        @mkdir($fDest, $item->getPerms(), true);
      } else if( $item->isFile() ) {
        @mkdir(dirname($fDest), 755, true);
        if( !copy($item->getPathname(), $fDest) ) {
          throw new Engine_Package_Exception('Unable to copy.');
        }
      }
    }
  }
  
  static public function fsRmdirRecursive($path, $includeSelf = false)
  {
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::KEY_AS_PATHNAME), RecursiveIteratorIterator::CHILD_FIRST);
    foreach( $it as $key => $child ) {
      if( $child->getFilename() == '.' || $child->getFilename() == '..' ) {
        continue;
      }
      if( $it->isDir() ) {
        if( !rmdir($key) ) {
          throw new Engine_Package_Exception('Unable to remove directory');
        }
      } else if( $it->isFile() ) {
        if( !unlink($key) ) {
          throw new Engine_Package_Exception('Unable to remove directory');
        }
      }
    }

    if( is_dir($path) && $includeSelf ) {
      if( !rmdir($path) ) {
        throw new Engine_Package_Exception('Unable to remove directory');
      }
    }
  }
}