<div class="container-fluid p-3 rounded">
	<?= loadInclude('app_container_control',$this->tool_info); ?>
	<div class="row">
		<div class="col">
			<?php if($this->session->userdata('location_added')){ ?>
			<div class="alert alert-success flashmessage">
				<b><i class="fas fa-check-circle"></i> Success!!</b> You have added <b><?= $this->session->userdata('location_added'); ?></b> locations
			</div>
			<?php 
				$this->session->unset_userdata('location_added');
			} ?>
			<div class="alert alert-warning">
				<b><i class="fas fa-exclamation-triangle"></i> Caution!!</b> This tool is strictly for IT use only any misuse of this tool may result to irreversable damage to WMS.<br>
				If you are not sure how to use it please refer to this <a href="http://10.89.98.122/wiki/index.php/wiki/article/633">article</a>
			</div>
		</div>
	</div>
	<form id="prepare_form" action="<?= site_url('tools/prepare_bulk_locations'); ?>" method="POST">
	<div class="row">
		<div class="col-2">
			<label>Locations</label>
			<small><p>Paste all the locations in the field provided below separated by new line. <b>Same format only</b></p></small>
			<textarea rows=13 class="form-control fields" name="locations" placeholder="O0102-31"></textarea>
			<div class="card card-body bg-light p-2 mt-1">
				<p class="mb-0">Locations <span id="total_locs" class="badge badge-primary float-right m-1">0</span></p>
			</div>
		</div>
		<!--div class="col-2">
			<label>Command Sequence</label>
			<small><p>Paste all the cmd_seq in the field provided below separated by new line. <b>In relation to locations</b></p></small>
			<textarea rows=13 class="form-control fields" name="cmd_seq" placeholder="10231"></textarea>
			<div class="card card-body bg-light p-2 mt-1">
				<p class="mb-0">Cmd Seq <span class="badge badge-primary float-right m-1">0</span></p>
			</div>
		</div>
		<div class="col-2">
			<label>Store Sequence</label>
			<small><p>Paste all the store_seq in the field provided below separated by new line. <b>In relation to locations</b></p></small>
			<textarea rows=13 class="form-control fields" name="store_seq" placeholder="10231"></textarea>
			<div class="card card-body bg-light p-2 mt-1">
				<p class="mb-0">Store Seq <span class="badge badge-primary float-right m-1">0</span></p>
			</div>
		</div-->
		<div class="col-2">
			<label>Custom Field</label>
			<small><p>Placeholder for a custom field to modify. Send request to add. <br><b>In relation to locations</b></p></small>
			<textarea rows=13 class="form-control fields" disabled name="custom"></textarea>
			<div class="card card-body bg-light p-2 mt-1">
				<p class="mb-0">Custom <span class="badge badge-secondary float-right m-1">0</span></p>
			</div>
		</div>
	</div>
	</form>
	<div class="row mt-1">
		<div id="error" class="col"></div>
	</div>
	<div class="row mt-2">
		<div class="col">
			<div class="btn-group d-flex" role="group">
				<button type="button" id="prepare" class="btn w-100 btn-primary">Prepare Locations <i class="fas fa-table"></i></button>
				<button type="button" class="btn w-100 btn-success" disabled>Import from Excel </i> <i class="fas fa-upload"></i></button>
				<button type="button" class="btn w-100 btn-secondary" disabled>Download Import Template </i> <i class="fas fa-file-excel"></i></button>
				<button type="button" id="clear" class="btn w-100 btn-warning">Clear Form <i class="fas fa-undo"></i></button>
			</div>
		</div>
	</div>
</div>

<div id="preview_modal" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Review submitted information Step 2 of 3</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="alert alert-secondary">
      		Make sure the rows are relative before we generate the final data for insertion.
      	</div>
      	<form id="preview_form" action="<?= site_url('tools/verify_bulk_locations'); ?>" method="POST">
      		<div id="preview" style="max-height: 35%;overflow: auto"></div>
      	</form>
      </div>
      <div class="modal-footer">
      	<button type="button" id="verify" class="btn btn-sm btn-success">Looks good <i class="fas fa-thumbs-up"></i></button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel <i class="fas fa-times"></i></button>
      </div>
    </div>
  </div>
</div>

<div id="final_step" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 1300px">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Review data to be inserted Step 3 of 3</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="container-fluid">
      		<form id="insert_form" action="<?= site_url('tools/insert_bulk_locations'); ?>" method="POST">
      		<div id="final_preview"></div>
      		</form>
      	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" id="insert" class="btn btn-sm btn-success">Acknowledged! Proceed with Insert <i class="fas fa-check-square"></i></button>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel <i class="fas fa-times"></i></button>
      </div>
    </div>
  </div>
</div>

<script>
	$('.fields').keyup(function(){
		values = $(this).val();
		values_breakdown = values.split("\n");
		values_filtered = values_breakdown.filter(function(n){ return n != '' });
		$(this).siblings('.card').find('.badge').html(values_filtered.length);
	});

	$('#prepare').click(function(){
		ready = false;
		counts = [];
		$('.badge.badge-primary').each(function(k,v,){
			value = parseInt($(v).html());
			if(value){
				counts.push(value);
			}
		});
	
		is_equal = counts.every((val,i,arr)=>val ===arr[0]);
		ready = is_equal;

		if(!counts.length){
			error ="<strong>CAUTION:</strong> Please make sure all fields have been filled.";
			$('#error').html(createAlert('warning mb-0',error));
		}
		else if(!is_equal){
			error ="<strong>DANGER:</strong> There's an inconsistency between columns please make sure all rows are in relation with each other.";
			$('#error').html(createAlert('danger mb-0',error));
		}else if($('#total_locs').html() >= 10000){
			error ="<strong>DANGER:</strong> Max input reached. please do it less than 10000 at a time.";
			$('#error').html(createAlert('danger mb-0',error));
		}else{
			$('#error').html('');
			prepare_form();
		}
	});

	$('#verify').click(function(){
		url = $('#preview_form').attr('action');
		$('.modal').modal('hide');
		verify_form();
	});

	$('#insert').click(function(){
		startSubmit('#insert');
		$('body').append(<?php echo getFullLoading('Inserting locations to WMS. page will redirect when completed'); ?>);
		$('#insert_form').submit();
	});

	$('#final_step').on('shown.bs.modal',function(){
		$('#full-loader').remove();
	});

	$('#clear').click(function(){
		$('.fields').val('');
		$('.badge').html(0);
		$('.flashmessage').remove();
	})

	function prepare_form()
	{
		url = $('#prepare_form').attr('action');
		post = $('#prepare_form').serialize();
		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'HTML',
			data: { post : post },
			beforeSend: function(){
				startSubmit('#prepare');
			},
			success: function(res){
				$('#preview').html(res);
				$('#preview_modal').modal('show');
			},
			complete: function(){
				endSubmit('#prepare',false);
			}
		});
	}

	function verify_form()
	{
		url = $('#preview_form').attr('action');
		post = $('#preview_form').serialize();
		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'HTML',
			data: { post : post },
			beforeSend: function(){
				startSubmit('#verify');
				$('body').append(<?php echo getFullLoading('Verifying data vs WMS'); ?>);
			},
			success: function(res){
				$('#final_preview').html(res);
				$('#final_step').modal('show');
			},
			complete: function(){
				endSubmit('#verify',false);
			}
		});
	}
</script>