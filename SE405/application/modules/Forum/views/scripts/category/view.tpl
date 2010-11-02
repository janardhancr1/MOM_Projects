<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: view.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */
?>

<div class="group_discussions_thread_options">
  <?php echo $this->htmlLink(array('route' => 'default', 'module' => 'forum', 'controller' => 'forum', 'action' => 'create', 'category_id' => $this->category->getIdentity()), $this->translate('Create Forum'), array(
    'class' => 'buttonlink icon_back'
  )) ?>
</div>

<?php if( count($this->forums) > 0 ): ?>
  <ul>
    <?php foreach( $this->forums as $forum ): ?>
      <li>
        <?php echo $forum->__toString() ?>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <?php echo $this->translate('No forums in this category.');?>
<?php endif; ?>