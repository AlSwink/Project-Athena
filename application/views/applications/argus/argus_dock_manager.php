<div class="container-fluid">
	<?= loadInclude('app_container_control',$this->app_info); ?>
	<div class="row">
		<div class="col">
			<table id="dock_table" class="table table-sm table-bordered table-hover">
				<thead>
					<tr class="thead-dark">
						<th>Dock Number</th>
						<th>Type</th>
						<th>Building</th>
						<th>Expecting Carrier? (Y/N)</th>
						<th>Status</th>
						<th>Notes</th>
						<th>Last Action by</th>
				</thead>
			</table>
		</div>
	</div>
</div>

<?php loadSubTemplate(['js/dock_manager']); ?>