<div class="row">
	<div class="col-lg-12 col-sm-12">
		<div class="table-responsive">
			<table class="table table-sm text-center table-bordered mb-1">
				<thead>
					<tr>
						<th colspan="6" class="my-display table-dark"></th>
					</tr>
					<tr>
						<th class="table-primary">Completed Documents</th>
						<th class="table-info">Unassigned Documents</th>
						<th class="table-warning">Pending Documents</th>
						<th class="table-success">Standard Met</th>
						<th class="table-secondary">Deprecations</th>
						<th class="table-danger">Reported</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="display-4"><span id="rd_completed"><?= $totals['completed']; ?></span><span class="u_limit"> /<?= $totals['documents'] ?></span></td>
						<td class="display-4"><span id="rd_unassigned"><?= $totals['unassigned']; ?></span></td>
						<td class="display-4"><span id="rd_pending"><?= $totals['pending']; ?></span><span class="u_limit"> /<?= $totals['documents'] ?></span></td>
						<td class="display-4"><span id="rd_standard"><?= $totals['standard_met']; ?></span><span class="u_limit"> /<?= $totals['documents'] ?></span></td>
						<td class="display-4"><span id="rd_deprecation"><?= $totals['deprecation']; ?></span><span class="u_limit"> /<?= $totals['documents'] ?></span></td>
						<td class="display-4"><span id="rd_reported"><?= $totals['reported']; ?></span><span class="u_limit"> /<?= $totals['documents'] ?></span></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-12">
		<label class="mb-0">Search Filters</label>
		<input id="search_report_assignment" type="text" class="form-control form-control-sm text-input" placeholder="Quicksearch">
	</div>
	<div class="col-lg-3 col-md-4 col-sm-12">
		<label class="mb-0">Department</label>
		<?= createDropdown('dept','departments','department','department_filter',['has_swi = 1'],'form-control form-control-sm document_report_filters is_filter'); ?>
	</div>
	<div class="col-lg-2 col-md-4 col-sm-12">
		<label class="mb-0">Status</label>
		<select id="status_filter" class="form-control form-control-sm is_filter document_report_filters">
			<option value="">Show all</option>
			<option>Standard Met</option>
			<option>Deprecation</option>
			<option>Pending</option>
			<option>Reported</option>
		</select>
	</div>
	<div class="col-lg-3 col-md-12 col-sm-12">
		<label class="mb-0">Controls</label>
		<div class="btn-group btn-group-sm text-right">
			<button id="rdl_table_reload" type="button" class="btn btn-info">Fetch new data <i class="fas fa-sync-alt"></i></button>
			<button id="rdl_excel" type="button" class="btn btn-success">Excel <i class="fas fa-file-excel"></i></button>
			<button id="rprint" type="button" class="btn btn-secondary">Print <i class="fas fa-print"></i></button>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<table id="report_document_table" class="table table-sm text-center table-bordered table-hover">
			<thead class="thead-dark">
				<tr>
					<th>Assignment ID</th>
					<th>Doc #</th>
					<th>Doc Name</th>
					<th>Department</th>
					<th>Status</th>
					<th>Assigned to</th>
					<th>Assigned on</th>
					<th>Completed on</th>
				</tr>
			</thead>
		</table>
	</div>
</div>