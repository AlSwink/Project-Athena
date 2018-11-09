<div class="row mt-2">
	<div class="col">
		<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Please make sure to read the manual before using this application. Improper use of this application can result to <b>irreperable damage to WMS.</b> Please exercise caution</div>
	</div>
</div>
<div class="row">
	<div class="col-4">
		<label>Enter a Wave to Replenish</label>
		<div class="input-group">
			<input type="text" id="wave" class="form-control" placeholder="Wave goes here"/>
			<div class="input-group-append">
				<button type=button id="build" class="btn btn-secondary">Build Replenishment <i class="fas fa-magic"></i></button>
			</div>
		</div>
		<div style="max-height: 70%; overflow: auto">
			<?php if($cresting_waves){ ?>
			<table class="table table-sm table-bordered table-hover mt-2 text-center" style="font-size:11px">
				<thead>
					<tr class="thead-dark">
						<th colspan="4">Cresting Waves [<?= count($cresting_waves); ?>]</th>
					</tr>
					<tr>
						<th>Wave</th>
						<th>Built? (Y/N)</th>
						<th>User</th>
						<th>Timestamp</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($cresting_waves as $wave){ ?>
					<tr class="<?= ($wave['built'] ? 'bg-success text-light' : null); ?>">
						<td ><?= $wave['wave']; ?></td>
						<td class="text-center"><?= ($wave['built'] ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'); ?></td>
						<td><?= $wave['user']; ?></td>
						<td><?= humanDate($wave['timestamp']); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php } ?>
		</div>
	</div>
	<div class="col-8">
		<h4 class="display-4">Replenishment Summary</h4>
		<hr>
		<form id="replen_summary_form">
			<input type="hidden" name="wave" value=""/>
			<div id="replen_summary" class="mb-3"></div>
		</form>
		<button type="button" class="btn btn-success w-100 btn_submit d-none mb-5">Confirm & Update Locations <i class="fas fa-check"></i></button>
	</div>
</div>
