<script>
	function start_qa()
	{
		now = moment().format('MM/DD/YYYY');
		$('#tabs a[href="#verification2_sheet"]').tab('show');
		$('.timestamps').text(now);
	}

	$('.cancel_verification_btn').click(function(){
		$('#tabs a[href="#shipment_list"]').tab('show');
	});

	$('#verified_btn').click(function(){
		shipment = $('#verify2_shipment_id').val();
		socket.emit('command','/do-argus-verified-'+shipment);
		$('#tabs a[href="#shipment_list"]').tab('show');
	});
</script>