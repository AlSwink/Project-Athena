<script>
	var	 shipment = $('#start_shipment_id').val();

	function start_shipment()
	{
		socket.emit('command','/do-argus-lock-'+shipment);
		$('#start_shipment').modal('show');
	}

	$('#start_shipment_btn').click(function(){
		socket.emit('command','/do-argus-started-'+shipment);
		$('.modal').modal('hide');
		socket.emit('command','/do-argus-unlock-'+shipment);
	});
</script>