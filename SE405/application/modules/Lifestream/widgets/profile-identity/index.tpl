

<ul>
  <?php foreach($this->links as $link) : ?>
  <li>
    <a target="_blank" href="<?php echo $link['link'] ?>"><img src="application/modules/Socialdna/externals/images/brands/<?php echo $link['icon'] ?>"><?php echo $this->translate('Find me on') . ' ' . $link['label'] ?> </a>
  </li>
  <?php endforeach; ?>
</ul>