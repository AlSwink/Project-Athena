<div class="container-fluid">
	<div class="row mt-3">
		<div class="col-6">
			<div class="row">
				<div class="col">
				</div>
			</div>
			<div class="row">
				<div class="col-6">
					<input id="search_reported_doc" type="text" class="form-control form-control-sm text-input" placeholder="Quicksearch">
				</div>
				<div class="col-6">
				</div>
				<div class="col">
					<table id="reported_table" class="table table-sm table-bordered table-hover">
						<thead>
							<tr class="bg-danger">
								<th>Document Name</th>
								<th>Process</th>
								<th>Reported on</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div id="info_card" class="card shadow d-none">
				<div class="card-body">
					<div class="form-row mb-3">
						<div class="col">
							<h5 class="mb-0 doc_num"></h5>
							<small class="ulimit text-muted">Document Number</small>
						</div>
						<div class="col">
							<h5 class="mb-0 doc_name"></h5>
							<small class="ulimit text-muted">Document Name</small>
						</div>
					</div>
					<div class="form-row">
						<div class="col">
							<h5 class="mb-0 e_audited"></h5>
							<small class="ulimit text-muted">Audited</small>
						</div>
						<div class="col">
							<h5 class="mb-0 e_auditor"></h5>
							<small class="ulimit text-muted">Auditor</small>
						</div>
						<div class="col">
							<h5 class="mb-0 doc_reported"></h5>
							<small class="ulimit text-muted">Reported</small>
						</div>
						<div class="col">
							<h5 class="mb-0 a_id"></h5>
							<small class="ulimit text-muted">Assignment ID</small>
						</div>
					</div>
					<hr>
					<form id="resolution_form" action="<?= site_url('swi/save_resolution'); ?>" method="POST">
					<div class="form-row mb-5">
						<div class="col">
							<h5 class="rprocess text-danger"></h5>
							<small class="ulimit comments"></small>
						</div>
					</div>
					<hr>
					<div class="form-row">
						<div class="col">
							<label>Countermeasures taken</label>
							<textarea class="form-control mb-2" name="resolution" rows="5"></textarea>
							<button type="button" id="resolution_submit" class="btn btn-sm w-100 btn-primary">Save <i class="fas fa-check"></i></button>
							<input type="hidden" name="adj_id">
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	loadSubTemplate(['js/resolution']); 
?>