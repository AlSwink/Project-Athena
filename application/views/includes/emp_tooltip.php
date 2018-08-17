<table style="color:white;border:0" cellpadding="2">
	<tbody>
		<tr>
			<td>User id</td>
			<td>:</td>
			<td><?= $employee->user_id; ?></td>
		</tr>
		<tr>
			<td>Department</td>
			<td>:</td>
			<td><?= $employee->department; ?></td>
		</tr>
		<tr>
			<td>Primary Role</td>
			<td>:</td>
			<td><?= $employee->pos1; ?></td>
		</tr>
		<tr>
			<td>Secondary Role</td>
			<td>:</td>
			<td><?= $employee->pos2; ?></td>
		</tr>
		<tr>
			<td>Staffing</td>
			<td>:</td>
			<td><?= $employee->staffing_name; ?></td>
		</tr>
		<tr>
			<td>Supervisor</td>
			<td>:</td>
			<td><?= $employee->supervisor; ?></td>
		</tr>
	</tbody>
</table>