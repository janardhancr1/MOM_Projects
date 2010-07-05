<?php
/**
 * SocialEngine
 *
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: session.php 6570 2010-06-24 00:50:18Z shaun $
 */
defined('_ENGINE') or die('Access Denied'); return array(
  'options' => array(
    'save_path' => 'session',
    'use_only_cookies' => true,
    'remember_me_seconds' => 864000,
    'gc_maxlifetime' => 86400,
  ),
  'saveHandler' => array(
    'class' => 'Core_Model_DbTable_Session',
    'params' => array(
      'lifetime' => 86400,
    ),
  )
) ?>