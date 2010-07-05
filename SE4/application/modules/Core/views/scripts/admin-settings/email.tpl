<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: email.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>

<script type="text/javascript">
  var language_id = <?php echo $this->language_id;?>;

  var setEmailLanguage =function(language_id){
    window.location.href= en4.core.baseUrl+'admin/email/'+language_id;
    //alert(level_id);
  }

  var fetchEmailTemplate =function(template_id){
    window.location.href= en4.core.baseUrl+'admin/email/'+language_id+'/'+template_id;
    //alert(level_id);
  }
</script>


<div class='settings'>
  <?php echo $this->form->render($this); ?>
</div>