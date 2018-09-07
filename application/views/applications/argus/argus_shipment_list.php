<div class="row">
	<div class="col-6">
		<div class="form-group">
			<label>Search WR/Shipment</label>
			<input type="text" class="form-control"/>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12 mb-1 shipment_item" data-shipment="WR01535889" data-stage="waiting">
		<div class="card text-white" style="background-color: #872f2f">
		  <div class="card-body">
		  	<?php $data['stage'] = array(); ?>
		    <h5 class="card-title">WR01535889 <span class="float-right"><?php loadSubTemplate('argus_status_icons',$data); ?></span></h5>
		    <h6 class="card-subtitle text-light">Not Started</h6>
		    <table class="table table-sm text-light">
		    	<tr>
		    		<td>Carrier</td>
		    		<td>Customer Name</td>
		    		<td>Shipment</td>
					<td>Shipment</td>
		    	</tr>
		    </table>
		  </div>
		</div>
	</div>
	<div class="col-12 mb-1" data-shipment="WR15892565">
		<div class="card text-white" style="background-color: #872f2f">
		  <div class="card-body">
		  	<?php $data['stage'] = array('started','verified'); ?>
		    <h5 class="card-title">WR15892565 <span class="float-right"><?php loadSubTemplate('argus_status_icons',$data); ?></span></h5>
		    <h6 class="card-subtitle text-warning">Waiting for Pickup Number</h6>
		    <table class="table table-sm text-light">
		    	<tr>
		    		<td>Carrier</td>
		    		<td>Customer Name</td>
		    		<td>Shipment</td>
					<td>Shipment</td>
		    	</tr>
		    </table>
		  </div>
		</div>
	</div>
	<div class="col-12 mb-1" data-shipment="WR87987458">
		<div class="card text-white" style="background-color: #872f2f">
		  <div class="card-body">
		  	<?php $data['stage'] = array('started'); ?>
		    <h5 class="card-title">WR87987458 <span class="float-right"><?php loadSubTemplate('argus_status_icons',$data); ?></span></h5>
		    <h6 class="card-subtitle" style="color: #19e0ff">Under Verification</h6>
		    <table class="table table-sm text-light">
		    	<tr>
		    		<td>Carrier</td>
		    		<td>Customer Name</td>
		    		<td>Shipment</td>
					<td>Shipment</td>
		    	</tr>
		    </table>
		  </div>
		</div>
	</div>
	<div class="col-12 mb-1" data-shipment="14878999987">
		<div class="card text-white" style="background-color: #135458">
		  <div class="card-body">
		  	<?php $data['stage'] = array('started','verified'); ?>
		    <h5 class="card-title">14878999987 <span class="float-right"><?php loadSubTemplate('argus_status_icons',$data); ?></span></h5>
		    <h6 class="card-subtitle text-warning">Waiting on Door no.</h6>
		    <table class="table table-sm text-light">
		    	<tr>
		    		<td>Carrier</td>
		    		<td>Customer Name</td>
		    		<td>Shipment</td>
					<td>Shipment</td>
		    	</tr>
		    </table>
		  </div>
		</div>
	</div>
	<div class="col-12 mb-1" data-shipment="15787899363">
		<div class="card text-white" style="background-color: #135458">
		  <div class="card-body">
		  	<?php $data['stage'] = array('started','verified','loaded','signed','released'); ?>
		    <h5 class="card-title">15787899363 <span class="float-right"><?php loadSubTemplate('argus_status_icons',$data); ?></span></h5>
		    <h6 class="card-subtitle text-success">Released</h6>
		    <table class="table table-sm text-light">
		    	<tr>
		    		<td>Carrier</td>
		    		<td>Customer Name</td>
		    		<td>Shipment</td>
					<td>Shipment</td>
		    	</tr>
		    </table>
		  </div>
		</div>
	</div>
</div>