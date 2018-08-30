<div class="container-fluid">
	<div class="row">
		<div class="col">
			<h3 class="display-3">SWI - <?= $summary[0]['department']; ?></h3>
		</div>
		<div class="col text-right">
			<h3 class="display-3">FY - <?= date('Y'); ?></h3>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col">
			<div class="progress" style="height: 50px">
			  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: <?= $summary[0]['progress']['completed']; ?>"><h4><?= $summary[0]['progress']['completed']; ?> COMPLETE</h4></div>
			</div>
			<div class="progress mt-2" style="height: 30px">
			  <div class="progress-bar bg-success" role="progressbar" style="width: <?= $summary[0]['progress']['met']; ?>"><b>Standard Met</b></div>
			  <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $summary[0]['progress']['reported']; ?>"><b>Reported</b></div>
			  <div class="progress-bar bg-dark" role="progressbar" style="width: <?= $summary[0]['progress']['pending']; ?>"><b>Pending</b></div>
			</div>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col">
			<table class="table table-sm table-bordered text-center">
				<thead>
					<tr>
						<th>Doc Num</th>
						<th>Doc Name
						<?php for($x=01;$x<=12;$x++){ ?>
							<th><?= date_format(date_create(date('Y-'.$x.'-d')),'M'); ?></th>
						<?php } ?>
					</tr>
				</thead>
				<tbody style="font-size: 11px">
					<?php for($x=0;$x<count($summary);$x++){ ?>
					<tr>
						<td><?= $summary[$x]['doc_num']; ?></td>
						<td><?= $summary[$x]['doc_name']; ?></td>
						<?php for($y=01;$y<=12;$y++){ ?>
							<td><?= $summary[$x]['months'][$y]['value']; ?></td>
						<?php } ?>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php loadSubTemplate('js/swi_progress_board'); ?>