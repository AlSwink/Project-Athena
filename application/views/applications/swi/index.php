<div id="assign_print" class="d-none d-print-block"></div>
<div class="container-fluid d-print-none">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<div class="row mt-2">
		<div class="col">
			<ul class="nav nav-tabs nav-fill dashboard_tabs">
				<li class="nav-item  ">
			    	<a class="nav-link active" data-toggle="tab" href="#swi_dash"><i class="fas fa-tachometer-alt"></i>  Dashboard</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#swi_input"><i class="fas fa-pen-square"></i>  Input SWI</a>
			  	</li>
				<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#swi_docs"><i class="fas fa-file"></i>  SWI Documents</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#swi_requests"><i class="fas fa-tasks"></i>  Requests <span class="badge badge-danger">5</span></a>
			  	</li>
			  	<li class="nav-item ">
			    	<a class="nav-link" data-toggle="tab" href="#swi_reports"><i class="fas fa-chart-line"></i>  Reporting</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#swi_settings"><i class="fas fa-cog"></i>  Settings</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#swi_documentation"><i class="fas fa-book"></i>  Documentation</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#swi_logs"><i class="fas fa-file-code"></i> Changelog</a>
			  	</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="tab-content col">
			<div class="tab-pane active" id="swi_dash" role="tabpanel">
			  	<?php loadSubTemplate('swi_dashboard'); ?>
			</div>
			<div class="tab-pane" id="swi_input" role="tabpanel">
			  	<?php loadSubTemplate('swi_input'); ?>
			</div>
			<div class="tab-pane " id="swi_docs" role="tabpanel">
			  	<?php loadSubTemplate('swi_docs'); ?>
			</div>
			<div class="tab-pane " id="swi_requests" role="tabpanel">
			  	<?php loadSubTemplate('swi_requests'); ?>
			</div>
			<div class="tab-pane " id="swi_reports" role="tabpanel">
			  	<?php loadSubTemplate('swi_reports'); ?>
			</div>
			<div class="tab-pane " id="swi_settings" role="tabpanel">
			  	<?php loadSubTemplate('swi_settings'); ?>
			</div>
			<div class="tab-pane" id="swi_documentation" role="tabpanel">
			  	<?php loadSubTemplate('swi_documentation'); ?>
			</div>
			<div class="tab-pane " id="swi_logs" role="tabpanel">
			  	<?php loadSubTemplate('swi_changelog'); ?>
			</div>
		</div>
	</div>
</div>
<?php loadSubTemplate(['modals','css','js']); ?>