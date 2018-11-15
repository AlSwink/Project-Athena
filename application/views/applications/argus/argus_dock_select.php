<div class="row">
	<div class="col">
		<h4>Step 2 : Enter Dock Information</h4>
	</div>
</div>
<div class="row">
	<div class="col-5">
	</div>
	<div class="col-7">
		<table class="table table-sm text-center">
			<thead>
				<tr class="thead-dark">
					<th>Dock #</th>
					<th>Status</th>
					<th>Note</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($doors as $door){ ?>
					<tr class="<?= ($door['status'] ? 'table-danger' : null); ?>">
						<td><?= $door['dock']; ?></td>
						<td><?= ($door['status'] ? 'Occupied' : 'Open'); ?></td>
						<td><?= $door['note']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="alert alert-warning mt-2">
			Please verify the information is correct before proceeding in order to avoid shipping delays.
		</div>
		<button type="button" class="btn btn-lg btn-success w-100">Confirm and Receive <i class="fas fa-check-circle"></i></button>
	</div>
</div>
