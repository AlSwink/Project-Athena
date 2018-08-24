<div class="row">
	<div class="col">
		<table class="table table-sm table-bordered" style="font-size: 12px">
			<tbody>
				<tr>
					<td>Locations Submitted</td>
					<th><?= $locations; ?></th>
				</tr>
				<tr>
					<td>Format Basis</td>
					<th><?= $format; ?></th>
				</tr>
				<tr>
					<td>Template grabbed from</td>
					<th><?= $template['loc']; ?></th>
				</tr>
				<tr>
					<td>Duplicate found</td>
					<th class="text-danger"><?= count($existing); ?></th>
				</tr>
				<tr>
					<td>To be inserted</td>
					<th class="text-success"><?= count($insert); ?></th>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col">
		<h5>Template Data</h5>
		<div class="table-responsive">
			<table class="table table-sm table-hover table-bordered" style="font-size: 10px;">
				<thead>
					<tr class="table-primary">
						<?php 
							$headers = array_keys($template);
							foreach($headers as $header){ ?>
						<th><?= strtoupper($header); ?></th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php foreach($headers as $header){ ?>
							<td><?= $template[$header]; ?></td>
						<?php } ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row mt-2">
	<div class="col">
		<h5>Data to insert</h5>
		<div class="table-responsive" style="max-height: 30%;overflow: auto">
			<table class="table table-sm table-hover table-bordered" style="font-size: 10px;">
				<thead>
					<tr class="table-success">
						<?php foreach($headers as $header){ ?>
						<th><?= strtoupper($header); ?></th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach($insert as $row){ ?>
					<tr>
						<?php foreach($headers as $header){ ?>
							<td><?= $row[$header]; ?></td>
						<?php } ?>
						<input type="hidden" name="locs[]" value="<?= $row['loc']; ?>"/>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<input type="hidden" name="template_loc" value="<?= $template['loc']; ?>"/>