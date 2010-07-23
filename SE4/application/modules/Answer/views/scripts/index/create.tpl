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
    <?php echo $this->translate('Ask New Question');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/answers/manage'>Back to My Questions</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Questions and Answers on everything relating to being a mom.');?></div>
</div>
 <div style='padding-top:20px;padding-right:10px;width:680px'>
<?php echo $this->form->render($this) ?>
</div>
</div>
