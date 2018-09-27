<input type="hidden" id="dataset" value="<?= $totals['dataset']; ?>">
<div class="container-fluid d-print-none pb-5">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<div class="row mt-2">
		<div class="col col-sm-12">
			<ul class="nav nav-tabs nav-fill">
				<li class="nav-item "><a class="nav-link active"><b><i class="fas fa-warehouse"></i> <?= $totals['dataset_header']; ?> (FY-<?= date('Y'); ?>)</b></a></li>
			</ul>
			<ul class="nav nav-tabs nav-fill">
				<li class="nav-item">
			    	<a class="nav-link active" data-toggle="tab" href="#cyc_dash"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link " data-toggle="tab" href="#cyc_reports"><i class="fas fa-chart-line"></i> Reports</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link " data-toggle="tab" href="#cyc_controls"><i class="fas fa-sliders-h"></i> Controls</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#cyc_logs"><i class="fas fa-table"></i> Logs</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#cyc_changelog"><i class="fas fa-code"></i> Changelog</a>
			  	</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="tab-content col">
			<div class="tab-pane active" id="cyc_dash" role="tabpanel">
				<?= loadSubTemplate('cycle_count_dashboard'); ?>
			</div>
			<div class="tab-pane " id="cyc_reports" role="tabpanel">
				<?= loadSubTemplate('cycle_count_reports'); ?>
			</div>
			<div class="tab-pane " id="cyc_controls" role="tabpanel">
				<?= loadSubTemplate('cycle_count_controls'); ?>
			</div>
			<div class="tab-pane" id="cyc_logs" role="tabpanel">
				<?= loadSubTemplate('cycle_count_logs'); ?>
			</div>
			<div class="tab-pane" id="cyc_changelog" role="tabpanel">
				<?= loadSubTemplate('cycle_count_changelog'); ?>
			</div>
		</div>
	</div>
</div>

<?php

	loadSubTemplate(['modals','css','js']);

?>