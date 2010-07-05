<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6599 2010-06-26 02:45:22Z steve $
 * @author     John
 */
?>

<?php
$title = Engine_Api::_()->getApi('settings', 'core')->getSetting('core_general_site_title', $this->translate('_SITE_TITLE'));
$logo  = $this->logo;
$route = $this->viewer()->getIdentity()
             ? array('route'=>'user_general', 'action'=>'home')
             : array('route'=>'core_home');

echo ($logo)
     ? $this->htmlLink($route, $this->htmlImage($logo, array('alt'=>$title)))
     : $this->htmlLink($route, $title);

