<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Contests
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: browse.tpl 6398 2010-06-16 23:33:03Z steve $
 * @author     Steve
 */
?>
<?php include 'rightside.tpl' ?>  

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Contests/externals/images/contest_contest48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Momburbia has Moms in Mind... ');?>
    <div class="smallheadline"><?php echo $this->translate('Check the contest page daily and tell other moms about the great giveaways.');?></div>
</div>
<br />

<br />
<br />
<?php $href = "#"; ?>
<?php foreach ($this->paginator as $group): ?>
<?php $href = $group->getHref(); ?>
<?php endforeach; ?>
<center>
	<a href="<?php echo $href ?>"><img src='./application/modules/Contests/externals/images/CONTESTPAGEBANNERHOLIDAY.gif' border='0' alt='' /></a>
<br />
<br />
<div style='text-align:center'><a href="<?php echo $href ?>">Click here</a> to visit the Momburbia Contest Group and enter to win...</div>
</center>
</div>
<div style='text-align:center'><a href="/contests/rules">Click here</a> for Rules and Regulations</div>
</center>
</div>
</div>
