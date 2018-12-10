<div class="row">
	<div class="col">
		Data as of: <em><?= date('F d, Y h:i A'); ?>
		<table class="table table-sm table-bordered table-hover text-center">
			<thead>
				<tr class="thead-dark">
					<th>Employees</th>
					<?php foreach($data['hours'] as $hour){ ?>
						<th class="individual_hours"><?= humanDate($hour['from'],'h:00 A'); ?> - <?= humanDate($hour['to'],'h:00 A'); ?></th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php 
					if(isset($data['data'])){
					for($x=0;$x<count($data['data']);$x++){ ?>
						<tr>
							<td>
								<a href="#" class="collapse_trigger" data-target="#row_<?= $x; ?>"><?= trim($data['data'][$x]['picker']); ?></a>
							</td>
							<?php for($y=0;$y<count($data['data'][$x]['rows']);$y++){ ?>
								<td title="Total Real Time : <?= $data['data'][$x]['rows'][$y]['real_time']; ?>&#013;Total Picks : <?= $data['data'][$x]['rows'][$y]['total_picks']; ?>"
								><b><?= $data['data'][$x]['rows'][$y]['total_efficiency']; ?></b></td>
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
						
				<?php } } ?>
			</tbody>
		</table>
	</div>
</div>