<div class="container-fluid">
	<div class="row mt-2">
		<div class="col-sm-12">
			<?= loadSubtemplate('card',array(
									'icon'=>'thermometer-half',
									'label'=>'Total Remaining',
									'sub_label'=>'units',
									'value'=>$remaining,
									'desc'=>'',
									'logic' => null
								)); ?>
		</div>
		<div class="col-sm-12">
			<?= loadSubtemplate('card',array(
									'icon'=>'flag-checkered',
									'label'=>'Total Processed',
									'sub_label'=>'units',
									'value'=>$done,
									'desc'=>'',
									'logic' => null
								)); ?>
		</div>
		<div class="col-sm-12">
			<?= loadSubtemplate('card',array(
									'icon'=>'arrow-alt-circle-down',
									'label'=>'Total Dropped',
									'sub_label'=>'',
									'value'=>$dropped,
									'desc'=>'',
									'logic' => null
								)); ?>
		</div>
		<div class="col-sm-12">
			<?= loadSubtemplate('card',array(
									'icon'=>'tachometer-alt',
									'label'=>'UPH',
									'sub_label'=>'',
									'value'=>$uph,
									'desc'=>'',
									'logic' => null
								)); ?>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col">
			<table class="table table-sm table-bordered">
				<thead>
					<tr>
						<th>Hour</th>
						<th>Dropped</th>
						<th>Processed</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($hours as $hour){ ?>
						<tr>
							<td><?= $hour['label']; ?></td>
							<td><?= $hour['dropped']; ?></td>
							<td><?= $hour['processed']; ?></td>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
