<div class="row">
	<div class="col-2 px-1">
		<?= loadSubtemplate('card',array(
									'icon'=>'flag-checkered',
									'label'=>'Processing Capacity',
									'sub_label'=>'picks',
									'value'=>$data['processing_capacity'],
									'desc'=>'Total amount of picks that the current shift setting can handle',
									'logic' => null
								)); ?>
	</div>
	<div class="col-2 px-1">
		<?= loadSubtemplate('card',array(
										'icon'=>'tachometer-alt text-success',
										'label'=>'Target Picks Per Hour',
										'sub_label'=>'pph',
										'value'=>$data['target_pph'],
										'desc'=>'PPH Based off weighted time study considering all pick locations',
										'logic' => null
								)); ?>
	</div>
	<div class="col-2 px-1">
		<?= loadSubtemplate('card',array(
										'icon'=>'arrows-alt-h',
										'label'=>'Variance to Target',
										'sub_label'=>'picks',
										'value'=>$data['variance_to_target'],
										'desc'=>'Difference to target picks',
										'logic' => ($data['variance_to_target'] > 0 ? 'text-success' : 'text-danger')
								)); ?>
	</div>
	<div class="col-2 px-1">
		<?= loadSubtemplate('card',array(
										'icon'=>'tasks',
										'label'=>'Efficiency',
										'sub_label'=>'%',
										'value'=>$data['efficiency'],
										'desc'=>'Percentage completed towards capacity',
										'logic' => ($data['efficiency'] >= 100 ? 'text-success' : 'text-danger')
								)); ?>
	</div>
	<div class="col-2 px-1">
		<?= loadSubtemplate('card',array(
										'icon'=>'tachometer-alt text-info',
										'label'=>'Actual PPH',
										'sub_label'=>'pph',
										'value'=>$data['actual_pph'],
										'desc'=>'Actual Pick per hour',
										'logic' => ($data['actual_pph'] >= $data['target_pph'] ? 'text-success' : 'text-danger')
								)); ?>
	</div>
	<div class="col-2 px-1">
		<?= loadSubtemplate('card',array(
										'icon'=>'tachometer-alt text-muted',
										'label'=>'Variance to PPH',
										'sub_label'=>'pph',
										'value'=>$data['variance_pph'],
										'desc'=>'Variance to target Pick per hour',
										'logic' => ($data['variance_pph'] > 0 ? 'text-success' : 'text-danger')
								)); ?>
	</div>
</div>
<div class="row mt-2 px-1">
	<div class="col-2 px-1">
		<?= loadSubtemplate('card',array(
									'icon'=>'calculator',
									'label'=>'Simulated Capacity',
									'sub_label'=>'picks',
									'value'=>$data['simulated_capacity'],
									'desc'=>'Simulated amount of picks that the current shift setting can handle',
									'logic' => null
								)); ?>
	</div>
	<div class="col-3 px-1">
		<?= loadSubtemplate('card',array(
									'icon'=>'circle',
									'label'=>'Current Remaining',
									'sub_label'=>'picks|units',
									'value'=>$data['available_picks'].' | '.$data['available_units'],
									'desc'=>'Total remaining picks and units',
									'logic' => null
								)); ?>
	</div>
	<div class="col-3 px-1">
		<?= loadSubtemplate('card',array(
									'icon'=>'check-circle',
									'label'=>'Current Completed',
									'sub_label'=>'picks|units',
									'value'=>$data['cmp_picks'].' | '.$data['cmp_units'],
									'desc'=>'Total completed picks and units',
									'logic' => null
								)); ?>
	</div>
	<div class="col-4 px-1">
		<?= loadSubtemplate('card',array(
									'icon'=>'thumbs-up',
									'label'=>'Summary',
									'sub_label'=>null,
									'value'=>'We are still on track if we can increase efficiency',
									'desc'=>'Productivity suggestions',
									'logic' => null
								)); ?>
	</div>
</div>