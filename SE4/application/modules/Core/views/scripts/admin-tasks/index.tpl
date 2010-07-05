
<h2><?php echo $this->translate("Task Scheduler") ?></h2>

<p>
  <?php echo $this->translate("CORE_VIEWS_SCRIPTS_ADMINTASKS_INDEX_DESCRIPTION") ?>
</p>

<br />


<script type="text/javascript">
  var runTasks = function(task, activator) {
    if( activator ) {
      activator.addClass('admin_tasks_run_link_activated');
    }
    var url = '<?php echo $this->url(array('action' => 'run')) ?>';
    var request = new Request({
      url : url,
      data : {
        task_id : task,
        format : 'json'
      },
      onComplete: function() {
        if( activator ) {
          activator.removeClass('admin_tasks_run_link_activated');
        }
      }
    });
    request.send();
  }
</script>


<form action="<?php echo $this->url() ?>">

  <table class="admin_table">
    <thead>
      <tr>
        <th>
          <input type="checkbox" onclick="$$('input[type=checkbox][name]').set('checked', this.get('checked'));" />
        </th>
        <th>
          Name
        </th>
        <th>
          Timeout
        </th>
        <th>
          Enabled?
        </th>
        <th>
          Run State
        </th>
        <th>
          Times Completed
        </th>
        <th>
          Times Failed
        </th>
        <th>
          Options
        </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach( $this->tasks as $task ): ?>
        <tr>
          <td>
            <input type="checkbox" name="selection[]" value="<?php echo $task->task_id ?>" />
          </td>
          <td>
            <?php if( !empty($task->title) ): ?>
              <?php echo $task->title ?>
            <?php else: ?>
              <?php echo $task->plugin ?>
            <?php endif; ?>
          </td>
          <td>
            <?php echo $task->timeout ?>
          </td>
          <td>
            <?php echo $task->enabled ? 'Yes' : 'No' ?>
          </td>
          <td>
            <?php if( $task->executing ): ?>
              <?php echo 'running since: ' . $this->timestamp($task->started_last) ?>
            <?php else: ?>
              <?php echo 'completed: ' . $this->timestamp($task->completed_last) ?>
              <br />
              <?php echo 'run duration: ' . ($task->completed_last - $task->started_last) . ' seconds' ?>
            <?php endif; ?>
          </td>
          <td>
            <?php echo $this->locale()->toNumber($task->completed_count) ?>
          </td>
          <td>
            <?php echo $this->locale()->toNumber($task->failure_count) ?>
          </td>
          <td class="admin_table_options">
            <?php if( !$task->system ): ?>
              <?php if( $task->enabled ): ?>
                <span class="sep">|</span>
                <?php echo $this->htmlLink(array('reset' => false, 'action' => 'disable', 'task_id' => $task->task_id), $this->translate('disable')) ?>
              <?php else: ?>
                <span class="sep">|</span>
                <?php echo $this->htmlLink(array('reset' => false, 'action' => 'enable', 'task_id' => $task->task_id), $this->translate('enable')) ?>
              <?php endif; ?>
            <?php endif; ?>
            <span class="sep">|</span>
            <?php echo $this->htmlLink('javascript:void(0);', $this->translate('run'), array('onclick' => 'runTasks(' . $task->task_id . ', $(this));')) ?>
            <span class="sep">|</span>
            <?php echo $this->htmlLink(array('reset' => false, 'action' => 'edit', 'task_id' => $task->task_id), $this->translate('edit')) ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <br />
  
  <div>
    <button>Run Selected Now</button>
    <button>Disable Selected</button>
    <button>Enable Selected</button>
  </div>


</form>