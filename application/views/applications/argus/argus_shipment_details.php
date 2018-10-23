<div class="row">
	<div class="col border-right">
		<h4 class="display-4 mb-0"><?= $shipment['wms']['shipment']; ?></h4>
		<span class="badge badge-secondary"><?= $shipment['wms']['attention']; ?></span>
		<span class="badge badge-secondary"><?= $shipment['wms']['carrier']; ?></span>
		<span class="badge badge-secondary"><?= $shipment['wms']['wave']; ?></span>
	</div>
	<div class="col text-center">
		Currently<br>
		<i class="fas fa-<?= $shipment['argus']['stage_icon']; ?> fa-3x text-info"></i><br>
		<small><?= $shipment['argus']['stage_desc']; ?></small>
	</div>
</div>
<div class="row mt-3">
	<div class="col">
		<table class="table table-sm shipment_details_table">
			<tr>
				<th>Customer</th>
				<td><?= $shipment['wms']['ship_name']; ?></td>
				<th>Acct Number</th>
				<td><?= $shipment['wms']['pay_acct']; ?></td>
			</tr>
			<tr>
				<th>Sched Date</th>
				<td><?= humanDate($shipment['wms']['sched_date'],'m/d/Y'); ?></td>
				<th>FR Terms</th>
				<td><?= $shipment['wms']['fr_terms']; ?></td>
			</tr>
			<tr>
				<th>PROBILL</th>
				<td colspan="3"><?= $shipment['wms']['probill']; ?></td>
			</tr>
			<tr>
				<th>Cartons</th>
				<td><?= $shipment['wms']['cartons']; ?></td>
				<th>Weight</th>
				<td><?= $shipment['wms']['wgt']; ?>lbs</td>
			</tr>
			<!--tr>
				<th>Lines</th>
				<td><?= $shipment['wms']['num_line']; ?></td>
				<th>Units</th>
				<td><?= $shipment['wms']['num_unit']; ?></td>
			</tr-->
			<tr>
				<th>Ship Address</th>
				<td><?= $shipment['wms']['ship_addr1'].'<br>'.$shipment['wms']['ship_addr2'].'<br>'.$shipment['wms']['ship_city'].','.$shipment['wms']['ship_state'].' '.$shipment['wms']['ship_zip']; ?></td>
				<th>Comments</th>
				<td><?= $shipment['wms']['route_cmt1'].$shipment['wms']['route_cmt2'].$shipment['wms']['route_cmt3']; ?></td>
			</tr>
		</table>
	</div>
</div>
<div class="row">
	<div class="col">
		<div style="max-height: 30%;overflow: auto">
			<table class="table table-sm table-bordered table-hover shipment_details_table">
				<thead>
					<tr class="thead-dark">
						<th>Stage</th>
						<th>Start</th>
						<th>End</th>
						<th>User</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($shipment['argus']['transactions'] as $transaction){ ?>
						<tr>
							<td><i class="fas fa-<?= $transaction['stage_icon']; ?> text-success"></i> <?= strtoupper($transaction['stage']); ?></td>
							<td><?= humanDate($transaction['start']); ?></td>
							<td><?= humanDate($transaction['end']); ?></td>
							<td><?= $transaction['e_fname'].' '.$transaction['e_lname']; ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>