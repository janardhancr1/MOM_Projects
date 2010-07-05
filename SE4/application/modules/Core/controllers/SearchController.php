<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: SearchController.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_SearchController extends Core_Controller_Action_Standard
{
  public function indexAction()
  {
    //$viewer = $this->_helper->api()->user()->getViewer();

    // check public settings
    $require_check = Engine_Api::_()->getApi('settings', 'core')->core_general_search;
    if(!$require_check){
      if( !$this->_helper->requireUser()->isValid() ) return;
    }


    $this->view->form = $form = new Core_Form_Search();

    if( $form->isValid($this->_getAllParams()) )
    {
      // zzz
    }
    
    $this->view->query = $query = (string) $form->getValue('query');
    $this->view->page = $page = (int) $this->_getParam('page');
    if( $query )
    {
      $this->view->paginator = Engine_Api::_()->getApi('search', 'core')->getPaginator($query);
      $this->view->paginator->setCurrentPageNumber($page);
    }
  }
}