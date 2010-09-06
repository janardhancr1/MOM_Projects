<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Search.php 6532 2010-06-23 22:17:37Z shaun $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Recipe_Form_Index_Search extends Engine_Form
{
  public function init()
  {
    $this
      ->setAttribs(array(
        'id' => 'filter_form',
        'class' => 'global_search_box',
      ))
      ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array('page'=>1)));

    parent::init();
    
    $this->addElement('Text', 'recipe_search', array(
      'label' => 'Search Recipes:'
    ));

    $this->addElement('Select', 'browse_recipes_by', array(
      'label' => 'Browse By:',
      'multiOptions' => array(
        'recent' => 'Most Recent',
        'popular' => 'Most Popular',
      ),
      'onchange' => 'this.form.submit();',
    ));
    
  $categories = Engine_Api::_()->recipe()->getCategories();
		if (count($categories)!=0){
			$categories_prepared[0]= "";
			foreach ($categories as $category){
					$categories_prepared[$category->category_id]= $category->category_name;
			}

			// category field
			$this->addElement('Select', 'category_id', array(
            'label' => 'Category',
            'multiOptions' => $categories_prepared,
      		'style' => 'width:202px',
			'onchange' => 'this.form.submit();',
			));
		}

    $content = Zend_Registry::get('Zend_Translate')->_("<img src='./application/modules/Core/externals/images/plus16.gif' border='0' class='button'>&nbsp;<a href='/index.php/recipes/manage'>Go to My Recipes</a>");
	$this->addElement('Dummy', 'my_groups', array(
      'content' => $content,
    ));
  }
}