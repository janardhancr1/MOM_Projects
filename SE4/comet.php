<?php
/**
 * @package     Engine_Core
 * @version     $Id: comet.php 6574 2010-06-24 01:14:28Z shaun $
 * @copyright   Copyright (c) 2008 Webligo Developments
 * @license     See license.html
 */
define('APPLICATION_INCLUDE', true);

include dirname(__FILE__).DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'index.php';

$application->setOption('runMode', 'comet');
$application->bootstrap();
$application->run();
