<?php
  $this->headScript()
    ->appendFile($this->baseUrl() . '/application/modules/Socialdna/externals/scripts/FusionCharts.js')
?>

<h2><?php echo $this->translate("Social DNA Plugin") ?></h2>

<?php if( count($this->navigation) ): ?>
  <div class='tabs'>
    <?php
      // Render the menu
      //->setUlClass()
      echo $this->navigation()->menu()->setContainer($this->navigation)->render();
      
    ?>
  </div>
<?php endif; ?>

<p>
  <?php  echo $this->translate("SOCIALDNA_ADMIN_STATS_DESC") ?>
</p>



<br><br>

<h3>Most Popular Incoming Links</h3>

<div style='padding: 5px'>
  
  <br>
    
  Top links clicked through from the social networks after content from your network is published by one of the users. For example, a member of your network published new event with attached link on Facebook. When one of this member's facebook friends clicks on the attached link, it will show up here.
  
  <br><br>

</div>

<div style='padding: 5px'>
  
  <table cellpadding=0 cellpadding=0 width="100%" class='admin_table'>
    <thead>
    <tr>
      <th width='80' style="text-align:left">Total visits</th>
      <!--<th width='200'>Published by user</th>-->
      <th style="text-align:left">Link</th>
    </tr>
    </thead>
    <?php foreach($this->top_links as $top_link): ?>
    <tr>
      <td><?php echo $top_link['total'] ?></td>
      <!--<td>user</td>-->
      <td><a href="<?php echo $top_link['openidlinkstat_link'] ?>"><?php echo $top_link['openidlinkstat_link'] ?></a></td>
    </tr>
    <?php endforeach; ?>
    <?php if(count($this->top_links) == 0): ?>
    <tr>
      <td colspan=2 class="admin_table_centered">
        No links yet.
      </td>
    </tr>
    <?php endif; ?>
  </table>

</div>



<br>
<br>


<h3>Recent Incoming Links</h3>

<div style='padding: 5px'>
  
  <br>
    
  Recent links clicked through from the social networks after content from your network is published by one of the users. For example, a member of your network published new event with attached link on Facebook. When one of this member's facebook friends clicks on the attached link, it will show up here.
  
  <br><br>

</div>

<div style='padding: 5px'>
  
  <table cellpadding=0 cellpadding=0 width="100%" class="admin_table">
    <thead>
    <tr>
      <th width='80' style="text-align:left">Network</th>
      <th width='200' style="text-align:left">Published by user</th>
      <th style="text-align:left">Link</th>
    </tr>
    </thead>
    <?php foreach($this->recent_links as $recent_link): ?>
    <tr>
      <td><img style="float:left; padding-right: 5px" border='0' src="application/modules/Socialdna/externals/images/brands/<?php echo $recent_link['openidservice_logo_mini'] ?>" alt="<?php echo $recent_link['openidservice_displayname'] ?>"></td>
      <td><?php echo $this->user($recent_link->user_id)->getTitle() ?></td>
      
      <td><a href="<?php echo $recent_link['openidlinkstat_link'] ?>"><?php echo $recent_link['openidlinkstat_link'] ?></a></td>
    </tr>
    <?php endforeach; ?>
    <?php if(count($this->recent_links) == 0): ?>
    <tr>
      <td colspan=3 class="admin_table_centered">
        No links yet.
      </td>
    </tr>
    <?php endif; ?>

  </table>

</div>


<br><br><br><br>


<table cellpadding=0 cellspacing=0 width="100%">
<tr>
<td width="50%">
      
  <h3>Newsfeed Updates</h3>

  <div style='padding: 5px'>
    
    <br>
      
    Activities published by your network users to the connected social networks.
    
    <br><br>
  
  </div>
  
  <div style='padding: 5px'>

    
    <?php echo $this->charts['feeds'] ?>


  </div>

</td>
<td width="50%">
      
  <h3>Status Updates</h3>
  
  <div style='padding: 5px'>
    
    <br>
      
    Status updates by your users, broadcasted to connected social networks.
    
    <br><br>
  
  </div>
  
  
  <div style='padding: 5px'>

    <?php echo $this->charts['status'] ?>

  </div>


</td>
</tr>
<tr>
<td width="50%">
      
  <h3>Messages Sent<h3>
  
  <div style='padding: 5px'>
    
    <br>
      
    Messages sent by your network users to their social networks friends
    
    <br><br>
  
  </div>
  
  <div style='padding: 5px'>
    
    <?php echo $this->charts['messages'] ?>

  </div>

</td>
<td width="50%">
      
  <h3>Referred Viral Traffic</h3>
  
  <div style='padding: 5px'>
    
    <br>
      
    Incoming traffic from the content published on the social networks by your users (such as events, groups, etc)
    
    <br><br>
  
  </div>
  
  <div style='padding: 5px'>

    <?php echo $this->charts['clicks'] ?>

  </div>

</td>
</tr>
<tr>
<td width="50%">
      
  <h3>New User Signups</h3>
  
  <div style='padding: 5px'>
    
    <br>
      
    New users connecting or signing up to your network
    
    <br><br>
  
  </div>
  
  <div style='padding: 5px'>
    
    <?php echo $this->charts['signups'] ?>


  </div>
  
</td>
<td width="50%">
      
  <h3>All connected users by service</h3>
  
  <div style='padding: 5px'>
    
    <br>
      
    All users on your network, connected per service
    
    <br><br>
  
  </div>
  
  <div style='padding: 5px'>

    <?php echo $this->charts['openidusers'] ?>

  </div>

</td>
</tr></table>


<br>
<br>


<form action="<?php echo $this->url(array('action' => 'reset'), 'admin_default')?>" method='POST'>
<div class="table_clear">
  <button type='submit' class='button'>Clear ALL statistics</button>
</div>
</form>
