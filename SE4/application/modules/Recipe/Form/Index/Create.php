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
    

    $this->addElement('text', 'tags', array(
        'label' => 'Tags',
        'maxlength' => 255,
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '255'))
        ),
      ));
      
    $this->addElement('text', 'preparationTime', array(
        'label' => 'Preparation Time',
        'maxlength' => 100,
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '100'))
        ),
      ));
      
    $this->addElement('text', 'cookingTime', array(
        'label' => 'Cooking Time',
        'maxlength' => 100,
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '100'))
        ),
      ));
    $this->addElement('text', 'numPeople', array(
        'label' => 'How many people does it serve?',
        'maxlength' => 100,
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '100'))
        ),
      ));
      
    $this->addElement('Select', 'difficulty', array(
      'label' => 'Difficulty',
      'multiOptions' => array("Easy"=>"Easy - for beginners", 
      						  "Medium"=>"Medium - some experience needed",
                              "Difficult"=>"Difficult - for experienced cooks" ),
      'value' => 'Easy - for beginners',
    ));
    
    $this->addElement('textarea', 'ingredients', array(
        'label' => 'Ingredients',
        'required' => true,
        'maxlength' => 100,
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '100'))
        ),
      ));
      
    $this->addElement('textarea', 'method', array(
        'label' => 'Method',
        'required' => true,
        'maxlength' => 100,
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '100'))
        ),
      ));
      
       $this->addElement('checkbox', 'vegetarians', array(
        'label' => 'Suitable for vegetarians?',
        'value' => 1,
        'disableTranslator' => true
      ));
      
     $this->addElement('Checkbox', 'vegans', array(
      'label' => 'Suitable for vegans?',
      'value' => 1,
      'disableTranslator' => true
    ));
    
    $this->addElement('Checkbox', 'dairyfree', array(
      'label' => 'Dairy free?',
    'value' => 1,
      'disableTranslator' => true
    ));
    
    $this->addElement('Checkbox', 'glutenfree', array(
      'label' => 'Gluten free?',
      'value' => 1,
      'disableTranslator' => true
    ));
    
    $this->addElement('Checkbox', 'nutfree', array(
      'label' => 'nutfree?',
      'value' => 1,
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


    $this->addElement('Select', 'auth_view', array(
      'label' => 'Privacy',
      'description' => 'Who may see this poll?',
      'multiOptions' => $options,
      'value' => 'everyone',
    ));
    $this->auth_view->getDecorator('Description')->setOption('placement', 'append');
    
     // Comment
    // Init profile comment
    $options =(array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('poll', $user, 'auth_comment');
    $options = array_intersect_key($availableLabels, array_flip($options));

    $this->addElement('Select', 'auth_comment', array(
      'label' => 'Comment Privacy',
      'description' => 'Who may post comments on this poll?',
      'multiOptions' => $options,
      'value' => 'everyone',
    ));
    $this->auth_comment->getDecorator('Description')->setOption('placement', 'append');
    
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
    $recipe->recipe_name             = $this->getElement('title')->getValue();
    $recipe->recipe_description       = $this->getElement('description')->getValue();
    $recipe->recipe_tags              = $this->getElement('tags')->getValue();
    $recipe->recipe_prep_tm   = $this->getElement('preparationTime')->getValue();
    $recipe->recipe_cook_tm       = $this->getElement('cookingTime')->getValue();
    $recipe->recipe_serve_to         = $this->getElement('numPeople')->getValue();
    $recipe->recipe_difficulty        = $this->getElement('difficulty')->getValue();
    $recipe->recipe_ingredients       = $this->getElement('ingredients')->getValue();
    $recipe->recipe_method            = $this->getElement('method')->getValue();
    $recipe->recipe_vege       = $this->getElement('vegetarians')->getValue();
    $recipe->recipe_vegan            = $this->getElement('vegans')->getValue();
    $recipe->recipe_dairy         = $this->getElement('dairyfree')->getValue();
    $recipe->recipe_gluten        = $this->getElement('glutenfree')->getValue();
    $recipe->recipe_nut           = $this->getElement('nutfree')->getValue();
    $recipe->views             = $this->getElement('auth_view')->getValue();
    $recipe->comments          = $this->getElement('auth_comment')->getValue();
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