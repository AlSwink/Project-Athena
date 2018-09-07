<script>
	function start_security_sign(){
		$('#start_security_signature').modal('show');
		$('#security_sign').signature();
	}

	$('.complete_btn').click(function(){
		socket.emit('command','/do-argus-release-'+shipment);
		$('.modal').modal('hide');
	});
</script>