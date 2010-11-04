
<h2>
  <?php echo $this->translate("Connected Members") ?>
</h2>

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
  <?php echo $this->translate("USER_VIEWS_SCRIPTS_ADMINMANAGE_INDEX_DESCRIPTION") ?>
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

<div class='admin_search' style="max-width:800px;">
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


  <table class='admin_table'>
    <thead>
      <tr>
        <th style='width: 1%;'><a href="javascript:void(0);" onclick="javascript:changeOrder('user_id', 'DESC');"><?php echo $this->translate("ID") ?></a></th>
        <th><a href="javascript:void(0);" onclick="javascript:changeOrder('openid_service_id', 'ASC');"><?php echo $this->translate("Social Network") ?></a></th>
        <th><a href="javascript:void(0);" onclick="javascript:changeOrder('displayname', 'ASC');"><?php echo $this->translate("Display Name") ?></a></th>
        <th><a href="javascript:void(0);" onclick="javascript:changeOrder('username', 'ASC');"><?php echo $this->translate("Username") ?></a></th>
        <th style='width: 1%;'><a href="javascript:void(0);" onclick="javascript:changeOrder('email', 'ASC');"><?php echo $this->translate("Email") ?></a></th>
        <th style='width: 1%;' class='admin_table_centered'><a href="javascript:void(0);" onclick="javascript:changeOrder('level_id', 'ASC');"><?php echo $this->translate("User Level") ?></a></th>
        <th style='width: 1%;'><a href="javascript:void(0);" onclick="javascript:changeOrder('creation_date', 'DESC');"><?php echo $this->translate("Signup Date") ?></a></th>
        <th style='width: 1%;' class='admin_table_options'><?php echo $this->translate("Options") ?></th>
      </tr>
    </thead>
    <tbody>
      <?php if( count($this->paginator) ): ?>
        <?php foreach( $this->paginator as $item ): ?>
          <tr>
            <td><?php echo $item->user_id ?></td>
            <td class='admin_table_bold'><img style='float: left; padding-right: 5px; border: 0px' src="application/modules/Socialdna/externals/images/brands/<?php echo $item->openidservice_logo_mini;?>"><?php echo $item->openidservice_displayname;?></td>
            <td class='admin_table_bold'><?php echo $this->htmlLink($this->item('user', $item->user_id)->getHref(), $this->item('user', $item->user_id)->getTitle(), array('target' => '_blank')) ?></td>
            <td class='admin_table_bold'><?php echo $this->htmlLink($this->item('user', $item->user_id)->getHref(), $this->item('user', $item->user_id)->username, array('target' => '_blank')) ?></td>
            <td>
              <?php if( !$this->hideEmails ): ?>
                <a href='mailto:<?php echo $item->email ?>'><?php echo $item->email ?></a>
              <?php else: ?>
                (hidden)
              <?php endif; ?>
            </td>
            <td class='admin_table_centered'>
              <a href='<?php echo $this->url(array('module'=>'authorization','controller'=>'level', 'action' => 'edit', 'id' => $item->level_id)) ?>'>
                <?php echo $this->translate(Engine_Api::_()->getItem('authorization_level', $item->level_id)->getTitle()) ?>
              </a>
            </td>
            <td><?php echo $item->creation_date ?></td>
            <td class='admin_table_options'>
              <a class='smoothbox' href='<?php echo $this->url(array('module' => 'user', 'controller' =>'manage', 'action' => 'edit', 'id' => $item->user_id));?>'><?php echo $this->translate("edit") ?></a>
              <?php if (($this->superAdminCount>1 && $item->level_id==1) || $item->level_id != 1): // @todo change this to look up actual superadmin level ?>
                |
                  <a class='smoothbox' href='<?php echo $this->url(array('module' => 'user', 'controller' =>'manage', 'action' => 'delete', 'id' => $item->user_id));?>'><?php echo $this->translate("delete") ?></a>
              <?php endif;?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
  <br />
