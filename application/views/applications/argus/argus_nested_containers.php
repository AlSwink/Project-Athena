<div class="mt-2" style="max-height: 45%;overflow: auto;">
	<?php foreach($shipment['pallet_info'] as $pallet=>$conts){ ?>
			<div class="col mx-0">
				<h6><i class="fas fa-pallet"></i> <?= $pallet; ?> <b>[<?= count($conts); ?>]</b></h6>
				<div class="row col mt-2 mx-0 px-0">
					<?php foreach($conts as $cont){ ?>
						<div class="card text-center col-2 mb-1 px-0 containers">
							<?= $cont; ?>
						</div>					
					<?php } ?>
				</div>	
			</div>
		<hr>
	<?php } ?>
</div>