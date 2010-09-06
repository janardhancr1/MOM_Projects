<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: categories.tpl 6241 2010-06-10 01:54:01Z jung $
 * @author     Jung
 */
?>

<h2>Answers Plugin</h2>



<div class='clear'>
  <div class='settings'>
    <form class="global_form">
      <div>
      <h3><?php echo $this->translate("Answer Entry Sub Categories") ?></h3>
      <p class="description">
        <?php echo $this->translate("ANSWER_VIEW_SCRIPTS_ADMINSETTINGS_CATEGORIES_DESCRIPTION") ?>
      </p>
          <?php if(count($this->subcategories)>0):?>

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
          <?php foreach ($this->subcategories as $category): ?>

          <tr>
            <td><?php echo $category->category_name?></td>
            <td><?php echo $category->user_id?></td>
            <td><?php echo $category->getUsedCount()?></td>
            <td>
              <?php echo $this->htmlLink(array('route' => 'admin_default', 'module' => 'answer', 'controller' => 'settings', 'action' => 'edit-category', 'id' =>$category->category_id), $this->translate('edit'), array(
                'class' => 'smoothbox',
              )) ?>
              |
              <?php echo $this->htmlLink(array('route' => 'admin_default', 'module' => 'answer', 'controller' => 'settings', 'action' => 'delete-category', 'id' =>$category->category_id), $this->translate('delete'), array(
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
      <span><?php echo $this->translate("There are currently no sub categories.") ?></span>
      </div>
      <?php endif;?>
      <br/>

      <?php echo $this->htmlLink(array('route' => 'admin_default', 'module' => 'answer', 'controller' => 'settings', 'action' => 'add-subcategory', 'id' =>$this->parent_cat_id), $this->translate('Add New Sub Category'), array(
      'class' => 'smoothbox buttonlink',
      'style' => 'background-image: url(application/modules/Core/externals/images/admin/new_category.png);')) ?>
      </div>
    </form>
  </div>
</div>
