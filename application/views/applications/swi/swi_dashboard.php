<div class="row mt-3">
	<div class="col-3">
		<div class="card shadow text-white bg-info">
		  <div class="card-header">
		  	<i class="fas fa-wrench"></i> Control Panel
		  </div>
		  <div class="card-body">
    			<p class="card-text">Use this panel to quickly access SWI tools and functions.</p>	    
		  </div>
		  	<ul class="list-group list-group-flush">
		  		<a href="<?= site_url('swi/assign_documents'); ?>" target="_blank" class="list-group-item list-group-item-action list-group-item-primary"><i class="fas fa-file-alt"></i> Get Assignments</a>
			    <a href="#" id="test" class="list-group-item list-group-item-action list-group-item-secondary"> <i class="fas fa-random"></i> Re-shuffle assignments</a>
			    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary"><i class="fas fa-user-tag"></i> Assign a document</a>
			    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary" data-toggle="modal" data-target="#add_swi_document"><i class="fas fa-plus-square"></i> New document</a>
			    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary"><i class="fas fa-columns"></i> Compare Data</a>
			    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary"><i class="fas fa-chart-area"></i> Create Report</a>
			    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary"><i class="fas fa-download"></i> Download Report</a>
			    <a href="#" class="list-group-item list-group-item-action list-group-item-info"><i class="fas fa-cog"></i> SWI Settings</a>
			</ul>
		</div>
	</div>
	<div class="col">
		<div class="row">
			<div class="col">
				<table class="table table-sm text-center table-bordered">
					<thead class="thead-dark">
						<tr>
							<th colspan="3">SWI Document Summary</th>
						</tr>
						<tr>
							<th>Completed Documents</th>
							<th>Assigned Documents</th>
							<th>Reported Documents</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="display-4"><?= $totals['completed']; ?><span class="u_limit"> /<?= $totals['documents'] ?></span></td>
							<td class="display-4"><?= $totals['assigned']; ?><span class="u_limit"> /<?= $totals['documents'] ?></span></td>
							<td class="display-4"><?= $totals['reported']; ?><span class="u_limit"> /<?= $totals['documents'] ?></span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<table class="table table-sm text-center table-bordered etable">
					<thead class="thead-dark">
						<tr>
							<th colspan="4">Employee Progress</th>
						</tr>
						<tr>
							<th>Name</th>
							<th>Docs</th>
							<th>Department</th>
							<th>Status</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>