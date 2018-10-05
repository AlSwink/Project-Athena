<script>
	var shipment = $('#verify2_shipment_id').val();

	function start_qa()
	{
		socket.emit('command','/do-argus-lock-'+shipment);
		now = moment().format('MM/DD/YYYY');
		$('#tabs a[href="#verification2_sheet"]').tab('show');
		$('.timestamps').text(now);
	}

	$('.cancel_verification_btn').click(function(){
		$('#tabs a[href="#shipment_list"]').tab('show');
	});

	$('#verified_btn').click(function(){
		socket.emit('command','/do-argus-verified-'+shipment);
		$('#tabs a[href="#shipment_list"]').tab('show');
		socket.emit('command','/do-argus-unlock-'+shipment);
	});
</script>