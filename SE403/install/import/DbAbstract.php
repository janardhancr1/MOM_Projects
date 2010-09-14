<?php

abstract class Install_Import_DbAbstract extends Install_Import_Abstract
{
  protected $_fromDb;

  protected $_fromTable;

  protected $_fromJoins;

  protected $_fromJoinTable;

  protected $_fromJoinCondition;

  protected $_fromWhere;

  protected $_fromTableExists;

  protected $_selectCount = 100;

  protected $_runCount = 0;

  protected $_runComplete = false;



  public function __sleep()
  {
    return array_merge(parent::__sleep(), array(
      /*'_fromDb',*/ '_fromTable', '_fromJoins', '_fromJoinTable',
      '_fromJoinCondition', '_fromWhere', '_fromTableExists', '_selectCount',
      '_runCount', '_runComplete',
    ));
    // Need to reinit _fromDb - (parent) _toDb, _log, _cache
  }


  public function setFromDb(Zend_Db_Adapter_Abstract $fromDb)
  {
    $this->_fromDb = $fromDb;
    return $this;
  }

  /**
   * @return Zend_Db_Adapter_Abstract
   */
  public function getFromDb()
  {
    if( null === $this->_fromDb ) {
      throw new Engine_Exception('No from database');
    }
    return $this->_fromDb;
  }

  public function setFromTable($fromTable)
  {
    $this->_fromTable = $fromTable;
    return $this;
  }

  public function getFromTable()
  {
    if( null === $this->_fromTable ) {
      throw new Engine_Exception('No from table');
    }
    return $this->_fromTable;
  }

  public function getFromTableExists()
  {
    if( null === $this->_fromTable ) {
      return false;
    }
    if( null === $this->_fromTableExists ) {
      $this->_fromTableExists = $this->_tableExists($this->getFromDb(), $this->getFromTable());
    }
    return $this->_fromTableExists;
  }

  public function setSelectCount($selectCount)
  {
    $this->_selectCount = (int) $selectCount;
    return $this;
  }

  public function getSelectCount()
  {
    if( !is_int($this->_selectCount) || $this->_selectCount <= 0 ) {
      $this->_selectCount = 100;
    }
    return $this->_selectCount;
  }



  // Custom

  public function init()
  {
    $this->_initPre();
    
    if( $this->_toTableTruncate ) {
      $this->_truncateToTable();
    }

    $this->_initPost();
  }

  public function run()
  {
    $this->_message('(START)', 2);

    // This is to trick things that overrode _run to be complete
    $this->_isComplete = true;

    try {

      $this->_runPre();
      $this->_run();
      $this->_runPost();

    } catch( Exception $e ) {
      $this->_error($e->getMessage(), 0);
    }
    
    $this->_message('(END)', 2);
  }

  protected function _run()
  {
    // We're done
    if( $this->_runComplete ) {
      return;
    }

    // Get from db/table, check if it exists
    try {
      $fromDb = $this->getFromDb();
      $fromTable = $this->getFromTable();
    } catch( Exception $e ) {
      return $this->_error($e);
    }

    $fromTables = array();
    $fromTables[] = $fromTable;
    $fromTables = array_merge($fromTables, array_keys((array) $this->_fromJoins));
    $fromTables[] = $this->_fromJoinTable;
    $fromTables = array_filter($fromTables);

    if( !$fromTables || empty($fromTables) || !is_array($fromTables) || count($fromTables) < 1 ) {
      $this->_error('No from table specified.', 0);
      return;
    }

    if( !$this->_tableExists($fromDb, $fromTables) ) {
      $this->_warning(sprintf('One of the source tables does not exist (%s). This usually means you did not have the plugin installed.', join(', ', $fromTables)), 0);
      return;
    }
    
    // Get to db/table, check if it exists
    try {
      $toDb = $this->getToDb();
      $toTable = $this->getToTable();
    } catch( Exception $e ) {
      return $this->_error($e);
    }

    if( !$this->_tableExists($toDb, $toTable) ) {
      $this->_warning(sprintf('One of the target tables does not exist (%s). This usually means you do not have the plugin installed.', $toTable), 0);
      return;
    }
    
    $this->_runComplete = $this->_isComplete = false;
    
    // stats
    $cTotal = 0;
    $cSuccess = 0;
    $cFail = 0;

    // Import
    $select = $fromDb->select();
    $select->from($fromTable);
    if( $this->_fromJoins && is_array($this->_fromJoins) ) {
      foreach( $this->_fromJoins as $table => $condition ) {
        $select->joinLeft($table, $condition);
      }
    } else if( $this->_fromJoinTable && $this->_fromJoinCondition ) {
      $select->joinLeft($this->_fromJoinTable, $this->_fromJoinCondition);
    }

    if( $this->_fromWhere && is_array($this->_fromWhere) ) {
      foreach( $this->_fromWhere as $cond => $value ) {
        $select->where($cond, $value);
      }
    }
    
    // Get ready to select
    $break = false;
    $currentRunCount = 0;
    
    $this->_message($select->__toString(), 2);

    // Select in batches of $this->_selectCount
    do {
      // Select
      $tmpSelect = clone $select;
      //$tmpSelect = new Zend_Db_Select();
      $dataSet = $tmpSelect->limit($this->getSelectCount(), $this->_runCount)
        ->query(Zend_Db::FETCH_ASSOC)
        ->fetchAll(Zend_Db::FETCH_ASSOC);

      // Nothing left
      if( !is_array($dataSet) || empty($dataSet) ) {
        $this->_runComplete = $this->_isComplete = true;
        $break = true;
        continue;
      }

      // Iterate over each item in batch
      foreach( $dataSet as $data ) {

        $cTotal++;

        try {

          $newData = $this->_translateRow($data);

          if( !empty($newData) && is_array($newData) ) {
            $toDb->insert($toTable, $newData);
          }

          $cSuccess++;

        } catch( Exception $e ) {

          $this->_error($e);

          $cFail++;

        }

      }

      // Prepare next round
      $num = count($dataSet);
      $this->_runCount += $num;
      $currentRunCount += $num;

      // Ran out of stuff
      if( $num < $this->getSelectCount() ) {
        $this->_runComplete = $this->_isComplete = true;
        $break = true;
      }
      // Finished the batch
      else if( null !== $this->getBatchCount( ) && $currentRunCount >= $this->getBatchCount() ) {
        $break = true;
      }


    } while( !$break );


    if( $cFail <= 0 ) {
      $this->_message(sprintf('Success - %d records imported.', $cSuccess), 1);
    } else {
      $this->_warning(sprintf('Failure - %d records imported, %d records failed.', $cSuccess, $cFail), 0);
    }
  }

}