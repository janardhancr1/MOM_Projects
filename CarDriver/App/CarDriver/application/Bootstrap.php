<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	public function init()
	{
		Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');
	}
}

