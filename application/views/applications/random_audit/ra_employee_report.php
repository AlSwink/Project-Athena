<?php
	$dates = $employees['dates'];
?>
<table id="emp_report" class="table table-sm table-bordered table-hover text-center">
	<thead>
		<tr class="thead-dark">
			<th>Users</th>
			<?php foreach($dates as $date){ ?>
				<th><?= $date; ?></th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach($employees['users'] as $employee){?>
		<tr>
			<td><?= $employee['user']; ?></td>
			<?php for($x=0;$x<count($dates);$x++){ ?>
				<td>
					<?= $employee['dates'][$x]; ?>
				</td>
			<?php } ?>
		</tr>
		<?php } ?>
	</tbody>
</table>