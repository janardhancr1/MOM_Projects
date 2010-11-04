<?php
class Socialdna_SignupController extends Core_Controller_Action_Standard
{
  public function indexAction()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');

    // If the user is logged in, they can't sign up now can they?
    if( Engine_Api::_()->user()->getViewer()->getIdentity() )
    {
      return $this->_helper->redirector->gotoRoute(array(), 'default', true);
    }
    
    $formSequenceHelper = $this->_helper->formSequence;
    foreach( $this->_helper->api()->getDbtable('signup', 'user')->fetchAll() as $row )
    {
      if( $row->enable == 1 )
      {
        $class = $row->class;
        $formSequenceHelper->setPlugin(new $class, $row->order);
      }
    }

    // This will handle everything until done, where it will return true
    if( $this->_helper->formSequence() )
    {
      $viewer = Engine_Api::_()->user()->getViewer();
      $approved = $viewer->enabled;
      $verified = $viewer->verified;
      if (!($viewer->enabled && $viewer->verified))
      {
        Engine_Api::_()->user()->setViewer(null);
      }
      if ($approved && $verified)
      {
        // update networks
        Engine_Api::_()->network()->recalculate($viewer);

        return $this->_helper->_redirector->gotoRoute(array(), 'core_home', true);
      }
      else
      {
        return $this->_helper->_redirector->gotoRoute(array('action' => 'confirm', 'approved'=>$approved, 'verified'=>$verified), 'user_signup', true);
      }
    }
  }
}