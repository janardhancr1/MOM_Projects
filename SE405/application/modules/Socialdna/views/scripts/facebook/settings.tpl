<div class='layout_middle'>
<div class="headline">
  <h2>
    <?php echo $this->translate('Social DNA');?>
  </h2>
  <div class="tabs">
    <?php
      // Render the menu
      echo $this->navigation()
        ->menu()
        ->setContainer($this->navigation)
        ->render();
    ?>
  </div>
</div>

<?php echo $this->form->render($this) ?>

</div>

