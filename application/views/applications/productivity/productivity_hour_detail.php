<input type="hidden" name="ph_id" value="<?= $ph_id; ?>"/>
<table class="table table-sm table-bordered text-center table-hover">
	<thead>
		<tr class="table-info">
			<td>Picker</td>
			<td class="w-25">Mins Worked</td>
			<td></td>
			<td>MODs</td>
			<td>Outside</td>
			<td>Cresting</td>
			<td>Quick Pick</td>
			
		</tr>
	</thead>
	<tbody>
		<?php for($x=0;$x<count($pickers);$x++){ ?>
				<tr>
					<th rowspan="4" class="align-middle"><?= $pickers[$x]['opr']; ?></th>
					<td rowspan="4" class="align-middle">
						<input type="hidden" name="phd_id[]" value="<?= $pickers[$x]['db']['phd_id']; ?>"/>
						<input type="hidden" name="picker[]" value="<?= $pickers[$x]['opr']; ?>"/>
						<input type="text" name='labor[]' class="mins_worked form-control form-control-sm text-input p-0 text-center" value="<?= $pickers[$x]['db']['worked']; ?>"/>
					</td>
					<tr>
						<td>Picks | Units</td>
						<th><?= ($pickers[$x]['mod']['picks'] ? $pickers[$x]['mod']['picks'].' | '.$pickers[$x]['mod']['units'] : null); ?></th>
						<th><?= ($pickers[$x]['out']['picks'] ? $pickers[$x]['out']['picks'].' | '.$pickers[$x]['out']['units'] : null); ?></th>
						<th><?= ($pickers[$x]['crs']['picks'] ? $pickers[$x]['crs']['picks'].' | '.$pickers[$x]['crs']['units'] : null); ?></th>
						<th><?= ($pickers[$x]['qp']['picks'] ? $pickers[$x]['qp']['picks'].' | '.$pickers[$x]['qp']['units'] : null); ?></th>		
					</tr>
					<tr>
						<td>1st Pick</td>
						<th><?= humanDate($pickers[$x]['mod']['start'],'h:i A'); ?></th>
						<th><?= humanDate($pickers[$x]['out']['start'],'h:i A'); ?></th>
						<th><?= humanDate($pickers[$x]['crs']['start'],'h:i A'); ?></th>
						<th><?= humanDate($pickers[$x]['qp']['start'],'h:i A'); ?></th>
						
					</tr>
					<tr>
						<td>Last Pick</td>
						<th><?= humanDate($pickers[$x]['mod']['end'],'h:i A'); ?></th>
						<th><?= humanDate($pickers[$x]['out']['end'],'h:i A'); ?></th>
						<th><?= humanDate($pickers[$x]['crs']['end'],'h:i A'); ?></th>
						<th><?= humanDate($pickers[$x]['qp']['end'],'h:i A'); ?></th>
						
					</tr>
				</tr>
		<?php } ?>
	</tbody>
</table>