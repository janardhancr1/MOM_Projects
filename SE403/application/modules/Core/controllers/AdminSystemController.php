<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: AdminSystemController.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_AdminSystemController extends Core_Controller_Action_Admin
{
  public function init()
  {
    if( defined('_ENGINE_ADMIN_NEUTER') && _ENGINE_ADMIN_NEUTER ) {
      return $this->_helper->redirector->gotoRoute(array(), 'admin_default', true);
    }
  }

  public function indexAction()
  {
    $this->_redirect('/admin/system/php');
  }

  public function logAction()
  {
    $log_type   = $this->_getParam('log_type', 0);
    $log_length = $this->_getParam('log_length', 1000);

    switch ($log_type) {
        case 1:
            $log_filename = APPLICATION_PATH . '/temporary/log/main.log';
            break;
        case 2:
            $log_filename = APPLICATION_PATH . '/temporary/log/translate.log';
            break;
        case 3:
            $log_filename = APPLICATION_PATH . '/temporary/log/video.log';
            break;
        case 0:
        default:
            $log_filename = null;
    }
    if (!$log_filename || !file_exists($log_filename))
      $log = Zend_Registry::get('Zend_Translate')->_("Please select the type of log you wish to view from the filter above.");
    else {

      // clear log if requested
      if ($this->_getParam('clear_log', false)) {
        if( $fh = fopen($log_filename, 'w') ){
          fclose($fh);
        }
      }

      // emulate tail
      $stack      = array();
      $line_count = 0;
      if (true == ($fh = fopen($log_filename, 'r'))) {
        while (!feof($fh)) {
          $line = trim(fgets($fh, 4096));
          if (!empty($line)) {
            // append lines to beginning, so array displays in reverse order (newest line first)
            array_unshift($stack, $line);
            // only the requested # of lines should be stored in memory, so drop ancillary lines
            if (++$line_count > $log_length)
              array_pop($stack);
          }
        }
        fclose($fh);
      }
      $log = implode("\n", $stack);
    }
    $this->view->log_type = $log_type;
    $this->view->log_length = $log_length;
    $this->view->log = $log;
  }
  
  public function phpAction()
  {
    ob_start();
    phpinfo();
    $source = ob_get_clean();

    preg_match('~<style.+?>(.+?)</style>.+?(<table.+\/table>)~ims', $source, $matches);
    $css = $matches[1];
    $source = $matches[2];

    $css = preg_replace('/\n(.+?{)/iu', "\n#phpinfo \$1", $css);

    //$regex = '/'.preg_quote('<a href="http://www.php.net/">', '/').'.+?'.preg_quote('</a>', '/').'/ims';
    //$source = preg_replace($regex, '', $source);

    // strip images from phpinfo()
    $regex = '/<img .+?>/ims';
    $source = preg_replace($regex, '', $source);
    
    $regex = '/'.preg_quote('<h2>PHP License</h2>', '/').'.+$/ims';
    $source = preg_replace($regex, '', $source);

    $source = str_replace("module_Zend Optimizer", "module_Zend_Optimizer", $source);

    $this->view->style = $css;
    $this->view->content = $source;
  }

  public function apcAction()
  {
    
  }
}