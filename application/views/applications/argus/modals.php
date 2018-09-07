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
        Starting this shipment will send it for verification.</p>
        <input id="start_shipment_id" type="hidden" class="shipment_val"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="start_shipment_btn" type="button" class="btn btn-sm btn-primary">Send to Verification</button>
      </div>
    </div>
  </div>
</div>