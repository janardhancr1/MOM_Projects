<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: verify.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     Jung
 */
?>

<script type="text/javascript">
  setTimeout(function()
  {
    parent.window.location.href = '<?php echo $this->url(array(), 'user_login', true); ?>';
  }, 5000);
</script>

<?php
?>

<?php echo $this->translate("Your account has been verified.  Please click %s to login, or wait to be redirected.", $this->htmlLink(array('route'=>'user_login'), $this->translate("here"))) ?>