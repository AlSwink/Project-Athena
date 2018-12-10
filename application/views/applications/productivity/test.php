<div class="container-fluid">
	<table class="table table-sm table-bordered table-hover text-center">
		<thead>
			<tr>
				<th colspan="2">Employee</th>
				<?php foreach($data['hours'] as $hour){ ?>
					<th><?= humanDate($hour['from'],'h A'); ?></th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
			<?php for($x=0;$x<count($data['data']);$x++){ ?>
					<tr>
						<th colspan="2" class="align-middle"><a data-toggle="collapse" href="#row_<?= $x; ?>"><?= trim($data['data'][$x]['picker']); ?></a></th>
						<?php for($y=0;$y<count($data['data'][$x]['rows']);$y++){ ?>
							<th title="Total Real Time : <?= $data['data'][$x]['rows'][$y]['real_time']; ?>&#013;Total Picks : <?= $data['data'][$x]['rows'][$y]['total_picks']; ?>"
							><?= $data['data'][$x]['rows'][$y]['total_efficiency']; ?></th>
						<?php } ?>
					</tr>
					<tbody class="collapse" id="row_<?= $x; ?>">
						<?php foreach($data['locations'] as $key=>$val){

								if($data['data'][$x][$key]){
									$data['data'] = $data['data'];
									$data['index'] = $key;
									$data['label'] = $val;
									$data['picker'] = $x;
									loadSubTemplate('productivity_individual_hours',$data);
								}	
						 } ?>
					</tbody>
					
			<?php } ?>
		</tbody>
	</table>
</div>