<script>
	var shipment = $('#verify_shipment_id').val();

	function start_verification()
	{
		socket.emit('command','/do-argus-lock-'+shipment);
		now = moment().format('MM/DD/YYYY');

		$.ajax({
			type : 'POST',
			url : '<?= site_url('argus/getShipment'); ?>',
			dataType : 'json',
			data : { post : shipment },
			
			success : function(res){
				$('.carrier').html(res.argus.carrier);

			},
			complete : function(){
				
			}
		})

		$('#tabs a[href="#verification_sheet"]').tab('show');
		$('.timestamps').text(now);
	}

	$('#cancel_verification_btn').click(function(){
		$('#tabs a[href="#shipment_list"]').tab('show');
		socket.emit('command','/do-argus-unlock-'+shipment);
	});

	$('#ready_qa_btn').click(function(){
		socket.emit('command','/do-argus-ready_qa-'+shipment);
		$('#tabs a[href="#shipment_list"]').tab('show');
		socket.emit('command','/do-argus-unlock-'+shipment);
	});

	$('.add_pallet_row').click(function(){
		pallet = parseInt($('.pallet_num:last').html());
		pallet++;
		delete_col = '<td><button type="button" class="btn btn-lg btn-danger remove_pallet"><i class="fas fa-minus fa-lg"></i></td>';
		
		pallet_col1 = '<td><h1 class="pallet_num mb-0">'+pallet+'</h1></td>';
		pallet_col2 = '<td>'+$('.carton_control:first').html()+'</td>';
		pallet_row = '<tr class="pallet_row">'+pallet_col1+pallet_col2+delete_col+'</tr>';

		$('.pallet_row:last').after($(pallet_row));
	});

	$(document).on('click','.add',function(){
		curr_val = $(this).parent().siblings('input').val();
		curr_val++;
		$(this).parent().siblings('input').val(curr_val);
	});

	$(document).on('click','.minus',function(){
		curr_val = $(this).parent().siblings('input').val();
		if(curr_val > 0)
			curr_val--;

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
		$('.carton_count').each(function(k,v){
			curr_cartons = curr_cartons + parseInt($(v).val());
		});

		$('#pallet_number').html($('.pallet_row').length);
		$('#carton_count').html(curr_cartons);
	}
</script>