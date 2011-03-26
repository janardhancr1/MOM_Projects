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
  	$table = Engine_Api::_()->getDbtable('answers', 'answer');
    $rName = $table->info('name');

    $tmTable = Engine_Api::_()->getDbtable('posts', 'answer');
    $tmName = $tmTable->info('name');
  	
    $select = $table->select()
     ->limit( 10 )
     ->group("$tmName.answer_id")
      ->order( $rName.'.answer_id DESC' );
  	
      $select = $select
        ->setIntegrityCheck(false)
        ->from($rName)
        ->joinInner($tmName, "$rName.answer_id = $tmName.answer_id");
  

    $paginator = Zend_Paginator::factory($select);

    if( $paginator->getTotalItemCount() <= 0 ) {
      return $this->setNoRender();
    }

    $this->view->paginator = $paginator;
  }
}