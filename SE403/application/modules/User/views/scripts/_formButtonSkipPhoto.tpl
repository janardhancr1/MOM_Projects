<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: _formButtonSkipPhoto.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     Jung
 */
?>
<?php
echo '<button onclick="javascript:finishForm();" type="submit" id="done" name="done">'.$this->translate('Save Photo').'</button>' .
      $this->translate('or') . '<a href="javascript:void(0);" onclick="javascript:skipForm();">'.$this->translate('skip').'</a>'
?>
