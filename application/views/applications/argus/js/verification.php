<script>
	function start_verification()
	{
		now = moment().format('MM/DD/YYYY');
		$('#tabs a[href="#verification_sheet"]').tab('show');
		$('.timestamps').text(now);
	}

	$('#cancel_verification_btn').click(function(){
		$('#tabs a[href="#shipment_list"]').tab('show');
	});

	$('#ready_qa_btn').click(function(){
		shipment = $('#verify_shipment_id').val();
		socket.emit('command','/do-argus-ready_qa-'+shipment);
		$('#tabs a[href="#shipment_list"]').tab('show');
	});
</script>