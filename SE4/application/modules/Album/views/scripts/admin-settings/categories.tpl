<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: categories.tpl 6513 2010-06-23 00:36:46Z john $
 * @author     Jung
 */
?>

<h2><?php echo $this->translate("Photo Albums Plugin");?></h2>

<?php if( count($this->navigation) ): ?>
<div class='tabs'>
    <?php
    // Render the menu
    //->setUlClass()
    echo $this->navigation()->menu()->setContainer($this->navigation)->render()
    ?>
</div>
<?php endif; ?>

<div class='clear'>
  <div class='settings'>
    <form class="global_form">
      <div>
      <h3><?php echo $this->translate("Album Categories") ?></h3>
      <p class="description">
        <?php echo $this->translate("ALBUM_VIEW_SCRIPTS_ADMINSETTINGS_CATEGORIES_DESCRIPTION") ?>
      </p>
          <?php if(count($this->categories)>0):?>

      <table class='admin_table'>
        <thead>

          <tr>
            <th><?php echo $this->translate("Category Name") ?></th>
            <th><?php echo $this->translate("Owner") ?></th>
            <th><?php echo $this->translate("Number of Times Used") ?></th>
            <th><?php echo $this->translate("Options") ?></th>
          </tr>

        </thead>
        <tbody>
          <?php foreach ($this->categories as $category): ?>

          <tr>
            <td><?php echo $category->category_name?></td>
            <td><?php echo $category->user_id?></td>
            <td><?php echo $category->getUsedCount()?></td>
            <td>
              <?php echo $this->htmlLink(array('route' => 'admin_default', 'module' => 'album', 'controller' => 'settings', 'action' => 'edit-category', 'id' =>$category->category_id), $this->translate('edit'), array(
                'class' => 'smoothbox',
              )) ?>
              |
              <?php echo $this->htmlLink(array('route' => 'admin_default', 'module' => 'album', 'controller' => 'settings', 'action' => 'delete-category', 'id' =>$category->category_id), $this->translate('delete'), array(
                'class' => 'smoothbox',
              )) ?>
            </td>
          </tr>

          <?php endforeach; ?>

        </tbody>
      </table>

      <?php else:?>
      <br/>
      <div class="tip">
      <span><?php echo $this->translate("There are currently no categories.") ?></span>
      </div>
      <?php endif;?>
      <br/>

      <?php echo $this->htmlLink(array('route' => 'admin_default', 'module' => 'album', 'controller' => 'settings', 'action' => 'add-category'), $this->translate('Add New Category'), array(
      'class' => 'smoothbox buttonlink',
      'style' => 'background-image: url(application/modules/Core/externals/images/admin/new_category.png);')) ?>
      </div>
    </form>
  </div>
</div>
