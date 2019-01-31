<div class="row mt-2">
	<div class="col">
		<div class="alert alert-warning">
			Below is a list of all manual or automated commands executed within the system.
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="btn-group">
			<button type="button" class="btn btn-sm btn-success" id="log_excel"><i class="fas fa-file-excel"></i> Excel</button>
			<button type="button" class="btn btn-sm btn-secondary" id="log_print"><i class="fas fa-print"></i> Print All</button>
		</div>
	</div>
	<div class="col-12">
		<table id="log_table" class="table table-sm table-hover table-bordered log_table">
			<thead>
				<tr class="thead-dark">
					<th>Log ID</th>
					<th>Action</th>
					<th>For</th>
					<th>Reason</th>
					<th>Triggered by</th>
					<th>Executed on</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
