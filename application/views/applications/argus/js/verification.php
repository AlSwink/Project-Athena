<script>
	var shipment = $('#verify_shipment_id').val();

	function start_verification()
	{
		socket.emit('command','/do-argus-lock-'+shipment);
		now = moment().format('MM/DD/YYYY');
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
</script>