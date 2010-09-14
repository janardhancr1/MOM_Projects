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

<h2>
  <?php echo $this->title ? $this->translate($this->title) : ''; ?>
</h2>

<script type="text/javascript">
  function skipForm()
  {
    document.getElementById("skip").value = "skipForm";
    $('SignupForm').submit();
  }
  function finishForm()
  {
    document.getElementById("nextStep").value = "finish";
  }
</script>

<?php echo $this->partial($this->script[0], $this->script[1], array(
  'form' => $this->form
)) ?>

<?php /*
<form action="<?php echo $this->form->getAction() ?>" method="post" id="signup-form" enctype="multipart/form-data">
  <div id='layout_middle'>

    <?php
      $script = $this->plugin->getScriptPath();
      $module = $this->plugin->getScriptModule();
      $model = array('form' => $this->form, 'plugin' => $this->plugin);
      echo $this->partial($script, $module, $model);
    ?>

    <div class='buttons' style='margin-top: 10px;'>
      <?php echo $this->form->back->setLabel('Previous')->render($this) ?>
      <?php echo $this->form->submit->setLabel('Continue')->render($this) ?>
      <?php echo $this->form->step->render($this) ?>
    </div>
  </div>
</form> */
