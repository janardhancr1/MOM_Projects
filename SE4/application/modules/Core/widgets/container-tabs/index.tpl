<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>

<script type="text/javascript">
  var tabContainerSwitch = function(element) {
    if (element.tagName.toLowerCase() == 'a')
      element = element.getParent('li');

    var myContainer = $('tabs_parent').getParent();

    myContainer.getChildren('div:not(.tabs_alt)').setStyle('display', 'none');
    myContainer.getElements('ul > li').removeClass('active');
    element.get('class').split(' ').each(function(className){
      className = className.trim();
      if (className.match(/^tab_[0-9]+$/)) {
        myContainer.getChildren('div.'+className).setStyle('display', null);
        element.addClass('active');
      }
    });
  }
</script>

<div class='tabs_alt' id='tabs_parent'>
  <ul id='main_tabs'>
    <?php foreach( $this->tabs as $key => $tab ): ?>
      <?php
        $class   = array();
        $class[] = 'tab_' . $tab['id'];
        $class[] = 'tab_' . trim(str_replace('generic_layout_container', '', $tab['containerClass']));
        if( $this->activeTab == $tab['id'] )
          $class[] = 'active';
        $class = join(' ', $class);
      ?>
      <?php if ($key < $this->max):?>
        <li class="<?php echo $class ?>"><a href="javascript:void(0);" onclick="tabContainerSwitch($(this), '<?php echo $tab['containerClass'] ?>');"><?php echo $this->translate($tab['title']) ?><?php if( !empty($tab['childCount']) ): ?><span>(<?php echo $tab['childCount'] ?>)</span><?php endif; ?></a></li>
      <?php endif;?>
    <?php endforeach; ?>
    <?php if (count($this->tabs) > $this->max):?>
    <li class="tab_closed" onclick="if(this.className=='tab_closed'){this.className='tab_open';}else{this.className='tab_closed';}" id="more_tab">
      <div class="tab_pulldown_contents_wrapper">
        <div class="tab_pulldown_contents">
          <ul>
          <?php foreach( $this->tabs as $key => $tab ): ?>
            <?php
              $class   = array();
              $class[] = 'tab_' . $tab['id'];
              $class[] = 'tab_' . trim(str_replace('generic_layout_container', '', $tab['containerClass']));
              if( $this->activeTab == $tab['name'] ) $class[] = 'active';
              $class = join(' ', array_filter($class));
            ?>
            <?php if ($key >= $this->max):?>
              <li class="<?php echo $class ?>" onclick="tabContainerSwitch($(this))"><?php echo $this->translate($tab['title']) ?><?php if( !empty($tab['childCount']) ): ?><span> (<?php echo $tab['childCount'] ?>)</span><?php endif; ?></li>
            <?php endif;?>
          <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <a href="javascript:void(0);"><?php echo $this->translate('More +') ?><span></span></a>
    </li>
    <?php endif;?>
  </ul>
</div>

<?php echo $this->childrenContent ?>