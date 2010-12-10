<?php
class Friendsinviter_Installer extends Engine_Package_Installer_Module
{
  function onInstall()
  {

    // ALTER IGNORE TABLE `engine4_users` ADD `user_referer` INT NOT NULL;

    $db     = $this->getDb();
    $select = new Zend_Db_Select($db);

    try {
      
      $db->query("ALTER TABLE `engine4_users` ADD `user_referer` INT NOT NULL;");
      
    } catch(Exception $ex) {
      
    }

    parent::onInstall();
  }
}
