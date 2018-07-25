<div class="container-fluid mt-5">
	<div class="row">
		<div class="col-7" style="font-family: monospace; font-size: 10px">
			<div class="row">
				<div class="col pl-5 pt-2">
					<?= trim($info->outermost_cont); ?><br>
					5295 Logistics Drive<br>
					Memphis, TN 38118<br>
					North West
				</div>
				<div class="col pt-2" style="padding-left: 100px;">
					<?= trim($info->ship_name); ?><br>
					<?= trim($info->ship_addr1); ?><br>
					<?= trim($info->ship_addr2); ?><br>
					<?= trim($info->ship_city).', '.trim($info->ship_state).trim($info->ship_zip); ?><br>
					<?= trim($info->ship_cntry); ?>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col" style="padding-left: 70px;">
					<?= trim($info->ob_oid); ?><br>
					<?= trim($info->dt_ship); ?>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-10 text-right" style="padding-right: 15px; font-size: 15px !important">
					<b>*<?= trim($info->cust_oid); ?>*</b><br>
					<?= trim($info->cust_oid); ?>
				</div>
			</div>
			<div class="row" style="margin-top:90px">
				<table class="table" style="font-family: monospace; font-size: 8px">
					<tr>
						<td style="width:5%"></td>
						<td style="width:5%"></td>
						<td style="width:15%"><?= trim($info->sku_desc); ?></td>
						<td style="width:10%"><?= trim($info->sku); ?></td>
						<td style="width:5%"><?= trim($info->pkg); ?></td>
						<td style="width:10%"><?= trim($info->upc); ?></td>
						<td style="width:5%"><?= round(trim($info->org_qty)); ?></td>
						<td style="width:5%"><?= round(trim($info->act_qty)); ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="col-5">
			<h1>
			<img src="<?= base_url('temp/labels/'.trim($info->outermost_cont).'.jpg'); ?>" width="100%" class="p-2"><br>
			<span style="font-size:10px;margin-left: 10px"><?= trim($info->outermost_cont); ?></span>
		</div>
	</div>
</div>

<style>
	@media print{
		@page{
			size : landscape;
		}
	}

	.table td{
		border-top: none;
		padding: 5px;
	}
</style>