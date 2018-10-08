<div class="container-fluid">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<div class="row mt-2">
		<div class="col col-sm-12">
			<ul class="nav nav-tabs nav-fill dashboard_tabs">
				<li class="nav-item ">
			    	<a class="nav-link active" data-toggle="tab" href="#ra_dash"><i class="fas fa-tachometer-alt"></i>  Dashboard</a>
			  	</li>
			  	<li class="nav-item ">
			    	<a class="nav-link " data-toggle="tab" href="#ra_reports"><i class="fas fa-chart-line"></i>  Reporting</a>
			  	</li>
			  	<li class="nav-item ">
			    	<a class="nav-link " data-toggle="tab" href="#ra_controls"><i class="fas fa-sliders-h"></i>  Controls</a>
			  	</li>
			  	<li class="nav-item ">
			    	<a class="nav-link" data-toggle="tab" href="#ra_logs"><i class="fas fa-table"></i>  Logs</a>
			  	</li>
			  	<li class="nav-item ">
			    	<a class="nav-link" data-toggle="tab" href="#ra_changelog"><i class="fas fa-code"></i>  Changelog</a>
			  	</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="tab-content col">
			<div class="tab-pane active" id="ra_dash" role="tabpanel">
			  	<?php loadSubTemplate('ra_dashboard'); ?>
			</div>
			<div class="tab-pane" id="ra_reports" role="tabpanel">
			  	<?php loadSubTemplate('ra_reports'); ?>
			</div>
			<div class="tab-pane" id="ra_controls" role="tabpanel">
			  	<?php loadSubTemplate('ra_controls'); ?>
			</div>
			<div class="tab-pane" id="ra_logs" role="tabpanel">
			  	<?php loadSubTemplate('ra_logs'); ?>
			</div>
			<div class="tab-pane" id="ra_changelog" role="tabpanel">
			  	<?php loadSubTemplate('ra_changelog'); ?>
			</div>
		</div>
	</div>
</div>

<?php
	loadSubTemplate(['css','js/js','js/charts','js/datatables']);
?>