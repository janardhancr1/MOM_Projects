<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: AdminSettingsController.php 6665 2010-07-01 04:19:12Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_AdminSettingsController extends Core_Controller_Action_Admin
{
  public function generalAction()
  {
    $this->view->form = $form = new Core_Form_Admin_Settings_General();
    $global_settings_file = APPLICATION_PATH . '/application/settings/general.php';
    $g = include $global_settings_file;

    // Save
    if( $this->getRequest()->isPost() )
    {
      if( $form->isValid($this->getRequest()->getPost()) )
      {
        $this->_helper->api()->getApi('settings', 'core')->core_general = $form->getValues();
      }

      // maintenance_mode is stored in /application/settings/general.php
      $maintenance = $this->_getParam('maintenance_mode', 0);
      if ($maintenance != $g['maintenance']['enabled']) {
        $g['maintenance']['enabled'] = (bool) $maintenance;
        $g['maintenance']['code']    = $this->createRandomPassword(5);
        if ($g['maintenance']['enabled']) {
          setcookie('en4_maint_code', $g['maintenance']['code'], time()+(60*60*24*365), $this->getFrontController()->getRouter()->assemble(array(), 'default'));
        }

        if (is_writable($global_settings_file)) {
          $file_contents  = "<?php defined('_ENGINE') or die('Access Denied'); return ";
          $file_contents .= var_export($g, true);
          $file_contents .= "; ?>";
          file_put_contents($global_settings_file, $file_contents);
        } else {
          $form->getElement('maintenance_mode')
               ->addError('Unable to configure this setting due to the file /application/settings/general.php not having the correct permissions.
                           Please CHMOD (change the permissions of) that file to 666, then try again.');
        }
      }
      $form->addNotice('Your changes have been saved.');
    }

    // Initialize
    else
    {
      $form->populate($this->_helper->api()->getApi('settings', 'core')->getFlatSetting('core_general', array()));
      // set maintenance mode field
      $g = include $global_settings_file;
      if ($g['maintenance']['enabled'] && $g['maintenance']['code'])
        $form->getElement('maintenance_mode')->setValue(1);
      else
        $form->getElement('maintenance_mode')->setValue(0);
    }
  }

  public function localeAction()
  {
    $this->view->form = $form = new Core_Form_Admin_Settings_Locale();

    // Save
    if( $this->getRequest()->isPost() )
    {
      if( $form->isValid($this->getRequest()->getPost()) )
      {
        $this->_helper->api()->getApi('settings', 'core')->core_locale = $form->getValues();
        $form->addNotice('Your changes have been saved.');
      }
    }

    // Initialize
    else
    {
      $form->populate($this->_helper->api()->getApi('settings', 'core')->core_locale);
    }
  }

  public function emailAction()
  {
    $this->view->form = $form = new Core_Form_Admin_Settings_Email();
    
    // get language
    $this->view->language_id = $language_id = $this->_getParam('language_id', '1');
    
    $table = Engine_Api::_()->getDbtable('languages', 'core');
    $select = $table->select()->where('language_id', $language_id);
    $language = $table->fetchRow($select);
    
    // get template
    $this->view->template_id = $template_id = $this->_getParam('template_id', '1');
    $email_template = Engine_Api::_()->getItem('core_mail_template', $template_id);

    $translate = Zend_Registry::get('Zend_Translate');

    $form_description = $form->getElement('template_id');
    $form_description->getDecorator('Description')->setOption('escape', false);
    $form_description->setDescription(strtoupper("_email_".$email_template->type."_description"));

    // Save
    if( $this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()) )
    {
      // save the information using the language id and template id
      $values = $form->getValues();
      
      // save the name and email address
      $settings = Engine_Api::_()->getApi('settings', 'core');
      $settings->setSetting('core_email_name', $values['email_name']);
      $settings->setSetting('core_email_from', $values['email_from']);

      $writer = new Engine_Translate_Writer_Csv();

      // Try to write to a file
      $targetFile = APPLICATION_PATH . '/application/languages/'.$language->code.'/custom.csv';
      if( !file_exists($targetFile) ) {
        touch($targetFile);
        chmod($targetFile, 0777);
      }

      // set the local folder depending on the language_id
      $writer->read(APPLICATION_PATH . '/application/languages/'.$language->code.'/custom.csv');

      // write new subject
      $writer->removeTranslation(strtoupper("_email_".$email_template->type."_subject"));
      $writer->setTranslation(strtoupper("_email_".$email_template->type."_subject"), $values['subject']);
      
      // write new body
      $writer->removeTranslation(strtoupper("_email_".$email_template->type."_body"));
      $writer->setTranslation(strtoupper("_email_".$email_template->type."_body"), $values['body']);

      $writer->write();
      $form->addNotice('Your changes have been saved.');
    }

    // Initialize
    else
    {
      // pass second variable to set locale: Zend_Registry::get('Zend_Translate', 'en');
      $translate = Zend_Registry::get('Zend_Translate');

      $subject = $translate->_(strtoupper("_email_".$email_template->type."_subject"));
      $body = $translate->_(strtoupper("_email_".$email_template->type."_body"));

      // set the avaliable variables of the email
      // 'value' => $settings->getSetting('invite.message', '%invite_url%')
      $form->getElement('subject')->setValue($subject);
      $form->getElement('body')->setValue($body);
      
      // populate form and the avaliable variables in description

      // populate rest of the form
      $settings = array();
      
      $settings = array_merge($settings, array(
        'language_id' => $language_id,
        'template_id' => $template_id
      ));

      $form->populate($settings);
    }
  }

  public function spamAction()
  {
    $this->view->form = $form = new Core_Form_Admin_Settings_Spam();
    $settings = Engine_Api::_()->getApi('settings', 'core');
    // Save
    if( $this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()) )
    {
      $db = Engine_Api::_()->getDbtable('settings', 'core')->getAdapter();
      $db->beginTransaction();
      try {
        $settings->core_spam = $this->view->form->getValues();
        $db->commit();
        $form->addNotice('Your changes have been saved.');
      } catch (Exception $e) {
        $db->rollback();
        throw $e;
      }
    }
    if ($settings->core_spam)
      $this->view->form->populate($settings->core_spam);
  }

  public function performanceAction()
  {
    $setting_file      = APPLICATION_PATH . '/application/settings/cache.php';
    $default_file_path = APPLICATION_PATH . '/temporary/cache';
    $current_cache     = include $setting_file;
    $current_cache['default_file_path'] = $default_file_path;
    $this->view->form  = $form = new Core_Form_Admin_Settings_Performance();

    // pre-fill form with proper cache type
    $form->populate($current_cache);

    // disable caching types not supported
    $disabled_type_options = $removed_type_options = array();
    foreach ($form->getElement('type')->options as $i => $backend) {
      if ('Apc' == $backend && !extension_loaded('apc'))
        $disabled_type_options[] = $backend;
      if ('Memcached' == $backend && !extension_loaded('memcache'))
        $disabled_type_options[] = $backend;
      if ('Xcache' == $backend && !extension_loaded('xcache'))
        $disabled_type_options[] = $backend;
    }
    $form->getElement('type')->setAttrib('disable', $disabled_type_options);

    // set required elements before checking for validity
    switch ($this->getRequest()->getPost('type')) {
      case 'File':
        $form->getElement('file_path')->setRequired(true)->setAllowEmpty(false);
        break;
      case 'Memcached':
        $form->getElement('memcache_host')->setRequired(true)->setAllowEmpty(false);
        $form->getElement('memcache_port')->setRequired(true)->setAllowEmpty(false);
        break;
      case 'Memcached':
        $form->getElement('xcache_username')->setRequired(true)->setAllowEmpty(false);
        $form->getElement('xcache_password')->setRequired(true)->setAllowEmpty(false);
        break;
    }

    if (!is_writable($setting_file)) {
      $phrase = Zend_Registry::get('Zend_Translate')->_('Changes made to this form will not be saved.  Please adjust the permissions (CHMOD) of file %s to 777 and try again.');
      $form->addError(sprintf($phrase, '/application/settings/cache.php'));
      return;
    }

    if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
    {
      $this->view->isPost = true;
      $code = "<?php\ndefined('_ENGINE') or die('Access Denied');\nreturn ";
      
      $do_flush = false;
      foreach ($form->getElement('type')->options as $type => $label)
        if (array_key_exists($type, $current_cache['backend']) && $type != $this->_getParam('type'))
          $do_flush = true;

      $options = array();
      switch ($this->getRequest()->getPost('type')) {
        case 'File':
          $options['file_locking'] = (bool) $this->_getParam('file_locking');
          $options['cache_dir']    = $this->_getParam('file_path');
          if (!is_writable($options['cache_dir'])) {
            $options['cache_dir']  = $default_file_path;
            $form->getElement('file_path')->setValue($default_file_path);
          }
          break;
        case 'Memcached':
          $options['servers'][] = array(
            'host' => $this->_getParam('memcache_host'),
            'port' => (int) $this->_getParam('memcache_port'),
          );
          $options['compression'] = (bool) $this->_getParam('memcache_compression');
      }
      $current_cache['backend'] = array($this->_getParam('type') => $options);
      $current_cache['frontend']['core']['lifetime'] = $this->_getParam('lifetime');
      $current_cache['frontend']['core']['caching']  = (bool) $this->_getParam('enable');
      
      $code .= var_export($current_cache, true);
      $code .= '; ?>';

      // test write+read before saving to file
      $backend = null;
      if (!$current_cache['frontend']['core']['caching']) {
        $this->view->success = true;
      } else {
        $backend = Zend_Cache::_makeBackend($this->_getParam('type'), $options);
        if ($current_cache['frontend']['core']['caching'] && @$backend->save('test_value', 'test_id') && @$backend->test('test_id')) {
          #$backend->remove('test_id');
          $this->view->success = true;
        } else {
          $this->view->success = false;
          $form->getElement('type')->setErrors(array('Unable to use this backend.  Please check your settings or try another one.'));
        }
      }

      // write settings to file
      if ($this->view->success && is_writable($setting_file) && file_put_contents($setting_file, $code)) {
        $form->addNotice('Your changes have been saved.');
      } elseif ($this->view->success) {
        $form->addError('Your settings were unable to be saved to the
          cache file.  Please log in through FTP and either CHMOD 777 the file
          <em>/application/settings/cache.php</em>, or edit that file and
          replace the existing code with the following:<br/>
          <code>'.htmlspecialchars($code).'</code>');
      }

      if ($backend instanceof Zend_Cache_Backend && ($do_flush || $form->getElement('flush')->getValue())) {
        $backend->clean();
        $form->getElement('flush')->setValue(0);
        $form->addNotice('Cache has been flushed.');
      }
    }
  }

  public function passwordAction()
  {
    // Super admins only?
    $viewer = Engine_Api::_()->user()->getViewer();
    $level = Engine_Api::_()->getItem('authorization_level', $viewer->level_id);
    if( !$viewer || !$level || $level->flag != 'superadmin' ) {
      return $this->_helper->redirector->gotoRoute(array(), 'admin_default', true);
    }

    $this->view->form = $form = new Core_Form_Admin_Settings_Password();

    if( !$this->getRequest()->isPost() ) {
      $form->populate(array(
        'mode' => Engine_Api::_()->getApi('settings', 'core')->getSetting('core.admin.mode', 'none'),
        'timeout' => Engine_Api::_()->getApi('settings', 'core')->getSetting('core.admin.timeout'),
      ));
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }

    $values = $form->getValues();
    $values['reauthenticate'] = ( $values['mode'] == 'none' ? '0' : '1' );
    
    // If auth method is global and password is empty (in db), require them to enter one
    if( $values['mode'] == 'global' ) {
      if( !Engine_Api::_()->getApi('settings', 'core')->core_admin_password && empty($values['password']) ) {
        $form->addError('Please choose a password.');
        return;
      }
    }

    // Verify password
    if( !empty($values['password']) ) {
      if( $values['password'] != $values['password_confirm'] ) {
        $form->addError('Passwords did not match.');
        return;
      }
      if( strlen($values['password']) < 4 ) {
        $form->addError('Password must be at least four (4) characters.');
        return;
      }
      // Hash password
      $values['password'] = md5(Engine_Api::_()->getApi('settings', 'core')->getSetting('core.secret', 'staticSalt') . $values['password']);
      unset($values['password_confirm']);

      $form->addNotice('Password updated.');

    } else {
      unset($values['password']);
      unset($values['password_confirm']);
    }

    Engine_Api::_()->getApi('settings', 'core')->core_admin = $values;

    $form->addNotice('Changes saved.');
  }

  public function createRandomPassword($length = 6) {
    $chars = "abcdefghijkmnpqrstuvwxyz23456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i < $length) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
  }
}