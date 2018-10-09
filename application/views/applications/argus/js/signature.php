<script>
	function start_bol_sign(){
		socket.emit('command','/do-argus-lock-'+shipment);
		$('#start_bol_signature').modal('show');
		$('#bol_shipper_sign').signature();
		$('#bol_carrier_sign').signature();
	}

	$('.start_release_btn').click(function(){
		socket.emit('command','/do-argus-loaded-'+shipment);
		$('.modal').modal('hide');
		socket.emit('command','/do-argus-unlock-'+shipment);
	});
</script>