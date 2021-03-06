<div class="modal" id="start_shipment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-clipboard"></i> Start Shipment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to start <b><span class="shipment"></span></b>?<br>
        <input id="start_shipment_id" type="hidden" class="shipment_val"/>
        <div id="unnestalert" class="col d-none">
          <div class="row">
            <div class="alert alert-danger mb-2 pb-0 col">
              <p>The below <b>[<span id="unnest_count"></span>]</b> container(s) have <b>not been nested</b>. 
              <br>Are you sure you want to proceed? <a href="#" class="details">See details</a></p>
            </div>
          </div>
          <div id="unnested_container_alert" class="row" style="max-height: 30%;overflow: auto">
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary cancel" data-dismiss="modal">Cancel</button>
        <button id="start_shipment_btn" type="button" class="btn btn-sm btn-primary">Send to Verification</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="start_load_wr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-truck-loading"></i> Enter Pickup Number</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Please provide the pickup number for <b><span class="shipment start_load_id"></span></b>?<br>
        <input type="text" class="form-control form-control-lg"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary cancel" data-dismiss="modal">Cancel</button>
        <button type="button" class="start_loading_btn btn btn-sm btn-primary">Send to Loading</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="start_load_reg" tabindex="-1">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-truck-loading"></i> Enter Pickup Number</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Please provide the Door number for <b><span class="shipment start_load_id"></span></b>?<br>
        <input type="text" class="form-control form-control-lg"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary cancel" data-dismiss="modal">Cancel</button>
        <button type="button" class="start_loading_btn btn btn-sm btn-primary">Send to Loading</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="start_bol_signature" tabindex="-1">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-clipboard-check"></i> Please sign BOL to proceed</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col">
              <p>I acknowledge that the below shipment has been verified and loaded.</p>
              <h4>BOL FORM GOES HERE</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-sm-12">
              Shipper Signature
              <div id="bol_shipper_sign" class="w-100 h-25"></div>
            </div>
            <div class="col-lg-6 col-sm-12">
              Carrier Signature
              <div id="bol_carrier_sign" class="w-100 h-25"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary cancel" data-dismiss="modal">Cancel</button>
        <button type="button" class="start_release_btn btn btn-sm btn-primary">Release</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="start_security_signature" tabindex="-1">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-truck"></i> Please sign release form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col">
              <p>I acknowledge that the below shipment has been verified and loaded.</p>
              <h4>SECURITY FORM GOES HERE</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-sm-12">
              Security Signature
              <div id="security_sign" class="w-100 h-25"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary cancel" data-dismiss="modal">Cancel</button>
        <button type="button" class="complete_btn btn btn-sm btn-primary">Ship complete</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="details" tabindex="-1">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-truck"></i> Shipment Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="ship_details" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary cancel" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="announcement_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-bullhorn"></i> Send an announcement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning">Only send announcements with the highest importance. Please use responsibly</div>
        <textarea class="form-control" name="announcement_text" rows=5></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="send_announcement btn btn-sm btn-primary">Announce</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-question-circle"></i> Confirm Action</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to <span class="confirm_action font-weight-bold">action</span>?</p>
      </div>
      <div class="modal-footer">
        <a href="#" id="confirm_url" class="btn btn-sm btn-secondary">Yes</a>
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="display-4">Ooops! An error has occured</h4>
        <p>It's ok, This happen sometimes. Try you action again.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Understood</a>
      </div>
    </div>
  </div>
</div>