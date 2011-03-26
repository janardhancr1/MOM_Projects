<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Answewr
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Answer_Widget_ListTopAnswersController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    $table = Engine_Api::_()->getItemTable('answer');
    $select = $table->select()
      ->order('answer_id DESC LIMIT 10');

    $paginator = Zend_Paginator::factory($select);

    if( $paginator->getTotalItemCount() <= 0 ) {
      return $this->setNoRender();
    }

    $this->view->paginator = $paginator;
  }
}