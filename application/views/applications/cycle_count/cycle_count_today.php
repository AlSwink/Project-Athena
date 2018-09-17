<div class="row">
	<div class="col">
		<div class="text-right">
			<button type="button" class="check_progress btn btn-sm btn-info">Check Progress <i class="fas fa-sync-alt"></i></button>
			<button type="button" class="btn btn-sm btn-success" id="tr_excel"><i class="fas fa-file-excel"></i> Excel</button>
			<button type="button" class="btn btn-sm btn-secondary" id="tr_print"><i class="fas fa-print"></i> Print</button>
		</div>
		<table id="cyc_today_table" class="table table-sm text-center table-bordered table-hover">
			<thead>
				<tr class="thead-dark">
					<th colspan="3"></th>
					<th colspan="3">Round 1</th>
					<th colspan="2">Round 2</th>
				</tr>
				<tr>
					<th>Location</th>
					<th>SKU</th>
					<th>PKG</th>
					<th class="table-info">Actual</th>
					<th class="table-success">Count</th>
					<th class="table-danger border-right">Adjustment</th>
					<th class="table-danger">Adjustment</th>
					<th class="table-primary">Final</th>
				</tr>
			</thead>
		</table>
	</div>
</div>