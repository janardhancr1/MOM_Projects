<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6072 2010-06-02 02:36:45Z john $
 * @author     Jung
 */
?>
<h2><?php echo $this->translate("Member Level Settings") ?></h2>
<script type="text/javascript">
  var fetchLevelSettings =function(level_id){
    window.location.href= en4.core.baseUrl+'admin/forum/level/'+level_id;
    //alert(level_id);
  }
</script>

<div class='clear'>

<?php if( count($this->navigation) ): ?>
  <div class='tabs'>
    <?php
      // Render the menu
      //->setUlClass()
      echo $this->navigation()->menu()->setContainer($this->navigation)->render()
    ?>
  </div>
<?php endif; ?>

  <div class='settings'>
    <?php echo $this->form->render($this) ?>
  </div>

</div>