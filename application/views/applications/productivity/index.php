<div class="container-fluid">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<div class="row">
		<div class="col">
			<h4 class="display-4"><i class="fas fa-chart-bar"></i> <?= $title; ?> Productivity Admin</h4>
		</div>
		<div class="col text-right">
			<h4 class="display-4"><?= date('F d, Y'); ?></h4>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col">
			<ul class="nav nav-tabs">
				<li class="nav-item ">
			    	<a class="nav-link active" data-toggle="tab" href="#prod_hour_admin"><i class="fas fa-tachometer-alt"></i> General Tracker</a>
			  	</li>
			  	<li class="nav-item ">
			    	<a class="nav-link" data-toggle="tab" href="#prod_individual_admin"><i class="fas fa-user"></i> Individual Tracker</a>
			  	</li>
			  	<li class="nav-item ">
			    	<a class="nav-link" data-toggle="tab" href="#changelog"><i class="fas fa-code"></i> Changelog</a>
			  	</li>
			</ul>
		</div>
	</div>
	<div class="row mt-3">
		<div class="tab-content col">
			<div class="tab-pane active" id="prod_hour_admin" role="tabpanel">
				<?= loadSubTemplate('productivity_admin'); ?>
			</div>
			<div class="tab-pane" id="prod_individual_admin" role="tabpanel">
				<div id="individual">
				</div>
			</div>
			<div class="tab-pane" id="changelog" role="tabpanel">
				<?= loadSubTemplate('changelog'); ?>
			</div>
		</div>
	</div>
</div>

<?= loadSubTemplate(['modals','js','css']); ?>