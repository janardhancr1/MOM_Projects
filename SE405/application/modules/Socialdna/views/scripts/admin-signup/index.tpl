
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

<script>
function openid_signup_profilecat_onChange() {
  value = SEMods.B.ge("reqfield_profile_type").checked;
  value==1 ? SEMods.B.hide("openid_signup_profilecat_default_div") : SEMods.B.show("openid_signup_profilecat_default_div");
}
</script>


<div class='settings'>

<form class="global_form" action='<?php echo $this->url(array('module'  => 'socialdna', 'controller' => 'signup'), 'admin_default') ?>' method='POST'>
<div>
<div>
  
  <h3><?php echo $this->translate('Fields Mapping') ?></h3>
  <p class="description">Select which of the profile data fields are imported into SocialEngine fields. Not all the fields are available from all social providers, for example "honors" field is only available from MySpace.</p>
  
  <br>

  <?php if ($this->success == 1): ?>
  <div class="success-notice"><?php echo $this->translate("Changes Successfully Saved"); ?></div>
  <br>
  <?php endif; ?>
    
    
  <div style='padding: 5px'>
  <table cellpadding='0' cellspacing='0' Xwidth='100%' class='admin_table'>
  <thead>
  <tr>
  <th style='width: 400px'>
    SocialEngine Field
  </th>
  <th>
    Imported Field
  </th>
  </tr>
  </thead>

	<?php foreach($this->fields as $field) : ?>

    <tr>
    <td colspan=2>

    <div style="background-color: #FFF; margin: -7px; padding: 7px"><h3  style="margin: 0px 0px 3px"> Profile Type : <?php echo $field['label'] ?></h3></div>
    

    </td>
    <!--<td>&nbsp;</td>-->
    </tr>

	<?php foreach($field['fields'] as $subfield) : ?>


    <?php if($subfield['heading']) : ?>

    <tr>
    <td style='padding-left: 30px;'>

    <div class='admin_fields_heading'> <?php echo $subfield['label'] ?></div>

    </td>
    <td>&nbsp;</td>
    </tr>
    
    <?php else : ?>

      <tr>
      <td style='padding-left: 30px;'>
        
      <div class='admin_fields_field'> <?php echo $subfield['label'] ?></div>    
      
      </td>
      <td><select name="openid_fieldmap[<?php echo $subfield['key'] ?>]"><option value="">--Select Field--</option><?php foreach($this->openid_imported_fields as $openid_imported_field) : ?><option value="<?php echo $openid_imported_field ?>" <?php if(isset($this->fields_remap[$subfield['key']]) AND ($this->fields_remap[$subfield['key']]['openidfieldmap_name'] == $openid_imported_field)) :?>SELECTED="SELECTED"<?php endif; ?>><?php echo $openid_imported_field ?></option><?php endforeach; ?></select></td>
      </tr>
    
    <?php endif; ?>

    <?php endforeach; ?>
    <?php endforeach; ?>

  </table>
  </div>



  <br><br><br>



  <h3><?php echo $this->translate('Signup Settings - Required fields') ?></h3>
  <p class="description">

    Select which of the following fields should be displayed on the quick signup page.
    The field will be imported, if available, regardless of whether it is displayed or not on the signup page.
    <br><br>
    If all the selected fields are filled (i.e imported, from facebook for example), the signup will be completed automatically and the user will not see the signup page at all.
    <br><br>
    For example, if only "Full Name" is selected, user chooses to sign up via Facebook (Full Name will be imported from Facebook) - signup will be completed automatically.
  
  </p>
  
  <br>



  <div style='padding: 5px'>
  <table cellpadding='0' cellspacing='0' Xwidth='100%' class='admin_table'>
  <thead>
  <tr>

  <th style='width: 400px'>
    &nbsp;
  </th>
  </tr>
  </thead>


    <tr>
    <td>
      <div style='width: 30px; float: left; padding: 7px 0px 7px 0px'>
        <input type='checkbox' id="reqfield_email" name='openid_signup_required_fields[]' value='email'<?php if (in_array('email',$this->openid_signup_required_fields)): ?> CHECKED<?php endif; ?>>
      </div>
      <div class='admin_fields_standard'> <label for="reqfield_email"> Email </label> </div>    
    </td>
    </tr>

    <tr>
    <td>
      <div style='width: 30px; float: left; padding: 7px 0px 7px 0px'>
        <input type='checkbox' id="reqfield_username" name='openid_signup_required_fields[]' value='username'<?php if (in_array('username',$this->openid_signup_required_fields)): ?> CHECKED<?php endif; ?>>
      </div>
      <div class='admin_fields_standard'> <label for="reqfield_username"> Username </label> </div>    
    </td>
    </tr>

    <tr>
    <td>
      <div style='width: 30px; float: left; padding: 7px 0px 7px 0px'>
        <input type='checkbox' id="reqfield_terms" name='openid_signup_required_fields[]' value='terms'<?php if (in_array('terms',$this->openid_signup_required_fields)): ?> CHECKED<?php endif; ?>>
      </div>
      <div class='admin_fields_standard'> <label for="reqfield_terms"> Terms Of Use </label> </div>    
    </td>
    </tr>

    <tr>
    <td>
      <div style='width: 30px; float: left; padding: 7px 0px 7px 0px'>
        <input type='checkbox' id="reqfield_language" name='openid_signup_required_fields[]' value='language'<?php if (in_array('language',$this->openid_signup_required_fields)): ?> CHECKED<?php endif; ?>>
      </div>
      <div class='admin_fields_standard'> <label for="reqfield_language"> Preferred Language </label> </div>    
    </td>
    </tr>

    <tr>
    <td>
      <div style='width: 30px; float: left; padding: 7px 0px 7px 0px'>
        <input type='checkbox' id="reqfield_timezone" name='openid_signup_required_fields[]' value='timezone'<?php if (in_array('timezone',$this->openid_signup_required_fields)): ?> CHECKED<?php endif; ?>>
      </div>
      <div class='admin_fields_standard'> <label for="reqfield_timezone"> Timezone </label> </div>    
    </td>
    </tr>

    <tr>
    <td>
      <div style='width: 30px; float: left; padding: 7px 0px 7px 0px'>
        <input type='checkbox' id="reqfield_profile_type" name='openid_signup_required_fields[]' value='profile_type'<?php if (in_array('profile_type',$this->openid_signup_required_fields)): ?> CHECKED<?php endif; ?> onclick="openid_signup_profilecat_onChange(this.value)" >
      </div>

      <div style="height: 40px">      

      <div class='admin_fields_standard'> <label for="reqfield_profile_type"> Profile Type </label> </div>
      
      <div id="openid_signup_profilecat_default_div" style='float:left; padding: 7px 10px 7px 7px; <?php if (in_array('profile_type',$this->openid_signup_required_fields)) : ?>display:none<?php endif; ?>'>
      Default profile type :
      <select name="openid_signup_profilecat_default">
      <?php foreach($this->topLevelOptions as $profile_type_key => $profile_type_val) : ?>
        <option value="<?php echo $profile_type_key ?>" <?php if($this->openid_signup_profilecat_default == $profile_type_key) : ?> SELECTED="SELECTED"<?php endif; ?>><?php echo $profile_type_val ?></option>
      <?php endforeach; ?>
      </select>
      </div>

      </div>      
      
    </td>
    </tr>


    <tr><td> &nbsp;</td></tr>


	<?php foreach($this->fields as $field) : ?>

    <tr>
    <td>

    <div style="background-color: #FFF; margin: -7px; padding: 7px"><h3 style="margin: 0px 0px 3px"> Profile Type : <?php echo $field['label'] ?></h3></div>
    

    </td>
    </tr>

	<?php foreach($field['fields'] as $subfield) : ?>


    <?php if($subfield['heading']) : ?>

    <tr>
    <td style='padding-left: 30px;'>

    <div class='admin_fields_heading'> <?php echo $subfield['label'] ?></div>

    </td>
    </tr>
    
    <?php else : ?>

      <tr>

      <td style='Xpadding-left: 30px;'>
      
      <div style='width: 30px; float: left; padding: 7px 0px 7px 0px'>
        <input type='checkbox' id="reqfield_<?php echo $subfield['key'] ?>" name='openid_signup_required_fields[]' value='<?php echo $subfield['key'] ?>'<?php if(in_array($subfield['key'],$this->openid_signup_required_fields)) : ?>CHECKED<?php endif; ?>>
      </div>
        
      <div class='admin_fields_field'> <label style='' for="reqfield_<?php echo $subfield['key'] ?>">   <?php echo $subfield['label'] ?> </label> </div>  
      
      </td>
      </tr>
    
    <?php endif; ?>

    <?php endforeach; ?>
    <?php endforeach; ?>

  </table>
  </div>


  <br>
    
  <div class="form-wrapper">
    <!--<div class="form-label">&nbsp;</div>-->
    <div class="form-element">
    <button type="submit" id="submit" name="submit"><?php echo $this->translate("Save Changes") ?></button>
    </div>
  </div>

</div>
</div>

</form>

</div>