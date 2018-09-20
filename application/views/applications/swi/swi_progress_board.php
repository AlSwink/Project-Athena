<div class="container-fluid">
	<div class="row">
		<div class="col-6">
			<img src="<?= base_url('/assets/img/xpo_logo.png'); ?>" class="img-fluid mt-2">
		</div>
		<div class="col-6 text-right">
			<h2 class="display-2">FY - <?= date('Y'); ?></h2>
		</div>
	</div>
	<div class="row border-bottom border-top mt-2">
		<div class="col">
			<div class="row">
				<div class="col text-center">
					<h4 class="display-4">KNT Progress</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-sm-12">
					<canvas id="days_prog" height="175px"></canvas>
				</div>
				<div class="col-lg-4 col-sm-12">
					<canvas id="doc_prog" height="175px"></canvas>
				</div>
				<div class="col-lg-4 col-sm-12">
					<canvas id="standard_acc" height="175px"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col text-center">
			<h4 class="display-4"><?= $summary[0]['department']; ?> Progress</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-6">
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
				<div id="" class="col">
					<?php loadSubTemplate('swi_document_progress_table',array('summary'=>$summary)); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php loadSubTemplate(['js','js/swi_progress_board']); ?>