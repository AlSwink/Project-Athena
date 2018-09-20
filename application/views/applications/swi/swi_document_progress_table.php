<table class="table table-sm table-bordered text-center">
	<thead>
		<tr>
			<th>Doc Num</th>
			<th>Doc Name</th>
			<?php for($x=01;$x<=12;$x++){ ?>
				<th><?= date_format(date_create(date('Y-'.$x.'-d')),'M'); ?></th>
			<?php } ?>
		</tr>
	</thead>
	<tbody style="font-size: 11px">
		<?php for($x=0;$x<count($summary);$x++){ ?>
		<tr>
			<td><?= $summary[$x]['doc_num']; ?></td>
			<td><?= $summary[$x]['doc_name']; ?></td>
			<?php for($y=01;$y<=12;$y++){ ?>
				<td><?= $summary[$x]['months'][$y]['value']; ?></td>
			<?php } ?>
		</tr>
		<?php } ?>
	</tbody>
</table>