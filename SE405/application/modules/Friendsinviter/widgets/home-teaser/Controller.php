<?php

class Friendsinviter_Widget_HomeTeaserController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {

    $viewer = Engine_Api::_()->user()->getViewer();

    if( !Engine_Api::_()->getDbTable('teasersettings', 'friendsinviter')->checkEnabled($viewer) ) {
      $this->setNoRender();
      return;
    }

    $this->getElement()->removeDecorator('Title');
    
  }

  public function getCacheKey()
  {
    return false;
  }
}