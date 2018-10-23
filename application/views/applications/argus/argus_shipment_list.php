<div class="row mb-2">
	<div class="col-6">
		<div class="form-group mb-0">
			<label>Search Shipment</label>
			<input id="search_shipment" type="text" class="form-control"/>
		</div>
	</div>
	<div class="col-6 text-center">
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
