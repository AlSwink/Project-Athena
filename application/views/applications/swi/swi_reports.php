<div class="row mt-3">
	<div class="col-lg-3 col-sm-12">
		<div class="card text-white bg-info">
			<div class="card-header">
	  			<i class="fas fa-bars"></i> Report Types
	  		</div>
		  	<div class="card-body">
				<p class="card-text">Please select a report type below.</p>	    
		  	</div>
			<ul class="list-group list-group-flush nav">
				<li class="nav-item">
		  			<a href="#report_documents" class="nav-link bbr-0 list-group-item list-group-item-action list-group-item-secondary" data-toggle="pill">All Documents</a>
		  		</li>
		  		<li class="nav-item">
		  			<a href="#report_document_reported" class="nav-link bbr-0 list-group-item list-group-item-action list-group-item-secondary" data-toggle="pill">Reported Documents</a>
		  		</li>
		  		<li class="nav-item">
		  			<a href="#report_employees" class="nav-link bbr-0 list-group-item list-group-item-action list-group-item-secondary" data-toggle="pill">Employees Progress</a>
		  		</li>
		  		<li class="nav-item">
		  			<a href="#" class="nav-link list-group-item list-group-item-action list-group-item-secondary" data-toggle="modal" data-target="#change_dataset">Change Dataset</a>
		  		</li>
			</ul>
		</div>
	</div>
	<div class="col-lg-9 col-sm-12">
		<div class="tab-content">
			<div class="tab-pane " id="report_documents">
				<?php loadSubTemplate('swi_reports_documents'); ?>
			</div>
			<div class="tab-pane show active" id="report_document_reported">
				<?php loadSubTemplate('swi_reports_document_reported'); ?>
			</div>
			<div class="tab-pane" id="report_employees">
				<?php loadSubTemplate('swi_reports_employees'); ?>
			</div>
		</div>
	</div>
</div>