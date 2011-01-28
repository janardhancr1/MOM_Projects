<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Edit.php 6532 2010-06-23 22:17:37Z shaun $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Answer_Form_Index_Edit extends Answer_Form_Index_Create
{
  public function init()
  {
    parent::init();
    //$this->setTitle('Edit Recipe Privacy')
    //  ->setDescription('Edit your recipe privacy below, then click "Save Recipe" to apply the new settings for the recipe.');
    $this->submit->setLabel('Save Answer');
  }
}