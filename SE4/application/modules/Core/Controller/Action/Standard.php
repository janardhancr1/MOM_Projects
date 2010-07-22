<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Standard.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
abstract class Core_Controller_Action_Standard extends Engine_Controller_Action
{
	public $autoContext = true;

	public function __construct(Zend_Controller_Request_Abstract $request, Zend_Controller_Response_Abstract $response, array $invokeArgs = array())
	{
		// Pre-init setSubject
		try {
			if( '' !== ($subject = trim((string) $request->getParam('subject'))) ) {
				$subject = Engine_Api::_()->getItemByGuid($subject);
				if( ($subject instanceof Core_Model_Item_Abstract) && $subject->getIdentity() && !Engine_Api::_()->core()->hasSubject() ) {
					Engine_Api::_()->core()->setSubject($subject);
				}
			}
		} catch( Exception $e ) {
			// Silence
			//throw $e;
		}

		// Parent
		parent::__construct($request, $response, $invokeArgs);
	}

	public function postDispatch()
	{
		$layoutHelper = $this->_helper->layout;
		if( $layoutHelper->isEnabled() && !$layoutHelper->getLayout() )
		{
			$layoutHelper->setLayout('default');
		}
	}

	protected function _redirectCustom($to, $options = array())
	{
		$options = array_merge(array(
      'prependBase' => false
		), $options);

		// Route
		if( is_array($to) && empty($to['uri']) ) {
			$route = ( !empty($to['route']) ? $to['route'] : 'default' );
			$reset = ( isset($to['reset']) ? $to['reset'] : true );
			unset($to['route']);
			unset($to['reset']);
			$to = $this->_helper->url->url($to, $route, $reset);
			// Uri with options
		} else if( is_array($to) && !empty($to['uri']) ) {
			$to = $to['uri'];
			unset($params['uri']);
			$params = array_merge($params, $to);
		} else if( is_object($to) && method_exists($to, 'getHref') ) {
			$to = $to->getHref();
		}

		if( !is_scalar($to) ) {
			$to = (string) $to;
		}

		$message = ( !empty($options['message']) ? $options['message'] : 'Changes saved!' );

		switch( $this->_helper->contextSwitch->getCurrentContext() ) {
			case 'smoothbox':
				return $this->_forward('success', 'utility', 'core', array(
          'messages' => array($message),
          'smoothboxClose' => true,
          'redirect' => $to
				));
				break;
			case 'json': case 'xml': case 'async':
				// What should be do here?
				//break;
			default:
				return $this->_helper->redirector->gotoUrl($to, $options);
				break;
		}
	}

	protected function getRightSideContent($adCamp1=2, $adCamp2=3)
	{
		$this->view->campaign1 = $campaign1 = Engine_Api::_()->getItem('core_adcampaign', $adCamp1);
		//print_r($campaign);
		if($campaign1){
			$this->view->ad1= $ad1 = $campaign1->getAd();
			$viewer = Engine_Api::_()->user()->getViewer();

			// check if ad is active
			if(!$ad1 || !$campaign1->status){
				$this->_noRender1 = true;
			}
			// check if user is the audience
			else if(!$campaign1->allowedToView($viewer) && !($campaign1->public && !$viewer->getIdentity())){
				$this->_noRender1 = true;
			}

			// check if exeeded limits
			else if($campaign1->checkLimits()){
				$this->_noRender1 = true;
			}

			// check if campaign expired
			else if($campaign1->checkExpired()){
				$this->_noRender1 = true;
			}

			// all clear, incremement views and render
			else{
				$campaign1->views++;
				$campaign1->save();
				$ad1->views++;
				$ad1->save();
			}
		}
		else {
			$this->_noRender1 = true;
		}

		$this->view->campaign2 = $campaign2 = Engine_Api::_()->getItem('core_adcampaign', $adCamp2);
		//print_r($campaign);
		if($campaign2){
			$this->view->ad2= $ad2 = $campaign2->getAd();
			$viewer = Engine_Api::_()->user()->getViewer();

			// check if ad is active
			if(!$ad2 || !$campaign2->status){
				$this->_noRender2 = true;
			}
			// check if user is the audience
			else if(!$campaign2->allowedToView($viewer) && !($campaign2->public && !$viewer->getIdentity())){
				$this->_noRender2 = true;
			}

			// check if exeeded limits
			else if($campaign2->checkLimits()){
				$this->_noRender2 = true;
			}

			// check if campaign expired
			else if($campaign2->checkExpired()){
				$this->_noRender2 = true;
			}

			// all clear, incremement views and render
			else{
				$campaign2->views++;
				$campaign2->save();
				$ad2->views++;
				$ad2->save();
			}
		}
		else {
			$this->_noRender2 = true;
		}

		$table = Engine_Api::_()->getDbtable('users', 'user');
		$select = $table->select()
		->where('search = ?', 1)
		->where('member_count > ?', -1) //0)
		->order('member_count DESC')
		->limit(4);

		$popularusers = $table->fetchAll($select);
			
		if( count($popularusers) < 1 )
		{
			return $this->setNoRender();
		}

		$this->view->popularusers = $popularusers;
			
		$table = Engine_Api::_()->getDbtable('users', 'user');
		$select = $table->select()
		->where('search = ?', 1)
		->order('creation_date DESC')
		->limit(4);

		$users = $table->fetchAll($select);

		if( count($users) < 1 )
		{
			return $this->setNoRender();
		}

		$this->view->users = $users;
	}
}