<div class="row">
	<div class="col">
		<table class="table table-sm text-center table-bordered mb-1">
			<thead>
				<tr>
					<th colspan="6" class="my-display table-dark"></th>
				</tr>
				<tr>
					<th class="table-danger">Reported Documents</th>
					<th class="table-success">Resolved Processes</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="display-4">
						<span class="rd_reported"><?= $totals['reported']; ?></span>
					</td>
					<td class="display-4">
						<span class="resolved_docs"></span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col">
		<table id="reported_report" class="table table-sm text-center table-bordered mb-1">
			<thead>
				<tr class="thead-dark">
					<th>Doc #</th>
					<th>Doc Name</th>
					<th>Process</th>
					<th>Comment</th>
					<th>Resolution</th>
					<th>Resolved by</th>
					<th>Resolved</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>