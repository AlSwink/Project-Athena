<div class="row">
	<div class="col-6 px-1">
		<?= loadSubtemplate('card',array(
									'icon'=>'circle',
									'label'=>'Current Remaining',
									'sub_label'=>'picks|units',
									'value'=>$data['available_picks'].' | '.$data['available_units'],
									'desc'=>'Total remaining picks and units',
									'logic' => null
								)); ?>
	</div>
	<div class="col-6 px-1">
		<?= loadSubtemplate('card',array(
									'icon'=>'check-circle',
									'label'=>'Current Completed',
									'sub_label'=>'picks|units',
									'value'=>$data['cmp_picks'].' | '.$data['cmp_units'],
									'desc'=>'Total completed picks and units',
									'logic' => null
								)); ?>
	</div>
</div>