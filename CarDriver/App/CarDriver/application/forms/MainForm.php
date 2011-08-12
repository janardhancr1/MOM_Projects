<?php
class Application_Form_MainForm extends Zend_Form
{
	/**
     * Creates a connection to the database.
     *
     * @return void
     */
	public function getDbConnection()
	{
		$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', 'production');

		$db_remote = new Zend_Db_Adapter_Pdo_Mysql(array(
          'host'     => $config->external->db->params->host,
          'username' => $config->external->db->params->username,
          'password' => $config->external->db->params->password,
          'dbname'   => $config->external->db->params->dbname
        ));
        
        return $db_remote;
	}
	
/**
   * Adds default decorators to an existing element
   * 
   * @param Zend_Form_Element $element
   */
  public static function addDefaultDecorators(Zend_Form_Element $element)
  {
    $fqName = $element->getName();
    if( null !== ($belongsTo = $element->getBelongsTo()) ) {
      $fqName = $belongsTo . '-' . $fqName;
    }
    $element
      ->addDecorator('Description', array('tag' => 'p', 'class' => 'description', 'placement' => 'PREPEND'))
      ->addDecorator('HtmlTag', array('tag' => 'div', 'id'  => $fqName . '-element', 'class' => 'form-element'))
      ->addDecorator('Label', array('tag' => 'div', 'tagOptions' => array('id' => $fqName . '-label', 'class' => 'form-label')))
      ->addDecorator('HtmlTag2', array('tag' => 'div', 'id'  => $fqName . '-wrapper', 'class' => 'form-wrapper'));
  }
  
    /**
     * Load the default decorators
     *
     * @return void
     */
    public function loadDefaultDecorators()
    {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return;
        }
 
        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('FormElements')
                 ->addDecorator('Form')
                 ;
        }
    }
  
}
?>