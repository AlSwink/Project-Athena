<div class="row">
	<div class="col-lg-5 col-sm-8">
		<label><i class="fas fa-calendar"></i> Choose a Date Range</label>
		<div class="input-group">
			<input type="text" class="form-control report_range text-center form-control-sm"/>
			<input type="hidden" name="report_from">
			<input type="hidden" name="report_to">
			<div class="input-group-append">
				<button id="generate" type="button" class="btn btn-sm btn-secondary"> Generate Report <i class="fas fa-search"></i></button>
			</div>
		</div>
	</div>
</div>
<div class="row mt-2">
	<div class="col">
		<ul class="nav nav-tabs">
			<li class="nav-item "><a class="nav-link active" data-toggle="tab" href="#custom_details"><i class="fas fa-list-alt"></i> Details</a></li>
			<li class="nav-item "><a class="nav-link" data-toggle="tab" href="#custom_charts"><i class="fas fa-chart-bar"></i> Charts</a></li>
			<li class="nav-item "><a class="nav-link" data-toggle="tab" href="#custom_logs"><i class="fas fa-table"></i> Logs</a></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="tab-content col">
		<div class="tab-pane active" id="custom_details" role="tabpanel">
			<?= loadSubTemplate('cycle_count_custom_detail'); ?>
		</div>
	</div>
</div>