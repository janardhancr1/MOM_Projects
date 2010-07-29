<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6438 2010-06-17 23:39:55Z jung $
 * @author     Steve
 */
?>
<ul class="polls_browse">
  <?php foreach ($this->paginator as $item): ?>
    <li>
      <div class='polls_browse_info'>
        <img src="application/modules/Poll/externals/images/types/poll.png" alt="admin" border="0" /> &nbsp;
        <?php echo $this->htmlLink(array('route'=>'poll_view', 'user_id'=>$item->user_id, 'poll_id'=>$item->poll_id), $item->getTitle()) ?>
        <div class='polls_browse_info_date'>
          <?php echo $this->translate('Posted') ?> <?php echo $this->timestamp($item->creation_date) ?>
        </div>
        <div class='polls_browse_info_desc'>
          <?php echo $item->description ?>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>