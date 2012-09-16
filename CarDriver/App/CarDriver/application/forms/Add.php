<?php
class Application_Form_Add extends Application_Form_MainForm
{
 	public  $elementDecoratorsTr = array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			);

	public 	$elementDecoratorsTd = array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			);

	public function init()
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$db_remote = $this->getDbConnection();
		$res = $db->query("SHOW TABLE STATUS LIKE 'rt_results_main'")->fetchAll();

		$this->addElement('Text', 'id', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'id',
		'value' => $res[0]['Auto_increment'],
		'tabindex' => 1,
		"readonly" => "readonly"
		));

		$this->addElement('Text', 'rt3_10mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-10 Accel',
		'tabindex' => 66,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		//$bg_year_ids_prepared[]= "Select from list";
		/*$objDOM = new DOMDocument();
		$objDOM->load("http://buyersguide.caranddriver.com/api/years?mode=xml");
		$xpath = new DOMXPath($objDOM);
		$query = '//response/data/row/name';
		$entries = $xpath->query($query);
		foreach( $entries as $entry )
		{
		    $name  = $entry->nodeValue;
		    $id  = $entry->previousSibling->nodeValue;
		    $bg_year_ids_prepared[$id]= $name;
		 }*/

		$this->addElement('Text', 'url_for_story_relationship', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'URL for story relationship',
		'tabindex' => 2,
		));

		$select = $db_remote->select()
	             ->from('bg_year')
	             ->order('name DESC');
        $bg_year_ids = $db_remote->query($select)->fetchAll();

		if (count($bg_year_ids)!=0){
				$bg_year_ids_prepared[]= "Select from list";
				foreach ($bg_year_ids as $Yea){
						$bg_year_ids_prepared[$Yea['id']]= $Yea['name'];
				}
		}
		//arsort($bg_year_ids_prepared);

		$this->addElement('Text', 'rt3_20mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-20 Accel',
		'tabindex' => 67,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'ez_id', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'EZ ID',
		'tabindex' => 3,
		));

		$this->addElement('Text', 'rt2_30_mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-30 Accel',
		'tabindex' => 68,
		'onkeydown' => 'return onlyFloat(event, this.value);',
		));


		$this->addElement('checkbox', 'suppress_public_display', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Suppress public display',
		'tabindex' => 4,
		));

		$this->addElement('Text', 'rt3_40mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-40 Accel',
		'tabindex' => 69,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));


		$this->addElement('Select', 'bg_year_id', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'Year(BG)',
		'tabindex' => 5,
		'MultiOptions' => $bg_year_ids_prepared,

		));

		$this->addElement('Text', 'rt3_50mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-50 Accel',
		'tabindex' => 70,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		/*$bg_make_ids_prepared[]= "Select from list";
		$objDOM = new DOMDocument();
		$objDOM->load("http://buyersguide.caranddriver.com/api/makes?mode=xml");
		$xpath = new DOMXPath($objDOM);
		$query = '//response/data/row/name';
		$entries = $xpath->query($query);
		foreach( $entries as $entry )
		{
		    $name  = $entry->nodeValue;
		    $id  = $entry->previousSibling->nodeValue;
		    $bg_make_ids_prepared[$id]= $name;
		 }*/

		 $select = $db_remote->select()
	             ->from('bg_make')
	             ->order('name ASC');
        $bg_make_ids = $db_remote->query($select)->fetchAll();

		if (count($bg_make_ids)!=0){
				$bg_make_ids_prepared[]= "Select from list";
				foreach ($bg_make_ids as $Mak){
						$bg_make_ids_prepared[$Mak['id']]= $Mak['name'];
				}
		}

		 $this->addElement('Select', 'bg_make_id', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'Make(BG)',
		'tabindex' => 6,
		'MultiOptions' => $bg_make_ids_prepared,
		'onchange' => 'AutoFillModel(this.value);'
		));

		$this->addElement('Text', 'rt_60_mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-60 Accel',
		'onkeydown' => 'return onlyFloat(event, this.value);',
		'tabindex' => 71,
		));


		$bg_model_ids_prepared[]= "Select from list";

		$session_makeid = new Zend_Session_Namespace('makeid');
		$session_global = new Zend_Session_Namespace('global');
    	$makeid = "0";
		if(isset($session_makeid->make_id))
		{
			//$makeid = $_SESSION['makid'];
			$makeid = $session_makeid->make_id;
			$bg_model_ids_prepared[]= "Select from list";
			/*$objDOM = new DOMDocument();
			$objDOM->load("http://buyersguide.caranddriver.com/api/models?mode=xml");
			$xpath = new DOMXPath($objDOM);
			$query = '//response/data/row/make_id';

			$entries = $xpath->query($query);
			foreach( $entries as $entry )
			{
				$make_id = $entry->nodeValue;
			    if($makeid == $make_id)
			    {
			    	$name  = $entry->previousSibling->nodeValue;
			    	$id  = $entry->previousSibling->previousSibling->nodeValue;
			    	$bg_model_ids_prepared[$id]= $name;
			    }
			 }*/

			$select = $db_remote->select()
		             ->from('bg_model')
		             ->where('make_id = ?', $makeid)
		             ->order('name ASC');
	        $bg_model_ids = $db_remote->query($select)->fetchAll();

			if (count($bg_model_ids)!=0){
					foreach ($bg_model_ids as $Mod){
							$bg_model_ids_prepared[$Mod['id']]= $Mod['name'];
					}
			}

		}

		$this->addElement('Select', 'bg_model_id', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'Model(BG)',
		'tabindex' => 7,
		'MultiOptions' => $bg_model_ids_prepared,
		'onchange' => 'AutoFillSubModel(this.value)'
		));

		$this->addElement('Text', 'rt3_70mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-70 Accel',
		'tabindex' => 72,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));





		$bg_submodel_ids_prepared[]= "Select from list";
		$session_yearid = new Zend_Session_Namespace('yearid');
		$session_global_year = new Zend_Session_Namespace('global_year');
    	//$modelid = $session_modelid->modelid;
		if(isset($session_yearid->year_id) && isset($session_yearid->model_id))
		{
			$yearid =$session_yearid->year_id;
			$modelid = $session_yearid->model_id;
			$bg_submodel_ids_prepared[]= "Select from list";
			/*$objDOM = new DOMDocument();
			$objDOM->load("http://buyersguide.caranddriver.com/api/submodels?mode=xml");
			$xpath = new DOMXPath($objDOM);
			$query = '//response/data/row/year_id';

	        $entries = $xpath->query($query);

			foreach( $entries as $entry)
			{
			    if($yearid == $entry->nodeValue && $modelid == $entry->previousSibling->nodeValue)
			    {
			    	$name  = $entry->previousSibling->previousSibling->nodeValue;
			    	$id  = $entry->previousSibling->previousSibling->previousSibling->nodeValue;
			    	$bg_submodel_ids_prepared[$id]= $name;
			    }
			 }*/

			/*$xml = file_get_contents("http://buyersguide.caranddriver.com/api/submodels/bymodelid?id=".$modelid."&mode=xml");
			$xml = str_replace("10best", "best10", $xml);

			$objDOM = new DOMDocument();
			$objDOM->loadXML($xml);
			$xpath = new DOMXPath($objDOM);
			$query = '//response/data/row/model_id';

			$entries = $xpath->query($query);
			foreach( $entries as $entry)
			{
				    if($yearid == $entry->nextSibling->nodeValue)
				    {
				    	$name  = $entry->previousSibling->nodeValue;
				    	$id  = $entry->previousSibling->previousSibling->nodeValue;
				    	$bg_submodel_ids_prepared[$id]= $name;
				    }
			 } */

			$select = $db_remote->select()
		             ->from('bg_submodel')
		             ->where('model_id = ?', $modelid)
		             ->where('year_id = ?', $yearid)
		             ->order('name ASC');
	        $bg_submodel_ids = $db_remote->query($select)->fetchAll();

		if (count($bg_submodel_ids)!=0){
					foreach ($bg_submodel_ids as $Mod){
							$bg_submodel_ids_prepared[$Mod['id']]= $Mod['name'];
					}
			}
		}

		$this->addElement('Select', 'bg_submodel_id', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'Sub-Model(BG)',
		'tabindex' => 8,
		'MultiOptions' => $bg_submodel_ids_prepared
		));

		$this->addElement('Text', 'rt3_80mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-80 Accel',
		'tabindex' => 73,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

        /* CDIM-1293 display years 1900 - 2020 */
		$rt_model_years_prepared[]= "Select from list";
		for ($my_year = 2020; $my_year >= 1900; $my_year--){
				$rt_model_years_prepared[$my_year] = $my_year;
		}

		$this->addElement('Select', 'rt_model_year', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'Year',
		'tabindex' => 9,
		'MultiOptions' => $rt_model_years_prepared
		));

		$this->addElement('Text', 'rt3_90mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-90 Accel',
		'tabindex' => 74,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));



		$rt_controlled_make_prepared = $this->gatMultioptions("Make");

		$this->addElement('Select', 'rt_controlled_make', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => '<a href="/index/manageconrolledlist/rt_types/5">Make</a>',
		'tabindex' => 10,
		'MultiOptions' => $rt_controlled_make_prepared
		));

		$this->rt_controlled_make->getDecorator('Label')->setOption('escape', false);

		$this->addElement('Text', 'rt2_100_mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-100 Accel',
		'onkeydown' => 'return onlyFloat(event, this.value);',
		'tabindex' => 75,
		));


		$select = $db->select()
	             ->from('rt_results_main');
        $rt_models = $db->query($select)->fetchAll();

        $rt_model_prepared[]= "Select from list";
		if (count($rt_models)!=0){
				foreach ($rt_models as $rt_mod){
						$rt_model_prepared[$rt_mod['rt_model']]= $rt_mod['rt_model'];
				}
		}

		$this->addElement('Text', 'rt_model', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'Model',
		'tabindex' => 11,
		//'MultiOptions' => $rt_model_prepared
		));

		$this->addElement('Text', 'rt3_110mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-110 Accel',
		'tabindex' => 76,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'rt_issue_year', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Mag Issue Year',
		'tabindex' => 12,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt3_120mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-120 Accel',
		'tabindex' => 77,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Select', 'rt_issue', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'Mag Issue Month',
		'tabindex' => 13,
		'MultiOptions' => array('0'=>'Select from list','01'=>'January', '02' => 'February',
								'03'=>'March','4'=>'April','05'=>'May','06'=>'June','07'=>'July',
								'08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December')
		));

		$this->addElement('Text', 'rt2_130_mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-130 Accel',
		'onkeydown' => 'return onlyFloat(event, this.value);',
		'tabindex' => 78,
		));

		$this->addElement('Select', 'rt_published', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'Web or Print',
		'tabindex' => 14,
		'MultiOptions' => array('Web'=>'Web','Print'=>'Print')
		));

		$this->addElement('Text', 'rt3_140mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-140 Accel',
		'tabindex' => 79,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$rt_controlled_sort_prepared = $this->gatMultioptions("Sort");

		$this->addElement('Select', 'rt_controlled_sort', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => '<a href="/index/manageconrolledlist/rt_types/7">Production Type</a>',
		'tabindex' => 15,
		'MultiOptions' => $rt_controlled_sort_prepared
		));

		$this->rt_controlled_sort->getDecorator('Label')->setOption('escape', false);

		$this->addElement('Text', 'rt3_150mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-150 Accel',
		'tabindex' => 80,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$rt_controlled_engine_prepared = $this->gatMultioptions("Engine");

		$this->addElement('Select', 'rt_controlled_engine', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => '<a href="/index/manageconrolledlist/rt_types/3">Engine Location</a>',
		'tabindex' => 16,
		'MultiOptions' => $rt_controlled_engine_prepared
		));

		$this->rt_controlled_engine->getDecorator('Label')->setOption('escape', false);

		$this->addElement('Text', 'rt3_160mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-160 Accel',
		'tabindex' => 81,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$rt_controlled_drive_prepared = $this->gatMultioptions("Drive");

		$this->addElement('Select', 'rt_controlled_drive', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => '<a href="/index/manageconrolledlist/rt_types/2">Driven Wheels</a>',
		'tabindex' => 17,
		'MultiOptions' => $rt_controlled_drive_prepared
		));

		$this->rt_controlled_drive->getDecorator('Label')->setOption('escape', false);

		$this->addElement('Text', 'rt3_170mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-170 Accel',
		'tabindex' => 82,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'rt2_passengers', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Number of Passengers',
		'tabindex' => 18,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt3_180mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-180 Accel',
		'tabindex' => 83,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));


		$this->addElement('Text', 'rt_doors', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Number of Doors',
		'tabindex' => 19,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt3_190mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-190 Accel',
		'tabindex' => 84,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$rt_controlled_body_prepared = $this->gatMultioptions("Body");

		$this->addElement('Select', 'rt_controlled_body', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => '<a href="/index/manageconrolledlist/rt_types/1">Body Style</a>',
		'tabindex' => 20,
		'MultiOptions' => $rt_controlled_body_prepared
		));

		$this->rt_controlled_body->getDecorator('Label')->setOption('escape', false);

		$this->addElement('Text', 'rt3_200mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '0-200 Accel',
		'tabindex' => 85,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'rt_base_price', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Base Price',
		'tabindex' => 21,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt_ss60', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => '5-60 ss accel',
		'onkeydown' => 'return onlyFloat(event, this.value);',
		'tabindex' => 86,
		));

		$this->addElement('Text', 'rt_base_price_notes', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Base Price Notes',
		'tabindex' => 22,
		));

		$this->addElement('Text', 'rt2_30_50TG', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Top-Gear Accel 30-50',
		'onkeydown' => 'return onlyFloat(event, this.value);',
		'tabindex' => 87,
		));

		$this->addElement('Text', 'rt_price_as_tested', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Price as Tested',
		'tabindex' => 23,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt2_50_70TG', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Top-Gear Accel 50-70',
		'onkeydown' => 'return onlyFloat(event, this.value);',
		'tabindex' => 88,
		));

		$this->addElement('Text', 'rt_price_as_tested_notes', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Price as Tested Notes',
		'tabindex' => 24,
		));

		$this->addElement('Text', 'rt2_sum_of_tg_times', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Sum of the above 2',
		'tabindex' => 89,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$rt_controlled_type_prepared = $this->gatMultioptions("Type");

		$this->addElement('Select', 'rt_controlled_type', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => '<a href="/index/manageconrolledlist/rt_types/11">Engine Type</a>',
		'tabindex' => 25,
		'MultiOptions' => $rt_controlled_type_prepared
		));

		$this->rt_controlled_type->getDecorator('Label')->setOption('escape', false);

		$this->addElement('Text', 'rt_quarter_time', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Quarter Mile Time',
		'onkeydown' => 'return onlyFloat(event, this.value);',
		'tabindex' => 90,
		));

		$this->addElement('Text', 'rt_no_cyl', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Number of Cylinders',
		'tabindex' => 26,
		));

		$this->addElement('Text', 'rt_speed_qtr_mile_speed_trap', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Quarter Trap Speed',
		'onkeydown' => 'return onlyDigits(event);',
		'tabindex' => 91,
		));


		$this->addElement('Text', 'rt3_bore_mm', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Cylinder Bore',
		'tabindex' => 27,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'rt_top_speed', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Top Speed',
		'tabindex' => 92,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt3_stroke_mm', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Cylinder Stroke',
		'tabindex' => 28,
		'onkeydown' => 'return onlyFloat(event);'
		));


		$rt_controlled_ts_limit_prepared = $this->gatMultioptions("TS limit");

		$this->addElement('Select', 'rt_controlled_ts_limit', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar; width:150px;',
		'label' => '<a href="/index/manageconrolledlist/rt_types/9">Top Speed Limit</a>',
		'tabindex' => 93,
		'MultiOptions' => $rt_controlled_ts_limit_prepared
		));

		$this->rt_controlled_ts_limit->getDecorator('Label')->setOption('escape', false);

		$this->addElement('Text', 'rt_disp_cc', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Engine Disp',
		'onkeydown' => 'return onlyDigits(event);',
		'tabindex' => 29,
		));

		$this->addElement('Text', 'rt_top_speed_notes', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Top Speed Notes',
		'tabindex' => 94,
		));

		$this->addElement('Text', 'rt3_comp_ratio', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Compression Ratio',
		'tabindex' => 30,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));


		$this->addElement('Text', 'rt_70_mph_braking', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Shortest 70',
		'onkeydown' => 'return onlyDigits(event);',
		'tabindex' => 95,
		));

		$this->addElement('Text', 'rt2_fuel_sys', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Fuel System',
		'tabindex' => 31,
		));

		$this->addElement('Text', 'rt2_skidpad', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Skidpad Grip',
		'tabindex' => 96,
		));


		$this->addElement('Text', 'rt3_valve_gear', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Valve Setup',
		'tabindex' => 32,
		));

		$this->addElement('Text', 'skidpad_diameter', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Skidpad diameter',
		'tabindex' => 97,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt3_valves_per_cyl', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Valves Per Cylinder',
		'tabindex' => 33,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt2_emergency_lane_change', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'MPH in Lane Change',
		'onkeydown' => 'return onlyFloat(event, this.value);',
		'tabindex' => 98,
		));

		$rt_controlled_turbo_superchg_prepared = $this->gatMultioptions("Turbo/Superchg");

		$this->addElement('Select', 'rt_controlled_turbo_superchg', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => '<a href="/index/manageconrolledlist/rt_types/10">Forced Induction</a>',
		'tabindex' => 34,
		'MultiOptions' => $rt_controlled_turbo_superchg_prepared
		));

		$this->rt_controlled_turbo_superchg->getDecorator('Label')->setOption('escape', false);



		$this->addElement('Text', 'rt_slalom', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Slalom Speed',
		'onkeydown' => 'return onlyFloat(event, this.value);',
		'tabindex' => 99,
		));

		$this->addElement('Text', 'rt3_boost_psi', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Boost in psi',
		'tabindex' => 35,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$rt_controlled_fuel_prepared = $this->gatMultioptions("Fuel");

		$this->addElement('Select', 'rt_controlled_fuel', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar; width:150px;',
		'label' => '<a href="/index/manageconrolledlist/rt_types/4">Fuel Type</a>',
		'tabindex' => 100,
		'MultiOptions' => $rt_controlled_fuel_prepared
		));

		$this->rt_controlled_fuel->getDecorator('Label')->setOption('escape', false);

		$this->addElement('Text', 'rt_peak_hp', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Peak Horsepower',
		'tabindex' => 36,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt3_fuel_cap', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Fuel Capacity',
		'tabindex' => 101,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'rt_rpm', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Peak Horsepower RPM',
		'onkeydown' => 'return onlyDigits(event);',
		'tabindex' => 37,
		));

		$this->addElement('Text', 'rt2_epa_city_fe', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'EPA City',
		'tabindex' => 102,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt_peak_hp_notes', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Peak Horsepower Notes',
		'tabindex' => 38,
		));

		$this->addElement('Text', 'rt2_epa_city_fe_notes', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'EPA City Notes',
		'tabindex' => 103,
		));

		$this->addElement('Text', 'rt_peak_torque', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Peak Torque',
		'tabindex' => 39,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt2_highway_fe', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'EPA Highway',
		'tabindex' => 104,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt_rpmt', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Peak Torque RPM',
		'tabindex' => 40,
		));

		$this->addElement('Text', 'rt2_highway_fe_notes', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'EPA HIghway Notes',
		'tabindex' => 105,
		));

		$this->addElement('Text', 'rt_peak_torque_notes', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Peak Torque Notes',
		'tabindex' => 41,
		));

		$this->addElement('Text', 'rt_cd_observed_fe', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'C/D Observed Economy',
		'onkeydown' => 'return onlyDigits(event);',
		'tabindex' => 106,
		));

		$this->addElement('Text', 'rt_redline', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Redline',
		'tabindex' => 42,
		));

		$this->addElement('Text', 'rt2_sound_level_idle', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Sound Level Idle',
		'tabindex' => 107,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt3_specific_power', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Spec pow (hp/liter)',
		'tabindex' => 43,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'rt2_wot', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'DB at Wot',
		'tabindex' => 108,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt_power_to_weight', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Power/Weight (hp/lb)',
		'onkeydown' => 'return onlyFloat(event, this.value);',
		'tabindex' => 44,
		));

		$this->addElement('Text', 'rt2_70cr', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'DB at 70 MPH Cruise',
		'tabindex' => 109,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$rt_controlled_transmission_prepared= $this->gatMultioptions("Transmission");

		$this->addElement('Select', 'rt_controlled_transmission', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => '<a href="/index/manageconrolledlist/rt_types/8">Transmission Type</a>',
		'tabindex' => 45,
		'MultiOptions' => $rt_controlled_transmission_prepared
		));

		$this->rt_controlled_transmission->getDecorator('Label')->setOption('escape', false);

		$this->addElement('Text', 'rt3_70co', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'DB at 70 Coast',
		'tabindex' => 110,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'rt3_final_drive_ratio', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Final Drive',
		'tabindex' => 46
		));

		$this->addElement('Text', 'rt3_lt_oil', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Long-term Oil Used',
		'tabindex' => 111,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt3_max_mph_1000_rpm', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Top Gear mph/1000rpm',
		'tabindex' => 47,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'rt3_lt_stps_sched', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'LT Scheduled Stops',
		'tabindex' => 112,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt3_wheelbase', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Wheelbase',
		'tabindex' => 48,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'rt3_lt_stps_unsched', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'LT Unscheduled Stops',
		'tabindex' => 113,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt3_length', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Length',
		'tabindex' => 49,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'rt3_lt_serv', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Costs for LT Service',
		'tabindex' => 114,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt3_width', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Width',
		'tabindex' => 50,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'rt3_lt_wear', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Costs for LT Wear',
		'tabindex' => 115,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt3_height', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Height',
		'tabindex' => 51
		));

		$this->addElement('Text', 'rt3_lt_repair', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Costs for LT Repair',
		'tabindex' => 116,
		'onkeydown' => 'return onlyDigits(event);'
		));

		$this->addElement('Text', 'rt3_frontal_area', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Frontal Area',
		'tabindex' => 52
		));

		$this->addElement('Text', 'rt2_50_mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'rt2_50_mph',
		'onkeydown' => 'return onlyFloat(event, this.value);',
		'tabindex' => 117,
		));

		$this->addElement('Text', 'rt3_frontal_area_notes', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Frontal Area Notes',
		'tabindex' => 53
		));


		$this->addElement('Text', 'rt2_70_mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'rt2_70_mph',
		'tabindex' => 118,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'rt3_cd', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Coefficient of Drag',
		'tabindex' => 54
		));

		$this->addElement('Text', 'rt3_et_factor', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'rt3_et_factor',
		'tabindex' => 119,
		));

		$this->addElement('Text', 'rt_weight', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Curb Weight',
		'onkeydown' => 'return onlyDigits(event);',
		'tabindex' => 55
		));

		$this->addElement('Text', 'rt3_road_hp_30mph', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'rt3_road_hp_30mph',
		'tabindex' => 120,
		));

		$this->addElement('Text', 'rt_percent_on_front', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Pct. Weight on Front',
		'onkeydown' => 'return onlyFloat(event, this.value);',
		'tabindex' => 56
		));


		$this->addElement('Text', 'rt3_sp_factor', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'rt3_sp_factor',
		'tabindex' => 121,
		));

		$this->addElement('Text', 'rt_percent_on_rear', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Pct. Weight on Rear',
		'onkeydown' => 'return onlyFloat(event, this.value);',
		'tabindex' => 57
		));

		$this->addElement('Text', 'rt3_peak_bmep', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'rt3_peak_bmep',
		'tabindex' => 122,
		));

		$this->addElement('Text', 'center_of_gravity_height', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Center of Gravity Height',
		'tabindex' => 58,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'rt3_peal_bmep', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'rt3_peal_bmep',
		'tabindex' => 123,
		));

		$select = $db->select()
	             ->from(array('rtd'=>'rt_dropdown_descriptions'),array('rtd.id_descriptions As dropdownid', 'rtd.description As description'))
	             ->joinInner(array('rtl'=>'rt_dropdown_lookup'),'rtl.id_descriptions=rtd.id_descriptions')
	             ->joinInner(array('rtdt'=>'rt_dropdown_types'),'rtdt.id_types=rtl.id_types')
	             ->where('rtdt.rt_types = ?', 'Airbags')
	             ->group('rtd.id_descriptions')
	             ->order('rtd.description ASC');

	    $results = $db->query($select)->fetchAll();

	    $multioptions_prepared = "";
	    $rt_controlled_airbags_prepared[0]= "Select from list";
		if (count($results)!=0){
				foreach ($results as $result){
						$rt_controlled_airbags_prepared[$result['dropdownid']]= $result['description'];
				}
		}

		$this->addElement('Select', 'rt2_controlled_airbags', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => '<a href="/index/manageconrolledlist/rt_types/6">Airbags</a>',
		'tabindex' => 59,
		'MultiOptions' => $rt_controlled_airbags_prepared
		));




		$bg_controlled_make_ids_prepared[0]= "Select from list";
		$this->addElement('Text', 'bg_controlled_make_id', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'bg_controlled_make_id',
		'tabindex' => 124,
		//'MultiOptions' => $bg_controlled_make_ids_prepared
		));

		$this->addElement('Text', 'rt2_int_vol_front', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Interior Volume Front',
		'tabindex' => 60
		));

		$this->rt2_controlled_airbags->getDecorator('Label')->setOption('escape', false);

		$bg_controlled_model_ids_prepared[0]= "Select from list";
		$this->addElement('Text', 'bg_controlled_model_id', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'bg_controlled_model_id',
		'tabindex' => 125,
		//'MultiOptions' => $bg_controlled_model_ids_prepared
		));

		$this->addElement('Text', 'rt2_mid', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Vol Behind Mid Row',
		'onkeydown' => 'return onlyDigits(event);',
		'tabindex' => 61
		));


		$this->addElement('Text', 'rt_original_table_id', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'rt_original_table_id',
		'tabindex' => 126,
		//'MultiOptions' => $rt_original_table_ids_prepared
		));

		$this->addElement('Text', 'rt2_rear', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Vol Behind Rear Row',
		'tabindex' => 62
		));

		$this->addElement('Text', 'first_stop_70', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'First stop 70',
		'tabindex' => 127,
		'onkeydown' => 'return onlyDigits(event, this.value);'
		));

		$this->addElement('Text', 'rt3_trunk', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Trunk Volume',
		'tabindex' => 63
		));


		$this->addElement('Select', 'rt2_traction_control', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'Traction Control?',
		'tabindex' => 128,
		'MultiOptions' => array('0'=>'No','1'=>'Yes')
		));

		$this->addElement('Text', 'rt2_turning_cir', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Turning Radius',
		'tabindex' => 64,
		'onkeydown' => 'return onlyFloat(event, this.value);'
		));

		$this->addElement('Text', 'longest_stop70', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Longest stop 70',
		'tabindex' => 129,
		'onkeydown' => 'return onlyDigits(event, this.value);'
		));

		$this->addElement('Select', 'rt2_anti_lock', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'Anti-Lock Brakes?',
		'tabindex' => 65,
		'MultiOptions' => array('0'=>'No','1'=>'Yes')
		));


		$this->addElement('Select', 'rt2_trac_defeatable', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'Tc Defeatable?',
		'tabindex' => 130,
		'MultiOptions' => array('0'=>'No','1'=>'Yes')
		));

		$this->addElement('Select', 'rt2_stability_control', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'Stability Control',
		'tabindex' => 131,
		'MultiOptions' => array('0'=>'No','1'=>'Yes')
		));

		$this->addElement('checkbox', 'transaction_off', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Traction off',
		'tabindex' => 132
		));

		$this->addElement('Text', 'rt2_stab_defeatable', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Esc Defeatable?',
		'tabindex' => 133,
		));

		$this->addElement('checkbox', 'partially_defeatable', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Partially defeatable',
		'tabindex' => 134
		));

		$this->addElement('checkbox', 'fully_defeatable', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Fully defeatable',
		'tabindex' => 135,
		));


		$this->addElement('checkbox', 'competition_mode', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Competition mode',
		'tabindex' => 136,
		));

		$this->addElement('checkbox', 'launch_control', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Launch control',
		'tabindex' => 137
		));

		$this->addElement('checkbox', 'permanent', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Permanent',
		'tabindex' => 138,
		));


		$this->addElement('Select', 'test_location', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar; width:150px;',
		'label' => 'Test location',
		'tabindex' => 139,
		'MultiOptions' => array(''=>'','willow'=>'willow','Milan'=>'Milan','Chelsea'=>'Chelsea')
		));

		$this->addElement('Text', 'test_notes', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'label' => 'Test notes',
		'tabindex' => 140,
		));

		$this->addElement('Text', 'test_location_detail', array(
		'decorators' => $this->elementDecoratorsTd,
		'style' => 'class:inputbar',
		'label' => 'Test location detail',
		'tabindex' => 141,
		));

		$this->addElement('Text', 'tester', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar',
		'maxlength' => 255,
		'label' => 'Tester',
		'tabindex' => 142,
		));

		$this->setAttrib('enctype', 'multipart/form-data');

		$this->addElement("Hidden", "image");

		$file_one = new Zend_Form_Element_File('image1');
        $file_one->setLabel('image')
        ->addValidator('Count', false, 1)
        ->setDestination('images');

		$file_one->setDecorators(array(
		 'File',
		 'Description',
		 'Errors',
		 array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		 array('Label', array('tag' => 'td','style' => 'float:right;')),
		 array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
		 ));

 		$this->addElement($file_one);

		$review_changes = new Zend_Form_Element_Submit('review_cganges');
		$review_changes->setLabel('Review');

		$review_changes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td', 'colspan' => 3,'align' => 'right')),
		));

		$cancel = new Zend_Form_Element_Submit('cancel');
		$cancel->setLabel('Cancel');

		$cancel->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td', 'colspan' => 4, 'align' => 'left')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));

		$this->addElements(array(
		$review_changes,
		$cancel));

		$this->setDecorators(array(
		'FormElements',
		array(array('data'=>'HtmlTag'),array('tag'=>'table ', 'align'=>'left', 'cellpadding' => '3', 'width' => '90%', 'class'=>'logintable', 'style' => 'font-weight:bold; font-family:arial; font-size:14px;')),
		'Form'
		));

	}

	private function gatMultioptions($type)
	{
		$db = Zend_Db_Table::getDefaultAdapter();

		$select = $db->select()
	             ->from(array('rtd'=>'rt_dropdown_descriptions'),array('rtl.id As dropdownid', 'rtd.description As description'))
	             ->joinInner(array('rtl'=>'rt_dropdown_lookup'),'rtl.id_descriptions=rtd.id_descriptions')
	             ->joinInner(array('rtdt'=>'rt_dropdown_types'),'rtdt.id_types=rtl.id_types')
	             ->where('rtdt.rt_types = ?', $type)
	             ->group('rtd.id_descriptions')
	             ->order('rtd.description ASC');

	    $results = $db->query($select)->fetchAll();

	    $multioptions_prepared = "";
		if (count($results)!=0){
				$multioptions_prepared[0]= "Select from list";
				foreach ($results as $result){
						$multioptions_prepared[$result['dropdownid']]= $result['description'];
				}
		}
		return $multioptions_prepared;
	}
}
?>
