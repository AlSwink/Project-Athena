<div class="row mt-3">
	<div class="col-3">
		<div class="card text-white bg-info">
		  <div class="card-header">
		  	<i class="fas fa-chart-bar"></i> Cycle Count Reports
		  </div>
		  <div class="card-body">
				<p class="card-text">Use this panel to change report types.</p>	    
		  </div>
			<ul class="list-group list-group-flush-nav">
		  		<li class="nav-item">
		  			<a href="#today_report" class="nav-link list-group-item list-group-item-action list-group-item-secondary bbr-0" data-toggle="pill">Today's Report</a>
		  		</li>
		  		<li class="nav-item">
			    	<a href="#generate_report" class="nav-link list-group-item list-group-item-action list-group-item-secondary" data-toggle="pill">Generate Report</a>
			    </li>
			</ul>
		</div>
	</div>
	<div class="col-9">
		<div class="tab-content">
			<div class="tab-pane active" id="today_report">
				<?= loadSubTemplate('cycle_count_today'); ?>
			</div>
			<div class="tab-pane " id="generate_report">
				<?= loadSubTemplate('cycle_count_generate_report'); ?>
			</div>
		</div>
	</div>
</div>