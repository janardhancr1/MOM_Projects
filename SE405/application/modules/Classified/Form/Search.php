<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: WidgetController.php
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Classified_Form_Search extends Fields_Form_Search
{
  protected $_fieldType = 'classified';
  
  public function init()
  {
    //parent::init();

    $this->loadDefaultDecorators();

    $this->getDecorator('HtmlTag')->setOption('class', 'browseclassifieds_criteria classifieds_browse_filters')->setOption('id', 'filter_form');
    
    $this
      ->setAttribs(array(
        'id' => 'filter_form',
        'class' => 'global_search_box classifieds_browse_filters',
      ))
      ->setAction($_SERVER['REQUEST_URI'])
      ;
    
    // Generate
    $this->generate();

    foreach( $this->getFieldElements() as $fel ) {
      if( $fel instanceof Zend_Form_Element ) {
        $fel->clearDecorators();
        $fel->addDecorator('ViewHelper');
        Engine_Form::addDefaultDecorators($fel);
      } else if( $fel instanceof Zend_Form_SubForm ) {
        $fel->clearDecorators();
        $fel->setDescription('<label>' . $fel->getDescription() . '</label>');
        $fel->addDecorator('FormElements')
            ->addDecorator('HtmlTag', array('tag' => 'div', 'id'  => $fel->getName() . '-element', 'class' => 'form-element'))
            ->addDecorator('Description', array('tag' => 'div', 'class' => 'form-label', 'placement' => 'PREPEND', 'escape' => false))
            ->addDecorator('HtmlTag2', array('tag' => 'div', 'id'  => $fel->getName() . '-wrapper', 'class' => 'form-wrapper browse-range-wrapper'));
      }
    }
    
    // Add custom elements
    $this->getAdditionalOptionsElement();
  }

  public function getAdditionalOptionsElement()
  {
    $i = -1000;
    
    $this->addElement('Hidden', 'page', array(
      'order' => 200,
    ));

    $this->addElement('Hidden', 'tag', array(
      'order' => 201,
    ));

    $this->addElement('Hidden', 'start_date', array(
      'order' => 202,
    ));

    $this->addElement('Hidden', 'end_date', array(
      'order' => 203,
    ));

    /*$this->addElement('Button', 'done', array(
      'label' => 'Search',
      'order' => $i--,
      'onclick' => 'this.form.submit();',
    ));*/
    
    $this->addElement('Select', 'subcategory', array(
      'label' => 'Sub Category',
      'multiOptions' => array(
        '0' => '',
      ),
      'onchange' => 'this.form.submit();',
      'style' => 'width:150px',
      'order' => $i--,
    ));
    
    
    /*$content = Zend_Registry::get('Zend_Translate')->_("<img src='./application/modules/Core/externals/images/plus16.gif' border='0' class='button'>&nbsp;<a href='/index.php/classifieds/manage'>Go to My Classifieds</a>");
	$this->addElement('Dummy', 'my', array(
      'content' => $content,
	  'order' => $i--,
    ));*/


    /*$this->addElement('Select', 'show', array(
      'label' => 'Show',
      'multiOptions' => array(
        '1' => 'Everyone\'s Posts',
        '2' => 'Only My Friends\' Posts',
      ),
      'onchange' => 'this.form.submit();',
      'order' => $i--,
    ));

    $this->addElement('Select', 'closed', array(
      'label' => 'Status',
      'multiOptions' => array(
        '' => 'All Listings',
        '0' => 'Only Open Listings',
        '1' => 'Only Closed Listings',
      ),
      'onchange' => 'this.form.submit();',
      'order' => $i--,
    ));*/

    
    $this->addElement('Select', 'category', array(
      'label' => 'Category',
      'multiOptions' => array(
        '0' => 'All Categories',
      ),
      'onchange' => 'this.form.submit();',
      'order' => $i--,
    ));
    
    $this->addElement('Select', 'orderby', array(
      'label' => 'Browse By',
      'multiOptions' => array(
        'creation_date' => 'Most Recent',
        'view_count' => 'Most Viewed',
      ),
      'onchange' => 'this.form.submit();',
      'order' => $i--,
    ));

    $this->addElement('Text', 'search', array(
      'label' => 'Search Classifieds',
      'order' => $i--,
    ));
    
  }
}