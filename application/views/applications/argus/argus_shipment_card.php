<?php
	$color = array(
				'work_request' => '#872f2f',
				'regular' => '#135458'
			);

?>
<div class="col-6 mb-1 px-1 sment shipment_item <?= $shipment['type']; ?> unlocked" data-shipment="<?= $shipment['shipment']; ?>" data-stage="<?= $shipment['stage']; ?>">
	<div class="card text-white" style="background-color: <?= $color[$shipment['type']]; ?>">
	  <div class="card-body p-2">
	  	<?php $data['stage'] = $shipment['stage_id']; ?>
	    <h5 class="card-title"><?= $shipment['shipment']; ?> <span class="float-right"><?php loadSubTemplate('argus_status_icons',$data); ?></span></h5>
	    <h6 class="card-subtitle text-light"><?= $shipment['stage_desc']; ?></h6>
	    <table class="table table-sm text-light mb-0 info_table">
	    	<tr>
	    		<td class="carrier text-left w-25"><?= $shipment['carrier']; ?></td>
	    		<td class="customer text-center w-50"><?= substr($shipment['customer'],0,15); ?></td>
	    		<td class="units text-right w-25"><?= number_format($shipment['qty']); ?></td>
	    	</tr>
	    </table>
	  </div>
	</div>
</div>