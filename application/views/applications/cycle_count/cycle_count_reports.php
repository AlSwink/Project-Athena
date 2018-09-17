<div class="row mt-3">
	<div class="col-3">
		<div class="card text-white bg-info">
		  <div class="card-header">
		  	<i class="fas fa-chart-bar"></i> Cycle Count Reports
		  </div>
		  <div class="card-body">
				<p class="card-text">Use this panel to change report types.</p>	    
		  </div>
		  	<ul class="list-group list-group-flush">
		  		<a href="#general" class="list-group-item list-group-item-action list-group-item-secondary" data-toggle="tab"> Today's Report</a>
			</ul>
		</div>
	</div>
	<div class="col-9">
		<div class="tab-content">
			<div class="tab-pane active" id="cyc_today">
				<?= loadSubTemplate('cycle_count_today'); ?>
			</div>
		</div>
	</div>
</div>