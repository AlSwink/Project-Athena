<script>
	function start_shipment()
	{
		$('#start_shipment').modal('show');
	}

	$('#start_shipment_btn').click(function(){
		shipment = $('#start_shipment_id').val();
		socket.emit('command','/do-argus-started-'+shipment);
		$('.modal').modal('hide');
	});
</script>