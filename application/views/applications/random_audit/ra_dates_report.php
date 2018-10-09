<div class="row">
	<div class="col-4">
		<label><i class="fas fa-calendar"></i> Choose a Date Range</label>
		<div class="input-group">
			<input type="text" class="form-control report_range text-center form-control-sm"/>
			<div class="input-group-append">
				<button id="generate" type="button" class="btn btn-sm btn-secondary"> Generate Report <i class="fas fa-search"></i></button>
			</div>
		</div>
	</div>
	<div class="col-8">
	</div>
</div>
<div class="row">
	<div class="col">
		<table id="dates_report" class="table table-sm table-bordered table-hover text-center">
			<thead>
				<tr class="thead-dark">
					<th>Date</th>
					<th>Counted</th>
					<th>Generated</th>
					<th>Error %</th>
				</tr>
			</thead>
		</table>
	</div>
</div>