<div class="modal" id="set_queue" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-stream"></i> Set Dock Queue</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_queue_form">
        <div class="row">
            <div class="col">
                <div class="row mb-2">
                  <div class="col">
                    <label>Pickup Number</label>
                    <input type="text" class="form-control" placeholder="(optional)" name="pickup_number"/>
                  </div>
                  <div class="col">
                    <label>Carrier</label>
                    <select name="carrier_code" class="form-control">
                    <?php foreach($carriers as $carrier){ ?>
                      <option value="<?= $carrier['carrier_code']; ?>" data-img="<?= $carrier['carrier_logo']; ?>"><?= $carrier['carrier_name']; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <label>Queue Range</label>
                    <input type="text" class="form-control col-12 queue_range text-center mb-1" placeholder="From" name="queue_range"/>
                    <input type="hidden" name="from"/>
                    <input type="hidden" name="to"/>
                    <input type="hidden" name="dock_id_queue"/>
                  <button type="button" id="add_queue" class="btn btn-success w-100">Add to Dock Queue <i class="fas fa-plus-circle"></i></button>
                  </div>
                </div>
            </div>
        </div>
        </form>
        <div class="row mt-2">
            <div class="col">
                <div id="current_queue"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="edit_dock" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Edit Dock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_dock_form">
          <div class="row">
            <div class="col">
              <label>Building</label>
              <select name="building_id" class="form-control">
              <?php foreach($buildings as $building){ ?>
                <option value="<?= $building['bldg_id']; ?>""><?= $building['bldg_name']; ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="col">
              <label>Status</label>
              <select name="status" class="form-control">
                <option value="0">Vacant</option>
                <option value="1">Occupied</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label>Note</label>
              <input type="text" class="form-control input-sm" name="note">
            </div>
          </div>
          <input type="hidden" name="dock_id"/>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="save_edit_dock" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="add_dock" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-plus"></i> Add Dock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_dock_form">
          <div class="row">
            <div class="col">
              <label>Dock Number</label>
              <input type="text" name="add_dock_number" class="form-control"/>
            </div>
            <div class="col">
              <label>Type</label>
              <select name="add_dock_type" class="form-control">
                <option>Dock</option>
                <option>Placeholder</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label>Building</label>
              <select name="add_building_id" class="form-control">
              <?php foreach($buildings as $building){ ?>
                <option value="<?= $building['bldg_id']; ?>""><?= $building['bldg_name']; ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="col">
              <label>Status</label>
              <select name="add_status" class="form-control">
                <option value="0">Vacant</option>
                <option value="1">Occupied</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label>Note</label>
              <input type="text" class="form-control input-sm" name="add_note">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="add_dock_btn" class="btn btn-success">Add</button>
        <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>