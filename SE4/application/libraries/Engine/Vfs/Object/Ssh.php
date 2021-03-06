<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Vfs
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Ssh.php 6213 2010-06-09 06:04:50Z john $
 * @author     John Boehr <j@webligo.com>
 */

/**
 * @category   Engine
 * @package    Engine_Vfs
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John Boehr <j@webligo.com>
 */
class Engine_Vfs_Object_System extends Engine_Vfs_Object_Abstract
{
  public function open($mode = 'r')
  {
    $qPath = 'ssh2.sftp://' . $this->_adapter->getSftpResource() . $this->_path;

    $resource = fopen($qPath, $mode);
    if( !$resource ) {
      throw new Engine_Vfs_File_Exception(sprintf('Unable to open file "%s" in mode "%s"', $filename, $mode));
    }

    $this->_resource = $resource;
    return $this;
  }

  public function close()
  {
    $ret = fclose($this->getResource());
    $this->_resource = null;
    return $ret;
  }

  public function end()
  {
    return feof($this->getResource());
  }

  public function flush()
  {
    return fflush($this->getResource());
  }

  public function read($length)
  {
    return fread($this->getResource(), $length);
  }

  public function rewind()
  {
    return rewind($this->getResource());
  }

  public function seek($offset, $whence = SEEK_SET)
  {
    return fseek($this->getResource(), $offset, $whence);
  }

  public function stat()
  {
    return fstat($this->getResource());
  }

  public function tell()
  {
    return ftell($this->getResource());
  }

  public function truncate($size)
  {
    return ftruncate($this->getResource(), $size);
  }

  public function write($string, $length = null)
  {
    if( null === $length ) {
      return fwrite($this->getResource(), $string);
    } else {
      return fwrite($this->getResource(), $string, $length);
    }
  }
}