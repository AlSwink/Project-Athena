<div class="row mt-3">
	<div class="col-lg-4 col-sm-12">
		<input id="search_employees" type="text" class="form-control form-control-sm text-input" placeholder="Search Employees">
	</div>
	<div class="col-lg-8 col-sm-12 text-right">
		<div class="btn-group">
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#add_employee"><i class="fas fa-plus-square"></i></button>
			<button id="dl_excel" type="button" class="btn btn-success"><i class="fas fa-file-excel"></i></button>
			<button id="print" type="button" class="btn btn-secondary"><i class="fas fa-print"></i></button>
		</div>
	</div>
</div>
<div class=row mt-2">
	<div class="col-lg-12 col-sm-12">
		<div class="card shadow">
			<div class="card-body">
				<table class="table table-sm table-bordered table-hover emp_table">
					<thead>
						<tr class="thead-dark">
							<th>Employee ID</th>
							<th>Name</th>
							<th>Staffing</th>
							<th>Department - Zone</th>
							<th>Position</th>
							<th>Shift</th>
							<th>Supervisor</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>