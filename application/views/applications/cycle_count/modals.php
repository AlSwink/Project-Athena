<!-- confirm delete -->
<div class="modal fade" id="delete_location" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-trash"></i> Confirm Location Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete the <b>Location(s)</b> from the report? Deleting this will only remove the <b>count</b> and <b>generation</b> record.</p> 
        <p><small>Locations will be returned to the selection pool for future generation.</small></p>
        <div class="row loc_list px-3 mb-2" style="max-height: 40%;overflow-y: auto">
          
        </div>
        <form id="delete_loc_form" action="<?= site_url('cycle_count/delete_locations'); ?>" method="POST">
          <label>Please provide the reason for deleting the location(s).</label>
          <textarea name="reason" class="form-control" rows="3"></textarea>
          <input type="hidden" name="ids">
          <input type="hidden" name="locations">
          <input type="hidden" name="dataset" value="<?= $totals['dataset']; ?>">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="delete_loc" type="button" class="btn btn-sm btn-danger">YES</button>
      </div>
    </div>
  </div>
</div>