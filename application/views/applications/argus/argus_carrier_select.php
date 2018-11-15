<div class="col-6 offset-3">
	<div class="card shadow">
		<div class="card-body">
			<h4>Step 1 : Enter Carrier Info</h4>
			<hr>
			<label>Select a Carrier</label>
			<select name="outbound_carrier" class="form-control form-control-lg">
				<?php foreach($carriers as $carrier){ ?>
					<option class="<?= $carrier['carrier_code']; ?>" data-img="<?= $carrier['carrier_logo']; ?>"><?= $carrier['carrier_name']; ?></option>
				<?php } ?>
			</select>
			<br>
			<label>Enter Trailer Number</label>
			<input type="text" name="trailer_number" class="form-control form-control-lg"/>
			<br>
			<label>Enter Pickup Number</label>
			<input type="text" name="pickup_number" class="form-control form-control-lg" placeholder="(Optional)" />
			<div class="alert alert-warning mt-2">
				Please verify the information is correct before proceeding in order to avoid shipping delays.
			</div>
			<button id="save_carrier" type="button" class="btn btn-lg btn-primary w-100">Proceed to Step 2 <i class="fas fa-arrow-alt-circle-right"></i></button>
		</div>
	</div>	
</div>