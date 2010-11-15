<?php
/**
 * SocialEngineMods
 *
 * @category   Application_Extensions
 * @package    Lifestream
 * @copyright  Copyright 2006-2010 SocialEngineMods
 * @license    http://www.socialenginemods.net/license/
 */
class Lifestream_Bootstrap extends Engine_Application_Bootstrap_Abstract
{

  public function __construct($application) {
    
    parent::__construct($application);

    // @tbd only when required
    $headScript = new Zend_View_Helper_HeadScript();
    $headScript->appendFile('application/modules/Lifestream/externals/scripts/lifestream.js');

    //$headLink = new Zend_View_Helper_HeadLink();
    //$headLink->prependStylesheet('application/modules/Lifestream/externals/styles/main.css');

  }
  
}