<div class="row mt-3">
	<div class="col-3">
		<div class="card text-white bg-info">
		  <div class="card-header">
		  	<i class="fas fa-chart-bar"></i> Random Audit Reports
		  </div>
		  <div class="card-body">
				<p class="card-text">Use this panel to change report types.</p>	    
		  </div>
			<ul class="list-group list-group-flush-nav">
		  		<li class="nav-item">
		  			<a href="#ra_employees" class="nav-link list-group-item list-group-item-action list-group-item-secondary bbr-0" data-toggle="pill">By Employees</a>
		  		</li>
		  		<li class="nav-item">
			    	<a href="#ra_dates" class="nav-link list-group-item list-group-item-action list-group-item-secondary" data-toggle="pill">By Dates</a>
			    </li>
			</ul>
		</div>
	</div>
	<div class="col-9">
		<div class="tab-content">
			<div class="tab-pane active" id="ra_employees">
				<?= loadSubTemplate('ra_employee_report',array('employees'=>$employees)); ?>
			</div>
			<div class="tab-pane " id="ra_dates">
				<?= loadSubTemplate('ra_dates_report'); ?>
			</div>
		</div>			
	</div>
</div>