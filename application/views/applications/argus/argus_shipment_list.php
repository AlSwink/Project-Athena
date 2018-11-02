<div class="row mb-2">
	<div class="col-4">
		<div class="form-group mb-0">
			<label>Search Shipment</label>
			<input id="search_shipment" type="text" class="form-control"/>
		</div>
	</div>
	<div class="col-8 text-center">
		<?php loadSubTemplate('argus_status_count'); ?>
	</div>
</div>
<div class="row mb-2">
	<?php loadSubTemplate('argus_shipment_list_control'); ?>
</div>
<div class="row shipment_cards mb-5">
	<?php
		foreach($shipments as $shipment){
    		$data['shipment'] = $shipment;
    		loadSubTemplate('argus_shipment_card',$data);
    	}
	?>
</div>
<hr>
<div class="row mb-5">
	<div class="col">
		<button id="argus_logout" class="btn btn-lg btn-danger w-100">Logout (<?= $this->session->userdata('user_info')['fname'].' '.$this->session->userdata('user_info')['lname']; ?>) <i class="fas fa-sign-out-alt"></i></button>
	</div>
</div>
