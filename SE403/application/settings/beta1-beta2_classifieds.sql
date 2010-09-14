/**
 * SocialEngine
 *
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: beta1-beta2_classifieds.sql 7244 2010-09-01 01:49:53Z john $
 */
ALTER TABLE `engine4_classified_classifieds` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;
UPDATE `engine4_classified_fields_meta` SET config = '{"unit":"USD"}' WHERE field_id = 2;
UPDATE `engine4_classified_fields_meta` SET `type` = 'location' WHERE field_id = 3;
