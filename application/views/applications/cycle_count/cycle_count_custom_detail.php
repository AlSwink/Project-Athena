<div class="row mt-2">
	<div class="col-12">
		<div class="btn-group">
			<button type="button" class="btn btn-sm btn-success" id="cr_excel"><i class="fas fa-file-excel"></i> Excel</button>
			<button type="button" class="btn btn-sm btn-dark" id="cr_print"><i class="fas fa-print"></i> Print</button>
		</div>
	</div>
	<div class="col-12 mt-1">
		<table class="table table-sm text-center table-bordered mb-1">
			<thead>
				<tr>
					<th class="table-primary">Counted Locations</th>
					<th class="table-warning">Error/Adjusted Locations</th>
					<th class="table-info">Units Counted</th>
					<th class="table-dark">Units Error</th>
					<th class="table-dark">Units Adjusted</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="display-4">
						<span class="custom_counted">0</span>
					</td>
					<td class="display-4">
						<span class="custom_error">0</span>
					</td>
					<td class="display-4">
						<span class="custom_units">0</span>
					</td>
					<td class="display-4">
						<span class="custom_net">0</span>
					</td>
					<td class="display-4">
						<span class="custom_adj">0</span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col">
		<table id="custom_detail_table" class="table table-sm text-center table-bordered table-hover">
			<thead>
				<tr class="thead-dark">
					<th colspan="2"></th>
					<th colspan="3">Round 1</th>
					<th colspan="2">Round 2</th>
				</tr>
				<tr>
					<th>ID</th>
					<th>Location</th>
					<th class="table-info">Actual</th>
					<th class="table-success">Count</th>
					<th class="table-danger border-right">Adjustment 1</th>
					<th class="table-danger">Adjustment 2</th>
					<th class="table-primary">Final</th>
				</tr>
			</thead>
		</table>
	</div>
</div>