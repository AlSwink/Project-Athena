<div id="statusControl" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Change status to:</p>
		<form id="statusForm" action='<?=site_url('it_5s/save');?>' method="post">
		<select name='status' class="form-control">
			<option value="0">Incomplete</option>
			<option value="1">Complete</option>
		</select>
		<p>Percent complete:</p>
		<input type='number' name='progress'>
		<input type="hidden" name="id">
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" id='submit' class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>