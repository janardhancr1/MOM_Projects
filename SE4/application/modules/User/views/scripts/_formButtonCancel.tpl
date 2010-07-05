<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: _formButtonCancel.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     Steve
 */
?><?php

echo '<button type="submit" id="submit" name="submit">'.$this->translate('Yes, Delete My Account').'</button>
     or <a href="#" onclick="javascript:window.location.href=\''.
        Zend_Controller_Front::getInstance()->getRouter()
          ->assemble(array('controller' => 'settings', 'action' => 'general'), 'user_extended', true).'\';">'.$this->translate('cancel').'</a>
     ';
?>