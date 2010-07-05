<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: widget.tpl 6550 2010-06-23 23:58:44Z shaun $
 * @author     John
 */
?>
<div style="padding: 10px;">

  <?php if( $this->form ): ?>

    <script type="text/javascript">
      window.addEvent('domready', function() {
        var params = parent.pullWidgetParams();
        var info = parent.pullWidgetTypeInfo();
        $H(params).each(function(value, key) {
          if( $(key) ) {
            $(key).value = value;
          }
        });
        $$('.form-description').set('html', info.description);
      })
    </script>

    <?php echo $this->form->render($this) ?>

  <?php elseif( $this->values ): ?>

    <script type="text/javascript">
      parent.setWidgetParams(<?php echo Zend_Json::encode($this->values) ?>);
      parent.Smoothbox.close();
    </script>

  <?php else: ?>

    <?php echo $this->translate("Error: no values") ?>
    
  <?php endif; ?>

</div>