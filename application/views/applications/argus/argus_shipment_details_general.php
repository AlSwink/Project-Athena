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
		<tr>
			<th>Ship Address</th>
			<td><?= $shipment['wms']['ship_addr1'].'<br>'.$shipment['wms']['ship_addr2'].'<br>'.$shipment['wms']['ship_city'].','.$shipment['wms']['ship_state'].' '.$shipment['wms']['ship_zip']; ?></td>
			<th>Comments</th>
			<td><?= $shipment['wms']['route_cmt1'].$shipment['wms']['route_cmt2'].$shipment['wms']['route_cmt3']; ?></td>
		</tr>
</table>