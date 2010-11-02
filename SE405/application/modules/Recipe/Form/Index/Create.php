<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Create.php 6241 2010-06-10 01:54:01Z jung $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Recipe_Form_Index_Create extends Engine_Form
{
  public function init()
  {
    //$this->setTitle('Create Recipe')
    //     ->setDescription('Create your recipe below, then click "Create Recipe" to start your recipe.');
    
    $auth = Engine_Api::_()->authorization()->context;
    $user = Engine_Api::_()->user()->getViewer();

    $this->addElement('text', 'title', array(
        'label' => 'Recipe Name',
        'required' => true,
        'maxlength' => 63,
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '63'))
        ),
      ));
     
       
    $this->addElement('textarea', 'description', array(
        'label' => 'Description',
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '200'))
        ),
      ));
  // prepare categories
		$categories = Engine_Api::_()->recipe()->getCategories();
		if (count($categories)!=0){
			$categories_prepared[0]= "";
			foreach ($categories as $category){
					$categories_prepared[$category->category_id]= $category->category_name;
			}

			// category field
			$this->addElement('Select', 'category_id', array(
            'label' => 'Category',
            'multiOptions' => $categories_prepared,
      		'style' => 'width:202px',
			));
		}

    $this->addElement('text', 'recipe_tags', array(
        'label' => 'Tags',
        'maxlength' => 255,
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '255'))
        ),
      ));
      
    $this->addElement('text', 'recipe_prep_tm', array(
        'label' => 'Preparation Time',
    	'description' => '(ie. 10 Mins)',
        'maxlength' => 100,
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '100'))
        ),
      ));
      $this->recipe_prep_tm->getDecorator('Description')->setOption('placement', 'append');
      
    $this->addElement('text', 'recipe_cook_tm', array(
        'label' => 'Cooking Time',
    'description' => '(ie. 10 Mins)',
        'maxlength' => 100,
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '100'))
        ),
      ));
       $this->recipe_cook_tm->getDecorator('Description')->setOption('placement', 'append');
       
    $this->addElement('text', 'recipe_serve_to', array(
        'label' => 'How many people does it serve?',
        'maxlength' => 100,
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '100'))
        ),
      ));
      
    $this->addElement('Select', 'recipe_difficulty', array(
      'label' => 'Difficulty',
      'multiOptions' => array("Easy"=>"Easy - for beginners", 
      						  "Medium"=>"Medium - some experience needed",
                              "Difficult"=>"Difficult - for experienced cooks" ),
      'value' => 'Easy - for beginners',
    ));
    
    $this->addElement('textarea', 'recipe_ingredients', array(
        'label' => 'Ingredients',
    	'description' => '(List each ingredient on a separate line)',
        'required' => true,
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
        ),
      ));
       $this->recipe_ingredients->getDecorator('Description')->setOption('placement', 'append');
      
    $this->addElement('textarea', 'recipe_method', array(
        'label' => 'Method',
    	'description' => '(List each step on a separate line)',
        'required' => true,
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
        ),
      ));
       $this->recipe_method->getDecorator('Description')->setOption('placement', 'append');
      
       $this->addElement('checkbox', 'recipe_vege', array(
        'label' => 'Suitable for vegetarians?',
        'disableTranslator' => true
      ));
      
     $this->addElement('Checkbox', 'recipe_vegan', array(
      'label' => 'Suitable for vegans?',
      'disableTranslator' => true
    ));
    
    $this->addElement('Checkbox', 'recipe_dairy', array(
      'label' => 'Dairy free?',
      'disableTranslator' => true
    ));
    
    $this->addElement('Checkbox', 'recipe_gluten', array(
      'label' => 'Gluten free?',
      'disableTranslator' => true
    ));
    
    $this->addElement('Checkbox', 'recipe_nut', array(
      'label' => 'nutfree?',
      'disableTranslator' => true
    ));

	$availableLabels = array(
      'everyone'       => 'Everyone',
      'owner_network' => 'Friends and Networks',
      'owner_member_member'  => 'Friends of Friends',
      'owner_member'         => 'Friends Only',
      'owner'          => 'Just Me'
    );

    // Init profile view

    $options = (array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('poll', $user, 'auth_view');
    $options = array_intersect_key($availableLabels, array_flip($options));


    $this->addElement('Select', 'views', array(
      'label' => 'Privacy',
      'description' => 'Who may see this recipe?',
      'multiOptions' => $options,
      'value' => 'everyone',
    ));
    $this->views->getDecorator('Description')->setOption('placement', 'append');
    
     // Comment
    // Init profile comment
    $options =(array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('poll', $user, 'auth_comment');
    $options = array_intersect_key($availableLabels, array_flip($options));

    $this->addElement('Select', 'comments', array(
      'label' => 'Comment Privacy',
      'description' => 'Who may post comments on this recipe?',
      'multiOptions' => $options,
      'value' => 'everyone',
    ));
    $this->comments->getDecorator('Description')->setOption('placement', 'append');
    
    $this->addElement('button', 'submit', array(
        'label' => 'Create recipe',
        'type' => 'submit'
      ));
  }

  public function save()
  {
    $db_recipes       = Engine_Api::_()->recipe()->api()->getDbtable('recipes', 'recipe');
    $db_recipeOptions = Engine_Api::_()->recipe()->api()->getDbtable('options', 'recipe');
    $censor         = new Engine_Filter_Censor();
    
    // @todo find a better way to trick Zend_Form
   /* $options = array();
    foreach ($_POST['optionsArray'] as $option)
      if (strlen(trim($option)))
        $options[] = strip_tags(trim($option));
    $max_options = Engine_Api::_()->getApi('settings', 'core')->getSetting('recipes.maxOptions', 15);
    while (count($options) > $max_options)
      array_pop($options);

    if (count($options) < 2) {
      $this->setErrors(array('You must provide at least two possible answers.'));
      return false;
    }*/

    // try/catch being done in controller
    $recipe = $db_recipes->createRow();
    $recipe->user_id           = Engine_Api::_()->user()->getViewer()->getIdentity();
    $recipe->is_closed         = 0;
    $recipe->title             = $this->getElement('title')->getValue();
    $recipe->description       = $this->getElement('description')->getValue();
    $recipe->category_id       = $this->getElement('category_id')->getValue();
    $recipe->recipe_tags              = $this->getElement('recipe_tags')->getValue();
    $recipe->recipe_prep_tm   = $this->getElement('recipe_prep_tm')->getValue();
    $recipe->recipe_cook_tm       = $this->getElement('recipe_cook_tm')->getValue();
    $recipe->recipe_serve_to         = $this->getElement('recipe_serve_to')->getValue();
    $recipe->recipe_difficulty        = $this->getElement('recipe_difficulty')->getValue();
    $recipe->recipe_ingredients       = $this->getElement('recipe_ingredients')->getValue();
    $recipe->recipe_method            = $this->getElement('recipe_method')->getValue();
    $recipe->recipe_vege       = $this->getElement('recipe_vege')->getValue();
    $recipe->recipe_vegan            = $this->getElement('recipe_vegan')->getValue();
    $recipe->recipe_dairy         = $this->getElement('recipe_dairy')->getValue();
    $recipe->recipe_gluten        = $this->getElement('recipe_gluten')->getValue();
    $recipe->recipe_nut           = $this->getElement('recipe_nut')->getValue();
    $recipe->views             = $this->getElement('views')->getValue();
    $recipe->comments          = $this->getElement('comments')->getValue();
    $recipe->creation_date = date('Y-m-d H:i:s');
    $recipe->save();

    #foreach ($this->getElement('options')->getValue() as $option) {
    /*foreach ($options as $option) {
      if (trim($option) != '') {
        $row = $db_recipeOptions->createRow();
        $row->recipe_id      = $recipe->recipe_id;
        $row->recipe_option  = $censor->filter(trim($option));
        $row->save();
      }
    }*/

    return $recipe->recipe_id;

  }
}