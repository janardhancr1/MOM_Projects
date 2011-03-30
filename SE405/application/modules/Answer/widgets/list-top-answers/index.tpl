<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 7319 2010-09-08 21:08:45Z jung $
 * @author     John
 */
?>
<?php foreach( $this->paginator as $categoryname => $answers ): ?>
<ul class="answers_browse">
      <li>
           <?php $temp = explode("||",$categoryname);?>
          		<h4><a href="index.php/answers/categories/<?php echo   $temp[1]?>"><?php echo  $temp[0]?></a></h4>
    	<?php foreach ($answers as $answerid => $answername): ?>
          <h4>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php/answers/view/<?php echo $answerid ?>"><?php echo $answername?></a>
          </h4>
      <?php endforeach; ?>
       </li>
</ul>
<?php endforeach; ?>