<div class="row">
	<div class="col">
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
						<span class="total_counted"><?= $totals['today']['counted']; ?></span>
					</td>
					<td class="display-4">
						<span class="total_qty"><?= $totals['today']['adjusted']; ?></span>
					</td>
					<td class="display-4">
						<span class="total_adj"><?= $totals['today']['units']['all']; ?></span>
					</td>
					<td class="display-4">
						<span class="total_adj"><?= $totals['today']['units']['net_adj']; ?></span>
					</td>
					<td class="display-4">
						<span class="total_adj"><?= $totals['today']['units']['abs_adj']; ?></span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-2">
		<button type="button" class="delete_locations btn btn-sm btn-danger" disabled>Delete Records <i class="fas fa-trash"></i></button>
	</div>
	<div class="col">
		<div class="text-right">
			<button type="button" class="check_progress btn btn-sm btn-info">Check Progress <i class="fas fa-sync-alt"></i></button>
			<button type="button" class="btn btn-sm btn-success" id="tr_excel"><i class="fas fa-file-excel"></i> Excel</button>
			<button type="button" class="btn btn-sm btn-secondary" id="trb_print"><i class="fas fa-print"></i> Print Blind</button>
			<button type="button" class="btn btn-sm btn-secondary" id="tr_print"><i class="fas fa-print"></i> Print All</button>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<table id="cyc_today_table" class="table table-sm text-center table-bordered table-hover">
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