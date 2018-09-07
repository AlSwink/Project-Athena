<?php if(isset($this->kiosk)){ ?>
	<div id="assign_print" class="d-none d-print-block"></div>
<?php } ?>
<div class="container-fluid d-print-none">
	<div class="row mt-3">
		<div class="col-lg-3 col-sm-12">
			<label>Assignment ID</label><br>
			<div class="input-group mb-3">
			  <input type="text" id="assignment_id" class="form-control alpha-no" placeholder="check the top left corner of the sheet">
			  <div class="input-group-append">
			    <button id="search_assignment" class="btn btn-primary" type="button">Search <i class="fas fa-search"></i></button>
			  </div>
			</div>
			<div id="doc_info_card" class="card d-none shadow">
			  <div class="card-body">
			    <h5 class="card-title" id="doc_assgn_title"></h5>
			    <h6 class="card-subtitle mb-2 text-muted" id="doc_assgn_num_display"></h6>
			    <table class="table table-sm table-bordered ">
			    	<tr>
			    		<td>Status</td>
			    		<td id="status_display"></td>
			    	</tr>
			    	<tr>
			    		<td>Department</td>
			    		<td id="department_display"></td>
			    	</tr>
			    	<tr>
			    		<td>Assigned to</td>
			    		<td id="assigned_to_display"></td>
			    	</tr>
			    	<tr>
			    		<td>Assigned on</td>
			    		<td id="assigned_on_display"></td>
			    	</tr>
			    	<tr>
			    		<td>Completed on</td>
			    		<td id="compeleted_on_display"></td>
			    	</tr>
			    </table>
			  </div>
			</div>
			<div class="list-group shadow mt-3">
			  <a href="#" id="reprint_sheet" class="list-group-item list-group-item-action list-group-item-primary"><i class="fas fa-print"></i> Re-print Sheet</a>
			  <!--a href="#" class="list-group-item list-group-item-action list-group-item-secondary"><i class="fas fa-redo-alt"></i> Re-assign</a>
			  <a href="#" class="list-group-item list-group-item-action list-group-item-secondary"><i class="fas fa-eraser"></i> Request Reset</a-->
			  <a href="#" class="list-group-item list-group-item-action list-group-item-secondary" data-toggle="modal" data-target="#assignment_printer"> <i class="fas fa-print"></i> Print assignments</a>
			  <a href="#" id="sign_submit" class="list-group-item list-group-item-action list-group-item-success"><i class="fas fa-clipboard-check"></i> Sign and Submit</a>
			  <a href="#" class="list-group-item list-group-item-action list-group-item-info" data-toggle="modal" data-target="#help_input_swi"><i class="fas fa-question-circle"></i> Need Help</a>
			</div>
			
		</div>
		<div class="col">
			<div class="card shadow">
				<div class="card-body p-3" style="min-height: 80%">
					<p class="lead"><i class="fas fa-list"></i> Process List</p>
					<hr>
					<div id="msg" class="alert alert-success d-none"></div>
					<form id="swi_worksheet_form" action="<?= site_url('swi/save_swi_worksheet'); ?>" method="POST" class="m-0">
						<div id="swi_input_table" class="table-responsive" style="max-height: 60%;overflow: auto">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
	if(isset($this->kiosk)){
		loadSubTemplate('modals'); 	
	}
	loadSubTemplate(['css','js/input_swi']); 
?>