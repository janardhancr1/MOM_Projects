<?php
/**
 * SocialEngine
 *
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: database.sample.php 6570 2010-06-24 00:50:18Z shaun $
 */
defined('_ENGINE') or die('Access Denied'); return array(
  'adapter' => 'mysqli',
  'params' => array(
    'host' => "127.0.0.1",
    'username' => "db_username",
    'password' => "db_password",
    'dbname'   => "db_name",
    'charset'  => 'UTF-8',
    'adapterNamespace' => 'Zend_Db_Adapter',
  ),
  'isDefaultTableAdapter' => true,
  'tablePrefix' => "engine4_",
  'tableAdapterClass' => "Engine_Db_Table",
);
