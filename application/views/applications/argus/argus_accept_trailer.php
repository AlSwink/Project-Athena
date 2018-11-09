<div class="container-fluid">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<div class="row">
		<div class="col">
			<h4 class="display-4"><i class="fas fa-truck"></i> Accept Outbound Trailer</h4>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-6 offset-3">
			<div class="card shadow">
				<div class="card-body">
					<h4>Step 1 : Enter Carrier Info</h4>
					<hr>
					<label>Select a Carrier</label>
					<select name="outbound_carrier" class="form-control">
						<?php foreach($carriers as $carrier){ ?>
							<option><?= $carrier['carrier']; ?></option>
						<?php } ?>
					</select>
					<br>
					<label>Enter Trailer Number</label>
					<input type="text" name="trailer_number" class="form-control"/>
					<div class="alert alert-warning mt-2">
						Please verify the information is correct before proceeding in order to avoid shipping delays.
					</div>
					<button type="button" class="btn btn-lg btn-primary w-100">Proceed to Step 2 <i class="fas fa-arrow-alt-circle-right"></i></button>
				</div>
			</div>
		</div>
	</div>
</div>