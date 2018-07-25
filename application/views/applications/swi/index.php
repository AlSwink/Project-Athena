<div id="assign_print" class="d-none d-print-block"></div>
<div class="container-fluid d-print-none">
	<?php $this->load->view('applications/container_control'); ?>
	<div class="row mt-2">
		<div class="col">
			<ul class="nav nav-tabs nav-fill">
				<li class="nav-item">
			    	<a class="nav-link active" data-toggle="tab" href="#swi_dash"><i class="fas fa-tachometer-alt"></i>  Dashboard</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#swi_input"><i class="fas fa-pen-square"></i>  Input SWI</a>
			  	</li>
				<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#swi_docs"><i class="fas fa-file"></i>  SWI Documents</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#swi_requests"><i class="fas fa-tasks"></i>  Requests</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#swi_reports"><i class="fas fa-chart-line"></i>  Reporting</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#swi_documentation"><i class="fas fa-book"></i>  Documentation</a>
			  	</li>
			  	<li class="nav-item">
			    	<a class="nav-link" data-toggle="tab" href="#swi_logs"><i class="fas fa-file-code"></i>  Logs</a>
			  	</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="tab-content col">
			<div class="tab-pane active" id="swi_dash" role="tabpanel">
			  	<?php $this->load->view($page_dir.'/swi_dashboard'); ?>
			</div>
			<div class="tab-pane" id="swi_input" role="tabpanel">
			  	<?php $this->load->view($page_dir.'/swi_input'); ?>
			</div>
			<div class="tab-pane " id="swi_docs" role="tabpanel">
			  	<?php $this->load->view($page_dir.'/swi_docs'); ?>
			</div>
			<div class="tab-pane " id="swi_requests" role="tabpanel">
			  	
			</div>
			<div class="tab-pane " id="swi_reports" role="tabpanel">
			  	
			</div>
			<div class="tab-pane" id="swi_documentation" role="tabpanel">
			  	<?php $this->load->view($page_dir.'/swi_documentation'); ?>
			</div>
			<div class="tab-pane " id="swi_logs" role="tabpanel">
			  	
			</div>
		</div>
	</div>
</div>

<?php 
$this->load->view($page_dir.'/modals');
$this->load->view($page_dir.'/css');
$this->load->view($page_dir.'/js'); 
?>