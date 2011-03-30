<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 7319 2010-09-08 21:08:45Z jung $
 * @author     John
 */
?>


  <?php $cnt = 0; $cssClass = "active"; ?>
  <div class="clearfix css3pie roundedBox popularGroups">
  <h3>Popular Momburbia Groups</h3>

	<a href="/groups" alt="Find a Group" class="findGroup">Find a group &raquo;</a>
	<p>Groups are the best place to meet and chat with other moms who share your interests and lifestyle.</p>
	<br/>
	<div class="groupSampleContainer">
	<?php foreach( $this->categories as $category ): ?>
	<?php if($cnt > 0) $cssClass = "hidden"; ?>
		<div class="groupBox <?php echo $cssClass ?>" id="groupBox_<?php echo $cnt ?>">
		<div class="groupCategory"><a href="/groups/active.php?type=cafemom&cat=preg_main" alt="<?php echo  $category->title ?>"><?php echo  $category->title ?></a></div>
		<ul class="clearfix groupList">
		<?php foreach( $this->paginator as $group ): ?>
		
		<?php if($group->category_id == $category->category_id) {?>
			<li>
				<?php echo $this->htmlLink($group->getHref(), $this->itemPhoto($group, 'thumb.normal')) ?>
				<h4><?php echo $this->htmlLink($group->getHref(), $group->getTitle()) ?></h4>
			</li>
		<?php } ?>
      
     <?php endforeach; ?>
     </div>
     <?php $cnt++; ?>
  	<?php endforeach; ?>
  <div>
  <ul class="groupCategories">
  <?php $cnt = 0; $cssClass = "active"; ?>
  <?php foreach( $this->categories as $category ): ?>
  <?php if($cnt > 0) $cssClass = ""; ?>
  		<li id="groupCategory_<?php echo $cnt ?>" class="<?php echo $cssClass ?>">
  			<a href="javascript:void(<?php echo $cnt ?>);" onClick="clickBox(<?php echo $cnt ?>);" class="<?php echo $cssClass ?>" id="groupCat_<?php echo $cnt ?>"><span><?php echo  $category->title ?></span></a>
   		</li>
  <?php $cnt++; ?>
  <?php endforeach; ?>
  </ul>
  </div>
</div>
</div>
<script>
var rotationTimeout = null;
var currentIndex = 0;
function rotateBox() { showBox(currentIndex+1 > 4 ? 0 : currentIndex+1); }
function showBox(index) { 
document.getElementById("groupBox_"+(currentIndex)).className = "groupBox hidden";
document.getElementById("groupCat_"+(currentIndex)).className = "";
document.getElementById("groupBox_"+(index)).className = "groupBox active"
document.getElementById("groupCat_"+(index)).className = "active";
document.getElementById("groupCategory_"+(currentIndex)).className = "";
document.getElementById("groupCategory_"+(index)).className = "active";
currentIndex = index;
}
function clickBox(index){
if (currentIndex != index) { showBox(index); }
if(rotationTimeout) { window.clearTimeout(rotationTimeout); }
return false;
}
rotationTimeout = window.setInterval(rotateBox, 6000);
</script>