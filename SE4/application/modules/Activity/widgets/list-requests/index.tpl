<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>

<?php // @todo add in a human-readable column to $requestInfo to properly display text ?>
<ul class="requests_widget">
  <?php foreach( $this->requests as $requestInfo ): ?>
      <li>
      <?php
      $request_type = str_replace('_', ' ', $requestInfo['info']['type']);
      echo $this->htmlLink(array('route'=> 'recent_activity'),
        $this->translate(array("%s $request_type", "%s {$request_type}s", $requestInfo['count']), $this->locale()->toNumber($requestInfo['count'])),
        array('class' => 'buttonlink notification_item_general notification_type_'.$requestInfo['info']['type'])) ?>
      </li>
  <?php endforeach; ?>
</ul>