<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: requireuser.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */
?>
<div style='float: left; width: 570px; padding: 0px 10px 0px 10px;'>
	<div class='mom_tag_line'>
		<center>
			<?php echo $this->translate('A unique, safe and rewarding place <br> for Moms to stay connected'); ?> 
		</center>
	</div>
	<div style='clear:both;height:20px'>
	</div>
	<div style='padding-left:5px;float:left'>
		<img src='./application/modules/Core/externals/images/momshomeimage.gif' border='0' alt='' />
	</div>
</div>
<div style='float: left; width: 400px;padding-right:5px'>
<?php
  if( $this->form ):
    echo $this->form->render($this);
  else:
    echo $this->translate('Please sign in to continue.');
  endif;
?>
<div>
	<!--<div class='mom_socail_line' style='float:left;padding-top:10px;margin-left:10px'>
		 <center>
		 or
		 </center>
	</div>-->
	<div class='mom_join' style='float:left'>
		 <center>
		 	<a class="join_link" href='index.php/signup'><?php echo $this->translate('Join Momburbia Today'); ?> </a>
		 </center>
	</div>
</div>
<div style='height:10px;clear:both'>
</div>
<div class='mom_nosocail_line'>
 	<img src='./application/modules/Core/externals/images/home_bullet.gif' border='0' alt='' />&nbsp;
	 Meet and connect with other moms like you 
 </div>
 <div class='mom_nosocail_line'>
 	<img src='./application/modules/Core/externals/images/home_bullet.gif' border='0' alt='' />&nbsp;
	Enter fun and exciting contests to win great prizes 
 </div>
 <div class='mom_nosocail_line'>
 	<img src='./application/modules/Core/externals/images/home_bullet.gif' border='0' alt='' />&nbsp;
	Share your life through photos, videos and your own blog 
 </div>
 <div class='mom_nosocail_line'>
 	<img src='./application/modules/Core/externals/images/home_bullet.gif' border='0' alt='' />&nbsp;
	Buy and sell items from trusted moms 
 </div>
<!-- <div class='mom_nosocail_line'>
 	<img src='./application/modules/Core/externals/images/home_bullet.gif' border='0' alt='' />&nbsp;
	Check daily for recipes posted by top mom chefs 
 </div>-->
</div>
