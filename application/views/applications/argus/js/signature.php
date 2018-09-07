<script>
	function start_bol_sign(){
		$('#start_bol_signature').modal('show');
		$('#bol_shipper_sign').signature();
		$('#bol_carrier_sign').signature();
	}

	$('.start_release_btn').click(function(){
		socket.emit('command','/do-argus-loaded-'+shipment);
		$('.modal').modal('hide');
	});
</script>