<div class="row mt-3">
	<div class="col-lg-3 col-sm-12">
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
			    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary" data-toggle="modal" data-target="#change_dataset"><i class="fas fa-exchange-alt"></i> Change Dataset</a>
			</ul>
		</div>
	</div>
	<div class="col-lg-9 col-sm-12">
		<div class="card shadow">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-sm-12 text-center">
						<h5 class="display-5"><span class="my-display"><?= date('F Y'); ?></span> Overview</h5>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-4 col-sm-12">
						<canvas id="days_prog" height="200px"></canvas>
					</div>
					<div class="col-lg-4 col-sm-12">
						<canvas id="doc_prog" height="235px"></canvas>
					</div>
					<div class="col-lg-4 col-sm-12">
						<canvas id="standard_acc" height="200px"></canvas>
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
					<div class="col-lg-6 col-sm-12">
						<h6>Recently Audited</h6>
						<div class="table-responsive">
							<table id="recently_audited_table" class="table table-sm table-bordered table-hover">
								<?php foreach($totals['recents'] as $recent){ ?>
									<tr class="table-<?= $recent['color']; ?> rdtablemenu">
										<td class="d-none"><?= $recent['assignment_id']; ?></td>
										<td><?= $recent['doc_id']; ?></td>
										<td><?= $recent['doc_name']; ?></td>
										<td><?= $recent['department']; ?></td>
										<td><?= $recent['status']; ?></td>
										<td><span class='rdempdetails' data-empid='<?= $recent['emp_id'];?>'><?= $recent['completed_by']; ?></span></td>
										<td><?= $recent['completed_on']; ?></td>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
					<div class="col-lg-6 col-sm-12">
						<h6>Progress by Department</h6>
						<table id="department_progress_table" class="table table-sm table-bordered table-hover rounded">
							<?php foreach($totals['departments'] as $key => $dept){ ?>
								<tr class="dashrow dashrow_<?= $key; ?> dept_progress" data-deptid="<?= $dept['dept']; ?>" data-dept="<?= $key; ?>">
									<td><?= $key; ?></td>
									<td class="w-50">
										<div class="progress">
										  <div class="progress-bar bg-<?= $dept['color']; ?>" role="progressbar" style="width: <?= $dept['progress']; ?>"><?= $dept['progress']; ?></div>
										</div>
									</td>
								</tr>
							<?php } ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>