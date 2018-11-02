<script>
	var shipment = $('#verify2_shipment_id').val();
	
	function start_qa()
	{
		socket.emit('command','/do-argus-lock-'+shipment);

		$.ajax({
			type : 'POST',
			url : '<?= site_url('argus/getShipment'); ?>',
			dataType : 'json',
			data : { post : shipment },
			beforeSend : function(){
				$('body').append(<?= getFullLoading('Fetching verification sheet.<br>Please wait'); ?>);
			},
			success : function(res){
				$('.carrier').html(res.argus.carrier);
			},
			complete : function(){
				now = moment().format('MM/DD/YYYY');
				$('#tabs a[href="#verification2_sheet"]').tab('show');
				$('.timestamps').html(now);	
				$('#full-loader').remove();
			}
		});
	}

	$('.cancel_verification_btn').click(function(){
		$('#tabs a[href="#shipment_list"]').tab('show');
		socket.emit('command','/do-argus-unlock-'+shipment);
	});

	$('#verified_btn').click(function(){
		socket.emit('command','/do-argus-verified-'+shipment);
		$('#tabs a[href="#shipment_list"]').tab('show');
		socket.emit('command','/do-argus-unlock-'+shipment);
	});
</script>