<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: create.tpl 5332 2010-05-01 03:19:08Z alex $
 * @author     Jung
 */
?>
<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>  

<div class='layout_middle'>
<div class="headerline_header">
 <img src='./application/modules/Answer/externals/images/ans_ans48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
   <a href='/index.php/answers/create'> <?php echo $this->translate('Ask New Question');?></a>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/answers/manage'>Back to My Questions</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Questions and Answers on everything relating to being a mom.');?></div>
</div>
 <div style='padding-top:20px;padding-right:10px;width:680px'>
<?php echo $this->form->render($this) ?>

<script type="text/javascript">
  //<!--
  function getSubCats(cat_id) {
    (new Request.JSON({
      'format': 'json',
      'url' : '/index.php/answers/subcats',
      'data' : {
        'format' : 'json',
        'cat_id' : cat_id
      },
      'onRequest' : function(){
      },
      'onSuccess' : function(responseJSON, responseText)
      {
      	$('sub_cat_id').empty();
      	var subcats = responseText.split(';');
      	for(var i=0; i<subcats.length-1; i++)
      	{
      		var subcat = subcats[i].split('~');
      		$('sub_cat_id').options[i] = new Option(subcat[1], subcat[0]);
      	}
      	//document.getElementById('parent_cat_id').innerHTML = responseText;
      }
    })).send();
  }
  // -->
 </script>
</div>
</div>
