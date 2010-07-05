<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     Jung
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Form_Admin_Widget_Ads extends Engine_Form
{
  public function init()
  {
    // Set form attributes
    $this->setTitle('Ad Campaign');
    $this->setDescription('Please choose an advertisement campaign.');
    $this->setAttrib('id', 'form-upload');
    $this->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()));

    //
    $table = Engine_Api::_()->getDbtable('adcampaigns', 'core');
    $campaigns = $table->fetchAll();

    if (count($campaigns)!=0){
      $campaigns_prepared[0]= "";
      foreach ($campaigns as $campaign){
        $campaigns_prepared[$campaign->adcampaign_id]= $campaign->name;
      }

      // category field
      $this->addElement('Select', 'adcampaign_id', array(
            'multiOptions' => $campaigns_prepared
          ));
    }

    // init submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true,
    ));
  }
}