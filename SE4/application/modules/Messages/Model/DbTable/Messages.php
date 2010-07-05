<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Messages
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Messages.php 6519 2010-06-23 01:41:45Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Messages
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Messages_Model_DbTable_Messages extends Engine_Db_Table
{
  protected $_rowClass = 'Messages_Model_Message';
}