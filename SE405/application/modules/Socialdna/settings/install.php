<?php
class Socialdna_Installer extends Engine_Package_Installer_Module
{
  function onInstall()
  {

    $db     = $this->getDb();
    $select = new Zend_Db_Select($db);

    // footer
    $select
      ->from('engine4_core_pages')
      ->where('name = ?', 'footer')
      ->limit(1);
    $page_id = $select->query()->fetchObject()->page_id;

    // Check if it's already been placed
    $select = new Zend_Db_Select($db);
    $select
      ->from('engine4_core_content')
      ->where('page_id = ?', $page_id)
      ->where('type = ?', 'widget')
      ->where('name = ?', 'socialdna.boot');

    $info = $select->query()->fetch();
    if( empty($info) ) {

      // container_id (will always be there)
      $select = new Zend_Db_Select($db);
      $select
        ->from('engine4_core_content')
        ->where('page_id = ?', $page_id)
        ->where('type = ?', 'container')
        ->limit(1);
      $container_id = $select->query()->fetchObject()->content_id;

      // boot loader
      $db->insert('engine4_core_content', array(
        'page_id' => $page_id,
        'type'    => 'widget',
        'name'    => 'socialdna.boot',
        'parent_content_id' => $container_id,
        'order'   => 100,
      ));
      
    }

    parent::onInstall();
    
  }
  

  
  function _runCustomQueries()
  {

    $db     = $this->getDb();


    // Settings

    try {
    $db->insert('engine4_openid_settings',
                array('name'  => 'socialdna.facebook.invitemessage',
                      'value' => "[full_name] is a member of [site_name] and would like to share that experience with you. To register, simply click on the 'Register' button below.<fb:req-choice url='[signup_link]' label='Register'/>",
                      )
               );
    }
    catch(Exception $ex) {}

    try {
    $db->insert('engine4_openid_settings',
                array('name'  => 'socialdna.openid.imported.fields',
                      'value' => 'nickname,about_me,sex,activities,body_type,birthday,books,children,current_location_city,current_location_zip,current_location_country,current_location_state,drinker,ethnicity,first_name,heroes,hometown_location_city,hometown_location_zip,hometown_location_country,hometown_location_state,interests,last_name,locale,looking_for,movies,music,name,political,profile_url,quotes,relationship_status,religion,sex,smoker,tv,twitter_followers_count,friends_count,twitter_favourites_count,twitter_statuses_count,website,headline,recommenders,industry,summary,specialties,associations,honors,education_school,education_major,position_title,position_start_date,position_end_date,position_company',
                      )
               );
    }
    catch(Exception $ex) {}

    try {
    $db->insert('engine4_openid_settings',
                array('name'  => 'socialdna.signup.required.fields',
                      'value' => 'email,username,terms,1_1_3',
                      )
               );
    }
    catch(Exception $ex) {}


    $db->query("CREATE TABLE IF NOT EXISTS `engine4_openid_signupstats` (
  `openidstat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openidstat_time` int(10) unsigned NOT NULL,
  `openidstat_service_1` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_2` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_3` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_4` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_5` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_6` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_7` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_8` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_9` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_10` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_11` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_12` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_13` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_14` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_15` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_16` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_17` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_18` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_19` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_20` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_21` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_22` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_23` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_24` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_25` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_26` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_27` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_28` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_29` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_30` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_31` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_32` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_33` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_34` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_35` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_36` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_37` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_38` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_39` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_40` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`openidstat_id`),
  UNIQUE KEY `openidstat_time` (`openidstat_time`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ");

    return 1;
  }
  
}
