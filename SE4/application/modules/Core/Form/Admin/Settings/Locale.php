<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Locale.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Form_Admin_Settings_Locale extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Locale Settings')
      ->setDescription('CORE_FORM_ADMIN_SETTINGS_LOCALE_DESCRIPTION');

    // Init timezeon
    $this->addElement('Select', 'timezone', array(
      'label' => 'Default Timezone',
      'multiOptions' => array(
        'US/Pacific'  => '(UTC-8) Pacific Time (US & Canada)',
        'US/Mountain' => '(UTC-7) Mountain Time (US & Canada)',
        'US/Central'  => '(UTC-6) Central Time (US & Canada)',
        'US/Eastern'  => '(UTC-5) Eastern Time (US & Canada)',
        'America/Halifax'   => '(UTC-4)  Atlantic Time (Canada)',
        'America/Anchorage' => '(UTC-9)  Alaska (US & Canada)',
        'Pacific/Honolulu'  => '(UTC-10) Hawaii (US)',
        'Pacific/Samoa'     => '(UTC-11) Midway Island, Samoa',
        'Etc/GMT-12' => '(UTC-12) Eniwetok, Kwajalein',
        'Canada/Newfoundland' => '(UTC-3:30) Canada/Newfoundland',
        'America/Buenos_Aires' => '(UTC-3) Brasilia, Buenos Aires, Georgetown',
        'Atlantic/South_Georgia' => '(UTC-2) Mid-Atlantic',
        'Atlantic/Azores' => '(UTC-1) Azores, Cape Verde Is.',
        'Europe/London' => 'Greenwich Mean Time (Lisbon, London)',
        'Europe/Berlin' => '(UTC+1) Amsterdam, Berlin, Paris, Rome, Madrid',
        'Europe/Athens' => '(UTC+2) Athens, Helsinki, Istanbul, Cairo, E. Europe',
        'Europe/Moscow' => '(UTC+3) Baghdad, Kuwait, Nairobi, Moscow',
        'Iran' => '(UTC+3:30) Tehran',
        'Asia/Dubai' => '(UTC+4) Abu Dhabi, Kazan, Muscat',
        'Asia/Kabul' => '(UTC+4:30) Kabul',
        'Asia/Yekaterinburg' => '(UTC+5) Islamabad, Karachi, Tashkent',
        'Asia/Dili' => '(UTC+5:30) Bombay, Calcutta, New Delhi',
        'Asia/Katmandu' => '(UTC+5:45) Nepal',
        'Asia/Omsk' => '(UTC+6) Almaty, Dhaka',
        'India/Cocos' => '(UTC+6:30) Cocos Islands, Yangon',
        'Asia/Krasnoyarsk' => '(UTC+7) Bangkok, Jakarta, Hanoi',
        'Asia/Hong_Kong' => '(UTC+8) Beijing, Hong Kong, Singapore, Taipei',
        'Asia/Tokyo' => '(UTC+9) Tokyo, Osaka, Sapporto, Seoul, Yakutsk',
        'Australia/Adelaide' => '(UTC+9:30) Adelaide, Darwin',
        'Australia/Sydney' => '(UTC+10) Brisbane, Melbourne, Sydney, Guam',
        'Asia/Magadan' => '(UTC+11) Magadan, Soloman Is., New Caledonia',
        'Pacific/Auckland' => '(UTC+12) Fiji, Kamchatka, Marshall Is., Wellington',
      )
    ));
    // Init default locale
    $localeMultiKeys = array_merge(
      array_keys(Zend_Locale::getLocaleList())
    );
    $localeMultiOptions = array();
    $languages = Zend_Locale::getTranslationList('language', null);
    $territories = Zend_Locale::getTranslationList('territory', null);
    foreach($localeMultiKeys as $key)
    {
      if (!empty($languages[$key]))
      {
        $localeMultiOptions[$key] = $languages[$key];
      }
      else
      {
        $locale = new Zend_Locale($key);
        $region = $locale->getRegion();
        $language = $locale->getLanguage();
        if ((!empty($languages[$language]) && (!empty($territories[$region])))) {
          $localeMultiOptions[$key] =  $languages[$language] . ' (' . $territories[$region] . ')';
        }
      }
    }
    $localeMultiOptions = array_merge(array('auto'=>'[Automatic]'), $localeMultiOptions);
    $this->addElement('Select', 'locale', array(
      'label' => 'Default Locale',
      'multiOptions' => $localeMultiOptions,
      'value' => 'auto',
      'disableTranslator'=> true
    ));
    
    // init submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true,
    ));
  }
}