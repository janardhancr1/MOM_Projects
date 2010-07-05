/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: my-upgrade-4.0.0beta3-4.0.0rc1.sql 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
ALTER TABLE  `engine4_core_menuitems` CHANGE  `name`  `name` VARCHAR( 64 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;

INSERT IGNORE INTO  `engine4_core_menuitems` (
  `name` ,
  `module` ,
  `label` ,
  `plugin` ,
  `params` ,
  `menu` ,
  `submenu` ,
  `order`
) VALUES (
  'core_admin_main_settings_password',  'core',  'Admin Password',  '',  '{"route":"core_admin_settings","action":"password"}',  'core_admin_main_settings',  '',  9
);
