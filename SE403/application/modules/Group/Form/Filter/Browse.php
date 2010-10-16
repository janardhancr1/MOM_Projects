<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Browse.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Group_Form_Filter_Browse extends Engine_Form
{
  public function init()
  {
    $this->clearDecorators()
      ->addDecorators(array(
        'FormElements',
        array('HtmlTag', array('tag' => 'dl')),
        'Form',
      ))
      ->setMethod('get')
      //->setAttrib('onchange', 'this.submit()')
      ;
    
    $this->addElement('Select', 'category_id', array(
      'label' => 'Category:',
      'style' => 'width:200px',
      'multiOptions' => array(
        '' => 'All Categories',
      ),
      'decorators' => array(
        'ViewHelper',
        array('HtmlTag', array('tag' => 'dd')),
        array('Label', array('tag' => 'dt', 'placement' => 'PREPEND'))
      ),
      'onchange' => '$(this).getParent("form").submit();',
    ));

    /*$this->addElement('Select', 'view', array(
      'label' => 'View:',
      'multiOptions' => array(
        '' => 'Everyone\'s Groups',
        '1' => 'Only My Friends\' Groups',
      ),
      'decorators' => array(
        'ViewHelper',
        array('HtmlTag', array('tag' => 'dd')),
        array('Label', array('tag' => 'dt', 'placement' => 'PREPEND'))
      ),
      'onchange' => '$(this).getParent("form").submit();',
    ));*/

    $this->addElement('Select', 'order', array(
      'label' => 'List By:',
      'multiOptions' => array(
        'creation_date DESC' => 'Recently Created',
        'member_count DESC' => 'Most Popular',
      ),
      'decorators' => array(
        'ViewHelper',
        array('HtmlTag', array('tag' => 'dd')),
        array('Label', array('tag' => 'dt', 'placement' => 'PREPEND'))
      ),
      'value' => 'creation_date DESC',
      'onchange' => '$(this).getParent("form").submit();',
    ));
    $content = Zend_Registry::get('Zend_Translate')->_("<img src='./application/modules/Core/externals/images/plus16.gif' border='0' class='button'>&nbsp;<a href='/index.php/groups/manage'>Go to My Groups</a>");
	$this->addElement('Dummy', 'my', array(
	  'label' => '    ',
      'content' => $content,
	'decorators' => array(
        'ViewHelper',
        array('HtmlTag', array('tag' => 'div', 'class' => 'my_groups')),
        array('Label', array('tag' => 'dt', 'placement' => 'PREPEND'))
      ),
    )); 
  }
}