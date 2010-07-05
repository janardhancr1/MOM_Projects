<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: invite.tpl 6512 2010-06-23 00:27:01Z shaun $
 * @access	   Sami
 */
?>
<?php if( $this->count > 0 ): ?>
  <script type="text/javascript">
    en4.core.runonce.add(function(){$('selectall').addEvent('click', function(){ $$('input[type=checkbox]').set('checked', $(this).get('checked', false)); })});
  </script>

  <?php echo $this->form->setAttrib('class', 'global_form_popup')->render($this) ?>
<?php else: ?>
  <div>
    <?php echo $this->translate('You have no friends you can invite.');?>
    <?php echo $this->htmlLink('javascript:void(0);', $this->translate('Close'), array('onclick' => 'parent.Smoothbox.close();')) ?>
  </div>
<?php endif; ?>