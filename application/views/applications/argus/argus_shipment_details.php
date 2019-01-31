<div class="row">
	<div class="col border-right">
		<h4 class="display-4 mb-0"><?= $shipment['wms']['shipment']; ?></h4>
		<span class="badge badge-secondary"><?= $shipment['wms']['attention']; ?></span>
		<span class="badge badge-secondary"><?= $shipment['wms']['carrier']; ?></span>
		<span class="badge badge-secondary"><?= $shipment['wms']['wave']; ?></span>
	</div>
	<div class="col text-center">
		Currently<br>
		<i class="fas fa-<?= $shipment['argus']['stage_icon']; ?> fa-3x text-info"></i><br>
		<small><?= $shipment['argus']['stage_desc']; ?></small>
	</div>
</div>
<div class="row mt-3">
	<div class="col">
		<ul class="nav nav-tabs nav-fill" id="tabs" role="tablist">
		  <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#ship_detail" >General</a></li>
		  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ship_pallets" >Pallets</a></li>
		  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ship_transactions" >Transactions</a></li>
		</ul>
		<div class="tab-content">
			<div id="ship_detail" class="tab-pane active">
				<?php loadSubTemplate('argus_shipment_details_general'); ?>
			</div>
			<div id="ship_pallets" class="tab-pane">
				<?php loadSubTemplate('argus_shipment_details_pallet_info'); ?>
			</div>
			<div id="ship_transactions" class="tab-pane">
				<?php loadSubTemplate('argus_shipment_details_transactions'); ?>
			</div>
		</div>
		
	</div>
</div>