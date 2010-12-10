<h2><?php echo $this->translate("Friends Inviter Plugin") ?></h2>

<?php if( count($this->navigation) ): ?>
  <div class='tabs'>
    <?php
      // Render the menu
      //->setUlClass()
      echo $this->navigation()->menu()->setContainer($this->navigation)->render()
    ?>
  </div>
<?php endif; ?>

<p>
  <?php echo $this->translate("100010288") ?>
</p>

<br />

<script type="text/javascript">
  var currentOrder = '<?php echo $this->order ?>';
  var currentOrderDirection = '<?php echo $this->order_direction ?>';
  var changeOrder = function(order, default_direction){
    // Just change direction
    if( order == currentOrder ) {
      $('order_direction').value = ( currentOrderDirection == 'ASC' ? 'DESC' : 'ASC' );
    } else {
      $('order').value = order;
      $('order_direction').value = default_direction;
    }
    $('filter_form').submit();
  }

function multiModify()
{
  var multimodify_form = $('multimodify_form');
  if (multimodify_form.submit_button.value == 'delete')
  {
    return confirm('<?php echo $this->string()->escapeJavascript($this->translate("Are you sure you want to delete the selected user accounts?")) ?>');
  }
}

function selectAll()
{
  var i;
  var multimodify_form = $('multimodify_form');
  var inputs = multimodify_form.elements;
  for (i = 1; i < inputs.length - 1; i++) {
    if (!inputs[i].disabled) {
      inputs[i].checked = inputs[0].checked;
    }
  }
}
</script>

<div class='admin_search'>
  <?php echo $this->formFilter->render($this) ?>
</div>

<br />

<div class='admin_results'>
  <div>
    <?php $memberCount = $this->paginator->getTotalItemCount() ?>
    <?php echo $this->translate(array("%s member found", "%s members found", $memberCount), ($memberCount)) ?>
  </div>
  <div>
    <?php echo $this->paginationControl($this->paginator); ?>
  </div>
</div>

<br />

<form id='multimodify_form' method="post" action="<?php echo $this->url(array('action'=>'multi-modify'));?>" onSubmit="multiModify()">
  <table class='admin_table'>
    <thead>
      <tr>
        <th style='width: 1%;'><a href="javascript:void(0);" onclick="javascript:changeOrder('user_id', 'DESC');"><?php echo $this->translate("ID") ?></a></th>
        <th><a href="javascript:void(0);" onclick="javascript:changeOrder('displayname', 'ASC');"><?php echo $this->translate("Display Name") ?></a></th>
        <th><a href="javascript:void(0);" onclick="javascript:changeOrder('username', 'ASC');"><?php echo $this->translate("Username") ?></a></th>

        <th><a href="javascript:void(0);" onclick="javascript:changeOrder('invites_sent', 'ASC');"><?php echo $this->translate("Invites Sent") ?></a></th>
        <th><a href="javascript:void(0);" onclick="javascript:changeOrder('invites_converted', 'ASC');"><?php echo $this->translate("Referred Users") ?></a></th>
        <th><a href="javascript:void(0);" onclick="javascript:changeOrder('referer_username', 'ASC');"><?php echo $this->translate("Referred by User") ?></a></th>
        
      </tr>
    </thead>
    <tbody>
      <?php if( count($this->paginator) ): ?>
        <?php foreach( $this->paginator as $item ): ?>
          <tr>
            <td><?php echo $item->user_id ?></td>
            <td class='admin_table_bold'><?php echo $this->htmlLink($this->item('user', $item->user_id)->getHref(), $this->item('user', $item->user_id)->getTitle(), array('target' => '_blank')) ?></td>
            <td class='admin_table_bold'><?php echo $this->htmlLink($this->item('user', $item->user_id)->getHref(), $this->item('user', $item->user_id)->username, array('target' => '_blank')) ?></td>

            <td Xclass='admin_table_centered'> <?php echo (int)$item->invites_sent ?> </td>
            <td Xclass='admin_table_centered'> <?php echo (int)$item->invites_converted ?> </td>
            <td Xclass='admin_table_centered'> <?php echo (!is_null($item->referer_displayname) && !is_null($item->referer_username)) ? (!is_null($item->referer_displayname) ? $item->referer_displayname : $item->referer_username) : '---'; ?> </td>
          
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
  <br />
</form>