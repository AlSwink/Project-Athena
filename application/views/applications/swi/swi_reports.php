<div class="row mt-3">
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