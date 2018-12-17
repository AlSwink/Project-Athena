<div class="container-fluid">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<div class="row">
		<div class="col">
			<ul class="nav nav-tabs nav-fill dashboard_tabs">
				<li class="nav-item  ">
			    	<a class="nav-link" data-toggle="tab" href="#replen_dash"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
			  	</li>
			  	<li class="nav-item  ">
			    	<a class="nav-link active" data-toggle="tab" href="#replen_controls"><i class="fas fa-dolly"></i> Replenish Wave</a>
			  	</li>
			  	<li class="nav-item  ">
			    	<a class="nav-link" data-toggle="tab" href="#replen_logs"><i class="fas fa-table"></i> Logs</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#replen_changelog"><i class="fas fa-file-code"></i> Changelog</a>
			  	</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="tab-content col">
			<div class="tab-pane" id="replen_dash" role="tabpanel">
			  	<?php loadSubTemplate('replenisher_dashboard'); ?>
			</div>
			<div class="tab-pane active" id="replen_controls" role="tabpanel">
			  	<?php loadSubTemplate('replenisher_controls'); ?>
			</div>
			<div class="tab-pane " id="replen_logs" role="tabpanel">
			  	<?php loadSubTemplate('replenisher_logs'); ?>
			</div>
			<div class="tab-pane " id="replen_changelog" role="tabpanel">
			  	<?php loadSubTemplate('replenisher_changelog'); ?>
			</div>
		</div>
	</div>
</div>

<?php loadSubTemplate(['modals','js','css']); ?>