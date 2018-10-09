<div class="row">
	<div class="col-7">
		<form id="generate_location_form" action="#" method="POST" class="ajaxForms">
		<div class="form-row mb-2">
			<div class="col">
				<label>Location Type</label>
				<select class="form-control" name="dataset">
					<option value="">MODS</option>
					<option value="">Cresting</option>
					<option value="">Sportsball</option>
				</select>
			</div>
			<div class="col">
				<label>Number of locations</label>
				<input type="number" class="form-control" name="num_locs" placeholder="leave empty for default" />
			</div>
		</div>
		<div class="form-row mb-2">
			<div class="col">
				<label>Generate for</label>
				<?= createEmpDropdown('emp_audited_id','user_id',['e_fname','e_lname'],[],['form-control form-control-sm']); ?>
			</div>
		</div>
		<div class="form-row">
			<div class="col">
				<div class="btn-group w-100">
					<button id="prep_from_filter" type="button" class="btn btn-secondary w-100">Prepare Locations</button>
				</div>
			</div>
		</div>
		</form>
	</div>
	<div class="col-5">
		<table id="location_generated" class="table table-sm table-bordered">
			<thead>
				<tr>
					<th colspan="2">Locations Generated</th>
				</tr>
				<tr class="text-center">
					<th>Loc</th>
					<th>SKU-PKG</th>
				</tr>
			</thead>
		</table>
		<div class="btn-group w-100">
			<button type="button" id="nike_cycle_count" disabled class="btn btn-primary start_cycle_count w-100">Insert to Audit Locations <i class="fas fa-bolt"></i></button>
		</div>
	</div>
</div>