<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: _formButtonSkipInvite.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     Steve
 */
?>
<?php
echo '<button onclick="javascript:finishForm();" type="submit" id="done" name="done">'.$this->translate('Send Invites').'</button>
      or <a href="javascript:void(0);" onclick="javascript:skipForm();">'.$this->translate('skip').'</a>'
?>
