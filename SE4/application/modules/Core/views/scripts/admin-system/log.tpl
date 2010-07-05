<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: log.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     Alex
 */
?>

<h2>
  <?php echo $this->translate("Log Browser") ?>
</h2>
<p>
  <?php echo $this->translate("CORE_VIEWS_SCRIPTS_ADMINSYSTEM_LOG_DESCRIPTION") ?>
</p>

<br />

<div class="admin_search">
  <div class="search">
    <form method="post" class="global_form_box" action="">
      <div>
        <select id="log_type" name="log_type">
          <option value="0" ></option>
          <option value="1" <?php if( $this->log_type == 1) echo "selected";?>><?php echo $this->translate("Error log") ?></option>
          <option value="2" <?php if( $this->log_type == 2) echo "selected";?>><?php echo $this->translate("Language log") ?></option>
          <option value="3" <?php if( $this->log_type == 3) echo "selected";?>><?php echo $this->translate("Video encoding log") ?></option>
        </select>
      </div>
      <div>
        <select id="log_length" name="log_length">
          <option value="100" ><?php echo $this->translate("Show 100 Lines") ?></option>
          <option value="1000"  <?php if( $this->log_length == 1000) echo "selected";?>><?php echo $this->translate("Show 1000 Lines") ?></option>
          <option value="5000"  <?php if( $this->log_length == 5000) echo "selected";?>><?php echo $this->translate("Show 5000 Lines") ?></option>
          <option value="10000" <?php if( $this->log_length == 10000) echo "selected";?>><?php echo $this->translate("Show 10000 Lines") ?></option>
          <option value="50000" <?php if( $this->log_length == 50000) echo "selected";?>><?php echo $this->translate("Show 50000 Lines") ?></option>
        </select>
      </div>
      <div>
        <button type="submit"><?php echo $this->translate("View Log") ?></button>
        <button type="submit" name="clear_log" value="true" onclick="return confirm('<?php echo $this->string()->escapeJavascript($this->translate("Are you sure you want to empty the %s","'+$('log_type').getChildren('[selected]').get('text')+'?")) ?>')"><?php echo $this->translate("Empty Log") ?></button>
      </div>
    </form>
  </div>
</div>

<br />

<div class="admin_logs">
  <pre>
<?php echo $this->log; ?>
  </pre>
</div>