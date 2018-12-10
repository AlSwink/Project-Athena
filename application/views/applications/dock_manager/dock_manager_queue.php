<table class="table table-sm table-hover table-bordered">
	<thead>
		<tr class="thead-dark">
			<th>Carrier</th>
			<th>Pickup</th>
			<th>From</th>
			<th>To</th>
			<th>Contact</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($queues as $queue){ ?>
			<tr>
				<td><?= $queue['carrier']; ?></td>
				<td><?= $queue['pickup_number']; ?></td>
				<td><?= humanDate($queue['expected_start']); ?></td>
				<td><?= humanDate($queue['expected_end']); ?></td>
				<td><?= $queue['contact']; ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>