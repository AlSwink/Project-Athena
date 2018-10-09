<div class="row mt-3">
	<div class="col border-bottom text-center">
		<h4 class="display-4"><?= date('F d, Y'); ?></h4>
	</div>
</div>
<div class="row mt-3">
	<div class="col-5">
		<div class="row mb-3">
			<div class="col">
				<canvas id="error" height="140px"></canvas>
			</div>
		</div>
		<div class="row">
			<div class="col-4">
				<canvas id="mod_accuracy" height="375px"></canvas>
			</div>
			<div class="col-4">
				<canvas id="crs_accuracy" height="375px"></canvas>
			</div>
			<div class="col-4">
				<canvas id="sb_accuracy" height="375px"></canvas>
			</div>
		</div>
	</div>
	<div class="col-7">
		<div class="row ">
			<div class="col">
				<table class="table table-sm table-bordered text-center">
					<thead>
						<tr class="thead-dark">
							<th>Generated</th>
							<th>Counted</th>
							<th>Adjusted</th>
							<th>Error %</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><h4 class="display-4 mb-0">60</h4></td>
							<td><h4 class="display-4 mb-0">30</h4></td>
							<td><h4 class="display-4 mb-0">3</h4></td>
							<td><h4 class="display-4 mb-0">5%</h4></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col">
				<h4>Progress : (30/60)</h4>
				<div class="progress" style="height: 6%">
					<div class="progress-bar progress-bar-striped bg-success" style="width: 50%;"><h4 class="m-0">50%</h4></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<h4>Top Auditors</h4>
				<ul class="list-group"">
					<li class="list-group-item">
						Samantha Brown 
						<span class="badge badge-success float-right"><i class="fas fa-caret-up fa-lg"></i> 37</span>
					</li>
					<li class="list-group-item">
						Rasheena Robertson
						<span class="badge badge-success float-right"><i class="fas fa-caret-up fa-lg"></i> 33</span>
					</li>
					<li class="list-group-item">
						Sherelle Warren
						<span class="badge badge-success float-right"><i class="fas fa-caret-up fa-lg"></i> 30</span>
					</li>
					<li class="list-group-item">
						Aldo Murray
						<span class="badge badge-success float-right"><i class="fas fa-caret-up fa-lg"></i> 22</span>
					</li>
					<li class="list-group-item">
						Adam Robinson
						<span class="badge badge-success float-right"><i class="fas fa-caret-up fa-lg"></i> 18</span>
					</li>
				</ul>
			</div>
			<div class="col">
				<h4>Needs Attention</h4>
				<ul class="list-group"">
					<li class="list-group-item">
						Samantha Brown
						<span class="badge badge-danger float-right"><i class="fas fa-caret-down fa-lg"></i> 10</span>
					</li>
					<li class="list-group-item">
						Rasheena Robertson
						<span class="badge badge-danger float-right"><i class="fas fa-caret-down fa-lg"></i> 7</span>
					</li>
					<li class="list-group-item">
						Sherelle Warren
						<span class="badge badge-danger float-right"><i class="fas fa-caret-down fa-lg"></i> 5</span>
					</li>
					<li class="list-group-item">
						Aldo Murray
						<span class="badge badge-danger float-right"><i class="fas fa-caret-down fa-lg"></i> 4</span>
					</li>
					<li class="list-group-item">
						Adam Robinson
						<span class="badge badge-danger float-right"><i class="fas fa-caret-down fa-lg"></i> 2</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>