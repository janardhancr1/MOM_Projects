<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: AdminFieldsController.php 6657 2010-07-01 01:38:38Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Classified_AdminFieldsController extends Fields_Controller_AdminAbstract
{
  protected $_fieldType = 'classified';

  protected $_requireProfileType = false;

  public function indexAction()
  {
    // Make navigation
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('classified_admin_main', array(), 'classified_admin_main_fields');

    parent::indexAction();
  }

  public function fieldCreateAction(){
    parent::fieldCreateAction();


    // remove stuff only relavent to profile questions
    $form = $this->view->form;

    if($form){
      $form->setTitle('Add Classified Question');

      $form->removeElement('display');
      $form->removeElement('search');
     
      // Display
      $form->addElement('hidden', 'display', array(
        'label' => 'Show on Member Profiles?',
        'multiOptions' => array(
          1 => 'Show on Member Profiles',
          2 => 'Show on Member Profiles (with links)',
          0 => 'Hide on Member Profiles'
        )
      ));


      $form->addElement('Select', 'search', array(
        'label' => 'Show on the search options?',
        'multiOptions' => array(
          0 => 'Hide on the search options',
          1 => 'Show on the search options'
        ),
        'value' => 1
      ));
    }
  }

  public function fieldEditAction(){
    parent::fieldEditAction();


    // remove stuff only relavent to profile questions
    $form = $this->view->form;

    if($form){
      $form->setTitle('Edit Classified Question');

      $form->removeElement('display');
      $form->removeElement('search');

      $form->addElement('Select', 'search', array(
        'label' => 'Show on the search options?',
        'multiOptions' => array(
          0 => 'Hide on the search options',
          1 => 'Show on the search options'
        ),
        'value' => $this->view->search
      ));
    }
  }
}