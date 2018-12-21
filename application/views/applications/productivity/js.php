<script>
	var app_name = '<?= $method = $this->router->fetch_method(); ?>';
	var productivity = {
			update: function(data){
					params = data.split('%');
					$('.hourly_table').find('tr[data-rowid="'+params[0]+'"]').find('input').val(params[1]);
				},
			refresh: function(){
					updateAdmin();
				}
			}

	$('.save_shift').click(function(){
		url = "<?= site_url('productivity/save_shift'); ?>";
		form_data = $('#shift_setting_form').serialize();
		type = $('#shift_type').val();

		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'HTML',
			data: { post : form_data, type : type },
			beforeSend: function(){
				startSubmit('.save_shift');
			},
			success: function(res){
				console.log(res);
			},
			complete: function(){
				endSubmit('.save_shift');
				socket.emit('command','/do-productivity-refresh');
			}
		});
	});

	$('.send_email').click(function(){
		type = $('#shift_type').val();
		url = "<?= site_url('productivity/email/'); ?>"+type;
		$.ajax({
			type: 'GET',
			url: url,
			beforeSend: function(){
				startSubmit('.send_email');
			},
			success: function(res){
				console.log(res);
			},
			complete: function(){
				endSubmit('.send_email');
			}
		});
	});

	$('.set_break').click(function(){
		val = $(this).attr('data-mins');
		$('input.mins_worked:visible').val(val);
	});

	$('.form_submit').click(function(){
		url = "<?= site_url('productivity/saveHoursWorked'); ?>";
		form_data = $('#hour_picker_detail_form').serialize();

		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'json',
			data: { post : form_data },
			beforeSend: function(){
				startSubmit('.form_submit');
			},
			success: function(res){
				console.log(res);
			},
			complete: function(){
				endSubmit('.form_submit');
				updateAdmin();
			}
		})
	});

	$(document).on('click','a[href="#prod_individual_admin"]',function(){
		url = "<?= site_url('productivity/individual_tracker'); ?>";

		$.ajax({
			type: 'GET',
			url: url,
			dataType: 'HTML',
			beforeSend: function(){
				$('#individual').html(loading);
			},
			success: function(res){
				$('#individual').html(res);
			},
			error: function(){
				error = '<h6><i class="fas fa-exclamation-circle"></i> Ooops! An error has occured</h6><p class="text-lead">Database locked. <a href="#prod_individual_admin">Try again</a></p>';
				$('#individual').html(error);	
			}
		});
	});

	$(document).on('click','a[href="#prod_hour_admin"]',function(){
		updateAdmin();
	});

	$(document).on('click','.collapse_trigger',function(){
		console.log('triggered');
		target = $(this).attr('data-target');
		$(target).collapse('toggle');
	});

	$(document).on('blur','.reasons',function(){
		row = $(this).parent().parent();
		ph_id = $(row).data('rowid');
		reason = $(this).val();
		url = '<?= site_url("productivity/save_reason"); ?>';

		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'json',
			data: { ph_id : ph_id, reason : reason },
			success: function(){
				row.addClass('stylish');
    			setTimeout(function() {
        			row.removeClass('stylish');
    			},500); 
			},
			complete: function(){
				socket.emit('command','/do-productivity-update-'+ph_id+'%'+reason);
			}
		});
	});
	

	$(document).on('click','.pickers_detail',function(){
		url = '<?= site_url("productivity/getPickersOnHour"); ?>';
		row = $(this).parent().parent();
		ph_id = $(row).attr('data-rowid');
		from = $(row).attr('data-from');
		to = $(row).attr('data-to');
		type = $('input[name="shift_type"]').val();

		timespan = moment(from).format('h:mm A')+' - '+moment(to).format('h:mm A');
		$('#hour_label').html(timespan);

		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'HTML',
			data: { ph_id : ph_id, from : from, to : to ,type : type},
			beforeSend: function(){
				$('#hour_picker_detail').html(loading);
			},
			success: function(res){
				$('#hour_picker_detail').html(res);
			},
			error: function(){
				error = '<h6><i class="fas fa-exclamation-circle"></i> Ooops! An error has occured</h6><p class="text-lead">Database locked. Close this dialog and try again.</p>';
				$('#hour_picker_detail').html(error);
			}
		});

		$('#picker_details_modal').modal('show');
	});

	function updateAdmin()
	{
		type = $('#shift_type').val();
		url = "<?= site_url('productivity/getAdminHTML/'); ?>"+type;

		$.ajax({
			type: 'GET',
			url: url,
			dataType: 'HTML',
			beforeSend: function(){
				$('#update_section').html(loading);
			},
			success: function(res){
				$('#update_section').html(res);
			},
			error: function(){
				error = '<h6><i class="fas fa-exclamation-circle"></i> Ooops! An error has occured</h6><p class="text-lead">Database locked. <a href="#prod_hour_admin">Try again</a></p>';
				$('#update_section').html(error);
			}
		});
	}
</script>