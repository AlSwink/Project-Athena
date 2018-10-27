<div class="row mt-2">	
	<div class="col">
		<div class="row">
			<div class="col-lg-2">
				<div class="card text-white bg-info">
					<div class="card-header">
						<i class="fas fa-cog"></i> E-Roster Settings
					</div>
					<div class="card-body">
						<p class="card-text">Please select a setting below.</p>	 
					</div>
						<ul class="list-group list-group-flush-nav">
							<li class="nav-item">
								<a href="#positions_tab" class="nav-link list-group-item list-group-item-action list-group-item-secondary bbr-0" data-toggle="pill">Positions</a>
							</li>
							<li class="nav-item">
								<a href="#zones_tab" class="nav-link list-group-item list-group-item-action list-group-item-secondary bbr-0" data-toggle="pill">Zones</a>
							</li>
							<li class="nav-item">
								<a href="#department_tab" class="nav-link list-group-item list-group-item-action list-group-item-secondary bbr-0" data-toggle="pill">Departments</a>
							</li>
							<li class="nav-item">
								<a href="#shift_tab" class="nav-link list-group-item list-group-item-action list-group-item-secondary bbr-0" data-toggle="pill">Shifts</a>
							</li>
							<li class="nav-item">
								<a href="#staffing_tab" class="nav-link list-group-item list-group-item-action list-group-item-secondary bbr-0" data-toggle="pill">Staffing</a>
							</li>
						</ul>
					
				</div>
			</div>	
			<div class="col-lg-10">
				<div class="tab-content">
					<div class="tab-pane active" id="positions_tab">
						<div class="row">
							<div class="col-lg-5">
								<h5>New Position</h5>
								<hr>
								<form id="add_position" action="<?= site_url('e_roster/add_setting'); ?>" method="POST">
									<input name="type" type="hidden" value="positions">
									<input name="setting" type="text" class="form-control input-sm">
								</form>
								<br>
								<button type="button" class="btn btn-sm btn-success setting_submit">Add</button>
								
							</div>
							<div class="col-lg-7">
								<input id="qspos" type="text" class="form-control input-sm" placeholder="Quicksearch">
								<hr>
								<div style="max-height:55%; overflow: auto">
									<table id="pos_table" class="table table-condensed table-bordered table-hover settings_table">
										<thead>
											<tr class="info">
												<th>Position</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="zones_tab">
						<div class="row">
							<div class="col-lg-5">
								<h5>New Zones</h5>
								<hr>
								<form id="add_zone" action="<?= site_url('e_roster/add_setting'); ?>" method="POST">
								<input name="type" type="hidden" value="zones">
								<input name="setting" type="text" class="form-control input-sm">
								<br>
								</form>
								<button type="button" class="btn btn-sm btn-success setting_submit">Add</button>
							</div>
							<div class="col-lg-7">
								<input id="qspos" type="text" class="form-control input-sm" placeholder="Quicksearch">
								<hr>
								<div style="max-height:55%; overflow: auto">
									<table id="zone_table" class="table table-condensed table-bordered table-hover settings_table">
										<thead>
											<tr class="info">
												<th>Zone</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="department_tab">
						<div class="row">
							<div class="col-lg-5">
								<h5>New Departments</h5>
								<hr>
								<form id="add_department" action="<?= site_url('e_roster/add_setting'); ?>" method="POST">
								<input name="type" type="hidden" value="departments">
								<input name="setting" type="text" class="form-control input-sm">
								</form>
								<br>
								<button type="button" class="btn btn-sm btn-success setting_submit">Add</button>
							</div>
							<div class="col-lg-7">
								<input id="qspos" type="text" class="form-control input-sm" placeholder="Quicksearch">
								<hr>
								<div style="max-height:55%; overflow: auto">
									<table id="dept_table" class="table table-condensed table-bordered table-hover settings_table">
										<thead>
											<tr class="info">
												<th>Department</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="shift_tab">
						<div class="row">
							<div class="col-lg-5">
								<h5>New Shift</h5>
								<hr>
								<form id="add_shift" action="<?= site_url('e_roster/add_setting'); ?>" method="POST">
								<input name="type" type="hidden" value="shifts">
								<input name="setting" type="text" class="form-control input-sm">
								</form>
								<br>
								<button type="button" class="btn btn-sm btn-success setting_submit">Add</button>
							</div>
							<div class="col-lg-7">
								<input id="qspos" type="text" class="form-control input-sm" placeholder="Quicksearch">
								<hr>
								<div style="max-height:55%; overflow: auto">
									<table id="shift_table" class="table table-condensed table-bordered table-hover settings_table">
										<thead>
											<tr class="info">
												<th>Department</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="staffing_tab">
						<div class="row">
							<div class="col-lg-5">
								<h5>Staffing</h5>
								<hr>
								<!--<input type="text" class="form-control input-sm">
								<br>
								<button type="button" class="btn btn-sm btn-success">Add</button>
							--></div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>

</div>