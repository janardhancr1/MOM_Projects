<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: edit.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     Sami
 */
?>
<script type="text/javascript">
function updateUploader()
{
  if($('photo_delete').checked) {
    $('photo_group-wrapper').style.display = 'block';
  }
  else 
  {
    $('photo_group-wrapper').style.display = 'none';
  }
}
</script>

<h2><?php echo $this->translate('Edit Post');?></h2>
<?php echo $this->form->render($this) ?>
