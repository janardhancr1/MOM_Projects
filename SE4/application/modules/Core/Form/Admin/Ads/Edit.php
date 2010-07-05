<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Edit.php 6543 2010-06-23 23:43:44Z shaun $
 * @author     Jung
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Form_Admin_Ads_Edit extends Core_Form_Admin_Ads_Create
{
  public function init()
  {
    parent::init();
    $this->setTitle('Edit Advertising Campaign');
    $this->setDescription('Follow this guide to design and launch a new advertising campaign.');

    $this->submit->setLabel('Save Changes');
  }
}