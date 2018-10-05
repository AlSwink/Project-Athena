<div class="row">
	<div class="col-6">
		<div class="form-group">
			<label>Search WR/Shipment</label>
			<input type="text" class="form-control"/>
		</div>
	</div>
	<div class="col-6 text-center">
		<?php loadSubTemplate('argus_status_count'); ?>
	</div>
</div>
<div class="row">
	<div class="col-12 mb-1 sment shipment_item" data-shipment="WR01535889" data-stage="waiting">
		<div class="card text-white" style="background-color: #872f2f">
		  <div class="card-body">
		  	<?php $data['stage'] = array(); ?>
		    <h5 class="card-title">WR01535889 <span class="float-right"><?php loadSubTemplate('argus_status_icons',$data); ?></span></h5>
		    <h6 class="card-subtitle text-light">Not Started</h6>
		    <table class="table table-sm text-light">
		    	<tr>
		    		<td class="carrier">AVRT</td>
		    		<td>Customer Name</td>
		    		<td>Shipment</td>
					<td>Shipment</td>
		    	</tr>
		    </table>
		  </div>
		</div>
	</div>
	<div class="col-12 mb-1 sment shipment_item" data-shipment="WR15892565" data-stage="verified">
		<div class="card text-white" style="background-color: #872f2f">
		  <div class="card-body">
		  	<?php $data['stage'] = array('started','verification','verified'); ?>
		    <h5 class="card-title">WR15892565 <span class="float-right"><?php loadSubTemplate('argus_status_icons',$data); ?></span></h5>
		    <h6 class="card-subtitle text-warning">Waiting for Pickup Number</h6>
		    <table class="table table-sm text-light">
		    	<tr>
		    		<td class="carrier">AVRT</td>
		    		<td>Customer Name</td>
		    		<td>Shipment</td>
					<td>Shipment</td>
		    	</tr>
		    </table>
		  </div>
		</div>
	</div>
	<div class="col-12 mb-1 sment shipment_item" data-shipment="WR87987458" data-stage="verification">
		<div class="card text-white" style="background-color: #872f2f">
		  <div class="card-body">
		  	<?php $data['stage'] = array('started'); ?>
		    <h5 class="card-title">WR87987458 <span class="float-right"><?php loadSubTemplate('argus_status_icons',$data); ?></span></h5>
		    <h6 class="card-subtitle" style="color: #19e0ff">Under Verification</h6>
		    <table class="table table-sm text-light">
		    	<tr>
		    		<td class="carrier">TBD</td>
		    		<td>Customer Name</td>
		    		<td>Shipment</td>
					<td>Shipment</td>
		    	</tr>
		    </table>
		  </div>
		</div>
	</div>
	<div class="col-12 mb-1 sment shipment_item" data-shipment="14878999987" data-stage="verified">
		<div class="card text-white" style="background-color: #135458">
		  <div class="card-body">
		  	<?php $data['stage'] = array('started','verification','verified'); ?>
		    <h5 class="card-title">14878999987 <span class="float-right"><?php loadSubTemplate('argus_status_icons',$data); ?></span></h5>
		    <h6 class="card-subtitle text-warning">Waiting on Door no.</h6>
		    <table class="table table-sm text-light">
		    	<tr>
		    		<td class="carrier">TBD</td>
		    		<td>Customer Name</td>
		    		<td>Shipment</td>
					<td>Shipment</td>
		    	</tr>
		    </table>
		  </div>
		</div>
	</div>
	<div class="col-12 mb-1 sment shipment_item" data-shipment="15787899363" data-stage="ship_complete">
		<div class="card text-white" style="background-color: #135458">
		  <div class="card-body">
		  	<?php $data['stage'] = array('started','verification','verified','loaded','signed','released'); ?>
		    <h5 class="card-title">15787899363 <span class="float-right"><?php loadSubTemplate('argus_status_icons',$data); ?></span></h5>
		    <h6 class="card-subtitle text-success">Released</h6>
		    <table class="table table-sm text-light">
		    	<tr>
		    		<td class="carrier">TBD</td>
		    		<td>Customer Name</td>
		    		<td>Shipment</td>
					<td>Shipment</td>
		    	</tr>
		    </table>
		  </div>
		</div>
	</div>
</div>