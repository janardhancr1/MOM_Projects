<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: form.tpl 4997 2010-04-14 01:09:44Z jung $
 * @author     Jung
 */
?>

<?php echo $this->form->setAttrib('class', 'global_form_popup')->render($this) ?>


<?php if( @$this->closeSmoothbox ): ?>
<script type="text/javascript">
  TB_close();
</script>
<?php endif; ?>
