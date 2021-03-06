<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */
?>

<table width="100%">
<tr style='margin-bottom:5px'>
<?php $i=0; ?>
  <?php foreach( $this->users as $user ): ?>
   <td width="33%">
      <div class='newestmembers_info'>
        <div class='newestmembers_name'>
          <?php echo $this->htmlLink($user->getHref(), $user->getTitle()) ?>
        </div>
        <div class='newestmembers_date'>
          <?php echo $this->htmlLink($user->getHref(), $this->itemPhoto($user, 'thumb.icon'), array('class' => 'newestmembers_thumb')) ?>
        </div>
      </div>
    </td>
     <?php
     $i++;
     if ($i%3 == 0)
     echo "</tr><tr><td colspan='3'>&nbsp;</tr><tr>";
     ?>
  <?php endforeach; ?>
</tr>
 </table>