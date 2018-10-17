<div class="row mb-2">
	<div class="col-6">
		<div class="form-group mb-0">
			<label>Search Shipment</label>
			<input type="text" class="form-control"/>
		</div>
	</div>
	<div class="col-6 text-center">
		<?php loadSubTemplate('argus_status_count'); ?>
	</div>
</div>
<div class="row mb-2">
	<div class="col text-center">
		<button type="button" class="btn btn-sm btn-info">Fetch new data <i class="fas fa-sync"></i></button>
		<button type="button" class="btn btn-sm btn-default filter off" data-filter="regular">Regular</button>
		<button type="button" class="btn btn-sm btn-default filter off" data-filter="work_request">Work Request</button>
		<button type="button" class="btn btn-sm btn-default filter off" data-filter="priority">Priority <i class="fas fa-star"></i></button>
		<button type="button" class="btn btn-sm btn-default filter off" data-filter="unlocked">Unlocked <i class="fas fa-unlock"></i></button>
	</div>
</div>
<div class="row">
	<?php 
		foreach($shipments as $shipment){
			$data['shipment'] = $shipment;
			loadSubTemplate('argus_shipment_card',$data);
		}
	?>
</div>
