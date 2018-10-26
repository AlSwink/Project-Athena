<div style="max-height: 30%;overflow: auto" class="mt-2">
		<table class="table table-sm table-bordered table-hover shipment_details_table">
			<thead>
				<tr class="thead-dark">
					<th>Stage</th>
					<th>Start</th>
					<th>End</th>
					<th>User</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($shipment['argus']['transactions'] as $transaction){ ?>
					<tr>
						<td><i class="fas fa-<?= $transaction['stage_icon']; ?> text-success"></i> <?= strtoupper($transaction['stage']); ?></td>
						<td><?= humanDate($transaction['start']); ?></td>
						<td><?= humanDate($transaction['end']); ?></td>
						<td><?= $transaction['e_fname'].' '.$transaction['e_lname']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
</div>