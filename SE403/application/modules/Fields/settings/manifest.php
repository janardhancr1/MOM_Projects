<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 7242 2010-09-01 01:21:10Z john $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'fields',
    'version' => '4.0.3',
    'revision' => '$Revision: 7242 $',
    'path' => 'application/modules/Fields',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Fields',
      'description' => 'Fields',
      'author' => 'Webligo Developments',
      'changeLog' => array(
        '4.0.3' => array(
          'Model/DbTable/Options.php' => 'ENUM/SET columns in search table get updated when options are added',
          'Model/DbTable/Search.php' => 'Proper handling of search bit',
          'settings/manifest.php' => 'Incremented version',
          'settings/my.sql' => 'Incremented version',
        ),
        '4.0.2' => array(
          'Controller/AdminAbstract.php' => 'Fixed problem that would prevent populating form elements for extra configuration options',
          'Form/Search.php' => 'Fixes age search to use minimum age',
          'Form/Standard.php' => 'Missing translation; fixed problem when used as a subform',
          'settings/manifest.php' => 'Increment version',
          'View/Helper/FieldFacebook.php' => 'Fixed improper display of value',
          'views/scripts/_jsAdmin.tpl' => 'Nested dependent fields now display properly',
        ),
        '4.0.1' => array(
          'Controller/AdminAbstract.php' => 'Fixed error caused when trying to link field to parent when it had already been linked; cache is flushed on changing of order',
          'Form/Search.php' => 'Required caused field to be required on search; fixed improper inflection on field types',
          'Model/DbTable/Abstract.php' => 'Added public flushCache method',
          'Model/DbTable/Maps.php' => 'Field is now deleted when last map is removed',
          'Model/DbTable/Search.php' => 'Fixed "typo" that would cause search index to not get removed on field deletion',
          'settings/manifest.php' => 'Incremented version',
          'View/Helper/FieldFacebook.php' => 'Fixed bad rendering of facebook link when given a URL instead of a profile name',
        ),
      ),
    ),
    'actions' => array(
       'install',
       'upgrade',
       'refresh',
       //'enable',
       //'disable',
     ),
    'callback' => array(
      'class' => 'Engine_Package_Installer_Module',
      'priority' => 3500,
    ),
    'directories' => array(
      'application/modules/Fields',
    ),
    'files' => array(
      'application/languages/en/fields.csv',
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  // Items ---------------------------------------------------------------------
  // Routes --------------------------------------------------------------------
  'routes' => array(
    'fields_admin_settings_general' => array(
      'route' => 'admin/settings/fields/',
      'defaults' => array(
          'module' => 'fields',
          'controller' => 'admin',
          'action' => 'index'
      )
    )
  )
) ?>