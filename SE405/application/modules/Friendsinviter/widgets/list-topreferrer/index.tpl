
<ul>
  <?php foreach( $this->users as $user ): ?>
    <li>
      <?php echo $this->htmlLink($user->getHref(), $this->itemPhoto($user, 'thumb.icon'), array('class' => 'topreferrers_thumb')) ?>
      <div class='topreferrers_info'>
        <div class='topreferrers_name'>
          <?php echo $this->htmlLink($user->getHref(), $user->getTitle()) ?>
        </div>
        <div class='topreferrers_friends'>
          <?php echo $this->translate(array('%s user referred', '%s users referred', $user->invites_converted),$this->locale()->toNumber($user->invites_converted)) ?>
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
