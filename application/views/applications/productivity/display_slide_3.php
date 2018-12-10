<div class="row mt-2 px-1">
	<div class="col px-0">
		<table class="hourly_table table table-sm table-bordered text-center totals">
			<thead>
				<tr class="table-secondary">
					<th class="w-25">Time</th>
					<th>Pickers</th>
					<th>Target</th>
					<th>Remaining</th>
					<th>Completed Picks</th>
					<th>Completed Units</th>
					<th>UPP</th>
					<th>Time Available</th>
					<th>Variance</th>
					<th>P<sup>4</sup>H</th>
					<th>UP<sup>3</sup>H</th>
					<th class="w-25">Reason for Variance</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($data['hourly_data'] as $row){ ?>
					<tr data-rowid="<?= $row['ph_id']; ?>" data-from="<?= $row['from']; ?>" data-to="<?= $row['to']; ?>">
						<td><?= $row['label']; ?></td>
						<td><?= $row['pickers']; ?></td>
						<td class="target"><?= $row['target']; ?></td>
						<td><?= $row['demand']; ?></td>
						<td><b><?= $row['picks']; ?></b></td>
						<td><?= $row['units']; ?></td>
						<td><?= $row['upp']; ?></td>
						<td>
							<div class="progress">
								<div class="progress-bar bg-info" style="width: <?= $row['time']; ?>;"><?= $row['time']; ?></div>
							</div>
						</td>
						<td class="<?= ($row['variance'] >= 0 ? 'text-success' : 'text-danger'); ?>"><?= $row['variance']; ?></td>
						<td><?= $row['pppph']; ?></td>
						<td><?= $row['uppph']; ?></td>
						
						<td><input type="text" name='reason[]' class="form-control form-control-sm text-input p-0 reasons" value="<?= $row['reason']; ?>"/></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>