<?php
class Application_Form_SearchRight extends Application_Form_MainForm
{
	public function init()
	{
		$db = $this->getDbConnection();
		$select = $db->select()
	             ->from('bg_year')
	             ->where('state = ?', 'published');
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
	             ->from('bg_make')
	             ->where('state = ?', 'published');
        $makes = $db->query($select)->fetchAll();
	       
		if (count($makes)!=0){
				$makes_prepared[0]= "Select or Leave blank";
				foreach ($makes as $mak){
						$makes_prepared[$mak['id']]= $mak['name'];
				}
		}
		
		$make = $this->createElement('select','make')
		->setLabel('Make')
		->addMultiOptions($makes_prepared);
		$this->addElement($make);
		
		$select = $db->select()
	             ->from('bg_model')
	             ->where('state = ?', 'published');
        $result = $db->query($select);
        $models = $result->fetchAll();
	       
		if (count($models)!=0){
				$models_prepared[0]= "Select or Leave blank";
				foreach ($models as $mod){
						$models_prepared[$mod['id']]= $mod['name'];
				}
		}
		
		$model = $this->createElement('select','model')
		->setLabel('Model')
		->addMultiOptions($models_prepared);
		
		$this->addElement($model);
		
		$submit1 = $this->createElement('submit','submit1',array('label'=>'GO'));
		$this->addElement($submit1);
		
		// Code for Custom Decorators here ...
		
		$year->setDecorators(array(
		'ViewHelper',
		'Errors',
		array(array('data'=>'HtmlTag'), array('tag' =>'div','class' =>'element', 'style' => 'float:left; padding-top:5px;')),
		array('Label',array('tag'=>'div', 'style' => 'font-family:arial; font-weight:bold; font-size:14px;')),
		array(array('row'=>'HtmlTag'), array('tag' =>'div','class' =>'element', 'style' => 'float:left;padding-left:50px; ')),
		
		));
		
		$make->setDecorators(array(
		'ViewHelper',
		'Errors',
		array(array('data'=>'HtmlTag'), array('tag' =>'div','class' =>'element', 'style' => 'float:left; padding-top:5px;')),
		array('Label',array('tag'=>'div', 'style' => 'font-family:arial; font-weight:bold; font-size:14px;')),
		array(array('row'=>'HtmlTag'), array('tag' =>'div','class' =>'element', 'style' => 'float:left;padding-left:50px; ')),
		
		));
		
		$model->setDecorators(array(
		'ViewHelper',
		'Errors',
		array(array('data'=>'HtmlTag'), array('tag' =>'div','class' =>'element', 'style' => 'float:left; padding-top:5px;')),
		array('Label',array('tag'=>'div', 'style' => 'font-family:arial; font-weight:bold; font-size:14px;')),
		array(array('row'=>'HtmlTag'), array('tag' =>'div','class' =>'element', 'style' => 'float:left;padding-left:50px; ')),
		
		));
		
		$submit1->setDecorators(array(
		'ViewHelper',
		array(array('data'=>'HtmlTag'),array('tag'=>'div','class'=>'element' , 'style' => 'float:left;padding-top: 20px; padding-left:8px;')),
		array(array('row'=>'HtmlTag'), array('tag' =>'div','class' =>'element', 'style' => 'float:left;')),
		));
	}
}
?>