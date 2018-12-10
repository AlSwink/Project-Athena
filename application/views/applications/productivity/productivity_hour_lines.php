<div class="row mt-2 px-1">
	<div class="col px-0">
		<table class="hourly_table table table-sm table-bordered text-center table-hover">
			<thead>
				<tr class="table-info">
					<th>Time</th>
					<th>Pickers</th>
					<th>Labor Hrs</th>
					<th>Target</th>
					<th>Remaining</th>
					<th>Completed Picks</th>
					<th>Completed Units</th>
					<th>UPP</th>
					<th>Variance</th>
					<th>P<sup>4</sup>H</th>
					<th>UP<sup>3</sup>H</th>
					<th>Time Available</th>
					<th class="w-25">Reason for Variance</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($data['hourly_data'] as $row){ ?>
					<tr data-rowid="<?= $row['ph_id']; ?>" data-from="<?= $row['from']; ?>" data-to="<?= $row['to']; ?>">
						<td><?= $row['label']; ?></td>
						<td><a href="#" class="<?= ($row['pickers'] ? 'pickers_detail' : null); ?>"><?= $row['pickers']; ?></a></td>
						<td><?= $row['labor']; ?></td>
						<td><?= $row['target']; ?></td>
						<td><?= $row['demand']; ?></td>
						<td><?= $row['picks']; ?></td>
						<td><?= $row['units']; ?></td>
						<td><?= $row['upp']; ?></td>
						<td class="<?= ($row['variance'] >= 0 ? 'text-success' : 'text-danger'); ?>"><?= $row['variance']; ?></td>
						<td><?= $row['pppph']; ?></td>
						<td><?= $row['uppph']; ?></td>
						<td>
							<div class="progress">
								<div class="progress-bar bg-success" style="width: <?= $row['time']; ?>;"><?= $row['time']; ?></div>
							</div>
						</td>
						<td><input type="text" name='reason[]' class="form-control form-control-sm text-input p-0 reasons" value="<?= $row['reason']; ?>"/></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>