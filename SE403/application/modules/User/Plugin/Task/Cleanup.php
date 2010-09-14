<?php

class User_Plugin_Task_Cleanup extends Core_Plugin_Task_Abstract
{
  public function execute()
  {
    // Garbage collect the online users table
    Engine_Api::_()->getDbtable('online', 'user')->gc();
  }
}