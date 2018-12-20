<div class="modal" id="confirm_rebuild" tabindex="-1">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-question-circle"></i> Confirm Re-build</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Some waves had already been built.<p>
        <table class="table table-sm table-bordered">
          <thead>
            <tr>
              <th>Wave</th>
              <th>User</th>
              <th>Timestamp</th>
            </tr>
          </thead>
          <tbody id="rb_table">
          </tbody>
        </table>
        <p>Are you sure you want to rebuild?</p>
      </div>
      <div class="modal-footer">
        <button id="rebuild_yes" type="button" class="btn btn-sm btn-primary">Yes</button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>