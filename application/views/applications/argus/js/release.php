<script>
	function start_security_sign(){
		socket.emit('command','/do-argus-lock-'+shipment);
		$('#start_security_signature').modal('show');
		$('#security_sign').signature();
	}

	$('.complete_btn').click(function(){
		socket.emit('command','/do-argus-release-'+shipment);
		$('.modal').modal('hide');
		socket.emit('command','/do-argus-unlock-'+shipment);
	});
</script>