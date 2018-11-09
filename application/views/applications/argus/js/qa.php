<script>
	var shipment = $('#verify2_shipment_id').val();
	
	function start_qa()
	{
		shipLock(shipment,1);
		socket.emit('command','/do-argus-lock-'+shipment);

		$.ajax({
			type : 'POST',
			url : '<?= site_url('argus/getShipment'); ?>',
			dataType : 'json',
			data : { post : shipment },
			beforeSend : function(){
				$('#qa_sheet').html('');
				$('body').append(<?= getFullLoading('Fetching verification sheet.<br>Please wait'); ?>);
			},
			success : function(res){
				$('.verification_id').html(res.verification[0].verification_id);
				$('.qa_carrier').html(res.wms.carrier);
				$('.loader').html(res.verification[0].e_fname+' '+res.verification[0].e_lname);
				$('#carton_count_counted').html(res.verification[0].total_cartons);
				$('#pallet_counted').html(res.verification[0].total_pallets);
				$('#pallet_expected').html(res.pallet_info.length);
				$('#carton_count_expected').html(res.wms.cartons);
				insertDetails(res.verification);
				$('#tabs a[href="#verification2_sheet"]').tab('show');
			},
			error: function(xhr,status,error){
				if(xhr.status == 500){
					$('.cancel:visible').click(function(){
						$('#tabs a[href="#shipment_list"]').tab('show');
						$('#error').modal('show');
					});
				}
			},
			complete : function(){
				now = moment().format('MM/DD/YYYY');
				$('.timestamps').html(now);	
				$('#full-loader').remove();
			}
		});
	}

	$('.cancel_verification_btn').click(function(){
		$('#tabs a[href="#shipment_list"]').tab('show');
		shipLock(shipment,0);
		socket.emit('command','/do-argus-unlock-'+shipment);
	});

	$('#ready_load_btn').click(function(){
		check = checkQAVals();
		if(check){
			data = getQAVals();
			
			$.ajax({
				type : 'POST',
				url : '<?= site_url('argus/submitQA'); ?>',
				dataType : 'json',
				data : data,
				success : function(res){
					console.log(res);
				},
				complete : function(){
					stage = {
						'shipment' : shipment,
						'stage' : 4,
						'button_id' : 'ready_load_btn',
						'type' : 'start'
					}
					updateShipment(stage);
					
					socket.emit('command','/do-argus-verified-'+shipment);
					$('#tabs a[href="#shipment_list"]').tab('show');
					shipLock(shipment,0);
					socket.emit('command','/do-argus-unlock-'+shipment);
					notifyAll(shipment,"QA'd");	
				}
			});

		}
	});

	$(document).on('change','.reason',function(){
		selected = $(this).val();
		
		if(selected != 'Good'){
			$(this).parent().siblings('td:last').find('.qty_control').attr('disabled',false);
		}else{
			$(this).parent().siblings('td:last').find('.qty_control').attr('disabled',true);
			$(this).parent().siblings('td:last').find('.qty_control').removeClass('bg-danger text-light');
		}
	});

	function insertDetails(sheet){
		var rows = '';
		$(sheet).each(function(k,v){
			rows += '<tr class="qa_rows">';
			rows += '<td class="detail_id d-none">'+v.detail_id+'</td>';
			rows += '<td><h1 class="pallet_num mb-0">'+v.pallet+'</h1></td>';
			rows += '<td><h1 class="carton_num mb-0">'+v.cartons+'</h1></td>';
			rows += '<td><select name="reason[]" class="reason form-control from-control-lg mt-1 text-center">';
			rows += '<option>Good</option><option>Short</option><option>Over</option></select></td><td>';
			rows += '<input type="number" name="qty[]" disabled class="qty_control mt-1 form-control from-control-lg text-center"/></td>';
			rows += '</tr>';
		});

		$('#qa_sheet').html(rows);
	}

	function checkQAVals(){
		ready = true;
		
		$('.qty_control:enabled').each(function(k,v){
			
			if(!$(v).val()){
				ready = false;
				$(v).addClass('bg-danger text-light');
			}
		});

		if(!ready){
			$.notify('Please provide the QTY',{
				style: 'globalerror'
			});
			error.play();
		}

		return ready;
	}

	function getQAVals()
	{
		pallet_nums = [];
		detail_ids = [];
		reasons = [];
		qtys = [];

		$('.qa_rows:visible').each(function(k,v){
			pallet_num = $(v).find('.pallet_num:visible').html();
			detail_id = $(v).find('.detail_id').html();
			reason = $(v).find('.reason:visible').val();
			qty = $(v).find('.qty_control:visible').val();
			
			pallet_nums.push(pallet_num);
			detail_ids.push(detail_id);
			reasons.push(reason);
			qtys.push(qty);
		});

		pallet = {
					'verification_id' : $('.verification_id').html(),
					'shipment' : shipment,
					'pallets' : pallet_nums,
					'detail_ids' : detail_ids,
					'reasons' : reasons,
					'qtys' : qtys,
				};

		return pallet;
	}

</script>