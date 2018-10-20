<div class="row mt-3">
	<div class="col-3">
		<div class="card text-white bg-info">
		  <div class="card-header">
		  	<i class="fas fa-chart-bar"></i> E-Roster Reports
		  </div>
		  <div class="card-body">
				<p class="card-text">Please select a report type below.</p>	    
		  </div>
			<ul class="list-group list-group-flush-nav">
		  		<li class="nav-item">
		  			<a href="#wms_report" class="nav-link list-group-item list-group-item-action list-group-item-secondary bbr-0" data-toggle="pill">Employees not in WMS</a>
		  		</li>
		  		<li class="nav-item">
			    	<a href="#dept_report" class="nav-link list-group-item list-group-item-action list-group-item-secondary" data-toggle="pill">Employees per department</a>
			    </li>
			</ul>
		</div>
	</div>
	<div class="col-lg-9 col-sm-12">
		<div class="tab-content">
			<div class="tab-pane" id="wms_report">
				<?php loadSubTemplate('eroster_reports_wms');?>
			</div>
			<div class="tab-pane show active" id="dept_report">
				<?php loadSubTemplate('eroster_reports_dept');?>
			</div>
		</div>
	</div>
</div>