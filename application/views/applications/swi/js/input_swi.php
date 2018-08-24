<script>
	$(document).on('click','.standard_select',function(){
		standard_value = $(this).data('value');
		
		var color = {
				'ok' : 'table-success',
				'bad' : 'table-danger',
				'na' : 'table-secondary'
				};

		$(this).parent().parent().parent().removeClass();
		$(this).parent().parent().parent().addClass(color[standard_value]);
		$(this).parent().children('.standard_select').removeClass('active');
		$(this).addClass('active');
		$(this).parent().siblings('input[name="standard[]"]').val(standard_value);


		if(standard_value != 'ok'){
			$(this).parent().parent().siblings('.comments').children('input').prop('required',true);
			$(this).parent().parent().siblings('.comments').children('input').prop('disabled',false);
		}else{
			$(this).parent().parent().siblings('.comments').children('input').val('');
			$(this).parent().parent().siblings('.comments').children('input').prop('required',false);
			$(this).parent().parent().siblings('.comments').children('input').prop('disabled',true);
		}
	});

	$('#assignment_id').keypress(function(e){
		if(e.which == 13){
			$('#search_assignment').click();
		}
	});

	$('#search_assignment').click(function(){
		assignment = $('#assignment_id').val();
		$('#assignment_id').val('');
		if(assignment.length){
			clear_validation();
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("swi/get_input_document"); ?>',
				dataType : 'json',
				data : { post : assignment },
				success : function(res){
					$('#swi_input_table').empty();
					$('#swi_input_table').append(res);

					if(res.length){
						doc_num = $('#doc_assgn_num').val();
						doc_name = $('#doc_assgn_name').val();
						doc_status = $('#doc_res_st').val();
						assigned_to = $('#doc_assgn_emp').val();
						assigned_on = $('#doc_assgn_on').val();
						completed_on = $('#doc_comp_on').val();
						department = $('#doc_assgn_dept').val();

						if(doc_status == 'COMPLETED'){
							doc_status = '<span class="text-success">'+doc_status+'</span>';
						}

						$('#doc_assgn_num_display').html(doc_num);
						$('#doc_assgn_title').html(doc_name);
						$('#status_display').html(doc_status);
						$('#assigned_to_display').html(assigned_to);
						$('#assigned_on_display').html(assigned_on);
						$('#compeleted_on_display').html(completed_on);
						$('#department_display').html(department);

						if(doc_name && doc_name.length){
							$('#doc_info_card').removeClass('d-none');
						}else{
							$('#doc_info_card').addClass('d-none');
						}
					}
				}
			})
		}else{
			clear_validation();
			alert = createAlert('danger','Please input assignment ID');
			$(this).parent().parent().parent().prepend(alert);
		}
	});

	$('#reprint_sheet').click(function(){
		assignment_id = $('input[name="process_assignment_id"]').val();
		search_assignment(assignment_id);
	})

	$('#sign_submit').click(function(evt){
		err = 0;
		if($('#status_display').html() == 'PENDING'){
			$('input[name="standard[]"]').each(function(k,v){
				if($(v).val() == ''){
					err = 1;
				}
			});

			$('input.comments_field[required]').each(function(k,v){
				if($(v).val() == ''){
					err = 1;
				}
			});

			if(err){
				$('#msg').removeClass('d-none');
				$('#msg').removeClass('alert-success');
				$('#msg').addClass('alert-danger');
				$('#msg').html('Please fill out the form');
				
			}else{
				$('#msg').removeClass('alert-danger');
				$('#msg').addClass('alert-success');
				$('#msg').addClass('d-none');
				
				post = $('#swi_worksheet_form').serialize();
				$.ajax({
					type : 'POST',
					url : $('#swi_worksheet_form').attr('action'),
					dataType : 'json',
					data : { post : post },
					success : function(res){
						clear_input_swi();
						$('#msg').removeClass('d-none');
						$('#msg').removeClass('alert-success');
						$('#msg').removeClass('alert-danger');
						$('#msg').addClass('alert-success');
						$('#msg').html('Worksheet saved successfully');
					}
				})
			}
		}
	});

	$('#request_reset').click(function(){
		
	});

	$('#print_type').change(function(){
		selected = $(this).val();
		$('.subselection').addClass('d-none');
		switch(selected){
			case 'assignment_id':
				$('input[name="assignment_id"]').parent().removeClass('d-none');
				break;
			case 'dept_id':
				$('select[name="dept_id"]').parent().removeClass('d-none');
				break;
			case 'employee':
				$('select[name="user_id"]').parent().removeClass('d-none');
				break;
		}
	});

	$('#print_assignment').click(function(){
		form = $('#print_assignment_form');
		url = $(form).attr('action');
		post = $(form).find(':visible').serialize();
		
		$.ajax({
			type: 'POST',
			url: '<?= site_url('api/get_assigned_document'); ?>',
			dataType: 'json',
			data: { post : post },
			beforeSend : function(){
				$('.modal').modal('hide');
				$('body').append(<?php echo getFullLoading('Generating SWI Worksheets<br>Please wait'); ?>);
			},
			success : function(res){
				$('#assign_print').html(res);
			},
			complete : function(){
				$('#full-loader').remove();
				window.print();
				$('#assign_print').html('');
			}
		})
	})

	function clear_input_swi()
	{
		$('#doc_info_card').addClass('d-none');
		$('#swi_input_table').empty();
		clear_validation();
	}

	function search_assignment(id)
	{
		$.ajax({
			type: 'GET',
			url: '<?= site_url('api/get_assigned_document/'); ?>'+id,
			dataType: 'json',
			beforeSend : function(){
				$('body').append(<?php echo getFullLoading('Generating SWI Worksheets<br>Please wait'); ?>);
			},
			success : function(res){
				$('#assign_print').html('');
				$('#assign_print').html(res);
			},
			complete : function(){
				$('#full-loader').remove();
				window.print();
			}
		})
	};
</script>