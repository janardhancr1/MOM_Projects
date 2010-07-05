
<a href="<?php echo $this->url(array('action' => 'upload')) ?>">Upload</a>

<form action="<?php echo $this->url(array('action' => 'installed')) ?>" method="get">
  <ul>
    <?php foreach( $this->installedPackages as $package ): ?>
      <li>
        <span>
          <input type="checkbox" name="packages[]" value="<?php echo $package->getKey() ?>" />
        </span>
        <span>
          <?php echo $package->getKey() ?>
        </span>
      </li>
    <?php endforeach; ?>
  </ul>
  <br />

  <div class="buttons">
    <button type="submit">Compare</button>
  </div>
</form>