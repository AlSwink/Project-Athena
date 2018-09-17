<div class="row mt-3">
	<div class="col-3">
		<div class="card text-white bg-info">
		  <div class="card-header">
		  	<i class="fas fa-wrench"></i> Quick Controls
		  </div>
		  <div class="card-body">
				<p class="card-text">Use this panel to quickly access Cycle Count tools and functions.</p>	    
		  </div>
		  	<ul class="list-group list-group-flush-nav">
		  		<li class="nav-item">
		  			<a href="#round_controls" class="nav-link bbr-0 list-group-item list-group-item-action list-group-item-secondary" data-toggle="pill"> <i class="fas fa-redo-alt"></i> Basic Controls</a>
		  		</li>
		  		<li class="nav-item">
			    	<a href="#generate_locations" class="nav-link list-group-item list-group-item-action list-group-item-secondary" data-toggle="pill"> <i class="fas fa-plus-circle"></i> Generate Locations</a>
			    </li>
			    <!--a href="#" class="list-group-item list-group-item-action list-group-item-secondary" data-toggle="modal" data-target="#"> <i class="fas fa-unlock-alt"></i> Release Locations</a>
			    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary" data-toggle="modal" data-target="#"><i class="fas fa-exchange-alt"></i> Change Dataset</a-->
			</ul>
		</div>
	</div>
	<div class="col-9">
		<div class="tab-content">
			<div class="tab-pane " id="round_controls">
				<?= loadSubTemplate('cycle_count_round_control'); ?>
			</div>
			<div class="tab-pane active" id="generate_locations">
				<?= loadSubTemplate('cycle_count_generate_location'); ?>
			</div>
		</div>
	</div>
</div>