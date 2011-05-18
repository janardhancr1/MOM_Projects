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
	   $db = new Zend_Db_Adapter_Pdo_Mysql(array(
          'host'     => 'localhost',
          'username' => 'root',
          'password' => 'kamflex',
          'dbname'   => 'cardriver'
        ));
        
        return $db;
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