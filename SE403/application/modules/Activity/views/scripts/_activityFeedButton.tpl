<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: _activityFeedButton.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */
?>

<?php echo $this->htmlLink('javascript:void(0);', $this->translate('Post'), array(
  'onclick' => "document.getElementById('activity-form').submit();",
  'class' => 'buttonlink icon_activity_post'
)) ?>
