<div class="row mt-3">
	<div class="col-3">
		<div class="card text-white bg-info">
		  <div class="card-header">
		  	<i class="fas fa-wrench"></i> Quick Controls
		  </div>
		  <div class="card-body">
				<p class="card-text">Use this panel to quickly access Cycle Count tools and functions.</p>	    
		  </div>
		  	<ul class="list-group list-group-flush">
			    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary" data-toggle="modal" data-target="#"> <i class="fas fa-plus-circle"></i> Generate Locations</a>
			    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary" data-toggle="modal" data-target="#"> <i class="fas fa-unlock-alt"></i> Release Locations</a>
			    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary" data-toggle="modal" data-target="#"><i class="fas fa-exchange-alt"></i> Change Dataset</a>

			</ul>
		</div>
	</div>
	<div class="col-9">
		<div class="row">
			<div class="col">
				 Create a filter for generating cycle count locations by selecting any of the below options.
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-8">
				<div class="row mb-2">
					<div class="col">
						<label>Building</label>
						<select class="form-control">
							<option value="DC">DC - KNT</option>
							<option value="SB">Sports Balls - KNK</option>
						</select>
					</div>
					<div class="col">
						<label>Number of locations</label>
						<input type="number" class="form-control" placeholder="leave empty for default" />
					</div>
				</div>
				<div class="row  mb-2">
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
				<div class="row mb-5">
					<div class="col">
						<label>Range From</label>
						<input type="number" class="form-control"/>
					</div>
					<div class="col">
						<label>Range To</label>
						<input type="number" class="form-control"/>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="btn-group w-100">
							<button type="button" class="btn btn-warning w-100">Prepare Defaults</button>
							<button type="button" class="btn btn-default w-100">Add to Filter <i class="fas fa-plus"></i></button>
							<button type="button" class="btn btn-secondary w-100">Prepare from Filters</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-4">
				<table class="table table-sm table-bordered">
					<thead>
						<tr>
							<th>Locations Generated</th>
						</tr>
					</thead>
					<tbody>
						<?php for($x=0;$x<10;$x++){ ?>
						<tr>
							<td>B1-1234-48</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<button type="button" class="btn btn-success w-100">Generate Cycle Count <i class="fas fa-bolt"></i></button>
			</div>
		</div>
	</div>
</div>