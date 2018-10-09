<div class="container-fluid">
	<?=loadInclude('app_container_control',$this->app_info); ?>
	<div class="row mt-2">
		<div class="col col-sm-12">
			<ul class="nav nav-tabs nav-fill dashboard_tabs">
				<li class="nav-item">
					<a class="nav-link active" href="#eroster_dashboard" data-toggle="tab">Dashboard</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="#eroster_employees" data-toggle="tab">Employees</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#eroster_reports" data-toggle="tab">Reports</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#eroster_logs" data-toggle="tab">Logs</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#eroster_settings" data-toggle="tab">Settings</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#eroster_changelog" data-toggle="tab">Changelog</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="tab-content col">
			<div class="tab-pane active" id="eroster_dashboard" role="tabpanel">
				<?php loadSubTemplate('eroster_dashboard');?>
			</div>
			<div class="tab-pane " id="eroster_employees" role="tabpanel">
				<?php loadSubTemplate('eroster_employees');?>
			</div>
			<div class="tab-pane" id="eroster_reports" role="tabpanel">
				<?php loadSubTemplate('eroster_reports');?>
			</div>
			<div class="tab-pane" id="eroster_logs" role="tabpanel">
				<?php //loadSubTemplate('eroster_logs');?>
			</div>
			<div class="tab-pane" id="eroster_settings" role="tabpanel">
				<?php //loadSubTemplate('eroster_settings');?>
			</div>
			<div class="tab-pane" id="eroster_changelog" role="tabpanel">
				<?php loadSubTemplate('eroster_changelog');?>
			</div>
		</div>
	</div>
</div>
<?=loadSubTemplate(['css','modals','js']);?>