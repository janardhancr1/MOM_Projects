<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: WidgetController.php
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Video_Form_Search extends Engine_Form
{
  public function init()
  {
    $this
      ->setAttribs(array(
        'id' => 'filter_form',
        'class' => 'global_search_box',
      ))
      ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()))
      ;
      
      $this->addElement('Text', 'search', array(
	      'label' => 'Search Viedos:',
	    ));
	    
    // prepare categories
    $categories = Engine_Api::_()->video()->getCategories();
    $categories_prepared[0] = "All Categories";
    foreach ($categories as $category){
      $categories_prepared[$category->category_id] = $category->category_name;
    }

       $this->addElement('Hidden', 'tag');

    $this->addElement('Select', 'orderby', array(
      'label' => 'Browse By',
      'multiOptions' => array(
        'creation_date' => 'Most Recent',
        'view_count' => 'Most Viewed',
        'rating' => 'Highest Rated',
      ),
      'onchange' => 'this.form.submit();',
    ));

    // category field
    $this->addElement('Select', 'category', array(
      'label' => 'Category',
      'multiOptions' => $categories_prepared,
    'style' => 'width:150px;',
      'onchange' => 'this.form.submit();'
    ));
    
    /*$content = Zend_Registry::get('Zend_Translate')->_("<img src='./application/modules/Core/externals/images/plus16.gif' border='0' class='button'>&nbsp;<a href='/index.php/videos/manage'>Go to My Videos</a>");
	$this->addElement('Dummy', 'my_groups', array(
      'content' => $content,
    ));  */
  }
}