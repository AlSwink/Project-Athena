<div class="row">
	<div class="col">
		<div class="alert alert-info">
			 Create a filter for generating cycle count locations by selecting any of the below options.
		</div>
	</div>
</div>
<div class="row">
	<div class="col-7">
		<form id="generate_location_form" action="<?= site_url('cycle_count/generate_defaults/'); ?>" method="POST" class="ajaxForms">
		<div class="form-row mb-2">
			<div class="col">
				<label>Building</label>
				<select class="form-control" name="dataset">
					<option value="KNT">DC - KNT</option>
					<option value="KNK" selected>Sports Balls - KNK</option>
				</select>
			</div>
			<div class="col">
				<label>Number of locations</label>
				<input type="number" class="form-control" name="num_locs" placeholder="leave empty for default" />
			</div>
		</div>
		<div id="KNT_fields" class="fields d-none">
			<div class="form-row mb-2">
				<div class="col">
					<label>Location Type</label>
					<select class="form-control" name="loc_type">
						<option value="MODS">MODS</option>
						<option value="OUTSIDE">Outside</option>
					</select>
				</div>
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
					<th>QTY</th>
				</tr>
			</thead>
		</table>
		<div class="alert alert-warning">
			 Select/Deselect locations that should be generated for cycle counting.
		</div>
		<div class="btn-group w-100">
			<button type="button" id="nike_cycle_count" disabled class="btn btn-primary start_cycle_count w-100">Start Nike Cycle Count <i class="fas fa-bolt"></i></button>
			<button type="button" id="internal_cycle_count" disabled class="btn btn-dark w-100">Start Internal Cycle Count <i class="fas fa-bolt"></i></button>
		</div>
	</div>
</div>