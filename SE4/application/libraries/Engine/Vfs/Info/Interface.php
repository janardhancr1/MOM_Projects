<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Vfs
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Interface.php 6213 2010-06-09 06:04:50Z john $
 * @author     John Boehr <j@webligo.com>
 */

/**
 * @category   Engine
 * @package    Engine_Vfs
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John Boehr <j@webligo.com>
 */
interface Engine_Vfs_Info_Interface
{
  // General
  
  public function __construct(Engine_Vfs_Adapter_Interface $adapter, $path, array $info = null);

  public function getAdapter();

  public function reload();



  // Tree

  public function getParent();

  public function getChildren();


  
  // Path

  public function getPath();

  public function getBaseName();

  public function getDirectoryName();

  public function getRealPath();
  
  public function toString();

  public function __toString();



  // Other

  public function exists();
  
  public function getSize();

  public function isDirectory();

  public function isExecutable();

  public function isFile();

  public function isLink();

  public function isReadable();

  public function isWritable();



  // Object
  
  public function open($mode = 'r');
}