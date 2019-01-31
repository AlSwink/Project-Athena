<script>
	var shipment = $('#verify_shipment_id').val();

	function start_verification()
	{
		shipLock(shipment,1);
		socket.emit('command','/do-argus-lock-'+shipment);
		
		$.ajax({
			type : 'POST',
			url : '<?= site_url('argus/getShipment'); ?>',
			dataType : 'json',
			data : { post : shipment },
			beforeSend : function(){
				$('body').append(<?= getFullLoading('Grabbing updated Carrier.<br>Please wait'); ?>);
				$('.reset_sheet').trigger('click');
			},
			success : function(res){
				$('.carrier').html(res.argus.carrier);
			},
			complete : function(){
				now = moment().format('MM/DD/YYYY');
				$('#tabs a[href="#verification_sheet"]').tab('show');
				$('.timestamps').html(now);	
				$('#full-loader').remove();	
			}
		});		
	}

	$('#cancel_verification_btn').click(function(){
		$('#tabs a[href="#shipment_list"]').tab('show');
	});

	$('#ready_qa_btn').click(function(){
		ready = checkValues();
		
		if(ready){

			data = submitVerification();

			$.ajax({
				type: 'POST',
				url: '<?= site_url("argus/submitVerification"); ?>',
				dataType: 'json',
				data: data,
				beforeSend: function(){
					$('body').append(<?= getFullLoading('Nesting Check in progress.<br>Please wait'); ?>);
				},
				success: function(res){
					console.log(res);
				},
				complete: function(){
					$('#full-loader').remove();
					stage = {
						'shipment' : shipment,
						'stage' : 3,
						'button_id' : 'ready_qa_btn',
						'type' : 'start'
					}
					updateShipment(stage);

					socket.emit('command','/do-argus-ready_qa-'+shipment);
					$('#tabs a[href="#shipment_list"]').tab('show');
					shipLock(shipment,0);
					socket.emit('command','/do-argus-unlock-'+shipment);
					notifyAll(shipment,'verified');	
				}
			})
		}
	});

	$('.add_pallet_row').click(function(){
		pallet = parseInt($('.pallet_num:visible:last').html());
		pallet++;
		delete_col = '<td><button type="button" class="btn btn-lg btn-danger remove_pallet"><i class="fas fa-minus fa-lg"></i></td>';
		
		pallet_col1 = '<td><h1 class="pallet_num mb-0">'+pallet+'</h1></td>';
		pallet_col2 = '<td>'+$('.carton_control:first').html()+'</td>';
		pallet_row = '<tr class="pallet_row">'+pallet_col1+pallet_col2+delete_col+'</tr>';

		$('.pallet_row:visible:last').after($(pallet_row));
	});

	$('.reset_sheet').click(function(){
		extra = $('.pallet_row:first').nextAll();
		$(extra).remove();
		$('.carton_count:first').val(0);
		updateTotals();
	});

	$(document).on('click','.add',function(){
		removeError($(this));
		curr_val = $(this).parent().siblings('input').val();
		curr_val++;
		$(this).parent().siblings('input').val(curr_val);
	});

	$(document).on('click','.add_ten',function(){
		removeError($(this));
		curr_val = $(this).parent().siblings('input').val();
		curr_val = parseInt(curr_val) + 10;
		$(this).parent().siblings('input').val(curr_val);
	});

	$(document).on('click','.minus',function(){
		removeError($(this));
		curr_val = $(this).parent().siblings('input').val();
		if(curr_val > 0)
			curr_val--;

		$(this).parent().siblings('input').val(curr_val);
	});

	$(document).on('click','.reset',function(){
		removeError($(this));
		curr_val = 0;
		$(this).parent().siblings('input').val(curr_val);
	});

	$(document).on('click','.check',function(){
		updateTotals();
	});

	$(document).on('click','.remove_pallet',function(){
		$(this).parent().parent().remove();
		updateTotals();
	});

	function updateTotals(){
		var curr_cartons = 0;
		$('.carton_count:visible').each(function(k,v){
			curr_cartons = curr_cartons + parseInt($(v).val());
		});

		$('#pallet_number').html($('.pallet_row:visible').length);
		$('#carton_count').html(curr_cartons);
	}

	function checkValues(){
		ready = true;
		$('.carton_count:visible').each(function(k,v){
			if($(v).val() == 0){
				ready = false;
				$(v).addClass('bg-danger text-light');
			}
		});

		if(!ready){
			$.notify('There must be at least 1 carton on a pallet',{
				style: 'globalerror'
			});
			error.play();
		}

		return ready;
	}

	function submitVerification(){
		pallet_nums = [];
		counts = [];

		$('.pallet_row:visible').each(function(k,v){
			pallet_num = $(v).find('.pallet_num:visible').html();
			count = $(v).find('.carton_count:visible').val();
			pallet_nums.push(pallet_num);
			counts.push(count);
		});

		pallet = {
					'shipment' : shipment,
					'pallets' : pallet_nums,
					'cartons' : counts
				};

		return pallet;
	}

	function removeError(element){
		input = $(element).parent().siblings('input');
		$(input).removeClass('bg-danger text-light');
	}
</script>