<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Mail.php 7244 2010-09-01 01:49:53Z john $
 * @author     Steve
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Api_Mail extends Core_Api_Abstract
{
  protected $_enabled;

  protected $_queueing;

  protected $_transport;

  public function __construct()
  {
    $this->_enabled = (bool) Engine_Api::_()->getApi('settings', 'core')->getSetting('core.mail.enabled', true);
    $this->_queueing = (bool) Engine_Api::_()->getApi('settings', 'core')->getSetting('core.mail.queueing', true);
  }

  // Options

  public function getTransport()
  {
    if( null === $this->_transport )
    {
      if( file_exists(APPLICATION_PATH . '/application/settings/mail.php') )
      {
        $config = include APPLICATION_PATH . '/application/settings/mail.php';
        try
        {
          $args = ( !empty($config['args']) ? $config['args'] : array() );
          $r = new ReflectionClass($config['class']);
          $transport = $r->newInstanceArgs($args);
          if( !($transport instanceof Zend_Mail_Transport_Abstract) )
          {
            $this->_transport = false;
          }
          else
          {
            $this->_transport = $transport;
          }
        }
        catch( Exception $e )
        {
          $this->_transport = false;
          throw $e;
        }
      }
    }

    if( !($this->_transport instanceof Zend_Mail_Transport_Abstract) )
    {
      return null;
    }

    return $this->_transport;
  }

  public function getCharset()
  {
    return 'utf-8';
  }


  // Doing things

  public function create()
  {
    return new Zend_Mail($this->getCharset());
  }

  public function send(Zend_Mail $mail)
  {
    if( $this->_enabled )
    {
      if( $this->_queueing ) {

        // Single
        if( count($mail->getRecipients()) <= 1 ) {
          $mailTable = Engine_Api::_()->getDbtable('mail', 'core');
          $mailTable->insert(array(
            'type' => 'zend',
            'body' => serialize($mail),
            'recipient_count' => count($mail->getRecipients()),
          ));
        }

        // Multi
        else {
          $recipients = $mail->getRecipients();
          $mailClone = clone $mail;
          $mailClone->clearRecipients();
          
          // Insert main
          $mailTable = Engine_Api::_()->getDbtable('mail', 'core');
          $mail_id = $mailTable->insert(array(
            'type' => 'zend',
            'body' => serialize($mailClone),
            'recipient_count' => count($recipients),
            'recipient_total' => count($recipients),
            'creation_time'   => date("Y-m-d H:i:s"),
          ));

          // Insert recipients
          $mailRecipientsTable = Engine_Api::_()->getDbtable('mailRecipients', 'core');
          foreach( $recipients as $oneRecipient ) {
            if( $oneRecipient instanceof Core_Model_Item_Abstract ) {
              $mailRecipientsTable->insert(array(
                'mail_id' => $mail_id,
                'user_id' => $oneRecipient->user_id,
              ));
            } else if( is_string($oneRecipient) ) {
              $mailRecipientsTable->insert(array(
                'mail_id' => $mail_id,
                'email' => $oneRecipient,
              ));
            }
          }
        }
        /*
        $mailRow = $mailTable->createRow();
        $mailRow->type = 'zend';
        $mailRow->body = $mail;
        $mailRow->recipient_count = count($mail->getRecipients());
        $mailRow->save();
         */
      } else {
        // $this->sendRaw($mail);
        $mailClone = clone $mail;
        $mailClone->clearRecipients();
        $mailClone->addTo( $mailClone->getFrom() );
        foreach( $mail->getRecipients() as $oneRecipient ) {
          if( $oneRecipient instanceof Core_Model_Item_Abstract && !empty($oneRecipient->email) ) {
            $mailClone->addBcc($oneRecipient->email);
          } else if( is_string($oneRecipient) ) {
            $mailClone->addBcc($oneRecipient);
          }
          // send in batches of 30
          if (30 <= count($mailClone->getRecipients())) {
            $this->sendRaw($mailClone);
            $mailClone->clearRecipients();
            $mailClone->addTo( $mailClone->getFrom() );
          }
        }
        if (1 <= count($mailClone->getRecipients())) {
          $this->sendRaw($mailClone);
        }
      }
    }
    
    return $this;
  }

  public function sendRaw(Zend_Mail $mail)
  {
    if( $this->_enabled )
    {
      try {
          $mail->send($this->getTransport());
      } catch( Exception $e ) {
        // Silence? Note: Engine_Exception 's are already logged
        if( !($e instanceof Engine_Exception) && Zend_Registry::isRegistered('Zend_Log') ) {
          $log = Zend_Registry::get('Zend_Log');
          $log->log($e, Zend_Log::ERR);
        }
      }
      
      // Track emails
      Engine_Api::_()->getDbtable('statistics', 'core')->increment('core.emails');
    }
    
    return $this;
  }


  // System

  public function sendSystem($recipient, $type, array $params = array())
  {
    // Just send
    if( !$this->_queueing || (isset($params['queue']) && $params['queue'] === false) )
    {
      $this->sendSystemRaw($recipient, $type, $params);
    }

    // Queue
    else
    {
      if( !is_array($recipient) && !($recipient instanceof Zend_Db_Table_Rowset_Abstract) ) {
        $recipient = array($recipient);
      }
      $recipients = array();
      // Pre-process recpients
      foreach( $recipient as $oneRecipient ) {
        if( !$this->_validateRecipient($oneRecipient) ) {
          throw new Exception(get_class($this).'::sendSystem() requires an item, an array of items with an email, or a string email address.');
        }
        $recipients[] = $oneRecipient;
      }
      
      // Insert main row
      $mailTable = Engine_Api::_()->getDbtable('mail', 'core');
      $mailRecipientsTable = Engine_Api::_()->getDbtable('mailRecipients', 'core');
      $mail_id = $mailTable->insert(array(
        'type' => 'system',
        'body' => serialize(array(
          'type' => $type,
          'params' => $params,
        )),
        'recipient_count' => count($recipients),
      ));

      // Insert recipients
      foreach( $recipients as $oneRecipient ) {
        if( $oneRecipient instanceof Core_Model_Item_Abstract ) {
          $mailRecipientsTable->insert(array(
            'mail_id' => $mail_id,
            'user_id' => $oneRecipient->user_id,
          ));
        } else if( is_string($oneRecipient) ) {
          $mailRecipientsTable->insert(array(
            'mail_id' => $mail_id,
            'email' => $oneRecipient,
          ));
        }
      }
    }

    return $this;
  }

  public function sendSystemRaw($recipient, $type, array $params = array())
  {
    // Verify mail template type
    $mailTemplateTable = Engine_Api::_()->getDbtable('MailTemplates', 'core');
    $mailTemplate = $mailTemplateTable->fetchRow($mailTemplateTable->select()->where('type = ?', $type));
    if( null === $mailTemplate ) {
      return;
    }

    // Verify recipient(s)
    if( !is_array($recipient) && !($recipient instanceof Zend_Db_Table_Rowset_Abstract) ) {
      $recipient = array($recipient);
    }
    $recipients = array();
    foreach( $recipient as $oneRecipient ) {
      if( !$this->_validateRecipient($oneRecipient) ) {
        throw new Exception(get_class($this).'::sendSystem() requires an item, an array of items with an email, or a string email address.');
      }
      $recipients[] = $oneRecipient;
    }

    // Verify params?

    // Send

    // Build subject/body
    $translate = Zend_Registry::get('Zend_Translate');
    $subjectTemplate = $translate->_(strtoupper("_email_".$mailTemplate->type."_subject"));
    $bodyTemplate = $translate->_(strtoupper("_email_".$mailTemplate->type."_body"));

    //$vars = explode(',', $mailTemplate->vars);
    //foreach( $vars as $var ) {
    foreach( $params as $var => $value ) {
      $raw = trim($var, '[]');
      $var = '[' . $var . ']';
      $val = ( isset($params[$raw]) ? $params[$raw] : $var ); // we could do auto params here?
      $subjectTemplate = str_replace($var, $val, $subjectTemplate);
      $bodyTemplate = str_replace($var, $val, $bodyTemplate);
    }

    $fromAddress = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.mail.from', 'admin@' . $_SERVER['HTTP_HOST']);
    $fromName = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.mail.name', 'Site Admin');

    // Send to each recipient
    foreach( $recipients as $recipient ) {
      $mail = $this->create();
      $rEmail = null;
      $rName = '';
      if( $recipient instanceof Core_Model_Item_Abstract ) {
        $rEmail = $recipient->email;
        $rName = $recipient->getTitle();
      } else if( is_string($recipient) ) {
        $rEmail = $recipient;
      } else {
        continue;
      }
      $mail
        ->addTo($rEmail, $rName)
        ->setFrom($fromAddress, $fromName)
        ->setSubject($subjectTemplate)
        ;

      // Has html
      if( ($tmpBody = strip_tags($bodyTemplate)) != $bodyTemplate ) {
        $mail
          ->setBodyHtml($bodyTemplate)
          ->setBodyText(strip_tags($bodyTemplate));
      }
      // Doesn't have html
      else {
        $mail
          ->setBodyHtml(nl2br($bodyTemplate))
          ->setBodyText($bodyTemplate);
      }
      $this->sendRaw($mail);
    }

    return $this;
  }

  protected function _validateRecipient($recipient)
  {
    if( $recipient instanceof Core_Model_Item_Abstract && !empty($recipient->email) ) {
      return true;
    } else if( is_string($recipient) && strpos($recipient, '@') >= 1 ) {
      return true;
    }
    return false;
  }
}