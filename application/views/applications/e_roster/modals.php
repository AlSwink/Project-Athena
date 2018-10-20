<div class="modal fade" id="add_employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add new employee</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="add_new_employee" action="<?= site_url('e_roster/add_employee'); ?>" method="POST">
				<div class="container-fluid">
					<div class="row">
						<div class="col-4">
							<label>Employee ID</label>
							<input type="text" class="form-control form-control-sm text-input" name="emp_id" autocomplete="off">
							<label>XPO Email Address</label>
							<input type="text" class="form-control form-control-sm text-input" name="emp_email" required>
						</div>
						<div class="col-4">
							<label>WMS User Group</label>
							<select name="wms_usrgrp" required class="form-control form-control-sm">
							<?php foreach($user_groups as $user_group){ ?>
								<option value="<?=$user_group->user_grp;?>"><?=$user_group->user_grp;?></option>
							<?php } ?>
							</select>
							<label>Parking Tag</label>
							<input type="text" class="form-control form-control-sm text-input" name="park_tag">
						</div>
					</div>
					<br/>
					<strong>Personal Information</strong>
					<hr size="1">
					<div class="row">
						<div class="col-4">
							<label>First Name</label>
							<input type="text" class="form-control form-control-sm text-input" name="emp_fname">
						</div>
						<div class="col-4">
							<label>Last Name</label>
							<input type="text" class="form-control form-control-sm text-input" name="emp_lname">
						</div>
						<div class="col-4">
							<label>Date of Birth</label>
							<input type="text" class="form-control form-control-sm text-input" name="emp_dob">
						</div>
					</div>
					<br/>
					<strong>Security Information</strong>
					<hr size="1">
					<div class="row">
						<div class="col-4">
							<label>WMS ID</label>
							<input type="text" class="form-control form-control-sm text-input" name="wms">
						</div>
						<div class="col-4">
							<label>Security Badge</label>
							<input type="text" class="form-control form-control-sm text-input" name="sb">
						</div>
						<div class="col-4">
							<label>Last 4 SSN</label>
							<input type="text" class="form-control form-control-sm text-input" name="ssn" required>
						</div>
					</div>
					<br/>
					<strong>Employment Information</strong>
					<hr size="1">
					<div class="row">
						<div class="col-6">
							<label>Staffing</label>
							<select name="temp_agency" class="form-control form-control-sm">
							<?php foreach($agencies as $agency){ ?>
								<option value="<?= $agency->temp_id;?>"><?= $agency->temp_name;?></option>
							<?php } ?>
							</select>
						</div>
						<div class="col-6">
							<label>Start Date</label>
							<input type="text" class="form-control form-control-sm text-input" name="temp_start">
						</div>
					</div>
					<br/>
					<strong>Job Details</strong>
					<hr size="1">
					<div class="row">
						<div class="col-4">
							<label>Department</label>
							<select name="department" required class="form-control input-sm">
								<?php foreach($departments as $row){ ?>
									<option value="<?php echo $row->dept_id; ?>"><?php echo $row->dept_name; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-4">
							<label>Zone</label>
							<select name="zone" required class="form-control input-sm">
								<?php foreach($zones as $row){ ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->zone; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-4">
							<label>Shift</label>
							<select name="shift" required class="form-control input-sm">
								<?php foreach($shifts as $row){ ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->shift; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-4">
							<label>Primary Role</label>
							<select name="pri_rol" required class="form-control input-sm">
								<?php foreach($positions as $row){ ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->position; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-4">
							<label>Secondary Role</label>
							<select name="sec_rol" required class="form-control input-sm">
								<?php foreach($positions as $row){ ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->position; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-4">
							<label>Supervisor</label>
							<select name="supervisor" class="form-control input-sm">
								<?php foreach($supervisors as $row){ ?>
									<option value="<?php echo $row->emp_fname.' '.$row->emp_lname; ?>"><?php echo $row->emp_fname.' '.$row->emp_lname; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="employee_submit btn btn-sm btn-primary">Submit</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="edit_employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit existing employee</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="edit_existing_employee" action="<?= site_url('e_roster/update_employee'); ?>" method="POST">
				<div class="container-fluid">
					<div class="row">
						<div class="col-4">
							<input type="hidden" name="tbl_id">
							<label>Employee ID</label>
							<input type="text" class="form-control form-control-sm text-input" name="emp_id" autocomplete="off">
							<label>XPO Email Address</label>
							<input type="text" class="form-control form-control-sm text-input" name="emp_email" required>
						</div>
						<div class="col-4">
							<label>WMS User Group</label>
							<select name="wms_usrgrp" required class="form-control form-control-sm">
							<?php foreach($user_groups as $user_group){ ?>
								<option value="<?=$user_group->user_grp;?>"><?=$user_group->user_grp;?></option>
							<?php } ?>
							</select>
							<label>Parking Tag</label>
							<input type="text" class="form-control form-control-sm text-input" name="park_tag">
						</div>
					</div>
					<br/>
					<strong>Personal Information</strong>
					<hr size="1">
					<div class="row">
						<div class="col-4">
							<label>First Name</label>
							<input type="text" class="form-control form-control-sm text-input" name="emp_fname">
						</div>
						<div class="col-4">
							<label>Last Name</label>
							<input type="text" class="form-control form-control-sm text-input" name="emp_lname">
						</div>
						<div class="col-4">
							<label>Date of Birth</label>
							<input type="text" class="form-control form-control-sm text-input" name="emp_dob">
						</div>
					</div>
					<br/>
					<strong>Security Information</strong>
					<hr size="1">
					<div class="row">
						<div class="col-4">
							<label>WMS ID</label>
							<input type="text" class="form-control form-control-sm text-input" name="wms">
						</div>
						<div class="col-4">
							<label>Security Badge</label>
							<input type="text" class="form-control form-control-sm text-input" name="sb">
						</div>
						<div class="col-4">
							<label>Last 4 SSN</label>
							<input type="text" class="form-control form-control-sm text-input" name="ssn" required>
						</div>
					</div>
					<br/>
					<strong>Employment Information</strong>
					<hr size="1">
					<div class="row">
						<div class="col-6">
							<label>Staffing</label>
							<select name="temp_agency" class="form-control form-control-sm">
							<?php foreach($agencies as $agency){ ?>
								<option value="<?= $agency->temp_id;?>"><?= $agency->temp_name;?></option>
							<?php } ?>
							</select>
						</div>
						<div class="col-6">
							<label>Start Date</label>
							<input type="text" class="form-control form-control-sm text-input" name="temp_start">
						</div>
					</div>
					<br/>
					<strong>Job Details</strong>
					<hr size="1">
					<div class="row">
						<div class="col-4">
							<label>Department</label>
							<select name="department" required class="form-control input-sm">
								<?php foreach($departments as $row){ ?>
									<option value="<?php echo $row->dept_id; ?>"><?php echo $row->dept_name; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-4">
							<label>Zone</label>
							<select name="zone" required class="form-control input-sm">
								<?php foreach($zones as $row){ ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->zone; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-4">
							<label>Shift</label>
							<select name="shift" required class="form-control input-sm">
								<?php foreach($shifts as $row){ ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->shift; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-4">
							<label>Primary Role</label>
							<select name="pri_rol" required class="form-control input-sm">
								<?php foreach($positions as $row){ ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->position; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-4">
							<label>Secondary Role</label>
							<select name="sec_rol" required class="form-control input-sm">
								<?php foreach($positions as $row){ ?>
									<option value="<?php echo $row->id; ?>"><?php echo $row->position; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-4">
							<label>Supervisor</label>
							<select name="supervisor" class="form-control input-sm">
								<?php foreach($supervisors as $row){ ?>
									<option value="<?php echo $row->emp_fname.' '.$row->emp_lname; ?>"><?php echo $row->emp_fname.' '.$row->emp_lname; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="employee_submit btn btn-sm btn-primary">Submit</button>
			</div>
		</div>
	</div>
</div>