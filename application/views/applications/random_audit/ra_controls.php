<div class="row mt-3">
	<div class="col-3">
		<div class="card text-white bg-info">
		  <div class="card-header">
		  	<i class="fas fa-chart-bar"></i> Random Audit Controls
		  </div>
		  <div class="card-body">
				<p class="card-text">Use this panel to control Random Audits.</p>	    
		  </div>
			<ul class="list-group list-group-flush-nav">
		  		<li class="nav-item">
		  			<a href="#ra_location_list" class="nav-link list-group-item list-group-item-action list-group-item-secondary bbr-0" data-toggle="pill">Location List</a>
		  		</li>
		  		<li class="nav-item">
		  			<a href="#ra_generate_locations" class="nav-link list-group-item list-group-item-action list-group-item-secondary bbr-0" data-toggle="pill">Generate Locations</a>
		  		</li>
		  		<li class="nav-item">
			    	<a href="#ra_settings" class="nav-link list-group-item list-group-item-action list-group-item-secondary" data-toggle="pill">Settings</a>
			    </li>
			</ul>
		</div>
	</div>
	<div class="col-9">
		<div class="tab-content">
			<div class="tab-pane active" id="ra_location_list">
				<?= loadSubTemplate('ra_location_list'); ?>
			</div>
			<div class="tab-pane" id="ra_generate_locations">
				<?= loadSubTemplate('ra_generate_locations'); ?>
			</div>
			<div class="tab-pane " id="ra_settings">
				<?= loadSubTemplate('ra_settings'); ?>
			</div>
		</div>
	</div>
</div>