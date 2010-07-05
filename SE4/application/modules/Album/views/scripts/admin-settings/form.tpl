<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: form.tpl 6541 2010-06-23 23:03:28Z shaun $
 * @author     Jung
 */
?>


<?php echo $this->form->setAttrib('class', 'global_form_popup')->render($this) ?>


<?php if( @$this->closeSmoothbox ): ?>
<script type="text/javascript">
  TB_close();
</script>
<?php endif; ?>
