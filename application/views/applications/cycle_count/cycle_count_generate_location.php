<div class="row">
	<div class="col">
		<div class="alert alert-info">
			 Create a filter for generating cycle count locations by selecting any of the below options.
		</div>
	</div>
</div>
<div class="row">
	<div class="col-7">
		<form id="generate_location_form" action="<?= site_url('cycle_count/generate_defaults/'.$totals['dataset']); ?>" method="POST" class="ajaxForms">
		<div class="form-row mb-2">
			<div class="col">
				<label>Building</label>
				<select class="form-control">
					<!--option value="DC">DC - KNT</option-->
					<option value="SB">Sports Balls - KNK</option>
				</select>
			</div>
			<div class="col">
				<label>Number of locations</label>
				<input type="number" class="form-control" name="num_locs" placeholder="leave empty for default" />
			</div>
		</div>
		<!--div class="form-row mb-2">
			<div class="col">
				<label>Location</label>
				<select class="form-control">
					<option value="DC">All</option>
					<option value="SB">MODS</option>
					<option value="SB">Outside</option>
				</select>
			</div>
			<div class="col">
				<label>MOD</label>
				<select class="form-control">
					<option value="DC">A</option>
					<option value="DC">B</option>
				</select>
			</div>
			<div class="col">
				<label>MOD Filter</label>
				<select class="form-control">
					<option value="DC">Floor</option>
					<option value="DC">Wing Rack</option>
					<option value="SB">Carton Flow</option>
					<option value="SB">Aisle Range</option>
				</select>
			</div>
		</div>
		<div class="form-row mb-3">
			<div class="col">
				<label>Range From</label>
				<input type="number" class="form-control"/>
			</div>
			<div class="col">
				<label>Range To</label>
				<input type="number" class="form-control"/>
			</div>
		</div-->
		<div class="form-row">
			<div class="col">
				<div class="btn-group w-100">
					<button type="button" class="btn btn-warning w-100" disabled>Prepare Defaults</button>
					<button type="button" class="btn btn-default w-100" disabled>Add to Filter <i class="fas fa-plus"></i></button>
					<button id="prep_from_filter" type="button" class="btn btn-secondary w-100">Prepare from Filters</button>
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