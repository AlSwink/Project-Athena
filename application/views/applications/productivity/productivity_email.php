<html>
<body style="font-family: sans-serif;">
	<h1 style="font-weight: 300;margin-bottom: 0px;"><?= $header; ?> Productivity Report</h1>
	<span style="font-weight: 500;color: #c10000;font-size:18px;margin: 5px 0px 0px 0px;">as of <?= date('m/d/y H:i A'); ?></span>
	<hr>
	<table style="width: 100%">
		<tr>
			<td style="padding: 15px;border: 1px solid #dadada;">
				<h3 style="margin-bottom: 5px;">Actual Capacity</h3>
				<center>
					<span style="font-size: 30px;"><?= $data['processing_capacity']; ?> <span style="color:gray;font-size: 20px;">picks</span></span>
				</center>
			</td>
			<td style="padding: 15px;border: 1px solid #dadada;">
				<h3 style="margin-bottom: 5px;">Variance to Capacity</h3>
				<center>
					<span style="font-size: 30px;color: <?= ($data['variance_to_target'] < 0 ? 'red' : 'green'); ?>"><?= $data['variance_to_target']; ?> <span style="color:gray;font-size: 20px;">picks</span></span>
				</center>
			</td>
			<td style="padding: 15px;border: 1px solid #dadada;">
				<h3 style="margin-bottom: 5px;">Efficiency</h3>
				<center>
					<span style="font-size: 30px;"><?= $data['efficiency']; ?>%</span>
				</center>
			</td>
		</tr>
	</table>
	<table style="width: 100%">
		<tr>
			<td style="padding: 15px;border: 1px solid #dadada;width: 50%">
				<h3 style="margin-bottom: 5px;">Actual PPH</h3>
				<center>
					<span style="font-size: 30px;"><?= $data['actual_pph']; ?> <span style="color:gray;font-size: 20px;">pph</span></span>
				</center>
			</td>
			<td style="padding: 15px;border: 1px solid #dadada;width: 50%">
				<h3 style="margin-bottom: 5px;">Variance to Target PPH</h3>
				<center>
					<span style="font-size: 30px;color: <?= ($data['variance_pph'] <= $data['target_pph'] ? 'red' : 'green'); ?>"><?= $data['variance_pph']; ?> <span style="color:gray;font-size: 20px;">pph</span></span>
				</center>
			</td>
		</tr>
	</table>
	<table style="width: 100%">
		<tr>
			<td style="padding: 15px;border: 1px solid #dadada;width: 50%">
				<h3 style="margin-bottom: 5px;">Remaining <span style="color:gray;font-size: 15px;">Picks | Units</span></h3>
				<center><span style="text-align: right;font-size: 30px;">
					<?= $data['available_picks'].' | '.$data['available_units']; ?>
				</span></center>
			</td>
			<td style="padding: 15px;border: 1px solid #dadada;width: 50%">
				<h3 style="margin-bottom: 5px;">Completed <span style="color:gray;font-size: 15px;">Picks | Units</span></h3>
				<center><span style="text-align: right;font-size: 30px;">
					<?= $data['cmp_picks'].' | '.$data['cmp_units']; ?>
				</span></center>
			</td>
		</tr>
	</table>
	<h2 style="margin-bottom: 0px;">Hourly Breakdown</h2>
	<table border=1 cellpadding=1 style="width: 100%;text-align: center;vertical-align: middle;border: 1px solid #dadada;margin: 10px 0px 10px 0px;border-collapse: collapse;">
		<thead>
			<tr style="background-color: #9ffffb;">
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
				<tr style="background-color: <?= ($row['variance'] < 0 ? '#ff8c8c' : 'white'); ?>;">
					<td><?= $row['label']; ?></td>
					<td><?= $row['pickers']; ?></td>
					<td class="target"><?= $row['target']; ?></td>
					<td><?= $row['demand']; ?></td>
					<td><b><?= $row['picks']; ?></b></td>
					<td><?= $row['units']; ?></td>
					<td><?= $row['upp']; ?></td>
					<td><?= $row['time']; ?></td>
					<td><b><?= $row['variance']; ?></b></td>
					<td><?= $row['pppph']; ?></td>
					<td><?= $row['uppph']; ?></td>
					<td><?= $row['reason']; ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</body>
</html>