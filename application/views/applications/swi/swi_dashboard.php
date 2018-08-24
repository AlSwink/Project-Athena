<div class="row mt-3">
	<div class="col-3">
		<div class="card text-white bg-info">
		  <div class="card-header">
		  	<i class="fas fa-wrench"></i> Quick Controls
		  </div>
		  <div class="card-body">
    			<p class="card-text">Use this panel to quickly access SWI tools and functions.</p>	    
		  </div>
		  	<ul class="list-group list-group-flush">
			    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary" data-toggle="modal" data-target="#assignment_printer"> <i class="fas fa-print"></i> Print assignments</a>
			    <a href="#assign_swi_document" class="list-group-item list-group-item-action list-group-item-secondary" data-toggle="modal" data-target="#assign_swi_document"><i class="fas fa-user-tag"></i> Assign a document</a>
			    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary" data-toggle="modal" data-target="#add_swi_document"><i class="fas fa-plus-square"></i> New document</a>
			    <!--a href="#" class="list-group-item list-group-item-action list-group-item-secondary"><i class="fas fa-columns"></i> Compare Data</a>
			    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary"><i class="fas fa-chart-area"></i> Create Report</a>
			    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary"><i class="fas fa-download"></i> Download Report</a>
			    <a href="#" class="list-group-item list-group-item-action list-group-item-info"><i class="fas fa-cog"></i> SWI Settings</a-->
			</ul>
		</div>
	</div>
	<div class="col-9">
		<div class="card shadow">
			<div class="card-body">
				<div class="row">
					<div class="col text-center">
						<h4 class="display-4"><?= date('F Y'); ?> Overview</h4>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<canvas id="days_prog" height="250px" style="position:absolute;bottom:0"></canvas>
					</div>
					<div class="col">
						<canvas id="doc_prog" height="335px"></canvas>
					</div>
					<div class="col">
						<canvas id="standard_acc" height="250px" style="position:absolute;bottom:0"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row mt-2">
	<div class="col">
		<div class="card shadow">
			<div class="card-body">
				<div class="row">
					<div class="col text-center">
						<h6>vs Last month <small>(dummy)</small></h6>
					</div>
				</div>
				<div class="row">
					<div class="col text-center">
						<h5 class="text-success"><i class="fas fa-caret-up fa-xs"></i>12</h5>
						<small>Documents</small>
					</div>
					<div class="col text-center">
						<h5 class="text-success"><i class="fas fa-caret-up"></i>20</h5>
						<small>Processes</small>
					</div>
					<div class="col text-center">
						<h5 class="text-danger"><i class="fas fa-caret-down"></i>10</h5>
						<small>Associates</small>
					</div>
					<div class="col text-center">
						<h5>6</h5>
						<small>Completed per Day</small>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>