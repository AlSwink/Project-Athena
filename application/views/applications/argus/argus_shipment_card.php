<?php
	$color = array(
				'work_request' => '#872f2f',
				'regular' => '#135458'
			);

?>
<div class="col-6 mb-1 px-1 sment shipment_item <?= $shipment['type']; ?> <?= $shipment['stage']; ?> unlocked" data-shipment="<?= $shipment['shipment']; ?>" data-stage="<?= $shipment['stage']; ?>">
	<div class="card text-white shadow" style="background-color: <?= $color[$shipment['type']]; ?>">
	  <div class="card-body p-2">
	  	<?php $data['stage'] = $shipment['stage_id']; ?>
	    <h5 class="card-title">
	    	<?= $shipment['shipment']; ?> 
	    	<span class="badge badge-dark attention_card"><?= ($shipment['attention'] ? $shipment['attention'] : $shipment['shipment']); ?></span>
	    
	    	<div class="float-right"><?php loadSubTemplate('argus_status_icons',$data); ?></div>
	    </h5>
	    <h6 class="card-subtitle"><?= $shipment['stage_desc']; ?></h6>
	    <table class="table table-sm text-light mb-0 info_table">
	    	<tr>
	    		<td class="carrier text-left w-25"><?= $shipment['carrier']; ?></td>
	    		<td class="customer text-center w-25"><?= substr($shipment['customer'],0,15); ?></td>
	    		<td class="units text-center w-25"><?= substr($shipment['comments'],0,15); ?></td>
	    		<td class="text-right w-25">
	    			<?= number_format($shipment['cartons']); ?> <i class="fas fa-box fa-xs"></i>
	    			<?= number_format($shipment['weight']); ?>lbs
	    		</td>
	    	</tr>
	    </table>
	  </div>
	</div>
</div>