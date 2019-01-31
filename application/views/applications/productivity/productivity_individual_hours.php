
	<th class="table-active"><?= $label; ?></th>
	<?php for($y=0;$y<count($data[$picker]['rows']);$y++){ ?>
		<td class="table-active <?= ($data[$picker]['rows'][$y][$index]['efficiency'] >= 100 ? 'text-success' : 'text-danger'); ?>"
			title="Real pick Time : <?= $data[$picker]['rows'][$y][$index]['difference']; ?>&#013;Expected Picks : <?= $data[$picker]['rows'][$y][$index]['expected_picks']; ?>&#013;Standard Picks : <?= $data[$picker]['rows'][$y][$index]['standard_time']; ?>&#013;1st Pick : <?= $data[$picker]['rows'][$y][$index]['start']; ?>&#013;Last Pick : <?= $data[$picker]['rows'][$y][$index]['end']; ?>"
			>
			<?= $data[$picker]['rows'][$y][$index]['efficiency_percentage']; ?></b>
		</td>
	<?php } ?>
<tr>
	<td>Picks</td>
	<?php for($y=0;$y<count($data[$picker]['rows']);$y++){ ?>
		<td><?= $data[$picker]['rows'][$y][$index]['picks']; ?></td>
	<?php } ?>
</tr>
<tr>
	<td>Units</td>
	<?php for($y=0;$y<count($data[$picker]['rows']);$y++){ ?>
		<td><?= $data[$picker]['rows'][$y][$index]['units']; ?></td>
	<?php } ?>
</tr>
