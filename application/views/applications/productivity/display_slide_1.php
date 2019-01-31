<div class="row mb-2">
	<div class="col-4 px-1">
		<?= loadSubtemplate('card',array(
									'icon'=>'clock',
									'label'=>'Scheduled For',
									'sub_label'=>'Hour(s)',
									'value'=>$data['sched_hrs'],
									'desc'=>'',
									'logic' => null
								)); ?>
	</div>
	<div class="col-4 px-1">
		<?= loadSubtemplate('card',array(
									'icon'=>'users',
									'label'=>'Head Count',
									'sub_label'=>'Operator(s)',
									'value'=>$data['oprs'],
									'desc'=>'',
									'logic' => null
								)); ?>
	</div>
	<div class="col-4 px-1">
		<?= loadSubtemplate('card',array(
									'icon'=>'flag-checkered',
									'label'=>'Processing Capacity',
									'sub_label'=>'picks',
									'value'=>$data['processing_capacity'],
									'desc'=>'Total amount of picks that the current shift setting can handle',
									'logic' => null
								)); ?>
	</div>
</div>
<div class="row">
	<div class="col-3 px-1">
		<?= loadSubtemplate('card',array(
									'icon'=>'tachometer-alt',
									'label'=>'Target PPH',
									'sub_label'=>'PPH',
									'value'=>$data['target_pph'],
									'desc'=>'',
									'logic' => null
								)); ?>
	</div>
	<div class="col-3 px-1">
		<?= loadSubtemplate('card',array(
										'icon'=>'tachometer-alt text-info',
										'label'=>'Actual PPH',
										'sub_label'=>'pph',
										'value'=>$data['actual_pph'],
										'desc'=>'Actual Pick per hour',
										'logic' => ($data['actual_pph'] >= $data['target_pph'] ? 'text-success' : 'text-danger')
								)); ?>
	</div>
	<div class="col-3 px-1">
		<?= loadSubtemplate('card',array(
									'icon'=>'arrows-alt-h',
									'label'=>'Variance to Target Picks',
									'sub_label'=>'Pick(s)',
									'value'=>$data['variance_to_target'],
									'desc'=>'',
									'logic' => ($data['variance_to_target'] > 0 ? 'text-success' : 'text-danger')
								)); ?>
	</div>
	<div class="col-3 px-1">
		<?= loadSubtemplate('card',array(
										'icon'=>'tasks',
										'label'=>'Efficiency',
										'sub_label'=>'%',
										'value'=>$data['efficiency'],
										'desc'=>'Percentage completed towards capacity',
										'logic' => ($data['efficiency'] >= 100 ? 'text-success' : 'text-danger')
								)); ?>
	</div>
</div>