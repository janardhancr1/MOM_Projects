<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: delete.tpl 6072 2010-06-02 02:36:45Z john $
 * @author     Jung
 */
?>

<form method="post" class="global_form_popup" action="<?php echo $this->url(array()) ?>">
  <div>
    <h3><?php echo $this->translate("Delete Group?") ?></h3>
    <p>
      <?php echo $this->translate("Are you sure that you want to delete this group? It will not be recoverable after being deleted.") ?>
    </p>
    <br />
    <p>
      <input type="hidden" name="confirm" value="<?php echo $this->group_id?>"/>
      <button type='submit'><?php echo $this->translate("Delete") ?></button>
      <?php echo $this->translate("or") ?> <a href='javascript:void(0);' onclick='javascript:parent.Smoothbox.close()'>
      <?php echo $this->translate("cancel") ?></a>
    </p>
  </div>
</form>

<?php if( @$this->closeSmoothbox ): ?>
  <script type="text/javascript">
    TB_close();
  </script>
<?php endif; ?>
