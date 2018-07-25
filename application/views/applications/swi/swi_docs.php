<div class="row mt-3">
	<div class="col-4">
		<input id="search_swi" type="text" class="form-control form-control-sm text-input" placeholder="Search SWI document">
	</div>
	<div class="col-8 text-right">
		<div class="btn-group">
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#add_swi_document"><i class="fas fa-plus-square"></i></button>
			<button id="edit" type="button" data-toggle="modal" data-target="#edit_swi_document" class="btn btn-info" disabled><i class="fas fa-edit"></i></button>
			<button id="delete" type="button" data-toggle="modal" data-target="#delete_swi_document" class="btn btn-danger" disabled><i class="fas fa-trash"></i></button>
			<button id="dl_excel" type="button" class="btn btn-success"><i class="fas fa-file-excel"></i></button>
			<button id="print" type="button" class="btn btn-secondary"><i class="fas fa-print"></i></button>
		</div>
	</div>
</div>
<div class="row mt-2">
	<div class="col">
		<div class="card shadow">
			<div class="card-body">
				<table class="table table-sm table-bordered table-hover dtable">
					<thead>
						<tr class="thead-dark">
							<th>Doc #</th>
							<th>Doc Name</th>
							<th>Department</th>
							<th>Processes</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
