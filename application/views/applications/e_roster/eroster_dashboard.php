<div class="container-fluid mt-3">
	<div class="row">
		<div class="col-9">
			<div class="row ml-2 border-bottom pb-3">
				<div class="col">
					<h4 class="display-4 mb-0"><?= date('F d, Y'); ?></h4>
					<span class="sub-header"><?php echo getShift('display'); ?> Shift</span>
				</div>
			</div>
			<div class="row text-center border-bottom py-3">
				<div class="col border-right">
					<h4 class="display-4 mb-0 employees_all"><?= count($employees); ?></h4>
					<span class="sub-header">Total Employees</span>
				</div>
				<?php foreach($agencies as $agency){ ?>
				<div class="col border-right">
					<h4 class="display-4 mb-0"><?=$agency->cnt;?></h4>
					<span class="sub-header"><?=$agency->temp_name;?></span>
				</div>
				<?php } ?>
			</div>
			<div class="row mt-3 ml-2 text-center border-bottom pb-3">
				birthdays go here
				<?php /*foreach($birthdays as $birthday){ ?>
				<div class="col border-right">
					<div><?=$birthday->emp_fname.' '.$birthday->emp_lname;?></div>
					<span class="sub-header"><?=$birthday->emp_dob;?></span>
				</div>
				<?php } */?>
			</div>
			<div class="row text-center mt-3">
				<div class="col border-right">
					<h4 class="display-4 mb-0 total_employees">#</h4>
					<span class="sub-header">Employees</span>
				</div>
				<div class="col">
					<h4 class="display-4 mb-0 total_wms">#</h4>
					<span class="sub-header">WMS Accounts</span>
				</div>
			</div>
		</div>
		<div class="col-3">
			<div class="row">
				<div class="col">
					<!--<canvas id="pstn_bar" height="200px"></canvas>-->
					Bar chart goes here
				</div>
			</div>
		</div>
	</div>
</div>