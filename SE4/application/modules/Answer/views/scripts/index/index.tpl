<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answers
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6160 2010-06-05 02:20:37Z alex $
 * @author     Jung
 */
?>


<!-- <div class="headline">
  <h2>
    <?php echo $this->translate('Answers');?>
  </h2>
  <div class="tabs">
    <?php
      // Render the menu
      echo $this->navigation()
        ->menu()
        ->setContainer($this->navigation)
        ->render();
    ?>
  </div>
</div> -->

<div class='layout_right'>
 
  <!--
  <?php if( $this->can_create): ?>
  <div class="quicklinks">
    <ul>
      <li>
        <a href='<?php echo $this->url(array(), 'blog_create', true) ?>' class='buttonlink icon_blog_new'><?php echo $this->translate('Write New Entry');?></a>
      </li>
    </ul>
  </div>
  <?php endif; ?>-->
</div>

<div class='layout_middle'>
	<div class="headline_header">
		<img src='./application/modules/Answer/externals/images/ans_ans48.gif' border='0' class='icon_big'>
		<h2>
	    <?php echo $this->translate('Momburbia Answers');?><br/>
	    <div class="smallheadline"><?php echo $this->translate('Ask, Answer and Explore. Questions and Answers on everything relating to being a mom.');?></div>
	  </h2>
	  
	</div>
	<div>
	  <?php echo $this->form->render($this) ?>
	</div>
	<div>
	&nbsp;
	</div>
	<div>
	  <?php echo $this->form1->render($this) ?>
	</div>
	<div>
	
		<?php echo $this->form2->render($this) ?>
	</div>
</div>
