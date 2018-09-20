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
							<span class="total_counted"><?= $totals['counted_today']; ?></span>
						</td>
						<td class="display-4">
							<span class="total_qty"><?= $totals['net_adj']; ?></span>
						</td>
						<td class="display-4">
							<span class="total_adj"><?= $totals['qty']; ?></span>
						</td>
						<td class="display-4">
							<span class="total_adj"><?= $totals['net_adj']; ?></span>
						</td>
						<td class="display-4">
							<span class="total_adj"><?= $totals['abs_adj']; ?></span>
						</td>
					</tr>
				</tbody>
			</table>
	</div>
</div>
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
					<th colspan=""></th>
					<th colspan="3">Round 1</th>
					<th colspan="2">Round 2</th>
				</tr>
				<tr>
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