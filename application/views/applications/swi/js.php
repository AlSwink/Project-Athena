<script>
	var last_doc = '';
	var new_process_line = '';
	var edit_process_line = '';
	var autocomplete_field = 'input.process';
	var autocomplete_options = {
		classes : { "ui-autocomplete": "highlight" },
		source: <?= create_autocomplete_source($processes,'principle_id','process'); ?>
	}

	var dtable = $('.dtable').DataTable({
			dom : '<"row"<"col"t>><"row"<"col"iBp>>',
			pagingType : 'numbers',
			info : true,
			colReorder: true,
			responsive: true,
			buttons: [
		        {
		            text: 'Excel',
		            extend: 'excel',
		            className: 'dl_excel d-none'
		        },
		        {
		            text: 'Print',
		            extend: 'print',
		            className: 'tprint d-none'
		        }
	        ],
			ajax: {
				url: '<?= site_url("swi/get_document"); ?>',
        		dataSrc: ''
			},
			columns : [
				{ data: "doc_number" },
		        { data: "doc_name" },
		        { data: "department" },
		        { data: "processes" }
			],
		    scrollY:        '60vh',
		    deferRender:    true,
		    scroller: {
		    	loadingIndicator : true
		    },
		    select: {
		    	style : 'multi+shift'
		    }
		});

	var etable = $('.etable').DataTable({
			dom : '<"row"<"col"t>><"row"<"col"iBp>>',
			pagingType : 'numbers',
			info : true,
			colReorder: true,
			responsive: true,
			buttons: [
		        {
		            text: 'Excel',
		            extend: 'excel',
		            className: 'dle_excel d-none'
		        },
		        {
		            text: 'Print',
		            extend: 'print',
		            className: 'teprint d-none'
		        }
	        ],
			ajax: {
				url: '<?= site_url("swi/get_dashboard_employees"); ?>',
        		dataSrc: ''
			},
			columns : [
				{ data: "name" },
		        { data: "assigned" },
		        { data: "department" },
		        { data: "status" }
			],
		    scrollY:        '40vh',
		    deferRender:    true,
		    scroller: {
		    	loadingIndicator : true
		    },
		    order : [3,'desc'],
		    "createdRow" : function(row,data,index){
		    	if(data['status'] == 'In-Progress'){
		    		$(row).addClass('table-warning');
		    	}
		    }
		});

	function form_submit(target,is_edit=false){
		
		url = $(target).attr('action');
		post = $(target).serialize();

		$.ajax({
			type : 'POST',
			url : url,
			dataType : 'json',
			data : post,
			beforeSend : function(){
				startSubmit('.form_submit');
			},
			success : function(res){
				autocomplete_options.source = res;
				$(target+' input[name="doc_num"]').val('');
				$(target+' input[name="doc_name"]').val('');
				endSubmit('.form_submit');
				$('.dtable').DataTable().ajax.reload();
			}
		});

		clear_validation();
	}

	function clear_input_swi()
	{
		$('#doc_info_card').addClass('d-none');
		$('#swi_input_table').empty();
		clear_validation();
	}

	$(document).ready(function(){
		new_process_line = $('#new_process').html();
		edit_process_line = $('#edit_process').html();
	});

	$(document).on('click','.add_process',function(){
		btn = $(this).parent().parent().html();
		$(this).parent().parent().remove();
		$('#process_table').append('<tr>'+new_process_line+'</tr><tr>'+btn+'</tr>');
		clear_validation();
	});

	$(document).on('click','.add_eprocess',function(){
		btn = $(this).parent().parent().html();
		
		$('#eprocess_table').append('<tr>'+edit_process_line+'</tr>');
		clear_validation();
	});

	$(document).on('click','.remove_process',function(){
		$(this).parent().parent().remove();
	});	

	$(document).on('keydown.autocomplete',autocomplete_field,function(){
		$(this).autocomplete(autocomplete_options);
	});

	$(document).on("autocompletefocus autocompleteselect",'.process',function( event, ui ) {
		event.preventDefault();
		principle_id = ui.item.value;

		$(this).val(ui.item.label);
		$(this).parent().siblings('td').find('select option:selected').prop('selected',false);
		$(this).parent().siblings('td').find('select option[value="'+principle_id+'"]').prop('selected',true);

	});

	$(document).on('dblclick','tbody td',function(){
		if(dtable.rows({selected:true}).data().length < 2){
			$('#edit').prop('disabled',false);
			$('#edit').click();
			$('#edit').prop('disabled',true);	
		}
	})

	$(document).on('keyup','.remove_process:last',function(e){
		var keyCode = e.keyCode || e.which;
		if (keyCode == 9) { 
			e.preventDefault(); 
		} 
	});

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
			$(this).parent().parent().siblings('.comments').children('input').prop('disabled',true);
		}
	});


	$('a[href="#swi_docs').click(function(){
		setTimeout(function(){
			dtable.draw('full-reset');
		},0);
	})

	$('a[href="#swi_dash').click(function(){
		setTimeout(function(){
			etable.draw('full-reset');
		},0);
	})

	$('#dl_excel').click(function(){
		$('.dl_excel').click();
	})

	$('#print').click(function(){
		$('.tprint').click();
	})

	$('#search_swi').keyup(function(){
		dtable.search( this.value ).draw();
	})

	$('#delete_docs').click(function(){
		to_delete = [];
		$(dtable.rows({selected:true}).data()).each(function(k,v,){
			to_delete.push(v.doc_id);
		});

		$.ajax({
			type : 'POST',
			url : '<?= site_url('swi/delete_document'); ?>',
			dataType : 'json',
			data : {docs : to_delete},
			success : function(res){
				$('.dtable').DataTable().ajax.reload();
			}
		})
	})

	$('#edit').click(function(){
		form = '#edit_doc';
		doc = ($(dtable.rows({selected:true}).data()[0]).length ? dtable.rows({selected:true}).data()[0] : last_doc[0]);
		doc_id = doc.doc_id;
		$(form+' input[name="doc_id"]').val(doc_id);
		$(form+' input[name="doc_num"]').val(doc.doc_number);
		$(form+' input[name="doc_name"]').val(doc.doc_name);
		$(form+' select[name="dept"] option:contains("'+doc.department+'")').attr('selected','selected');

		if(doc_id){
			$.ajax({
				type : 'GET',
				url	: '<?= site_url('swi/get_document_process/'); ?>/'+doc_id,
				dataType : 'json',
				asyc : false,
				success : function(res){
					$('#eprocess_table').empty();
					$(res).each(function(k,v){
						
						$('#eprocess_table').prepend(function(){
								eline = $.parseHTML('<tr>'+edit_process_line+'</tr>');
								
								$(eline)
								.find('input[name="process[]"]')
								.val(v.process);

								$(eline)
								.find('select option[value="'+v.principle_id+'"]')
								.attr('selected','selected');

								return (eline);							
							});
					});
				}
			})
		}
	});

	$('.form_submit').click(function(){
		clear_validation();

		submit_ready = true;
		is_edit = $(this).parent().siblings('.modal-body').find('form').find('input[name="doc_id"]').length;
		form = $(this).parent().siblings('.modal-body').find('form');
		form_id = '#'+$(form)[0].id;
		doc_num = $(form).find('input[name="doc_num"]').val().trim();
		doc_num_field = $(form).find('input[name="doc_num"]');
		process_list = $(form).find('.process');
		process_table = $(form).find('#process_table');

		//check required
		$(form_id+' .form-control').map(function(i,v){
			if(!$(v).val().length){
				$(this).addClass('is-invalid');
				$(this).parent().append(createInvalid('This field is required'));
				submit_ready = false;
			}
		});

		//check duplicate doc_number
		if(doc_num.length && !is_edit){
			$.ajax({
				type : 'GET',
				url	: '<?= site_url('swi/get_document/'); ?>doc_number/'+doc_num,
				dataType : 'json',
				success : function(res){
					if(res.length){
						submit_ready = false;
						$(doc_num_field).addClass('is-invalid');
						$(doc_num_field).parent().append(createInvalid('Document number already exist'));
					}
				}
			})
		}

		//check process
		if(!$(process_list).length){
			submit_ready = false;
			$(process_table).parent().parent().append(createAlert('danger','Please add at least 1 process for this document'));
		}

		if(submit_ready){
			form_submit(form_id,is_edit);
		}
	});

	$('#assignment_id').keypress(function(e){
		if(e.which == 13){
			$('#search_assignment').click();
		}
	})

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

	$('#sign_submit').click(function(evt){
		err = 0;
		if($('#status_display').html() == 'PENDING'){
			console.log('ok');
			$('input[name="standard[]"]').each(function(k,v){
				if($(v).val() == ''){
					err = 1;
				}
			});

			$('input[name="comments[]"][required]').each(function(k,v){
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

	$('#test').click(function(){
		$.ajax({
			type: 'GET',
			url: '<?= site_url('swi/get_assigned_document'); ?>',
			dataType: 'json',
			beforeSend : function(){
				$('body').append(<?php echo getFullLoading('Generating SWI Worksheets'); ?>);
			},
			success : function(res){
				$('#assign_print').html(res);
				window.print();
				$('#assign_print').html('');
				$('#full-loader').remove();
			}
		})
	});



	dtable.on('select deselect',function(e,dt,type,indexes){
		if(dtable.rows({selected:true}).data().length){
			$('#delete,#edit').prop('disabled',false);
		}else{
			$('#delete,#edit').prop('disabled',true);
		}

		if(dtable.rows({selected:true}).data().length > 1){
			$('#edit').prop('disabled',true);	
		}
	});

	dtable.on('deselect',function(e,dt,type,indexes){	
		last_doc = dtable.rows(indexes).data();
	});
</script>