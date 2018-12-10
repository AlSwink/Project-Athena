<div class="modal fade" id="picker_details_modal">
  <div class="modal-dialog modal-xlg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Picker Details for <span id="hour_label"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <em>To see detailed hourly efficiency follow this <a href="<?= site_url('productivity/test'); ?>" target="_blank">link</a>.</em>
        <form id="hour_picker_detail_form">
        <div id="hour_picker_detail">

        </div>
        </form>
      </div>
      <div class="modal-footer">
        <div class="btn-group dropleft">
          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Set ALL to Break
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item set_break" data-mins="45" href="#">15 Mins</a>
            <a class="dropdown-item set_break" data-mins="30" href="#">30 Mins</a>
            <a class="dropdown-item set_break" data-mins="15" href="#">45 Mins</a>
          </div>
        </div>
        <button type="button" class="set_break btn btn-warning" data-mins="60">Reset All <i class="fas fa-undo"></i></button>
        <button type="button" class="form_submit btn btn-primary">Save <i class="fas fa-save"></i></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>