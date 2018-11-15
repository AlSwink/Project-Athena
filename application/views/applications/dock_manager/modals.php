<div class="modal" id="set_queue" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-stream"></i> Set Dock Queue</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_queue_form" action="<?= site_url('dock_manager/add_dock_queue'); ?>" method="POST">
        <div class="row">
            <div class="col">
                <b>Add to Queue</b>
                <div class="row mx-1 mb-2">
                <input type="text" class="form-control col-6 mb-2" placeholder="Pickup Number (optional)" name="pickup_number"/>
                <input type="text" class="form-control col-6 mb-2" placeholder="Carrier" name="carrier_code"/>
                <label>Queue Range</label>
                <input type="text" class="form-control col-12 queue_range text-center" placeholder="From" name="queue_range"/>
                <input type="hidden" name="from"/>
                <input type="hidden" name="to"/>
                <input type="hidden" name="dock_id_queue"/>
                </div>
                <button type="submit" class="btn btn-success w-100">Add to Dock Queue <i class="fas fa-plus-circle"></i></button>
            </div>
        </div>
        </form>
        <div class="row mt-2">
            <div class="col">
                <b>Current Queue</b>
                <div id="current_queue">
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary cancel" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>