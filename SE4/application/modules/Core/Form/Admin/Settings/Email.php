<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Email.php 6590 2010-06-25 19:40:21Z john $
 * @author     Jung
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Form_Admin_Settings_Email extends Engine_Form
{
  public function init()
  {
    // Set form attributes
    $this->setTitle('Email Templates');
    $this->setDescription('CORE_FORM_ADMIN_SETTINGS_EMAIL_DESCRIPTION');

    $this->addElement('Text', 'email_name', array(
      'label' => 'From Name',
      'description' => 'Enter the name you want the emails from the system to come from in the field below.',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('core.email.name', 'admin'),
    ));

    $this->addElement('Text', 'email_from', array(
      'label' => 'From Address',
      'description' => 'Enter the email address you want the emails from the system to come from in the field below.',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('core.email.from', 'email@domain.com'),
    ));


    // prepare language packs
    $table = Engine_Api::_()->getDbtable('languages', 'core');
    $select = $table->select();
    $language_packs = $table->fetchAll($select);
    foreach ($language_packs as $language){
      $languages_prepared[$language->language_id]= $language->name;
    }

    $this->addElement('Select', 'language_id', array(
      'label' => 'Language Pack',
      'description' => 'Your community has more than one language pack installed. Please select the language pack you want to edit right now.',
      'onchange' => 'javascript:setEmailLanguage(this.value);',
      'multiOptions' => $languages_prepared
    ));

    // prepare user levels
    $table = Engine_Api::_()->getDbtable('MailTemplates', 'core');
    $select = $table->select();
    $email_templates = $table->fetchAll($select);

    $translate = Zend_Registry::get('Zend_Translate');

    foreach ($email_templates as $template){
      $title = $translate->_(strtoupper("_email_".$template->type."_title"));
      $templates_prepared[$template->mailtemplate_id]= $title;
    }
    
    $this->addElement('Select', 'template_id', array(
      'label' => 'Choose Message',
      'multiOptions' => $templates_prepared,
      'onchange' => 'javascript:fetchEmailTemplate(this.value);',
      'ignore' => true
    ));
    $this->template_id->getDecorator("Description")->setOption("placement", "append");

    $this->addElement('Text', 'subject', array(
      'label' => 'Subject',
    ));

    $this->addElement('Textarea', 'body', array(
      'label' => 'Message Body',
    ));


    // init submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true,
    ));
  }
}