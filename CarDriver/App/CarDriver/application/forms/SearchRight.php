<?php
class Application_Form_SearchRight extends Application_Form_MainForm
{
	public $makeid;
 
  	public function __construct($id) 
  	{ 
     	$this->makeid = $id;
     	parent::__construct();
     
  	} 
  	
	public function init()
	{
		$this
		->setAttribs(array(
        'id' => 'search_form',
        'class' => 'global_search_form',
		));
		
		$db = Zend_Db_Table::getDefaultAdapter(); 
		
		$select = $db->select()
	             ->from('bg_year')
	             ->where('state = ?', 'published')
	             ->order('name DESC');
        $years = $db->query($select)->fetchAll();
	       
		if (count($years)!=0){
				$years_prepared[0]= "Select or Leave blank";
				foreach ($years as $Yea){
						$years_prepared[$Yea['id']]= $Yea['name'];
				}
		}
		
		$year = $this->createElement('select','year')
		->setLabel('Year')
		->addMultiOptions($years_prepared);
		$this->addElement($year);
		
		$select = $db->select()
	             ->from(array('bg'=>'bg_make'),array('bg.id As makeid', 'bg.name As makename'))
	             ->joinInner(array('rt'=>'rt_results_main'),'bg.id=rt.bg_make_id')
	             ->where('bg.state = ?', 'published')
	             ->group('bg.name')
	             ->order('bg.name ASC');
	             
        $makes = $db->query($select)->fetchAll();
	       
		if (count($makes)!=0){
				$makes_prepared[0]= "Select or Leave blank";
				foreach ($makes as $mak){
						$makes_prepared[$mak['makeid']]= $mak['makename'];
				}
		}
		
		$make = $this->createElement('select','make')
		->setLabel('Make')
		->addMultiOptions($makes_prepared)
		->setAttrib('onChange', 'this.form.submit();');
		$this->addElement($make);
	             
	    if($this->makeid != 0)
	    {		
    		$select = $db->select()
             ->from('bg_model')
             ->where('state = ?', 'published')
             ->where('make_id = ?', $this->makeid)
             ->order('name ASC');
	        $result = $db->query($select);
	        $models = $result->fetchAll();
		       
			if (count($models)!=0){
					$models_prepared[0]= "Select or Leave blank";
					foreach ($models as $mod){
							$models_prepared[$mod['id']]= $mod['name'];
					}
			}
	    }
	    else
	     $models_prepared[0]= "Select or Leave blank";
		
		$model = $this->createElement('select','model')
		->setLabel('Model')
		->addMultiOptions($models_prepared);
		
		$this->addElement($model);
		
		$submit1 = $this->createElement('submit','submit1',array('label'=>'GO'));
		$this->addElement($submit1);
		
		$this->setElementDecorators(array(
			'ViewHelper',
			'Errors',
			array(array('data'=>'HtmlTag'),array('tag'=>'div', 'class'=>'form_element')),
			array('Label',array('tag'=>'div')),
			array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class'=>'form_wrapper'))
		));
		
		$this->setDecorators(array(
			'FormElements',
			array(array('data'=>'HtmlTag'),array('tag'=>'div')),
			'Form'
		));

	}
}
?>