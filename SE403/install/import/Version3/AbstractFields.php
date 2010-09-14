<?php

abstract class Install_Import_Version3_AbstractFields extends Install_Import_Version3_Abstract
{
  protected $_toTableTruncate = false;

  protected $_fromResourceType;

  protected $_fromAlternateResourceType;

  protected $_toResourceType;

  protected $_useProfileType = false;

  public function __sleep()
  {
    return array_merge(parent::__sleep(), array(
      '_fromResourceType', '_fromAlternateResourceType', '_toResourceType',
      '_useProfileType',
    ));
  }
  
  protected function _run()
  {
    $fromDb = $this->getFromDb();
    $toDb = $this->getToDb();

    $fromType = $this->_fromResourceType;
    $toType = $this->_toResourceType;
    $altFromType = $this->_fromAlternateResourceType;

    // Check all from tables exist
    $required_from_tables = array(
      'se_' . $fromType . 'cats',
      'se_' . $fromType . 'fields',
      'se_' . $fromType . 'values',
    );
    if( !$this->_tableExists($fromDb, $required_from_tables) ) {
      $this->_message(sprintf('One of the source tables does not exist: %s', join(', ', $required_from_tables)), 0);
      $this->_message('(END)', 2);
      return;
    }


    // Check all to tables exist
    $required_to_tables = array(
      'engine4_' . $toType . '_fields_meta',
      'engine4_' . $toType . '_fields_maps',
      'engine4_' . $toType . '_fields_options',
      'engine4_' . $toType . '_fields_search',
      'engine4_' . $toType . '_fields_values',
    );
    if( !$this->_tableExists($toDb, $required_to_tables) ) {
      $this->_message(sprintf('One of the target tables does not exist: %s', join(', ', $required_to_tables)), 0);
      $this->_message('(END)', 2);
      return;
    }


    // Truncate existing tables
    $toDb->query('TRUNCATE TABLE' . $toDb->quoteIdentifier('engine4_' . $toType . '_fields_meta'));
    $toDb->query('TRUNCATE TABLE' . $toDb->quoteIdentifier('engine4_' . $toType . '_fields_maps'));
    $toDb->query('TRUNCATE TABLE' . $toDb->quoteIdentifier('engine4_' . $toType . '_fields_options'));
    $toDb->query('TRUNCATE TABLE' . $toDb->quoteIdentifier('engine4_' . $toType . '_fields_search'));
    $toDb->query('TRUNCATE TABLE' . $toDb->quoteIdentifier('engine4_' . $toType . '_fields_values'));

    // Remove search columns
    $searchCols = $toDb->query('SHOW COLUMNS FROM ' . $toDb->quoteIdentifier('engine4_' . $toType . '_fields_search'))->fetchAll();
    foreach( $searchCols as $searchCol ) {
      if( $searchCol['Field'] != 'item_id' ) {
        try {
          $toDb->query('ALTER TABLE ' . $toDb->quoteIdentifier('engine4_' . $toType . '_fields_search')
            . ' DROP COLUMN ' . $toDb->quoteIdentifier($searchCol['Field']));
        } catch( Exception $e ) {
          $this->_warning($e->getMessage(), 0);
        }
      }
    }



    // Import profile types
    $fieldCount = 0;
    $optionCount = 0;
    $valueCount = 0;

    // Create profile type field
    $toDb->insert('engine4_' . $toType . '_fields_meta', array(
      'type' => 'profile_type',
      'label' => 'Profile Type',
      'alias' => 'profile_type',
      'required' => 1,
      'display' => 0,
      //'publish' => 0,
      'search' => 2,
      'order' => 1,
    ));
    $profileTypeFieldIdentity = $toDb->lastInsertId();

    $toDb->insert('engine4_' . $toType . '_fields_maps', array(
      'field_id' => 0,
      'option_id' => 0,
      'child_id' => $profileTypeFieldIdentity,
    ));

    // Add profile type options
    $stmt = $fromDb->select()
      ->from('se_' . $fromType . 'cats')
      ->order($fromType . 'cat_order')
      ->query();

    $profileTypeOptionMap = array();
    $profileTypeSubcatMap = array();
    $profileTypeHeadingMap = array();
    foreach( $stmt->fetchAll() as $data ) {
      // Don't add subcategories
      if( !empty($data[$fromType . 'cat_dependency']) ) {
        $profileTypeSubcatMap[$data[$fromType . 'cat_id']] = $data[$fromType . 'cat_dependency'];
        $profileTypeHeadingMap[$data[$fromType . 'cat_id']] = $data;
        continue;
      }
      $title = $this->_getLanguageValue($data[$fromType . 'cat_title']);
      $toDb->insert('engine4_' . $toType . '_fields_options', array(
        'field_id' => $profileTypeFieldIdentity,
        'label' => $title,
      ));
      $profileTypeOptionMap[$data[$fromType . 'cat_id']] = $toDb->lastInsertId();
    }

    // Import profile fields
    $stmt = $fromDb->select()
      ->from('se_' . $fromType . 'fields')
      ->order($fromType . 'field_' . $fromType . 'cat_id ASC')
      ->order($fromType . 'field_dependency ASC')
      ->order($fromType . 'field_order ASC')
      ->query();

    $fieldsMap = array();
    $fieldsOptionsMap = array();
    $dependentFieldMap = array();
    $orderIndex = 1;
    $optionOrderIndex = 1;
    foreach( $stmt->fetchAll() as $data ) {
      $title = $this->_getLanguageValue($data[$fromType . 'field_title']);
      $description = $this->_getLanguageValue($data[$fromType . 'field_desc']);
      $error = $this->_getLanguageValue($data[$fromType . 'field_error']);

      // Dependent field
      if( isset($dependentFieldMap[$data[$fromType . 'field_id']]) ) {
        $currentFieldParentFieldId = $dependentFieldMap[$data[$fromType . 'field_id']]['field_id'];
        $currentFieldParentOptionId = $dependentFieldMap[$data[$fromType . 'field_id']]['option_id'];
      }

      // Category
      else if( isset($profileTypeOptionMap[$data[$fromType . 'field_' . $fromType . 'cat_id']]) ) {
        $currentFieldParentFieldId = $profileTypeFieldIdentity;
        $currentFieldParentOptionId = $profileTypeOptionMap[$data[$fromType . 'field_' . $fromType . 'cat_id']];
      } else if( isset($profileTypeSubcatMap[$data[$fromType . 'field_' . $fromType . 'cat_id']]) &&
          isset($profileTypeOptionMap[$profileTypeSubcatMap[$data[$fromType . 'field_' . $fromType . 'cat_id']]]) ) {
        $currentFieldParentFieldId = $profileTypeFieldIdentity;
        $currentFieldParentOptionId = $profileTypeOptionMap[$profileTypeSubcatMap[$data[$fromType . 'field_' . $fromType . 'cat_id']]];
      } else {
        $this->_error('Missing parent category in field: ' . $data[$fromType . 'field_id']);
        continue;
      }

      // Insert heading before this field
      if( isset($profileTypeHeadingMap[$data[$fromType . 'field_' . $fromType . 'cat_id']]) ) {
        $toDb->insert('engine4_' . $toType . '_fields_meta', array(
          'type' => 'heading',
          'label' => $this->_getLanguageValue($profileTypeHeadingMap[$data[$fromType . 'field_' . $fromType . 'cat_id']][$fromType . 'cat_title']),
          'order' => $orderIndex++,
          'display' => 1, // 2?
        ));
        $headingId = $toDb->lastInsertId();
        $toDb->insert('engine4_' . $toType . '_fields_maps', array(
          'field_id' => $profileTypeFieldIdentity,
          'option_id' => $currentFieldParentOptionId,
          'child_id' => $headingId,
        ));
        // Remove?
        unset($profileTypeHeadingMap[$data[$fromType . 'field_' . $fromType . 'cat_id']]);
      }

      $options = null;
      $alias = null;
      switch( $data[$fromType . 'field_type'] ) {
        case 1: // TEXT FIELD
          if( $data[$fromType . 'field_special'] == 2 ) {
            $alias = 'first_name';
            $type = 'first_name';
          } else if( $data[$fromType . 'field_special'] == 3 ) {
            $alias = 'last_name';
            $type = 'last_name';
          } else {
            $type = 'text';
          }
          break;
        case 2: // TEXTAREA
          $type = 'textarea';
          break;
        case 3: // SELECT BOX
          $type = 'select';
          try {
            $options = $this->_unserialize($data[$fromType . 'field_options']);
          } catch( Exception $e ) {
            $options = null;
          }
          break;
        case 4: // RADIO BUTTON
          $type = 'radio';
          break;
        case 5: // DATE FIELD
          if( $data[$fromType . 'field_special'] == 1 ) {
            $alias = 'birthdate';
            $type = 'birthdate';
          } else {
            $type = 'date';
          }
          break;
        case 6: // CHECKBOXES
          $type = 'multi_checkbox';
          try {
            $options = $this->_unserialize($data[$fromType . 'field_options']);
          } catch( Exception $e ) {
            $options = null;
          }
          break;
        default:
          $this->_warning('Unknown field type: ' . $data[$fromType . 'field_type'] . ' for field: ' . $data[$fromType . 'field_id'], 0);
          continue;
          break;
      }

      $newData = array(
        'type' => (string) $type,
        'label' => (string) $title,
        'description' => (string) $description,
        'alias' => (string) $alias,
        'required' => $data[$fromType . 'field_required'],
        'display' => ( $data[$fromType . 'field_display'] ? 1 : 0 ), // ?
        //'publish' => 0, // ?
        'search' => ( !$data[$fromType . 'field_search'] ? 0 : ( in_array($type, array('profile_type', 'first_name', 'last_name'))) ? 2 : 1 ),
        'order' => $orderIndex++,

        'error' => $error,
        'style' => $data[$fromType . 'field_style'],
      );

      $toDb->insert('engine4_' . $toType . '_fields_meta', $newData);
      $fieldId = $toDb->lastInsertId();
      $fieldsMap[$data[$fromType . 'field_id']] = $fieldId;

      // Do options
      if( !empty($options) && is_array($options) ) {
        $fieldsOptionsMap[$data[$fromType . 'field_id']] = array();
        foreach( $options as $fieldOptionIndex => $option ) {
          $optionCount++;
          $toDb->insert('engine4_' . $toType . '_fields_options', array(
            'field_id' => $fieldId,
            'label' => $this->_getLanguageValue($option['label']),
            'order' => $optionOrderIndex++,
          ));
          $optionIdentity = $toDb->lastInsertId();
          $fieldsOptionsMap[$data[$fromType . 'field_id']][$option['value']] = $optionIdentity;

          // Check for dependent field
          if( !empty($option['dependency']) || !empty($option['dependent_id']) || !empty($option['dependent_label']) ) {
            $this->_message('Dependent option: ' . Zend_Json::encode($option), 2);
            $dependentFieldMap[$option['dependent_id']] = array(
              'field_id' => $fieldId,
              'option_id' => $optionIdentity,
            );
          }
        }
      }

      // Do map
      $fieldCount++;
      $toDb->insert('engine4_' . $toType . '_fields_maps', array(
        'field_id' => $currentFieldParentFieldId,
        'option_id' => $currentFieldParentOptionId,
        'child_id' => $fieldId,
      ));
    }



    // Import profile values
    $stmt = $fromDb->select()
      ->from('se_' . $fromType . 'values')
      ->query();

    while( false != ($data = $stmt->fetch()) ) {
      $valueCount++;
      $valId = $data[$fromType . 'value_id'];
      $valUserId = $data[$fromType . 'value_' . $altFromType .'_id'];
      unset($data[$fromType . 'value_id']);
      unset($data[$fromType . 'value_' . $altFromType .'_id']);
      foreach( $data as $key => $value ) {
        $valFieldId = array_pop(explode('_', $key));
        // Missing field
        if( !isset($fieldsMap[$valFieldId]) ) {
          $this->_message('No field for value: ' . $key);
          continue;
        }
        $valNewFieldId = $fieldsMap[$valFieldId];
        // Value by option
        if( isset($fieldsOptionsMap[$valFieldId]) ) {
          // Nothing selected
          if( $value == -1 || /* Not sure about empty */ empty($value) ) {
            continue;
          }

          // Normal select or multi_checkbox with one value selected
          else if( is_numeric($value) ) {
            if( isset($fieldsOptionsMap[$valFieldId][$value]) ) {
              $valFieldValue = $fieldsOptionsMap[$valFieldId][$value];
            } else {
              $this->_message('No corresponding value for field value: ' . $value . ' for field id: ' . $valFieldId);
              continue;
            }
          }

          // Multi select?
          else if( strpos($value, ',') !== false &&
              ($value = array_filter(array_map('trim', explode(',', $value)))) &&
              is_array($value) &&
              !empty($value) ) {
            $valFieldValue = array();
            foreach( $value as $valueArrVal ) {
              if( isset($fieldsOptionsMap[$valFieldId][$valueArrVal]) ) {
                $valFieldValue[] = $fieldsOptionsMap[$valFieldId][$valueArrVal];
              } else {
                $this->_message('No corresponding value for multi select field value: ' . $valueArrVal . ' for field id: ' . $valFieldId);
              }
            }
          }

          // Unknown
          else {
            $this->_message('Unknown option value type for field value: ' . $value . ' for field id: ' . $valFieldId);
            continue;
          }
        }
        // Value by value
        else {
          $valFieldValue = $value;
        }

        // Insert
        if( null !== $valFieldValue ) {
          // multi select
          if( is_array($valFieldValue) ) {
            if( !empty($valFieldValue) ) {
              $tmpValFieldValueIndex = 0;
              foreach( $valFieldValue as $valFieldValueIn ) {
                $toDb->insert('engine4_' . $toType . '_fields_values', array(
                  'item_id' => $valUserId,
                  'field_id' => $valNewFieldId,
                  'index' => $tmpValFieldValueIndex++,
                  'value' => $valFieldValueIn,
                ));
              }
            }
          }

          // Scalar
          else {
            $toDb->insert('engine4_' . $toType . '_fields_values', array(
              'item_id' => $valUserId,
              'field_id' => $valNewFieldId,
              'value' => $valFieldValue,
            ));
          }
        }
      }
    }


    // Select each users' profile type
    $stmt = $fromDb->select()
      ->from('se_' . $altFromType .'s', array($altFromType . '_id', $altFromType .'_' . $fromType .'cat_id'))
      ->query()
      ;

    while( false != ($data = $stmt->fetch()) ) {
      if( isset($profileTypeOptionMap[$data[$altFromType .'_' . $fromType .'cat_id']]) ) {
        $currentFieldParentOptionId = $profileTypeOptionMap[$data[$altFromType .'_' . $fromType .'cat_id']];
      } else if( isset($profileTypeSubcatMap[$data[$altFromType .'_' . $fromType .'cat_id']]) &&
          isset($profileTypeOptionMap[$profileTypeSubcatMap[$data[$altFromType .'_' . $fromType .'cat_id']]]) ) {
        $currentFieldParentOptionId = $profileTypeOptionMap[$profileTypeSubcatMap[$data[$altFromType .'_' . $fromType .'cat_id']]];
      } else {
        if( !isset($data[$altFromType .'_' . $fromType .'cat_id']) || $data[$altFromType .'_' . $fromType .'cat_id'] == 0 ) {
          $this->_warning('Missing profile type id: ' . @$data[$altFromType .'_' . $fromType .'cat_id'] . ' for object: ' . @$data[$altFromType . '_id']);
        } else {
          $this->_error('Missing profile type id: ' . @$data[$altFromType .'_' . $fromType .'cat_id'] . ' for object: ' . @$data[$altFromType . '_id']);
        }
        continue;
      }
      $toDb->insert('engine4_' . $toType . '_fields_values', array(
        'item_id' => $data[$altFromType . '_id'],
        'field_id' => $profileTypeFieldIdentity,
        'value' => $currentFieldParentOptionId,
      ));
    }


    // Add field search
    $stmt = $toDb->select()
      ->from('engine4_' . $toType . '_fields_meta')
      ->where('search > ?', 0)
      ->query();

    $createdSearchCols = array();
    $searchColIndex = array();
    foreach( $stmt->fetchAll() as $tmpFieldMeta ) {
      // Not searchable
      if( empty($tmpFieldMeta['search']) ) {
        continue;
      }

      $searchColName = null;
      if( !empty($tmpFieldMeta['alias']) ) {
        $searchColName = $tmpFieldMeta['alias'];
      } else {
        $searchColName = sprintf('field_%d', $tmpFieldMeta['field_id']);
      }

      // Already made?
      if( isset($createdSearchCols[$searchColName]) ) {
        continue;
      }

      $sql = 'ALTER TABLE ' . $toDb->quoteIdentifier('engine4_' . $toType . '_fields_search')
        . ' ADD COLUMN ' . $toDb->quoteIdentifier($searchColName);
      $keySql = 'ALTER TABLE ' . $toDb->quoteIdentifier('engine4_' . $toType . '_fields_search')
        . ' ADD INDEX (' . $toDb->quoteIdentifier($searchColName) . ')';
      switch( $tmpFieldMeta['type'] ) {
        case 'first_name':
        case 'last_name':
        case 'text':
          $sql .= ' varchar(255) NULL';
          break;
        case 'textarea':
          $sql .= ' varchar(255) NULL'; // ?
          break;

        case 'date':
        case 'birthdate':
          $sql .= ' DATETIME NULL';
          break;

        case 'profile_type':
        case 'select':
        case 'radio':
        case 'gender':
          $tmpFieldOptions = $toDb->select()
            ->from('engine4_' . $toType . '_fields_options', 'option_id')
            ->where('field_id = ?', $tmpFieldMeta['field_id'])
            ->query()
            ->fetchAll();
          if( empty($tmpFieldOptions) ) {
            continue 2;
          }
          $optStr = '';
          foreach( $tmpFieldOptions as $tmpFieldOption ) {
            if( $optStr != '' ) {
              $optStr .= ',';
            }
            $optStr .= sprintf("'%d'", $tmpFieldOption['option_id']); // blegh
          }
          $sql .= ' ENUM(' . $optStr . ') NULL';
          break;

        case 'multi_checkbox':
          $tmpFieldOptions = $toDb->select()
            ->from('engine4_' . $toType . '_fields_options', 'option_id')
            ->where('field_id = ?', $tmpFieldMeta['field_id'])
            ->query()
            ->fetchAll();
          if( empty($tmpFieldOptions) ) {
            continue 2;
          }
          $optStr = '';
          foreach( $tmpFieldOptions as $tmpFieldOption ) {
            if( $optStr != '' ) {
              $optStr .= ',';
            }
            $optStr .= sprintf("'%d'", $tmpFieldOption['option_id']); // blegh
          }
          $sql .= ' SET(' . $optStr . ') NULL';
          break;
        default:
          continue 2;
          break;
      }

      // Add column
      try {
        $toDb->query($sql);
      } catch( Exception $e ) {
        $this->_error($e->getMessage() . ', SQL was: ' . $sql);
        continue;
      }

      // Add as created
      $createdSearchCols[$searchColName] = true;
      $searchColIndex[$tmpFieldMeta['field_id']] = $searchColName;

      // Add key
      try {
        $toDb->query($keySql);
      } catch( Exception $e ) {
        $this->_error($e->getMessage() . ', SQL was: ' . $sql);
        continue;
      }

    }

    // Add fields search values
    $break = false;
    $startId = 0;
    $endId = 100;
    do {
      $stmtData = $toDb->select()
        ->from('engine4_' . $toType . '_fields_values')
        ->where('field_id IN(?)', array_keys($searchColIndex))
        ->where('item_id >= ?', $startId)
        ->where('item_id < ?', $endId)
        ->order('item_id ASC')
        ->query()
        ->fetchAll()
        ;

      if( empty($stmtData) || !is_array($stmtData) ) {
        $break = true;
        continue;
      }

      $tmp = $endId - $startId;
      $startId += $tmp;
      $endId += $tmp;

      $userData = array();
      foreach( $stmtData as $data ) {
        if( !isset($searchColIndex[$data['field_id']]) ) {
          continue;
        }
        $userData[$data['item_id']][$searchColIndex[$data['field_id']]] = $data['value'];
      }

      foreach( $userData as $userIdentity => $userDatum ) {
        $toDb->insert('engine4_' . $toType . '_fields_search', array_merge($userDatum, array(
          'item_id' => $userIdentity,
        )));
      }

    } while( !$break );


    $this->_message(sprintf('Fields: %d', $fieldCount));
    $this->_message(sprintf('Options: %d', $optionCount));
    $this->_message(sprintf('Values: %d', $valueCount));
  }

  protected function _translateRow(array $data, $key = null)
  {
    return false;
  }
}