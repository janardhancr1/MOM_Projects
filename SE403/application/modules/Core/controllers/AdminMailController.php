<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: AdminMailController.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_AdminMailController extends Core_Controller_Action_Admin
{

  public function settingsAction()
  {
    // Get mail config
    $mailConfigFile = APPLICATION_PATH . '/application/settings/mail.php';
    $mailConfig = array();
    if( file_exists($mailConfigFile) ) {
      $mailConfig = include $mailConfigFile;
    }

    // Get form
    $this->view->form = $form = new Core_Form_Admin_Mail_Settings();

    // Populate form
    $form->populate((array) Engine_Api::_()->getApi('settings', 'core')->core_mail);

    if( 'Zend_Mail_Transport_Smtp' === @$mailConfig['class'] ) {
      $form->populate(array_filter(array(
        'mail_smtp' => ( 'Zend_Mail_Transport_Smtp' == @$mailConfig['class'] ),
        'mail_smtp_server' => @$mailConfig['args'][0],
        'mail_smtp_ssl' => @$mailConfig['args'][1]['ssl'],
        'mail_smtp_authentication' => !empty($mailConfig['args'][1]['username']),
        'mail_smtp_port' => @$mailConfig['args'][1]['port'],
        'mail_smtp_username' => @$mailConfig['args'][1]['username'],
        'mail_smtp_password' => @$mailConfig['args'][1]['password'],
      )));
    }
    
    // Check method/valid
    if( !$this->getRequest()->isPost() ) {
      return;
    }
    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }

    // Process
    $values = $form->getValues();



    // Special case for auth
    if( $values['mail_smtp'] ){
      // re-assign existing password if form password is left blank
      if( empty($values['mail_smtp_password']) ) {
        if( !empty($mailConfig['args'][1]['password']) ){
          $values['mail_smtp_password'] = $mailConfig['args'][1]['password'];
        }
      }
    }


    // Save smtp settings
    if( $values['mail_smtp'] ) {
      $args = array();

      $args['port'] = (int) $values['mail_smtp_port'];

      if( !empty($values['mail_smtp_ssl']) ) {
        $args['ssl'] = $values['mail_smtp_ssl'];
      }

      if( !empty($values['mail_smtp_authentication']) ) {
        $args['auth'] = 'login';
        $args['username'] = $values['mail_smtp_username'];
        $args['password'] = $values['mail_smtp_password'];
      }

      $mailConfig = array(
        'class' => 'Zend_Mail_Transport_Smtp',
        'args' => array(
          $values['mail_smtp_server'],
          $args,
        )
      );

    } else {
      $mailConfig = array(
        'class' => 'Zend_Mail_Transport_Sendmail',
        'args' => array(),
      );
    }

    // Write contents to file
    if( (is_file($mailConfigFile) && is_writable($mailConfigFile)) ||
        (is_dir(dirname($mailConfigFile)) && is_writable(dirname($mailConfigFile))) ) {
      $contents = "<?php defined('_ENGINE') or die('Access Denied'); return ";
      $contents .= var_export($mailConfig, true);
      $contents .= "; ?>";

      file_put_contents($mailConfigFile, $contents);
    } else {
      return $form->addError('Unable to change mail settings due to the file ' .
        '/application/settings/mail.php not having the correct permissions.' .
        'Please CHMOD (change the permissions of) that file to 666, then try again.');
    }

    // save the name and email address
    Engine_Api::_()->getApi('settings', 'core')->core_mail = array(
      'from' => $values['from'],
      'name' => $values['name'],
      'queueing' => $values['queueing'],
    );
    
    $form->addNotice('Your changes have been saved.');
  }

  public function templatesAction()
  {
    $this->view->form = $form = new Core_Form_Admin_Mail_Templates();

    // Get language
    $this->view->language = $language = $this->_getParam('language');

    // Get template
    $this->view->template = $template = $this->_getParam('template', '1');
    $this->view->templateObject = $templateObject = Engine_Api::_()->getItem('core_mail_template', $template);
    if( !$templateObject ) {
      $templateObject = Engine_Api::_()->getDbtable('MailTemplates', 'core')->fetchRow();
      $template = $templateObject->mailtemplate_id;
    }

    // Populate form
    $form->getElement('template')
      ->setDescription(strtoupper("_email_".$templateObject->type."_description"))
      ->getDecorator('Description')
        ->setOption('escape', false)
        ;

    $translate = Zend_Registry::get('Zend_Translate');

    $form->populate(array(
      'language' => $language,
      'template' => $template,
      'subject' => $translate->_(strtoupper("_email_".$templateObject->type."_subject"), $language),
      'body' => $translate->_(strtoupper("_email_".$templateObject->type."_body"), $language),
    ));
    
    // Check method/valid
    if( !$this->getRequest()->isPost() ) {
      return;
    }
    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }

    // Process
    $values = $form->getValues();

    $writer = new Engine_Translate_Writer_Csv();

    // Try to write to a file
    $targetFile = APPLICATION_PATH . '/application/languages/' . $language . '/custom.csv';
    if( !file_exists($targetFile) ) {
      touch($targetFile);
      chmod($targetFile, 0777);
    }

    // set the local folder depending on the language_id
    $writer->read(APPLICATION_PATH . '/application/languages/' . $language . '/custom.csv');

    // write new subject
    $writer->removeTranslation(strtoupper("_email_" . $templateObject->type . "_subject"));
    $writer->setTranslation(strtoupper("_email_" . $templateObject->type . "_subject"), $values['subject']);

    // write new body
    $writer->removeTranslation(strtoupper("_email_" . $templateObject->type . "_body"));
    $writer->setTranslation(strtoupper("_email_" . $templateObject->type . "_body"), $values['body']);

    $writer->write();
    
    $form->addNotice('Your changes have been saved.');
  }

}