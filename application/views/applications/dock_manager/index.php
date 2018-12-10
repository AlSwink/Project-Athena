<div class="container-fluid">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<div class="row">
		<div class="col">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_dock">Add Dock <i class="fas fa-plus"></i></button>
			<table id="dock_table" class="table table-sm table-bordered table-hover text-center">
				<thead>
					<tr class="thead-dark">
						<th>Dock Number</th>
						<th>Status</th>
						<th>Type</th>
						<th>Building</th>
						<th>Expecting Carrier? (Y/N)</th>
						<th>Notes</th>
						<th>Last Action by</th>
				</thead>
			</table>
		</div>
	</div>
</div>

<?= loadSubTemplate(['modals','js']); ?>