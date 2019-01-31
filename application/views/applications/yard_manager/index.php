<div class="container-fluid">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<div class="row">
		<div class="col">
			<h4 class="display-4"><i class="fas fa-truck"></i> Accept Trailer</h4>
		</div>
		<div class="col">
			<div class="row text-right">
				<div class="col">
					<img id="carrier_logo" src="<?= base_url('assets/img/carrier_logos/xpo.png'); ?>" height="60px" />
				</div>
			</div>
		</div>
	</div>
	<div class="tab-content">
		<div id="tab1" class="tab-pane active">
			<div class="row">
				<?= loadSubTemplate('step_1'); ?>		
			</div>
		</div>
		<div id="tab2" class="tab-pane">
			<div class="row">
				<?= loadSubTemplate('step_2'); ?>		
			</div>
		</div>
	</div>
	<ul class="nav nav-tabs d-none" id="tabs" role="tablist">
	  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab1" >S1</a></li>
	  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab2" >S2</a></li>
	</ul>
</div>

<?= loadSubTemplate(['js/index']); ?>