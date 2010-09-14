<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Style.php 7244 2010-09-01 01:49:53Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Blog_Form_Style extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Blog Styles')
      ->setMethod('post')
      ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()))
      ->setAttrib('class', 'global_form_popup')
      ;

    $this->removeDecorator('FormWrapper');
    
    $this->addElement('Textarea', 'style', array(
      'label' => 'Custom Blog Styles',
      'description' => '_BLOG_FORM_STYLE_DESCRIPTION'
    ));
    $this->style->getDecorator('Description')->setOption('placement', 'APPEND');

    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
    ));

    $this->addElement('Button', 'cancel', array(
      'label' => 'Cancel',
      'onclick' => 'parent.Smoothbox.close();',
    ));

    $this->addElement('Hidden', 'id');
  }
}