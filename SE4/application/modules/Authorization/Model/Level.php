<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Authorization
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Level.php 6636 2010-06-30 00:16:59Z jung $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Authorization
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Authorization_Model_Level extends Core_Model_Item_Abstract
{
  protected $_parent_type = 'user';

  //protected $_owner_type = 'user';

  protected $_searchColumns = array('title', 'body');

  protected $_parent_is_owner = true;
  
  // return the number of members of a given user level
  public function getMembershipCount(){
    // first relocate all the user with the id to the default
    $table = Engine_Api::_()->getDbtable('users', 'user');
    $userTableName = $table->info('name');
    $select = $table->select();
    $users = $table->fetchAll($select->where($userTableName.'.level_id = ?', $this->level_id));
    return count($users);
  }

  // get members
  public function getMembers(){
    // first relocate all the user with the id to the default
    $table = Engine_Api::_()->getDbtable('users', 'user');
    $userTableName = $table->info('name');
    $select = $table->select();
    $users = $table->fetchAll($select->where($userTableName.'.level_id = ?', $this->level_id));
    return $users;
  }

  // reassign members to default level
  public function reassignMembers(){
    $members = $this->getMembers();
    $default_level = Engine_Api::_()->getItemTable('authorization_level')->getDefaultLevel()->level_id;
    if (count($members)>0){
      foreach ($members as $member){
        $member->level_id = $default_level;
        $member->save();
      }
    }

    return;
  }


  // delete all permissions associated with this level
  public function removeAllPermissions(){
    $table = Engine_Api::_()->getDbtable('levels', 'authorization');
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $permissionTable = Engine_Api::_()->getDbtable('permissions', 'authorization');
      $select = $permissionTable->select()->where('level_id = ?', $this->level_id);
      $level_permissions = $permissionTable->fetchAll($select);

      // create permissions
      foreach( $level_permissions as $permission )
      {
        $permission->delete();
      }

      $db->commit();
      return;
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
  }

}