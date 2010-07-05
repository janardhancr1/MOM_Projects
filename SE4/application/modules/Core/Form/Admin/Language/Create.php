<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Create.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Form_Admin_Language_Create extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Language Manager')
      ->setDescription('Create a new language pack')
      ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()))
      ;


    $languageList     = Zend_Locale_Data::getList('en', 'language');
    $territoryList    = Zend_Locale_Data::getList('en', 'territory');

    $languageNameList = array();
    foreach (array_keys(Zend_Locale::getLocaleList()) as $localeCode) {
      $lang_array = explode('_', $localeCode);
      $locale     = array_shift($lang_array);
      $territory  = array_shift($lang_array);
      $languageNameList[$localeCode] = $languageList[$locale];
      if (empty($languageNameList[$localeCode]))
        unset($languageNameList[$localeCode]);
      else {
        if (!empty($territoryList[$territory]))
          $languageNameList[$localeCode] .= " ({$territoryList[$territory]})";
        $languageNameList[$localeCode]   .= "  [$localeCode]";
      }
    }
    asort($languageNameList);
    $this->addElement('Select', 'language', array(
      'label' => 'Language',
      'description' => 'Which language do you want to create a language pack for?',
      'multiOptions' => $languageNameList,
    ));

    // Init submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Create',
      'type' => 'submit',
      'decorators' => array(
        'ViewHelper',
      ),
    ));

    $this->addElement('Cancel', 'cancel', array(
      'prependText' => ' or ',
      'link' => true,
      'label' => 'cancel',
      'onclick' => 'history.go(-1); return false;',
      'decorators' => array(
        'ViewHelper'
      )
    ));
  }
}