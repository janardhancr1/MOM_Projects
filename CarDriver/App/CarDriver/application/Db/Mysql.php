<?php
class Db_Mysql extends Zend_Db_Adapter_Abstract
{
	/**
     * Creates a connection to the database.
     *
     * @return void
     */
	public function _initDbAdapter()
	{
	   $parameters = array('host'     => 'localhost',
			       'username' => 'root',
			       'password' => 'kamflex',
			       'dbname'   => 'cardriver'
	      		      );
	   try
	   {
	   	$db = Zend_Db::factory('Pdo_Mysql', $parameters);
	 	$db->getConnection();
	   }
	   catch (Zend_Db_Adapter_Exception $e)
	   {
		echo $e->getMessage();
		die('Could not connect to database.');
	   }
	   catch (Zend_Exception $e)
	   {
		echo $e->getMessage();
		die('Could not connect to database.');
	   }
	   
	}
}
?>