<?php

class Socialdna_Controller_Action_Helper_FormSequenceEx
  extends Core_Controller_Action_Helper_FormSequence
{

  // Processing
  // Do all in one shot
  public function doSubmit()
  {
    if( $this->getActionController()->getRequest()->isPost() )
    {
      foreach( $this->getPlugins() as $plugin )
      {
        if( $plugin->isActive() )
        {
          $result = $plugin->onSubmit($this->getActionController()->getRequest());
          //var_dump($result);exit;
          if($plugin->isActive()) {
            return $plugin;
          }
        }
      }
    }

    return false;
  }

  // Do all in one shot
  public function doView()
  {
    foreach( $this->getPlugins() as $plugin )
    {
      if( $plugin->isActive() )
      {
        $plugin->onView();
        $this->getActionController()->view->script = $plugin->getScript();
        $this->getActionController()->view->form = $plugin->getForm();
        $this->getActionController()->view->title = $plugin->getTitle();
        if($plugin->isActive()) {
          return $plugin;
        }
      }
    }

    return false;
  }

}