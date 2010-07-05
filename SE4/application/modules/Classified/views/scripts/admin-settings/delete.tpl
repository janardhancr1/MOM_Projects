<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: delete.tpl 6537 2010-06-23 22:51:46Z shaun $
 * @author     Jung
 */
?>

  <form method="post" class="global_form_popup">
    <div>
      <h3><?php echo $this->translate("Delete Classified Category?") ?></h3>
      <p>
        <?php echo $this->translate("CLASSIFIEDS_VIEWS_SCRIPTS_ADMINSETTINGS_DELETE_DESCRIPTION") ?>
      </p>
      <br />
      <p>
        <input type="hidden" name="confirm" value="<?php echo $this->blog_id?>"/>
        <button type='submit'><?php echo $this->translate("Delete") ?></button>
        <?php echo $this->translate(" or ") ?> 
        <a href='<?php echo $this->url(array(), 'blog_manage', true) ?>'>
        <?php echo $this->translate("cancel") ?></a>
      </p>
    </div>
  </form>

<?php if( @$this->closeSmoothbox ): ?>
<script type="text/javascript">
  TB_close();
</script>
<?php endif; ?>
