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
        <p>This wave has already been built.<p>
        <table class="table table-sm table-bordered">
          <tr>
            <td>Wave</td><td class="rb_wave"></td>
          </tr>
          <tr>
            <td>User</td><td class="rb_user"></td>
          </tr>
          <tr>
            <td>Timestamp</td><td class="rb_timestamp"></td>
          </tr>
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