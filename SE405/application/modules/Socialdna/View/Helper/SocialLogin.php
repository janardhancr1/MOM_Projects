<?php

class Socialdna_View_Helper_SocialLogin extends Zend_View_Helper_Abstract
{
  public function socialLogin()
  {    

    $data = array();

    return $this->view->partial(
      '_socialLogin.tpl',
      'sociallogin',
      $data
    );

  }
}