<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Edit.php 6532 2010-06-23 22:17:37Z shaun $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Poll_Form_Index_Edit extends Poll_Form_Index_Create
{
  public function init()
  {
    parent::init();
    //$this->setTitle('Edit Poll Privacy')
    //  ->setDescription('Edit your poll privacy below, then click "Save Privacy" to apply the new privacy settings for the poll.');
    $this->submit->setLabel('Save Privacy');
  }
}