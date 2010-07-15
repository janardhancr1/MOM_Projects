<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Create.php 6241 2010-06-10 01:54:01Z jung $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Answer_Form_Create extends Engine_Form
{
  public function init()
  {   
   $this
      ->setAttribs(array(
        'id' => 'filter_form',
        'class' => 'global_answer_box',
      ))
      ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()))
      ;
    
     $this->addElement('Text', 'question', array(
      'size' => '50',
      'maxlength' => '100',
      'value' => 'What Would You Like to Know?',
     'onfocus' => "if(this.value == 'What Would You Like to Know?') this.value='';",
     'onblur'=> "if(this.value.length == 0) this.value='What Would You Like to Know?';",
    ));
    
	$this->addElement('Text', 'additionalDetails',array(
      'label'=>'Additional Details (Optional)',
	  'size' => '50',
      'maxlength' => '100',
    ));
    // init to
    $this->addElement('Text', 'tags',array(
      'label'=>'Tags - help moms find your question, i.e.', 
      'size' => '50',
      'maxlength' => '100',
    ));
  
    
    // prepare categories
    $categories = Engine_Api::_()->answer()->getCategories();
    if (count($categories)!=0){
      $categories_prepared[0]= "";
      foreach ($categories as $category){
        $categories_prepared[$category->category_id]= $category->category_name;
      }

      // category field
      $this->addElement('Select', 'category_id', array(
            'label' => 'Category',
            'multiOptions' => $categories_prepared
          ));
    }

    $this->addElement('Button', 'submit', array(
      'label' => 'Ask Question',
      'type' => 'submit',
    ));
    

  }
  
 /* public function postEntry()
  {
    $values = $this->getValues();
    
    $user = Engine_Api::_()->user()->getViewer();
    $title = $values['title'];
    $body = $values['body'];
    $category_id = $values['category_id'];
    $tags = preg_split('/[,]+/', $values['tags']);

    $db = Engine_Db_Table::getDefaultAdapter();
    $db->beginTransaction();
    try{
      // Transaction
      $table = Engine_Api::_()->getDbtable('blogs', 'blog');

      // insert the blog entry into the database
      $row = $table->createRow();
      $row->owner_id   =  $user->getIdentity();
      $row->owner_type = $user->getType();
      $row->category_id = $category_id;
      $row->creation_date = date('Y-m-d H:i:s');
      $row->modified_date   = date('Y-m-d H:i:s');
      $row->title   = $title;
      $row->body   = $body;
      //$row->category_id = $category_id;
      $row->save();

      $blog_id = $row->blog_id;

      if ($tags)
      {
        $this->handleTags($blog_id,$tags);
      }

      $attachment = Engine_Api::_()->getItem($row->getType(), $blog_id);
      $action = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($user, $row, 'blog_new');
      Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $attachment);
      $db->commit();
    }
    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
    //      $action = $api->addActivity($viewer, $viewer, 'status', $body);
    //  $api->attachActivity($action, $attachment);
  }*/

  public function handleTags($blog_id, $tags){
      $tagTable = Engine_Api::_()->getDbtable('tags', 'blog');
      $tabMapTable = Engine_Api::_()->getDbtable('tagmaps', 'blog');
      $tagDup = array();
      foreach( $tags as $tag )
      {

        $tag = htmlspecialchars((trim($tag)));
        if (!in_array($tag, $tagDup) && $tag !="" && strlen($tag)< 20){
          $tag_id = $this->checkTag($tag);
          // check if it is new. if new, createnew tag. else, get the tag_id and insert
          if (!$tag_id){
            $tag_id = $this->createNewTag($tag, $blog_id, $tagTable);
          }

          $tabMapTable->insert(array(
            'blog_id' => $blog_id,
            'tag_id' => $tag_id
          ));
          $tagDup[] = $tag;
        }
        if (strlen($tag)>= 20){
          $this->_error[] = $tag;
        }
      }
   }

  public function checkTag($text){
    $table = Engine_Api::_()->getDbtable('tags', 'blog');
    $select = $table->select()->order('text ASC')->where('text = ?', $text);
    $results = $table->fetchRow($select);
    $tag_id = "";
    if($results) $tag_id = $results->tag_id;
    return $tag_id;
  }

  public function createNewTag($text, $blog_id, $tagTable){
    $row = $tagTable->createRow();
    $row->text =  $text;
    $row->save();
    $tag_id = $row->tag_id;

    return $tag_id;
  }

}