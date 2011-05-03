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
<div class='layout_middle'>
<center>
	<table cellpadding=0 cellpadding=0 width="100%" align="center">
	<tr>
		<td style="text-align:center;padding-bottom:10px">
			<h3>It's easy to be a part of the Momburbia Community.<br/>
			If you have a login, type it in below or click to join below.<br/>
			If you wish to use your facebook login, head to the homepage and click on the facebook button there.</h3>
		</td>
	</tr>
	</table>
	<table cellpadding=0 cellpadding=0 width="50%" align="center">
	<tr>
		<td style="padding-left:50px">
			<?php echo $this->form->render($this) ?>
		</td>
	</tr>
	<tr>
		<td style='vertical-align: top;padding-left:120px'>
		<br>
		<div class='mom_join' style='float:left'>
		 <center>
		 	<a class="join_link" href='index.php/signup'><?php echo $this->translate('Join Momburbia Today'); ?> </a>
		 </center>
		</div>	
		</td>
	</tr>
	</table>
</center>
</div>
