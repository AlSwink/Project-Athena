<div class="panel panel-primary">
	<div class="panel-heading"><span class="glyphicon glyphicon-user"></span>My Employees<span class="badge"><?php echo count($employees);?></span><a data-toggle="modal" data-target="#my_employees_help" href="#"><span class="help glyphicon glyphicon-question-sign pull-right"></span></a></div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-2 pull-left">
				<label>Position</label>
				<select id="position_filter" class="input-sm form-control">
					<option value="all">All Employees (<?php echo count($employees); ?>)</option>
					<?php foreach($positions as $pstn=>$people){ ?>
						<option value="<?php echo $pstn;//echo $xtab_; ?>" data-toggle="tab"><?php echo $pstn; ?> (<?php echo $people; ?>)</option>
					<?php } ?>
				</select>
			</div>
			
		</div>
		<div class="row"style="max-height:40%; overflow:auto;">
			<div class="col-lg-12">
				<div class="tab-content">
					<div class="tab-pane active" id="all">
					<table id="emp_table" class="table table-condensed table-hover">
						<thead>
							<tr>
								<th>Employee ID</th>
								<th>Name</th>
								<th>Staffing</th>
								<th>Department - Zone</th>		
								<th>Position</th>
								<th>Shift</th>
								<th>Supervisor</th>
								<th>Controls</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($employees as $row){ ?>
							<tr class="employee">
								<td><?php echo $row->kronos_id; ?></td>
								<td class="name"><?php echo $row->emp_fname.' '.$row->emp_lname; ?></td>
								<td class="staffing"><?php echo $row->temp_name; ?></td>
								<td><?php echo $row->dept_name.' - '.$row->zone; ?></td>
								<td class='position'><?php echo $row->position; ?></td>
								<td><?php echo $row->shift; ?></td>
								<td class="supervisor"><?php echo $row->supervisor; ?></td>
								<td>
									<div class="btn-group">
										<a href="#<?php //echo site_url('e_roster/edit_employee/'.$row->id); ?>" class="btn btn-sm btn-default" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>
										<?php //if(!in_array($this->session->userdata('user_info')->user_group,$temps)){ ?>
										<a href="#<?php //echo site_url('e_roster/employee_module/'.$row->id); ?>" type="button" class="btn btn-sm btn-default" title="View Training Modules"><span class="glyphicon glyphicon-list"></span></a>
										<?php //} ?>
										<button data-destination="#<?php //echo site_url('e_roster/delete_employee/'.$row->id); ?>" type="button" class="btn btn-sm btn-primary delete_employee" title="Delete" data-toggle="modal" data-target="#delete_employee"><span class="glyphicon glyphicon-remove"></span></button>
									</div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					</div>
	</div>	
</div>